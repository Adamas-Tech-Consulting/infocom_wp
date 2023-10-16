<?php
/*
Plugin Name: Custom Rest API
Plugin URI: 
Description: Rest API for Event Management
Armstrong:
Version: 1.0
Author: Avik Basak
*/

require('routes.php');
require('common.php');

function create_term(WP_REST_Request $request)
{
  $attributes = $request->get_attributes();
  $taxonomy = $attributes['args']['taxonomy'];
  $term = wp_insert_term(
    $request['name'],
    $taxonomy, 
    array(
        'description'   => $request['description'],
        'slug'          => $request['slug'],
    )
  );
  return new WP_REST_Response($term, 200);
}

function update_term(WP_REST_Request $request)
{
  $attributes = $request->get_attributes();
  $taxonomy = $attributes['args']['taxonomy'];
  $term_id = $request['term_id'];
  $args = [
    'name'        => $request['name'],
    'slug'        => $request['slug'],
    'description' => $request['description'],
  ];
  $term = wp_update_term($term_id, $taxonomy, $args);
  return new WP_REST_Response($term, 200);
}

function delete_term(WP_REST_Request $request)
{
  $attributes = $request->get_attributes();
  $taxonomy = $attributes['args']['taxonomy'];
  $term_id = $request['term_id'];
  $term = wp_delete_term($term_id, $taxonomy);
  return new WP_REST_Response($term, 200);
}

function create_post(WP_REST_Request $request)
{
  $attributes = $request->get_attributes();
  $post_type = $attributes['args']['post_type'];
  $taxonomy = $attributes['args']['taxonomy'];
  $my_post = array(
    'post_type'     => $post_type,
    'post_title'    => wp_strip_all_tags($request['title']),
    'post_content'  => $request['overview_description'],
    'post_author'   => 1,
  );
  $post_id = wp_insert_post($my_post);
  wp_set_post_terms($post_id, $request['category'], $taxonomy, false);
  set_featured_image($request['featured_banner'], $post_id);
  $banner_id = upload_media($request['event_banner'], $post_id);
  $logo_id = upload_media($request['event_logo'], $post_id);
  $input_fields = [
    'show_on_homepage_banner' => $request['featured'],
    'homepage_banner_url' => $request['featured_banner'],
    'add_banner' => $banner_id,
    'add_banner_url' => $request['event_banner'],
    'add_date' => date("d F, Y", strtotime($request['event_start_date'])),
    'add_venue' => $request['event_venue'],
    'add_theme' => $request['event_theme'],
    'add_conference_details' => $request['event_description'],
    'add_conference_logo' => $logo_id,
    'add_register_now_link' => $request['registration_link'],
  ];
  update_custom_fields($post_id, $input_fields);
  if(isset($request['event_speakers']) && $request['event_speakers']) {
    foreach($request['event_speakers'] as $key => $event_speaker)
    {
      upsert_event_speaker($post_id, $key, $event_speaker);
    }
  }
  if(isset($request['event_sponsors']) && $request['event_sponsors']) {
    foreach($request['event_sponsors'] as $key => $event_sponsor)
    {
      upsert_event_sponsor($post_id, $key, $event_sponsor);
    }
  }
  if(isset($request['event_cios']) && $request['event_cios']) {
    foreach($request['event_cios'] as $key => $event_cio)
    {
      upsert_event_cio($post_id, $key, $event_cio);
    }
  }
  $post = array('post_id' => $post_id);
  return new WP_REST_Response($post, 200);
}

function update_post(WP_REST_Request $request)
{
  $attributes = $request->get_attributes();
  $post_type = $attributes['args']['post_type'];
  $taxonomy = $attributes['args']['taxonomy'];
  $post_id = $request['post_id'];
  $my_post = array(
    'ID'            => $post_id,
    'post_type'     => $post_type,
    'post_title'    => wp_strip_all_tags($request['title']),
    'post_content'  => $request['overview_description'],
    'post_author'   => 1,
    'post_excerpt'  => $request['sub_title'],
    'post_status'   => (($request['published']) ? 'publish' : 'draft'),
  );
  wp_update_post($my_post);
  wp_set_post_terms($post_id, $request['category'], $taxonomy, false);
  $attach_id = get_post_thumbnail_id($post_id,'post');
  if((int)$attach_id>0) wp_delete_attachment($attach_id, true); 
  if(isset($request['featured_banner']) && $request['featured_banner'])
  {
    set_featured_image($request['featured_banner'], $post_id);
  }
  $input_fields = [
    'show_on_homepage_banner' => $request['featured'],
    'add_date' => date("d F, Y", strtotime($request['event_start_date'])),
    'add_venue' => $request['event_venue'],
    'add_theme' => $request['event_theme'],
    'add_conference_details' => $request['event_description'],
    'add_register_now_link' => $request['registration_link'],
  ];
  if(isset($request['event_banner']) && $request['event_banner']) {
    $attach_id = get_post_meta($post_id, 'add_banner', true);
    if((int)$attach_id>0) wp_delete_attachment($attach_id, true);
    $input_fields['add_banner'] = upload_media($request['event_banner'], $post_id);
  }
  if(isset($request['event_logo']) && $request['event_logo']) {
    $attach_id = get_post_meta($post_id, 'add_conference_logo', true);
    if((int)$attach_id>0) wp_delete_attachment($attach_id, true);
    $input_fields['add_conference_logo'] = upload_media($request['event_logo'], $post_id);
  }
  update_custom_fields($post_id, $input_fields);
  delete_custom_fields($post_id, 'add_speakers');
  delete_custom_fields($post_id, 'add_sponsers');
  delete_custom_fields($post_id, 'add_event_details');
  if(isset($request['event_speakers']) && $request['event_speakers']) {
    foreach($request['event_speakers'] as $key => $event_speaker)
    {
      upsert_event_speaker($post_id, $key, $event_speaker);
    }
  }
  if(isset($request['event_sponsors']) && $request['event_sponsors']) {
    foreach($request['event_sponsors'] as $key => $event_sponsor)
    {
      upsert_event_sponsor($post_id, $key, $event_sponsor);
    }
  }
  if(isset($request['event_agenda']) && $request['event_agenda']) {
    foreach($request['event_agenda'] as $key => $event_agenda)
    {
      upsert_event_agenda($post_id, $key, $event_agenda);
    }
  }
  $post = array('post_id' => $post_id);
  return new WP_REST_Response($post, 200);
}






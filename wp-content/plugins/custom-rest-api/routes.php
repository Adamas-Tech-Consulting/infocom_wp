<?php

//Create Event Category
add_action('rest_api_init', function () {
  register_rest_route('abp/v1', 'create-event-category', array(
    'methods'   => 'POST',
    'callback'  => 'create_term',
    'args'      => array('taxonomy' => 'event-categories')
  ));
});

//Update Event Category
add_action('rest_api_init', function () {
  register_rest_route('abp/v1', 'update-event-category/(?P<term_id>\d+)', array(
    'methods'   => 'POST',
    'callback'  => 'update_term',
    'args'      => array('taxonomy' => 'event-categories')
  ));
});

//Delete Event Category
add_action('rest_api_init', function () {
  register_rest_route('abp/v1', 'delete-event-category/(?P<term_id>\d+)', array(
    'methods'   => 'POST',
    'callback'  => 'delete_term',
    'args'      => array('taxonomy' => 'event-categories')
  ));
});


//Create Sponsorship Type
add_action('rest_api_init', function () {
  register_rest_route('abp/v1', 'create-sponsorship-type', array(
    'methods' => 'POST',
    'callback' => 'create_term',
    'args'      => array('taxonomy' => 'sponsor-categories')
  ));
});

//Update Sponsorship Type
add_action('rest_api_init', function () {
  register_rest_route('abp/v1', 'update-sponsorship-type/(?P<term_id>\d+)', array(
    'methods' => 'POST',
    'callback' => 'update_term',
    'args'      => array('taxonomy' => 'sponsor-categories')
  ));
});

//Delete Sponsorship Type
add_action('rest_api_init', function () {
  register_rest_route('abp/v1', 'delete-sponsorship-type/(?P<term_id>\d+)', array(
    'methods' => 'POST',
    'callback' => 'delete_term',
    'args'      => array('taxonomy' => 'sponsor-categories')
  ));
});

//Create Event
add_action('rest_api_init', function () {
  register_rest_route('abp/v1', 'create-event', array(
    'methods'   => 'POST',
    'callback'  => 'create_post',
    'args'      => array('post_type' => 'event-list','taxonomy' => 'event-categories')
  ));
});

//Update Event
add_action('rest_api_init', function () {
  register_rest_route('abp/v1', 'update-event/(?P<post_id>\d+)', array(
    'methods'   => 'POST',
    'callback'  => 'update_post',
    'args'      => array('post_type' => 'event-list','taxonomy' => 'event-categories')
  ));
});

//Create Event Agenda
add_action('rest_api_init', function () {
  register_rest_route('abp/v1', 'create-event-agenda/(?P<post_id>\d+)', array(
    'methods'   => 'POST',
    'callback'  => 'create_event_agenda',
  ));
});

//Update Event Agenda
add_action('rest_api_init', function () {
  register_rest_route('abp/v1', 'update-event-agenda/(?P<post_id>\d+)/(?P<row_id>\d+)/(?P<nested_row_id>\d+)', array(
    'methods'   => 'POST',
    'callback'  => 'update_event_agenda',
  ));
});

?>
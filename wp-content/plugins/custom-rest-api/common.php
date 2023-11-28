<?php
function upload_media($image_url, $post_id)
{
  $upload_dir = wp_upload_dir();
  $image_data = file_get_contents($image_url);
  $filename = basename($image_url);
  if(wp_mkdir_p($upload_dir['path']))
    $file = $upload_dir['path'] . '/' . $filename;
  else
    $file = $upload_dir['basedir'] . '/' . $filename;
  file_put_contents($file, $image_data);

  $wp_filetype = wp_check_filetype($filename, null );
  $attachment = array(
      'post_mime_type' => $wp_filetype['type'],
      'post_title' => sanitize_file_name($filename),
      'post_content' => '',
      'post_status' => 'inherit',
      'post_author'   => 1,
  );
  $attach_id = wp_insert_attachment( $attachment, $file, $post_id );
  return $attach_id;
}

function set_featured_image($image_url, $post_id) {
  $upload_dir = wp_upload_dir();
  $image_data = file_get_contents($image_url);
  $filename = basename($image_url);
  if(wp_mkdir_p($upload_dir['path']))
    $file = $upload_dir['path'] . '/' . $filename;
  else
    $file = $upload_dir['basedir'] . '/' . $filename;
  file_put_contents($file, $image_data);

  $wp_filetype = wp_check_filetype($filename, null );
  $attachment = array(
      'post_mime_type' => $wp_filetype['type'],
      'post_title' => sanitize_file_name($filename),
      'post_content' => '',
      'post_status' => 'inherit',
      'post_author'   => 1,
  );
  $attach_id = wp_insert_attachment( $attachment, $file, $post_id );
  require_once(ABSPATH . 'wp-admin/includes/image.php');
  $attach_data = wp_generate_attachment_metadata( $attach_id, $file );
  $res1= wp_update_attachment_metadata( $attach_id, $attach_data );
  $res2= set_post_thumbnail( $post_id, $attach_id );
  return $attach_id;
}

function update_custom_fields($post_id, $inputs=array(), $is_repeater=false, $row=0)
{
  foreach($inputs as $ikey => $value)
  {
    if($is_repeater) {
      update_row($ikey, $row, $value, $post_id);
    } else {
      $all_fields = acf_get_fields(52);
      $akey = array_search($ikey, array_column($all_fields, 'name'));
      update_field($all_fields[$akey]['key'], $value, $post_id);
    }
  }
}

function update_custom_sub_fields($post_id, $inputs=array(), $row_id, $nested_row_id)
{
  foreach($inputs as $ikey => $value)
  {
    foreach($value as $vkey => $v)
    {
      update_sub_row(array($ikey, $row_id, $vkey), $nested_row_id, $value[$vkey], $post_id);
    }
  }
}

function delete_custom_fields($post_id, $field_key)
{
  $rows = get_field($field_key, $post_id);
  if (!empty($rows)) {
    $count = count($rows);
    for ($index=$count; $index>0; $index--) {
      if($field_key == 'add_speakers') {
        $attach_id = get_post_meta($post_id, $field_key.'_'.($index-1).'_add_speaker_image', true);
        if((int)$attach_id>0) wp_delete_attachment($attach_id, true);
      }
      if($field_key == 'add_sponsers') {
        $attach_id = get_post_meta($post_id, $field_key.'_'.($index-1).'_sponsor_logo', true);
        if((int)$attach_id>0) wp_delete_attachment($attach_id, true);
      }
      if($field_key == 'add_event_details') {
        $sub_rows = $rows[$index-1]['add_events'];
        if (!empty($sub_rows)) {
          $sub_count = count($sub_rows);
          foreach($sub_rows as $skey => $sub_row) {
            $array[] = $field_key.'_'.($index-1).'_add_events_'.$skey.'_add_speaker_image';
            if (!empty($sub_row['add_speaker_image']))
            {
              $attach_id = get_post_meta($post_id, $field_key.'_'.($index-1).'_add_events_'.$skey.'_add_speaker_image', true);
              if((int)$attach_id>0) wp_delete_attachment($attach_id, true);
            }
          }
        }
      }
      delete_row($field_key, $index, $post_id);
    }
  }
}

function upsert_event_speaker($post_id, $row_id, $inputs)
{
  $row_id  = $row_id + 1;
  $input_fields = [
    'add_speakers' => [
      'add_speaker_name'    =>  $inputs['name'],
      'add_company_name'    =>  $inputs['company_name'],
      'add_designation'     =>  $inputs['designation'],
      'choose_speaker_type' =>  $inputs['speakers_category'], //KeyNoteSpeaker
      'add_speaker_image_url' => $inputs['image']
    ]
  ];
  if(isset($inputs['image']) && $inputs['image']) {
    $input_fields['add_speakers']['add_speaker_image'] = upload_media($inputs['image'], $post_id);
  }
  update_custom_fields($post_id, $input_fields, true, $row_id);
}

function upsert_event_cio($post_id, $row_id, $inputs)
{
  $row_id  = $row_id + 1;
  $input_fields = [
    'add_cio' => [
      'add_user_name'       =>  $inputs['name'],
      'add_user_type'       =>  $inputs['type'],
      'add_company_name'    =>  $inputs['company_name'],
      'add_user_designation'=>  $inputs['designation'],
      'add_linkedin_link'   =>  $inputs['linkedin_url'],
      'add_user_pic_url'    =>  $inputs['image'],
    ]
  ];
  update_custom_fields($post_id, $input_fields, true, $row_id);
}

function upsert_event_sponsor($post_id, $row_id, $inputs)
{
  $row_id  = $row_id + 1;
  $input_fields = [
    'add_sponsers' => [
      'sponsorship_type'    =>  $inputs['sponsorship_type_id'],
      'sponsors_name'       =>  $inputs['sponsor_name'],
      'company_website'     =>  $inputs['website_link'],
      'sponsor_logo_url'    =>  $inputs['sponsor_logo']
    ]
  ];
  if(isset($inputs['sponsor_logo']) && $inputs['sponsor_logo']) {
    $input_fields['add_sponsers']['sponsor_logo'] = upload_media($inputs['sponsor_logo'], $post_id);
  }
  update_custom_fields($post_id, $input_fields, true, $row_id);
}

function upsert_event_agenda($post_id, $row_id, $inputs)
{
  $row_id = $row_id + 1;
  $input_fields = [
    'add_event_details' => [
      'add_day'     =>  strtoupper(date("D", strtotime($inputs['agenda_date']))),
      'add_date'    =>  date("d F, Y", strtotime($inputs['agenda_date']))
    ]
  ];
  update_custom_fields($post_id, $input_fields, true, $row_id);
  if(isset($inputs['agenda_details']) && $inputs['agenda_details']) {
    foreach($inputs['agenda_details'] as $agdtls => $agenda_details)
    {
      if(isset($agenda_details['add_speaker_image'])) {
        $agenda_details['add_speaker_image'] = upload_media($agenda_details['add_speaker_image'], $post_id);
      }
      $nested_row_id = $agenda_details['row_id'];
      $input_fields = array(
        'add_event_details' => array(
          'add_events' => $agenda_details
        )
      );
      update_custom_sub_fields($post_id, $input_fields, $row_id, $nested_row_id);
    }
  }
}
?>

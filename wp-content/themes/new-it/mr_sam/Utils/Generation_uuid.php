<?php
// START Generation uuid
  class GenerationUUIDHelper
  {
    public static function uuid($entityType = null)
    {
      $entityType = strtolower($entityType);

      $data = random_bytes(16);

      $data[6] = chr(ord($data[6]) & 0x0f | 0x40); // set version to 0100
      $data[8] = chr(ord($data[8]) & 0x3f | 0x80); // set bits 6-7 to 10

      return is_null($entityType)
        ? vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4))
        : vsprintf($entityType . '%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
    }
  }

  function post_is_in_descendant_category($cats, $_post = null) {
    foreach ( (array) $cats as $cat ) {
      // get_term_children() accepts integer ID only
      $descendants = get_term_children( (int) $cat, 'category');
      if ($descendants && in_category( $descendants, $_post) )
        return true;
    }
    return false;
  }

  function action_check_uuid_in_course($post_ID, $post, $update) {
    $cat_education = array(22, 219, 23, 296);
    if (in_category($cat_education) || post_is_in_descendant_category($cat_education, $post)) {

      if (pll_get_post_language($post_ID) == 'ru') {
        $post_meta_uuid = get_post_meta($post_ID, 'uuid_for_itea_crm', true);
        if (empty($post_meta_uuid)) {
          delete_post_meta($post_ID, 'uuid_for_itea_crm');
          update_post_meta($post_ID, 'uuid_for_itea_crm', GenerationUUIDHelper::uuid('CURS'));
        }
      } else {
        delete_post_meta($post_ID, 'uuid_for_itea_crm');
      }
    }
  }
  add_action( 'save_post', 'action_check_uuid_in_course', 10, 3 );

  function action_check_uuid_in_road($term_id, $taxonomy) {
    $cat_education = array(22, 219, 23, 296);
    $parent_categories = get_ancestors($term_id, 'category');
    if (array_uintersect($cat_education, $parent_categories, 'strcasecmp')) {
      if (pll_get_post_language($term_id) == 'ru') {
        $term_meta_uuid = get_term_meta($term_id, 'uuid_for_itea_crm', true);
        if (empty($term_meta_uuid)) {
          delete_term_meta($term_id, 'uuid_for_itea_crm');
          update_term_meta($term_id, 'uuid_for_itea_crm', GenerationUUIDHelper::uuid('ROAD'));
        }
      } else {
        delete_post_meta($term_id, 'uuid_for_itea_crm');
      }
    }
  }
  add_action( 'edited_terms', 'action_check_uuid_in_road', 10, 2 );
  // END Generation uuid

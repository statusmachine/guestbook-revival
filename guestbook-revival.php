<?php
/**
 * Plugin Name: Guestbook Revival
 * Description: Makes your WordPress site web-1.0-compliant.
 * Author: Julien Desrosiers
 * Text Domain: guestbook-revival
 * Domain Path: /languages
 * License: GPLv2
 */

defined( 'ABSPATH' ) or die( 'I got your IP, and I just called the cops.' );


assert_options(ASSERT_ACTIVE, 1);
assert_options(ASSERT_WARNING, 0);
assert_options(ASSERT_BAIL, 1);
assert_options(ASSERT_CALLBACK, 'gbr_callback');

function gbr_callback($script, $line, $message) {
  echo "<h1>Condition failed!</h1><br />
      Script: <strong>$script</strong><br />
      Line: <strong>$line</strong><br />
      Condition: <br /><pre>$message</pre>";
}


define('GBR_CUSTOM_POST_TYPE', 'guestbook_entry');

function gbr_load_textdomain() {
  load_plugin_textdomain('guestbook-revival', false, basename(dirname(__FILE__)) . '/languages');
}
add_action( 'plugins_loaded', 'gbr_load_textdomain' );



function gbr_taxonomy_update_count_callback() {
}

// Register Custom Taxonomy
function gbr_register_taxonomy() {

  $labels = array(
    'name'                       => _x( 'Guestbook Tags', 'Taxonomy General Name', 'guestbook-revival' ),
    'singular_name'              => _x( 'Guestbook Tag', 'Taxonomy Singular Name', 'guestbook-revival' ),
    'menu_name'                  => __( 'Guestbook Tag', 'guestbook-revival' ),
    'all_items'                  => __( 'All Guestbook Tags', 'guestbook-revival' ),
    'parent_item'                => __( 'Parent Guestbook Tag', 'guestbook-revival' ),
    'parent_item_colon'          => __( 'Guestbook Tag:', 'guestbook-revival' ),
    'new_item_name'              => __( 'New Guestbook Tag Name', 'guestbook-revival' ),
    'add_new_item'               => __( 'Add New Guestbook Tag', 'guestbook-revival' ),
    'edit_item'                  => __( 'Edit Guestbook Tag', 'guestbook-revival' ),
    'update_item'                => __( 'Update Guestbook Tag', 'guestbook-revival' ),
    'view_item'                  => __( 'View Guestbook Tag', 'guestbook-revival' ),
    'separate_items_with_commas' => __( 'Separate tags with commas', 'guestbook-revival' ),
    'add_or_remove_items'        => __( 'Add or remove Guestbook Tag', 'guestbook-revival' ),
    'choose_from_most_used'      => __( 'Choose from the most used', 'guestbook-revival' ),
    'popular_items'              => __( 'Popular Guestbook Tags', 'guestbook-revival' ),
    'search_items'               => __( 'Search Guestbook Tags', 'guestbook-revival' ),
    'not_found'                  => __( 'Not Found', 'guestbook-revival' ),
    'no_terms'                   => __( 'No guestbook tags', 'guestbook-revival' ),
    'items_list'                 => __( 'Guestbook tags list', 'guestbook-revival' ),
    'items_list_navigation'      => __( 'Guestbook Tags list navigation', 'guestbook-revival' ),
  );
  $args = array(
    'labels'                     => $labels,
    'hierarchical'               => false,
    'public'                     => true,
    'show_ui'                    => true,
    'show_admin_column'          => true,
    'show_in_nav_menus'          => false,
    'show_tagcloud'              => false,
    'update_count_callback'      => 'gbr_taxonomy_update_count_callback',
    'show_in_rest'               => false,
  );
  register_taxonomy( 'gbr_guestbook_tag', array( GBR_CUSTOM_POST_TYPE ), $args );

}
add_action( 'init', 'gbr_register_taxonomy', 0 );

// Register Custom Post Type
function gbr_register_post_type() {

  $labels = array(
    'name'                  => _x( 'Guestbook Entries', 'Post Type General Name', 'guestbook-revival' ),
    'singular_name'         => _x( 'Guestbook Entry', 'Post Type Singular Name', 'guestbook-revival' ),
    'menu_name'             => __( 'Guestbook Entries', 'guestbook-revival' ),
    'name_admin_bar'        => __( 'Guestbook Entry', 'guestbook-revival' ),
    'archives'              => __( 'Guestbook Entry Archives', 'guestbook-revival' ),
    'attributes'            => __( 'Guestbook Entry Attributes', 'guestbook-revival' ),
    'parent_item_colon'     => __( 'Parent Guestbook Entry:', 'guestbook-revival' ),
    'all_items'             => __( 'All Guestbook Entries', 'guestbook-revival' ),
    'add_new_item'          => __( 'Add New Guestbook Entry', 'guestbook-revival' ),
    'add_new'               => __( 'Add New', 'guestbook-revival' ),
    'new_item'              => __( 'New Guestbook Entry', 'guestbook-revival' ),
    'edit_item'             => __( 'Edit Guestbook Entry', 'guestbook-revival' ),
    'update_item'           => __( 'Update Guestbook Entry', 'guestbook-revival' ),
    'view_item'             => __( 'View Guestbook Entry', 'guestbook-revival' ),
    'view_items'            => __( 'View Guestbook Entries', 'guestbook-revival' ),
    'search_items'          => __( 'Search Guestbook Entry', 'guestbook-revival' ),
    'not_found'             => __( 'Not found', 'guestbook-revival' ),
    'not_found_in_trash'    => __( 'Not found in Trash', 'guestbook-revival' ),
    'featured_image'        => __( 'Featured Image', 'guestbook-revival' ),
    'set_featured_image'    => __( 'Set featured image', 'guestbook-revival' ),
    'remove_featured_image' => __( 'Remove featured image', 'guestbook-revival' ),
    'use_featured_image'    => __( 'Use as featured image', 'guestbook-revival' ),
    'insert_into_item'      => __( 'Insert into guestbook entry', 'guestbook-revival' ),
    'uploaded_to_this_item' => __( 'Uploaded to this guestbook entry', 'guestbook-revival' ),
    'items_list'            => __( 'Guestbook Entries list', 'guestbook-revival' ),
    'items_list_navigation' => __( 'Guestbook Entries list navigation', 'guestbook-revival' ),
    'filter_items_list'     => __( 'Filter guestbook entries list', 'guestbook-revival' ),
  );
  $args = array(
    'label'                 => __( 'Guestbook Entry', 'guestbook-revival' ),
    'description'           => __( 'A message someone left into our guestbook.', 'guestbook-revival' ),
    'labels'                => $labels,
    'supports'              => array( 'title', 'editor' ),
    'taxonomies'            => array( 'gbr_guestbook_tag' ),
    'hierarchical'          => false,
    'public'                => true,
    'show_ui'               => true,
    'show_in_menu'          => true,
    'menu_position'         => 25,
    'menu_icon'             => 'dashicons-book',
    'show_in_admin_bar'     => true,
    'show_in_nav_menus'     => false,
    'can_export'            => true,
    'has_archive'           => true,
    'exclude_from_search'   => true,
    'publicly_queryable'    => true,
    'capability_type'       => 'page',
    'show_in_rest'          => false,
  );
  register_post_type( GBR_CUSTOM_POST_TYPE, $args );

}
add_action( 'init', 'gbr_register_post_type', 0 );


// Form & action to handle that form:
define('GBR_CREATE_ACTION', 'gbr_create_guestbook');
define('GBR_CREATE_NONCE_FIELD', GBR_CREATE_ACTION.'_nonce');

function gbr_guestbook_form() {
  return "<form action='".get_admin_url()."admin-post.php' method='post'>
    <input type='hidden' name='action' value='".GBR_CREATE_ACTION."'>
    ". wp_nonce_field( GBR_CREATE_ACTION, GBR_CREATE_NONCE_FIELD, true, false ) ."
    <p>
      <input name='guestbook_name' type='text' placeholder='Billy Bob'>
    </p>
    <p>
      <textarea name='guestbook_content' cols='45' rows='8' maxlength='1000' required='required' placeholder='I really like your website...'></textarea>
    </p>
    <p>
      <input type='submit' value='".__( 'Send', 'guestbook-revival' )."'>
    </p>
  </form>";
}
add_shortcode( 'guestbook_form', 'gbr_guestbook_form' );


function gbr_guestbook() {
  apply_filters('the_content', ''); // exit the current (parent) the_content filtering context
  $n_posts_per_page = -1; // -1 means no limit
  $posts = get_posts([
    'numberposts' => $n_posts_per_page,
    'post_type' => GBR_CUSTOM_POST_TYPE,
  ]);
  $posts_count = wp_count_posts(GBR_CUSTOM_POST_TYPE);
  $published_posts_count = $posts_count->publish;
  $current_page = get_query_var('paged');

  $html = "<div class='gbr-guestbook-entries'>";
  foreach ($posts as $post) {
    $html .= "<div class='gbr-guestbook-entry'>";
    $html .= "  <h3 class='gbr-guestbook-entry-title'>".$post->post_title."</h3>";
    $html .= "  <div class='gbr-guestbook-entry-content'>".apply_filters('the_content', $post->post_content)."</div>";
    $html .= "</div>";
  }
  $html .= "</div>"; // ends gbr-guestbook-entries

  return $html;
}
add_shortcode( 'guestbook', 'gbr_guestbook' );


function gbr_form_handling() {
  if (!isset( $_POST[GBR_CREATE_NONCE_FIELD] )
  || ! wp_verify_nonce( $_POST[GBR_CREATE_NONCE_FIELD], GBR_CREATE_ACTION)) {
    wp_die("This action is protected.");
  } else {
    wp_insert_post([
      'post_title' => $_POST['guestbook_name'],
      'post_content' => $_POST['guestbook_content'],
      'post_type' => GBR_CUSTOM_POST_TYPE,
      'post_status' => 'publish',
    ], $error_on_failure = false);

    wp_redirect( $_SERVER['HTTP_REFERER'] );
    exit;
  }
}
add_action( 'admin_post_'.GBR_CREATE_ACTION, 'gbr_form_handling' );
add_action( 'admin_post_nopriv_'.GBR_CREATE_ACTION, 'gbr_form_handling' );

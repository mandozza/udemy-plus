<?php
/**
 * Actions to perform on plugin activation.
 *
 * Checks the current WordPress version, and if it's below 5.9, the plugin
 * activation is halted with a message. Otherwise, it registers the 'recipe'
 * custom post type and flushes the rewrite rules.
 *
 * @since 1.0.0
 */
function up_activate_plugin() {

  if ( version_compare( get_bloginfo( 'version' ), '5.9', '<' ) ) {
    wp_die( __('You must update WordPress to use this plugin.', 'udemy-plus') );
  }

  up_recipe_post_type();
  flush_rewrite_rules();
}

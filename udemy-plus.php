<?php
/*
 * Plugin Name:       Udemy Plus
 * Plugin URI:        https://example.com/plugins/udemy-plus/
 * Description:       Adds blocks to be used in theme.
 * Version:           1.0.0
 * Requires at least: 5.9
 * Requires PHP:      7.2
 * Author:            Jeremy Josey
 * Author URI:        https://jeremy.example.com/
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Update URI:        https://example.com/udemy-plus/
 * Text Domain:       udemy-plus
 * Domain Path:       /languages
 */

  // If this file is called directly, abort.
  if ( !function_exists( 'add_action' ) ) {
    exit;
  }

  // Setup
  define( 'UP_PLUGIN_DIR', plugin_dir_path(__FILE__));
// Includes
/**
 * Automatically includes all PHP files from the plugin's "includes" directory and its subdirectories.
 *
 * 1. Fetches all PHP files directly under the "includes" directory.
 * 2. Fetches all PHP files from subdirectories within the "includes" directory.
 * 3. Merges both sets of files into a single array.
 * 4. Includes each file once.
 *
 * Below is a few examples of files that will be included automatically if present:
 * includes/register-blocks.php
 * includes/blocks/search-form.php
 *
 * @package Udemy-Plus
 * @author Jeremy Josey
 */

  $rootFiles =glob(UP_PLUGIN_DIR . 'includes/*.php');
  $subdirectoryFiles = glob(UP_PLUGIN_DIR . 'includes/**/*.php');
  $allFiles = array_merge($rootFiles, $subdirectoryFiles);

  foreach($allFiles as $filename) {
    include_once($filename);
  }

  // Hooks
  add_action( 'init', 'up_register_blocks' );
  add_action( 'rest_api_init', 'up_rest_api_init' );
  add_action ( 'wp_enqueue_scripts', 'up_enqueue_scripts' );


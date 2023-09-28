<?php
/**
 * Registers custom blocks for the plugin.
 *
 * This function registers a list of custom blocks defined in the $blocks array.
 * Each block in the array should have a 'name' key that represents the block's directory name.
 *
 * @since 1.0.0 The version where this function was introduced.
 * @uses register_block_type() Uses WordPress function to register the block types.
 *
 * @return void
 */
function up_register_blocks() {

  $blocks = [
    [ 'name' => 'fancy-header' ],
    [ 'name' => 'search-form', 'options' => [
      'render_callback' => 'up_search_form_render_cb'
    ]],
    [ 'name' => 'page-header', 'options' => [
      'render_callback' => 'up_page_header_render_cb'
    ]],
    [ 'name' => 'header-tools', 'options' => [
      'render_callback' => 'up_header_tools_render_cb'
    ]],
    [ 'name' => 'auth-modal', 'options' => [
      'render_callback' => 'up_auth_modal_render_cb'
    ]]
  ];

  foreach ($blocks as $block) {
    register_block_type(
      UP_PLUGIN_DIR . 'build/blocks/'. $block['name'],
      isset($block['options']) ? $block['options'] : []
    );
  }
}

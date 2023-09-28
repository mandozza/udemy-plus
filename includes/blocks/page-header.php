<?php
/**
 * Renders the page header block.
 *
 * This function outputs a block with a heading. By default, it uses the 'content' attribute from
 * the passed $atts for the heading. If 'showCategory' is set in $atts and is true, it will
 * override the heading with the archive title.
 *
 * @since 1.0.0 The version where this function was introduced.
 *
 * @param array $atts {
 *     An array of attributes used for rendering the block.
 *
 *     @type string  $content       The default content for the heading. Default empty string.
 *     @type bool    $showCategory  Whether to display the archive title as the heading.
 *                                  Default false.
 * }
 * @return string Returns the HTML string for the block.
 */

function up_page_header_render_cb($atts) {
  $heading =esc_html($atts['content']);
  if($atts['showCategory']) {
    $showCategory = true;
    $heading = get_the_archive_title();
  }

  ob_start();
?>
  <div class="wp-block-udemy-plus-page-header">
    <div className="inner-page-header">
      <h1><?php echo $heading; ?></h1>
    </div>
  </div>
<?php
  $output = ob_get_contents();
  ob_end_clean();

  return $output;
}

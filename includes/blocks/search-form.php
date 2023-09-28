<?php

/**
 * Render callback for the 'udemy-plus' custom search form block.
 *
 * This function outputs a styled search form with an accompanying title. The background color
 * and text color for the form can be specified using the provided block attributes.
 *
 * @since 1.0.0 The version where this function was introduced.
 *
 * @param array $atts {
 *     Attributes of the block.
 *
 *     @type string $bgColor     Background color for the search form and button.
 *     @type string $textColor   Text color for the search form title and button.
 * }
 *
 * @return string Rendered search form block HTML.
 */
function up_search_form_render_cb($atts)
{
  $bgColor = esc_attr($atts['bgColor']);
  $textColor = esc_attr($atts['textColor']);
  $styleAtt = "background-color: {$bgColor}; color: {$textColor};";

  ob_start();
?>
  <div style="<?php echo $styleAtt; ?>" class="wp-block-udemy-plus-search-form">
    <h1>
      <?php esc_html_e('Search', 'udemy-plus'); ?>:
      <?php the_search_query(); ?>
    </h1>
    <form action="<?php echo esc_url(home_url('/')); ?>">
      <input type="text" placeholder=<?php esc_html_e('Search', 'udemy-plus'); ?> name="s" value="<?php the_search_query(); ?>" />
      <div class="btn-wrapper">
        <button type="submit" style="<?php echo $styleAtt; ?>">
          <?php esc_html_e('Search', 'udemy-plus'); ?>
        </button>
      </div>
    </form>
  </div>
<?php
  $output = ob_get_contents();
  ob_end_clean();

  return $output;
}

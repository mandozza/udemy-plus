<?php
/**
 * Save the 'up_more_info_url' meta value for a given cuisine term.
 *
 * @param int $termID The ID of the term to which the meta data will be saved.
 *
 * @return void
 * @since 1.0.0
 */
function up_save_cuisine_meta($termID) {
  if(!isset($_POST['up_more_info_url'])) {
    return;
  }

  update_term_meta($termID, 'up_more_info_url', esc_url_raw($_POST['up_more_info_url']));
}

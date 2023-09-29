<?php
/**
 * Display a custom input field in the "Add New Cuisine" term form.
 *
 * @since 1.0.0
 */
function up_cuisine_add_form_fields() {
  $url = get_term_meta($term->term_id, 'up_more_info_url', true);
?>
  <div class="form-field">
    <label for="up_more_info_url"><?php _e('More Info URL', 'udemy-plus'); ?></label>
    <input name="up_more_info_url" id="more-info" type="text"  />
    <p><?php _e('A URL a user can click to learn more information on this cuisine', 'udemy-plus'); ?></p>
  </div>
<?php
}

/**
 * Add a custom input field to the "Edit Cuisine" term form.
 *
 * @param WP_Term $term The current term object.
 *
 * @since 1.0.0
 */
function up_cuisine_edit_form_fields($term) {
  ?>
  <tr class="form-field">
    <th scope="row" valign="top">
      <label for="up_more_info_url"><?php _e('More Info URL', 'udemy-plus'); ?></label>
    </th>
    <td>
      <input name="up_more_info_url" id="more-info" type="text" value="<?php echo esc_attr( $url ); ?>" />
      <p class="description"><?php _e('A URL a user can click to learn more information on this cuisine', 'udemy-plus'); ?></p>
    </td>
  </tr>
  <?php
}

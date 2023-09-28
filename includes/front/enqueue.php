<?php
/**
 * Enqueues inline scripts for authentication.
 *
 * This function embeds a JSON object containing the REST API URL for signing up.
 * The data is injected into the 'udemy-plus-auth-modal-script' as a JavaScript constant named 'up_auth_rest'.
 *
 * @since 1.0.0
 * @return void
 */
function up_enqueue_scripts() {
  $authURLs = json_encode([
    'signup' => esc_url_raw(rest_url('up/v1/signup')),
    'signin' => esc_url_raw(rest_url('up/v1/signin'))
  ]);

  wp_add_inline_script(
    'udemy-plus-auth-modal-script',
    "const up_auth_rest = {$authURLs}",
    'before'
  );
}

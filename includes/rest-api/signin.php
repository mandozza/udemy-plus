<?php
/**
 * Handles the REST API request for user sign-in.
 *
 * This function processes the user sign-in request based on the provided `user_login` and `password` parameters.
 * The `user_login` parameter can be an email or username. If the sign-in fails, it returns a status of 1.
 * On successful sign-in, it returns a status of 2.
 *
 * @since 1.0.0
 * @param WP_REST_Request $request The REST request object containing sign-in parameters.
 * @return array Returns an associative array with a 'status' key. A status of 1 indicates sign-in failure,
 *               and a status of 2 indicates a successful sign-in.
 *
 * @uses sanitize_email() To sanitize the email/username input.
 * @uses sanitize_text_field() To sanitize the password input.
 * @uses wp_signon() To attempt a user sign-in with WordPress.
 * @uses is_wp_error() To check if the sign-in resulted in an error.
 */
function up_rest_api_signin_handler($request) {
  $response = ['status' => 1];
  $params = $request->get_json_params();

  if(
    !isset($params['user_login'], $params['password']) ||
    empty($params['user_login']) ||
    empty($params['password'])
  ) {
    return $response;
  }

  $email = sanitize_email($params['user_login']);
  $password = sanitize_text_field($params['password']);

  $user = wp_signon([
    'user_login' => $email,
    'user_password' => $password,
    'remember' => true
  ]);

  if(is_wp_error($user)) {
    return $response;
  }

  $response['status'] = 2;
  return $response;
}

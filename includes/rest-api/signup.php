<?php
/**
 * Handles the REST API request for user signup.
 *
 * This function attempts to register a new user based on the provided request parameters.
 * The expected parameters are 'email', 'password', and 'username'.
 * If the user registration is successful, it sets the user session and triggers the 'wp_login' action.
 *
 * @since 1.0.0
 * @param WP_REST_Request $request The REST request object.
 * @return array Returns an associative array with a 'status' key. A status of 1 indicates failure,
 *               and a status of 2 indicates success.
 *
 * @uses sanitize_email() To sanitize the email address.
 * @uses sanitize_text_field() To sanitize the password and username.
 * @uses username_exists() To check if the username already exists.
 * @uses email_exists() To check if the email address already exists.
 * @uses wp_insert_user() To insert a new user into the database.
 * @uses is_wp_error() To check if the user registration resulted in an error.
 * @uses wp_new_user_notification() To send a new user notification.
 * @uses wp_set_current_user() To set the current user.
 * @uses wp_set_auth_cookie() To set the authentication cookie.
 * @uses get_user_by() To get the user object by ID.
 * @uses do_action() To trigger the 'wp_login' action.
 */
function up_rest_api_signup_handler($request) {
  $response = ['status' => 1];
  $params = $request->get_json_params();

  if( !isset($params['email'], $params['password'], $params['username']) ||
      empty($params['email']) ||
      empty($params['password']) ||
      empty($params['username'])
    ) {
      return $response;
  }
  $email = sanitize_email($params['email']);
  $password = sanitize_text_field($params['password']);
  $username = sanitize_text_field($params['username']);

  if(
    username_exists($username) ||
    !is_email($email) ||
    email_exists($email)
    ) {
      return $response;
    }

  $userID = wp_insert_user([
    'user_login' => $username,
    'user_email' => $email,
    'user_pass' => $password,
    'role' => 'subscriber'
  ]);

  if(is_wp_error($userID)) {
    return $response;
  }

  wp_new_user_notification($userID, null, 'both');
  wp_set_current_user($userID);
  wp_set_auth_cookie($userID);

  $user = get_user_by('id', $userID);

  do_action('wp_login', $username, $user->user_login, $user);


  $response['status'] = 2;
  return $response;
}

<?php
/**
 * Initializes custom REST API endpoints for the 'up' namespace.
 *
 * This function registers two REST API routes under the 'up/v1' namespace:
 * 1. A `/signup` route intended for user registration, handled by the 'up_rest_api_signup_handler' callback.
 *    The endpoint accepts requests equivalent to POST.
 * 2. A `/signin` route intended for user sign-in, handled by the 'up_rest_api_signin_handler' callback.
 *    The endpoint accepts requests equivalent to POST or PUT.
 *
 * Both endpoints are accessible without any specific permission checks by default.
 *
 * @since 1.0.0
 *
 * @uses register_rest_route() To register new REST API routes.
 * @uses WP_REST_Server::CREATABLE A constant representing the HTTP POST method.
 * @uses WP_REST_Server::EDITABLE A constant representing the HTTP POST and PUT methods.
 */
function up_rest_api_init() {
  register_rest_route( 'up/v1', '/signup', [
    'methods' => WP_REST_Server::CREATABLE,
    'callback' => 'up_rest_api_signup_handler',
    'permission_callback' => '__return_true'
  ]);

  register_rest_route('up/v1', '/signin', [
    'methods' => WP_REST_Server::EDITABLE,
    'callback' => 'up_rest_api_signin_handler',
    'permission_callback' => '__return_true'
  ]);
}

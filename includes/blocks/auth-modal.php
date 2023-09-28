<?php
/**
 * Renders the authentication modal for the Udemy Plus plugin.
 *
 * Generates the markup for the authentication modal, which includes both sign-in and sign-up forms.
 * The modal will not be displayed if the user is already logged in. The 'showRegister' attribute
 * determines if the registration (sign-up) tab should be displayed alongside the sign-in tab.
 *
 * @since 1.0.0
 * @param array $atts {
 *     An array of attributes used for rendering the modal.
 *
 *     @type bool $showRegister Determines if the sign-up form should be displayed. Default false.
 * }
 * @return string Returns the HTML string for the authentication modal or an empty string if the user is logged in.
 *
 * @uses is_user_logged_in() To check if the user is currently logged in.
 */
function up_auth_modal_render_cb($atts) {
  if(is_user_logged_in()) {
    return '';
  }

  ob_start();
?>
  <div class="wp-block-udemy-plus-auth-modal">
    <div class="modal-container">
      <div class="modal-overlay"></div>

      <span class="modal-trick">&#8203;</span>

      <div class="modal-content">
        <button class="modal-btn-close" type="button">
          <i class="bi bi-x"></i>
        </button>
        <!-- Tabs -->
        <ul class="tabs">
          <!-- Login Tab -->
          <li>
            <a href="#signin-tab" class="active-tab">
              <i class="bi bi-key"></i>Sign in
            </a>
          </li>
          <?php
            if ($atts['showRegister']) {
          ?>
          <!-- Register Tab -->
          <li>
            <a href="#signup-tab">
              <i class="bi bi-person-plus-fill"></i>Sign up
            </a>
          </li>
          <?php
            }
          ?>
        </ul>
        <div class="modal-body">
          <!-- Login Form -->
          <form id="signin-tab" style="display: block;">
            <div id="signin-status"></div>
            <fieldset>
              <label>Name/Email</label>
              <input type="text" id="si-email" placeholder="johndoe@example.com" />

              <label>Password</label>
              <input type="password" id="si-password" />

              <button type="submit">Sign in</button>
            </fieldset>
          </form>
          <?php
            if ($atts['showRegister']) {
          ?>
          <!-- Register Form -->
          <form id="signup-tab">
            <div id="signup-status"></div>
            <fieldset>
              <label>Full name</label>
              <input type="text" id="su-name" placeholder="John Doe" />

              <label>Email address</label>
              <input type="email" id="su-email" placeholder="johndoe@example.com" />

              <label for="su-password">Password</label>
              <input type="password" id="su-password" />

              <button type="submit">Sign up</button>
            </fieldset>
          </form>
          <?php
            }
          ?>
        </div>
      </div>
    </div>
  </div>

<?php
  $output = ob_get_contents();
  ob_get_clean();
  return $output;
}

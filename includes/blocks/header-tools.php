<?php
/**
 * Renders header tools for the Udemy Plus plugin.
 *
 * This function generates the markup for the header tools section. If the user is logged in,
 * it displays their username. Otherwise, it provides a 'Sign In' link. When the 'showAuth'
 * attribute is set to true, the authentication section (either 'Sign In' or the user's name)
 * will be displayed.
 *
 * @since 1.0.0
 * @param array $atts {
 *     An array of attributes used for rendering the block.
 *
 *     @type bool $showAuth Whether to display the authentication section. Default false.
 * }
 * @return string Returns the HTML string for the header tools.
 *
 * @uses wp_get_current_user() To fetch the current WordPress user.
 */
function up_header_tools_render_cb($atts)
{
  $user = wp_get_current_user();
  $name = $user->exists() ? $user->user_login : 'Sign In';
  $openClass = $user->exists() ? '' : 'open-modal';

  $showAuth = $atts['showAuth'] ?? false;
  ob_start();
?>
  <div class="wp-block-udemy-plus-header-tools">
    <?php
    if ($showAuth) {
    ?>
      <a class="signin-link <?php echo $openClass; ?>" href="#">
        <div class="signin-icon">
          <i class="bi bi-person-circle"></i>
        </div>
        <div class="signin-text">
          <small>Hello, <?php echo $name; ?></small>
          My Account
        </div>
      </a>
    <?php
    }
    ?>
  </div>
<?php
  $output = ob_get_contents();
  ob_end_clean();

  return $output;
}

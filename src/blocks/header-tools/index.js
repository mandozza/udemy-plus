import { registerBlockType } from '@wordpress/blocks';
import { useBlockProps, InspectorControls } from '@wordpress/block-editor';
import { PanelBody, SelectControl,CheckboxControl} from '@wordpress/components';
import { __ } from '@wordpress/i18n';
import icons from '../../icons.js'
import './main.css'

/**
 * Registers a custom Gutenberg block for Udemy Plus header tools.
 *
 * This block offers controls to configure and display a login/register link.
 * Users can choose whether to show the login/register link through a select
 * control and a checkbox in the block inspector.
 *
 * @typedef {Object} Attributes
 * @property {boolean} showAuth - Determines if the login/register link should be displayed.
 *
 * @function edit - The edit function that describes the structure of the block in the editor.
 * @param {Attributes} attributes - The block attributes used in the edit function.
 * @param {function} setAttributes - A function to update block attributes.
 *
 * @returns {WPElement} Element that represents the block's UI as it appears in the editor.
 */
registerBlockType('udemy-plus/header-tools', {
  icon: {
    src: icons.primary
  },
  edit({ attributes, setAttributes }) {
    const { showAuth } = attributes;
    const blockProps = useBlockProps();

    return (
      <>
        <InspectorControls>
          <PanelBody title={ __('General', 'udemy-plus') }>
            <SelectControl
            label = {__('Show Login/ Register Link', 'udemy-plus')}
            value = {showAuth}
            option={[
              {label:__('Yes', 'udemy-plus'), value: true},
              {label:__('No', 'udemy-plus'), value: false},
            ]}
            onChange={ newVal => setAttributes({ showAuth: (newVal === 'true') })}
            />
            <CheckboxControl
              label = {__('Show Login/ Register Link', 'udemy-plus')}
              help = {
                showAuth ?
                __('Show Login/ Register Link', 'udemy-plus') :
                __('Hide Login/ Register Link', 'udemy-plus')
              }
              checked = { showAuth }
              onChange = { showAuth => setAttributes({ showAuth })}
            />
          </PanelBody>
        </InspectorControls>
        <div { ...blockProps }>
          {  showAuth &&
            <a className="signin-link open-modal" href="#">
              <div className="signin-icon">
                <i className="bi bi-person-circle"></i>
              </div>
              <div className="signin-text">
                <small>Hello, Sign in</small>
                My Account
              </div>
            </a>
          }
        </div>
      </>
    );
  }
});

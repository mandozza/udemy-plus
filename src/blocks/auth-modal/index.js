import { registerBlockType } from '@wordpress/blocks';
import { useBlockProps, InspectorControls } from '@wordpress/block-editor';
import { PanelBody, ToggleControl } from '@wordpress/components';
import { __ } from '@wordpress/i18n';
import icons from '../../icons.js'
import './main.css'

/**
 * Registers the 'udemy-plus/auth-modal' block.
 *
 * This block provides a modal for authentication purposes. It can be configured
 * to either display or hide the registration form using the inspector control.
 * The block is not previewable directly from the editor and instead instructs
 * users to view the live site for a demonstration.
 *
 * @since 1.0.0
 *
 * @see {@link https://developer.wordpress.org/block-editor/reference-guides/block-api/block-registration/|Block Registration in Block Editor Handbook}
 *
 * @property {Object} icon                The icon object for the block.
 * @property {Object} icon.src            The source icon from the defined icons.
 * @property {Function} edit              The edit function for the block which returns the edit UI.
 * @property {Object} attributes          The block's attributes.
 * @property {boolean} attributes.showRegister Determines if the registration form should be shown.
 *
 * @returns {WPElement} Element structure for the block's edit UI.
 */
registerBlockType('udemy-plus/auth-modal', {
  icon: {
    src: icons.primary
  },
  edit({ attributes, setAttributes }) {
    const { showRegister } = attributes;
    const blockProps = useBlockProps();

    return (
      <>
        <InspectorControls>
          <PanelBody title={ __('General', 'udemy-plus') }>
            <ToggleControl
              label={__('Show Register', 'udemy-plus')}
              checked={showRegister}
              onChange={showRegister => setAttributes({ showRegister })}
              help={
                showRegister ?
                __('Showing Registration Form', 'udemy-plus') :
                __('Hiding Registration Form', 'udemy-plus')
                }
            />
          </PanelBody>
        </InspectorControls>
        <div { ...blockProps }>
          {__('This block is not previewable from the editor. View your site for a live demo.', 'udemy-plus')}
        </div>
      </>
    );
  }
});

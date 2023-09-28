import { registerBlockType } from '@wordpress/blocks';
import { RichText, useBlockProps, InspectorControls } from '@wordpress/block-editor';
import { __ } from '@wordpress/i18n';
import { PanelBody, ColorPalette } from '@wordpress/components';
import block from './block.json';
import icons from '../../icons';
import './main.css';

/**
 * Registers a custom Gutenberg block named 'fancy-header'.
 *
 * This block allows users to input header text and choose an underline color
 * for the header. The block uses the provided color palette for the underline color.
 * It utilizes the Gutenberg `InspectorControls`, `PanelBody`, `ColorPalette`,
 * and `RichText` components for the edit interface.
 *
 * @since 1.0.0 The version where this block was introduced.
 *
 * @param {Object} block.name - The name of the block.
 * @param {Object} icons.primary - Icon for the block.
 *
 * @property {Function} edit - The edit function defines the block's edit interface.
 * @property {Object} attributes - Represents block's attributes such as content and underline_color.
 * @property {Function} setAttributes - Function to set the block's attributes.
 *
 * @property {Function} save - Defines how the block's attributes should be saved in post_content.
 *
 * @return {JSX.Element} Returns a rendered block for the editor and for the front-end.
 */
registerBlockType(block.name, {
  icon: icons.primary,
  edit({ attributes, setAttributes }) {
    const { content, underline_color } = attributes;
    const blockProps = useBlockProps();

    return (
      <>
      <InspectorControls>
        <PanelBody title={__('Colors', 'udemy-plus')}>
          <p>{__('Select a color for your header text', 'udemy-plus')}</p>
          <ColorPalette
          colors={[
            {name: 'Red', color: '#f87171'},
            {name: 'Orange', color: '#fbbf24'},
            {name: 'Yellow', color: '#faf089'},
          ]}
            value={underline_color}
            onChange={newVal => setAttributes({ underline_color: newVal })}
          />
        </PanelBody>
      </InspectorControls>
      <div {...blockProps}>
        <RichText
          tagName="h2"
          className="fancy-header"
          placeholder={__('Enter your header text here', 'udemy-plus')}
          value={content}
          onChange={newVal => setAttributes({ content: newVal })}
          allowFormats={['core/bold', 'core/italic']}
        />
      </div>
      </>
      );
  },
  save({ attributes }) {
    const { content, underline_color } = attributes;
    const blockProps = useBlockProps.save({
      className: `fancy-header`,
      style: {
        'background-image': `
          linear-gradient(transparent, transparent),
          linear-gradient(${underline_color}, ${underline_color});
          `
      }
    });

    return <RichText.Content
      {...blockProps}
      tagName="h2"
      value={content}
    />;
  }
});

import { registerBlockType } from '@wordpress/blocks';
import {RichText, InspectorControls, useBlockProps } from '@wordpress/block-editor';
import {PanelBody, ToggleControl} from '@wordpress/components';
import {__} from '@wordpress/i18n'
import block from './block.json';
import icons from '../../icons';
import './main.css'

/**
 * Registers a custom Gutenberg block for Udemy Plus page headers.
 *
 * This block provides controls for either displaying a category automatically
 * (formatted as "Category: Some Category") or allowing users to input custom
 * header content. Users can toggle between these options using a `ToggleControl`
 * in the block inspector.
 *
 * @typedef {Object} Attributes
 * @property {string} content - The custom content for the header, if `showCategory` is false.
 * @property {boolean} showCategory - Flag indicating if the block should display the category automatically.
 *
 * @function edit - The edit function describes the block's structure in the context of the editor.
 * @param {Attributes} attributes - The block attributes used within the edit function.
 * @param {function} setAttributes - A function to update block attributes.
 *
 * @returns {WPElement} Element that represents the block's UI as it appears in the editor.
 */
registerBlockType(block.name, {
  icon: icons.primary,
  edit({ attributes, setAttributes }) {
    const { content, showCategory } = attributes;
    const blockProps = useBlockProps();

    return (
      <>
        <InspectorControls>
          <PanelBody title={__('General', 'udemy-plus')}>
            <p>
            { showCategory ?
              __('The category will be automatically handled by wordpress un the format of Category: Some Category.', 'udemy-plus')
            :
              __('You can enter text for the page heading', 'udemy-plus')
            }
            </p>
            <ToggleControl
              label={__('Show Category', 'udemy-plus')}
              checked={showCategory}
              onChange={showCategory => setAttributes({ showCategory })}
              help={__('If show category is activated the category will be automatically handled by wordpress. If it is not you can enter text for the page heading ', 'udemy-plus')}
            />
          </PanelBody>
        </InspectorControls>
        <div { ...blockProps }>
            <div className="inner-page-header">
              { showCategory ?
              <h1>{__('Category: Some Category', 'udemy-plus')}</h1> :
                  <RichText
                    tagName="h1"
                    className="up-page-header"
                    placeholder={__('Heading', 'udemy-plus')}
                    value={content}
                    onChange={content => setAttributes({ content })}
                    allowFormats={['core/bold', 'core/italic']}
                  />
              }
            </div>
          </div>
      </>
    );
  }
  });


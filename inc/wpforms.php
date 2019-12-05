<?php
/**
 * WPForms
 *
 * @package      rko
 * @author       Yuriy Lysyuk
 * @since        1.0.3
**/

/**
 * WPForms submit button, match Gutenberg button block
 * @see https://www.billerickson.net/code/wpforms-submit-button-match-gutenberg-block/
 */
function be_wpforms_match_button_block( $form_data ) {
	$form_data['settings']['submit_class'] .= ' wp-block-button__link';
	return $form_data;
}
add_filter( 'wpforms_frontend_form_data', 'be_wpforms_match_button_block' );

/**
 * Modify the required field indicator
 *
 * @link https://wpforms.com/developers/how-to-change-required-field-indicator/
 *
 */
function wpf_dev_required_indicator( $text ) {
    return ' <span class="wpforms-required-label">* Обязательно</span>';
}
add_filter( 'wpforms_get_field_required_label', 'wpf_dev_required_indicator' );
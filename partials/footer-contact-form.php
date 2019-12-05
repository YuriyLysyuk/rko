<?php
/**
 * Footer contact form partial
 *
 * @package      rko
 * @author       Yuriy Lysyuk
 * @since        1.1.0
**/

$footer_form_id = get_field( 'footer_form_id');
?>

<div class="footer-contact">
	<?php if ( !is_page_template('templates/contact.php') ) { ?>
		<svg class="footer-contact-angle" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" preserveAspectRatio="none"><polygon fill="#12879C" points="0,0 100,100 0,100"></polygon></svg>
	<?php } ?>

	<div class="wrap">
		<?php wpforms_display($footer_form_id, true, true); ?>
	</div>
</div>
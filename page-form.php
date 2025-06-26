<?php
/**
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package test
 */

get_header();
?>

	<main id="primary" class="site-main">
        <div id="form" class="form-container">
            <h1 class="form-title">お問い合わせ</h1>
        <!-- お問い合わせフォーム -->
        <?php echo do_shortcode('[contact-form-7 id="484" title="contact-form"]'); ?>
    </div>
	</main><!-- #main -->

<?php
get_sidebar();
get_footer();

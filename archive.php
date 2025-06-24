<?php
/**
 * アーカイブページを表示するためのテンプレート
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package test
 */

get_header();
?>

	<main id="primary" class="site-main">

		<?php if ( have_posts() ) : ?>

			<header class="page-header">
				<?php
				the_archive_title( '<h1 class="page-title">', '</h1>' );
				the_archive_description( '<div class="archive-description">', '</div>' );
				?>
			</header><!-- .page-header -->

			<?php
			/* 投稿ループの開始 */
			while ( have_posts() ) :
				the_post();

				/*
				 * 投稿タイプ固有のコンテンツテンプレートを読み込み
				 * 子テーマでこれを上書きしたい場合は、content-___.phpという名前のファイル
				 * （___は投稿タイプ名）を作成すると、そちらが使用されます
				 */
				get_template_part( 'template-parts/content', get_post_type() );

			endwhile;

			the_posts_navigation();

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif;
		?>

	</main><!-- #main -->

<?php
get_sidebar();
get_footer();

<?php
/**
 * メインテンプレートファイル
 *
 * これはWordPressテーマで最も汎用的なテンプレートファイルです。
 * テーマに必要な2つのファイルのうちの1つです（もう1つはstyle.css）。
 * より具体的なテンプレートがクエリに一致しない場合に使用されます。
 * 例：home.phpファイルが存在しない場合のホームページの表示に使用されます。
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package test
 */

get_header();
?>

	<main id="primary" class="site-main">

		<?php
		if ( have_posts() ) :

			if ( is_home() && ! is_front_page() ) :
				?>
				<header>
					<h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
				</header>
				<?php
			endif;

			/* 投稿ループの開始 */
			while ( have_posts() ) :
				the_post();

				/*
				 * 投稿タイプ固有のコンテンツテンプレートを読み込みます。
				 * 子テーマでこれを上書きしたい場合は、content-___.phpという名前のファイル
				 * （___は投稿タイプ名）を作成すると、そちらが代わりに使用されます。
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

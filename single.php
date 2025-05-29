<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package test
 */

get_header();
?>

<!-- 記事の詳細ページ。記事のタイトル、本文、コメントなどを表示。 -->
 <!-- ここではtemplate-parts/contentから記事を読み込むための準備をしている -->
	<main id="primary" class="site-main">

		<?php
		// 記事がある間、繰り返し表示する
		while ( have_posts() ) :
			the_post();

			// 記事の内容を表示する（template-parts/content.phpというファイルから読み込む）
			get_template_part( 'template-parts/content', get_post_type() );

			// 前の記事と次の記事へのリンクを表示する
			the_post_navigation(
				array(
					'prev_text' => '<span class="nav-subtitle">' . esc_html__( '前の記事:', 'test' ) . '</span> <span class="nav-title">%title</span>',
					'next_text' => '<span class="nav-subtitle">' . esc_html__( '次の記事:', 'test' ) . '</span> <span class="nav-title">%title</span>',
				)
			);

			// コメントが許可されている、またはコメントが1つ以上ある場合、コメント欄を表示する
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

		endwhile; // 記事の表示が終わった
		?>

	</main><!-- #main -->

<?php
get_sidebar();
get_footer();

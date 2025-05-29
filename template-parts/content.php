<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package test
 */

?>

<!-- 記事の内容を表示する -->
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<!-- 記事のタイトルと日付を表示する部分 -->
	<header class="entry-header">
		<?php
		// 記事のタイトルを表示
		// 単一の記事ページでは大きい見出しh1、一覧ページではh2で表示
		if ( is_singular() ) :
			the_title( '<h1 class="entry-title">', '</h1>' );
		else :
			the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
		endif;

		// 記事の種類が「投稿」の場合、投稿日と投稿者を表示
		if ( 'post' === get_post_type() ) :
			?>
			<!-- 投稿日と投稿者を表示するための関数を呼び出している -->
			<div class="entry-meta">
				<?php
				test_posted_on();  // 投稿日を表示
				test_posted_by();  // 投稿者を表示
				?>
			</div><!-- .entry-meta -->
		<?php endif; ?>
	</header><!-- .entry-header -->

	<?php test_post_thumbnail(); // 記事のサムネイル画像を表示 ?>

	<!-- 記事の本文を表示する部分 -->
	<div class="entry-content">
		<?php
		// 記事の本文を表示
		the_content(
			sprintf(
				wp_kses(
					//  %s の部分には記事のタイトルが入る
					// このテキストは画面読み上げソフトでしか見えない部分
					// 記事を読み続けるためのリンクテキストとして使われる
					__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'test' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				wp_kses_post( get_the_title() )
			)
		);

		// 記事が複数ページに分かれている場合、ページ番号のリンクを表示
		wp_link_pages(
			array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'test' ),
				'after'  => '</div>',
			)
		);
		?>
	</div><!-- .entry-content -->

	<!-- 記事の最後の部分（カテゴリーやタグなどを表示） -->
	<footer class="entry-footer">
		<!-- 記事の最後の部分（カテゴリーやタグなどを表示） -->
		<?php test_entry_footer(); ?>
	</footer><!-- .entry-footer -->
	<!-- 記事のIDを表示 -->
</article><!-- #post-<?php the_ID(); ?> -->

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
		if ( is_home() && ! is_front_page() ) :
			?>
			<header>
				<h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
			</header>
			<?php
		endif;
		?>

		<div class="posts-container">
			<?php
			// 最初に3件だけ表示
			$args = array(
				'post_type' => 'post',
				'posts_per_page' => 3,
				'paged' => 1,
			);
			$the_query = new WP_Query($args);
			if ($the_query->have_posts()):
				while ($the_query->have_posts()): $the_query->the_post();
					get_template_part('template-parts/content', get_post_format());
				endwhile;
			endif;
			wp_reset_postdata();
			?>
		</div>

		<div class="load-more-container">
			<button id="load-more" class="load-more-button">もっと見る</button>
		</div>

	</main><!-- #main -->

<?php
get_sidebar();
get_footer();

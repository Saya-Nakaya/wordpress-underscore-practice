<?php
/**
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package test
 */

get_header();
?>

	<main id="primary" class="site-main">
        <div class="profile-container">
            <h1 class="page-title"><?php the_title(); ?></h1>

            <!-- 
                ************************
                ** ページのメインコンテンツ **
                ************************
            -->
			<div class="page-content">
                <div class="image-item">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/gemini-beer.jpeg" alt="サンプル画像">
                </div>

                <!-- 
                    ********************
                    ** 基本情報セクション **
                    ********************
                -->
                <div class="text-item">
                    <div class="profile-basic-info">
                        <div class="sample-name">
                            <h2>名前　なまえ</h2>
                        </div>
                        <div class="sample-name">
                            <h2>居住地　きょうじゅうち</h2>
                        </div>
                    </div>

                    <!-- 詳細情報セクション  -->
                    <div class="profile-details">
                        <div class="sample-name">
                            <h2>好きなこと</h2>
                            <p>毎年ビールフェスに参加すること</p>
                        </div>
                        
                        <div class="sample-name">
                            <h2>将来の夢</h2>
                            <p>お酒のイベントを巡って全国各地に旅行<br />
                            全国各地から面白いお酒を集めて飲めるお店を作りたい</p>
                        </div>
                    </div>

                    <!-- 
                        ********************
                        ** SNSリンクセクション **
                        ********************
                    -->
                    <div class="social-links">
                        <h2>SNS</h2>
                        <div class="social-icons">
                            <a href="<?php echo esc_url('https://twitter.com/'); ?>" target="_blank" rel="noopener noreferrer" class="social-link"><?php esc_html_e('Twitter', 'test'); ?></a>
                            <a href="<?php echo esc_url('https://instagram.com/'); ?>" target="_blank" rel="noopener noreferrer" class="social-link"><?php esc_html_e('Instagram', 'test'); ?></a>
                            <a href="<?php echo esc_url('https://github.com/'); ?>" target="_blank" rel="noopener noreferrer" class="social-link"><?php esc_html_e('GitHub', 'test'); ?></a>
                        </div>
                    </div>
                </div>
			</div>
        </div>
	</main>

<?php
get_sidebar();
get_footer();

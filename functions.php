<?php
/**
 * test functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package test
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function test_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on test, use a find and replace
		* to change 'test' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'test', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
	add_theme_support( 'title-tag' );

	/*
		* Enable support for Post Thumbnails on posts and pages.
		*
		* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		*/
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'menu-1' => esc_html__( 'Primary', 'test' ),
		)
	);

	/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'test_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);
}
add_action( 'after_setup_theme', 'test_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function test_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'test_content_width', 640 );
}
add_action( 'after_setup_theme', 'test_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function test_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'test' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'test' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'test_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function test_scripts() {
	wp_enqueue_style( 'test-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_style_add_data( 'test-style', 'rtl', 'replace' );

	wp_enqueue_script( 'test-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'test_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

// cssの読み込み
function my_enqueue_files() {
	wp_enqueue_style('destyle', get_template_directory_uri() . '/styles/destyle.css');
	wp_enqueue_style('style', get_template_directory_uri() . '/styles/style.css');
	wp_enqueue_script('scroll-to-top', get_template_directory_uri() . '/js/scroll-to-top.js', array(), _S_VERSION, true);
}
add_action('wp_enqueue_scripts', 'my_enqueue_files');

/*
###############
## ここから追加 ##
###############
*/

// コメントフォームのフィールドをカスタマイズ
function my_remove_comment_logged_in_text($args) {
    $args['logged_in_as'] = '';
    return $args;
}
add_filter('comment_form_defaults', 'my_remove_comment_logged_in_text');

function my_customize_comment_form_texts($args) {
    $args['title_reply'] = 'コメントを残す'; // フォームのタイトル
    $args['comment_field'] = '<p class="comment-form-comment"><textarea id="comment" name="comment" cols="45" rows="8" maxlength="65525" required="required"></textarea></p>';
    return $args;
}
add_filter('comment_form_defaults', 'my_customize_comment_form_texts');

/**
 * 投稿内容の文字数制限関数
 * ホーム画面と検索画面で100文字に制限
 */
function limit_post_content($content, $limit = 100) {
    // HTMLタグを除去してプレーンテキストに変換
    $plain_text = wp_strip_all_tags($content);
    
    // 文字数を制限
    if (mb_strlen($plain_text) > $limit) {
        $limited_text = mb_substr($plain_text, 0, $limit);
        return $limited_text . '...';
    }
    
    return $plain_text;
}

/**
 * ホーム画面と検索画面でのみ文字数制限を適用
 */
function custom_the_content($content) {
    // 単一投稿ページでは全文表示
    if (is_single()) {
        return $content;
    }
    
    // ホーム画面または検索画面の場合、文字数制限を適用
    if (is_home() || is_search() || is_page('articles')) {
        return limit_post_content($content, 100);
    }
    
    return $content;
}
add_filter('the_content', 'custom_the_content');

// コメントの日時表示をカスタマイズ
function custom_comment_date_format($comment_date, $comment) {
    return get_comment_time('Y/m/d H:i', false, true);
}
add_filter('get_comment_date', 'custom_comment_date_format', 10, 2);

// 日時表示の統一設定
function custom_date_format($date_format) {
    return 'Y/m/d H:i';
}
add_filter('date_format', 'custom_date_format');

// 投稿日時の表示形式を統一
function custom_post_date_format($date) {
    return esc_html(get_the_date('Y/m/d H:i'));
}

// 更新日時の表示形式を統一
function custom_modified_date_format($date) {
    return esc_html(get_the_modified_date('Y/m/d H:i'));
}

// コメントリストのカスタムコールバック関数
function my_simple_comment_callback($comment, $args, $depth) {
    ?>
    <li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
        <div class="comment-body">
            <div class="comment-meta">
                <span class="comment-author"><?php echo esc_html(get_comment_author()); ?></span>
                <span class="comment-date"><?php echo get_comment_time('Y/m/d H:i'); ?></span>
            </div>
            <div class="comment-content"><?php comment_text(); ?></div>
        </div>
    </li>
    <?php
}

<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package test
 */

get_header();
?>

	<main id="primary" class="site-main">
        <h1><?php the_title(); ?></h1>

        <!-- 
            ###############
            ## 検索フォーム ##
            ###############
        -->
        <div class="search-form-container">
            <!-- 
                検索フォームの設定
                - action: 検索した結果をどこに送るか（ウェブサイトのトップページに送る）
                - method: 検索する言葉をどのように送るか（GETで送る）
                - post_type: どんな種類の記事を探すか（ブログの記事だけを探す）
                - input type="search"：ユーザーが探したい言葉を入力するためのフィールド
                - input type="hidden"：見えない設定で、「記事だけを探す」という指示を送る
                - button type="submit"：検索ボタンを押すと、検索結果が表示される
            -->
            <form role="search" method="get" class="search-form" action="<?php echo esc_url(home_url('/')); ?>">
                <input type="search" class="search-field" placeholder="記事を検索..." value="<?php echo get_search_query(); ?>" name="s" />
                <input type="hidden" name="post_type" value="post" />
                <button type="submit" class="search-submit">検索</button>
            </form>
        </div>

        <!-- 
            #####################
            ## 記事一覧（検索結果） ##
            #####################
        -->
        <div class="articles-container">
            <?php
            // ウェブサイトで記事をたくさん表示するときに、どのページの記事を表示すればいいのかを決めるために必要な情報を取得
            $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

            // WP_Queryの引数を設定
            $args = array(
                'post_type' => 'post',        // 投稿タイプを'post（投稿）'に設定
                'posts_per_page' => 10,       // 1ページあたりの表示件数を10件に設定
                'paged' => $paged,            // 現在のページ番号を取得
                'orderby' => 'date',          // 日付によって並び替え
                'order' => 'DESC'             // 降順（新しい順）で表示
            );

            // クエリを実行
            $query = new WP_Query($args);

            // 記事がある場合の処理
            if ($query->have_posts()) :
                // 記事のループ開始
                while ($query->have_posts()) : $query->the_post();
            ?>
                <!-- 1つの記事を表示する部分 -->
                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                    <!-- 記事の最初の部分（タイトルと日付を表示） -->
                    <header class="entry-header">
                        <!-- 記事のタイトル（クリックすると記事のページに移動する） -->
                        <h2 class="entry-title">
                            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                        </h2>
                        <!-- 記事を書いた日付を表示 -->
                        <div class="entry-meta">
                            <span class="posted-on">
                                <?php echo get_the_date(); ?>
                            </span>
                        </div>
                    </header>

                    <!-- 記事本文（抜粋） -->
                    <div class="entry-content">
                        <?php the_excerpt(); ?>
                    </div>
                </article>
            <?php
                endwhile;
                ?>
                
                <!-- 
                    ##################################
                    ## 記事を複数のページに分けて表示する ##
                    ##################################
                -->
                <div class="pagination">
                    <?php
                    paginate_links(array(
                        'total' => $query->max_num_pages,    // 全ページ数
                        'current' => $paged,                 // 現在のページ
                        'prev_text' => '前へ',              // 前のページのテキスト
                        'next_text' => '次へ'               // 次のページのテキスト
                    ));
                    ?>
                </div>

                <?php
                // クエリをリセット
                wp_reset_postdata();
            else :
                // 記事が見つからない場合のメッセージ
                echo '<p>記事が見つかりませんでした。</p>';
            endif;
            ?>
        </div>
	</main><!-- #main -->

<?php
get_footer();

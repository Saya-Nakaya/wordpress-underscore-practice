let currentPage = 1; // 1回に何個の記事を表示するか（3個ずつ）
const postsPerPage = 3; // 1回に何個の記事を表示するか（3個ずつ）
const loadMoreBtn = document.getElementById('load-more'); // 「もっと見る」ボタンを見つける
const postsContainer = document.querySelector('.posts-container'); // 記事を並べる場所を見つける

// ボタンと記事を並べる場所が両方ある場合だけ動く
if (loadMoreBtn && postsContainer) {
    // 「もっと見る」ボタンを押した時の処理
    loadMoreBtn.addEventListener('click', function() {
        currentPage++;

        // サーバーに送る情報を準備
        const data = new FormData();
        data.append('action', 'load_more_posts'); // 何をするか（記事をもっと読み込む）
        data.append('page', currentPage); // 何ページ目か
        data.append('posts_per_page', postsPerPage); // 何個の記事が欲しいか

        // Ajax通信でサーバーに「もっと記事をください」とお願いする
        fetch('/wp-admin/admin-ajax.php', {
        method: 'POST',
        body: data,
        })
        .then(response => response.text()) // サーバーからの返事を文字にする
        .then(html => {
        if (html.trim() === 'end') {
            loadMoreBtn.style.display = 'none'; // もう記事がない場合、ボタンを隠す
        } else {
            postsContainer.insertAdjacentHTML('beforeend', html); // 新しい記事を画面に追加する
        }
        })
        .catch(error => {
        console.error('Error:', error); // エラーが起きた場合、コンソールにエラーを表示
        });
    });
}

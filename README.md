//Laravel MVC 準拠構成のネイティブアプリ
//ディレクトリ構成

phpFullScratch
app
Http
Controllers 　
PostsController.php
Post.php <-モデル

    resources
        views　
            layouts
                meta.php
                header.php
                footer.php
            posts
                index.php
                edit.php
                create.php

    routes　<-ルーター
        .htaccess
        web.php

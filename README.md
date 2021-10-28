//Laravel MVC 準拠構成のネイティブアプリ

//ローカル開発環境
Vagrant
VirtualBox
Linux
Apache
PHP
192.168.33.10

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

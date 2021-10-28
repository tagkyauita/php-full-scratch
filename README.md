//Laravel MVC 準拠構成のネイティブアプリ

//ローカル開発環境
Vagrant/2.2.16
VirtualBox/6.1.26
Linux CentOS/6.8
Apache/2.2.15
PHP/5.5.3
MySQL/14.14 Distrib 5.6.51
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

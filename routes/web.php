<?php
//★routing setting

//変数にURLを格納する
$url_text = $_GET['url'];
//URLの区切りが"/"であることを明示, 第2引数は何を分割するのかを指定
//★ "url_text" を "/" で分割します の意となる
$params = explode("/", $url_text);         //※paramsには配列が入る(例:create/1なら[0]はcreate, [1]は"/"以降あり)

// var_dump($params."<br>");
// var_dump($params[0]."<br>");
// var_dump($params[1]."<br>");

//Apacheで設定したDocumentRootを変数に格納
$webroot = $_SERVER['DOCUMENT_ROOT'];    
//modelのパスを定義
$models = $webroot."/../app/";
//viewのパスを定義
$views = $webroot."/../resources/views/";

//PostsControllerを呼び出す
include($webroot."/../app/Http/Controllers/PostsController.php");       //DocumentRootから見た相対パスで指定

//★URLによって呼び出すページを変える
//まずインスタンス化(modelとviewのパスも同時に渡す)
$postsController = new PostsController($models, $views);

//switch文でPostControllerのメソッドを分岐処理
switch($params[0]){
    case "":
        $postsController->index();
        break;
    case "create":
        $postsController->create();
        break;
    case "store":
        $postsController->store();
        break;       
    case "show":
        //※paramsには配列が入る(例:create/1なら[0]はcreate, [1]は"/"以降あり)
        $postsController->show($params[1]);     
        break;
    case "edit":
        $postsController->edit($params[1]);
        break;
    case "update":
        $postsController->update($params[1]);
        break;        
    case "destroy":
        $postsController->destroy($params[1]);
        break;      
}

?>
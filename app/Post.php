<?php

class Post{
    private $DB_HOST = "192.168.33.10";
    private $DB_NAME = "php_hacks";
    private $DB_USER = "root";
    private $DB_PASSWORD = "kanamerinsuketasuku";

    protected function db_accsess()
    {
        //PHPがエラーを表示するように設定
        error_reporting(E_ALL & ~E_NOTICE);

        //データベースに接続し情報を取得する構文(try catchで行う)
        //データベースへの接続(PHP dbh PDO で検索すると公式の雛形がヒットするのでそれを拝借)
        //https://www.php.net/manual/ja/pdo.connections.php
        //host, dbname, $user, $pass を本クラスで宣言したものに変更する
        try {
            $dbh = new PDO('mysql:host=' . $this->DB_HOST . ';dbname=' . $this->DB_NAME . '', $this->DB_USER, $this->DB_PASSWORD);

            //以下foreachは拝借したが今回不要なのでコメントアウト
            // foreach($dbh->query('SELECT * from FOO') as $row) {
            //     print_r($row);
            // }
            // $dbh = null;

            //データベースから取得した情報を返す構文
            return $dbh;

            //エラー検出時、エラー内容を表示する構文(今回はブラウザに表示させたいのでprint を echo に変更)
        } catch (PDOException $e) {
            echo "エラー!: " . $e->getMessage() . "<br/>";
            die();
        }
    }

    protected function validation($data_title, $data_body){
        $error = array();

        if (empty($data_title) || ctype_space($data_title)){
            $error[] = "タイトルを入力してください";
        } 
        if (empty($data_body) || ctype_space($data_body)){
            $error[] = "本文を入力してください";
        }
        if (strlen($data_body) > 140){
            $error[] = "140字以下にしてください";
        } 

        return $error;
    }

    //取得データを表示するメソッド
    public function index()
    {
        //データベースにアクセス、格納
        $dbh = $this->db_accsess();
        //postsテーブルの全データを取得、格納
        $sql = "SELECT * FROM posts";
        //?
        $stmt = $dbh->prepare($sql);
        //?
        $stmt->execute();
        //?
        $result = $stmt->fetchALL(PDO::FETCH_ASSOC);

        return $result;
    }

    public function store()
    {
        $post = array(
            "title" => $_POST['title'],
            "body" => $_POST['body'],
        );

        $error = $this->validation($post['title'],$post['body']);

        if (count($error)){
            //createにエラーログを飛ばす（何もしない）

        } else { //エラーがなければ下記を実行
            //データベースにアクセス
            $dbh = $this->db_accsess();
            //トランザクション処理を記述
            try {
                $dbh->beginTransaction();   //トランザクションここから
                $sql = "INSERT INTO  posts(title, body) VALUES(:title, :body)";   //VALUES=実際に入れる値ではない=仮に置いておく=プレースホルダ
                $stmt = $dbh->prepare($sql);
                //ここでプレースホルダに実際の値を入れる(型宣言が必要)
                $stmt->bindValue(':title', $post['title'], PDO::PARAM_STR);
                $stmt->bindValue(':body', $post['body'], PDO::PARAM_STR);
                $stmt->execute();

                $dbh->commit();    //トランザクションここまで
            } catch (PDOException $Exception) {    //PDO~ はエラー時に実行処理
                $stmt->rollback();    //失敗した場合こちら
            }
        }

        $result = array($post, $error);

        return $result;
    }

    public function show($article_id)
    {
        //データベースにアクセス、格納
        $dbh = $this->db_accsess();
        //postsテーブル内の$article_idに合致するレコードを取得、格納
        $sql = "SELECT * FROM posts WHERE id = :id";   //プレースホルダ
        $stmt = $dbh->prepare($sql);
        $stmt->bindValue(':id', $article_id, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetchALL(PDO::FETCH_ASSOC);

        return $result;
    }

    public function edit($article_id)
    {
        //データベースにアクセス、格納
        $dbh = $this->db_accsess();
        //postsテーブル内の$article_idに合致するレコードを取得、格納
        $sql = "SELECT * FROM posts WHERE id = :id";   //プレースホルダ
        $stmt = $dbh->prepare($sql);
        $stmt->bindValue(':id', $article_id, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetchALL(PDO::FETCH_ASSOC);

        return $result;
    }

    public function update($article_id)
    {
        $post = array(
            "title" => $_POST['title'],
            "body" => $_POST['body'],
        );

        $error = $this->validation($post['title'],$post['body']);

        if (count($error)){
            //editにエラーログを飛ばす（何もしない）

        } else { //エラーがなければ下記を実行
            //データベースにアクセス
            $dbh = $this->db_accsess();
            //トランザクション処理を記述
            try {
                $dbh->beginTransaction();   //トランザクションここから
                $sql = 'UPDATE posts SET title= :title, body= :body WHERE id= :id';   //プレースホルダ
                $stmt = $dbh->prepare($sql);
                //ここでプレースホルダに実際の値を入れる(型宣言が必要)
                $stmt->bindValue(':title', $post['title'], PDO::PARAM_STR);
                $stmt->bindValue(':body', $post['body'], PDO::PARAM_STR);
                $stmt->bindValue(':id', $article_id, PDO::PARAM_INT);
                $stmt->execute();

                $dbh->commit();    //トランザクションここまで
            } catch (PDOException $Exception) {    //PDO~ はエラー時に実行処理
                $stmt->rollback();    //失敗した場合こちら
            }
        }

        $result = array($post, $error);

        return $result;
    }

    public function destroy($article_id)
    {
        //データベースにアクセス、格納
        $dbh = $this->db_accsess();
        //postsテーブル内の$article_idに合致するレコードを取得、格納
        $sql = "DELETE FROM posts WHERE id = :id";   //プレースホルダ
        $stmt = $dbh->prepare($sql); //sqlを準備
        $stmt->bindValue(':id', $article_id, PDO::PARAM_INT); //bindValueでプレースホルダに値をセット
        $stmt->execute(); //実行
        // $result = $stmt->fetchALL(PDO::FETCH_ASSOC); <=実行したら返す値は無いので不要

        return "DELETED"; //返す値の代わりに文字列を返しておきまーす
    }

}

<?php

/**
* ひとこと掲示板
* @author nixnoughtnothing
*/
require_once($_SERVER['DOCUMENT_ROOT'].'/oneline_bbs/define.php');


    //------------データベース接続--------------//


        try{
            $pdo = new PDO(DSN,CONNECT_USER,CONNECT_PASS);
        }catch(PDOException $e){
            // 接続失敗
        var_dump($e->getMessage());
        exit;
    }

    // エラーメッセージを入れる配列
    $errors = array();




//-------------------------------インサート処理--------------------------------//


    // POSTなら保存処理実行
    if($_SERVER['REQUEST_METHOD'] === 'POST'){

        // 名前が正しく入力されているかチェック
        $name = null;
        if(!isset($_POST['name']) || !strlen($_POST['name'])){

            $errors["name"] = '名前を入力してください';

        }else if(strlen($_POST['name'])>40){

            $errors['name'] = '名前は40文字以内で入力してください';

        }else{

            $name = $_POST['name'];
            echo $name;
        }


        // ひとことが正しく入力されているかチェック
        $comment = null;
        if(!isset($_POST['comment']) || !strlen($_POST['comment'])){

            $errors["comment"] = 'ひとことを入力してください';

        }else if(strlen($_POST['comment'])>200){

            $errors['comment'] = 'ひとことは200文字以内で入力してください';

        }else{

            $comment = $_POST['comment'];
        }


        // エラーがなければ保存
        if(count($errors) === 0){
            // 保存するためのSQL文を発行

            $stmt = $pdo->prepare('INSERT INTO `post`(`name`,`comment`,`created_at`)VALUES(?,?,?)');

            $stmt->bindParam(1,$name,                             PDO::PARAM_STR);
            $stmt->bindParam(2,$comment,                          PDO::PARAM_STR);
            $stmt->bindParam(3,$created_at = date('Y-m-d H:i:s'), PDO::PARAM_STR);
            $stmt->execute();
            $stmt=null;

            // 目的：更新時の二重で書き込みを防ぐ
            header('Location:./bbs.php');
        }
    }


            // 投稿内容の取得
            $stmt = $pdo->prepare("SELECT `name`,`comment`,`created_at` from `post` ORDER BY `created_at` DESC");
            $stmt->execute();
            $bbs_records = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $stmt=null;


require_once($_SERVER['DOCUMENT_ROOT'].'/oneline_bbs/views/bbs_view.php');
?>

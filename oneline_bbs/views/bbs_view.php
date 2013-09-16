
<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
    <title>ひとこと掲示板</title>
</head>
<body>
    <h1>ひとこと掲示板</h1>
    <table>
    <form aciton="bbs.php" method="POST">
        <tr>
            <td>名前:</td>
            <td><input type=text name="name"><br></td>
        </tr>
        <tr>
            <td>ひとこと:</td>
            <td><input type=text name="comment" size="60"><br></td>
        </tr>
        <tr>
            <td><input type="submit" name="submit" value="送信"></td>
        </tr>
        <tr>
            <th>名前</th><th>コメント</th><th>投稿時間</th>
        </tr>
        <?php foreach($bbs_records as $bbs_record){ ?>
        <tr>
            <td><?php echo $bbs_record['name'] ?></td>
            <td><?php echo $bbs_record['comment'] ?></td>
            <td><?php echo $bbs_record['created_at'] ?></td>
        </tr>
        <?php } ?>
    </form>
    </table>

</body>
</html>
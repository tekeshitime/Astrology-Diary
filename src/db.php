<?php
//データベースに接続
function dbConnect()
{
    define('DSN', 'mysql:host=172.21.0.2;dbname=astro_diary');
    define('DB_USER', 'root');
    define('DB_PASS', 'password');
    try {
        $dbh = new PDO(DSN, DB_USER, DB_PASS, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ]);
    } catch (PDOException $e) {
        echo "エラーメッセージ : " . $e->getMessage();
    }
    return $dbh;
}

//ログインしているユーザー情報を取得
function getLoggedinUser()
{
    try {
        $dbh = dbConnect();
        $sql = "SELECT * FROM userdeta WHERE id = :id";
        $stmt = $dbh->prepare($sql);
        $stmt->bindParam(':id', $_SESSION['id'], PDO::PARAM_INT);
        $stmt->execute();
        $record = $stmt->fetch(PDO::FETCH_ASSOC);
        return $record;
    } catch (PDOException $e) {
        echo "エラーメッセージ : " . $e->getMessage();
    }
}

//ログインしているユーザー情報を編集
function editLoggedInUser()
{
    try {
        $dbh = dbConnect();
        $sql = "UPDATE
                    `userdeta`
                SET
                    `email` = :email,
                    `username` = :username,
                    `birth_y` = :birth_y,
                    `birth_m` = :birth_m,
                    `birth_d` = :birth_d,
                    `birth_hour` = :birth_hour,
                    `birth_min` = :birth_min,
                    `place` = :place
                WHERE
                    id = :id";
        $stmt = $dbh->prepare($sql);
        $stmt->bindParam(':id', $_SESSION['id'], PDO::PARAM_STR);
        $stmt->bindParam(':email', $_POST['email'], PDO::PARAM_STR);
        $stmt->bindParam(':username', $_POST['username'], PDO::PARAM_STR);
        $stmt->bindParam(':birth_y', $_POST['birth_y'], PDO::PARAM_INT);
        $stmt->bindParam(':birth_m', $_POST['birth_m'], PDO::PARAM_INT);
        $stmt->bindParam(':birth_d', $_POST['birth_d'], PDO::PARAM_INT);
        $stmt->bindParam(':birth_hour', $_POST['birth_hour'], PDO::PARAM_INT);
        $stmt->bindParam(':birth_min', $_POST['birth_min'], PDO::PARAM_INT);
        $stmt->bindParam(':place', $_POST['place'], PDO::PARAM_STR);
        $stmt->execute();
        //結果報告の前に挿入
        header("Location: profile.php");
    } catch (PDOException $e) {
        echo "エラーメッセージ : " . $e->getMessage();
    }
}

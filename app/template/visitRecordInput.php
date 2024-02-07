<?php

require_once(__DIR__ . '/../app/config.php');

use PrefecturesApp\Database;
use PrefecturesApp\Todo;
use PrefecturesApp\Utils;

/**
 * PDO DBアクセス
 */
$pdo = Database::getInstance()




?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>訪問記録入力画面</title>
    <link rel="stylesheet" href="css/styles.css" >
</head>
<body>
    <main data-token="<?= Utils::h($_SESSION['token']); ?>"> 
        <!-- 訪問記録入力フォーム -->
        <header>
            <h1>訪問記録入力</h1>
        </header>
        <form action="?action=add" method="post">
            <label for="prefecture">都道府県名:</label>
            <input type="text" id="prefecture" name="name"><br>
            <label for="visitDate">訪問日:</label>
            <input type="date" id="visitDate" name="visit_date"><br>
            <label for="purpose">訪問目的:</label>
            <textarea id="purpose" name="purpose" rows="4"></textarea><br>
            <label for="stayLevel">滞在レベル:</label>
            <select id="stayLevel" name="stayLevel">
                <option value="1">レベル1【未訪問】</option>
                <option value="2">レベル2【尋ねた・通過した】</option>
                <option value="3">レベル3【旅行（宿泊無）】</option>
                <option value="4">レベル4【旅行（宿泊有）】</option>
                <option value="5">レベル5【暮らした】</option>
            </select><br>
            <button type="submit">記録</button>
        </form>
    </main>
</body>
</html>

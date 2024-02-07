<?php
declare(strict_types=1);

//今いるフォルダの親のファルダを返す . 設定ファイル.php
require_once(dirname(__DIR__) . "/library/common.php");

$errorMessage = '';
$successMessage = "";

//POST送信かつ削除ボタン押下
//同じPOSTっていう文字でも、大文字で来る場合と小文字で来る場合がある。
//小文字に変換してから比較して確実に処理するようにする。
if (isPost()) {
    //trueならば削除ボタンが押されたということ
    $isDelete = (isset($_POST['delete']) && $_POST['delete'] === '1') ? true : false;
    if ($isDelete === true) {
        //POSTされた都道府県の入力チェック
        $deletePrefecture = isset($_POST['prefecture']) ? $_POST['prefecture'] : '';
        if (!validateRequired($deletePrefecture)) { //空白でないか
            $errorMessage .= '都道府県記録が不正です。<br>';
        } else if (!validatePrefecture($deletePrefecture)) { //正しい都道府県か
            $errorMessage .= '都道府県記録が不正です。<br>';
        } else {
            //都道府県の記録があるか
            if (!Prefectures::isExists($deletePrefecture)) {
                $errorMessage .= '都道府県記録が不正です。<br>';
            }
        }

        //入力チェックOK?
        if ($errorMessage === '') {
            //トランザクション開始
            DataBase::beginTransaction();

            //都道府県記録の削除
            Prefectures::deleteById($deleteId);

            //コミット
            DataBase::commit();

            $successMessage = "削除完了しました。";
        } else {
           // エラー有り
            echo $errorMessage;
        }
    }
}

$prefecture = $_GET['prefecture'] ?? '';
$region = $_GET['region'] ?? '';
$stay_level = $_GET['stay_level'] ?? '';
$visit_date = $_GET['visit_date'] ?? '';

// 検索条件の入力チェック
// 都道府県の入力チェック
if (!validatePrefecture($prefecture)) {
    $errorMessage .= '都道府県が不正です。<br>';
}
// 地方の入力チェック
if (!validateRegion($region)) {
    $errorMessage .= '地方が不正です。<br>';
}
// 滞在レベルの入力チェック
if (!validateStayLevel($stay_level)) {
    $errorMessage .= '滞在レベルが不正です。<br>';
}
// 訪問日の入力チェック
if (!validateDate($visit_date)) {
    $errorMessage .= '訪問日が不正です。<br>';
}

//入力チェックOK?
if ($errorMessage === '') {
    // 件数取得SQLの実行
    $count = Prefectures::searchCount($prefecture, $region, $stay_level, $visit_date);
    // var_dump($count);

    // 都道府県記録取得SQLの実行
    $data = Prefectures::searchData($prefecture, $region, $stay_level, $visit_date);
// var_dump($count);
} else {
    echo $errorMessage;
}

//headerphpのtitleで受け取り
$title = "記録検索";
//templeteの読み込み
require_once(TEMPLATE_DIR . "prefectures_search.php");
?>


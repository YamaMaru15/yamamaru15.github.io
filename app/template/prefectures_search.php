<?php declare(strict_types=1); ?>
<?php require_once(TEMPLATE_DIR . "header.php"); ?>




<div class="clearfix">
<?php require_once(TEMPLATE_DIR . "menu.php"); ?>

    <div id="main">
        <h3 id="title">都道府県　記録検索画面</h3>

        <div id="search_area">
            <div id="sub_title">検索条件</div>
            <form action="search.php" method="GET">
                <div id="form_area">
                    <div class="clearfix">
                        <div class="input_area">
                            <span class="input_label">都道府県</span>
                            <select name="region">
                                <?php foreach(PREFECTURE_LISTS as $prefecture_value) { ?>
                                    <option value="<?= $prefecture_value; ?>"
                                    <?= $prefecture === $prefecture_value ? "selected" : ""; ?>
                                    <?= mb_strpos($prefecture_value, "地方") !== false ? "disabled" : ""; ?>>
                                    <?= $prefecture_value; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="input_area">
                            <span class="input_label">地方</span>
                            <select name="region">
                                <?php foreach(REGION_LISTS as $region_value) { ?>
                                    <option value="<?= $region_value; ?>"
                                    <?= $region === $region_value ? "selected" : ""; ?>>
                                    <?= $region_value; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="input_area">
                            <span class="input_label">滞在レベル</span>
                            <select name="stay_level">
                                <?php foreach(STAY_LEVEL_LISTS as $level_value) { ?>
                                    <option value="<?= $level_value; ?>"
                                    <?= $stay_level === $level_value ? "selected" : ""; ?>>
                                    <?= $level_value; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="input_area"><span class="input_label">訪問日</span>
                            <input type="date" name="visit_date" value="<?php $visit_date ?>" >
                        </div>
                    </div>
                    <div class="clearfix">
                        <div class="input_area_right"><input type="submit" id="search_button" value="検索"></div>
                    </div>
                </div>
            </form>
        </div>


    <?php //メッセージ表示 ?>
    <?php //例)都道府県が登録されていません。 ?>
    <?php if ($errorMessage !== '') { ?>
        <p class="error_message"><?= $errorMessage; ?></p>
    <?php } ?>

    <?php //例)削除完了しました。 ?>
    <?php if ($successMessage !== '') { ?>
        <p class="success_message"><?= $successMessage; ?></p>
    <?php } ?>



        <?php //件数表示 ?>
        <div id="page_area">
            <div id="page_count"><?= Utils::h($count); ?> 件の記録があります。</div>
        </div>

        <div id="search_result">
            <table>
                <thead>
                    <tr>
                        <th>都道府県名</th>
                        <th>地方</th>
                        <th>滞在レベル</th>
                        <th>訪問日</th>
                        <th>訪問目的</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php //件数が1件以上 ?>
                    <?php if ($count >= 1) { ?>
                        <?php //訪問記録取得結果を1行ずつ読込、終端まで繰り返し ?>
                        <?php foreach ($data as $row) {?>
                            <tr>
                                <?php //記録情報の表示 ?>
                                <td><?= Utils::h($row["prefecture"]); ?></td>
                                <td><?= Utils::h($row["stay_level"]); ?></td>
                                <td><?= Utils::h($row["region"]); ?></td>
                                <td><?= Utils::h($row["visit_date"]); ?></td>
                                <td><?= Utils::h($row["purpose"]); ?></td>
                                <td class="button_area">
                                    <button class="edit_button"
                                        onclick="editRecord('<?= Utils::h($row["prefecture"]); ?>');">
                                        編集
                                    </button>
                                    <button class="delete_button"
                                        onclick="deleteRecord('<?= Utils::h($row["prefecture"]); ?>;');">
                                        削除
                                    </button>
                                </td>
                            </tr>
                        <?php } ?>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<form action="input.php" name="edit_form"  method="POST">
    <input type="hidden" name="prefecture" value="" />
    <input type="hidden" name="edit" value="1" />
</form>

<form action="search.php" name="delete_form"  method="POST">
    <input type="hidden" name="prefecture" value="" />
    <input type="hidden" name="delete" value="1" />
</form>

<script>
function editRecord(prefecture) {
    //編集が押されたら都道府県をhidden項目[id]に記録番号をセットしてsubmit
    document.edit_form.prefecture.value = prefecture; 
    document.edit_form.submit();
}

    //javascriptでform内のhidden項目[prefecture]に都道府県をセットしてsubmitする
    function deleteRecord(prefecture) {
        //削除確認ダイアログ表示
        if (!window.confirm('[' + prefecture + ']の記録を削除してよろしいですか?')) {
            //キャンセルが押されたら処理終了
            return false;
        }
    //OKが押されたら記録番号をhidden項目[prefecture]にセットしてsubmit
        document.delete_form.prefecture.value = prefecture; 
        document.delete_form.submit();
    }
</script>

<?php require_once(TEMPLATE_DIR . "footer.php"); ?>


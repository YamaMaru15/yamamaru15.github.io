<?php declare(strict_types=1); ?>

<div id="menu">
        <h3>メニュー</h3>
        <!-- mb_strposでsearchがあるかを検索。あったらsearch.php -->
        <?php if (mb_strpos($_SERVER["REQUEST_URI"], "prefectures_search.php") !== false) { ?>
            <div class="sub_menu">記録検索</div>
            <div class="sub_menu"><a href="input.php">記録登録</a></div>
        <?php } else { ?>
            <div class="sub_menu"><a href="prefectures_search.php">記録検索</a></div>
            <div class="sub_menu">記録登録</div>
        <?php } ?>
</div>
<?php

// namespace PrefecturesApp;

class Utils {
    /* 安全なデータの埋め込み,インスタンスを作るようなものではないため、staticで
     クラスメソッドにして直接呼び出せるようにしておく */
    public static function h($str) {
        return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
    }
}










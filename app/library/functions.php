<?php

/**
 * POST通信かを判定する
 *
 * @param なし
 * @return bool true:POST通信／false:POST通信以外
 */
function isPost(): bool
{
    return mb_strtolower($_SERVER['REQUEST_METHOD']) === 'post';
}

/**
 * 強制リダイレクト
 *
 * @param srting $url リダイレクト先URL
 * @return なし
 */
function redirect(string $url): void
{
    header("Location: {$url}");
    exit();
}
?>
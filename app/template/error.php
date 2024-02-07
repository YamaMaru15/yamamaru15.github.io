<?php declare(strict_types=1); ?>

<?php require_once(TEMPLATE_DIR . "header.php"); ?>

<div class="clearfix">
<?php require_once(TEMPLATE_DIR . "menu.php"); ?>

<div id="main">
    <div class="error_message"><?= $errorMessage; ?></div>
</div>
</div>
<?php require_once(TEMPLATE_DIR . "footer.php"); ?>
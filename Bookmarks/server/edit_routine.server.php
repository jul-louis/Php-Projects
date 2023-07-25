<?php
session_start();
$_SESSION['is_edit'] = 1;
$_SESSION['in_edit'] = 1;

$org_bm_id = $_GET['orgbmid'];
$name = $_GET['name'];
$bookmark = $_GET['url'];
include 'delete_function.server.php';
run_delete($org_bm_id);
include 'add.server.php';
run_add($bookmark, $name);

$_SESSION['in_edit'] = 0;

header('Location: ../index.php?mode=edit&bookmark_id='.$org_bm_id);

<?php
include 'delete_function.server.php';
$bm_id = $_GET['bookmark_id'];
run_delete($bm_id);
header('Location: ../index.php?delete=success');

<?php
$bm_id = $_GET['bookmark_id'];
function run_delete($bm_id)
{
    require '../../shared/php/db_handler.server.php';
    session_start();
    $u_id = $_SESSION['id'];
    $_SESSION['ed-delete'] = 0;


    $sql_1 = "DELETE FROM user_bookmark WHERE user_id=? AND bookmark_id=?";
    $sql_2 = "UPDATE bookmarks SET bookmark_count = bookmark_count - 1 WHERE bookmark_id=?";
    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $sql_1)) {
        header("Location: ../index.php?error=query_err1&url=" . $bm_id);
    } else {
        mysqli_stmt_bind_param($stmt, "ss", $u_id, $bm_id);
        mysqli_stmt_execute($stmt);
    }
    if (!mysqli_stmt_prepare($stmt, $sql_2)) {
        header("Location: ../index.php?error=query_err2&url=" . $bm_id);
    } else {
        mysqli_stmt_bind_param($stmt, "s", $bm_id);
        mysqli_stmt_execute($stmt);
    }
    $_SESSION['ed-delete'] = 1;
}
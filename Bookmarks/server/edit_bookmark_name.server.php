<?php

if (isset($_POST['edit-submit'])) {
    require '../../shared/php/db_handler.server.php';
    session_start();
    $u_id = $_SESSION['id'];
    $bm_id = $_GET['bm_id'];
    $name = $_POST['newName'];
    $url = $_POST['newUrl'];
    $mode = $_POST['mode'];


    // Change Name Only:
    if ($mode == "on") {
        $sql = "UPDATE user_bookmark SET name = ? WHERE bookmark_id=? AND user_id=?";
        $stmt = mysqli_stmt_init($conn);

        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ../index.php?error=query_err4&url=".$bm_id."&name=".$name);
        } else {
            mysqli_stmt_bind_param($stmt, "sss", $name,$bm_id,$u_id);
            mysqli_stmt_execute($stmt);

            header('Location: ../index.php?name_edit=success');
        }
    } else {
        // Change URL&Name:
        header('Location: edit_routine.server.php?orgbmid='.$bm_id.'&name='.$name.'&url='.$url);
    }


} else {
    header("Location: ../index.php");
    exit();
}











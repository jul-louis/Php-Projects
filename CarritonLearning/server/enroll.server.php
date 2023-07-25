<?php

if (isset($_POST['enroll-submit'])) {
    session_start();
    $uid = $_SESSION['ccid'];
    $cid = $_GET['cid'];
    require '../../shared/php/db_handler_c.server.php';

    $sql = "INSERT INTO course_student (course_id, student_id) values (?, ?)";
    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $sql)) { // here
        header("Location: ../courses.php?error=enroll-sql&cid=".$cid);
    } else {
        mysqli_stmt_bind_param($stmt, "ss", $cid, $uid);
        mysqli_stmt_execute($stmt);
        header("Location: ../courses.php?enroll=success&cid=".$cid);
    }

    mysqli_stmt_close($stmt);
    mysqli_close($conn);


} else {
    header("Location: ../index.php");
}
exit();



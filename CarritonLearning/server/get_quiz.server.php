<?php
if (isset($_SESSION['current_cid'])) {
    require 'functions/parser.php';
    require '../shared/php/db_handler_c.server.php';
    $sql = "SELECT course_quiz from courses WHERE course_id=?";
    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("Location: ../course.php?error=query_err");
        exit();
    } else {
        mysqli_stmt_bind_param($stmt, "s", $_SESSION['current_cid']);
        mysqli_stmt_execute($stmt);
        $res = mysqli_stmt_get_result($stmt);

        $row = mysqli_fetch_array($res, MYSQLI_NUM);
        $quiz = $row[0]; // quiz retrieved here
        parseNotesOverview($quiz);
        parseQuizQuestions($quiz);
    }
} else {
    header('Location: courses.php');
    exit();
}
<?php
    if (isset($_POST['register-submit'])) {

        require '../../shared/php/db_handler_c.server.php';
        $username = $_POST['user-uid-reg'];
        $password = $_POST['pwd-reg'];
        $password_check = $_POST['pwd-check'];


        if (empty($username) || empty($password) || empty($password_check)) {
            header("Location: ../register.php?error=any_empty_field&student-uid-reg=".$username);
            exit();
        } else if (!preg_match("/^[a-zA-Z\d]*$/", $username)) {
            header("Location: ../register.php?error=inv_uid");
            exit();
        } else if ($password !== $password_check) {
            header("Location: ../register.php?error=pwd_not_match&student-uid-reg=".$username);
            exit();
        } else {

            $query = "SELECT student_uid FROM students WHERE student_uid=?";
            $stmt = mysqli_stmt_init($conn);

            if (!mysqli_stmt_prepare($stmt, $query)) { // here
                header("Location: ../register.php?error=query_err&student-uid-reg=".$username);
            } else {

                mysqli_stmt_bind_param($stmt, "s", $username);
                mysqli_stmt_execute($stmt);
                mysqli_stmt_store_result($stmt);
                $res = mysqli_stmt_num_rows($stmt);
                if ($res > 0) {
                    header("Location: ../register.php?error=taken_uid&student-uid-reg=".$username);
                } else {
                    $query = "INSERT INTO students (student_uid, pwd) values (?, ?)";

                    $stmt = mysqli_stmt_init($conn);

                    if (!mysqli_stmt_prepare($stmt, $query)) {
                        header("Location: ../register.php?error=query_err&student-uid-reg=".$username);
                    } else {
                        $hashed_pwd = password_hash($password, PASSWORD_DEFAULT);
                        mysqli_stmt_bind_param($stmt, "ss", $username, $hashed_pwd);
                        mysqli_stmt_execute($stmt);
                        header("Location: ../index.php?register=success");
                    }
                }
            }
            mysqli_stmt_close($stmt);
            mysqli_close($conn);
            exit();
        }

    } else {
        header("Location: ../index.php");
        exit();
    }

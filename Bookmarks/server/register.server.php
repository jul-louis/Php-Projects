<?php
    if (isset($_POST['register-submit'])) {
        require '../../shared/php/db_handler.server.php';

        $username = $_POST['user-uid'];
        $password = $_POST['pwd'];
        $password_check = $_POST['pwd-check'];

        if (empty($username) || empty($password) || empty($password_check)) {
            header("Location: ../register.php?error=any_empty_field&user-uid=".$username);
            exit();
        } else if (!preg_match("/^[a-zA-Z\d]*$/", $username)) {
            header("Location: ../register.php?error=inv_uid");
            exit();
        } else if ($password !== $password_check) {
            header("Location: ../register.php?error=pwd_not_match&user-uid=".$username);
            exit();
        } else {
            $query = "SELECT user_uid FROM users WHERE user_uid=?";
            $stmt = mysqli_stmt_init($conn);

            if (!mysqli_stmt_prepare($stmt, $query)) {
                header("Location: ../register.php?error=query_err&user-uid=".$username);
            } else {
                mysqli_stmt_bind_param($stmt, "s", $username);
                mysqli_stmt_execute($stmt);
                mysqli_stmt_store_result($stmt);
                $res = mysqli_stmt_num_rows($stmt);
                if ($res > 0) {
                    header("Location: ../register.php?error=taken_uid&user-uid=".$username);
                } else {
                    $query = "INSERT INTO users (user_uid, pwd) values (?, ?)";

                    $stmt = mysqli_stmt_init($conn);

                    if (!mysqli_stmt_prepare($stmt, $query)) {
                        header("Location: ../register.php?error=query_err&user-uid=".$username);
                    } else {
                        $hashed_pwd = password_hash($password, PASSWORD_DEFAULT);
                        mysqli_stmt_bind_param($stmt, "ss", $username, $hashed_pwd);
                        mysqli_stmt_execute($stmt);
                        header("Location: ../register.php?register=success");
                    }
                }
            }
            mysqli_stmt_close($stmt);
            mysqli_close($conn);
            exit();
        }

    } else {
        header("Location: ../register.php");
        exit();
    }

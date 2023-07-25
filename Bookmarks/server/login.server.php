<?php
    if (isset($_POST['login-submit'])) {
        require '../../shared/php/db_handler.server.php';

        $username = $_POST['user-uid'];
        $password = $_POST['pwd'];

        if (empty($username) || empty($password)) {
            header("Location: ../index.php?error=any_empty_field&user-uid=".$username);
        } else {
            $query = "SELECT * from users WHERE user_uid=?";
            $stmt = mysqli_stmt_init($conn);
            if (!mysqli_stmt_prepare($stmt, $query)) {
                header("Location: ../index.php?error=query_err&user-uid=".$username);
            } else {
                mysqli_stmt_bind_param($stmt, "s", $username);
                mysqli_stmt_execute($stmt);
                $res = mysqli_stmt_get_result($stmt);
                if ($row = mysqli_fetch_assoc($res)) {
                    $password_check = password_verify($password, $row['pwd']);
                    if (!$password_check) {
                        header("Location: ../index.php?error=wrong_pwd&user-uid=".$username);
                    } else {
                        session_start();
                        $_SESSION['id'] = $row['user_id'];
                        $_SESSION['uid'] = $row['user_uid'];

                        header("Location: ../index.php?login=success");
                    }
                } else {
                    header("Location: ../index.php?error=user_dne&user-uid=".$username);
                }
            }
            mysqli_stmt_close($stmt);
            mysqli_close($conn);
        }
    } else {
        header("Location: ../index.php");
    }
exit();
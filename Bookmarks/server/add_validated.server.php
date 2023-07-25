<?php

session_start();
$id= $_SESSION['id'];
$bookmark = $_GET['url'];
$name = $_GET['name'];

require '../../shared/php/db_handler.server.php';

    $query = "SELECT * from bookmarks WHERE bookmark_url=?";
    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $query)) {
        header("Location: ../index.php?error=query_err&url=".$bookmark);
    } else {
        mysqli_stmt_bind_param($stmt, "s", $bookmark);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);
        $res = mysqli_stmt_num_rows($stmt);
        if ($res > 0) {
            $query = "SELECT bookmark_id FROM bookmarks WHERE bookmark_url=?";
            $stmt = mysqli_stmt_init($conn);

            if (!mysqli_stmt_prepare($stmt, $query)) {
                header("Location: ../index.php?error=query_err&url=".$bookmark);
            } else {
                mysqli_stmt_bind_param($stmt, "s", $bookmark);
                mysqli_stmt_execute($stmt);

                $res = mysqli_stmt_get_result($stmt);
                if ($row = mysqli_fetch_assoc($res)) {
                    $bm_id = $row['bookmark_id'];
                    // Check if already added:
                    $query = "SELECT * FROM user_bookmark WHERE bookmark_id=? AND user_id=?";
                    $stmt = mysqli_stmt_init($conn);
                    if (!mysqli_stmt_prepare($stmt, $query)) {
                        header("Location: ../index.php?error=query_err&url=" . $bookmark);
                    } else {
                        mysqli_stmt_bind_param($stmt, "ss", $bm_id, $id);
                        mysqli_stmt_execute($stmt);

                        mysqli_stmt_store_result($stmt);
                        $res = mysqli_stmt_num_rows($stmt);
                        if ($res > 0) {
                            header("Location: ../index.php?error=already_added");
                            exit();
                        }
                    }

                    $query = "INSERT INTO user_bookmark (bookmark_id, user_id, name) values (?, ?, ?)";
                    $stmt = mysqli_stmt_init($conn);

                    if (!mysqli_stmt_prepare($stmt, $query)) {
                        header("Location: ../index.php?error=query_err&url=" . $bookmark);
                    } else {

                        mysqli_stmt_bind_param($stmt, "sss", $bm_id, $id, $name);
                        mysqli_stmt_execute($stmt);
                        $query = "UPDATE bookmarks SET bookmark_count = bookmark_count + 1 WHERE bookmark_id=?";
                        $stmt = mysqli_stmt_init($conn);
                        if (!mysqli_stmt_prepare($stmt, $query)) {
                            header("Location: ../index.php?error=query_err&url=" . $bookmark);
                        } else {
                            mysqli_stmt_bind_param($stmt, "s", $bm_id);
                            mysqli_stmt_execute($stmt);
                            $_SESSION['ed-add'] = 1;
                            header("Location: ../index.php?add=success");
                        }
                    }
                } else {
                    header("Location: ../index.php?error=query_err&url=" . $bookmark);
                }
            }

        } else {
            $query = "INSERT INTO bookmarks (bookmark_url) values (?)";
            $stmt = mysqli_stmt_init($conn);
            if (!mysqli_stmt_prepare($stmt, $query)) {
                header("Location: ../index.php?error=query_err&url=".$bookmark);
            } else {
                mysqli_stmt_bind_param($stmt, "s", $bookmark);
                mysqli_stmt_execute($stmt);

                $query = "SELECT bookmark_id FROM bookmarks WHERE bookmark_url=?";
                $stmt = mysqli_stmt_init($conn);
                if (!mysqli_stmt_prepare($stmt, $query)) {
                    header("Location: ../index.php?error=query_err&url=".$bookmark);
                } else {
                    mysqli_stmt_bind_param($stmt, "s", $bookmark);
                    mysqli_stmt_execute($stmt);
                    $res = mysqli_stmt_get_result($stmt);

                    if ($row = mysqli_fetch_assoc($res)) {
                        $bm_id=$row['bookmark_id'];
                        $query = "INSERT INTO user_bookmark (bookmark_id, user_id, name) values (?, ?, ?)";
                        $stmt = mysqli_stmt_init($conn);
                        if (!mysqli_stmt_prepare($stmt, $query)) {
                            header("Location: ../index.php?error=query_err&url=".$bookmark);
                        } else {
                            mysqli_stmt_bind_param($stmt, "sss", $bm_id, $id, $name);
                            mysqli_stmt_execute($stmt);
                            $_SESSION['ed-add'] = 1;
                            header("Location: ../index.php?add=success");
                        }
                    } else {
                        header("Location: ../index.php?error=query_err&url=".$bookmark);
                    }
                }
            }
        }
    }
mysqli_stmt_close($stmt);
mysqli_close($conn);
exit();
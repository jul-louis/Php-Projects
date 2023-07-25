<!--<script type="text/javascript" src="server/scripts/interact.js"></script>-->

<?php
    require '../shared/php/db_handler.server.php';
    session_start();
    $u_id = $_SESSION['id'];

    $sql = "DELETE FROM bookmarks WHERE bookmark_count < 1";

    $query = "SELECT * FROM user_bookmark WHERE user_id=?";
    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $query)) {
        header("Location: ../register.php?error=query_err");
    } else {
        mysqli_stmt_bind_param($stmt, "s", $u_id);
        mysqli_stmt_execute($stmt);

        $res = mysqli_stmt_get_result($stmt);

        while($row = mysqli_fetch_array($res, MYSQLI_NUM)){

            $bm_id = $row['0'];
            $name = $row['2'];
            if ($name == "") {
                $name = "No Name";
            }

            $query = "SELECT * FROM bookmarks WHERE bookmark_id=?";
            $stmt = mysqli_stmt_init($conn);

            if (!mysqli_stmt_prepare($stmt, $query)) {
                header("Location: ../register.php?error=query_err");
            } else {
                mysqli_stmt_bind_param($stmt, "s", $bm_id);
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);
                if ($bm_row = mysqli_fetch_assoc($result)) {
                    echo "<div class='link-box'><a target='_blank' class='m-link' href='". $bm_row['bookmark_url'] ."'> ".$name.", ".$bm_row['bookmark_url']."</a>
                            <span class='fr'>
                                <a href='server/delete_bookmark.server.php?bookmark_id=".$bm_id."'>Delete</a>
                            </span>
                            <span class='fr'>
                                <a href='edit.php?bookmark_id=".$bm_id."&name=".$name."&url=".$bm_row['bookmark_url']."'>Edit</a>
                                </span></div>";
                }
            }
        }
    }




<?php
require '../shared/php/db_handler.server.php';

$sql = "DELETE FROM bookmarks WHERE bookmark_count < 1";
$query = "SELECT * FROM bookmarks ORDER BY bookmark_count DESC LIMIT 10";
$stmt = mysqli_stmt_init($conn);

if (!mysqli_stmt_prepare($stmt, $sql)) {
    header("Location: ../register.php?error=query_err");
} else {
    mysqli_stmt_execute($stmt);
}

if (!mysqli_stmt_prepare($stmt, $query)) {
    header("Location: ../register.php?error=query_err");
} else {
    mysqli_stmt_execute($stmt);
    $res = mysqli_stmt_get_result($stmt);

    while($row = mysqli_fetch_array($res, MYSQLI_NUM)){
        $url = $row['1'];
        $count = $row['2'];
        echo "<div><a target='_blank' class='p-link' href='". $url ."'>count: ".$count." ".$url."</a></div>";
    }
}
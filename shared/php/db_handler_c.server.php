<?php

//Get Heroku ClearDB connection information
$cleardb_url = parse_url(getenv("CLEARDB_GOLD_URL"));
$cleardb_server = $cleardb_url["host"];
$cleardb_username = $cleardb_url["user"];
$cleardb_password = $cleardb_url["pass"];
$cleardb_db = substr($cleardb_url["path"],1);
$active_group = 'default';
$query_builder = TRUE;
// Connect to DB
//$conn = mysqli_connect($cleardb_server, $cleardb_username, $cleardb_password, $cleardb_db);
$conn = mysqli_connect('us-cdbr-east-05.cleardb.net', 'b4c666323ee583', '5b3d8c58', 'heroku_d398ab4b9895803', 3306);
if (!$conn) {
    die("connection failed:".mysqli_connect_error());
}

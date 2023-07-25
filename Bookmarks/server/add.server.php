<style>
    <?php include '../../shared/styles/style.css'; ?>
</style>
<?php

require '../header.php';
echo '<br/><br/><div class="df jcc aic fdc"><p class="slogan">If this page failed to jump back to the previous page automatically in a long time or stopped loading, it means the URL you entered is inactive, or CORS has been disabled in your browser.</p><a class="btn centre" href="../index.php?error=back">Click to return to previous page</a></div>'
?>
<?php
    header('Access-Control-Allow-Origin: *');
    header("Access-Control-Allow-Methods: PUT, GET, POST, HEAD");
    header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

    run_add($bookmark, $name);

    function run_add($bookmark, $name) {
        header('Access-Control-Allow-Origin: *');
        if (isset($_POST['add-submit']) || isset($_SESSION['is_edit'])) {
            require '../../shared/php/db_handler.server.php';

            session_start();
            $id = $_SESSION['id'];
            $_SESSION['ed-add'] = 0;

            if (isset($_POST['add-submit'])) {
                $bookmark = $_POST['url'];
                $name = $_POST['name'];
            }

            if (empty($bookmark)) {
                header("Location: ../index.php?error=any_empty_field");
                exit();
            } else if (!filter_var($bookmark, FILTER_VALIDATE_URL)) {
                header("Location: ../index.php?error=inv_bm_url");
                exit();
            } else {
//                 Now the candidate URL is valid, let's check if it's active:
                echo '<script type="text/javascript">
                    var url = "' . $bookmark . '";
                    
                    function isValidUrl(str) {
                        var url;
                        try {
                            url = new URL(str);
                        } catch (_) {
                            return false;
                        }
                        return ( url.protocol === "http:" || url.protocol === "https:");
                    }
                    function setCookie(cname, cvalue, exdays) {
    const d = new Date();
    d.setTime(d.getTime() + (exdays*24*60*60*1000));
    let expires = "expires="+ d.toUTCString();
    document.cookie = cname + "=" + cvalue + "; " + expires + "; path=/;";
}
// //ref stack
 function ifUrlExists(url, callback) {
    let request = new XMLHttpRequest;
    request.open("GET", url, true);
    request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded; charset=UTF-8");
    request.setRequestHeader("Accept", "*/*");
    request.onprogress = function(event) {
        let status = event.target.status;
        let statusFirstNumber = (status).toString()[0];
        switch (statusFirstNumber) {
            case "2":
                request.abort();
                return callback(true);
            default:
                request.abort();
                return callback(false);
        }
    };
    request.send(null);
 }
                    if (isValidUrl(url)) {
                        try {
                            ifUrlExists(url, function(oui) {
                                window.location = "add_validated.server.php?url='.$bookmark.'&name='.$name.'";
                            })   
                        } catch (_) {
                            window.location = "../index.php?error=error";
                        }
                      } else {
                        window.location = "../index.php?error=invalidated_by_js";
                      }
                    </script>';
                sleep(0.01);
            }
        } else {
            header("Location: ../index.php?add=no_access_allowed");
            exit();
        }
    }
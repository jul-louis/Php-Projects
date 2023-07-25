<style type="text/css">
   .course-box {
       height:300px;
       width:300px;
       background-position: center;
       background-repeat: no-repeat;
       border-radius: 8px;

       margin: 0 40px 10px 0;
       filter: grayscale(1);
       display: flex;
       align-items: center;
       flex-direction: column;
   }
   .cb-border-black {
       border: 2px solid #1F1A1F;
   }
   .no-en-box {
       width: 600px;
       height: 300px;
       display: flex;
       align-items: center;
   }
   .no-en-box h1 {
       width: 600px;
       font-style: italic;
       font-size: 2rem;
   }
   .cb-border-white {
       border: 2px solid #FFF0F1;
   }
   .cb-wrapper {
       display: flex;
       align-items: center;
       justify-content: space-evenly;
       flex-direction: column;
   }
   .cb-wrapper p {
       font-size: 1.2rem;
       padding: 5px 8px;
   }
   .first-box {
       height:300px;
       width:240px;
       margin: 0 40px 0 -20px;
       display: flex;
       align-items: center;
   }
   .first-box h1 {
       width:240px;
       font-style: italic;
       font-size: 2rem;
       text-align: center;
   }
   .trigger-visibility {
       visibility: hidden;
       opacity: 0;
       transition: visibility 0s 0.3s linear, opacity 0.3s;
   }
   .opaque-black {
       background: rgba(0, 0, 0, 0.6);
   }
   .opaque-white {
       background: rgba(255, 255, 255, 0.6);
   }
   .course-desc {
       width: 100%;
       border-radius: 8px 8px 0 0;
       height: 38%;
       overflow: scroll;
   }
</style>

<?php

function get_courses() {
    require '../shared/php/db_handler_c.server.php';

    if (isset($_SESSION['ccid'])) {
        echo "<div class='first-box'><h1>Your Learning Journey Starts Here &#10154;</h1></div>";

        $query = "SELECT * FROM courses ORDER BY course_id LIMIT 10";
        $stmt = mysqli_stmt_init($conn);

        if (!mysqli_stmt_prepare($stmt, $query)) {
            header("Location: ../register.php?error=query_err");
        } else {
            mysqli_stmt_execute($stmt);
            $res = mysqli_stmt_get_result($stmt);

            while($row = mysqli_fetch_array($res, MYSQLI_NUM)){
                $course_name = $row['1'];
                $desc = $row['2'];
                $cover = $row['3'];
                echo "<div class='cb-wrapper'><div style='background: url(".$cover."); background-size: cover; ' class='course-box cb-border-white'><p class='course-desc trigger-visibility opaque-black'>".$desc."</p></div>
                    <p>".$course_name."</p>
                    <form action='server/enroll.server.php?cid=".$row[0]."' method='post'>
                        <button id='a-".$row[0]."' type='submit' name='enroll-submit' class='btn-w'>Enroll</button>
                    </form>
                  </div>";
            }
        }
        mysqli_stmt_close($stmt);
        mysqli_close($conn);

    } else {
        header("Location: index.php");
        exit();
    }
}

function get_enrolled() {
    require '../shared/php/db_handler_c.server.php';
    if (isset($_SESSION['ccid'])) {
        echo "<div class='first-box'><h1>Registered Courses List &#10154;</h1></div>";

        $query = "SELECT * FROM course_student WHERE student_id=? ORDER BY course_id LIMIT 10";
        $stmt = mysqli_stmt_init($conn);

        if (!mysqli_stmt_prepare($stmt, $query)) {
            header("Location: ../index.php?error=query_err");
        } else {
            mysqli_stmt_bind_param($stmt, "s", $_SESSION['ccid']);
            mysqli_stmt_execute($stmt);
            $res = mysqli_stmt_get_result($stmt);

            while($row = mysqli_fetch_array($res, MYSQLI_NUM)){

                $course_id = $row[0];

                $query = "SELECT * FROM courses WHERE course_id=?";
                $stmt = mysqli_stmt_init($conn);

                if (!mysqli_stmt_prepare($stmt, $query)) {
                    header("Location: ../index.php?error=query_err");
                } else {
                    mysqli_stmt_bind_param($stmt, "s", $course_id);
                    mysqli_stmt_execute($stmt);

                    $result = mysqli_stmt_get_result($stmt);

                    while($row = mysqli_fetch_array($result, MYSQLI_NUM)){
                        $_SESSION['en_num'] += 1;
                        $_SESSION['en-'.$row[0]] = true;
                        $_SESSION['encn-'.$row[0]] = $row['1'];
                        $course_name = $row['1'];
                        $desc = $row['2'];
                        $cover = $row['3'];
                        echo "<div id='en-".$row[0]."' class='cb-wrapper'><div style='background: url(".$cover."); background-size: cover; ' class='course-box cb-border-black'><p class='course-desc trigger-visibility opaque-white'>".$desc."</p></div>
                    <p>".$course_name."</p>
                    <form action='course_page.php?cid=".$row[0]."&cname=".urlencode($course_name)."' method='post'>
                        <button type='submit' name='enter-course-button' class='btn'>Enter</button>
                    </form>
                  </div>";
                    }
                }
            }
            if (!(isset($_SESSION['en_num'])) || $_SESSION['en_num'] <= 0) {
                echo "<div class='no-en-box'><h1>No Enrolled Courses! Please have a look at our Available Courses!</h1></div>";
            }
        }

    } else {
        header("Location: index.php");
        exit();
    }
}

?>

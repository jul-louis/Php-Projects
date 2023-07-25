<?php
require 'header.php';
if (isset($_SESSION['ccid'])) {
    require 'logout.php';
    require 'to_courses.php';
    $course_name = $_GET['cname'];
    $_SESSION['current_cid'] = $_GET['cid'];
} else {
    header('Location: index.php?access=authorization-error');
}
?>

<main>
    <nav id="course-nav" role="navigation">
        <br/><br/><br/><br/><br/>
        <div class="cnav-content df aic jcse fdc">
            <?php
            echo "<p class='font2'>".$course_name."</p>";
            ?>
            <hr class="hrw"/>
            <?php
            if (isset($_GET['quiz']) && $_GET['quiz']) {
                echo "<a class='btn-w course-link tac' href='course_page.php?cid=".$_SESSION['current_cid']."&cname=".urlencode($course_name)."'>Notes</a>";
            } else {
                echo "<a class='btn-w course-link tac' href='course_page.php?cid=".$_SESSION['current_cid']."&cname=".urlencode($course_name)."&quiz=true''>Quiz</a>";
            }
            ?>
            <hr/><br/>
            <p class="font2">Enrolled Courses</p>
            <hr class="hrw"/>
            <?php
            if (isset($_SESSION['en-1'])) {
                echo "<a class='btn-w course-link' href='course_page.php?cid=1&cname=Web%2C+HTML5+%26+CSS3'>1&emsp;".$_SESSION['encn-1']."</a>";
            }
            if (isset($_SESSION['en-2'])) {
                echo "<a class='btn-w course-link' href='course_page.php?cid=2&cname=JavaScript'>2&emsp;".$_SESSION['encn-2']."</a>";
            }
            if (isset($_SESSION['en-3'])) {
                echo "<a class='btn-w course-link' href='course_page.php?cid=3&cname=XML+%26+Ajax'>3&emsp;".$_SESSION['encn-3']."</a>";
            }
            ?>
        </div>
    </nav>
    <br/><br/><br/><br/>
    <div class="content df jcse fdc">
        <?php
        if (isset($_GET['quiz']) && $_GET['quiz']) {
            echo "<form id='quiz'><h1 class='tac'>".$course_name." Quiz</h1><br/>";
            require 'server/get_quiz.server.php';
            echo '<hr/><div class="df aic jcc"><button class="btn" type="submit">Submit</button></div>';
            echo '</form>';
        } else {
            echo "<h1 class='tac'>".$course_name."</h1><br/>";
            require 'server/get_notes.server.php';

            echo "<form class='df aic jcc' method='post' action='course_page.php?cid=".$_GET['cid']."&cname=".urlencode($_GET['cname'])."&quiz=true'><button type='submit' class='btn'>Take The Quiz</button></form>";
        }
        echo "<br/><h1 class='tac'>&#167;</h1>";
        ?>
        <!-- Get Quiz/Notes, Parse, and then render -->

    </div>
</main>
<script type="text/javascript" src="../shared/scripts/jquery-3.6.0.js"></script>
<script type="text/javascript" src="../shared/scripts/script.js"></script>
<script type="text/javascript" src="scripts/quiz.js"></script>

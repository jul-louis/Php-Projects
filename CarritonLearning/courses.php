<?php
    require 'header.php';
    if (isset($_SESSION['ccid'])) {
        unset($_SESSION["en-1"]);
        unset($_SESSION["en-2"]);
        unset($_SESSION["en-3"]);
        require 'logout.php';
    } else {
        header('Location: index.php?access=authorization-error');
    }
require 'server/get_courses.server.php';
    session_start();
    $_SESSION['en_num'] = 0;
?>



<main>
    <br/><br/><br/>
    <div id="course-list-wrapper-black" class="df aic jcse fdc">
        <p class="slogan">Available Courses</p>
        <!-- Get Courses -->
        <div class="courses-wrapper df">
            <?php
            get_courses();
            ?>
        </div>
        <br/><br/>
    </div>
    <div id="enrolled-list-wrapper" class="df aic jcse fdc">
        <p class="slogan">Enrolled Courses</p>
        <!-- Get Courses -->
        <div class="courses-wrapper df">
            <?php
            get_enrolled();
            ?>
        </div>
    </div>
    <br/><br/>
</main>

<script type="text/javascript" src="../shared/scripts/script.js"></script>
<script>
    var courseBoxes = document.getElementsByClassName('course-box');
    var descriptions = document.getElementsByClassName('course-desc');
    var en1 = document.getElementById('en-1');
    var en2 = document.getElementById('en-2');
    var en3 = document.getElementById('en-3');

if (courseBoxes !== null && courseBoxes.length > 0) {
        for (let i=0; i<courseBoxes.length; i++) {
            courseBoxes[i].addEventListener('mouseover', ev => {
                colorOnlyElement(courseBoxes[i]);
                if (descriptions !== null && descriptions.length > 0) {
                    for (let j=0; j<descriptions.length; j++) {
                        showElement(descriptions[j]);
                    }
                }
            })
        }
        for (let i=0; i<courseBoxes.length; i++) {
            courseBoxes[i].addEventListener('mouseout', ev => {
                grayOnlyElement(courseBoxes[i]);
                if (descriptions !== null && descriptions.length > 0) {
                    for (let j=0; j<descriptions.length; j++) {
                        hideElement(descriptions[j]);
                    }
                }
            })
        }
    }
if (en1 !== null) {
    var a1 = document.getElementById("a-1");
    if (a1 !== null) {
        a1.style.visibility ='hidden';
    }
}
    if (en2 !== null) {
        var a2 = document.getElementById("a-2");
        if (a2 !== null) {
            a2.style.visibility ='hidden';
        }
    }
    if (en3 !== null) {
        var a3 = document.getElementById("a-3");
        if (a3 !== null) {
            a3.style.visibility ='hidden';
        }
    }
</script>



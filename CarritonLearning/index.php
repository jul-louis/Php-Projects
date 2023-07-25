<?php
    session_start();
    require "header.php";
?>
<?php  header('Access-Control-Allow-Origin: *'); ?>
<style>
    <?php include '../shared/styles/style.css'; ?>
</style>

    <main>
        <footer>2022 &copy;&nbsp;KrakenLouis All Right Reserved</footer>
        <video autoplay muted loop playsinline id="bgv">
            <source src="../shared/media/video.mp4" type="video/mp4">
        </video>
        <div class="intro df aic jcc fdc">
            <h1 class="tac">Carriton Course</h1>
            <h2 class="tac">The latest online tuition system that specializes in teaching technologies in 2022</h2>
        </div>
        <?php
            if (isset($_SESSION['ccid'])) {
                require 'logout.php';
                echo '<div id="after-login-box" class="form-box-corner login df aic jcse fdc black-theme">
                            <p class="tac">Logged in Successfully!! Happy Learning!</p>
                            <br/>
                            <div class="df aic jcse">
                            <button id="close-button-login" class="btn-w" name="close">Close</button>
                            <button id="go-courses" class="btn-w" name="go">Learn</button>
                            </div>
                      </div>';
                require 'to_courses.php';
            } else {
                echo '<div class="logout"><button id="login-trigger-button" class="login-trigger btn-w" name="login-trigger">Login</button></div>';
                echo '
                <div>
                    <div id="start-box" class="form-box login df aic jcse fdc black-theme">
                        
                        <form class="login-form df aic jcc fdc" action="server/login.server.php" method="post">
                            <input class="text-in auto-margin-input" type="text" name="student-uid" placeholder="Username">
                            <input class="text-in auto-margin-input" type="password" name="pwd" placeholder="Password">
                            <button class="btn-w" type="submit" name="login-submit">Login</button>
                        </form>
                        <hr/>
                        <div class="df aic jcc fdc">
                        <p class="auto-margin-input">Become a member today!</p>
                        
                        <button id="call-reg-box" class="btn-w" name="get-reg-trigger">Register</button>
                        </div>
                    </div>
                     <div id="register-box" class="form-box login df aic jcse fdc black-theme">
                        
                        <form class="login-form df aic jcc fdc" action="server/register.server.php" method="post">
                            <input class="text-in auto-margin-input" type="text" name="user-uid-reg" placeholder="Username">
                            <input class="text-in auto-margin-input" type="password" name="pwd-reg" placeholder="Password">
                            <input class="text-in auto-margin-input" type="password" name="pwd-check" placeholder="Repeat Password">
                            <button class="btn-w" type="submit" name="register-submit">Register</button>
                        </form>
                        <hr/>
                        <div class="df aic jcc fdc">
                        <p class="auto-margin-input">Already have an account?</p>
                        
                        <button id="call-login-box" class="btn-w" name="get-login-trigger">Login</button>
                        </div>
                    </div>
                </div>
       
             ';
            }

            if (isset($_GET['register'])) {
                echo '  <div id="after-register-box" class="form-box-corner login df aic jcse fdc black-theme">
                            <p>Registered Successfully!!</p>
                            <br/>
                            <div class="df aic jcse">
                            <button id="close-button" class="btn-w" name="get-login-trigger-2">Close</button>
                            <button id="call-login-box-2" class="btn-w" name="get-login-trigger-2">Login</button>
                            </div>
                        </div>';
            }
            if (isset($_GET['error'])) {
                if ($_GET['error']=="wrong_pwd") {
                    echo '<script>alert("Password and Username are not matched!")</script>';
                } else if ($_GET['error'] == "user_dne") {
                    echo '<script>alert("Username are not registered in our system!")</script>';
                }
            }
        ?>

    </main>
<script type="text/javascript" src="scripts/script.js"></script>
<script type="text/javascript" src="../shared/scripts/script.js"></script>

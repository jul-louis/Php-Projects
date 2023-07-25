<?php
    require "header.php";
?>

<style>
    <?php include '../shared/styles/style.css'; ?>
</style>

    <main>
        <div class="df aic jcc fdc">
            <form class="df aic jcc reg-form" action="server/register.server.php" method="post">
                <input class="text-in" type="text" name="user-uid" placeholder="Username">
                <input class="text-in" type="password" name="pwd" placeholder="Password">
                <input class="text-in" type="password" name="pwd-check" placeholder="Repeat Password">
                <button class="btn" type="submit" name="register-submit">Register</button>
            </form>
            <?php
            if (isset($_GET['error'])) {
                if ($_GET['error'] == 'any_empty_field') {
                    echo '<p class="error_msg">Please fill all fields!</p>';
                } else if ($_GET['error'] == 'inv_uid') {
                    echo '<p class="error_msg">Username can only contain letters and digits!</p>';
                } else if ($_GET['error'] == 'pwd_not_match') {
                    echo '<p class="error_msg">Passwords Not Matched!</p>';
                } else if ($_GET['error'] == 'taken_uid') {
                    echo '<p class="error_msg">Username has been taken!</p>';
                }
            } else {
                if ($_GET['register'] == 'success') {
                    echo '<a class="success_msg" href="index.php">Registered! Click and Go Back to Log In.</a>';
                }
            }
            ?>
            <p class="slogan">Store &amp; Manage Your Favorite Sites in&nbsp;One&nbsp;Step</p>
            <a class="btn" href="index.php">Already have an account? Go</a>
        </div>
    </main>

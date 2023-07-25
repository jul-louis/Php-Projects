<?php
    session_start();
    require "header.php";
    require "welcome.php";
?>
<?php  header('Access-Control-Allow-Origin: *'); ?>
<style>
    <?php include '../shared/styles/style.css'; ?>
</style>
<script type="text/javascript" src="server/scripts/interact.js"></script>
    <main>
        <?php
            if (isset($_SESSION['id'])) {
                echo '
                    <form class="logout" action="server/logout.server.php" method="post">
                    <button class="btn-w" type="submit" name="logout-submit">Logout</button>
                    </form>';
            } else {
                echo '<p class="log-status">Welcome</p>';
            }
        ?>
    </main>

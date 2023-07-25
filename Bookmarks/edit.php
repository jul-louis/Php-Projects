<?php
require 'header.php';
?>

<style>
    <?php include '../shared/styles/style.css'; ?>
</style>


<main>

    <div class="df aic jcc fdc">
        <p class="slogan">Edit Bookmark: Change Name or URL</p>
        <p class="ori">Original</p>
        <?php
        if (isset($_GET['url'])) {
            echo '<p class="ori">URL: '.$_GET['url'].'</p>';
        }
        if (isset($_GET['name'])) {
            echo '<p class="ori">Name: '.$_GET['name'].'</p>';
        }
        ?>
        <hr/>
        <form class="login pad df aic jcsb fdc" <?php echo 'action="server/edit_bookmark_name.server.php?bm_id='.$_GET['bookmark_id'].'"' ?> method="post">
            <div>
                <input class="text-in" type="text" name="newName" placeholder="New Name">
                <input id="url_input" class="text-in" type="text" name="newUrl" placeholder="New URL, https://...">
                <button class="btn" type="submit" name="edit-submit">Edit</button>
            </div>
            <div class="df aic jcc fdc" id="toggle-box">
                <label class="toggle" id="toggle-mode" style="margin-left: 0">
                    <input type="checkbox" name="mode">
                    <span class="slider round"></span>
                </label>
                <h5 id="toggle-text-mode" class="ori margin">Disable URL Edit</h5>
            </div>
        </form>
        <hr/>
        <a class="btn" href="index.php">Cancel Editing</a>
    </div>
    <script><?php require '../shared/scripts/script.js'; ?><?php require 'server/scripts/interact.js'; ?></script>
</main>

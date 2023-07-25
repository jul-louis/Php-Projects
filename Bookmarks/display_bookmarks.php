<style>
    <?php include '../shared/styles/style.css'; ?>
</style>
<div class="bm-wrapper df jcc aic">
    <div class="bookmarks">
        <div>
            <h2>Popular Bookmarks</h2>
            <?php
            require 'server/get_populars.server.php';
            ?>
        </div>
    </div>
    <div class="bookmarks inv-color">
        <div>
            <h2>My Bookmarks</h2>
            <?php
            if (isset($_SESSION['id'])) {
                echo '<p><br/></p>';
                require 'server/get_mine.server.php';
            } else {
                echo '<p>Please login to view or manage your bookmarks.</p>';
            }
            ?>
        </div>
    </div>
</div>

<?php
?>

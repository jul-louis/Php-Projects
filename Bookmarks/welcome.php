<style>
    <?php include '../shared/styles/style.css'; ?>
</style>
<div class="welcome-content">
    <div>
        <?php
        if (isset($_SESSION['id'])) {
            echo '
            <div>
            <form name="add_form" class="login pad df aic jcse" action="server/add.server.php" method="post">
            <input class="text-in" type="text" name="name" placeholder="Optional Name">
            <input class="text-in" type="text" name="url" placeholder="https://...">
            <button class="btn" type="submit" name="add-submit">Bookmark</button>
            </form>
            </div><hr/>';
            if (isset($_GET['error'])) {
                if ($_GET['error'] == 'any_empty_field') {
                    echo '<p class="info error_msg">Please fill all fields!</p>';
                    if (isset($_SESSION['is_edit'])) {
                        if ($_SESSION['is_edit']==1) {
                            $_SESSION['is_edit'] = 0;
                            echo '<p class="info error_msg">Error Message From Edit: Please Add Your New URL Here! The Old Bookmark is Deleted.</p>';
                        }
                    }
                } else if ($_GET['error'] == 'inv_bm_url') {
                    echo '<p class="info error_msg">Invalid URL!</p>';
                    if (isset($_SESSION['is_edit'])) {
                        if ($_SESSION['is_edit']==1) {
                            $_SESSION['is_edit'] = 0;
                            echo '<p class="info error_msg">Error Message From Edit: Please Add Your New URL Here! The Old Bookmark is Deleted.</p>';
                        }
                    }
                } else if ($_GET['error'] == 'invalidated_by_js') {
                    echo '<p class="info error_msg">Invalid or Inactive URL!</p>';
                    if (isset($_SESSION['is_edit'])) {
                        if ($_SESSION['is_edit'] == 1) {
                            $_SESSION['is_edit'] = 0;
                            echo '<p class="info error_msg">Error Message From Edit: Please Add Your New URL Here! The Old Bookmark is Deleted.</p>';
                        }
                    }
                } else if ($_GET['error'] == 'back') {
                        echo '<p class="info error_msg">Returned! Please check your url and retry! If you were to edit, now you should add your new bookmark.</p>';
                }
            } else {
                if ($_GET['add'] == 'success') {
                    echo '<p class="df aic jcc"><a class="success_msg" href="index.php">Added! Click to Clear This Information.</a></p>';
                }
                if ($_GET['name_edit'] == 'success') {
                    echo '<p class="df aic jcc"><a class="success_msg" href="index.php">Name Edited! Click to Clear This Information.</a></p>';
                }
                if ($_GET['delete'] == 'success') {
                    echo '<p class="df aic jcc"><a class="success_msg" href="index.php">Deleted! Click to Clear This Information.</a></p>';
                }
            }
            if (isset($_GET['mode']) && $_GET['mode']=='edit') {
                $add_res = $_SESSION['ed-add'];
                $delete_res= $_SESSION['ed-delete'];
                if ($add_res == 1 and $delete_res == 1) {
                    echo '<p class="df aic jcc"><a class="success_msg" href="index.php">Edited! Click to Clear This Information.</a></p>';
                } else if ($add_res == 0 and $delete_res == 1) {
                    echo '<p class="info error_msg">Edit Failed. Undesired Bookmark has been removed. Please add a new one.</p>';
                }
            }
        } else {
            echo '
            <div class="login df aic jcse">
            <form class="login-form df aic jcc" action="server/login.server.php" method="post">
            <input class="text-in" type="text" name="user-uid" placeholder="Username">
            <input class="text-in" type="password" name="pwd" placeholder="Password">
            <button class="btn" type="submit" name="login-submit">Login</button>
            </form>
            <div class="df aic jcc">
                <p>Don\'t have an account?&emsp;&emsp;&emsp;</p>
                <a class="btn" href="register.php">Register</a>
            </div>
            </div><hr/>';

            if (isset($_GET['error'])) {
                if ($_GET['error'] == 'wrong_pwd') {
                    echo '<p class="info error_msg">Password and Username are not matched!!</p>';
                } else if ($_GET['error'] == 'user_dne') {
                    echo '<p class="info error_msg">Username not found!!</p>';
                }
            }
        }
        ?>
        <?php
            require('display_bookmarks.php');
        ?>

    </div>
</div>


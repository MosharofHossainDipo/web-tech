<?php
session_start();
?>
<header style="display:flex; justify-content:space-between; padding:10px; background:#f2f2f2;">
    <div><strong>Butcher Finder</strong></div>
    <div>
        <?php
        if (isset($_SESSION['butcher_email'])) {
            echo "Welcome, " . $_SESSION['butcher_email'] . " | <a href='logout.php'>Logout</a>";
        } else {
            echo "<a href='log_in.php'>Login</a>";
        }
        ?>
    </div>
</header>

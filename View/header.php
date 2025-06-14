<?php
session_start();
?>
<header style="display:flex; justify-content:space-between; padding:10px; background:#f2f2f2;">
   
    <div>
        <?php
        if (isset($_SESSION['butcher_email'])) {
            
        } else {
            echo "<a href='log_in.php'></a>";
        }
        ?>
    </div>
</header>

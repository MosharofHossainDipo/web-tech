<?php include 'header.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Search Butchers</title>
    <link rel="stylesheet" type="text/css" href="../../Design/ButcherCSS/styles.css">
</head>
<body>
    <div class="search-container">
        <h1>Find Butchers in Your Area</h1>
        <form method="GET" action="../../Control/Butcher/search_butchers.php">
            <input type="text" name="location" placeholder="Enter your city (e.g., Dhaka)" required>
            <button type="submit">Search</button>
        </form>
        
        <?php if (isset($_GET['location'])): ?>
            <div class="results-container">
                <h2>Butchers in <?php echo htmlspecialchars($_GET['location']); ?></h2>
                
                <?php if (!empty($butchers)): ?>
                    <div class="butchers-list">
                        <?php foreach ($butchers as $butcher): ?>
                            <div class="butcher-card">
                                <h3><?php echo htmlspecialchars($butcher['butcher_name']); ?></h3>
                                <p>Email: <?php echo htmlspecialchars($butcher['butcher_email']); ?></p>
                                <p>Experience: <?php echo htmlspecialchars($butcher['experience']); ?> years</p>
                                <p>Services: <?php echo htmlspecialchars($butcher['services']); ?></p>
                                <p>Available Time: <?php echo htmlspecialchars($butcher['available_time']); ?></p>
                                <a href="butcher_details.php?id=<?php echo $butcher['id']; ?>" class="view-btn">View Details</a>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php else: ?>
                    <p>No butchers found in this area.</p>
                <?php endif; ?>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>
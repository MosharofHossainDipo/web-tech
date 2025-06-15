<?php include 'header.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Butcher Finder</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 0; padding: 0; background: #fff; }
        .hero { text-align: center; padding: 60px 20px; }
        .hero input { padding: 10px; width: 300px; }
        .hero button { padding: 10px 20px; background: red; color: #fff; border: none; }
        .section { padding: 40px 20px; text-align: center; }
        .features, .butchers { display: flex; justify-content: center; gap: 20px; flex-wrap: wrap; }
        .card { border: 1px solid #ddd; padding: 10px; width: 200px; }
        .testimonial { margin-top: 40px; }
    </style>
</head>
<body>
        
 
<div class="hero">
    <h1>Find the Best Butchers<br>in Your Area</h1>
    <p>Discover top-quality meat and exceptional service at local butcher shops near you.</p>
    <div class="search-box" style="text-align: center; margin: 20px 0;">
        <form method="GET" action="search.php" style="display: inline-block;">
            <input type="text" name="location" placeholder="Search butchers by location">
            <button type="submit">Search</button>
        </form>
    </div>
</div>
 
<div class="section">
    <h2>Why Choose Us</h2>
    <div class="features">
        <div><strong>✔ Quality Selection</strong><br> Finest cuts and artisanal products.</div>
        <div><strong>📍 Local Expertise</strong><br> Deep knowledge of local tastes.</div>
        <div><strong>👍 Trusted Reviews</strong><br> Choose with confidence.</div>
    </div>
</div>
 
<div class="section">
    <h2>Featured Butchers</h2>
    <div class="butchers">
        <div class="card"><img src="meat1.png" width="100%"><b>Johnson’s Butcher Shop</b><br>Springfield<br>⭐⭐⭐⭐⭐</div>
        <div class="card"><img src="meat2.png" width="100%"><b>Prime Cuts</b><br>Riverside<br>⭐⭐⭐⭐⭐</div>
        <div class="card"><img src="meat3.png" width="100%"><b>Meat Mart</b><br>Lakside<br>⭐⭐⭐⭐⭐</div>
        <div class="card"><img src="meat4.png" width="100%"><b>The Chop House</b><br>Greenville<br>⭐⭐⭐⭐⭐</div>
    </div>
</div>
 
<div class="section testimonial">
    <h2>What Our Users Are Saying</h2>
    <p><img src="avatar.png" width="50" style="border-radius:50%"><br>
    I found the perfect butcher for my family thanks to Butcher Finder! Great quality and friendly service.<br><b>Sarah W.</b></p>
</div>
 
</body>
</html>
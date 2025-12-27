<?php
include("includes/db.php");
include("includes/header.php");
?>

<!-- HERO SECTION -->
<section class="hero">
    <div class="hero-overlay">
        <h1>Welcome to LUX Hotel</h1>
        <p>Where Comfort Meets Elegance</p>
        <a href="rooms.php" class="btn-primary">Explore Rooms</a>
    </div>
</section>

<!-- ABOUT SECTION -->
<section class="about-home">
    <div class="about-text">
        <h2>Experience Luxury Like Never Before</h2>
        <p>
            LUX Hotel offers premium hospitality with elegant rooms,
            world-class service, and breathtaking views. Whether you are
            traveling for business or leisure, we ensure a memorable stay.
        </p>
        <a href="rooms.php" class="btn-secondary">View Rooms</a>
    </div>

    <div class="about-image">
        <img src="images/suite.jpg" alt="Luxury Suite">
    </div>
</section>

<!-- GALLERY SECTION -->
<section class="home-gallery">
    <h2>Hotel Gallery</h2>
    <div class="gallery-grid">
        <img src="images/single.jpg" alt="Single Room">
        <img src="images/double.jpg" alt="Double Room">
        <img src="images/family.jpg" alt="Family Room">
        <img src="images/deluxe.jpg" alt="Deluxe Room">
        <img src="images/suite.jpg" alt="Suite">
        <img src="images/sea.jpg" alt="Sea View">
    </div>
</section>

<!-- FEATURES SECTION -->
<section class="features">
    <div class="feature">
        <h3>🏨 Luxury Rooms</h3>
        <p>Stylish rooms designed for comfort and relaxation.</p>
    </div>

    <div class="feature">
        <h3>🍽 Fine Dining</h3>
        <p>Enjoy delicious cuisine prepared by expert chefs.</p>
    </div>

    <div class="feature">
        <h3>🌊 Ocean View</h3>
        <p>Relax with breathtaking views and serene surroundings.</p>
    </div>
</section>

<?php include("includes/footer.php"); ?>




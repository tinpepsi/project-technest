<!-- 
 * This code is written by NUR ATHIRAH BINTI HILALUDDIN
 * Student ID: AM2307013911
 * Date: 11/9/2024
 * Purpose: This page display the smart device product. 
-->

<?php
session_start(); // Start the session
include 'db_connect.php';  // Include the database connection file

// Include the fetching logic for smart devices
include 'fetch_category.php';


$category = 'Smart Device'; 
$products = fetchProductsByCategory($category);
$totalProducts = count($products); // Count the total products 

if (isset($_SESSION['username'])) {
    // User is logged in
    $authLink = "logout.php";
    $authLabel = "Logout";
} else {
    // User is not logged in
    $authLink = "login.php";
    $authLabel = "Login";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="include/css/shop.css">
    <!-- Bootstrap v5.3 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>

   <!--Navbar-->
   <nav class="navbar navbar-expand-lg fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand me-auto md-" href="#">TechNest</a>
            <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar"
                aria-labelledby="offcanvasNavbarLabel">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title" id="offcanvasNavbarLabel">TechNest</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                    <ul class="navbar-nav justify-content-center flex-grow-1 pe-3">
                        <li class="nav-item">
                            <a class="nav-link  mx-lg-2" aria-current="page" href="index.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link  mx-lg-2" href="about.php">About</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link  mx-lg-2" href="contact.php">Contact</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle active" href="#" role="button" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                Product
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="shop.php">Shop</a></li>
                                <li><a class="dropdown-item" href="tech.php">Tech Accessories</a></li>
                                <li><a class="dropdown-item" href="game.php">Gaming Console</a></li>
                                <li><a class="dropdown-item" href="smartphone.php">Smartphone</a></li>
                                <li><a class="dropdown-item" href="smart.php">Smart Device</a></li>
                                <li><a class="dropdown-item" href="drone.php">Drones and Camera</a></li>
                                <li><a class="dropdown-item" href="bike.php">Electric Bikes</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
            <!-- cart button, visible only to normal users -->
            <?php if (isset($_SESSION['username']) && $_SESSION['role'] != 1): ?>
                <a href="display_cart.php" class="cart-link">
                    <i class="fa-solid fa-cart-shopping"></i>
                </a>
            <?php endif; ?>

            <!-- login/logout button -->
            <?php if (isset($_SESSION['username'])): // Check if user is logged in ?>
                <div class="dropdown">
                    <button class="dropbtn"><?php echo htmlspecialchars($_SESSION['username']); // Display username ?></button>
                    <div class="dropdown-content">
                        <?php if ($_SESSION['role'] == 1): // Check if user is an admin ?>
                            <a class="dropdown-item" href="admin_dashboard.php">Admin Dashboard</a>
                        <?php else: // Regular user ?>
                            <a class="dropdown-item" href="profile.php">Profile</a>
                        <?php endif; ?>
                        <a class="dropdown-item" href="<?php echo $authLink; ?>"><?php echo $authLabel; ?></a>
                    </div>
                </div>
            <?php else: // User is not logged in ?>
                <a class="login-button" href="login.php">Login</a>
            <?php endif; ?>

            <!--navbar button-->
            <button class="navbar-toggler pe-0" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar"
                aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
    </nav>
    <!--End Navbar-->

<!-- Start top-smartwatch Area -->
<section class="top-smartwatch-area section-gap">
    <div class="container custom_smartwatch_container">
        <div class="row d-flex justify-content-center">
            <div class="menu-content pb-60 col-lg-10">
                <div class="title text-center">
                    <h1 class="mb-10">Top Smartwatches Available Now</h1>
                    <p>Discover the best smartwatches designed to keep you connected, healthy, and active.</p>
                </div>
            </div>
        </div>                    
        <div class="row justify-content-center align-items-center">
            <div class="col-lg-3 feature-left"> <!-- LEFT SIDE -->
                <div class="single-feature mb-4"> <!-- TOP -->
                    <span class="lnr lnr-heart"></span>
                    <h4>Health & Fitness Tracking</h4>
                    <p>
                        Monitor your heart rate, sleep, and fitness activity with advanced health tracking features that help you stay active and informed.
                    </p>
                </div>
                <div class="single-feature"> <!-- BOTTOM -->
                    <span class="lnr lnr-alarm"></span>
                    <h4>Notifications & Alerts</h4>
                    <p>
                        Receive notifications, reminders, and alerts right on your wrist, helping you stay connected and on track throughout the day.
                    </p>
                </div>                            
            </div>
            <div class="col-lg-6 feature-middle"> <!-- CENTER -->
    <!-- picture fade in out 1 -->
    <img class="fade-img img-fluid mx-auto d-block" src="include/pic/shop/smart/bg1.png" alt="Smartwatch Image">
    <!-- picture fade in out 2 -->
    <img class="fade-img img-fluid mx-auto d-block" src="include/pic/shop/smart/bg2.png" alt="Smartwatch Image">
    <!-- picture fade in out 3 -->
    <img class="fade-img img-fluid mx-auto d-block" src="include/pic/shop/smart/bg3.png" alt="Smartwatch Image">
</div>

            <div class="col-lg-3 feature-right"> <!-- RIGHT SIDE -->
                <div class="single-feature mb-4"> <!-- TOP -->
                    <span class="lnr lnr-cloud-sync"></span>
                    <h4>Seamless Connectivity</h4>
                    <p>
                        Stay connected with Bluetooth, Wi-Fi, and LTE options that allow you to sync with your smartphone or operate independently.
                    </p>
                </div>
                <div class="single-feature"> <!-- BOTTOM -->
                    <span class="lnr lnr-battery"></span>
                    <h4>Long Battery Life</h4>
                    <p>
                        Enjoy extended battery life that supports your lifestyle, with up to several days on a single charge.
                    </p>
                </div>                                                        
            </div>
        </div>
    </div>    
</section>
<!-- End top-smartwatch Area -->



<!-- Start Steps Section -->
<section class="steps-section">
    <div class="container-fluid text-center">
        <div class="intro-text">
            <h1>Download<br>the SmartThings app</h1>
            <p>Add your devices to the SmartThings app for a whole new world of connected living.</p>
            <button class="cta-button">Google Play Store</button>
        </div>
        <div class="row">
            <div class="col-md-4">
                <img src="include/pic/shop/smart/1.png" alt="Image 1" class="step-img">
            </div>
            <div class="col-md-4">
                <img src="include/pic/shop/smart/2.png" alt="Image 2" class="step-img">
            </div>
            <div class="col-md-4">
                <img src="include/pic/shop/smart/3.png" alt="Image 3" class="step-img">
            </div>
        </div>
    </div>
</section>
<!-- End Steps Section -->


<!--Product-->
<div class="container-fluid custom_product_container">
    <div class="product-title">
        <h1>View Our Products</h1>
    </div>
    <div class="container-fluid custom_product_container">
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-2" id="product-list">
            <?php if ($totalProducts > 0): // Check if there are products ?>
                <?php foreach ($products as $product): // Loop through the products ?>
                    <div class="col product-card-wrapper">
                        <div class="product-card" data-id="<?php echo $product['product_id']; ?>" data-category="<?php echo htmlspecialchars($product['category']); ?>" data-price="<?php echo htmlspecialchars($product['price']); ?>">
                            <div class="badge">New</div>
                            <div class="product-tumb">
                                <img src="<?php echo htmlspecialchars($product['image']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>" class="card-img-top shop-item-image">
                            </div>
                            <div class="product-details">
                                <span class="product-catagory shop-item-categories"><?php echo htmlspecialchars($product['category']); ?></span>
                                <h4><a href="#" class="card-title shop-item-title"><?php echo htmlspecialchars($product['name']); ?></a></h4>
                                <p><?php echo htmlspecialchars($product['description']); ?></p>
                                <div class="product-bottom-details">
                                    <div class="product-price shop-item-price">RM<?php echo number_format($product['price'], 2); ?></div>
                                    <div class="product-links">
                                        <form action="cart.php" method="POST" style="display: inline;">
                                            <input type="hidden" name="product_id" value="<?php echo $product['product_id']; ?>">
                                            <input type="hidden" name="quantity" value="1"> <!-- Default quantity -->
                                            <button type="submit" class="btn-shop-item mt-auto shop-item-button">
                                                <i class="fa fa-shopping-cart"></i>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col">
                    <p>No products available.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
    <!--Pagination-->
    <div class="pagination mt-4">
        <button id="prev" class="btn btn-secondary" onclick="changePage(-1)">Previous</button>
        <span id="page-info">Page 1</span>
        <button id="next" class="btn btn-secondary" onclick="changePage(1)">Next</button>
    </div>
</div>
<!--END Product-->

<!-- Features Section Begin -->
<section class="features-section spad">
    <div class="tech-features-box">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="single-box-item first-box">
                                <img src="include/pic/shop/smart/4.png" alt="">
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="single-box-item second-box">
                                <img src="include/pic/shop/smart/5.png" alt="">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="single-box-item large-box">
                        <img src="include/pic/shop/smart/6.png" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Features Section End -->

<!--FOOTER-->
<div class="footer-basic">
    <footer>
        <div class="social">
            <a href="#"><i class="fa-brands fa-instagram"></i></a>
            <a href="#"><i class="fa-brands fa-facebook"></i></a>
            <a href="#"><i class="fa-brands fa-twitter"></i></a>
            <a href="#"><i class="fa-brands fa-youtube"></i></a>
        </div>
        <ul class="list-inline">
            <li class="list-inline-item"><a href="#">Home</a></li>
            <li class="list-inline-item"><a href="#">Services</a></li>
            <li class="list-inline-item"><a href="#">About</a></li>
            <li class="list-inline-item"><a href="#">Terms</a></li>
            <li class="list-inline-item"><a href="#">Privacy Policy</a></li>
        </ul>
        <p class="copyright">
            Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | <i class="ion-ios-heart" aria-hidden="true"></i> by <span class="neon-text"><a href="#" target="_blank">TechNest</a></span>
        </p>
    </footer>
</div>
<!--END FOOTER-->

<script>
document.addEventListener("DOMContentLoaded", function() {
    let currentIndex = 0;
    const images = document.querySelectorAll('.fade-img');  // Select all images with the 'fade-img' class
    const totalImages = images.length;

    // Function to cycle through images
    function fadeImages() {
        // Remove the 'active' class from the current image
        images[currentIndex].classList.remove('active');
        
        // Move to the next image
        currentIndex = (currentIndex + 1) % totalImages;  // Loop back to the first image
        
        // Add the 'active' class to the new image
        images[currentIndex].classList.add('active');
    }

    // Make sure the first image is visible immediately on page load
    images[currentIndex].classList.add('active');

    // Set an interval to change images every 3 seconds (3000 ms)
    setInterval(fadeImages, 3000);
});

    </script>

 
<!--JS-->
<script src="include/js/script.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Bootstrap v5.3 JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

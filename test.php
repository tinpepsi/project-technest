<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sliding Hero Section with Multiple Images</title>
  <style>
    /* Set the body to make the page look nice */
    body {
      margin: 0;
      padding: 0;
      overflow: hidden; /* To hide scrollbars during animation */
      font-family: Arial, sans-serif;
    }

    /* Hero Section Styling */
    .hero {
      width: 100%;
      height: 100vh;
      position: relative;
      overflow: hidden;
    }

    /* Container for images */
    .hero-images {
      display: flex;
      width: 300%; /* 3 images, each 100% width */
      animation: slide 15s infinite linear; /* Animation to slide the images */
    }

    /* Styling for each image */
    .hero-images img {
      width: 100%; /* Each image takes full width of the viewport */
      height: 100vh; /* Makes sure the images fill the screen height */
      object-fit: cover; /* Ensures the images cover the area without distortion */
    }

    /* Keyframes for Sliding Effect */
    @keyframes slide {
      0% {
        transform: translateX(0); /* Start from the first image */
      }
      33% {
        transform: translateX(-33.33%); /* Slide to the second image */
      }
      66% {
        transform: translateX(-66.66%); /* Slide to the third image */
      }
      100% {
        transform: translateX(-100%); /* After the third image, start from the first one */
      }
    }
  </style>
</head>
<body>

  <section class="hero">
    <div class="hero-images">
      <img src="include/pic/shop/bike/1.png" alt="Image 1">
      <img src="include/pic/shop/bike/2.png" alt="Image 2">
      <img src="include/pic/shop/bike/3.png" alt="Image 3">
    </div>
  </section>

</body>
</html>

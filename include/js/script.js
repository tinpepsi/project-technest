//JavaScript for search and pagination (admin_dashboard.php)-->

/////////////////////////////////////////////////////////////
///     search and pagination (admin_dashboard.php)    //////
/////////////////////////////////////////////////////////////
// Search Function for Product Table
function searchTable() {
  const input = document.getElementById("searchInput");
  const filter = input.value.toLowerCase();
  const table = document.getElementById("productTable");
  const tr = table.getElementsByTagName("tr");

  for (let i = 1; i < tr.length; i++) {
    // Start from 1 to skip header row
    const td = tr[i].getElementsByTagName("td");
    let found = false;

    for (let j = 0; j < td.length; j++) {
      if (td[j]) {
        const txtValue = td[j].textContent || td[j].innerText;
        if (txtValue.toLowerCase().indexOf(filter) > -1) {
          found = true;
          break;
        }
      }
    }

    tr[i].style.display = found ? "" : "none"; // Show or hide the row based on search
  }
}

let currentAdminPage = 1; // Scoped to admin dashboard

function paginateTable() {
  const table = document.getElementById("productTable");
  const rows = table.getElementsByTagName("tr");
  const rowsPerPage = 7;
  const totalPages = Math.ceil((rows.length - 1) / rowsPerPage);

  // Hide all rows initially
  for (let i = 1; i < rows.length; i++) {
    rows[i].style.display = "none";
  }

  // Show rows for the current page
  const start = (currentAdminPage - 1) * rowsPerPage + 1;
  const end = currentAdminPage * rowsPerPage + 1;
  for (let i = start; i < end && i < rows.length; i++) {
    rows[i].style.display = "";
  }

  // Generate pagination buttons
  const pagination = document.getElementById("pagination");
  pagination.innerHTML = ""; // Clear previous pagination

  for (let i = 1; i <= totalPages; i++) {
    const btn = document.createElement("li");
    btn.innerHTML = `<a href="#" class="${
      i === currentAdminPage ? "active" : ""
    }" onclick="changeAdminPage(${i})">${i}</a>`;
    pagination.appendChild(btn);
  }
}

// Function to change the current page in admin dashboard
function changeAdminPage(pageNumber) {
  currentAdminPage = pageNumber; // Update the current admin page
  paginateTable(); // Refresh the table display for the new page
}

// Initialize admin table pagination on page load
document.addEventListener("DOMContentLoaded", function () {
  paginateTable();
});

let currentShopPage = 1; // Scoped to shop
const productsPerPage = 9;

function displayProducts() {
  const productList = document.getElementById("product-list");
  const products = Array.from(productList.children);
  const totalPages = Math.ceil(products.length / productsPerPage);

  // Calculate start and end indices for the current page
  const startIndex = (currentShopPage - 1) * productsPerPage;
  const endIndex = startIndex + productsPerPage;

  // Hide all products initially
  products.forEach((product) => (product.style.display = "none"));

  // Show products for the current page
  products.slice(startIndex, endIndex).forEach((product) => {
    product.style.display = "block";
  });

  // Update page information text
  document.getElementById("page-info").textContent = `Page ${currentShopPage} of ${totalPages}`;

  // Enable or disable the buttons based on the current page
  document.getElementById("prev").disabled = currentShopPage === 1;
  document.getElementById("next").disabled = currentShopPage === totalPages;
}

function changeShopPage(direction) {
  const productList = document.getElementById("product-list");
  const products = Array.from(productList.children);
  const totalPages = Math.ceil(products.length / productsPerPage);

  // Update current page based on direction (1 for next, -1 for prev)
  currentShopPage += direction;

  // Ensure the page stays within bounds
  if (currentShopPage < 1) currentShopPage = 1;
  if (currentShopPage > totalPages) currentShopPage = totalPages;

  // Refresh the display with updated current page
  displayProducts();
}

// Initial call to display products on page load
document.addEventListener("DOMContentLoaded", () => {
  displayProducts();

  // Attach event listeners to the Prev and Next buttons
  document.getElementById("prev").addEventListener("click", () => changeShopPage(-1));
  document.getElementById("next").addEventListener("click", () => changeShopPage(1));
});


//SHOP.PHP
//countdown for hot deal
// Set the date and time for the countdown target (30 days from now)
const countdownDate = new Date();
countdownDate.setDate(countdownDate.getDate() + 30); // Add 30 days to the current date
countdownDate.setHours(23, 59, 59, 999); // Set the time to 23:59:59.999 for that day

// Update the countdown every second
const countdownInterval = setInterval(function() {
    // Get the current time
    const now = new Date().getTime();
    
    // Calculate the difference between the countdown target and now
    const distance = countdownDate.getTime() - now;

    // Calculate days, hours, minutes, and seconds
    const days = Math.floor(distance / (1000 * 60 * 60 * 24));
    const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
    const seconds = Math.floor((distance % (1000 * 60)) / 1000);

    // Update the HTML elements with calculated values
    document.getElementById("days").innerHTML = days;
    document.getElementById("hours").innerHTML = hours;
    document.getElementById("minutes").innerHTML = minutes;
    document.getElementById("seconds").innerHTML = seconds;

    // If the countdown is over, stop the timer and optionally display a message
    if (distance < 0) {
        clearInterval(countdownInterval);
        document.getElementById("days").innerHTML = 0;
        document.getElementById("hours").innerHTML = 0;
        document.getElementById("minutes").innerHTML = 0;
        document.getElementById("seconds").innerHTML = 0;
        document.querySelector(".hot-deal").insertAdjacentHTML('beforeend', "<p>Deal expired!</p>");
    }
}, 1000);

//////////////////////////////////////////////////////
//////     SEARCH FUNCTION SHOP.PHP           ////////
//////////////////////////////////////////////////////

function filterProducts() {
    const searchInput = document.getElementById("search-bar").value.toLowerCase();
    const products = document.querySelectorAll("#product-list .product-card");

    products.forEach((product) => {
        const productName = product.querySelector(".shop-item-title").textContent.toLowerCase();
        const productCategory = product.querySelector(".shop-item-categories").textContent.toLowerCase();

        // Show product if it matches the search query in name or category
        if (productName.includes(searchInput) || productCategory.includes(searchInput)) {
            product.parentElement.style.display = "block"; // Show the entire product card column
        } else {
            product.parentElement.style.display = "none"; // Hide the entire product card column
        }
    });
}

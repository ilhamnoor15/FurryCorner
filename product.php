<?php
include "db.php";

if (!isset($_GET['id'])) {
    die("Product not found.");
}

$id = (int)$_GET['id'];

$sql = "SELECT * FROM products WHERE product_id = $id";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) == 0) {
    die("Product not found.");
}

$product = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="en">
<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Product - FurryCorner PH</title>

<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Baloo+2:wght@500;600;700;800&family=Nunito:wght@400;600;700;800&display=swap" rel="stylesheet">

<style>

:root{
  --blue:#7BB8F0;
  --blue-dark:#5CA3E8;
  --cream:#FCE3C0;
  --cream-light:#FDEEDA;
  --ink:#1F2430;
  --white:#ffffff;
}

*{
  box-sizing:border-box;
  margin:0;
  padding:0;
}

html{
  scroll-behavior:smooth;
}

body{
  font-family:'Nunito',sans-serif;
  color:var(--ink);
  background:var(--cream);
  line-height:1.5;
}

a{
  text-decoration:none;
  color:inherit;
}

img{
  max-width:100%;
  display:block;
}

.container{
  max-width:1200px;
  margin:0 auto;
  padding:0 40px;
}

h1,h2,h3,.brand{
  font-family:'Baloo 2',cursive;
}


/* =========================
   NAVBAR
========================= */

.navbar{
  position:sticky;
  top:0;
  left:0;
  right:0;
  z-index:1000;

  background:var(--white);

  display:flex;
  align-items:center;
  justify-content:space-between;

  padding:14px 40px;

  box-shadow:0 2px 0 rgba(0,0,0,0.04);

  transition:box-shadow .25s ease,
             padding .25s ease;
}

.navbar.scrolled{
  box-shadow:0 6px 18px rgba(0,0,0,0.10);
  padding:10px 40px;
}

.nav-left{
  display:flex;
  align-items:center;
  gap:44px;
}

.logo{
  display:flex;
  align-items:center;
  gap:8px;

  font-weight:700;
  font-size:14px;
  line-height:1.1;

  color:var(--blue-dark);
}

.logo img{
  width:38px;
  height:38px;
  object-fit:contain;
}

.nav-links{
  display:flex;
  align-items:center;
  gap:32px;

  list-style:none;

  font-weight:700;
  font-size:15px;
}

.nav-links li a{
  display:flex;
  align-items:center;
  gap:4px;
  opacity:.9;
}

.nav-links li a:hover{
  opacity:1;
  color:var(--blue-dark);
}

.nav-icons{
  display:flex;
  align-items:center;
  gap:22px;
}

.nav-icons svg{
  width:22px;
  height:22px;
  cursor:pointer;
}

.menu-toggle{
  display:none;
  background:none;
  border:none;
  cursor:pointer;
}


/* =========================
   CART ICON
========================= */

.cart-link{
  position:relative;

  display:flex;
  align-items:center;
  justify-content:center;

  cursor:pointer;
}

.cart-icon-wrap{
  position:relative;

  display:flex;
  align-items:center;
  justify-content:center;
}

.cart-icon-wrap svg{
  width:22px;
  height:22px;
}

.cart-badge{
  position:absolute;

  top:-9px;
  right:-10px;

  min-width:17px;
  height:17px;

  padding:0 4px;

  display:flex;
  align-items:center;
  justify-content:center;

  border-radius:50%;

  background:var(--blue-dark);
  color:white;

  font-size:10px;
  font-weight:800;
}


/* =========================
   SEARCH
========================= */

.search-overlay{
  position:fixed;
  inset:0;

  background:rgba(123,184,240,0.55);

  backdrop-filter:blur(2px);

  z-index:2000;

  display:none;

  align-items:flex-start;
  justify-content:center;

  padding:60px 40px 0;
}

.search-overlay.open{
  display:flex;
}

.search-box{
  background:var(--white);

  width:100%;
  max-width:760px;

  border-radius:12px;

  border:2px solid var(--blue);

  display:flex;
  align-items:center;

  padding:14px 20px;

  gap:14px;

  box-shadow:0 12px 30px rgba(0,0,0,0.15);
}

.search-box input{
  flex:1;

  border:none;
  outline:none;

  font-family:'Nunito',sans-serif;
  font-size:16px;
  font-weight:600;

  color:var(--ink);

  background:transparent;
}

.search-box svg{
  width:22px;
  height:22px;

  color:var(--blue-dark);

  flex-shrink:0;
}

.search-close{
  background:none;
  border:none;

  cursor:pointer;

  margin-left:16px;

  flex-shrink:0;
}

.search-close svg{
  width:26px;
  height:26px;

  color:var(--ink);
}

.search-results-hint{
  max-width:760px;
  width:100%;

  margin:10px auto 0;

  color:var(--white);

  font-weight:700;
  font-size:14px;

  text-align:left;
}


/* =========================
   PRODUCT PAGE
========================= */

.product-page{
  max-width:1200px;

  margin:50px auto 80px;

  padding:0 40px;
}

.product-container{
  background:var(--white);

  border-radius:18px;

  padding:35px;

  display:grid;

  grid-template-columns:1fr 1fr;

  gap:55px;

  box-shadow:0 4px 14px rgba(0,0,0,0.05);
}


/* =========================
   PRODUCT IMAGE
========================= */

.product-image-area{
  width:100%;

  display:flex;
  align-items:center;
  justify-content:center;

  background:var(--blue);

  border-radius:14px;

  min-height:520px;

  padding:30px;

  overflow:hidden;
}

.product-image-area img{
  width:100%;
  height:100%;

  max-height:460px;

  object-fit:contain;
}


/* =========================
   PRODUCT DETAILS
========================= */

.product-details{
  display:flex;
  flex-direction:column;

  justify-content:center;
}

.product-category{
  font-size:14px;

  font-weight:700;

  color:var(--blue-dark);

  margin-bottom:8px;
}

.product-title{
  font-size:32px;

  line-height:1.15;

  font-weight:800;

  margin-bottom:12px;
}

.product-price{
  font-size:23px;

  font-weight:800;

  color:var(--blue-dark);

  margin-bottom:22px;
}


/* =========================
   QUANTITY
========================= */

.quantity-label{
  font-size:14px;

  font-weight:800;

  margin-bottom:9px;
}

.quantity-control{
  width:145px;
  height:42px;

  display:flex;
  align-items:center;

  border:1.5px solid var(--blue);

  border-radius:8px;

  background:var(--white);

  margin-bottom:18px;
}

.quantity-control button{
  width:42px;
  height:40px;

  border:none;

  background:transparent;

  color:var(--blue-dark);

  font-size:22px;

  font-family:'Nunito',sans-serif;

  font-weight:700;

  cursor:pointer;
}

.quantity-control button:hover{
  background:var(--cream-light);
}

.quantity-control span{
  flex:1;

  text-align:center;

  font-size:15px;

  font-weight:800;
}


/* =========================
   ADD TO CART
========================= */

.add-cart-btn{
  width:100%;

  height:46px;

  border-radius:8px;

  border:1.5px solid var(--blue);

  background:var(--white);

  color:var(--blue-dark);

  font-family:'Nunito',sans-serif;

  font-size:15px;

  font-weight:800;

  cursor:pointer;

  transition:
    background .2s ease,
    color .2s ease,
    transform .1s ease;
}

.add-cart-btn:hover{
  background:var(--blue);

  color:var(--white);
}

.add-cart-btn:active{
  transform:scale(.98);
}


/* =========================
   BUY NOW
========================= */

.buy-now-btn{
  width:100%;

  height:46px;

  border-radius:8px;

  border:none;

  background:var(--blue);

  color:var(--white);

  font-family:'Nunito',sans-serif;

  font-size:15px;

  font-weight:800;

  cursor:pointer;

  margin-top:10px;

  transition:
    background .2s ease,
    transform .1s ease;
}

.buy-now-btn:hover{
  background:var(--blue-dark);
}

.buy-now-btn:active{
  transform:scale(.98);
}

/* =========================
   CART DRAWER
========================= */

.cart-overlay{
  position:fixed;
  inset:0;
  background:rgba(0,0,0,.45);
  opacity:0;
  visibility:hidden;
  transition:.3s;
  z-index:1998;
}

.cart-overlay.show{
  opacity:1;
  visibility:visible;
}

.cart-drawer{
  position:fixed;
  top:0;
  right:-420px;
  width:400px;
  max-width:100%;
  height:100%;
  background:#fff;
  display:flex;
  flex-direction:column;
  box-shadow:-8px 0 30px rgba(0,0,0,.15);
  transition:right .35s ease;
  z-index:1999;
}

.cart-drawer.show{
  right:0;
}

.drawer-header{
  display:flex;
  justify-content:space-between;
  align-items:center;
  padding:20px;
  border-bottom:1px solid #eee;
}

.drawer-header h2{
  font-size:22px;
  color:var(--blue-dark);
}

.drawer-header button{
  border:none;
  background:none;
  font-size:32px;
  cursor:pointer;
  line-height:1;
}

.drawer-body{
  flex:1;
  overflow-y:auto;
  padding:20px;
}

.drawer-cart-item{
  display:flex;
  gap:15px;
  margin-bottom:18px;
  border-bottom:1px solid #eee;
  padding-bottom:15px;
}

.drawer-cart-item img{
  width:75px;
  height:75px;
  object-fit:contain;
  background:#F7F7F7;
  border-radius:10px;
}

.drawer-item-info{
  flex:1;
}

.drawer-item-name{
  font-weight:800;
  margin-bottom:6px;
}

.drawer-item-price{
  color:var(--blue-dark);
  font-weight:700;
}

.drawer-item-quantity{
  margin-top:8px;
  font-size:14px;
}

.drawer-footer{
  border-top:1px solid #eee;
  padding:20px;
}

.drawer-total{
  display:flex;
  justify-content:space-between;
  align-items:center;
  margin-bottom:15px;
  font-size:18px;
  font-weight:800;
}

.drawer-btn{
  width:100%;
  height:45px;
  border:none;
  border-radius:8px;
  background:var(--blue-dark);
  color:#fff;
  font-weight:700;
  cursor:pointer;
}

.drawer-btn:hover{
  background:var(--blue);
}

.drawer-empty{
  height:100%;
  display:flex;
  flex-direction:column;
  justify-content:center;
  align-items:center;
  text-align:center;
  color:#666;
}

.drawer-empty h3{
  margin-bottom:10px;
}

/* =========================
   FOOTER
========================= */

footer{
  background:var(--white);

  width:100%;

  margin-top:80px;

  padding:60px 0 30px;
}

.footer-container{
  width:90%;
  max-width:1400px;

  margin:auto;
}

.footer-grid{
  display:grid;

  grid-template-columns:
    1fr 1fr 1fr 1.4fr;

  gap:60px;

  padding-bottom:40px;

  align-items:start;
}

.footer-grid h4{
  font-weight:800;

  margin-bottom:18px;

  font-size:16px;
}

.footer-grid p,
.footer-grid a{
  display:block;

  margin-bottom:10px;

  font-size:14.5px;

  opacity:.85;

  font-weight:600;
}

.footer-grid a:hover{
  color:var(--blue-dark);

  padding-left:5px;
}

.footer-bottom{
  width:100%;

  border-top:2px solid #eee;

  margin-top:20px;

  padding-top:18px;

  text-align:center;

  font-size:14px;

  color:var(--blue-dark);

  font-weight:700;
}


/* =========================
   RESPONSIVE
========================= */

@media(max-width:900px){

  .nav-left{
    gap:20px;
  }

  .nav-links{
    display:none;
  }

  .menu-toggle{
    display:block;
  }

  .product-container{
    grid-template-columns:1fr;

    gap:30px;
  }

  .product-image-area{
    min-height:400px;
  }

  .footer-grid{
    grid-template-columns:1fr 1fr;
  }
}

@media(max-width:480px){

  .navbar,
  .product-page,
  footer{
    padding-left:20px;
    padding-right:20px;
  }

  .product-container{
    padding:20px;
  }

  .product-image-area{
    min-height:300px;
  }

  .product-title{
    font-size:27px;
  }

  .footer-grid{
    grid-template-columns:1fr;
  }
}

</style>
</head>


<body>


<!-- =========================
     NAVBAR
========================= -->

<nav class="navbar" id="navbar">
  <div class="nav-left">
    <div class="logo">
      <img src="images/logo.png" alt="FurryCorner logo">
    </div>
    <ul class="nav-links">
      <li><a href="FurryCorner.php">Home</a></li>
      <li><a href="AllProducts.php">All Products</a></li>
      <li><a href="services.php">Services</a></li>
      <li><a href="#">About</a></li>
      <li><a href="#">Contact Us</a></li>
    </ul>
  </div>
   <div class="nav-icons">
    <svg id="searchToggle" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="cursor:pointer;"><circle cx="11" cy="11" r="7"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="8" r="4"/><path d="M4 21c0-4 4-6 8-6s8 2 8 6"/></svg>
    <span class="notif-icon-wrap" id="notifToggle" style="cursor:pointer;">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 8a6 6 0 00-12 0c0 7-3 9-3 9h18s-3-2-3-9"/><path d="M13.73 21a2 2 0 01-3.46 0"/></svg>
      <span class="notif-badge" id="notifBadge" style="display:none;">0</span>
    </span>

     <a href="javascript:void(0)"
        class="cart-link"
        id="cartToggle">

      <span
        class="cart-icon-wrap">
        <svg
          viewBox="0 0 24 24"
          fill="none"
          stroke="currentColor"
          stroke-width="2">
          <circle
            cx="9"
            cy="21"
            r="1"/>
          <circle
            cx="20"
            cy="21"
            r="1"/>
          <path
            d="M1 1h4l2.6 13.4a2 2 0 002 1.6h9.7a2 2 0 002-1.6L23 6H6"/>
        </svg>
        <span
          class="cart-badge"
          id="cartBadge"
          style="display:none;">
          0
        </span>
      </span>
    </a>
    
    <button class="menu-toggle" aria-label="Menu">
      <svg viewBox="0 0 24 24" width="26" height="26" fill="none" stroke="currentColor" stroke-width="2"><line x1="3" y1="6" x2="21" y2="6"/><line x1="3" y1="12" x2="21" y2="12"/><line x1="3" y1="18" x2="21" y2="18"/></svg>
    </button>
  </div>
</nav>

    <!-- MENU -->

    <button
      class="menu-toggle"
      aria-label="Menu">

      <svg
        viewBox="0 0 24 24"
        width="26"
        height="26"
        fill="none"
        stroke="currentColor"
        stroke-width="2">

        <line
          x1="3"
          y1="6"
          x2="21"
          y2="6"/>

        <line
          x1="3"
          y1="12"
          x2="21"
          y2="12"/>

        <line
          x1="3"
          y1="18"
          x2="21"
          y2="18"/>

      </svg>

    </button>

  </div>

</nav>


<!-- =========================
     SEARCH OVERLAY
========================= -->

<div
  class="search-overlay"
  id="searchOverlay">

  <div style="width:100%;max-width:760px;">

    <div class="search-box">

      <svg
        viewBox="0 0 24 24"
        fill="none"
        stroke="currentColor"
        stroke-width="2">

        <circle
          cx="11"
          cy="11"
          r="7"/>

        <line
          x1="21"
          y1="21"
          x2="16.65"
          y2="16.65"/>

      </svg>

      <input
        type="text"
        id="searchInput"
        placeholder="Search"
        autocomplete="off">

      <button
        class="search-close"
        id="searchClose"
        aria-label="Close search">

        <svg
          viewBox="0 0 24 24"
          fill="none"
          stroke="currentColor"
          stroke-width="2">

          <line
            x1="18"
            y1="6"
            x2="6"
            y2="18"/>

          <line
            x1="6"
            y1="6"
            x2="18"
            y2="18"/>

        </svg>

      </button>

    </div>

    <div
      class="search-results-hint"
      id="searchHint">
    </div>

  </div>

</div>

<div class="cart-overlay" id="cartOverlay"></div>

<div class="cart-drawer" id="cartDrawer">

    <div class="drawer-header">
        <h2>Shopping Cart</h2>

        <button id="closeDrawer">
            &times;
        </button>
    </div>

    <div
        class="drawer-body"
        id="cartDrawerBody">

    </div>

    <div class="drawer-footer">

        <div class="drawer-total">

            <span>Total</span>

            <strong id="drawerTotal">
                ₱0.00
            </strong>

        </div>

        <button
            class="drawer-btn"
            onclick="location.href='cart.php'">

            View Cart

        </button>

    </div>

</div>


<!-- =========================
     PRODUCT
========================= -->

<main>

  <section class="product-page">

    <div class="product-container">

      <!-- PRODUCT IMAGE -->

      <div class="product-image-area">

        <img
          id="productImage"
          src=""
          alt="Product">

      </div>


      <!-- PRODUCT DETAILS -->

      <div class="product-details">

        <div
          class="product-category"
          id="productCategory">
        </div>

        <h1
          class="product-title"
          id="productName">
        </h1>

        <div
          class="product-price"
          id="productPrice">
        </div>

        <!-- QUANTITY -->

        <div class="quantity-label">
          Quantity
        </div>

        <div class="quantity-control">

          <button
            type="button"
            id="minusBtn">
            −
          </button>

          <span id="quantity">
            1
          </span>

          <button
            type="button"
            id="plusBtn">
            +
          </button>

        </div>


        <!-- ADD TO CART -->

        <button
          type="button"
          class="add-cart-btn"
          id="addCartBtn">

          Add to Cart

        </button>


        <!-- BUY NOW -->

        <button
          type="button"
          class="buy-now-btn"
          id="buyNowBtn">

          Buy Now

        </button>

  </section>

</main>


<!-- =========================
     FOOTER
========================= -->

<footer>

  <div class="container">

    <div class="footer-grid">

      <div>

        <h4>
          Menu
        </h4>

        <a href="#">
          Terms &amp; Conditions
        </a>

        <a href="#">
          Privacy Policy
        </a>

        <a href="#">
          FAQs
        </a>

      </div>


      <div>

        <h4>
          FurryCorner PH
        </h4>

        <a href="#">
          About Us
        </a>

      </div>


      <div>

        <h4>
          Shop
        </h4>

        <a href="#">
          Foods
        </a>

        <a href="#">
          Accessories
        </a>

        <a href="#">
          Services
        </a>

      </div>


      <div>

        <h4>
          Contact Information
        </h4>

        <p>
          Phone Number:
        </p>

        <p>
          091234567
        </p>

        <p>
          Email Inquiries:
        </p>

        <p>
          FurryCorner@gmail.com
        </p>

      </div>

    </div>


    <div class="footer-bottom">

      2026, FurryCorner PH

    </div>

  </div>

</footer>

<script>
const product = <?php echo json_encode([
    "id" => (int)$product["product_id"],
    "name" => $product["product_name"],
    "category" => $product["category"],
    "subcategory" => $product["subcategory"],
    "price" => (float)$product["price"],
    "stock" => (int)$product["stock"]
]); ?>;
</script>

<script>


/* =========================
   NAVBAR SCROLL
========================= */

const navbar =
  document.getElementById('navbar');

window.addEventListener('scroll', () => {

  navbar.classList.toggle(
    'scrolled',
    window.scrollY > 10
  );

});


/* =========================
   PRODUCT ELEMENTS
========================= */

const productImage =
  document.getElementById(
    'productImage'
  );

const productName =
  document.getElementById(
    'productName'
  );

const productCategory =
  document.getElementById(
    'productCategory'
  );

const productPrice =
  document.getElementById(
    'productPrice'
  );


const quantityDisplay =
  document.getElementById(
    'quantity'
  );


/* =========================
   PRICE FORMAT
========================= */

function peso(number){

  return '₱' +
    number.toLocaleString(
      'en-PH',
      {
        minimumFractionDigits:2
      }
    );

}


/* =========================
   LOAD PRODUCT
========================= */

if(product){

  productName.textContent =
    product.name;

  productCategory.textContent =
    product.category +
    ' • ' +
    product.subcategory;

  productPrice.textContent =
    peso(product.price);

  productImage.src =
    `images/product-${product.id}.png`;

  productImage.alt =
    product.name;

}else{

  productName.textContent =
    'Product Not Found';

  productPrice.textContent =
    '';

  productImage.style.display =
    'none';

}


/* =========================
   QUANTITY
========================= */

let quantity = 1;


document
  .getElementById('minusBtn')
  .addEventListener(
    'click',
    () => {

      if(quantity > 1){

        quantity--;

        quantityDisplay.textContent =
          quantity;

      }

    }
  );


document
  .getElementById('plusBtn')
  .addEventListener(
    'click',
    () => {

      quantity++;

      quantityDisplay.textContent =
        quantity;

    }
  );

  /* =========================
   CART DRAWER
========================= */

const cartDrawer =
document.getElementById("cartDrawer");

const cartOverlay =
document.getElementById("cartOverlay");

const cartDrawerBody =
document.getElementById("cartDrawerBody");

const drawerTotal =
document.getElementById("drawerTotal");

const cartToggle =
document.getElementById("cartToggle");

const closeDrawer =
document.getElementById("closeDrawer");

function renderCartDrawer() {

    const cart = JSON.parse(localStorage.getItem("cart")) || [];

    const cartDrawerBody = document.getElementById("cartDrawerBody");
    const drawerTotal = document.getElementById("drawerTotal");

    if (cart.length === 0) {

        cartDrawerBody.innerHTML = `
            <div class="drawer-empty">
                <h3>Your cart is empty</h3>
                <p>Add some products first.</p>
            </div>
        `;

        drawerTotal.textContent = "₱0.00";
        return;
    }

    let total = 0;

    cartDrawerBody.innerHTML = cart.map(item => {

        total += item.price * item.quantity;

        return `
            <div class="drawer-cart-item">

                <img src="images/product-${item.id}.png">

                <div class="drawer-item-info">

                    <div class="drawer-item-name">
                        ${item.name}
                    </div>

                    <div class="drawer-item-price">
                        ₱${item.price.toFixed(2)}
                    </div>

                    <div class="drawer-item-quantity">
                        Qty: ${item.quantity}
                    </div>

                </div>

            </div>
        `;

    }).join("");

    drawerTotal.textContent = "₱" + total.toFixed(2);

}

function openDrawer(){

    renderCartDrawer();

    document.getElementById("cartDrawer").classList.add("show");

    document.getElementById("cartOverlay").classList.add("show");

}

function closeCartDrawer(){

    document.getElementById("cartDrawer").classList.remove("show");

    document.getElementById("cartOverlay").classList.remove("show");

}

cartToggle.addEventListener(
"click",
openDrawer
);

closeDrawer.addEventListener(
"click",
closeCartDrawer
);

cartOverlay.addEventListener(
"click",
closeCartDrawer
);

/* =========================
   ADD TO CART
========================= */

document
  .getElementById('addCartBtn')
  .addEventListener(
    'click',
    () => {

      if(!product){
        return;
      }


      let cart =
        JSON.parse(
          localStorage.getItem('cart')
        ) || [];


      const existingItem =
        cart.find(
          item =>
            item.id === product.id
        );


      if(existingItem){

        existingItem.quantity +=
          quantity;

      }else{

        cart.push({

          id:product.id,

          name:product.name,

          price:product.price,

          quantity:quantity

        });

      }


      localStorage.setItem(
      'cart',
      JSON.stringify(cart)
      );

      updateCartBadge();

      renderCartDrawer();

      openDrawer();

      /*
        NO ALERT
        NO LEFT POPUP
        NO RIGHT POPUP
      */

    }
  );


/* =========================
   BUY NOW
========================= */

document
  .getElementById('buyNowBtn')
  .addEventListener(
    'click',
    () => {

      if(!product){
        return;
      }


      let cart =
        JSON.parse(
          localStorage.getItem('cart')
        ) || [];


      const existingItem =
        cart.find(
          item =>
            item.id === product.id
        );


      if(existingItem){

        existingItem.quantity +=
          quantity;

      }else{

        cart.push({

          id:product.id,

          name:product.name,

          price:product.price,

          quantity:quantity

        });

      }


      localStorage.setItem(
        'cart',
        JSON.stringify(cart)
      );


      /*
        DIRECTLY GO TO CART PAGE
      */

      window.location.href =
        'cart.php';

    }
  );


/* =========================
   UPDATE CART BADGE
========================= */

function updateCartBadge(){

  const cart =
    JSON.parse(
      localStorage.getItem('cart')
    ) || [];


  const totalItems =
    cart.reduce(
      (total,item) =>
        total + item.quantity,
      0
    );


  const badge =
    document.getElementById(
      'cartBadge'
    );


  if(totalItems > 0){

    badge.textContent =
      totalItems;

    badge.style.display =
      'flex';

  }else{

    badge.style.display =
      'none';

  }

}


updateCartBadge();


/* =========================
   SEARCH
========================= */

const searchToggle =
  document.getElementById(
    'searchToggle'
  );

const searchOverlay =
  document.getElementById(
    'searchOverlay'
  );

const searchInput =
  document.getElementById(
    'searchInput'
  );

const searchClose =
  document.getElementById(
    'searchClose'
  );


function openSearch(){

  searchOverlay.classList.add(
    'open'
  );

  setTimeout(
    () =>
      searchInput.focus(),
    50
  );

}


function closeSearch(){

  searchOverlay.classList.remove(
    'open'
  );

}


searchToggle.addEventListener(
  'click',
  openSearch
);


searchClose.addEventListener(
  'click',
  closeSearch
);


searchOverlay.addEventListener(
  'click',
  (event) => {

    if(
      event.target ===
      searchOverlay
    ){

      closeSearch();

    }

  }
);


searchInput.addEventListener(
  'keydown',
  (event) => {

    if(event.key === 'Enter'){

      const query =
        searchInput.value
          .trim()
          .toLowerCase();


      if(query){

        window.location.href =
          `products.php?search=${encodeURIComponent(query)}`;

      }

    }

  }
);


document.addEventListener(
  'keydown',
  (event) => {

    if(
      event.key === 'Escape' &&
      searchOverlay.classList.contains(
        'open'
      )
    ){

      closeSearch();

    }

  }
);

</script>

</body>
</html>
<?php
include "db.php";

$sql = "SELECT * FROM services ORDER BY service_id";
$result = mysqli_query($conn, $sql);

$services = [];

while ($row = mysqli_fetch_assoc($result)) {
    $services[] = [
        "id" => $row["service_id"],
        "category" => $row["category"],
        "name" => $row["service_name"],
        "price" => $row["price"],
        "image" => $row["image"],
        "status" => $row["status"],
        "duration" => $row["duration"]
    ];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Services - FurryCorner PH</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Baloo+2:wght@500;600;700;800&family=Nunito:wght@400;600;700;800&display=swap" rel="stylesheet">
<style>
  :root{
    --blue: #7BB8F0;
    --blue-dark: #5CA3E8;
    --cream: #FCE3C0;
    --cream-light: #FDEEDA;
    --ink: #1F2430;
    --white: #ffffff;
    --border: #e2e6ec;
    --muted: #9aa1ad;
  }

    *{ box-sizing: border-box; margin:0; padding:0; }
    html{ scroll-behavior: smooth; }

    body{
      font-family:'Nunito', sans-serif;
      color: var(--ink);
      background:#fff;
      line-height:1.5;
    }

    h1,h2,h3{ font-family:'Baloo 2', cursive; }
    a{ text-decoration:none; color:inherit; }
    img{ max-width:100%; display:block; }

    .container{
      max-width: 1200px;
      margin: 0 auto;
      padding: 0 40px;
    }

    .navbar{
      position: sticky;
      top: 0; left: 0; right: 0;
      z-index: 1000;
      background: var(--white);
      display:flex;
      align-items:center;
      justify-content:space-between;
      padding: 14px 40px;
      box-shadow: 0 2px 0 rgba(0,0,0,0.04);
      transition: box-shadow .25s ease, padding .25s ease;
    }
    .navbar.scrolled{ 
      box-shadow: 0 6px 18px rgba(0,0,0,0.10); 
      padding: 10px 40px; 
    }

    .nav-left{ 
      display:flex; 
      align-items:center; 
      gap: 44px; 
    }

    .logo{ 
      display:flex; 
      align-items:center; 
      gap:8px; 
      font-weight:700; 
      font-size: 14px; 
      color: var(--blue-dark); 
    }

    .logo img{ 
      width:38px; 
      height:38px; 
      object-fit:contain; 
    }

    .nav-links{ 
      display:flex; 
      align-items:center; 
      gap: 32px; 
      list-style:none; 
      font-weight:700; 
      font-size: 15px; 
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

    .nav-links li a.current{ 
      opacity:1; 
      color:var(--blue-dark); 
    }

    .nav-icons{
      display:flex;
      align-items:center;
      justify-content:center;
      gap:22px;
      height:38px;
    }


    .nav-icons > a,
    .nav-icons > span,
    .nav-icons > button{
      display:flex;
      align-items:center;
      justify-content:center;
      height:38px;
    }


    .nav-icons svg{
      width:22px;
      height:22px;
      display:block;
      cursor:pointer;
    }



    .cart-icon-wrap{
      position:relative;
      display:flex;
      align-items:center;
      justify-content:center;
      width:22px;
      height:22px;
      cursor:pointer;
    }

    .cart-icon-wrap svg{
      width:22px;
      height:22px;
    }

    .cart-badge{
    position:absolute;
    top:-9px;
    right:-10px;

    min-width:18px;
    height:18px;

    padding:0 4px;

    display:none;
    align-items:center;
    justify-content:center;

    border-radius:50%;

    background:var(--blue-dark);
    color:#fff;

    font-size:10px;
    font-weight:800;
    line-height:1;

    border:2px solid var(--white);
    }

  .search-overlay{
      position:fixed;
      inset:0;
      background:rgba(123,184,240,.55);
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
      background:#fff;
      width:100%;
      max-width:760px;
      border-radius:12px;
      border:2px solid var(--blue);
      display:flex;
      align-items:center;
      gap:14px;
      padding:14px 20px;
      box-shadow:0 12px 30px rgba(0,0,0,.15);
  }

  .search-box input{
      flex:1;
      border:none;
      outline:none;
      background:transparent;
      font-size:16px;
      font-family:'Nunito',sans-serif;
      font-weight:600;
  }

  .search-box svg{
      width:22px;
      height:22px;
      color:var(--blue-dark);
  }

  .search-close{
      background:none;
      border:none;
      cursor:pointer;
  }

  .search-close svg{
      width:24px;
      height:24px;
  }

  .search-results-hint{
      text-align:center;
      color:#fff;
      margin-top:14px;
      font-weight:700;
  }

  .services-section{
    padding: 70px 40px 90px;
  }

  .services-section h2{
    font-size: 32px;
    font-weight: 800;
    text-align:center;
    margin-bottom: 8px;
  }

  .services-section .sub{
    text-align:center;
    font-weight:600;
    color: var(--muted);
    margin-bottom: 40px;
  }

  .tab-bar{
    display:flex;
    justify-content:center;
    gap: 12px;
    margin-bottom: 44px;
    flex-wrap: wrap;
  }

  .tab-btn{
    padding: 12px 26px;
    border-radius: 999px;
    border: 1.5px solid var(--border);
    background: var(--white);
    font-family:'Nunito', sans-serif;
    font-weight: 800;
    font-size: 14.5px;
    color: var(--ink);
    cursor:pointer;
    transition: background .2s ease, border-color .2s ease, color .2s ease;
  }
  .tab-btn:hover{ 
    border-color: var(--blue); 
  }

  .tab-btn.active{
    background: var(--blue);
    border-color: var(--blue);
    color: var(--white);
  }

  .service-grid{
    display:grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 24px;
  }

  .service-grid.hidden{ display:none; }

  .service-card{
    background: var(--white);
    border: 1.5px solid var(--border);
    border-radius: 16px;
    overflow:hidden;
    display:flex;
    flex-direction:column;
    transition: transform .2s ease, box-shadow .2s ease;
  }
  .service-card:hover{
    transform: translateY(-4px);
    box-shadow: 0 10px 24px rgba(0,0,0,0.08);
  }
  .service-card.inactive{
    opacity: 0.55;
    filter: grayscale(40%);
  }

  .service-book-btn[disabled]{
    background: #cfd6e0;
    color: #7a8594;
    cursor: not-allowed;
  }

  .service-thumb{
    background: var(--cream-light);
    aspect-ratio: 4/3;
    overflow:hidden;
  }

  .service-thumb img{ 
    width:100%; 
    height:100%; 
    object-fit:cover; 
  }

  .service-body{
    padding: 18px 20px 20px;
    display:flex;
    flex-direction:column;
    gap: 6px;
    flex:1;
  }

  .service-name{
    font-size: 16.5px;
    font-weight: 800;
  }

  .service-price{
    font-size: 14.5px;
    font-weight: 700;
    color: var(--blue-dark);
    margin-bottom: 10px;
  }

  .service-book-btn{
    margin-top:auto;
    width: 100%;
    height: 42px;
    border-radius: 8px;
    border:none;
    background: var(--blue);
    color: var(--white);
    font-family:'Nunito', sans-serif;
    font-weight: 800;
    font-size: 14.5px;
    cursor:pointer;
    transition: background .2s ease;
  }

  .service-book-btn:hover{ 
    background: var(--blue-dark); 
  }

  .booking-backdrop{
    position: fixed;
    inset: 0;
    background: rgba(31,36,48,0.5);
    z-index: 3000;
    display:none;
    align-items:center;
    justify-content:center;
    padding: 20px;
  }
  .booking-backdrop.open{ display:flex; }

  .booking-modal{
    background: var(--white);
    width: 100%;
    max-width: 460px;
    border-radius: 16px;
    padding: 30px 30px 28px;
    box-shadow: 0 24px 60px rgba(0,0,0,0.25);
    max-height: 90vh;
    overflow-y:auto;
  }

  .booking-header{
    display:flex;
    align-items:flex-start;
    justify-content:space-between;
    gap: 12px;
    margin-bottom: 20px;
  }

  .booking-service-info{
    display:flex;
    align-items:center;
    gap: 14px;
  }
  .booking-service-thumb{
    width: 56px; height: 56px;
    border-radius: 10px;
    overflow:hidden;
    background: var(--cream-light);
    flex-shrink:0;
  }

  .booking-service-thumb img{ 
    width:100%; 
    height:100%; 
    object-fit:cover; 
  }

  .booking-service-name{ 
    font-weight: 800; 
    font-size: 16px; 
  }

  .booking-service-price{ 
    font-weight: 700; 
    font-size: 13.5px; 
    color: var(--blue-dark); 
  }

  .booking-close{
    background:none; 
    border:none; 
    cursor:pointer;
    flex-shrink:0;
  }

  .booking-close svg{ 
    width: 22px; 
    height:22px; 
    color: var(--ink); }

  .booking-label{
    font-size: 12px;
    font-weight: 800;
    color: var(--muted);
    text-transform: uppercase;
    letter-spacing: .03em;
    margin-bottom: 8px;
    display:block;
  }

  .booking-field{
    width: 100%;
    padding: 13px 16px;
    border: 1.5px solid var(--border);
    border-radius: 8px;
    font-family:'Nunito', sans-serif;
    font-size: 14.5px;
    font-weight: 600;
    color: var(--ink);
    outline:none;
    margin-bottom: 18px;
  }

  .booking-field:focus{ 
    border-color: var(--blue); 
  }

  .time-slots{
    display:grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 10px;
    margin-bottom: 18px;
  }
  .time-slot{
    padding: 10px 6px;
    border-radius: 8px;
    border: 1.5px solid var(--border);
    background: var(--white);
    font-family:'Nunito', sans-serif;
    font-weight: 700;
    font-size: 13px;
    cursor:pointer;
    text-align:center;
    transition: background .2s ease, border-color .2s ease, color .2s ease;
  }

  .time-slot:hover{ 
    border-color: var(--blue); 
  }

  .time-slot.active{
    background: var(--cream-light);
    border-color: var(--blue);
    color: var(--blue-dark);
  }

  .booking-submit{
    width: 100%;
    height: 50px;
    border-radius: 10px;
    border:none;
    background: var(--blue);
    color: var(--white);
    font-family:'Nunito', sans-serif;
    font-weight: 800;
    font-size: 15.5px;
    cursor:pointer;
    margin-top: 4px;
    transition: background .2s ease;
  }

  .booking-submit:hover{ 
    background: var(--blue-dark); 
  }

  .booking-submit:disabled{ 
    background: #cbd2db; cursor:not-allowed; 
  }

  .booking-note{
    font-size: 12.5px;
    color: var(--muted);
    font-weight:600;
    margin-top: 12px;
    text-align:center;
  }

  .booking-confirmed{
    text-align:center;
    padding: 10px 0 6px;
  }
  .booking-confirmed svg{
    width: 56px; height:56px;
    color: #3fb27f;
    margin: 0 auto 16px;
  }

  .booking-confirmed h3{ 
    font-size: 20px; 
    margin-bottom: 8px; 
  }
  .booking-confirmed p{ 
    font-size: 14.5px; 
    color: var(--muted); 
    font-weight:600; 
    margin-bottom: 4px; 
  }

  .booking-confirmed .summary{
    background: var(--cream-light);
    border-radius: 10px;
    padding: 14px 16px;
    margin: 18px 0;
    text-align:left;
    font-size: 14px;
    font-weight: 700;
  }

  .booking-confirmed .summary div{ 
    margin-bottom: 4px; 
  }

  .booking-done-btn{
    width: 100%;
    height: 48px;
    border-radius: 10px;
    border:none;
    background: var(--blue);
    color: var(--white);
    font-family:'Nunito', sans-serif;
    font-weight: 800;
    font-size: 15px;
    cursor:pointer;
  }

  .booking-done-btn:hover{ 
    background: var(--blue-dark); 
  }

  footer{ padding: 60px 40px 30px; }
  .footer-grid{ display:grid; grid-template-columns: repeat(4, 1fr); gap: 30px; padding-bottom: 40px; }
  .footer-grid h4{ font-weight: 800; margin-bottom: 16px; font-size: 16px; }
  .footer-grid p, .footer-grid a{ display:block; margin-bottom: 10px; font-size: 14.5px; opacity: .85; font-weight:600; }
  .footer-bottom{ border-top: 1px solid rgba(0,0,0,0.08); padding-top: 20px; text-align:center; font-size: 13px; color: var(--blue-dark); font-weight:700; }

    .notif-icon-wrap{ position: relative; display:inline-flex; }
  .notif-badge{
    position: absolute;
    top: -8px; right: -9px;
    background: #e0685f;
    color: #fff;
    font-size: 10.5px;
    font-weight: 800;
    width: 17px; height: 17px;
    border-radius: 50%;
    display:flex; align-items:center; justify-content:center;
  }
 
  .notif-dropdown{
    position: fixed;
    top: 68px;
    right: 40px;
    width: 100%;
    max-width: 380px;
    max-height: 480px;
    background: var(--white);
    border-radius: 14px;
    box-shadow: 0 20px 50px rgba(0,0,0,0.18);
    z-index: 3200;
    display: none;
    flex-direction: column;
    overflow: hidden;
  }
  .notif-dropdown.open{ display:flex; }
 
  .notif-header{
    display:flex;
    align-items:center;
    justify-content:space-between;
    padding: 18px 20px;
    border-bottom: 1px solid #eee;
  }
  .notif-header h3{ font-family:'Baloo 2', cursive; font-size: 17px; }
  .notif-mark-read{
    background:none; border:none; cursor:pointer;
    font-size: 12.5px; font-weight: 800;
    color: var(--blue-dark);
    text-decoration: underline;
  }
 
  .notif-list{ overflow-y: auto; flex: 1; }
 
  .notif-item{
    display:flex;
    gap: 12px;
    padding: 14px 20px;
    border-bottom: 1px solid #f2f2f2;
    position: relative;
  }
  .notif-item.unread{ background: var(--cream-light); }
 
  .notif-icon{
    width: 38px; height: 38px;
    border-radius: 50%;
    flex-shrink:0;
    display:flex; align-items:center; justify-content:center;
  }
  .notif-icon.payment{ background: #e5f5ec; color: #2f9e63; }
  .notif-icon.booking{ background: #e8f1fd; color: var(--blue-dark); }
  .notif-icon svg{ width: 19px; height:19px; }
 
  .notif-body{ flex:1; }
  .notif-title{ font-weight: 800; font-size: 13.5px; margin-bottom: 3px; }
  .notif-message{ font-size: 13px; color: #55606e; font-weight:600; line-height:1.4; }
  .notif-time{ font-size: 11.5px; color: var(--muted, #9aa1ad); font-weight:700; margin-top: 5px; }
 
  .notif-unread-dot{
    width: 8px; height: 8px;
    border-radius: 50%;
    background: var(--blue-dark);
    flex-shrink:0;
    margin-top: 6px;
  }
 
  .notif-empty{
    text-align:center;
    padding: 50px 20px;
    color: var(--muted, #9aa1ad);
    font-weight:700;
  }

  @media (max-width: 900px){
    .nav-left{ gap: 20px; }
    .nav-links{ display:none; }
    .hero{ flex-direction:column; text-align:center; padding: 60px 24px; min-height:auto; }
    .hero-text{ max-width:100%; }
    .hero-text p{ margin-left:auto; margin-right:auto; }
    .hero-art img{ width: 320px; }
    .service-grid{ grid-template-columns: repeat(2, 1fr); }
    .footer-grid{ grid-template-columns: 1fr 1fr; }
  }
  @media (max-width: 480px){
    .container, .navbar, .services-section, footer{ padding-left:20px; padding-right:20px; }
    .service-grid{ grid-template-columns: 1fr; }
    .footer-grid{ grid-template-columns: 1fr; }
    .time-slots{ grid-template-columns: repeat(2, 1fr); }
  }
</style>
</style>
<script src="shared-order.js"></script>
</head>
<body>

<nav class="navbar" id="navbar">
  <div class="nav-left">
    <div class="logo">
      <img src="images/logo.png" alt="FurryCorner logo">
    </div>
    <ul class="nav-links">
      <li><a href="FurryCorner.php">Home</a></li>
      <li><a href="AllProducts.php">All Products</a></li>
      <li><a href="services.php" class="current">Services</a></li>
      <li><a href="#">About</a></li>
      <li><a href="#">Contact Us</a></li>
    </ul>
  </div>
  <div class="nav-icons">
    <svg id="searchToggle" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="cursor:pointer;"><circle cx="11" cy="11" r="7"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
    
    <a href="signin.php">
      <svg viewBox="0 0 24 24" 
      fill="none" 
      stroke="currentColor" 
      stroke-width="2">
      <circle cx="12" cy="8" r="4"/><path d="M4 21c0-4 4-6 8-6s8 2 8 6"/>
      </svg>
    </a>

    <span class="notif-icon-wrap" id="notifToggle" style="cursor:pointer;">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 8a6 6 0 00-12 0c0 7-3 9-3 9h18s-3-2-3-9"/><path d="M13.73 21a2 2 0 01-3.46 0"/></svg>
      <span class="notif-badge" id="notifBadge" style="display:none;">0</span>
    </span>
    
   <a href="cart.php" class="cart-icon-wrap" id="cartToggle">
      <svg viewBox="0 0 24 24"
           fill="none"
           stroke="currentColor"
           stroke-width="2">
        <circle cx="9" cy="21" r="1"/>
        <circle cx="20" cy="21" r="1"/>
        <path d="M1 1h4l2.6 13.4a2 2 0 002 1.6h9.7a2 2 0 002-1.6L23 6H6"/>
      </svg>
      <!-- CART NOTIFICATION -->
      <span class="cart-badge" id="cartBadge">0</span>
    </a>
  </div>
</nav>

<div class="notif-dropdown" id="notifDropdown">
  <div class="notif-header">
    <h3>Notifications</h3>
    <button class="notif-mark-read" id="notifMarkAllRead">Mark all as read</button>
  </div>
  <div class="notif-list" id="notifList"></div>
</div>

<div class="search-overlay" id="searchOverlay">
  <div style="width:100%;max-width:760px;">
    <div class="search-box">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="7"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
      <input type="text" id="searchInput" placeholder="Search" autocomplete="off">
      <button class="search-close" id="searchClose" aria-label="Close search">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
      </button>
    </div>
    <div class="search-results-hint" id="searchHint"></div>
  </div>
</div>
 
<section class="services-section" id="services">
  <div class="container">
    <h2>Our Services</h2>
    <p class="sub">Choose a category, pick a service, and book a date that works for you.</p>

    <div class="tab-bar" id="tabBar">
      <button class="tab-btn active" data-category="Grooming">Grooming</button>
      <button class="tab-btn" data-category="Care">Care</button>
      <button class="tab-btn" data-category="Boarding">Boarding</button>
    </div>

    <div id="serviceGridContainer"></div>
  </div>
</section>

<div class="booking-backdrop" id="bookingBackdrop">
  <div class="booking-modal" id="bookingModal"></div>
</div>

<footer>
  <div class="container">
    <div class="footer-grid">
      <div>
        <h4>Menu</h4>
        <a href="#">Terms &amp; Conditions</a>
        <a href="#">Privacy Policy</a>
        <a href="#">FAQs</a>
      </div>
      <div>
        <h4>FurryCorner PH</h4>
        <a href="#">About Us</a>
      </div>
      <div>
        <h4>Shop</h4>
        <a href="AllProducts.php">Foods</a>
        <a href="AllProducts.php">Accessories</a>
        <a href="services.php">Services</a>
      </div>
      <div>
        <h4>Contact Information</h4>
        <p>Phone Number:</p>
        <p>091234567</p>
        <p>Email Inquiries:</p>
        <p>FurryCorner@gmail.com</p>
      </div>
    </div>
    <div class="footer-bottom">2026, FurryCorner PH</div>
  </div>
</footer>

<script>
  const nav = document.getElementById('navbar');

window.addEventListener('scroll', () => {

  nav.classList.toggle(
    'scrolled',
    window.scrollY > 10
  );

});

let services = [];


fetch("getServices.php")

.then(response => response.json())

.then(data => {

    services = data;

    renderServiceGrids();

})

.catch(error => {

    console.error("Error loading services:", error);

});

/* =========================================================
   CART NOTIFICATION
   Reads the SAME localStorage cart used by your cart.php
   and product.php.
========================================================= */

const cartBadge = document.getElementById('cartBadge');


function getCart(){

  try{

    const savedCart = localStorage.getItem('cart');

    if(!savedCart){
      return [];
    }

    const parsedCart = JSON.parse(savedCart);

    return Array.isArray(parsedCart)
      ? parsedCart
      : [];

  }catch(error){

    console.error('Unable to read cart:', error);

    return [];

  }

}


function updateCartBadge(){

  const cart = getCart();

  /*
    Counts quantities.

    Example:

    Product A quantity = 2
    Product B quantity = 1

    Badge = 3
  */

  const totalQuantity = cart.reduce((total, item) => {

    const quantity =
      Number(item.quantity) || 1;

    return total + quantity;

  }, 0);


  if(totalQuantity > 0){

    cartBadge.textContent =
      totalQuantity > 99
        ? '99+'
        : totalQuantity;

    cartBadge.style.display = 'flex';

  }else{

    cartBadge.style.display = 'none';

  }

}


/*
  Update when this page first opens.
*/
updateCartBadge();


/*
  Update when the cart changes in another browser tab.
*/
window.addEventListener('storage', function(event){

  if(event.key === 'cart'){

    updateCartBadge();

  }

});


/*
  Also check periodically.

  This helps when product.php changes localStorage
  while this page is already open in the same tab.
*/
setInterval(updateCartBadge, 500);


const CATEGORIES = [
  'Grooming',
  'Care',
  'Boarding'
];


const serviceGridContainer =
  document.getElementById('serviceGridContainer');

const tabBar =
  document.getElementById('tabBar');

let searchQuery = "";


/* =========================================================
   RENDER SERVICES
========================================================= */

function renderServiceGrids(){

  serviceGridContainer.innerHTML =

    CATEGORIES.map(cat => {

      const items = services.filter(service => {

        return service.category === cat &&
               service.name
                 .toLowerCase()
                 .includes(searchQuery);

      });


      return `

        <div class="service-grid ${cat === 'Grooming' ? '' : 'hidden'}"
             data-category-grid="${cat}">

          ${
            items.length

            ?

            items.map(s => {
              const active = !(s.status && s.status.toLowerCase() === 'inactive');
              return `
              <div class="service-card ${active ? '' : 'inactive'}">

                <div class="service-thumb">

                  <img
                    src="${s.image}"
                    alt="${s.name}"
                  >

                </div>

                <div class="service-body">

                  <div class="service-name">
                    ${s.name}
                  </div>

                        <div class="service-price">
                          ${(function(){
                            const raw = String(s.price || '').replace(/(&#8369;|₱|â‚±)/g, '').trim();
                            if (!raw) return '';
                            if (raw.includes('-')) return '\u20B1' + raw;
                            const n = Number(raw);
                            if (!isNaN(n)) return '\u20B1' + n.toLocaleString('en-PH', { minimumFractionDigits: 2 });
                            return raw;
                          })()}
                        </div>

                  <button
                    class="service-book-btn"
                    data-id="${s.id}"
                    ${active ? '' : 'disabled'}>
                    ${active ? 'Book Now' : 'Unavailable'}
                  </button>

                </div>

              </div>
            `}).join("")

            :

            `
              <p style="grid-column:1/-1;text-align:center;font-weight:bold;">
                No services found.
              </p>
            `
          }

        </div>

      `;

    }).join("");

}


renderServiceGrids();


/* =========================================================
   CATEGORY TABS
========================================================= */

tabBar.addEventListener('click', (e) => {

  const btn =
    e.target.closest('.tab-btn');

  if(!btn) return;


  document
    .querySelectorAll('.tab-btn')
    .forEach(b =>
      b.classList.remove('active')
    );


  btn.classList.add('active');


  const cat =
    btn.dataset.category;


  document
    .querySelectorAll('.service-grid')
    .forEach(grid => {

      grid.classList.toggle(
        'hidden',
        grid.dataset.categoryGrid !== cat
      );

    });

});


/* =========================================================
   BOOKING MODAL
========================================================= */

const bookingBackdrop =
  document.getElementById('bookingBackdrop');

const bookingModal =
  document.getElementById('bookingModal');

console.log("serviceGridContainer:", serviceGridContainer);
console.log("bookingBackdrop:", bookingBackdrop);
console.log("bookingModal:", bookingModal);

let selectedTime = '';


function todayISO(){

  const d = new Date();

  return d.toISOString().split('T')[0];

}


function renderBookingForm(service){

console.log("renderBookingForm started");

  selectedTime = '';


  bookingModal.innerHTML = `

    <div class="booking-header">

      <div class="booking-service-info">

        <div class="booking-service-thumb">

          <img
            src="${service.image}"
            alt="${service.name}"
          >

        </div>

        <div>

          <div class="booking-service-name">
            ${service.name}
          </div>

          <div class="booking-service-price">
            ${service.price}
          </div>

        </div>

      </div>

      <button
        class="booking-close"
        id="bookingCloseBtn"
        aria-label="Close">

        <svg
          viewBox="0 0 24 24"
          fill="none"
          stroke="currentColor"
          stroke-width="2">

          <line x1="18" y1="6" x2="6" y2="18"/>
          <line x1="6" y1="6" x2="18" y2="18"/>

        </svg>

      </button>

    </div>


    <label class="booking-label">
      Pet name
    </label>

    <input
      class="booking-field"
      type="text"
      id="petNameField"
      placeholder="e.g. Bella"
    >


    <label class="booking-label">
      Choose a date
    </label>

    <input
      class="booking-field"
      type="date"
      id="bookingDateField"
      min="${todayISO()}"
    >


    <label class="booking-label">
      Choose a time
    </label>

    <div class="time-slots" id="timeSlots">

      <button class="time-slot" data-time="9:00 AM">
        9:00 AM
      </button>

      <button class="time-slot" data-time="11:00 AM">
        11:00 AM
      </button>

      <button class="time-slot" data-time="1:00 PM">
        1:00 PM
      </button>

      <button class="time-slot" data-time="3:00 PM">
        3:00 PM
      </button>

      <button class="time-slot" data-time="5:00 PM">
        5:00 PM
      </button>

      <button class="time-slot" data-time="7:00 PM">
        7:00 PM
      </button>

    </div>


    <button
      class="booking-submit"
      id="confirmBookingBtn"
      disabled>

      Confirm Booking

    </button>


    <div class="booking-note">
      You'll receive a confirmation once your booking is reviewed.
    </div>

  `;


  const dateField =
    document.getElementById('bookingDateField');

  const petNameField =
    document.getElementById('petNameField');

  const confirmBtn =
    document.getElementById('confirmBookingBtn');

  const timeSlots =
    document.getElementById('timeSlots');


  function validate(){

    confirmBtn.disabled =
      !(
        petNameField.value.trim() &&
        dateField.value &&
        selectedTime
      );

  }


  petNameField.addEventListener(
    'input',
    validate
  );


  dateField.addEventListener(
    'change',
    validate
  );


  timeSlots.addEventListener(
    'click',
    (e) => {

      const slot =
        e.target.closest('.time-slot');

      if(!slot) return;


      timeSlots
        .querySelectorAll('.time-slot')
        .forEach(s =>
          s.classList.remove('active')
        );


      slot.classList.add('active');

      selectedTime =
        slot.dataset.time;

      validate();

    }
  );


  document
    .getElementById('bookingCloseBtn')
    .addEventListener(
      'click',
      closeBooking
    );


confirmBtn.addEventListener(
    "click",
    () => {

        const userId =
        localStorage.getItem("loggedInUserId");

        if(!userId){

            alert("Please sign in first.");
            window.location.href = "signin.php";
            return;

        }

        fetch("bookService.php",{

            method:"POST",

            headers:{
                "Content-Type":"application/json"
            },

            body:JSON.stringify({

                user_id:userId,
                service_id:service.id,
                pet_name:petNameField.value.trim(),
                booking_date:dateField.value,
                booking_time:selectedTime

            })

        })

        .then(response=>response.json())

        .then(result=>{

            if(result.status==="success"){

                renderConfirmation(

                    service,

                    petNameField.value.trim(),

                    dateField.value,

                    selectedTime

                );

            }else{

                alert(result.message);

            }

        })

        .catch(error=>{

            console.error(error);

            alert("Unable to save booking.");

        });

    }
);

}


function formatDate(iso){

  const d =
    new Date(iso + 'T00:00:00');

  return d.toLocaleDateString(
    'en-PH',
    {
      weekday:'long',
      year:'numeric',
      month:'long',
      day:'numeric'
    }
  );

}


function renderConfirmation(
  service,
  petName,
  dateISO,
  time
){

  bookingModal.innerHTML = `

    <div class="booking-confirmed">

      <svg
        viewBox="0 0 24 24"
        fill="none"
        stroke="currentColor"
        stroke-width="2">

        <circle cx="12" cy="12" r="10"/>

        <polyline points="8 12 11 15 16 9"/>

      </svg>


      <h3>
        Booking Requested!
      </h3>


      <p>
        We've received your request for
        ${service.name}.
      </p>


      <div class="summary">

        <div>
          <strong>Pet:</strong>
          ${petName}
        </div>

        <div>
          <strong>Service:</strong>
          ${service.name}
          (${service.price})
        </div>

        <div>
          <strong>Date:</strong>
          ${formatDate(dateISO)}
        </div>

        <div>
          <strong>Time:</strong>
          ${time}
        </div>

      </div>


      <button
        class="booking-done-btn"
        id="bookingDoneBtn">

        Done

      </button>

    </div>

  `;


  document
    .getElementById('bookingDoneBtn')
    .addEventListener(
      'click',
      closeBooking
    );

}


function openBooking(serviceId){

console.log("Opening booking for: ", serviceId);

  const serviceIdNumber = Number(serviceId);

  const service =
      services.find(
        s => s.id === serviceIdNumber
      );

  if(!service) return;

    renderBookingForm(service);

    console.log("After renderBookingForm");

    bookingBackdrop.classList.add("open");

    console.log("Backdrop opened");

    document.body.style.overflow = "hidden";

}


function closeBooking(){

  bookingBackdrop.classList.remove('open');

  document.body.style.overflow = '';

}


serviceGridContainer.addEventListener(
  'click',
  (e) => {

    console.log("clicked", e.target);

    const btn =
      e.target.closest('.service-book-btn');

    if(!btn) return;

    console.log("button found", btn.dataset.id);

    openBooking(btn.dataset.id);

  }
);


bookingBackdrop.addEventListener(
  'click',
  (e) => {

    if(e.target === bookingBackdrop){

      closeBooking();

    }

  }
);

  document.addEventListener("keydown", function(e){

    if(e.key === "Enter"){

        if(bookingBackdrop.classList.contains("open")){
            closeBooking();
        }

        if(searchOverlay.classList.contains("open")){
            closeSearch();
        }

    }

});

    const searchToggle = document.getElementById('searchToggle');
    const searchOverlay = document.getElementById('searchOverlay');
    const searchInput = document.getElementById('searchInput');
    const searchClose = document.getElementById('searchClose');
    const searchHint = document.getElementById('searchHint');
  
    function openSearch(){
      searchOverlay.classList.add('open');
      searchInput.value = searchQuery;
      setTimeout(() => searchInput.focus(), 50);
    }
  
    function closeSearch(){
      searchOverlay.classList.remove("open");
  }

    searchToggle.addEventListener("click", openSearch);
    searchClose.addEventListener("click", closeSearch);
    searchOverlay.addEventListener("click", function(e){
        if(e.target === searchOverlay){
            closeSearch();
        }
    });

    searchInput.addEventListener("input", function(){

    searchQuery = this.value.trim().toLowerCase();

    renderServiceGrids();
    
    const activeTab = document.querySelector(".tab-btn.active").dataset.category;

    document.querySelectorAll(".service-grid").forEach(grid => {
        grid.classList.toggle(
            "hidden",
            grid.dataset.categoryGrid !== activeTab
        );
    });
});
document.addEventListener(
  'keydown',
  function(e){

    if(e.key === 'Escape'){

      if(
        bookingBackdrop.classList.contains('open')
      ){

        closeBooking();

      }


      if(
        searchOverlay.classList.contains('open')
      ){

        closeSearch();

      }
    }
  });

</script>

</body>
</html>
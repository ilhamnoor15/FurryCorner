<?php
include "db.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>FurryCorner PH</title>
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
  }

  *{ box-sizing: border-box; margin:0; padding:0; }

  body{
    font-family:'Nunito', sans-serif;
    color: var(--ink);
    background:#fff;
    line-height:1.5;
  }

  h1,h2,h3,.brand{
    font-family:'Baloo 2', cursive;
  }

  a{ text-decoration:none; color:inherit; }

  img{ max-width:100%; display:block; }

  .container{
    width: 100%;
    max-width: 1400px;
    margin: 0 auto;
    padding: 0 40px;
  }

  .navbar{
    position: sticky;
    top: 0;
    left: 0;
    right: 0;
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
    line-height:1.1;
    color: var(--blue-dark);
  }

  .logo img{ width:38px; height:38px; object-fit:contain; }

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
  .nav-links li a:hover{ opacity:1; color:var(--blue-dark); }

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


  .menu-toggle{
    display:none;
  }


   .cart-link{
  position:relative;
  display:flex;
  align-items:center;
  justify-content:center;
  width:24px;
  height:24px;
}

.cart-link svg{
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

  .hero{
    background: var(--cream);
    min-height: calc(100vh - 70px);
    padding: 0 80px;
    display:flex;
    align-items:center;
    justify-content:space-between;
    gap: 30px;
    overflow:hidden;
  }

  .hero-text{
    max-width: 560px;
    flex: 1;
  }

  .hero-text h1{
    font-size: clamp(38px, 5vw, 56px);
    line-height: 1.05;
    font-weight: 800;
    margin-bottom: 20px;
  }

  .hero-text p{
    font-size: 17px;
    max-width: 420px;
    opacity:.85;
    font-weight:600;
  }

  .hero-art{
    flex: 1;
    display: flex;
    justify-content:center;
    align-items: center;
  }

  .hero-art img{ 
    width: 500px; 
    height:auto; 
    max-width: 100%;
  }

  .section{
    min-height: 100vh;
    padding: 80px 0;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
  }

  .section h2{
    width: 100%;
    max-width:1200px;
    font-size: 32px;
    font-weight: 700;
    margin-bottom: 30px;
  }

  .center{ text-align:center; }

  .panel{
    background: var(--blue);
    border-radius: 22px;
    padding: 28px;
    display:grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 22px;
  }
 
  .card{
    background: var(--white);
    border-radius: 14px;
    overflow:hidden;
    display:flex;
    flex-direction:column;
  }
 
  .card-thumb{
    display:block;
    background: var(--cream-light);
    aspect-ratio: 1/1;
    overflow: hidden;
  }
 
  .card-thumb img{
    width: 100%;
    height: 100%;
    object-fit: contain;
    display: block;
  }
 
  .card-body{
    padding: 16px;
    display:flex;
    flex-direction:column;
    gap: 6px;
  }
 
  .card-name{
    display:block;
    font-size: 14px;
    font-weight: 700;
    color: var(--ink);
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
  }
  .card-name:hover{ color: var(--blue-dark); }
 
  .card-price{
    font-size: 13.5px;
    font-weight: 800;
    color: var(--blue-dark);
    margin-bottom: 6px;
  }
 
  .card-btn{
    display:block;
    width: 100%;
    height: 34px;
    line-height: 34px;
    text-align:center;
    border-radius: 8px;
    border: 1.5px solid #cfd6e0;
    background: transparent;
    font-family:'Nunito', sans-serif;
    font-weight: 700;
    font-size: 13.5px;
    color: var(--ink);
    transition: border-color .2s ease, color .2s ease;
  }
  .card-btn:hover{ border-color: var(--blue); color: var(--blue-dark); }
 
  .view-all-wrap{
    display:flex;
    justify-content:center;
    margin-top: 28px;
  }
 
  .btn{
    display:inline-block;
    background: var(--blue);
    color: var(--white);
    font-weight: 700;
    border:none;
    border-radius: 8px;
    padding: 12px 30px;
    cursor:pointer;
    font-size: 15px;
    transition: background .2s ease, transform .2s ease;
  }
  .btn:hover{ background: var(--blue-dark); transform: translateY(-1px); }
 

  .services{
    text-align:center;
  }

  .services h2{
    text-align:left;
  }

  .service-grid{
    display:flex;
    justify-content: center;
    gap: 90px;
    margin: 46px 0 40px;
    flex-wrap: wrap;
  }

  .service{
    display:flex;
    flex-direction:column;
    align-items:center;
    gap: 18px;
  }

  .service-icon{
    width: 130px;
    height: 130px;
    border-radius: 50%;
    background: var(--blue);
    display:flex;
    align-items:center;
    justify-content:center;
    box-shadow: 0 10px 24px rgba(123,184,240,.35);
  }

  .service-icon img{ width: 56px; height:56px; object-fit:contain; }

  .service span{
    font-size: 20px;
    font-weight: 800;
  }

  .why{
      background: var(--cream);
      min-height: 100vh;
      padding: 80px;
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
  }

  .why h2{
    font-size: 30px;
    margin-bottom: 50px;
  }

  .why-grid{
    width: 100%;
    max-width: 900px;
    display:grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 25px;
  }

  .why-item{
    background: var(--blue);
    color:var(--white);
    border-radius: 12px;
    padding: 18px 22px;
    display:flex;
    align-items:center;
    gap: 14px;
    font-weight: 800;
    font-size: 16px;
    text-align:left;
  }

  .why-item svg{ width:26px; height:26px; flex-shrink:0; }

  footer{
    width: 100%;
    padding: 70px 0px 20px;
  }

  .footer-container {
    width: 90%;
    max-width: 1400px;
    margin: auto;
  }

  .footer-grid{
    display:grid;
    grid-template-columns: 1fr 1fr 1fr 1.4fr;
    gap: 60px;
    padding-bottom: 40px;
    align-items: start;
  }

  .footer-grid h4{
    font-weight: 800;
    margin-bottom: 18px;
    font-size: 16px;
  }

  .footer-grid p, .footer-grid a{
    display:block;
    margin-bottom: 10px;
    font-size: 14.5px;
    opacity: .85;
    font-weight:600;
  }

  .footer-grid a:hover{
    color:var(--blue-dark);
    padding-left:5px;
  }

  .footer-divider {
    width: 100%;
    height: 2px;
    background: #eee;
  }
  .footer-bottom{
    width: 100%;
    border-top: 2px solid #eee;
    margin-top: 20px;
    padding-top: 18px;
    text-align:center;
    font-size: 14px;
    color: var(--blue-dark);
    font-weight:700;
  }

    .search-overlay{
    position: fixed;
    inset: 0;
    background: rgba(123, 184, 240, 0.55);
    backdrop-filter: blur(2px);
    z-index: 2000;
    display: none;
    align-items: flex-start;
    justify-content: center;
    padding: 60px 40px 0;
  }

  .search-overlay.open{ display: flex; }

  .search-box{
    background: var(--white);
    width: 100%;
    max-width: 760px;
    border-radius: 12px;
    border: 2px solid var(--blue);
    display:flex;
    align-items:center;
    padding: 14px 20px;
    gap: 14px;
    box-shadow: 0 12px 30px rgba(0,0,0,0.15);
  }

  .search-box input{
    flex:1;
    border:none;
    outline:none;
    font-family:'Nunito', sans-serif;
    font-size: 16px;
    font-weight: 600;
    color: var(--ink);
    background: transparent;
  }

  .search-box svg{
    width: 22px;
    height: 22px;
    color: var(--blue-dark);
    flex-shrink:0;
  }

  .search-close{
    background:none;
    border:none;
    cursor:pointer;
    margin-left: 16px;
    flex-shrink:0;
  }

  .search-close svg{
    width: 26px;
    height: 26px;
    color: var(--ink);
  }

  .search-results-hint{
    max-width: 760px;
    width:100%;
    margin: 10px auto 0;
    color: var(--white);
    font-weight: 700;
    font-size: 14px;
    text-align:left;
  }


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
    .hero{ flex-direction:column; text-align:center; padding-top:40px; }
    .hero-text{ padding-bottom: 0; }
    .hero-text p{ margin: 0 auto; }
    .hero-art{ align-self:center; margin-top: 20px; }
    .panel{ grid-template-columns: repeat(2, 1fr); }
    .why-grid{ grid-template-columns: 1fr; }
    .footer-grid{ grid-template-columns: 1fr 1fr; }
    .service-grid{ gap: 40px; }
  }

  @media (max-width: 480px){
    .container, .navbar, .section, .why, footer{ padding-left:20px; padding-right:20px; }
    .panel{ grid-template-columns: 1fr; padding: 18px; }
    .footer-grid{ grid-template-columns: 1fr; }
  }
</style>
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
      <li><a href="services.php">Services</a></li>
      <li><a href="about.php">About</a></li>
      <li><a href="contact.php">Contact Us</a></li>
    </ul>
  </div>
  <div class="nav-icons">
    <svg id = "searchToggle" 
          viewBox="0 0 24 24" 
          fill="none" 
          stroke="currentColor" 
          stroke-width="2">
          <circle cx="11" cy="11" r="7"/><line x1="21" y1="21" x2="16.65" y2="16.65"/>
    </svg>

    <a href="signin.php">
      <svg viewBox="0 0 24 24" 
      fill="none" 
      stroke="currentColor" 
      stroke-width="2">
      <circle cx="12" cy="8" r="4"/><path d="M4 21c0-4 4-6 8-6s8 2 8 6"/>
      </svg>
    </a>

    <span class="notif-icon-wrap" id="notifToggle" style="cursor:pointer;">
      <svg viewBox="0 0 24 24" 
            fill="none" 
            stroke="currentColor" 
            stroke-width="2">
            <path d="M18 8a6 6 0 00-12 0c0 7-3 9-3 9h18s-3-2-3-9"/>
            <path d="M13.73 21a2 2 0 01-3.46 0"/>
      </svg>

      <span class="notif-badge" id="notifBadge" style="display:none;">0</span>

    </span>

    <!-- CART -->

    <a
      href="cart.php"
      class="cart-link"
      aria-label="Shopping cart">

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


      <!-- CART NOTIFICATION -->
      <span
        class="cart-badge"
        id="cartBadge">
        0
      </span>
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

<header class="hero">
  <div class="hero-text">
    <h1>Furry Friends,<br>Cozy Corner</h1>
    <p>Provides quality products and services for your pet's health and happiness</p>
  </div>
  <div class="hero-art">
    <img src="images/hero-pets.png" alt="Cat and dog illustration">
  </div>
</header>
 
<section class="section">
  <div class="container">
    <h2>FOOD</h2>
      <div class="panel">

      <?php

      $sql = "SELECT * FROM products
              WHERE category='Food'
              LIMIT 4";

      $result = mysqli_query($conn, $sql);

      while($row = mysqli_fetch_assoc($result)){

      ?>

      <div class="card">

          <a class="card-thumb"
            href="product.php?id=<?php echo $row['product_id']; ?>">

              <img
              src="<?php echo $row['image']; ?>"
              alt="<?php echo $row['product_name']; ?>">

          </a>

          <div class="card-body">

              <a class="card-name"
                href="product.php?id=<?php echo $row['product_id']; ?>">

                  <?php echo $row['product_name']; ?>

              </a>

              <div class="card-price">
                  ₱<?php echo number_format($row['price'],2); ?>
              </div>

              <a class="card-btn"
                href="product.php?id=<?php echo $row['product_id']; ?>">
                  View
              </a>

          </div>

      </div>

      <?php
      }
      ?>

      </div>
    </div>
    <div class="view-all-wrap"><a class="btn" href="AllProducts.php">View All</a></div>
  </div>
</section>
 
<section class="section">
  <div class="container">
    <h2>ACCESSORIES</h2>
    <div class="panel">

        <?php

        $sql = "SELECT * FROM products
                WHERE category='Accessories'
                LIMIT 4";

        $result = mysqli_query($conn, $sql);

        while($row = mysqli_fetch_assoc($result)){

        ?>

        <div class="card">

            <a class="card-thumb"
              href="product.php?id=<?php echo $row['product_id']; ?>">

                <img src="<?php echo $row['image']; ?>"
                    alt="<?php echo htmlspecialchars($row['product_name']); ?>">

            </a>

            <div class="card-body">

                <a class="card-name"
                  href="product.php?id=<?php echo $row['product_id']; ?>">

                    <?php echo htmlspecialchars($row['product_name']); ?>

                </a>

                <div class="card-price">

                    ₱<?php echo number_format($row['price'],2); ?>

                </div>

                <a class="card-btn"
                  href="product.php?id=<?php echo $row['product_id']; ?>">

                    View

                </a>

            </div>

        </div>

        <?php
        }

        ?>

        </div>
      </div>
    </div>
    <div class="view-all-wrap"><a class="btn" href="AllProducts.php">View All</a></div>
  </div>
</section>
 
<section class="section services">
  <div class="container">
    <h2>How can we serve you today?</h2>
    <div class="service-grid">
      <div class="service">
        <div class="service-icon">
          <img src="images/icon-grooming.png" alt="Grooming icon">
        </div>
        <span>Grooming</span>
      </div>
      <div class="service">
        <div class="service-icon">
          <img src="images/icon-care.png" alt="Care icon">
        </div>
        <span>Care</span>
      </div>
      <div class="service">
        <div class="service-icon">
          <img src="images/icon-boarding.png" alt="Boarding icon">
        </div>
        <span>Boarding</span>
      </div>
    </div>
    <button class="btn" onclick="window.location.href='services.php'">
    Book Now
</button>
  </div>
</section>

<section class="why">
  <h2>Why choose FurryCorner for your pet?</h2>
  <div class="why-grid">
    <div class="why-item">
      <svg viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="1" y="7" width="15" height="10"/><path d="M16 10h4l3 3v4h-7z"/><circle cx="5.5" cy="19.5" r="1.5"/><circle cx="18.5" cy="19.5" r="1.5"/></svg>
      Fast &amp; Secure Delivery
    </div>
    <div class="why-item">
      <svg viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="6" cy="6" r="3"/><circle cx="6" cy="18" r="3"/><line x1="20" y1="4" x2="8.12" y2="15.88"/><line x1="14.47" y1="14.48" x2="20" y2="20"/><line x1="8.12" y1="8.12" x2="12" y2="12"/></svg>
      Professional Pet Services
    </div>
    <div class="why-item">
      <svg viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20.59 13.41L11 3.83A2 2 0 009.61 3H4a1 1 0 00-1 1v5.61a2 2 0 00.59 1.42l9.58 9.58a2 2 0 002.82 0l4.6-4.6a2 2 0 000-2.82z"/><circle cx="7.5" cy="7.5" r="1.5"/></svg>
      Affordable &amp; Quality Goods
    </div>
    <div class="why-item">
      <svg viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 11.5a8.38 8.38 0 01-.9 3.8 8.5 8.5 0 01-7.6 4.7 8.38 8.38 0 01-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 01-.9-3.8 8.5 8.5 0 014.7-7.6 8.38 8.38 0 013.8-.9h.5a8.48 8.48 0 018 8v.5z"/></svg>
      Reliable Support
    </div>
  </div>
</section>


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
        <a href="#">Foods</a>
        <a href="#">Accessories</a>
        <a href="#">Services</a>
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
    if (window.scrollY > 10) {
      nav.classList.add('scrolled');
    } else {
      nav.classList.remove('scrolled');
    }
  });

  let notifications = [
    {
      id: 'n1',
      type: 'payment',
      title: 'Payment received',
      message: 'Your payment for Order #FC-1032 has been confirmed.',
      time: '2 hours ago',
      read: false
    },
    {
      id: 'n2',
      type: 'booking',
      title: 'Booking confirmed',
      message: 'Your Bath appointment on Aug 6 has been confirmed.',
      time: '1 day ago',
      read: true
    }
  ];
 
  const notifToggle = document.getElementById('notifToggle');
  const notifDropdown = document.getElementById('notifDropdown');
  const notifList = document.getElementById('notifList');
  const notifBadge = document.getElementById('notifBadge');
  const notifMarkAllRead = document.getElementById('notifMarkAllRead');
 
  const notifIcons = {
    payment: `<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="5" width="20" height="14" rx="2"/><line x1="2" y1="10" x2="22" y2="10"/></svg>`,
    booking: `<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>`
  };
 
  function addNotification(type, title, message){
    notifications.unshift({
      id: 'n' + Date.now(),
      type,
      title,
      message,
      time: 'Just now',
      read: false
    });
    renderNotifications();
  }
 
  function renderNotifications(){
    const unreadCount = notifications.filter(n => !n.read).length;
    notifBadge.style.display = unreadCount > 0 ? 'flex' : 'none';
    notifBadge.textContent = unreadCount;
 
    notifList.innerHTML = notifications.length
      ? notifications.map(n => `
          <div class="notif-item ${n.read ? '' : 'unread'}" data-id="${n.id}">
            <div class="notif-icon ${n.type}">${notifIcons[n.type]}</div>
            <div class="notif-body">
              <div class="notif-title">${n.title}</div>
              <div class="notif-message">${n.message}</div>
              <div class="notif-time">${n.time}</div>
            </div>
            ${n.read ? '' : '<div class="notif-unread-dot"></div>'}
          </div>
        `).join('')
      : `<div class="notif-empty">You're all caught up</div>`;
  }
 
  notifToggle.addEventListener('click', (e) => {
    e.stopPropagation();
    notifDropdown.classList.toggle('open');
  });
 
  notifMarkAllRead.addEventListener('click', () => {
    notifications.forEach(n => n.read = true);
    renderNotifications();
  });
 
  notifList.addEventListener('click', (e) => {
    const item = e.target.closest('.notif-item');
    if (!item) return;
    const n = notifications.find(x => x.id === item.dataset.id);
    if (n){ n.read = true; renderNotifications(); }
  });
 
  document.addEventListener('click', (e) => {
    if (!notifDropdown.contains(e.target) && !notifToggle.contains(e.target)){
      notifDropdown.classList.remove('open');
    }
  });
 
  renderNotifications();

  // ===== SEARCH OVERLAY =====
const searchToggle = document.getElementById("searchToggle");
const searchOverlay = document.getElementById("searchOverlay");
const searchClose = document.getElementById("searchClose");
const searchInput = document.getElementById("searchInput");

const productKeywords = [
        "food","dry","dry food","wet","wet food","treat","treats",
        "accessories","walking essentials","home gear","toys",
        "harness","collar","leash","bed","cage","bowl",
        "potty","brush","comb","plush","ball","chew",
        "interactive","stroller","shoe","dog","cat"
    ];

    // Service keywords
    const serviceKeywords = [
        "grooming","care","boarding",
        "haircut","bath","tooth","brushing",
        "nail","ear","cleaning","dental",
        "vaccination","medicine","spaying",
        "consultation","day boarding",
        "overnight","spa","fostering",
        "veterinary"
    ];

// Open search
searchToggle.addEventListener("click", () => {
    searchOverlay.classList.add("open");
    searchInput.focus();
});

// Close search
function closeSearch(){
    searchOverlay.classList.remove("open");
    searchInput.value = "";
}

searchClose.addEventListener("click", closeSearch);

searchOverlay.addEventListener("click", function(e){
    if(e.target === searchOverlay){
        closeSearch();
    }
});

document.addEventListener("keydown", function(e){
    if(e.key === "Escape"){
        closeSearch();
    }
});
searchInput.addEventListener("keydown", function(e){

    if(e.key !== "Enter") return;

    const keyword = this.value.trim().toLowerCase();

    if(keyword === ""){
        return;
    }

    const isProduct = productKeywords.some(word =>
        keyword.includes(word)
    );

    const isService = serviceKeywords.some(word =>
        keyword.includes(word)
    );

    if(isProduct){

        window.location.href =
            "AllProducts.php?search=" + encodeURIComponent(keyword);

    }
    else if(isService){

        window.location.href =
            "services.php?search=" + encodeURIComponent(keyword);

    }
    else{

        alert("No products or services found.");

    }

});

function updateCartBadge(){

  const badge =
    document.getElementById('cartBadge');

  if(!badge){
    return;
  }


  /*
    Get the same cart used by
    product.php and cart.php.
  */

  let cart = [];

  try{

    cart =
      JSON.parse(
        localStorage.getItem('cart')
      ) || [];

  }catch(error){

    cart = [];

  }


  /*
    Count total quantity.

    Example:
    Kibble x2
    Harness x1

    Badge = 3
  */

  const totalItems =
    cart.reduce(
      (total, item) => {

        const quantity =
          Number(item.quantity) || 0;

        return total + quantity;

      },
      0
    );


  if(totalItems > 0){

    badge.textContent =
      totalItems > 99
        ? '99+'
        : totalItems;

    badge.style.display =
      'flex';

  }else{

    badge.style.display =
      'none';

  }

}


/* =========================
   UPDATE WHEN PAGE LOADS
========================= */

updateCartBadge();


/* =========================
   UPDATE WHEN RETURNING
   TO THIS PAGE
========================= */

window.addEventListener(
  'pageshow',
  updateCartBadge
);


/*
  This also updates if the cart
  is changed in another browser tab.
*/

window.addEventListener(
  'storage',
  function(event){

    if(event.key === 'cart'){

      updateCartBadge();

    }

  }
);
</script>

</body>
</html>

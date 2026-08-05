<?php

include "db.php";

$sql = "SELECT * FROM products ORDER BY product_id ASC";

$result = mysqli_query($conn, $sql);

$products = [];

while($row = mysqli_fetch_assoc($result)){

    $products[] = [

        "id" => $row["product_id"],
        "name" => $row["product_name"],
        "category" => $row["category"],
        "subcategory" => $row["subcategory"],
        "price" => (float)$row["price"],
        "stock" => (int)$row["stock"],
        "status" => $row["stock"] > 0 ? "In Stock" : "Out of Stock"

    ];

}

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Products - FurryCorner PH</title>
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

  html{ scroll-behavior: smooth; }

  body{
    font-family:'Nunito', sans-serif;
    color: var(--ink);
    background: var(--cream);
    line-height:1.5;
  }

  main {
    background: var(--cream);
  }

  h1,h2,h3,.brand{
    font-family:'Baloo 2', cursive;
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
    display:flex; align-items:center; gap:8px;
    font-weight:700; font-size: 14px; line-height:1.1;
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

  .nav-icons{ 
    display:flex;
    align-items:center; 
    gap: 22px; 
  }

  .nav-icons svg{ 
    width: 22px; 
    height: 22px; 
    cursor:pointer; 
  }

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


  .menu-toggle{ 
    display:none; 
    background:none;
    border:none; 
    cursor:pointer; 
  }

  .page-header{
    max-width: 1200px;
    margin: 40px auto 0;
    padding: 0 40px;
  }
  .page-header h1{
    font-size: 32px;
    font-weight: 800;
  }

  .products-content {
    display: flex;
    flex-direction: column;
    width: 100%;
  }

  .toolbar{
    display:flex;
    align-items:center;
    justify-content: flex-end;
    gap: 15px;
    margin-bottom: 30px;
  }

  .toolbar .count{
    font-size: 14px;
    font-weight:700;
    opacity:.75;
  }

  .toolbar .container {
    display: flex;
    justify-content: flex-end;
    align-items: center;
    gap: 15px;
    width: 100%;
  }

  .sort-label{ 
    font-weight:700; 
    font-size:14px;
   }

  select{
    font-family:'Nunito', sans-serif;
    font-weight:700;
    font-size: 14px;
    padding: 8px 14px;
    border-radius: 8px;
    border: 1.5px solid var(--blue);
    background: var(--white);
    color: var(--ink);
    cursor:pointer;
  }

  .products-layout{
    display:grid;
    grid-template-columns: 220px 1fr;
    gap: 50px;
    padding: 30px 40px 70px;
    align-items:start;
  }

  .sidebar h3{
    font-size: 17px;
    font-weight: 800;
    margin-bottom: 25px;
  }

  .filter-group{
    margin-bottom: 22px;
  }

  .filter-group summary{
    font-weight: 700;
    font-size: 15px;
    cursor: pointer;
    list-style:none;
    display:flex;
    align-items:center;
    justify-content:space-between;
    padding: 4px 0;
  }

  .filter-group summary::-webkit-details-marker{ 
    display:none; 
  }

  .filter-group summary::after{
    content:'+';
    font-size: 16px;
    color: var(--blue-dark);
  }

  .filter-group[open] summary::after{ 
    content:'−'; 
  }

  .filter-group .options{
    margin-top: 10px;
    display:flex;
    flex-direction:column;
    gap: 8px;
    padding-left: 4px;
  }

  .filter-group label{
    font-size: 14px;
    font-weight: 600;
    display:flex;
    align-items:center;
    gap: 8px;
    cursor:pointer;
  }

  .product-grid{
    width: 100%;
    display:grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 24px;
    align-content: start;
  }

  .card{
    background: var(--white);
    border-radius: 16px;
    overflow:hidden;
    display:flex;
    flex-direction:column;
    box-shadow: 0 4px 14px rgba(0,0,0,0.05);
    transition: transform .2s ease, box-shadow .2s ease;
  }
  .card:hover{
    transform: translateY(-4px);
    box-shadow: 0 10px 22px rgba(0,0,0,0.10);
  }

  .card-thumb{
    background: var(--blue);
    width: 100%;
    height: 250px;
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 15px;
    overflow: hidden;
    border-bottom: 1px solid #eee;
}

  .card-thumb img{
      width: 100%;
      height: 100%;
      object-fit: contain;
      object-position: center;
  }

  a.card-name{
    display:block;
    color: inherit;
  }

  a.card-name:hover{ 
    color: var(--blue-dark); 
  }

  .card-body{
    padding: 16px;
    display:flex;
    flex-direction:column;
    gap: 8px;
  }

  .card-name{
    font-size: 14.5px;
    font-weight: 700;
    color: var(--ink);
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
  }

  .card-price{
    font-size: 14px;
    font-weight: 800;
    color: var(--blue-dark);
    margin-bottom: 4px;
  }

  .card-btn{
    width: 100%;
    height: 38px;
    border-radius: 8px;
    border: none;
    background: var(--blue);
    color: var(--white);
    font-family:'Nunito', sans-serif;
    font-weight: 700;
    font-size: 14px;
    cursor:pointer;
    transition: background .2s ease;
  }

  .card-btn:hover{ 
    background: var(--blue-dark); 
  }

  .card-btn[disabled]{
    background: #c8c8c8;
    color: #666;
    cursor: not-allowed;
  }

  .card.out-of-stock{
    opacity: 0.7;
    filter: grayscale(40%);
  }

  .card-btn[disabled]{
    background: #c8c8c8;
    cursor: not-allowed;
    color: #5a5a5a;
  }

  .card.out-of-stock{
    opacity: 0.65;
    filter: grayscale(30%);
  }

  .pagination{
    display:flex;
    justify-content:center;
    align-items:center;
    gap: 10px;
    padding: 40px 40px 0;
  }

  .pagination button{
    width: 38px;
    height: 38px;
    border-radius: 8px;
    border: 1.5px solid var(--blue);
    background: var(--white);
    font-weight:700;
    cursor:pointer;
  }
  .pagination button.active{
    background: var(--blue);
    color: var(--white);
  }

  footer{
    background: var(--white);
    width: 100%;
    margin-top: 80px;
    padding: 60px 0px 30px;
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

  .cart-alert{
  position:fixed;
  left:50%;
  top:50%;
  transform:translate(-50%,-50%) scale(.85);
  background:var(--white);
  width:360px;
  max-width:90vw;
  padding:25px;
  border-radius:18px;
  box-shadow:0 15px 45px rgba(0,0,0,.20);
  border:2px solid var(--blue);
  z-index:5000;
  opacity:0;
  visibility:hidden;
  transition:opacity .25s ease,transform .25s ease,visibility .25s ease;
  text-align:center;
}

.cart-alert.show{
  opacity:1;
  visibility:visible;
  transform:translate(-50%,-50%) scale(1);
}

.cart-alert-icon{
  width:55px;
  height:55px;
  margin:0 auto 12px;
  border-radius:50%;
  background:var(--blue);
  color:white;
  display:flex;
  align-items:center;
  justify-content:center;
  font-size:27px;
  font-weight:800;
}

.cart-alert h3{
  font-size:22px;
  margin-bottom:5px;
}

.cart-alert p{
  font-size:14px;
  font-weight:600;
  opacity:.7;
}


/* =========================
   CART DRAWER
========================= */

.cart-overlay{
  position:fixed;
  inset:0;
  background:rgba(31,36,48,.35);
  backdrop-filter:blur(2px);
  z-index:3000;
  opacity:0;
  visibility:hidden;
  transition:opacity .25s ease,visibility .25s ease;
}

.cart-overlay.open{
  opacity:1;
  visibility:visible;
}

.cart-drawer{
  position:fixed;
  top:0;
  right:0;
  width:390px;
  max-width:90vw;
  height:100vh;
  background:var(--cream-light);
  z-index:3001;
  display:flex;
  flex-direction:column;
  transform:translateX(100%);
  transition:transform .3s ease;
  box-shadow:-8px 0 30px rgba(0,0,0,.15);
}

.cart-drawer.open{
  transform:translateX(0);
}


/* DRAWER HEADER */

.cart-drawer-header{
  background:var(--blue-dark);
  color:var(--white);
  padding:22px 24px;
  display:flex;
  align-items:center;
  justify-content:space-between;
}

.cart-drawer-header h2{
  font-size:24px;
  font-weight:800;
}

.cart-close{
  width:36px;
  height:36px;
  border:2px solid rgba(255,255,255,.7);
  border-radius:50%;
  background:transparent;
  color:white;
  font-size:25px;
  line-height:1;
  cursor:pointer;
}

.cart-close:hover{
  background:rgba(255,255,255,.15);
}


/* DRAWER BODY */

.cart-drawer-body{
  flex:1;
  overflow-y:auto;
  padding:20px;
}


/* DRAWER ITEM */

.drawer-cart-item{
  background:white;
  border-radius:14px;
  padding:12px;
  margin-bottom:12px;
  display:flex;
  gap:12px;
  box-shadow:0 3px 10px rgba(0,0,0,.06);
}

.drawer-cart-item img{
  width:70px;
  height:70px;
  border-radius:10px;
  background:var(--blue);
  object-fit:contain;
}

.drawer-item-info{
  flex:1;
  min-width:0;
}

.drawer-item-name{
  font-weight:800;
  font-size:14px;
  margin-bottom:4px;
  white-space:nowrap;
  overflow:hidden;
  text-overflow:ellipsis;
}

.drawer-item-price{
  color:var(--blue-dark);
  font-weight:800;
  font-size:14px;
}

.drawer-item-quantity{
  font-size:13px;
  font-weight:700;
  opacity:.7;
}


/* EMPTY */

.drawer-empty{
  min-height:300px;
  display:flex;
  flex-direction:column;
  align-items:center;
  justify-content:center;
  text-align:center;
  padding:30px;
}

.drawer-empty h3{
  font-size:22px;
  margin-bottom:8px;
}

.drawer-empty p{
  font-size:14px;
  opacity:.7;
}


/* DRAWER FOOTER */

.cart-drawer-footer{
  background:white;
  padding:20px;
  border-top:1px solid #eee;
}

.cart-total-row{
  display:flex;
  align-items:center;
  justify-content:space-between;
  margin-bottom:15px;
  font-size:16px;
  font-weight:800;
}

.cart-total-row strong{
  color:var(--blue-dark);
}


/* ONLY VIEW CART BUTTON */

.view-cart-btn{
  width:100%;
  height:44px;
  border-radius:9px;
  display:flex;
  align-items:center;
  justify-content:center;
  font-family:'Nunito',sans-serif;
  font-size:14px;
  font-weight:800;
  cursor:pointer;
  background:var(--blue-dark);
  color:white;
}

.view-cart-btn:hover{
  background:var(--blue);
}

  @media (max-width: 900px){
    .nav-left{ gap: 20px; }
    .nav-links{ display:none; }
    .menu-toggle{ display:block; }
    .products-layout{ grid-template-columns: 1fr; }
    .product-grid{ grid-template-columns: repeat(2, 1fr); }
    .footer-grid{ grid-template-columns: 1fr 1fr; }
    .toolbar{ justify-content:flex-start; }
    .toolbar .count{ margin-left:0; width:100%; order:3; }
  }

  @media (max-width: 480px){
    .container, .navbar, .page-header, .products-layout, .toolbar, footer{
      padding-left:20px; padding-right:20px;
    }
    .product-grid{ grid-template-columns: 1fr; }
    .footer-grid{ grid-template-columns: 1fr; }
    .cart-drawer{ width:100%; max-width:100%; }
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
    
    <a
      href="cart.php"
      class="cart-link">
      <span class="cart-icon-wrap">
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

<div
  class="cart-alert"
  id="cartAlert">

  <div class="cart-alert-icon">
    ✓
  </div>

  <h3>
    Added to Cart!
  </h3>

  <p id="cartAlertText">
    Product has been added to your cart.
  </p>

</div>


<!-- =========================
     CART DRAWER
========================= -->

<div
  class="cart-overlay"
  id="cartOverlay">
</div>


<aside
  class="cart-drawer"
  id="cartDrawer">

  <div class="cart-drawer-header">

    <h2>
      Cart
    </h2>

    <button
      class="cart-close"
      id="cartClose"
      aria-label="Close cart">

      ×

    </button>

  </div>


  <div
    class="cart-drawer-body"
    id="cartDrawerBody">
  </div>


  <div class="cart-drawer-footer">

    <div class="cart-total-row">

      <span>
        Total
      </span>

      <strong id="drawerTotal">
        ₱0.00
      </strong>

    </div>


    <a
      href="cart.php"
      class="view-cart-btn">

      View Cart

    </a>

  </div>

</aside>


<main>
  
<div class="page-header">
  <div class="container">
    <h1>Products</h1>
  </div>
</div>

<div class="products-layout container">
 
    <aside class="sidebar">
        <h3>Filter:</h3>
 
        <details class="filter-group" open>
            <summary>Products Type</summary>
            <div class="options" id="typeFilterOptions">
                <label><input type="checkbox" data-filter="category" data-value="Food"> Food</label>
                <label style="padding-left:16px;"><input type="checkbox" data-filter="subcategory" data-value="Dry Food"> Dry Food</label>
                <label style="padding-left:16px;"><input type="checkbox" data-filter="subcategory" data-value="Wet Food"> Wet Food</label>
                <label style="padding-left:16px;"><input type="checkbox" data-filter="subcategory" data-value="Treats"> Treats</label>
                <label><input type="checkbox" data-filter="category" data-value="Accessories"> Accessories</label>
                <label style="padding-left:16px;"><input type="checkbox" data-filter="subcategory" data-value="Walking Essentials"> Walking Essentials</label>
                <label style="padding-left:16px;"><input type="checkbox" data-filter="subcategory" data-value="Home Gear"> Home Gear</label>
                <label style="padding-left:16px;"><input type="checkbox" data-filter="subcategory" data-value="Toys"> Toys</label>
            </div>
        </details>
 
        <details class="filter-group">
            <summary>Price</summary>
            <div class="options" id="priceFilterOptions">
                <label><input type="checkbox" data-filter="price" data-min="0" data-max="200"> Under ₱200</label>
                <label><input type="checkbox" data-filter="price" data-min="200" data-max="500"> ₱200 - ₱500</label>
                <label><input type="checkbox" data-filter="price" data-min="500" data-max="999999"> Over ₱500</label>
            </div>
        </details>
 
        <button class="link-btn" id="clearFiltersBtn" style="background:none;border:none;cursor:pointer;color:var(--blue-dark);font-weight:700;font-size:13.5px;text-decoration:underline;margin-top:6px;">Clear filters</button>
    </aside>

    <div class="products-content">
 
        <div class="toolbar">
 
            <span class="sort-label">Sort By:</span>
 
            <select id="sortSelect">
                <option>Alphabetically, A-Z</option>
                <option>Alphabetically, Z-A</option>
                <option>Price, low to high</option>
                <option>Price, high to low</option>
            </select>
 
            <span class="count" id="productCount">
                30 of 30 products
            </span>
 
        </div>

        <section class="product-grid" id="productGrid"></section>

    </div>

</div>

<div class="pagination" id="pagination"></div>

</main>

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

<script src="shared-order.js"></script>

<script src="furryCornerStorage.js"></script>

<script>
  const nav = document.getElementById('navbar');

  window.addEventListener('scroll', () => {
    nav.classList.toggle('scrolled', window.scrollY > 10);
  });

  let products = [];
  let filteredProduct = [];


fetch("getProducts.php")

.then(response => response.json())

.then(data => {

    products = data;

    filteredProducts = [...products];

    applyFiltersAndSort();

    renderProducts();

})
.catch(error => {

    console.error("Failed loading products:", error);

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

  const PER_PAGE = 15;
  let currentPage = 1;
 
  let searchQuery = '';

  const params = new URLSearchParams(window.location.search);
  const keyword = params.get("search");

if(keyword){
    searchQuery = keyword.toLowerCase();
}


  let selectedCategories = new Set();
  let selectedSubcategories = new Set();
  let selectedPriceRanges = []; // [{min, max}, ...]
  let sortValue = 'Alphabetically, A-Z';
 
  function applyFiltersAndSort(){
    let result = products.filter(p => {
      const matchesSearch =
      !searchQuery ||
      p.name.toLowerCase().includes(searchQuery) ||
      p.category.toLowerCase().includes(searchQuery) ||
      (p.subcategory && p.subcategory.toLowerCase().includes(searchQuery));

    const matchesCategory =
      selectedCategories.size === 0 ||
      selectedCategories.has(p.category);

    const matchesSubcategory =
      selectedSubcategories.size === 0 ||
      selectedSubcategories.has(p.subcategory);

    const matchesPrice =
      selectedPriceRanges.length === 0 ||
      selectedPriceRanges.some(r =>
        p.price >= r.min && p.price <= r.max
      );
      return matchesSearch && matchesCategory && matchesSubcategory && matchesPrice;
    });
 
    switch (sortValue) {
      case 'Alphabetically, Z-A':
        result.sort((a, b) => b.name.localeCompare(a.name));
        break;
      case 'Price, low to high':
        result.sort((a, b) => a.price - b.price);
        break;
      case 'Price, high to low':
        result.sort((a, b) => b.price - a.price);
        break;
      default: // Alphabetically, A-Z
        result.sort((a, b) => a.name.localeCompare(b.name));
    }
 
    filteredProducts = result;
    currentPage = 1;
    renderProducts();
    renderPagination();
 
    if (searchHint){
      searchHint.textContent = searchQuery
        ? `${filteredProducts.length} result${filteredProducts.length === 1 ? '' : 's'} for "${searchQuery}"`
        : '';
    }
  }
 
  const grid = document.getElementById('productGrid');
  const countEl = document.getElementById('productCount');
  const paginationEl = document.getElementById('pagination');

 
  function peso(n){
    return '₱' + n.toLocaleString('en-PH', { minimumFractionDigits: 2 });
  }

  function addToCart(productId){
  // Prefer canonical product from storage so stock is authoritative
  const storedProducts = window.FurryCornerStorage ? window.FurryCornerStorage.getProducts() : products;
  const product = storedProducts.find(p => Number(p.id) === Number(productId)) || products.find(p => p.id === productId);

  if(!product) return;

  if(product.stock !== undefined && Number(product.stock) <= 0){
    alert(product.name + ' is out of stock.');
    return;
}

  let cart =
    JSON.parse(
      localStorage.getItem('cart')
    ) || [];

  const existingItem =
    cart.find(
      item => item.id === productId
    );

  if(existingItem){

    existingItem.quantity += 1;

  }else{

    cart.push({

      id:product.id,
      name:product.name,
      price:product.price,
      quantity:1

    });

  }

  localStorage.setItem(
    'cart',
    JSON.stringify(cart)
  );

  updateCartBadge();

  renderCartDrawer();

  openCartDrawer();

  showCartAlert(
    product.name
  );

}


/* =========================
   CART BADGE
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


/* =========================
   CENTER CART ALERT
========================= */

const cartAlert =
  document.getElementById(
    'cartAlert'
  );

const cartAlertText =
  document.getElementById(
    'cartAlertText'
  );

let alertTimeout;


function showCartAlert(productName){

  cartAlertText.textContent =
    productName +
    ' has been added to your cart.';

  cartAlert.classList.add(
    'show'
  );

  clearTimeout(
    alertTimeout
  );

  alertTimeout =
    setTimeout(
      () => {

        cartAlert.classList.remove(
          'show'
        );

      },
      1800
    );

}


/* =========================
   CART DRAWER
========================= */

const cartDrawer =
  document.getElementById(
    'cartDrawer'
  );

const cartOverlay =
  document.getElementById(
    'cartOverlay'
  );

const cartClose =
  document.getElementById(
    'cartClose'
  );

const cartDrawerBody =
  document.getElementById(
    'cartDrawerBody'
  );

const drawerTotal =
  document.getElementById(
    'drawerTotal'
  );


function openCartDrawer(){

  cartDrawer.classList.add(
    'open'
  );

  cartOverlay.classList.add(
    'open'
  );

}


function closeCartDrawer(){

  cartDrawer.classList.remove(
    'open'
  );

  cartOverlay.classList.remove(
    'open'
  );

}


cartClose.addEventListener(
  'click',
  closeCartDrawer
);


cartOverlay.addEventListener(
  'click',
  closeCartDrawer
);


/* =========================
   RENDER CART DRAWER
========================= */

function renderCartDrawer(){

  const cart =
    JSON.parse(
      localStorage.getItem('cart')
    ) || [];

  if(cart.length === 0){

    cartDrawerBody.innerHTML = `

      <div class="drawer-empty">

        <h3>
          Your cart is empty
        </h3>

        <p>
          Add some products to your
          cart to see them here.
        </p>

      </div>

    `;

    drawerTotal.textContent =
      '₱0.00';

    return;

  }

  let total = 0;

  cartDrawerBody.innerHTML =
    cart.map(item => {

      total +=
        item.price *
        item.quantity;

      return `

        <div class="drawer-cart-item">

          <img
            src="images/product-${item.id}.png"
            alt="${item.name}">

          <div class="drawer-item-info">

            <div class="drawer-item-name">
              ${item.name}
            </div>

            <div class="drawer-item-price">
              ${peso(item.price)}
            </div>

            <div class="drawer-item-quantity">
              Quantity: ${item.quantity}
            </div>

          </div>

        </div>

      `;

    }).join('');

  drawerTotal.textContent =
    peso(total);

}
 
  function totalPages(){
    return Math.max(1, Math.ceil(filteredProducts.length / PER_PAGE));
  }
 
  function renderProducts(){

  const start =
    (currentPage - 1) *
    PER_PAGE;

  const pageItems =
    filteredProducts.slice(
      start,
      start + PER_PAGE
    );


  if(pageItems.length === 0){

    grid.innerHTML = `

      <p
        style="
        grid-column:1/-1;
        font-weight:700;
        opacity:.7;">

        No products found.

      </p>

    `;

  }else{

    grid.innerHTML =
      pageItems.map(
        p => {

          const productId = p.id;
          const isOutOfStock = Number(p.stock ?? 20) <= 0;

          return `

            <div class="card${isOutOfStock ? ' out-of-stock' : ''}">

              <a
                class="card-thumb"
                href="product.php?id=${productId}">

                <img
                  src="images/product-${productId}.png"
                  alt="${p.name}">

              </a>

              <div class="card-body">

                <a
                  class="card-name"
                  href="product.php?id=${productId}">
                  ${p.name}
                </a>

                <div class="card-price">
                  ${peso(p.price)}
                </div>

                ` + (function(){
                  // check storage for latest stock

                    if (Number(p.stock) <= 0) {
                      return '<button class="card-btn" type="button" disabled>Out of stock</button>';
                    
                  }
                  return `<button class="card-btn" type="button" onclick="addToCart(${p.id})">Add to Cart</button>`;
                })() + `

              </div>

            </div>

          `;

        }
      ).join('');

  }

 
    const shownCount = Math.min(start + PER_PAGE, filteredProducts.length);
    countEl.textContent = `${filteredProducts.length ? start + 1 : 0}-${shownCount} of ${filteredProducts.length} products`;
  }
 
  function renderPagination(){
    const pages = totalPages();
    let html = `<button id="prevBtn" aria-label="Previous">‹</button>`;
    for (let p = 1; p <= pages; p++){
      html += `<button class="${p === currentPage ? 'active' : ''}" data-page="${p}">${p}</button>`;
    }
    html += `<button id="nextBtn" aria-label="Next">›</button>`;
    paginationEl.innerHTML = html;
  }
 
  function goToPage(page){
    currentPage = Math.min(Math.max(page, 1), totalPages());
    renderProducts();
    renderPagination();
    window.scrollTo({ top: document.querySelector('.toolbar').offsetTop - 80, behavior: 'smooth' });
  }
 
  function changeQty(id, delta){
    const item = cart.find(i => i.id === id);
    if (!item) return;
    item.qty += delta;
    if (item.qty <= 0){
      cart = cart.filter(i => i.id !== id);
      syncCardCheckbox(id, false);
    }
    renderCart();
  }
 
  function removeFromCart(id){
    cart = cart.filter(i => i.id !== id);
    syncCardCheckbox(id, false);
    renderCart();
  }
 
  function syncCardCheckbox(id, checked){
    const checkbox = grid.querySelector(`input[type="checkbox"][data-id="${id}"]`);
    if (!checkbox) return;
    checkbox.checked = checked;
    const label = checkbox.closest('.card-check');
    label.classList.toggle('checked', checked);
    label.lastChild.textContent = checked ? 'Selected' : 'Select';
  }
 
    paginationEl.addEventListener('click', (e) => {
    const btn = e.target.closest('button');
    if (!btn) return;
    if (btn.id === 'prevBtn') return goToPage(currentPage - 1);
    if (btn.id === 'nextBtn') return goToPage(currentPage + 1);
    if (btn.dataset.page) return goToPage(Number(btn.dataset.page));
  });

  const searchToggle = document.getElementById('searchToggle');
  const searchOverlay = document.getElementById('searchOverlay');
  const searchInput = document.getElementById('searchInput');
  const searchClose = document.getElementById('searchClose');
  const searchHint = document.getElementById('searchHint');
        
  const urlParams = new URLSearchParams(window.location.search);

  const initialSearch =
  urlParams.get("search") || "";

  searchQuery =
  initialSearch.toLowerCase();


  function openSearch(){
    searchOverlay.classList.add('open');
    searchInput.value = searchQuery;
    setTimeout(() => searchInput.focus(), 50);
  }
 
  function closeSearch(){
    searchOverlay.classList.remove('open');
  }
 
  function runSearch(query){
    searchQuery = query.trim().toLowerCase();
    if(initialSearch){

    searchInput.value = initialSearch;

}
if(keyword){
    searchInput.value = keyword;
}

applyFiltersAndSort();
      }
 
  const typeFilterOptions = document.getElementById('typeFilterOptions');
  const priceFilterOptions = document.getElementById('priceFilterOptions');
  const clearFiltersBtn = document.getElementById('clearFiltersBtn');
  const sortSelect = document.getElementById('sortSelect');
 
  typeFilterOptions.addEventListener('change', (e) => {
    const cb = e.target.closest('input[type="checkbox"]');
    if (!cb) return;
    const value = cb.dataset.value;
    const targetSet = cb.dataset.filter === 'category' ? selectedCategories : selectedSubcategories;
    if (cb.checked) targetSet.add(value); else targetSet.delete(value);
    applyFiltersAndSort();
  });
 
  priceFilterOptions.addEventListener('change', (e) => {
    const cb = e.target.closest('input[type="checkbox"]');
    if (!cb) return;
    const range = { min: Number(cb.dataset.min), max: Number(cb.dataset.max) };
    if (cb.checked){
      selectedPriceRanges.push(range);
    } else {
      selectedPriceRanges = selectedPriceRanges.filter(r => !(r.min === range.min && r.max === range.max));
    }
    applyFiltersAndSort();
  });
 
  clearFiltersBtn.addEventListener('click', () => {
    selectedCategories.clear();
    selectedSubcategories.clear();
    selectedPriceRanges = [];
    document.querySelectorAll('#typeFilterOptions input, #priceFilterOptions input').forEach(cb => cb.checked = false);
    applyFiltersAndSort();
  });
 
  sortSelect.addEventListener('change', (e) => {
    sortValue = e.target.value;
    applyFiltersAndSort();
  });
 
  searchToggle.addEventListener('click', openSearch);
  searchClose.addEventListener('click', closeSearch);
  searchOverlay.addEventListener('click', (e) => {
    if (e.target === searchOverlay) closeSearch();
  });
  searchInput.addEventListener('input', (e) => runSearch(e.target.value));
  document.addEventListener('keydown', (e) => {
    if (e.key === 'Enter' && searchOverlay.classList.contains('open')) closeSearch();
  });
 
  applyFiltersAndSort();
  document.addEventListener(
  'keydown',
  e => {
    if(
      e.key === 'Escape'
    ){
      if(
        searchOverlay.classList.contains(
          'open'
        )
      ){
        closeSearch();
      }
      if(
        cartDrawer.classList.contains(
          'open'
        )
      ){

        closeCartDrawer();
      }
    }
  }
);
</script>

</body>
</html>

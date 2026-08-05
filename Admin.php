<?php
include "db.php";
?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
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
    font-family: 'times new roman', sans-serif;
    color: var(--ink);
    background:#fff;
    line-height:1.5;
  }

  /* FIXED: Changed .p to p */
  h1,h2,h3,.brand, p {
    font-family:'times new roman', sans-serif;
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

   .nav-icons{
    display:flex;
    align-items:center;
    gap: 22px;
  }

  .nav-icons svg{
    width: 22px;
    height: 25px;
    cursor:pointer;
  }

  .icon-btn{
  background:none;
  border:none;
  padding:0;
  cursor:pointer;
  position:relative;
  display:flex;
  color: var(--ink);
}

.icon-btn svg{
  width: 22px;
  height: 25px;
  transition: color .2s ease, transform .2s ease;
}

.icon-btn:hover svg{
  color: var(--blue-dark);
  transform: translateY(-2px);
}

.icon-btn .dot{
  position:absolute;
  top:-2px; right:-2px;
  width:9px; height:9px;
  border-radius:50%;
  background:#E5735F;
  border:2px solid #fff;
}

  .logo{
    display:flex;
    align-items:center;
    gap:8px;
    font-weight:700;
    font-size: 25px; 
    line-height:1.1;
    color: var(--blue-dark);
  }

  .logo img{ width:38px; height:38px; object-fit:contain; }
  
  .sidenav {
    height: 100%;
    width: 250px;
    position: fixed;
    z-index: 1;
    top: 0; left: 0;
    background-color: var(--blue-dark);
    overflow-x: hidden;
    padding-top: 20px;
  }

  .sidenav a.active {
    background-color: var(--blue);
    color: var(--white);
    font-weight: 700;
  }

  .sidenav a {
    padding: 6px 8px 6px 16px;
    text-decoration: none;
    font-size: 22px;
    color: var(--ink);
    display: block;
  }

  .sidenav a:hover {
    color: #f1f1f1;
    background-color: var(--blue-dark);
  }

  .main {
    margin-left: 250px; 
    font-size: 16px; 
    padding: 0px 10px;
  }
 .dashboard-grid{
    display:grid;
    grid-template-columns: repeat(4,1fr);
    gap:24px;
    margin-top:28px;
  }

  .dashboard-card{
    background: var(--cream);
    border-radius: 20px;
    padding: 26px;
    display:flex;
    flex-direction:column;
    gap:14px;
    box-shadow:0 16px 34px rgba(123,184,240,.08);
  }

  .dashboard-card h3{ margin:0; font-size:18px; color:var(--blue-dark); }
  .dashboard-card p{ margin:0; color:var(--ink); font-size:14px; line-height:1.7; }
  .dashboard-card strong{ font-size:32px; display:block; color:var(--blue-dark); }

  .summary{ display:grid; grid-template-columns: repeat(2,1fr); gap:28px; margin-top:28px; }
  .summary-card{ background:#fff; border-radius:22px; padding:26px; box-shadow:0 18px 40px rgba(0,0,0,.05); }
  .summary-card h3{ margin-bottom:14px; font-size:20px; }
  .summary-card p{ color:#5d6d86; line-height:1.8; }

  @media screen and (max-width: 980px){ .main{ margin-left:0; padding:20px; } .sidenav{position:relative; width:100%; height:auto;} .dashboard-grid{grid-template-columns:1fr 1fr;} }
  @media screen and (max-width: 640px){ .dashboard-grid,.summary{grid-template-columns:1fr;} .navbar{flex-direction:column; align-items:flex-start;} }
</style>
</head>
<body>

<div class="sidenav">
  <a href="Admin.php" class="active">Dashboard</a>
  <a href="Products.php">Products</a> 
  <a href="Service.php">Services</a>
  <a href="Orders.php">Orders</a>
</div>

<div class="main">
  <div class="navbar">
    <div class="nav-left">
      <div class="logo">
        <img src="images/logo.png" alt="FurryCorner logo">
        <span>Admin</span>
      </div>
    </div>
    <div class="nav-icons">
      <button class="icon-btn" aria-label="Notifications">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
          <path d="M18 8a6 6 0 10-12 0c0 7-3 8-3 8h18s-3-1-3-8"/>
          <path d="M13.7 21a2 2 0 01-3.4 0"/>
        </svg>
        <span class="dot"></span>
      </button>
      <button class="icon-btn" aria-label="Profile">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
          <circle cx="12" cy="8" r="4"/>
          <path d="M4 21c0-4 4-6 8-6s8 2 8 6"/>
        </svg>
      </button>
      <button 
        onclick="logoutAdmin()"
        class="icon-btn logout-btn">

            Logout

        </button>
    </div>
  </div>

  <div class="dashboard-grid">
    <div class="dashboard-card">
      <h3>Products</h3>
      <strong>24</strong>
      <p>Manage the entire product catalog and inventory from the dedicated Products page.</p>
    </div>
    <div class="dashboard-card">
      <h3>Services</h3>
      <strong id="serciveCount">0</strong>
      <p>Maintain service offerings, rates, and availability from the separate Services page.</p>
    </div>
    <div class="dashboard-card">
      <h3>Orders</h3>
      <strong>15</strong>
      <p>Track open and completed orders from the Orders section.</p>
    </div>
    <div class="dashboard-card">
      <h3>Inventory Alerts</h3>
      <strong>3</strong>
      <p>Quickly see low-stock and out-of-stock items across products and services.</p>
    </div>
  </div>

  <div class="summary">
    <div class="summary-card">
      <h3>Product Workflow</h3>
      <p>Use Products.php to add new items, update pricing, and track stock. This page remains focused on product catalog management.</p>
    </div>
    <div class="summary-card">
      <h3>Service Workflow</h3>
      <p>Use Services.php to manage grooming, boarding, and care packages separately. This keeps service management independent from product inventory.</p>
    </div>
  </div>
</div>

<script src="shared-order.js"></script>

<script>

const adminLoggedIn = localStorage.getItem("adminLoggedIn");

if(!adminLoggedIn){

    window.location.href = "Login.php";

} else {

    fetch("getDashboardSummary.php")

      .then(response=>response.json())

      .then(summary=>{

          const cards =
          document.querySelectorAll(".dashboard-card strong");

          cards[0].textContent =
          summary.productCount;

          cards[1].textContent =
          summary.serviceCount;

          cards[2].textContent =
          summary.orderCount;

          cards[3].textContent =
          summary.lowStockCount;

      });

}

function logoutAdmin(){

    localStorage.removeItem("adminLoggedIn");

    localStorage.removeItem("adminUser");

    localStorage.removeItem("redirectAfterLogin");


    window.location.href = "Login.php";

}

</script>

</body>
</html>
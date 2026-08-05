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
    background: #fff;   
    line-height:1.5;
}

h1,h2,h3,.brand, p {
    font-family:'times new roman', sans-serif;
}

.header{
    font-family:'times new roman', sans-serif;
    padding: 20px;
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

.logout-btn{
    margin-left: 0;
    padding: 10px 16px;
    border-radius: 14px;
    background: var(--blue);
    color: #fff;
    border: none;
    font-weight: 700;
    font-family: inherit;
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
    padding: 0 20px 40px;  
}

.page-header {
    display: flex;
    justify-content: space-between; /* Pushes h1 to left, button to right */
    align-items: center;            /* Vertically centers them */
}

.page-header h1 {
    margin: 0;
    font-size: 28px;
    color: var(--ink);
}

/* --- TOOLBAR --- */
.toolbar{
    display:flex;
    align-items:center;
    gap:6px;
    background:#fafafa;
    border:1.5px solid #d9dce1;
    border-radius:12px;
    padding:8px 12px;
    margin: 0 0 20px;
}

.tool-btn{
    background:none;
    border:none;
    padding:6px;
    border-radius:8px;
    cursor:pointer;
    display:flex;
    color:var(--ink);
    transition: background .2s ease, color .2s ease;
}
.tool-btn:hover{ background:var(--cream-light); color:var(--blue-dark); }
.tool-btn svg{ width:20px; height:20px; }

.tool-search{
    flex:1;
    border:none;
    background:transparent;
    font-family:inherit;
    font-size:15px;
    font-weight:700;
    color:var(--ink);
    padding:6px 8px;
}
.tool-search:focus{ outline:none; }
.tool-search::placeholder{ color:#9aa1ad; font-weight:600; }

/* --- ORDERS TABLE (SnowUI style) --- */
.table-container{
     width: 100%;
    min-width: 900px;
    border-collapse: collapse;   /* no gaps — header + rows become one block */
    font-size: 15px;
}

.table-container th{
    text-align: left;
    background: var(--cream-light);
    color: var(--ink);
    font-size: 12.5px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: .5px;
    padding: 16px;
}

.table-container td{
    padding: 16px;
    background: var(--white);
    border-bottom: 1px solid #eee;
    font-weight: 600;
    color: var(--ink);
    font-size: 15px;
    text-transform: none;
    letter-spacing: normal;
}


.table-container tbody tr:last-child td{
    border-bottom: none;
}
.table-scroll{
     width: 100%;
    overflow-x: auto;
    background: var(--white);
    border: 1px solid #eee;
    border-radius: 12px;
    box-shadow: 0 4px 10px rgba(0,0,0,.05);
}

.badge{
    display: inline-block;
    padding: 6px 14px;
    border-radius: 999px;
    font-size: 13px;
    font-weight: 700;
}
.badge.shipped   { background: #dbeafe; color: #3b82f6; }
.badge.delivered { background: #d1fae5; color: #10b981; }
.badge.pending   { background: #fef9c3; color: #ca8a04; }
.badge.cancelled { background: #ffc9c9; color: #ff6f6f; }
.badge.paid      { background: #d1fae5; color: #10b981; }
.badge.processing { background: #f3e8ff; color: #9333ea; } 
.badge.refunded { background: #ffedd5; color: #ea580c; }  

.date-cell{
    display: inline-flex;
    align-items: center;
    gap: 8px;
}
.date-cell svg{
    width: 16px;
    height: 16px;
    opacity: .7;
}

.action-btn{
    background: none;
    border: none;
    padding: 6px;
    border-radius: 8px;
    cursor: pointer;
    display: inline-flex;
    color: var(--ink);
    transition: background .2s ease, color .2s ease;
}

.action-btn svg{
    width: 18px;
    height: 18px;
}

.action-btn:hover{
    background: var(--cream-light);
    color: var(--blue-dark);
}

.action-btn.refund:hover{
    background: #fef9c3;
    color: #ca8a04;
}

.modal {
    display: none;
    position: fixed;

    top: 0;
    left: 0;

    width: 100%;
    height: 100%;

    background: rgba(0,0,0,0.5);

    justify-content: center;
    align-items: center;

    z-index: 9999;
}

.modal.open {
    display: flex;
}

.modal-panel {
    background: white;
    width: 500px;
    max-width: 90%;
    max-height: 80vh;

    overflow-y: auto;

    padding: 30px;

    border-radius: 15px;

    position: relative;
}

.modal-close {
    position: absolute;

    top: 15px;
    right: 20px;

    font-size: 30px;

    cursor: pointer;
}

  .order-info{

      margin-top:20px;

  }


  .order-info p{

      margin:10px 0;

  }

@media screen and (max-height: 450px) {
    .sidenav {padding-top: 15px;}
    .sidenav a {font-size: 18px;}
}

@media (max-width: 900px){
    .nav-left{ gap: 20px; }
    .nav-links{ display:none; }
    .menu-toggle{ display:block; }
}

@media (max-width: 480px){
    .container, .navbar, .section, .why, footer{ padding-left:20px; padding-right:20px; }
}
</style>
</head>
<body>

<div class="sidenav">
  <a href="Admin.php">Dashboard</a>
  <a href="Products.php">Products</a> 
  <a href="Service.php">Services</a>
  <a href="Orders.php" class="active">Orders</a>
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
      <button class="icon-btn logout-btn" id="logoutBtn">Logout</button>
    </div>
  </div>

  <div class="page-header">
    <h1 class="header">Order Management</h1>  
  </div>

  <div class="toolbar">
    <button class="tool-btn" aria-label="Filter">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><path d="M4 6h16M7 12h10M10 18h4"/></svg>
    </button>
    <button class="tool-btn" aria-label="Sort">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <path d="M3 8l4-4 4 4"/><path d="M7 4v16"/>
        <path d="M21 16l-4 4-4-4"/><path d="M17 20V4"/>
      </svg>
    </button>

    <input type="text" id="tool-search" class="tool-search" placeholder="Search orders...">

    <button class="tool-btn" aria-label="Search">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><circle cx="11" cy="11" r="7"/><path d="M20 20l-3.5-3.5"/></svg>
    </button>
  </div>

  <div class="table-scroll">
  <table class="table-container">
    <thead>
      <tr>
        <th>Order ID</th>
        <th>Customer Name</th>
        <th>Product Name</th>
        <th>Quantity</th>
        <th>Total Price</th>
        <th>Payment</th>
        <th>Status</th>
        <th>Date Ordered</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody id="orderTableBody">

</tbody>
    </table>

    </div>
</div>

<div class="modal" id="orderModal">

    <div class="modal-panel">

        <span class="modal-close" id="closeOrderModal">
            &times;
        </span>

        <h2>Order Details</h2>

        <div id="orderDetails"></div>

    </div>

</div>

<script src="shared-order.js"></script>

<script>

const adminLoggedIn = localStorage.getItem("adminLoggedIn");


if(adminLoggedIn !== "true"){

    localStorage.setItem(
        "redirectAfterLogin",
        window.location.pathname.split("/").pop()
    );


    window.location.href = "Login.php";

}

</script>

<script>

function loadOrders(){

fetch("getOrders.php")

.then(response => response.json())

.then(data=>{

    const tbody =
    document.getElementById("orderTableBody");

    tbody.innerHTML = "";

    data.forEach(order=>{

    });
tbody.innerHTML="";


data.forEach(order=>{


tbody.innerHTML += `


<tr>

<td>#${order.id}</td>

<td>${order.customer}</td>

<td>${order.product}</td>

<td>${order.quantity}</td>

<td>
₱${Number(order.total).toLocaleString('en-PH',{
minimumFractionDigits:2
})}
</td>


<td>
<span class="badge paid">
${order.payment}
</span>
</td>


<td>
<span class="badge ${order.status.toLowerCase()}">
${order.status}
</span>
</td>


<td>

<span class="date-cell">

${order.date}

</span>

</td>


<td>

<button 
class="action-btn view-order"
data-id="${order.id}">
View
</button>


<button 
class="action-btn refund"
data-id="${order.id}">
Refund
</button>

</td>


</tr>


`;


});


});


}

loadOrders();

const orderModal =
document.getElementById("orderModal");


const closeOrderModal =
document.getElementById("closeOrderModal");


console.log("Modal:", orderModal);
console.log("Close:", closeOrderModal);

closeOrderModal.onclick = function(){

    orderModal.classList.remove("open");

};


document.addEventListener("click", function(e){

    if(e.target.classList.contains("refund")){


        const orderId = e.target.dataset.id;


        if(confirm("Are you sure you want to refund this order?")){


            fetch("updateOrderStatus.php", {

                method:"POST",

                headers:{
                    "Content-Type":
                    "application/x-www-form-urlencoded"
                },

                body:
                "order_id=" + orderId +
                "&status=Cancelled"

            })


            .then(response=>response.text())


            .then(result=>{


                if(result.trim()=="success"){


                    alert("Order refunded successfully!");

                    loadOrders();


                }else{

                    alert(result);

                }


            });


        }


    }


});

document.addEventListener("click",function(e){


if(e.target.classList.contains("view-order")){


let id = e.target.dataset.id;


fetch("getOrderDetails.php?id="+id)


.then(res=>res.json())


.then(order=>{


document.getElementById("orderDetails").innerHTML = `


<p>
<b>Customer:</b>
${order.first_name}
${order.last_name}
</p>


<p>
<b>Address:</b>
${order.address},
${order.city},
${order.province}
</p>


<p>
<b>Phone:</b>
${order.phone}
</p>


<p>
<b>Payment:</b>
${order.payment_method}
</p>


<h3>Products</h3>


${order.items.map(item=>`

<p>
${item.product_name}
 x ${item.quantity}

 - ₱${item.item_total}

</p>


`).join("")}


<p>
<b>Total:</b>
₱${order.total_amount}
</p>


`;



document
.getElementById("orderModal")
.classList.add("open");


});


}


});
  // Admin moved to separate folder; redirect to isolated admin login
  // window.location.href = 'Login.php';

  function renderOrders() {
    const orders = window.FurryCornerStorage.getOrders();
    const tbody = document.querySelector('.table-container tbody');

    if (!orders.length) {
      tbody.innerHTML = '<tr><td colspan="9" style="text-align:center;">No orders yet.</td></tr>';
      return;
    }

    tbody.innerHTML = orders.map((order, index) => {
      const firstItem = order.items && order.items[0] ? order.items[0] : {};
      const totalItems = (order.items || []).reduce((sum, item) => sum + Number(item.quantity || 0), 0);
      const totalPrice = Number(order.total || 0);
      const customerName = order.customerName || `${order.shipping?.firstName || ''} ${order.shipping?.lastName || ''}`.trim() || 'Customer';
      const productName = firstItem.name || 'Multiple items';
      const payment = order.payment || 'Cash on Delivery';
      const statusClass = (order.status || 'Processing').toLowerCase();
      const statusLabel = order.status || 'Processing';
      const date = order.dateOrdered || new Date(order.date || Date.now()).toLocaleDateString('en-PH');
      const orderId = order.orderId || `#CM${(1000 + index).toString()}`;

      return `
        <tr>
          <td>${orderId}</td>
          <td>${customerName}</td>
          <td>${productName}</td>
          <td>${totalItems}</td>
          <td>${window.FurryCornerStorage.formatPrice(totalPrice)}</td>
          <td><span class="badge paid">${payment}</span></td>
          <td><span class="badge ${statusClass}">${statusLabel}</span></td>
          <td><span class="date-cell"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="5" width="18" height="16" rx="2"/><path d="M3 9h18M8 3v4M16 3v4"/></svg>${date}</span></td>
          <td>
            <button class="action-btn" title="View Invoice" aria-label="View Invoice">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M15 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7z"/>
                <path d="M14 2v4a2 2 0 0 0 2 2h4"/>
                <path d="M16 13H8"/>
                <path d="M16 17H8"/>
              </svg>
            </button>
            <button class="action-btn refund" title="Refund" aria-label="Refund">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M9 14 4 9l5-5"/>
                <path d="M4 9h10.5a5.5 5.5 0 0 1 5.5 5.5 5.5 5.5 0 0 1-5.5 5.5H11"/>
              </svg>
            </button>
          </td>
        </tr>
      `;
    }).join('');
  }

  renderOrders();

  document.getElementById('tool-search').addEventListener('input', function(){
    const q = this.value.toLowerCase();
    document.querySelectorAll('.table-container tbody tr').forEach(function(row){
      row.style.display = row.textContent.toLowerCase().includes(q) ? '' : 'none';
    });
  });
</script>
</body>
</html>
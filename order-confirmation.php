<?php
include "db.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Order Confirmed - FurryCorner PH</title>

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
  --gray:#777;
  --border:#e5e5e5;
  --panel:#f7f8fa;
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
  min-height:100vh;
}

a{
  text-decoration:none;
  color:inherit;
}


/* =========================
   HEADER
========================= */

.top-header{
  display:flex;
  justify-content:center;
  padding:26px 20px;
  background:var(--white);
  box-shadow:0 2px 8px rgba(0,0,0,.06);
}

.top-header .logo{
  display:flex;
  align-items:center;
  gap:10px;
  font-family:'Baloo 2',cursive;
  font-weight:800;
  font-size:22px;
  color:var(--blue-dark);
}

.top-header .logo img{
  width:42px;
  height:42px;
  object-fit:contain;
}


/* =========================
   PAGE
========================= */

.container{
  max-width:1100px;
  margin:auto;
  padding:0 30px;
}

.confirmation-wrap{
  padding:45px 0 70px;
}

.box{
  background:white;
  border-radius:16px;
  padding:28px;
  box-shadow:0 4px 14px rgba(0,0,0,.05);
}


/* =========================
   SUMMARY ROWS (shared style)
========================= */

.summary-row{
  display:flex;
  justify-content:space-between;
  margin-bottom:12px;
  font-size:14px;
}

.summary-row.total{
  border-top:1px solid var(--border);
  padding-top:15px;
  margin-top:15px;
  font-size:19px;
  font-weight:800;
}

.summary-row.total span:last-child{
  color:var(--blue-dark);
}


/* =========================
   SHOP BUTTON
========================= */

.shop-btn{
  display:inline-flex;
  align-items:center;
  justify-content:center;
  padding:12px 25px;
  border-radius:8px;
  background:var(--blue);
  color:white;
  font-weight:800;
  border:none;
  cursor:pointer;
  font-size:15px;
}

.shop-btn:hover{
  background:var(--blue-dark);
}


/* =========================
   ORDER CONFIRMATION
========================= */

.confirmation-header{
  margin-bottom:26px;
}

.confirmation-header h2{
  font-family:'Baloo 2',cursive;
  font-size:32px;
  margin-bottom:12px;
}

.confirmation-check-row{
  display:flex;
  align-items:center;
  gap:9px;
  font-weight:800;
  font-size:16px;
  color:var(--ink);
  margin-bottom:8px;
}

.confirmation-check-row svg{
  width:20px;
  height:20px;
  color:#3fb27f;
  flex-shrink:0;
}

.confirmation-header .confirmation-note{
  font-size:14px;
  color:var(--gray);
}

.confirmation-layout{
  display:grid;
  grid-template-columns:1fr 1fr;
  gap:24px;
  align-items:start;
}

.confirm-box{
  background:var(--white);
  border:1.5px solid var(--border);
  border-radius:14px;
  padding:22px 24px;
  margin-bottom:20px;
}

.confirm-box:last-child{
  margin-bottom:0;
}

.confirm-box h3{
  font-family:'Baloo 2',cursive;
  font-size:19px;
  margin-bottom:14px;
}

.confirm-box h4{
  font-size:14px;
  font-weight:800;
  margin-bottom:4px;
}

.confirm-box p{
  font-size:14.5px;
  color:var(--ink);
  margin-bottom:14px;
  line-height:1.5;
}

.confirm-box p:last-child{
  margin-bottom:0;
}

.confirm-order-id{
  font-family:'Baloo 2',cursive;
  font-size:20px;
  font-weight:700;
}

.confirmation-summary-box{
  background:var(--panel);
}

.confirmation-item{
  display:flex;
  align-items:center;
  gap:14px;
  padding:12px 0;
  border-bottom:1px solid var(--border);
}

.confirmation-item:first-of-type{
  padding-top:0;
}

.confirmation-item:last-of-type{
  border-bottom:none;
}

.confirmation-item img{
  width:52px;
  height:52px;
  border-radius:8px;
  background:var(--white);
  object-fit:contain;
  padding:5px;
  flex-shrink:0;
}

.confirmation-item-info{
  flex:1;
  min-width:0;
}

.confirmation-item-name{
  font-weight:800;
  font-size:14px;
  line-height:1.4;
}

.confirmation-item-price{
  font-weight:800;
  font-size:14px;
  white-space:nowrap;
}

.confirmation-totals{
  margin-top:14px;
  padding-top:14px;
  border-top:1px solid var(--border);
}

.confirmation-totals .summary-row{
  font-size:14px;
}

.confirmation-totals .summary-row.total{
  border-top:1px solid var(--border);
  padding-top:14px;
  margin-top:4px;
  font-size:18px;
}

.confirmation-totals .summary-row.total span:last-child{
  color:var(--ink);
}

.confirmation-totals .summary-row.total .peso-tag{
  font-size:12px;
  font-weight:700;
  color:var(--gray);
  margin-right:4px;
}

.confirmation-empty{
  text-align:center;
  padding:70px 20px;
}

.confirmation-empty h2{
  font-family:'Baloo 2',cursive;
  font-size:26px;
  margin-bottom:10px;
}

.confirmation-empty p{
  color:var(--gray);
  margin-bottom:20px;
}


/* =========================
   RESPONSIVE
========================= */

@media (max-width:800px){

  .confirmation-layout{
    grid-template-columns:1fr;
  }

}

</style>
</head>
<body>

<div class="top-header">
  <a href="FurryCorner.php" class="logo">
    <img src="images/logo.png" alt="FurryCorner logo">
    FurryCorner
  </a>
</div>

<main class="container">

  <div class="confirmation-wrap">

    <div class="box success" id="confirmationRoot">
      <!-- Filled by JS from localStorage.lastOrder -->
    </div>

  </div>

</main>

<script>

function peso(n){
  return '₱' + Number(n).toLocaleString('en-PH', { minimumFractionDigits: 2 });
}


/* =========================
   RENDER ORDER CONFIRMATION
========================= */

function renderOrderConfirmation(order){

  const root =
    document.getElementById('confirmationRoot');


  if(!order){

    root.innerHTML = `

      <div class="confirmation-empty">

        <h2>No recent order found</h2>

        <p>
          We couldn't find an order to show you. If you just checked out,
          try refreshing this page.
        </p>

        <a href="FurryCorner.php" class="shop-btn">
          Continue Shopping
        </a>

      </div>

    `;

    return;

  }


  const shipping =
    order.shipping || {};


  const addressLine =
    [
      shipping.address,
      shipping.city,
      shipping.province,
      shipping.postal,
      "Philippines"
    ]
      .filter(part => part && part.trim() !== "")
      .join(", ");


  const itemCount =
    order.items.reduce(
      (sum, item) =>
        sum + Number(item.quantity),
      0
    );


  const itemsHtml =
    order.items.map(item => {

      const itemTotal =
        Number(item.price) *
        Number(item.quantity);

      return `

        <div class="confirmation-item">

          <img
            src="images/product-${item.id}.png"
            alt="${item.name}">

          <div class="confirmation-item-info">
            <div class="confirmation-item-name">
              ${item.name}
            </div>
          </div>

          <div class="confirmation-item-price">
            ${peso(itemTotal)}
          </div>

        </div>

      `;

    }).join("");


  root.innerHTML = `

    <div class="confirmation-header">

      <h2>Thank you, ${shipping.firstName || 'friend'}!</h2>

      <div class="confirmation-check-row">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="12" cy="12" r="10"/><polyline points="8 12 11 15 16 9"/></svg>
        Your order is confirmed.
      </div>

      <p class="confirmation-note">
        You'll receive a confirmation email with your order number and tracking link shortly.
      </p>

    </div>


    <div class="confirmation-layout">

      <div>

        <div class="confirm-box">
          <p class="confirm-order-id">
            Order #${order.order_id || '-'}
          </p>
        </div>

        <div class="confirm-box">

          <h3>Customer Information</h3>

          <h4>Contact</h4>
          <p>${shipping.email || '-'}</p>

          <h4>Shipping Address</h4>
          <p>${addressLine || '-'}</p>

          <h4>Shipping Method</h4>
          <p>Standard Delivery</p>

        </div>

        <div class="confirm-box">
          <h3>Payment Method</h3>
          <p>${order.payment || '-'}</p>
        </div>

      </div>


      <div>

        <div class="confirm-box confirmation-summary-box">

          <h3>Order Summary (${itemCount} item${itemCount === 1 ? '' : 's'})</h3>

          <div>
            ${itemsHtml}
          </div>

          <div class="confirmation-totals">

            <div class="summary-row">
              <span>Subtotal</span>
              <span>${peso(order.subtotal)}</span>
            </div>

            <div class="summary-row">
              <span>Shipping</span>
              <span>${peso(order.shippingFee)}</span>
            </div>

            <div class="summary-row total">
              <span>Total</span>
              <span>
                <span class="peso-tag">PHP</span>${peso(order.total)}
              </span>
            </div>

          </div>

        </div>

        <a
          href="FurryCorner.php"
          class="shop-btn"
          style="display:block; width:100%; text-align:center;">

          Continue Shopping

        </a>

      </div>

    </div>

  `;

}


/* =========================
   START
========================= */

const savedOrder =
  JSON.parse(
    localStorage.getItem("lastOrder")
  );

renderOrderConfirmation(savedOrder);

</script>

</body>
</html>
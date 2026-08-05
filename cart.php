<?php
include "db.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Cart - FurryCorner PH</title>

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

button,
input,
select{
  font-family:'Nunito',sans-serif;
}


/* =========================
   NAVBAR
========================= */

.navbar{
  position:sticky;
  top:0;
  z-index:1000;
  background:var(--white);
  display:flex;
  align-items:center;
  justify-content:space-between;
  padding:14px 40px;
  box-shadow:0 2px 8px rgba(0,0,0,.06);
}

.nav-left{
  display:flex;
  align-items:center;
  gap:44px;
}

.logo img{
  width:38px;
  height:38px;
  object-fit:contain;
}

.nav-links{
  display:flex;
  gap:32px;
  list-style:none;
  font-weight:700;
  font-size:15px;
}

.nav-links a:hover{
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
}

.cart-link{
  position:relative;
  display:flex;
}

.cart-badge{
  position:absolute;
  top:-9px;
  right:-10px;
  min-width:17px;
  height:17px;
  padding:0 4px;
  display:flex;
  justify-content:center;
  align-items:center;
  border-radius:50%;
  background:var(--blue-dark);
  color:white;
  font-size:10px;
  font-weight:800;
}


/* =========================
   PAGE
========================= */

.container{
  max-width:1100px;
  margin:auto;
  padding:0 30px;
}

.page-title{
  padding:45px 0 25px;
}

.page-title h1{
  font-family:'Baloo 2',cursive;
  font-size:36px;
  font-weight:800;
}


/* =========================
   CHECKOUT STEPS
========================= */

.steps{
  background:white;
  border-radius:16px;
  padding:22px 30px;
  margin-bottom:30px;
  box-shadow:0 4px 14px rgba(0,0,0,.05);
  display:flex;
  align-items:center;
  justify-content:center;
}

.step{
  display:flex;
  align-items:center;
  color:#aaa;
  font-weight:800;
  font-size:14px;
}

.step-number{
  width:32px;
  height:32px;
  border-radius:50%;
  display:flex;
  align-items:center;
  justify-content:center;
  background:#eee;
  margin-right:8px;
}

.step.active{
  color:var(--blue-dark);
}

.step.active .step-number{
  background:var(--blue);
  color:white;
}

.step.completed{
  color:var(--blue-dark);
}

.step.completed .step-number{
  background:var(--blue-dark);
  color:white;
}

.step-line{
  width:70px;
  height:2px;
  background:#ddd;
  margin:0 15px;
}


/* =========================
   CHECKOUT CONTENT
========================= */

.checkout-section{
  display:none;
}

.checkout-section.active{
  display:block;
}

.checkout-layout{
  display:grid;
  grid-template-columns:1fr 350px;
  gap:30px;
  align-items:start;
}

.box{
  background:white;
  border-radius:16px;
  padding:28px;
  box-shadow:0 4px 14px rgba(0,0,0,.05);
}

.box h2{
  font-family:'Baloo 2',cursive;
  font-size:25px;
  margin-bottom:20px;
}


/* =========================
   CART ITEMS
========================= */

.cart-item{
  display:grid;
  grid-template-columns:80px 1fr auto;
  gap:18px;
  align-items:center;
  padding:18px 0;
  border-bottom:1px solid var(--border);
}

.cart-item:first-child{
  padding-top:0;
}

.cart-image{
  width:80px;
  height:80px;
  border-radius:10px;
  background:var(--blue);
  padding:7px;
  object-fit:contain;
}

.cart-name{
  font-weight:800;
  font-size:15px;
}

.cart-price{
  color:var(--blue-dark);
  font-weight:800;
  margin-top:4px;
}

.quantity-controls{
  display:flex;
  align-items:center;
  gap:10px;
  margin-top:8px;
}

.quantity-controls button{
  width:28px;
  height:28px;
  border:1px solid var(--blue);
  background:white;
  border-radius:6px;
  cursor:pointer;
  font-weight:800;
}

.quantity-controls span{
  min-width:20px;
  text-align:center;
  font-weight:800;
}

.item-total{
  font-weight:800;
  text-align:right;
}

.remove-btn{
  display:block;
  border:none;
  background:none;
  color:#999;
  cursor:pointer;
  font-size:12px;
  margin-top:5px;
}

.remove-btn:hover{
  color:#e55;
}


/* =========================
   SUMMARY
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

.checkout-btn{
  width:100%;
  height:46px;
  margin-top:20px;
  border:none;
  border-radius:9px;
  background:var(--blue);
  color:white;
  font-weight:800;
  font-size:15px;
  cursor:pointer;
}

.checkout-btn:hover{
  background:var(--blue-dark);
}

.back-btn{
  width:100%;
  height:44px;
  margin-top:10px;
  border:1.5px solid var(--blue);
  border-radius:9px;
  background:white;
  color:var(--blue-dark);
  font-weight:800;
  cursor:pointer;
}


/* =========================
   FORMS
========================= */

.form-grid{
  display:grid;
  grid-template-columns:1fr 1fr;
  gap:18px;
}

.form-group{
  display:flex;
  flex-direction:column;
  gap:7px;
}

.form-group.full{
  grid-column:1/-1;
}

.form-group label{
  font-weight:800;
  font-size:14px;
}

.form-group input,
.form-group select{
  height:44px;
  border:1.5px solid #ddd;
  border-radius:8px;
  padding:0 13px;
  outline:none;
  background:white;
}

.form-group input:focus,
.form-group select:focus{
  border-color:var(--blue);
}


/* =========================
   PAYMENT
========================= */

.payment-options{
  display:flex;
  flex-direction:column;
  gap:12px;
}

.payment-option{
  border:1.5px solid #ddd;
  border-radius:10px;
  padding:15px;
  display:flex;
  align-items:center;
  gap:12px;
  cursor:pointer;
}

.payment-option:hover{
  border-color:var(--blue);
}

.payment-option input{
  accent-color:var(--blue-dark);
}

.payment-info{
  margin-top:20px;
}


/* =========================
   REVIEW
========================= */

.review-block{
  margin-bottom:25px;
}

.review-block h3{
  font-family:'Baloo 2',cursive;
  font-size:19px;
  margin-bottom:8px;
}

.review-block p{
  font-size:14px;
  margin-bottom:3px;
}

.review-item{
  display:flex;
  justify-content:space-between;
  padding:12px 0;
  border-bottom:1px solid var(--border);
  font-size:14px;
}

.place-order{
  background:var(--blue-dark);
}

.place-order:hover{
  background:#438fd8;
}


/* =========================
   SUCCESS
========================= */

.success{
  text-align:center;
  padding:60px 30px;
}

.success-icon{
  width:70px;
  height:70px;
  border-radius:50%;
  background:var(--blue);
  color:white;
  display:flex;
  align-items:center;
  justify-content:center;
  font-size:35px;
  margin:0 auto 20px;
}

.success h2{
  font-family:'Baloo 2',cursive;
  font-size:30px;
  margin-bottom:10px;
}

.success p{
  color:var(--gray);
  margin-bottom:20px;
}


/* =========================
   EMPTY CART
========================= */

.empty-cart{
  text-align:center;
  padding:60px 20px;
}

.empty-cart h2{
  font-family:'Baloo 2',cursive;
  font-size:28px;
  margin-bottom:10px;
}

.empty-cart p{
  color:var(--gray);
  margin-bottom:20px;
}

.shop-btn{
  display:inline-flex;
  align-items:center;
  justify-content:center;
  padding:12px 25px;
  border-radius:8px;
  background:var(--blue);
  color:white;
  font-weight:800;
}

/* Empty cart rounded alert */
.cart-empty-alert{
  display:none;
  max-width:920px;
  margin:14px auto;
  padding:12px 18px;
  background: rgba(123,184,240,0.12);
  border:1px solid var(--blue);
  color:var(--blue-dark);
  border-radius:12px;
  text-align:center;
  font-weight:800;
}


/* =========================
   RESPONSIVE
========================= */

@media(max-width:800px){

  .nav-links{
    display:none;
  }

  .nav-left{
    gap:20px;
  }

  .checkout-layout{
    grid-template-columns:1fr;
  }

  .form-grid{
    grid-template-columns:1fr;
  }

  .form-group.full{
    grid-column:auto;
  }

  .step-line{
    width:25px;
    margin:0 6px;
  }

  .step{
    font-size:11px;
  }

  .step-number{
    width:27px;
    height:27px;
    font-size:12px;
  }

}

@media(max-width:500px){

  .navbar{
    padding:12px 20px;
  }

  .container{
    padding:0 18px;
  }

  .steps{
    padding:18px 8px;
  }

  .step span:not(.step-number){
    display:none;
  }

  .step-line{
    width:35px;
  }

  .cart-item{
    grid-template-columns:60px 1fr;
  }

  .cart-image{
    width:60px;
    height:60px;
  }

  .item-total{
    grid-column:2;
    text-align:left;
  }

}

/* =========================
   SIGN-IN MODAL
========================= */

.signin-backdrop{
  position:fixed;
  inset:0;
  background:rgba(31,36,48,.55);
  z-index:5000;
  display:none;
  align-items:center;
  justify-content:center;
  padding:20px;
}

.signin-backdrop.open{
  display:flex;
}

.signin-card{
  background:white;
  width:100%;
  max-width:400px;
  border-radius:16px;
  padding:34px 32px 30px;
  box-shadow:0 20px 50px rgba(0,0,0,.25);
  position:relative;
}

.signin-close{
  position:absolute;
  top:16px;
  right:16px;
  background:none;
  border:none;
  cursor:pointer;
  color:var(--ink);
}

.signin-close svg{
  width:20px;
  height:20px;
}

.signin-card h2{
  font-family:'Baloo 2',cursive;
  font-size:22px;
  text-align:center;
  margin-bottom:6px;
}

.signin-card p.signin-sub{
  text-align:center;
  font-size:14px;
  color:var(--gray);
  margin-bottom:22px;
}

.signin-field{
  width:100%;
  height:46px;
  border:1.5px solid #ddd;
  border-radius:8px;
  padding:0 14px;
  outline:none;
  margin-bottom:14px;
  font-family:'Nunito',sans-serif;
  font-size:14.5px;
}

.signin-field:focus{
  border-color:var(--blue);
}

.signin-error{
  color:#e0685f;
  font-size:13px;
  font-weight:700;
  margin:-6px 0 12px;
  display:none;
}

.signin-error.show{
  display:block;
}

.signin-submit{
  width:100%;
  height:48px;
  border-radius:9px;
  border:none;
  background:var(--blue);
  color:white;
  font-weight:800;
  font-size:15px;
  cursor:pointer;
  margin-top:4px;
}

.signin-submit:hover{
  background:var(--blue-dark);
}

.signin-switch{
  text-align:center;
  margin-top:18px;
  font-size:13.5px;
  color:var(--gray);
}

.signin-switch a{
  color:var(--blue-dark);
  font-weight:800;
  text-decoration:underline;
}

</style>
</head>

<body>

<!-- =========================
     SIGN-IN MODAL
========================= -->

<div class="signin-backdrop" id="signinBackdrop">

  <div class="signin-card">

    <button class="signin-close" id="signinCloseBtn" aria-label="Close">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
    </button>

    <h2>Sign in to continue</h2>
    <p class="signin-sub">Please sign in before proceeding to checkout.</p>

    <div class="signin-error" id="signinError">Please enter both your email and password.</div>

    <input class="signin-field" type="email" id="signinEmail" placeholder="Email address">
    <input class="signin-field" type="password" id="signinPassword" placeholder="Password">

    <button class="signin-submit" id="signinSubmitBtn">Sign in</button>

    <div class="signin-switch">
      Don't have an account? <a href="signup.php">Sign up</a>
    </div>

  </div>

</div>


<!-- =========================
     NAVBAR
========================= -->

<nav class="navbar">

  <div class="nav-left">

    <a href="FurryCorner.php">
      <div class="logo">
        <img src="images/logo.png" alt="FurryCorner">
      </div>
    </a>

    <ul class="nav-links">
      <li><a href="FurryCorner.php">Home</a></li>
      <li><a href="AllProducts.php">All Products</a></li>
      <li><a href="services.php">Services</a></li>
      <li><a href="#">About</a></li>
      <li><a href="#">Contact Us</a></li>
    </ul>

  </div>

  <div class="nav-icons">

    <!-- Account -->
    <svg viewBox="0 0 24 24" fill="none"
         stroke="currentColor" stroke-width="2">
      <circle cx="12" cy="8" r="4"/>
      <path d="M4 21c0-4 4-6 8-6s8 2 8 6"/>
    </svg>


    <!-- Cart -->
    <a href="cart.php" class="cart-link">

      <svg viewBox="0 0 24 24" fill="none"
           stroke="currentColor" stroke-width="2">

        <circle cx="9" cy="21" r="1"/>
        <circle cx="20" cy="21" r="1"/>

        <path d="M1 1h4l2.6 13.4a2 2 0 002 1.6h9.7a2 2 0 002-1.6L23 6H6"/>

      </svg>

      <span class="cart-badge" id="cartBadge">0</span>

    </a>

  </div>

</nav>


<!-- =========================
     PAGE
========================= -->

<main class="container">

  <div class="page-title">
    <h1>Checkout</h1>
  </div>


  <!-- =========================
       STEPS
  ========================= -->

  <div class="steps">

    <div class="step active" id="stepIndicator1">
      <span class="step-number">1</span>
      <span>Cart</span>
    </div>

    <div class="step-line"></div>

    <div class="step" id="stepIndicator2">
      <span class="step-number">2</span>
      <span>Shipping</span>
    </div>

    <div class="step-line"></div>

    <div class="step" id="stepIndicator3">
      <span class="step-number">3</span>
      <span>Payment</span>
    </div>

    <div class="step-line"></div>

    <div class="step" id="stepIndicator4">
      <span class="step-number">4</span>
      <span>Review</span>
    </div>

  </div>


  <!-- =========================
       STEP 1 - CART
  ========================= -->

  <section class="checkout-section active" id="cartStep">

    <div class="checkout-layout">

      <div class="box">

        <h2>Your Cart</h2>

        <div id="cartItems"></div>

      </div>


      <div class="box">

        <h2>Order Summary</h2>

        <div class="summary-row">
          <span>Subtotal</span>
          <span id="subtotal">₱0.00</span>
        </div>

        <div class="summary-row">
          <span>Shipping</span>
          <span id="shipping">₱50.00</span>
        </div>

        <div class="summary-row total">
          <span>Total</span>
          <span id="grandTotal">₱0.00</span>
        </div>

        <button class="checkout-btn" onclick="handleProceedToCheckout()">
          Proceed to Checkout
        </button>

      </div>

    </div>

  </section>


  <!-- =========================
       STEP 2 - SHIPPING
  ========================= -->

  <section class="checkout-section" id="shippingStep">

    <div class="checkout-layout">

      <div class="box">

        <h2>Shipping Information</h2>

        <div class="form-grid">

          <div class="form-group">
            <label>First Name</label>
            <input type="text" id="firstName" placeholder="First name">
          </div>

          <div class="form-group">
            <label>Last Name</label>
            <input type="text" id="lastName" placeholder="Last name">
          </div>

          <div class="form-group full">
            <label>Address</label>
            <input type="text" id="address" placeholder="House number, street, barangay">
          </div>

          <div class="form-group">
            <label>City</label>
            <input type="text" id="city" placeholder="City">
          </div>

          <div class="form-group">
            <label>Province</label>
            <input type="text" id="province" placeholder="Province">
          </div>

          <div class="form-group">
            <label>Postal Code</label>
            <input type="text" id="postal" placeholder="Postal code">
          </div>

          <div class="form-group">
            <label>Phone Number</label>
            <input type="tel" id="phone" placeholder="09XXXXXXXXX">
          </div>

        </div>

      </div>


      <div class="box">

        <h2>Summary</h2>

        <div class="summary-row">
          <span>Subtotal</span>
          <span id="shippingSubtotal">₱0.00</span>
        </div>

        <div class="summary-row">
          <span>Shipping</span>
          <span>₱50.00</span>
        </div>

        <div class="summary-row total">
          <span>Total</span>
          <span id="shippingTotal">₱0.00</span>
        </div>

        <button class="checkout-btn" onclick="validateShipping()">
          Continue to Payment
        </button>

        <button class="back-btn" onclick="goToStep(1)">
          Back to Cart
        </button>

      </div>

    </div>

  </section>


  <!-- =========================
       STEP 3 - PAYMENT
  ========================= -->

  <section class="checkout-section" id="paymentStep">

    <div class="checkout-layout">

      <div class="box">

        <h2>Payment Information</h2>

        <div class="payment-options">

          <label class="payment-option">
            <input
              type="radio"
              name="payment"
              value="Cash on Delivery"
              checked>

            <span>
              <strong>Cash on Delivery</strong><br>
              Pay when your order arrives.
            </span>
          </label>


          <label class="payment-option">
            <input
              type="radio"
              name="payment"
              value="GCash">

            <span>
              <strong>GCash</strong><br>
              Pay using your GCash account.
            </span>
          </label>


          <label class="payment-option">
            <input
              type="radio"
              name="payment"
              value="Credit/Debit Card">

            <span>
              <strong>Credit / Debit Card</strong><br>
              Pay using your card.
            </span>
          </label>

        </div>


        <div class="payment-info" id="cardInfo">

          <div class="form-grid">

            <div class="form-group full">
              <label>Cardholder Name</label>
              <input
                type="text"
                id="cardName"
                placeholder="Name on card">
            </div>

            <div class="form-group full">
              <label>Card Number</label>
              <input
                type="text"
                id="cardNumber"
                placeholder="XXXX XXXX XXXX XXXX"
                maxlength="19">
            </div>

            <div class="form-group">
              <label>Expiry Date</label>
              <input
                type="text"
                id="expiry"
                placeholder="MM/YY">
            </div>

            <div class="form-group">
              <label>CVV</label>
              <input
                type="password"
                id="cvv"
                placeholder="CVV"
                maxlength="4">
            </div>

          </div>

        </div>

      </div>


      <div class="box">

        <h2>Order Summary</h2>

        <div class="summary-row">
          <span>Subtotal</span>
          <span id="paymentSubtotal">₱0.00</span>
        </div>

        <div class="summary-row">
          <span>Shipping</span>
          <span>₱50.00</span>
        </div>

        <div class="summary-row total">
          <span>Total</span>
          <span id="paymentTotal">₱0.00</span>
        </div>

        <button class="checkout-btn" onclick="goToStep(4)">
          Continue to Review
        </button>

        <button class="back-btn" onclick="goToStep(2)">
          Back to Shipping
        </button>

      </div>

    </div>

  </section>


  <!-- =========================
       STEP 4 - REVIEW
  ========================= -->

  <section class="checkout-section" id="reviewStep">

    <div class="checkout-layout">

      <div class="box">

        <h2>Order Review</h2>


        <div class="review-block">

          <h3>Shipping Information</h3>

          <p id="reviewName"></p>
          <p id="reviewAddress"></p>
          <p id="reviewCity"></p>
          <p id="reviewPhone"></p>

        </div>


        <div class="review-block">

          <h3>Payment Method</h3>

          <p id="reviewPayment"></p>

        </div>


        <div class="review-block">

          <h3>Items</h3>

          <div id="reviewItems"></div>

        </div>

      </div>


      <div class="box">

        <h2>Order Summary</h2>

        <div class="summary-row">
          <span>Subtotal</span>
          <span id="reviewSubtotal">₱0.00</span>
        </div>

        <div class="summary-row">
          <span>Shipping</span>
          <span>₱50.00</span>
        </div>

        <div class="summary-row total">
          <span>Total</span>
          <span id="reviewTotal">₱0.00</span>
        </div>


        <button
          class="checkout-btn place-order"
          onclick="placeOrder()">

          Place Order

        </button>


        <button
          class="back-btn"
          onclick="goToStep(3)">

          Back to Payment

        </button>

      </div>

    </div>

  </section>


  <!-- =========================
       SUCCESS
  ========================= -->

  <section
    class="checkout-section"
    id="successStep">

    <div class="box success">

      <div class="success-icon">
        ✓
      </div>

      <h2>Order Placed Successfully!</h2>

      <p>
        Thank you for shopping with FurryCorner PH.
      </p>

      <p>
        Your order has been received and is being processed.
      </p>

      <a
        href="FurryCorner.php"
        class="shop-btn">

        Continue Shopping

      </a>

    </div>

  </section>

</main>

<script src="shared-order.js"></script>
<script>

/* =========================
   SIGN-IN GATE
   NOTE: front-end only — this does not verify credentials against a real
   account system. Wire it up to your actual auth backend before going live.
========================= */

let isSignedIn =
  localStorage.getItem("loggedInUser") !== null;

const signinBackdrop = document.getElementById('signinBackdrop');
const signinEmail = document.getElementById('signinEmail');
const signinPassword = document.getElementById('signinPassword');
const signinError = document.getElementById('signinError');
const signinSubmitBtn = document.getElementById('signinSubmitBtn');
const signinCloseBtn = document.getElementById('signinCloseBtn');

function openSigninModal(){
  signinBackdrop.classList.add('open');
  signinError.classList.remove('show');
  document.body.style.overflow = 'hidden';
}

function closeSigninModal(){
  signinBackdrop.classList.remove('open');
  document.body.style.overflow = '';
}

function handleProceedToCheckout(){

  if(cart.length === 0){

    showEmptyCartAlert(
      'Your cart is empty. Add some products before checking out.'
    );

    return;

  }


  const loggedUser =
    JSON.parse(
      localStorage.getItem("loggedInUser")
    );


  if(!loggedUser){

    openSigninModal();

    return;

  }


  goToStep(2);

}

function showEmptyCartAlert(message){
  let el = document.getElementById('cartEmptyAlert');
  if(!el){
    el = document.createElement('div');
    el.id = 'cartEmptyAlert';
    el.className = 'cart-empty-alert';
    const container = document.querySelector('.container') || document.body;
    container.prepend(el);
  }
  el.innerHTML = message;
  el.style.display = 'block';
  clearTimeout(el._timeout);
  el._timeout = setTimeout(()=>{ el.style.display = 'none'; }, 4000);
}

signinSubmitBtn.addEventListener('click', () => {

  const loggedUser =
    JSON.parse(
      localStorage.getItem("loggedInUser")
    );


  if(!loggedUser){

    signinError.textContent =
      "Please sign in first.";

    signinError.classList.add('show');

    return;

  }


  closeSigninModal();

  goToStep(2);

});

[signinEmail, signinPassword].forEach(field => {
  field.addEventListener('keydown', (e) => {
    if(e.key === 'Enter') signinSubmitBtn.click();
  });
});

signinCloseBtn.addEventListener('click', closeSigninModal);

signinBackdrop.addEventListener('click', (e) => {
  if(e.target === signinBackdrop) closeSigninModal();
});

document.addEventListener('keydown', (e) => {
  if(e.key === 'Escape' && signinBackdrop.classList.contains('open')) closeSigninModal();
});


/* =========================
   CART DATA
========================= */

let cart =
  JSON.parse(
    localStorage.getItem('cart')
  ) || [];


const SHIPPING_FEE = 50;


/* =========================
   PRICE FORMAT
========================= */

function peso(number){

  return '₱' +
    Number(number).toLocaleString(
      'en-PH',
      {
        minimumFractionDigits:2
      }
    );

}


/* =========================
   CART TOTAL
========================= */

function getSubtotal(){

  return cart.reduce(
    (total,item) =>
      total +
      Number(item.price) *
      Number(item.quantity),
    0
  );

}


function getTotal(){

  if(cart.length === 0){
    return 0;
  }

  return getSubtotal() + SHIPPING_FEE;

}


/* =========================
   CART BADGE
========================= */

function updateCartBadge(){

  const badge =
    document.getElementById(
      'cartBadge'
    );

  const count =
    cart.reduce(
      (total,item) =>
        total + Number(item.quantity),
      0
    );

  badge.textContent = count;

  badge.style.display =
    count > 0 ? 'flex' : 'none';

}


/* =========================
   RENDER CART
========================= */

function renderCart(){

  const container =
    document.getElementById(
      'cartItems'
    );


  if(cart.length === 0){

    container.innerHTML = `

      <div class="empty-cart">

        <h2>Your cart is empty</h2>

        <p>
          Add some products before checking out.
        </p>

        <a
            href="AllProducts.php"
          class="shop-btn">

          Shop Products

        </a>

      </div>

    `;

    return;

  }


  container.innerHTML =
    cart.map(item => {

      const imageNumber =
        item.id;

      const itemTotal =
        Number(item.price) *
        Number(item.quantity);


      return `

        <div class="cart-item">

          <img
            class="cart-image"
            src="images/product-${imageNumber}.png"
            alt="${item.name}">


          <div>

            <div class="cart-name">
              ${item.name}
            </div>

            <div class="cart-price">
              ${peso(item.price)}
            </div>


            <div class="quantity-controls">

              <button
                onclick="changeQuantity(${item.id}, -1)">
                −
              </button>

              <span>
                ${item.quantity}
              </span>

              <button
                onclick="changeQuantity(${item.id}, 1)">
                +
              </button>

            </div>

          </div>


          <div class="item-total">

            ${peso(itemTotal)}

            <button
              class="remove-btn"
              onclick="removeItem(${item.id})">

              Remove

            </button>

          </div>

        </div>

      `;

    }).join('');


  updateTotals();

}


/* =========================
   CHANGE QUANTITY
========================= */

function changeQuantity(id, amount){

  const item =
    cart.find(
      item => item.id === id
    );


  if(!item){
    return;
  }


  // Prevent exceeding stock
  if(amount > 0){

    if(item.quantity + amount > item.stock){

      alert(
        "Only " + item.stock + " item(s) available."
      );

      return;

    }

  }


  item.quantity += amount;


  if(item.quantity <= 0){

    cart =
      cart.filter(
        item => item.id !== id
      );

  }


  saveCart();

}


/* =========================
   REMOVE ITEM
========================= */

function removeItem(id){

  cart =
    cart.filter(
      item => item.id !== id
    );

  saveCart();

}


/* =========================
   SAVE CART
========================= */

function saveCart(){

  localStorage.setItem(
    'cart',
    JSON.stringify(cart)
  );

  renderCart();

  updateCartBadge();

  updateTotals();

}


/* =========================
   UPDATE TOTALS
========================= */

function updateTotals(){

  const subtotal =
    getSubtotal();

  const total =
    getTotal();


  document.querySelectorAll(
    '#subtotal,#shippingSubtotal,#paymentSubtotal,#reviewSubtotal'
  ).forEach(el => {

    el.textContent =
      peso(subtotal);

  });


  document.querySelectorAll(
    '#grandTotal,#shippingTotal,#paymentTotal,#reviewTotal'
  ).forEach(el => {

    el.textContent =
      peso(total);

  });

}


/* =========================
   STEP FLOW
========================= */

let currentStep = 1;


function goToStep(step){

  if(cart.length === 0){

    alert(
      'Your cart is empty.'
    );

    return;

  }


  currentStep = step;


  document.querySelectorAll(
    '.checkout-section'
  ).forEach(section => {

    section.classList.remove(
      'active'
    );

  });


  if(step === 1){

    document
      .getElementById('cartStep')
      .classList.add('active');

  }

  if(step === 2){

    document
      .getElementById('shippingStep')
      .classList.add('active');

  }

  if(step === 3){

    document
      .getElementById('paymentStep')
      .classList.add('active');

  }

  if(step === 4){

    prepareReview();

    document
      .getElementById('reviewStep')
      .classList.add('active');

  }


  updateStepIndicators(step);

  window.scrollTo({
    top:0,
    behavior:'smooth'
  });

}


/* =========================
   STEP INDICATORS
========================= */

function updateStepIndicators(step){

  for(let i=1;i<=4;i++){

    const indicator =
      document.getElementById(
        'stepIndicator' + i
      );


    indicator.classList.remove(
      'active',
      'completed'
    );


    if(i < step){

      indicator.classList.add(
        'completed'
      );

    }

    if(i === step){

      indicator.classList.add(
        'active'
      );

    }

  }

}


/* =========================
   SHIPPING VALIDATION
========================= */

function validateShipping(){

  const fields = [

    'firstName',
    'lastName',
    'address',
    'city',
    'province',
    'postal',
    'phone'

  ];


  for(const id of fields){

    const input =
      document.getElementById(id);


    if(input.value.trim() === ''){

      alert(
        'Please complete all shipping information.'
      );

      input.focus();

      return;

    }

  }


  goToStep(3);

}


/* =========================
   PREPARE REVIEW
========================= */

function prepareReview(){

  const firstName =
    document.getElementById(
      'firstName'
    ).value;

  const lastName =
    document.getElementById(
      'lastName'
    ).value;

  const address =
    document.getElementById(
      'address'
    ).value;

  const city =
    document.getElementById(
      'city'
    ).value;

  const province =
    document.getElementById(
      'province'
    ).value;

  const postal =
    document.getElementById(
      'postal'
    ).value;

  const phone =
    document.getElementById(
      'phone'
    ).value;


  document.getElementById(
    'reviewName'
  ).textContent =
    firstName + ' ' + lastName;


  document.getElementById(
    'reviewAddress'
  ).textContent =
    address;


  document.getElementById(
    'reviewCity'
  ).textContent =
    city + ', ' +
    province + ' ' +
    postal;


  document.getElementById(
    'reviewPhone'
  ).textContent =
    'Phone: ' + phone;


  const payment =
    document.querySelector(
      'input[name="payment"]:checked'
    );


  document.getElementById(
    'reviewPayment'
  ).textContent =
    payment
      ? payment.value
      : 'Not selected';


  const reviewItems =
    document.getElementById(
      'reviewItems'
    );


  reviewItems.innerHTML =
    cart.map(item => {

      const itemTotal =
        Number(item.price) *
        Number(item.quantity);


      return `

        <div class="review-item">

          <span>
            ${item.name}
            × ${item.quantity}
          </span>

          <strong>
            ${peso(itemTotal)}
          </strong>

        </div>

      `;

    }).join('');


  updateTotals();

}


/* =========================
   PLACE ORDER
========================= */

function placeOrder(){

  const stockResult = window.FurryCornerStorage.deductStock(cart);

  if (!stockResult.ok) {
    alert(`Not enough stock for ${stockResult.insufficient.join(', ')}.`);
    return;
  }

  const order = {

    items:cart,

    shipping:{

      firstName:
        document.getElementById(
          'firstName'
        ).value,

      lastName:
        document.getElementById(
          'lastName'
        ).value,

      address:
        document.getElementById(
          'address'
        ).value,

      city:
        document.getElementById(
          'city'
        ).value,

      province:
        document.getElementById(
          'province'
        ).value,

      postal:
        document.getElementById(
          'postal'
        ).value,

      phone:
        document.getElementById(
          'phone'
        ).value

    },

    payment:
      document.querySelector(
        'input[name="payment"]:checked'
      ).value,

    subtotal:getSubtotal(),

    shippingFee:SHIPPING_FEE,

    total:getTotal(),

    date:new Date().toISOString()

  };


  fetch("saveOrder.php", {

    method:"POST",

    headers:{
        "Content-Type":"application/json"
    },

    body: JSON.stringify(order)

})

.then(response=>response.json())

.then(data=>{

    if(data.success){

        localStorage.removeItem('cart');

        cart=[];

        document.querySelectorAll(
          '.checkout-section'
        ).forEach(section=>{
          section.classList.remove('active');
        });


        document
        .getElementById('successStep')
        .classList.add('active');


    }

});

  localStorage.setItem(
    'lastOrder',
    JSON.stringify(savedOrder)
  );


  /* Clear cart after order */

  localStorage.removeItem(
    'cart'
  );

  cart = [];


  document.querySelectorAll(
    '.checkout-section'
  ).forEach(section => {

    section.classList.remove(
      'active'
    );

  });


  document
    .getElementById('successStep')
    .classList.add('active');


  document.querySelectorAll(
    '.step'
  ).forEach(step => {

    step.classList.add(
      'completed'
    );

    step.classList.remove(
      'active'
    );

  });


  updateCartBadge();

  window.scrollTo({
    top:0,
    behavior:'smooth'
  });

}


/* =========================
   PAYMENT DISPLAY
========================= */

document.querySelectorAll(
  'input[name="payment"]'
).forEach(radio => {

  radio.addEventListener(
    'change',
    () => {

      const cardInfo =
        document.getElementById(
          'cardInfo'
        );


      if(
        radio.value ===
        'Credit/Debit Card' &&
        radio.checked
      ){

        cardInfo.style.display =
          'block';

      }else{

        cardInfo.style.display =
          'none';

      }

    }
  );

});


/* =========================
   START
========================= */

renderCart();

updateCartBadge();

updateTotals();

</script>

</body>
</html>


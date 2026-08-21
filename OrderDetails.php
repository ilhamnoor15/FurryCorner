<?php

include "db.php";

header_remove("Content-Type");

?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Order Details - FurryCorner PH</title>

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

body{
    font-family:'Nunito',sans-serif;
    color:var(--ink);
    background:var(--cream);
    min-height:100vh;
}

a{
    text-decoration:none;
    color:inherit;
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
    box-shadow:0 2px 0 rgba(0,0,0,.04);
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
    align-items:center;
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

.nav-icon-button{
    position:relative;
    display:flex;
    align-items:center;
    justify-content:center;
    width:38px;
    height:38px;
    border:none;
    background:none;
    color:var(--ink);
    cursor:pointer;
}

.nav-icon-button:hover{
    color:var(--blue-dark);
}

.nav-icon-button svg{
    width:22px;
    height:22px;
}

.cart-badge{
    position:absolute;
    top:0;
    right:-2px;
    min-width:17px;
    height:17px;
    padding:0 4px;
    border-radius:20px;
    background:var(--blue-dark);
    color:white;
    font-size:10px;
    font-weight:800;
    display:none;
    align-items:center;
    justify-content:center;
}

/* =========================
   PAGE
========================= */

.container{
    max-width:1000px;
    margin:auto;
    padding:50px 30px 70px;
}

.back-link{
    display:inline-block;
    margin-bottom:20px;
    color:var(--blue-dark);
    font-weight:800;
}

.back-link:hover{
    text-decoration:underline;
}

.page-title{
    margin-bottom:25px;
}

.page-title h1{
    font-family:'Baloo 2',cursive;
    font-size:36px;
    font-weight:800;
}

/* =========================
   ORDER CARD
========================= */

.order-card{
    background:white;
    border-radius:16px;
    padding:30px;
    box-shadow:0 4px 14px rgba(0,0,0,.05);
    margin-bottom:20px;
}

.order-header{
    display:flex;
    justify-content:space-between;
    align-items:flex-start;
    gap:20px;
    padding-bottom:20px;
    border-bottom:1px solid var(--border);
}

.order-number{
    font-size:22px;
    font-weight:800;
}

.order-date{
    color:#888;
    font-size:13px;
    margin-top:5px;
}

/* =========================
   STATUS
========================= */

.status{
    padding:8px 14px;
    border-radius:20px;
    font-size:12px;
    font-weight:800;
}

.status.pending{
    background:#fff3cd;
    color:#9a7200;
}

.status.processing{
    background:#e4f2ff;
    color:#3279b9;
}

.status.shipped{
    background:#e9e2ff;
    color:#6743a5;
}

.status.delivered{
    background:#e2f7ed;
    color:#27845a;
}

.status.cancelled{
    background:#ffe5e5;
    color:#c23b3b;
}

/* =========================
   SECTIONS
========================= */

.section-title{
    font-family:'Baloo 2',cursive;
    font-size:21px;
    margin-bottom:15px;
}

.info-section{
    padding:25px 0;
    border-bottom:1px solid var(--border);
}

.info-grid{
    display:grid;
    grid-template-columns:1fr 1fr;
    gap:18px;
}

.info-item{
    font-size:14px;
}

.info-label{
    color:#888;
    font-size:12px;
    font-weight:700;
    margin-bottom:3px;
}

.info-value{
    font-weight:700;
}

/* =========================
   PRODUCTS
========================= */

.product-list{
    display:flex;
    flex-direction:column;
    gap:12px;
}

.product-item{
    display:flex;
    justify-content:space-between;
    align-items:center;
    padding:15px;
    border:1px solid var(--border);
    border-radius:10px;
}

.product-name{
    font-weight:800;
}

.product-details{
    color:#777;
    font-size:13px;
    margin-top:3px;
}

.product-total{
    font-weight:800;
    font-size:15px;
}

/* =========================
   TOTALS
========================= */

.total-section{
    padding-top:25px;
}

.total-row{
    display:flex;
    justify-content:space-between;
    padding:7px 0;
    font-size:14px;
}

.total-row.grand-total{
    border-top:1px solid var(--border);
    margin-top:10px;
    padding-top:15px;
    font-size:20px;
    font-weight:800;
}

/* =========================
   BUTTON
========================= */

.back-orders{
    display:inline-block;
    margin-top:20px;
    background:var(--blue);
    color:white;
    padding:11px 20px;
    border-radius:8px;
    font-weight:800;
}

.back-orders:hover{
    background:var(--blue-dark);
}

/* =========================
   LOADING / ERROR
========================= */

.message-card{
    background:white;
    border-radius:16px;
    padding:60px 30px;
    text-align:center;
    box-shadow:0 4px 14px rgba(0,0,0,.05);
}

.message-card h2{
    font-family:'Baloo 2',cursive;
    margin-bottom:8px;
}

.message-card p{
    color:#888;
}

/* =========================
   RESPONSIVE
========================= */

@media(max-width:750px){

    .navbar{
        padding:12px 20px;
    }

    .nav-links{
        display:none;
    }

    .container{
        padding:30px 20px 50px;
    }

    .order-header{
        flex-direction:column;
    }

    .info-grid{
        grid-template-columns:1fr;
    }

    .product-item{
        align-items:flex-start;
        gap:15px;
    }

}

</style>

</head>

<body>

<!-- =========================
     NAVBAR
========================= -->

<nav class="navbar">

    <div class="nav-left">

        <a href="FurryCorner.php" class="logo">

            <img
                src="images/logo.png"
                alt="FurryCorner logo">

        </a>

        <ul class="nav-links">

            <li>
                <a href="FurryCorner.php">
                    Home
                </a>
            </li>

            <li>
                <a href="AllProducts.php">
                    All Products
                </a>
            </li>

            <li>
                <a href="services.php">
                    Services
                </a>
            </li>

            <li>
                <a href="about.php">
                    About
                </a>
            </li>

            <li>
                <a href="contact.php">
                    Contact Us
                </a>
            </li>

        </ul>

    </div>

    <div class="nav-icons">

        <!-- PROFILE -->

        <a
            href="profile.php"
            class="nav-icon-button">

            <svg
                viewBox="0 0 24 24"
                fill="none"
                stroke="currentColor"
                stroke-width="2">

                <circle cx="12" cy="8" r="4"/>

                <path
                    d="M4 21c0-4 4-6 8-6s8 2 8 6"/>

            </svg>

        </a>

        <!-- CART -->

        <a
            href="cart.php"
            class="nav-icon-button">

            <svg
                viewBox="0 0 24 24"
                fill="none"
                stroke="currentColor"
                stroke-width="2">

                <circle cx="9" cy="21" r="1"/>

                <circle cx="20" cy="21" r="1"/>

                <path
                    d="M1 1h4l2.6 13.4a2 2 0 002 1.6h9.7a2 2 0 002-1.6L23 6H6"/>

            </svg>

            <span
                class="cart-badge"
                id="cartBadge">

                0

            </span>

        </a>

    </div>

</nav>


<!-- =========================
     PAGE
========================= -->

<main class="container">

    <a
        href="OrderHistory.php"
        class="back-link">

        ← Back to My Orders

    </a>

    <div class="page-title">

        <h1>
            Order Details
        </h1>

    </div>


    <div id="orderContainer">

        <div class="message-card">

            <h2>
                Loading order...
            </h2>

            <p>
                Please wait while we load your order details.
            </p>

        </div>

    </div>

</main>


<footer>

    © 2026 FurryCorner PH. All rights reserved.

</footer>


<script>

/* =========================
   GET ORDER ID
========================= */

const urlParams =
    new URLSearchParams(
        window.location.search
    );

const orderId =
    urlParams.get("order_id");


/* =========================
   CHECK ORDER ID
========================= */

if(!orderId){

    document.getElementById(
        "orderContainer"
    ).innerHTML = `

        <div class="message-card">

            <h2>
                Order not found
            </h2>

            <p>
                No order ID was provided.
            </p>

        </div>

    `;

}else{

    loadOrder();

}


/* =========================
   LOAD ORDER
========================= */

function loadOrder(){

    fetch(
        "getOrderDetails.php?id=" +
        encodeURIComponent(orderId)
    )

    .then(response => response.json())

    .then(data => {

        console.log(
            "Order details:",
            data
        );


        /*
            Your current getOrderDetails.php
            returns the order directly.

            Example:

            {
                order_id: 1,
                first_name: "...",
                items: [...]
            }
        */

        const order =
            data.order || data;


        if(!order || !order.order_id){

            showError(
                "Order could not be found."
            );

            return;

        }


        renderOrder(order);

    })

    .catch(error => {

        console.error(
            "Order details error:",
            error
        );

        showError(
            "Unable to load order details."
        );

    });

}


/* =========================
   RENDER ORDER
========================= */

function renderOrder(order){

    const status =
        String(
            order.status || "Pending"
        ).toLowerCase();


    const items =
        order.items || [];


    const itemsHTML =
        items.length

        ?

        items.map(item => `

            <div class="product-item">

                <div>

                    <div class="product-name">

                        ${escapeHTML(
                            item.product_name
                        )}

                    </div>

                    <div class="product-details">

                        ₱${formatPrice(item.price)}
                        ×
                        ${item.quantity}

                    </div>

                </div>

                <div class="product-total">

                    ₱${formatPrice(
                        item.item_total
                    )}

                </div>

            </div>

        `).join("")

        :

        `

            <p style="color:#888;">
                No items found.
            </p>

        `;


    document.getElementById(
        "orderContainer"
    ).innerHTML = `

        <div class="order-card">

            <!-- ORDER HEADER -->

            <div class="order-header">

                <div>

                    <div class="order-number">

                        Order #${order.order_id}

                    </div>

                    <div class="order-date">

                        ${formatDate(
                            order.order_date
                        )}

                    </div>

                </div>


                <span
                    class="status ${status}">

                    ${escapeHTML(
                        order.status || "Pending"
                    )}

                </span>

            </div>


            <!-- CUSTOMER INFORMATION -->

            <div class="info-section">

                <h2 class="section-title">

                    Delivery Information

                </h2>


                <div class="info-grid">

                    <div class="info-item">

                        <div class="info-label">
                            Customer
                        </div>

                        <div class="info-value">

                            ${escapeHTML(
                                order.first_name || ""
                            )}

                            ${escapeHTML(
                                order.last_name || ""
                            )}

                        </div>

                    </div>


                    <div class="info-item">

                        <div class="info-label">
                            Phone Number
                        </div>

                        <div class="info-value">

                            ${escapeHTML(
                                order.phone || ""
                            )}

                        </div>

                    </div>


                    <div class="info-item">

                        <div class="info-label">
                            Address
                        </div>

                        <div class="info-value">

                            ${escapeHTML(
                                order.address || ""
                            )}

                        </div>

                    </div>


                    <div class="info-item">

                        <div class="info-label">
                            City
                        </div>

                        <div class="info-value">

                            ${escapeHTML(
                                order.city || ""
                            )}

                        </div>

                    </div>


                    <div class="info-item">

                        <div class="info-label">
                            Province
                        </div>

                        <div class="info-value">

                            ${escapeHTML(
                                order.province || ""
                            )}

                        </div>

                    </div>


                    <div class="info-item">

                        <div class="info-label">
                            Postal Code
                        </div>

                        <div class="info-value">

                            ${escapeHTML(
                                order.postal_code || ""
                            )}

                        </div>

                    </div>

                </div>

            </div>


            <!-- PAYMENT -->

            <div class="info-section">

                <h2 class="section-title">

                    Payment Information

                </h2>


                <div class="info-item">

                    <div class="info-label">
                        Payment Method
                    </div>

                    <div class="info-value">

                        ${escapeHTML(
                            order.payment_method || ""
                        )}

                    </div>

                </div>

            </div>


            <!-- PRODUCTS -->

            <div class="info-section">

                <h2 class="section-title">

                    Ordered Items

                </h2>


                <div class="product-list">

                    ${itemsHTML}

                </div>

            </div>


            <!-- TOTAL -->

            <div class="total-section">

                <div class="total-row">

                    <span>
                        Subtotal
                    </span>

                    <strong>
                        ₱${formatPrice(
                            order.subtotal
                        )}
                    </strong>

                </div>


                <div class="total-row">

                    <span>
                        Shipping Fee
                    </span>

                    <strong>
                        ₱${formatPrice(
                            order.shipping_fee
                        )}
                    </strong>

                </div>


                <div class="total-row grand-total">

                    <span>
                        Total
                    </span>

                    <span>
                        ₱${formatPrice(
                            order.total_amount
                        )}
                    </span>

                </div>

            </div>

        </div>

    `;

}


/* =========================
   FORMAT PRICE
========================= */

function formatPrice(value){

    return Number(
        value || 0
    ).toLocaleString(
        "en-PH",
        {
            minimumFractionDigits:2,
            maximumFractionDigits:2
        }
    );

}


/* =========================
   FORMAT DATE
========================= */

function formatDate(date){

    if(!date){
        return "";
    }

    return new Date(date).toLocaleDateString(
        "en-PH",
        {
            month:"long",
            day:"numeric",
            year:"numeric"
        }
    );

}


/* =========================
   ESCAPE HTML
========================= */

function escapeHTML(value){

    const div =
        document.createElement("div");

    div.textContent =
        value ?? "";

    return div.innerHTML;

}


/* =========================
   ERROR
========================= */

function showError(message){

    document.getElementById(
        "orderContainer"
    ).innerHTML = `

        <div class="message-card">

            <h2>
                Unable to load order
            </h2>

            <p>
                ${escapeHTML(message)}
            </p>

        </div>

    `;

}


/* =========================
   CART BADGE
========================= */

function updateCartBadge(){

    const badge =
        document.getElementById(
            "cartBadge"
        );

    if(!badge){
        return;
    }


    let cart = [];

    try{

        cart =
            JSON.parse(
                localStorage.getItem("cart")
            ) || [];

    }catch(error){

        cart = [];

    }


    const totalItems =
        cart.reduce(
            (total,item) => {

                return total +
                    (
                        Number(
                            item.quantity
                        ) || 0
                    );

            },
            0
        );


    if(totalItems > 0){

        badge.textContent =
            totalItems > 99
                ? "99+"
                : totalItems;

        badge.style.display =
            "flex";

    }else{

        badge.style.display =
            "none";

    }

}


updateCartBadge();

window.addEventListener(
    "pageshow",
    updateCartBadge
);

</script>

</body>

</html>
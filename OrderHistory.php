<?php

include "db.php";

header_remove("Content-Type");

?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>My Orders - FurryCorner PH</title>

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
    left:0;
    right:0;
    z-index:1000;
    background:var(--white);
    display:flex;
    align-items:center;
    justify-content:space-between;
    padding:14px 40px;
    box-shadow:0 2px 0 rgba(0,0,0,0.04);
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
    justify-content:center;
    gap:22px;
    height:38px;
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
    text-decoration:none;
    padding:0;
}

.nav-icon-button:hover{
    color:var(--blue-dark);
}

.nav-icon-button svg{
    width:22px;
    height:22px;
}


/* =========================
   BADGES
========================= */

.notif-icon-wrap{
    position:relative;
}

.notif-badge{
    position:absolute;
    top:1px;
    right:0;
    min-width:17px;
    height:17px;
    padding:0 4px;
    border-radius:20px;
    background:#ef5b6b;
    color:white;
    font-size:10px;
    font-weight:800;
    align-items:center;
    justify-content:center;
}

.cart-link{
    position:relative;
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
    align-items:center;
    justify-content:center;
}


/* =========================
   NOTIFICATION
========================= */

.notif-dropdown{
    position:fixed;
    top:72px;
    right:40px;
    width:360px;
    max-width:calc(100vw - 30px);
    background:white;
    border-radius:14px;
    box-shadow:0 10px 35px rgba(0,0,0,.15);
    z-index:3000;
    display:none;
    overflow:hidden;
}

.notif-dropdown.open{
    display:block;
}

.notif-header{
    display:flex;
    align-items:center;
    justify-content:space-between;
    padding:18px;
    border-bottom:1px solid var(--border);
}

.notif-header h3{
    font-family:'Baloo 2',cursive;
    font-size:20px;
}

.notif-mark-read{
    border:none;
    background:none;
    color:var(--blue-dark);
    font-size:12px;
    font-weight:800;
    cursor:pointer;
}

.notif-list{
    max-height:400px;
    overflow-y:auto;
}

.notif-item{
    position:relative;
    display:flex;
    gap:12px;
    padding:16px 18px;
    border-bottom:1px solid #f0f0f0;
}

.notif-item.unread{
    background:#f4f9fe;
}

.notif-icon{
    width:36px;
    height:36px;
    flex-shrink:0;
    display:flex;
    align-items:center;
    justify-content:center;
    border-radius:50%;
    background:var(--cream-light);
}

.notif-icon svg{
    width:18px;
    height:18px;
}

.notif-body{
    flex:1;
}

.notif-title{
    font-weight:800;
    font-size:14px;
    margin-bottom:3px;
}

.notif-message{
    font-size:12px;
    color:#777;
    line-height:1.4;
}

.notif-time{
    font-size:11px;
    color:#aaa;
    margin-top:5px;
}

.notif-unread-dot{
    width:8px;
    height:8px;
    background:var(--blue-dark);
    border-radius:50%;
    margin-top:5px;
}

.notif-empty{
    padding:35px 20px;
    text-align:center;
    color:#999;
    font-size:14px;
}


/* =========================
   SEARCH
========================= */

.search-overlay{
    position:fixed;
    inset:0;
    background:rgba(31,36,48,.55);
    display:none;
    align-items:flex-start;
    justify-content:center;
    padding:90px 20px 20px;
    z-index:4000;
}

.search-overlay.open{
    display:flex;
}

.search-container{
    width:100%;
    max-width:760px;
}

.search-box{
    width:100%;
    height:58px;
    background:white;
    border-radius:14px;
    display:flex;
    align-items:center;
    padding:0 18px;
    box-shadow:0 15px 40px rgba(0,0,0,.2);
}

.search-box svg{
    width:22px;
    height:22px;
}

.search-box input{
    flex:1;
    border:none;
    outline:none;
    font-family:'Nunito',sans-serif;
    font-size:16px;
    padding:0 14px;
}

.search-close{
    border:none;
    background:none;
    cursor:pointer;
}

.search-close svg{
    width:22px;
    height:22px;
}


/* =========================
   PAGE
========================= */

.container{
    max-width:1100px;
    margin:auto;
    padding:50px 30px 70px;
}

.page-title{
    margin-bottom:30px;
}

.page-title h1{
    font-family:'Baloo 2',cursive;
    font-size:36px;
    font-weight:800;
}


/* =========================
   ACCOUNT LAYOUT
========================= */

.account-layout{
    display:grid;
    grid-template-columns:220px 1fr;
    gap:30px;
    align-items:start;
}


/* =========================
   SIDEBAR
========================= */

.sidebar{
    background:white;
    border-radius:16px;
    padding:25px;
    box-shadow:0 4px 14px rgba(0,0,0,.05);
}

.sidebar h2{
    font-family:'Baloo 2',cursive;
    font-size:22px;
    margin-bottom:20px;
}

.sidebar a{
    display:block;
    padding:12px 14px;
    border-radius:8px;
    font-weight:700;
    margin-bottom:5px;
}

.sidebar a:hover{
    background:var(--cream-light);
    color:var(--blue-dark);
}

.sidebar a.active{
    background:var(--blue);
    color:white;
}


/* =========================
   ORDERS CARD
========================= */

.orders-card{
    background:white;
    border-radius:16px;
    padding:30px;
    box-shadow:0 4px 14px rgba(0,0,0,.05);
}

.orders-header{
    display:flex;
    align-items:center;
    justify-content:space-between;
    margin-bottom:25px;
}

.orders-header h2{
    font-family:'Baloo 2',cursive;
    font-size:27px;
}


/* =========================
   ORDER ITEM
========================= */

.order-card{
    border:1.5px solid var(--border);
    border-radius:12px;
    padding:20px;
    margin-bottom:15px;
    transition:.2s;
}

.order-card:hover{
    border-color:var(--blue);
    box-shadow:0 5px 15px rgba(0,0,0,.05);
}

.order-top{
    display:flex;
    align-items:center;
    justify-content:space-between;
    margin-bottom:15px;
}

.order-number{
    font-size:16px;
    font-weight:800;
}

.order-date{
    font-size:13px;
    color:#888;
    margin-top:3px;
}


/* =========================
   STATUS
========================= */

.status{
    padding:7px 12px;
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
   ORDER BOTTOM
========================= */

.order-bottom{
    display:flex;
    align-items:center;
    justify-content:space-between;
    padding-top:15px;
    border-top:1px solid var(--border);
}

.order-info{
    font-size:13px;
    color:#777;
}

.order-total{
    font-size:17px;
    font-weight:800;
}

.view-btn{
    border:none;
    background:var(--blue);
    color:white;
    padding:9px 16px;
    border-radius:8px;
    font-weight:800;
    cursor:pointer;
}

.view-btn:hover{
    background:var(--blue-dark);
}


/* =========================
   EMPTY ORDERS
========================= */

.empty-orders{
    text-align:center;
    padding:60px 20px;
}

.empty-orders h3{
    font-family:'Baloo 2',cursive;
    font-size:24px;
    margin-bottom:8px;
}

.empty-orders p{
    color:#888;
    font-size:14px;
    margin-bottom:20px;
}

.shop-btn{
    display:inline-block;
    background:var(--blue);
    color:white;
    padding:11px 20px;
    border-radius:8px;
    font-weight:800;
}

.shop-btn:hover{
    background:var(--blue-dark);
}


/* =========================
   FOOTER
========================= */

footer{
    background:white;
    text-align:center;
    padding:25px;
    font-size:13px;
    color:#888;
    margin-top:30px;
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

    .account-layout{
        grid-template-columns:1fr;
    }

    .sidebar{
        display:flex;
        align-items:center;
        gap:10px;
        padding:15px;
    }

    .sidebar h2{
        display:none;
    }

    .sidebar a{
        margin:0;
    }

    .order-top{
        align-items:flex-start;
        gap:10px;
    }

    .order-bottom{
        flex-direction:column;
        align-items:flex-start;
        gap:12px;
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

        <!-- SEARCH -->

        <button
            type="button"
            class="nav-icon-button"
            id="searchToggle">

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

        </button>


        <!-- ACCOUNT -->

        <a
            href="profile.php"
            class="nav-icon-button">

            <svg
                viewBox="0 0 24 24"
                fill="none"
                stroke="currentColor"
                stroke-width="2">

                <circle
                    cx="12"
                    cy="8"
                    r="4"/>

                <path
                    d="M4 21c0-4 4-6 8-6s8 2 8 6"/>

            </svg>

        </a>


        <!-- NOTIFICATIONS -->

        <button
            type="button"
            class="nav-icon-button notif-icon-wrap"
            id="notifToggle">

            <svg
                viewBox="0 0 24 24"
                fill="none"
                stroke="currentColor"
                stroke-width="2">

                <path
                    d="M18 8a6 6 0 00-12 0c0 7-3 9-3 9h18s-3-2-3-9"/>

                <path
                    d="M13.73 21a2 2 0 01-3.46 0"/>

            </svg>

            <span
                class="notif-badge"
                id="notifBadge"
                style="display:none;">

                0

            </span>

        </button>


        <!-- CART -->

        <a
            href="cart.php"
            class="nav-icon-button cart-link">

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

        </a>

    </div>

</nav>


<!-- =========================
     NOTIFICATIONS
========================= -->

<div
    class="notif-dropdown"
    id="notifDropdown">

    <div class="notif-header">

        <h3>
            Notifications
        </h3>

        <button
            class="notif-mark-read"
            id="notifMarkAllRead">

            Mark all as read

        </button>

    </div>

    <div
        class="notif-list"
        id="notifList">
    </div>

</div>


<!-- =========================
     SEARCH
========================= -->

<div
    class="search-overlay"
    id="searchOverlay">

    <div class="search-container">

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
                placeholder="Search products or services...">

            <button
                type="button"
                class="search-close"
                id="searchClose">

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

    </div>

</div>


<!-- =========================
     PAGE
========================= -->

<main class="container">

    <div class="page-title">

        <h1>
            My Account
        </h1>

    </div>


    <div class="account-layout">


        <!-- SIDEBAR -->

        <aside class="sidebar">

            <h2>
                My Account
            </h2>

            <a
                href="OrderHistory.php"
                class="active">

                Orders

            </a>

            <a href="profile.php">

                Profile

            </a>

        </aside>


        <!-- ORDERS -->

        <section class="orders-card">

            <div class="orders-header">

                <h2>
                    My Orders
                </h2>

            </div>


            <div id="ordersContainer">

                <div class="empty-orders">

                    <p>
                        Loading your orders...
                    </p>

                </div>

            </div>

        </section>

    </div>

</main>


<footer>

    © 2026 FurryCorner PH. All rights reserved.

</footer>


<script>

/* =========================
   GET LOGGED-IN USER
========================= */

let loggedUser = null;

try{

    loggedUser =
        JSON.parse(
            localStorage.getItem("loggedInUser")
        );

}catch(error){

    loggedUser = null;

}


if(!loggedUser || !loggedUser.id){

    alert("Please sign in first.");

    window.location.href =
        "signin.php";

}


/* =========================
   LOAD ORDERS
========================= */

function loadOrders(){

    fetch(
        "getOrderHistory.php?user_id=" +
        encodeURIComponent(loggedUser.id)
    )

    .then(response => response.json())

    .then(data => {

        console.log("Orders:", data);

        if(!data.success){

            document.getElementById(
                "ordersContainer"
            ).innerHTML = `

                <div class="empty-orders">

                    <h3>
                        Unable to load orders
                    </h3>

                    <p>
                        ${data.message || "Something went wrong."}
                    </p>

                </div>

            `;

            return;

        }


        const orders = data.orders;


        if(!orders || orders.length === 0){

            document.getElementById(
                "ordersContainer"
            ).innerHTML = `

                <div class="empty-orders">

                    <h3>
                        No orders yet
                    </h3>

                    <p>
                        You haven't placed any orders yet.
                    </p>

                    <a
                        href="AllProducts.php"
                        class="shop-btn">

                        Start Shopping

                    </a>

                </div>

            `;

            return;

        }


        document.getElementById(
            "ordersContainer"
        ).innerHTML =

            orders.map(order => {

                const status =
                    String(
                        order.status || "Pending"
                    ).toLowerCase();


                const itemCount =
                    Number(
                        order.item_count
                    ) || 0;


                return `

                    <div class="order-card">

                        <div class="order-top">

                            <div>

                                <div class="order-number">

                                    Order #${order.order_id}

                                </div>

                                <div class="order-date">

                                    ${formatDate(order.order_date)}

                                </div>

                            </div>


                            <span
                                class="status ${status}">

                                ${order.status}

                            </span>

                        </div>


                        <div class="order-bottom">

                            <div>

                                <div class="order-info">

                                    ${itemCount}
                                    ${itemCount === 1 ? "item" : "items"}

                                </div>

                                <div class="order-total">

                                    ₱${formatPrice(order.total_amount)}

                                </div>

                            </div>


                            <button
                                class="view-btn"
                                onclick="viewOrder(${order.order_id})">

                                View Order

                            </button>

                        </div>

                    </div>

                `;

            }).join("");

    })

    .catch(error => {

        console.error(
            "Order history error:",
            error
        );

        document.getElementById(
            "ordersContainer"
        ).innerHTML = `

            <div class="empty-orders">

                <h3>
                    Unable to load orders
                </h3>

                <p>
                    Please try again later.
                </p>

            </div>

        `;

    });

}


/* =========================
   FORMAT PRICE
========================= */

function formatPrice(value){

    return Number(value || 0).toLocaleString(
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
   VIEW ORDER
========================= */

function viewOrder(orderId){

    window.location.href =
        "OrderDetails.php?order_id=" +
        encodeURIComponent(orderId);

}


/* =========================
   CART BADGE
========================= */

function updateCartBadge(){

    const badge =
        document.getElementById(
            "cartBadge"
        );


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
            (total,item) =>
                total +
                (
                    Number(item.quantity) || 0
                ),
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


/* =========================
   SEARCH
========================= */

const searchToggle =
    document.getElementById(
        "searchToggle"
    );

const searchOverlay =
    document.getElementById(
        "searchOverlay"
    );

const searchClose =
    document.getElementById(
        "searchClose"
    );

const searchInput =
    document.getElementById(
        "searchInput"
    );


searchToggle.addEventListener(
    "click",
    function(){

        searchOverlay.classList.add(
            "open"
        );

        searchInput.focus();

    }
);


searchClose.addEventListener(
    "click",
    function(){

        searchOverlay.classList.remove(
            "open"
        );

    }
);


searchOverlay.addEventListener(
    "click",
    function(e){

        if(e.target === searchOverlay){

            searchOverlay.classList.remove(
                "open"
            );

        }

    }
);


document.addEventListener(
    "keydown",
    function(e){

        if(e.key === "Escape"){

            searchOverlay.classList.remove(
                "open"
            );

        }

    }
);


/* =========================
   NOTIFICATIONS
========================= */

const notifications = [

    {
        id:"n1",
        title:"Order update",
        message:"Your order status has been updated.",
        time:"Recently",
        read:false
    }

];


const notifToggle =
    document.getElementById(
        "notifToggle"
    );

const notifDropdown =
    document.getElementById(
        "notifDropdown"
    );

const notifList =
    document.getElementById(
        "notifList"
    );

const notifBadge =
    document.getElementById(
        "notifBadge"
    );

const notifMarkAllRead =
    document.getElementById(
        "notifMarkAllRead"
    );


function renderNotifications(){

    const unread =
        notifications.filter(
            n => !n.read
        ).length;


    if(unread){

        notifBadge.style.display =
            "flex";

        notifBadge.textContent =
            unread;

    }else{

        notifBadge.style.display =
            "none";

    }


    notifList.innerHTML =
        notifications.length

            ? notifications.map(
                n => `

                    <div
                        class="notif-item ${
                            n.read ? "" : "unread"
                        }">

                        <div class="notif-icon">

                            <svg
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="2">

                                <path
                                    d="M3 5h18v14H3z"/>

                            </svg>

                        </div>

                        <div class="notif-body">

                            <div class="notif-title">

                                ${n.title}

                            </div>

                            <div class="notif-message">

                                ${n.message}

                            </div>

                            <div class="notif-time">

                                ${n.time}

                            </div>

                        </div>

                    </div>

                `
            ).join("")

            : `

                <div class="notif-empty">

                    You're all caught up.

                </div>

            `;

}


notifToggle.addEventListener(
    "click",
    function(e){

        e.stopPropagation();

        notifDropdown.classList.toggle(
            "open"
        );

    }
);


notifMarkAllRead.addEventListener(
    "click",
    function(){

        notifications.forEach(
            n => n.read = true
        );

        renderNotifications();

    }
);


document.addEventListener(
    "click",
    function(e){

        if(
            !notifDropdown.contains(e.target) &&
            !notifToggle.contains(e.target)
        ){

            notifDropdown.classList.remove(
                "open"
            );

        }

    }
);


/* =========================
   START
========================= */

renderNotifications();

updateCartBadge();

loadOrders();

</script>

</body>

</html>
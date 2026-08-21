<?php

include "db.php";

header_remove("Content-Type");

?>
<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>My Profile - FurryCorner PH</title>

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

  /* =========================
   NAVBAR ICON BUTTONS
========================= */

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
   NOTIFICATION BADGE
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


/* =========================
   CART BADGE
========================= */

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
   NOTIFICATION DROPDOWN
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

    cursor:pointer;

}

.notif-item:hover{

    background:#fafafa;

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
   SEARCH OVERLAY
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

.search-box > svg{

    width:22px;

    height:22px;

    flex-shrink:0;

    color:#777;

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

    display:flex;

    align-items:center;

    justify-content:center;

}

.search-close svg{

    width:22px;

    height:22px;

}

.search-results-hint{

    color:white;

    font-size:13px;

    margin-top:12px;

    padding-left:5px;

}


/* =========================
   MOBILE
========================= */

@media(max-width:750px){

    .navbar{

        padding:12px 20px;

    }

    .nav-links{

        display:none;

    }

    .nav-icons{

        gap:8px;

    }

    .notif-dropdown{

        top:65px;

        right:15px;

    }

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
   PROFILE CARD
========================= */

.profile-card{

    background:white;

    border-radius:16px;

    padding:30px;

    box-shadow:0 4px 14px rgba(0,0,0,.05);
}

.profile-header{

    display:flex;

    align-items:center;

    justify-content:space-between;

    margin-bottom:30px;
}

.profile-header h2{

    font-family:'Baloo 2',cursive;

    font-size:27px;
}

.edit-btn{

    border:none;

    background:var(--blue);

    color:white;

    padding:10px 20px;

    border-radius:8px;

    font-weight:800;

    cursor:pointer;
}

.edit-btn:hover{

    background:var(--blue-dark);
}


/* =========================
   PROFILE INFORMATION
========================= */

.profile-row{

    padding:18px 0;

    border-bottom:1px solid var(--border);
}

.profile-row:last-child{

    border-bottom:none;
}

.profile-label{

    font-size:12px;

    font-weight:800;

    color:#999;

    text-transform:uppercase;

    margin-bottom:5px;
}

.profile-value{

    font-size:16px;

    font-weight:700;
}


/* =========================
   ADDRESS
========================= */

.address-header{

    display:flex;

    justify-content:space-between;

    align-items:center;

    margin-top:25px;

    margin-bottom:10px;
}

.address-header h3{

    font-family:'Baloo 2',cursive;

    font-size:21px;
}

.add-btn{

    border:none;

    background:none;

    color:var(--blue-dark);

    font-weight:800;

    cursor:pointer;
}

.address-box{

    background:var(--cream-light);

    border-radius:10px;

    padding:15px;

    font-size:14px;

    font-weight:600;

    line-height:1.6;
}

.no-address{

    color:#999;
}


/* =========================
   ACCOUNT ACTIONS
========================= */

.account-actions{

    display:flex;

    gap:12px;

    margin-top:30px;
}

.action-btn{

    padding:11px 20px;

    border-radius:8px;

    font-weight:800;

    cursor:pointer;

    border:1.5px solid var(--blue);
}

.signout-btn{

    background:white;

    color:var(--blue-dark);
}

.password-btn{

    background:var(--blue);

    color:white;

    border-color:var(--blue);
}


/* =========================
   MODAL
========================= */

.modal-backdrop{

    position:fixed;

    inset:0;

    background:rgba(31,36,48,.55);

    display:none;

    align-items:center;

    justify-content:center;

    padding:20px;

    z-index:5000;
}

.modal-backdrop.open{

    display:flex;
}

.modal{

    width:100%;

    max-width:450px;

    background:white;

    border-radius:16px;

    padding:30px;

    box-shadow:0 20px 50px rgba(0,0,0,.25);

    position:relative;
}

.modal h2{

    font-family:'Baloo 2',cursive;

    font-size:25px;

    margin-bottom:20px;
}

.close-btn{

    position:absolute;

    top:15px;

    right:15px;

    border:none;

    background:none;

    font-size:22px;

    cursor:pointer;
}

.form-group{

    margin-bottom:15px;
}

.form-group label{

    display:block;

    font-size:13px;

    font-weight:800;

    margin-bottom:6px;
}

.form-group input{

    width:100%;

    height:44px;

    border:1.5px solid #ddd;

    border-radius:8px;

    padding:0 12px;

    font-family:'Nunito',sans-serif;

    outline:none;
}

.form-group input:focus{

    border-color:var(--blue);
}

.save-btn{

    width:100%;

    height:45px;

    border:none;

    border-radius:8px;

    background:var(--blue);

    color:white;

    font-weight:800;

    cursor:pointer;

    margin-top:5px;
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

}

</style>

</head>

<body>
<!-- =========================
     NAVBAR
========================= -->

<nav class="navbar" id="navbar">

    <div class="nav-left">

        <!-- LOGO -->
        <a href="FurryCorner.php" class="logo">

            <img
                src="images/logo.png"
                alt="FurryCorner logo">

        </a>


        <!-- NAVIGATION LINKS -->
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


    <!-- =========================
         NAVBAR ICONS
    ========================= -->

    <div class="nav-icons">


        <!-- SEARCH -->
        <button
            type="button"
            id="searchToggle"
            class="nav-icon-button"
            aria-label="Search">

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
            id="accountLink"
            class="nav-icon-button"
            aria-label="My Account">

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
            id="notifToggle"
            aria-label="Notifications">

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
            class="nav-icon-button cart-link"
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
     NOTIFICATION DROPDOWN
========================= -->

<div
    class="notif-dropdown"
    id="notifDropdown">

    <div class="notif-header">

        <h3>
            Notifications
        </h3>

        <button
            type="button"
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
     SEARCH OVERLAY
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
                placeholder="Search products or services..."
                autocomplete="off">


            <button
                type="button"
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

            Search for products, food, accessories, grooming, boarding, and more.

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


        <!-- =========================
             SIDEBAR
        ========================= -->

        <aside class="sidebar">

            <h2>
                My Account
            </h2>

            <a href="OrderHistory.php">
                Orders
            </a>

            <a
                href="profile.php"
                class="active">

                Profile

            </a>

        </aside>


        <!-- =========================
             PROFILE
        ========================= -->

        <section class="profile-card">

            <div class="profile-header">

                <h2>
                    Profile
                </h2>

                <button
                    class="edit-btn"
                    onclick="openEditModal()">

                    Edit

                </button>

            </div>


            <div class="profile-row">

                <div class="profile-label">
                    First Name
                </div>

                <div
                    class="profile-value"
                    id="firstName">

                    Loading...

                </div>

            </div>


            <div class="profile-row">

                <div class="profile-label">
                    Last Name
                </div>

                <div
                    class="profile-value"
                    id="lastName">

                    Loading...

                </div>

            </div>


            <div class="profile-row">

                <div class="profile-label">
                    Email Address
                </div>

                <div
                    class="profile-value"
                    id="email">

                    Loading...

                </div>

            </div>


            <!-- =========================
                 ADDRESS
            ========================= -->

            <div class="address-header">

                <h3>
                    Addresses
                </h3>

                <button
                    class="add-btn"
                    onclick="openAddressModal()">

                    + Add

                </button>

            </div>


            <div
                class="address-box"
                id="address">

                Loading...

            </div>


            <!-- =========================
                 MEMBER SINCE
            ========================= -->

            <div class="profile-row">

                <div class="profile-label">
                    Member Since
                </div>

                <div
                    class="profile-value"
                    id="memberSince">

                    Loading...

                </div>

            </div>


            <!-- =========================
                 ACTIONS
            ========================= -->

            <div class="account-actions">

                <button
                    class="action-btn signout-btn"
                    onclick="signOut()">

                    Sign out

                </button>

                <button
                    class="action-btn password-btn"
                    onclick="openPasswordModal()">

                    Change Password

                </button>

            </div>

        </section>

    </div>

</main>


<!-- =========================
     EDIT PROFILE MODAL
========================= -->

<div
    class="modal-backdrop"
    id="editModal">

    <div class="modal">

        <button
            class="close-btn"
            onclick="closeEditModal()">

            ×

        </button>

        <h2>
            Edit Profile
        </h2>


        <div class="form-group">

            <label>
                First Name
            </label>

            <input
                type="text"
                id="editFirstName">

        </div>


        <div class="form-group">

            <label>
                Last Name
            </label>

            <input
                type="text"
                id="editLastName">

        </div>


        <button
            class="save-btn"
            onclick="saveProfile()">

            Save Changes

        </button>

    </div>

</div>


<!-- =========================
     ADDRESS MODAL
========================= -->

<div
    class="modal-backdrop"
    id="addressModal">

    <div class="modal">

        <button
            class="close-btn"
            onclick="closeAddressModal()">

            ×

        </button>

        <h2>
            Add Address
        </h2>


        <div class="form-group">

            <label>
                Address
            </label>

            <input
                type="text"
                id="addressInput"
                placeholder="House No., Street, Barangay">

        </div>


        <div class="form-group">

            <label>
                City
            </label>

            <input
                type="text"
                id="cityInput"
                placeholder="City">

        </div>


        <div class="form-group">

            <label>
                Province
            </label>

            <input
                type="text"
                id="provinceInput"
                placeholder="Province">

        </div>


        <div class="form-group">

            <label>
                Postal Code
            </label>

            <input
                type="text"
                id="postalInput"
                placeholder="Postal Code">

        </div>


        <div class="form-group">

            <label>
                Phone Number
            </label>

            <input
                type="text"
                id="phoneInput"
                placeholder="09XXXXXXXXX">

        </div>


        <button
            class="save-btn"
            onclick="saveAddress()">

            Save Address

        </button>

    </div>

</div>


<!-- =========================
     CHANGE PASSWORD MODAL
========================= -->

<div
    class="modal-backdrop"
    id="passwordModal">

    <div class="modal">

        <button
            class="close-btn"
            onclick="closePasswordModal()">

            ×

        </button>

        <h2>
            Change Password
        </h2>


        <div class="form-group">

            <label>
                Current Password
            </label>

            <input
                type="password"
                id="currentPassword">

        </div>


        <div class="form-group">

            <label>
                New Password
            </label>

            <input
                type="password"
                id="newPassword">

        </div>


        <div class="form-group">

            <label>
                Confirm New Password
            </label>

            <input
                type="password"
                id="confirmPassword">

        </div>


        <button
            class="save-btn"
            onclick="changePassword()">

            Change Password

        </button>

    </div>

</div>


<footer>

    © 2026 FurryCorner PH. All rights reserved.

</footer>


<script>

   /* =========================
   NAVBAR
========================= */

const nav =
    document.getElementById("navbar");


window.addEventListener(
    "scroll",
    function(){

        if(window.scrollY > 10){

            nav.classList.add("scrolled");

        }else{

            nav.classList.remove("scrolled");

        }

    }
);


/* =========================
   ACCOUNT
========================= */

const accountLink =
    document.getElementById("accountLink");


if(accountLink){

    accountLink.addEventListener(
        "click",
        function(e){

            let loggedUser = null;

            try{

                loggedUser =
                    JSON.parse(
                        localStorage.getItem(
                            "loggedInUser"
                        )
                    );

            }catch(error){

                loggedUser = null;

            }


            if(
                !loggedUser ||
                !loggedUser.id
            ){

                e.preventDefault();

                window.location.href =
                    "signin.php";

            }

        }
    );

}


/* =========================
   NOTIFICATIONS
========================= */

let notifications = [

    {
        id:"n1",

        type:"payment",

        title:"Payment received",

        message:
            "Your payment for Order #FC-1032 has been confirmed.",

        time:"2 hours ago",

        read:false
    },

    {
        id:"n2",

        type:"booking",

        title:"Booking confirmed",

        message:
            "Your Bath appointment has been confirmed.",

        time:"1 day ago",

        read:true
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


const notifIcons = {

    payment:`

        <svg
            viewBox="0 0 24 24"
            fill="none"
            stroke="currentColor"
            stroke-width="2">

            <rect
                x="2"
                y="5"
                width="20"
                height="14"
                rx="2"/>

            <line
                x1="2"
                y1="10"
                x2="22"
                y2="10"/>

        </svg>

    `,

    booking:`

        <svg
            viewBox="0 0 24 24"
            fill="none"
            stroke="currentColor"
            stroke-width="2">

            <rect
                x="3"
                y="4"
                width="18"
                height="18"
                rx="2"/>

            <line
                x1="16"
                y1="2"
                x2="16"
                y2="6"/>

            <line
                x1="8"
                y1="2"
                x2="8"
                y2="6"/>

            <line
                x1="3"
                y1="10"
                x2="21"
                y2="10"/>

        </svg>

    `

};


function renderNotifications(){

    const unreadCount =
        notifications.filter(
            notification =>
                !notification.read
        ).length;


    if(unreadCount > 0){

        notifBadge.style.display =
            "flex";

        notifBadge.textContent =
            unreadCount > 99
                ? "99+"
                : unreadCount;

    }else{

        notifBadge.style.display =
            "none";

    }


    if(notifications.length === 0){

        notifList.innerHTML = `

            <div class="notif-empty">

                You're all caught up.

            </div>

        `;

        return;

    }


    notifList.innerHTML =
        notifications.map(
            notification => `

                <div
                    class="notif-item ${
                        notification.read
                            ? ""
                            : "unread"
                    }"
                    data-id="${
                        notification.id
                    }">

                    <div
                        class="notif-icon ${
                            notification.type
                        }">

                        ${
                            notifIcons[
                                notification.type
                            ] || ""
                        }

                    </div>

                    <div class="notif-body">

                        <div class="notif-title">

                            ${
                                notification.title
                            }

                        </div>

                        <div class="notif-message">

                            ${
                                notification.message
                            }

                        </div>

                        <div class="notif-time">

                            ${
                                notification.time
                            }

                        </div>

                    </div>

                    ${
                        notification.read
                            ? ""
                            : `
                                <div
                                    class="notif-unread-dot">
                                </div>
                            `
                    }

                </div>

            `
        ).join("");

}


/* OPEN NOTIFICATIONS */

notifToggle.addEventListener(
    "click",
    function(e){

        e.stopPropagation();

        notifDropdown.classList.toggle(
            "open"
        );

    }
);


/* MARK ALL AS READ */

notifMarkAllRead.addEventListener(
    "click",
    function(){

        notifications.forEach(
            notification => {

                notification.read = true;

            }
        );

        renderNotifications();

    }
);


/* CLICK NOTIFICATION */

notifList.addEventListener(
    "click",
    function(e){

        const item =
            e.target.closest(
                ".notif-item"
            );


        if(!item){

            return;

        }


        const notification =
            notifications.find(
                n =>
                    n.id ===
                    item.dataset.id
            );


        if(notification){

            notification.read = true;

            renderNotifications();

        }

    }
);


/* CLOSE NOTIFICATIONS */

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


renderNotifications();


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


const productKeywords = [

    "food",
    "dry",
    "dry food",
    "wet",
    "wet food",
    "treat",
    "treats",
    "accessories",
    "walking essentials",
    "home gear",
    "toys",
    "harness",
    "collar",
    "leash",
    "bed",
    "cage",
    "bowl",
    "potty",
    "brush",
    "comb",
    "plush",
    "ball",
    "chew",
    "interactive",
    "stroller",
    "shoe",
    "dog",
    "cat"

];


const serviceKeywords = [

    "grooming",
    "care",
    "boarding",
    "haircut",
    "bath",
    "tooth",
    "brushing",
    "nail",
    "ear",
    "cleaning",
    "dental",
    "vaccination",
    "medicine",
    "spaying",
    "consultation",
    "day boarding",
    "overnight",
    "spa",
    "fostering",
    "veterinary"

];


/* OPEN SEARCH */

searchToggle.addEventListener(
    "click",
    function(){

        searchOverlay.classList.add(
            "open"
        );

        searchInput.focus();

    }
);


/* CLOSE SEARCH */

function closeSearch(){

    searchOverlay.classList.remove(
        "open"
    );

    searchInput.value = "";

}


searchClose.addEventListener(
    "click",
    closeSearch
);


/* CLICK OUTSIDE */

searchOverlay.addEventListener(
    "click",
    function(e){

        if(
            e.target ===
            searchOverlay
        ){

            closeSearch();

        }

    }
);


/* ESC KEY */

document.addEventListener(
    "keydown",
    function(e){

        if(e.key === "Escape"){

            closeSearch();

        }

    }
);


/* SEARCH */

searchInput.addEventListener(
    "keydown",
    function(e){

        if(e.key !== "Enter"){

            return;

        }


        const keyword =
            this.value
                .trim()
                .toLowerCase();


        if(keyword === ""){

            return;

        }


        const isProduct =
            productKeywords.some(
                word =>
                    keyword.includes(word)
            );


        const isService =
            serviceKeywords.some(
                word =>
                    keyword.includes(word)
            );


        if(isProduct){

            window.location.href =
                "AllProducts.php?search=" +
                encodeURIComponent(
                    keyword
                );

            return;

        }


        if(isService){

            window.location.href =
                "services.php?search=" +
                encodeURIComponent(
                    keyword
                );

            return;

        }


        alert(
            "No products or services found."
        );

    }
);


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
                localStorage.getItem(
                    "cart"
                )
            ) || [];

    }catch(error){

        console.error(
            "Unable to read cart:",
            error
        );

        cart = [];

    }


    const totalItems =
        cart.reduce(
            function(total, item){

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


/* INITIAL CART */

updateCartBadge();


/* WHEN RETURNING TO PAGE */

window.addEventListener(
    "pageshow",
    updateCartBadge
);


/* WHEN CART CHANGES IN ANOTHER TAB */

window.addEventListener(
    "storage",
    function(event){

        if(event.key === "cart"){

            updateCartBadge();

        }

    }
);
/* =========================
   GET LOGGED-IN USER
========================= */

const loggedUser =
    JSON.parse(
        localStorage.getItem("loggedInUser")
    );


if(!loggedUser || !loggedUser.id){

    alert("Please sign in first.");

    window.location.href =
        "signin.php";

}


/* =========================
   LOAD PROFILE
========================= */

function loadProfile(){

    fetch(
        "getProfile.php?user_id=" +
        encodeURIComponent(loggedUser.id)
    )

    .then(response => response.json())

    .then(data => {

        console.log("Profile:", data);

        if(!data.success){

            alert(
                data.message ||
                "Unable to load profile."
            );

            return;
        }

        const user = data.user;


        /* =========================
           DISPLAY PROFILE
        ========================= */

        document.getElementById("firstName").textContent =
            user.firstName || "";

        document.getElementById("lastName").textContent =
            user.lastName || "";

        document.getElementById("email").textContent =
            user.email || "";


        /* =========================
           LOAD SAVED ADDRESS
        ========================= */

        const savedAddress =
            JSON.parse(
                localStorage.getItem("userAddress")
            );


        if(savedAddress){

            document.getElementById(
                "address"
            ).innerHTML = `

                ${savedAddress.address}<br>
                ${savedAddress.city},
                ${savedAddress.province}
                ${savedAddress.postal}<br>
                Phone: ${savedAddress.phone}

            `;

        }else{

            document.getElementById(
                "address"
            ).innerHTML =
                '<span class="no-address">No address saved yet.</span>';

        }


        /* =========================
           MEMBER SINCE
        ========================= */

        document.getElementById("memberSince").textContent =
            formatDate(user.createdAt);


        /* =========================
           FILL EDIT FIELDS
        ========================= */

        document.getElementById("editFirstName").value =
            user.firstName || "";

        document.getElementById("editLastName").value =
            user.lastName || "";

    })

    .catch(error => {

        console.error(
            "Profile error:",
            error
        );

        alert(
            "Unable to load your profile."
        );

    });

}


/* =========================
   DATE
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
   EDIT MODAL
========================= */

function openEditModal(){

    document
        .getElementById("editModal")
        .classList.add("open");

}

function closeEditModal(){

    document
        .getElementById("editModal")
        .classList.remove("open");

}


/* =========================
   SAVE PROFILE
========================= */

function saveProfile(){

    const firstName =
        document.getElementById(
            "editFirstName"
        ).value.trim();

    const lastName =
        document.getElementById(
            "editLastName"
        ).value.trim();


    if(!firstName || !lastName){

        alert(
            "Please complete all fields."
        );

        return;

    }


    fetch(
        "updateProfile.php",
        {

            method:"POST",

            headers:{
                "Content-Type":
                    "application/json"
            },

            body:JSON.stringify({

                user_id:loggedUser.id,

                first_name:firstName,

                last_name:lastName

            })

        }

    )

    .then(response =>
        response.json()
    )

    .then(data => {

        if(!data.success){

            alert(
                data.message ||
                "Unable to update profile."
            );

            return;

        }


        alert(
            "Profile updated successfully."
        );


        closeEditModal();

        loadProfile();

    })

    .catch(error => {

        console.error(error);

        alert(
            "Unable to update profile."
        );

    });

}


/* =========================
   ADDRESS MODAL
========================= */

function openAddressModal(){

    document
        .getElementById("addressModal")
        .classList.add("open");

}


function closeAddressModal(){

    document
        .getElementById("addressModal")
        .classList.remove("open");

}


/* =========================
   SAVE ADDRESS
========================= */

function saveAddress(){

    const address =
        document.getElementById("addressInput").value.trim();

    const city =
        document.getElementById("cityInput").value.trim();

    const province =
        document.getElementById("provinceInput").value.trim();

    const postal =
        document.getElementById("postalInput").value.trim();

    const phone =
        document.getElementById("phoneInput").value.trim();


    if(
        !address ||
        !city ||
        !province ||
        !postal ||
        !phone
    ){

        alert("Please complete all address fields.");

        return;
    }


    fetch("updateAddress.php", {

        method: "POST",

        headers: {
            "Content-Type": "application/json"
        },

        body: JSON.stringify({

            user_id: loggedUser.id,

            address: address,

            city: city,

            province: province,

            postal: postal,

            phone: phone

        })

    })

    .then(response => response.json())

    .then(data => {

        if(!data.success){

            alert(
                data.message ||
                "Unable to save address."
            );

            return;
        }


        alert("Address saved successfully.");

        closeAddressModal();

        loadProfile();

    })

    .catch(error => {

        console.error("Address error:", error);

        alert("Unable to save address.");

    });

}
/* =========================
   PASSWORD MODAL
========================= */

function openPasswordModal(){

    document
        .getElementById("passwordModal")
        .classList.add("open");

}

function closePasswordModal(){

    document
        .getElementById("passwordModal")
        .classList.remove("open");

}


/* =========================
   CHANGE PASSWORD
========================= */

function changePassword(){

    const currentPassword =
        document.getElementById(
            "currentPassword"
        ).value;

    const newPassword =
        document.getElementById(
            "newPassword"
        ).value;

    const confirmPassword =
        document.getElementById(
            "confirmPassword"
        ).value;


    if(
        !currentPassword ||
        !newPassword ||
        !confirmPassword
    ){

        alert(
            "Please complete all password fields."
        );

        return;

    }


    if(newPassword !== confirmPassword){

        alert(
            "New passwords do not match."
        );

        return;

    }


    alert(
        "Password change will be connected next."
    );

}


/* =========================
   SIGN OUT
========================= */

function signOut(){

    localStorage.removeItem(
        "loggedInUser"
    );

    localStorage.removeItem(
        "loggedInUserId"
    );

    localStorage.removeItem(
        "loggedInName"
    );

    localStorage.removeItem(
        "loggedInEmail"
    );


    window.location.href =
        "FurryCorner.php";

}


/* =========================
   START
========================= */

loadProfile();

</script>

</body>

</html>
<?php
include "db.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>About Us - FurryCorner PH</title>
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
    --muted: #6b7482;
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

  /* ===== NAVBAR (matches FurryCorner.php) ===== */

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
    padding-bottom: 3px;
    border-bottom: 2px solid transparent;
  }
  .nav-links li a:hover{ opacity:1; color:var(--blue-dark); }
  .nav-links li a.active{
    opacity:1;
    color: var(--blue-dark);
    border-bottom-color: var(--blue-dark);
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

  .cart-link{
    position:relative;
    display:flex;
    align-items:center;
    justify-content:center;
    width:24px;
    height:24px;
  }

  .cart-link svg{ width:22px; height:22px; }

  .cart-badge{
    position:absolute;
    top:-9px; right:-10px;
    min-width:18px; height:18px;
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

  
  /* ===== SEARCH ===== */

  .nav-search-btn{
    background:none;
    border:none;
    padding:0;
    cursor:pointer;
    display:flex;
    align-items:center;
    justify-content:center;
  }

  .nav-search-btn svg{
      width:24px;
      height:24px;
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

  .search-overlay.open{
      display: flex;
  }

  .search-box{
      background: var(--white);
      width: 100%;
      max-width: 760px;
      border-radius: 12px;
      border: 2px solid var(--blue);
      display: flex;
      align-items: center;
      padding: 14px 20px;
      gap: 14px;
      box-shadow: 0 12px 30px rgba(0,0,0,0.15);
  }

  .search-box input{
      flex: 1;
      border: none;
      outline: none;
      font-family: 'Nunito', sans-serif;
      font-size: 16px;
      font-weight: 600;
      color: var(--ink);
      background: transparent;
  }

  .search-box svg{
      width: 22px;
      height: 22px;
      color: var(--blue-dark);
      flex-shrink: 0;
  }

  .search-close{
      background: none;
      border: none;
      cursor: pointer;
      margin-left: 16px;
      flex-shrink: 0;
  }

  .search-close svg{
      width: 26px;
      height: 26px;
      color: var(--ink);
  }

  .search-results-hint{
      max-width: 760px;
      width: 100%;
      margin: 10px auto 0;
      color: var(--white);
      font-weight: 700;
      font-size: 14px;
      text-align: left;
  }

  /* ===== ABOUT HERO ===== */

  .about-hero{
    background: var(--cream);
    padding: 40px 40px;
    text-align:center;
    min-height: calc(100vh - 67px);
    display:flex;
    flex-direction:column;
    align-items:center;
    justify-content:center;
  }

  .about-hero .eyebrow{
    display:inline-block;
    background: var(--white);
    color: var(--blue-dark);
    font-weight:800;
    font-size: 14px;
    letter-spacing:.04em;
    text-transform:uppercase;
    padding: 9px 20px;
    border-radius: 999px;
    margin-bottom: 28px;
  }

  .about-hero h1{
    font-size: clamp(38px, 6vw, 64px);
    line-height:1.1;
    margin-bottom: 24px;
  }

  .about-hero p{
    max-width: 680px;
    margin: 0 auto;
    font-size: 19px;
    font-weight:600;
    opacity:.85;
  }

  @media (max-width: 640px){
    .about-hero{ min-height: calc(100svh - 67px); }
  }

  /* ===== STORY BLOCKS ===== */

  .story{
    padding: 60px 0;
  }

  .story-row{
    display:grid;
    grid-template-columns: 1fr 1fr;
    gap: 60px;
    align-items:center;
  }

  .story-row + .story-row{
    margin-top: 64px;
  }

  .story-row.reverse .story-art{
    order: 2;
  }

  .story-art{
    background: var(--cream-light);
    border-radius: 24px;
    aspect-ratio: 4/2.7;
    display:flex;
    align-items:center;
    justify-content:center;
    overflow:hidden;
    box-shadow: 0 20px 40px rgba(123,184,240,.15);
  }

  .story-art img{
    width: 100%;
    height: 100%;
    object-fit: cover;
  }

  .story-text .kicker{
    display:block;
    color: var(--blue-dark);
    font-weight:800;
    font-size: 13px;
    letter-spacing:.05em;
    text-transform:uppercase;
    margin-bottom: 10px;
  }

  .story-text h2{
    font-size: 30px;
    margin-bottom: 16px;
    line-height:1.15;
  }

  .story-text p{
    font-size: 15.5px;
    font-weight:600;
    color: var(--ink);
    opacity:.85;
    margin-bottom: 14px;
  }

  .story-text p:last-child{ margin-bottom:0; }

  /* ===== PROMISE BAND ===== */

  .promise{
    background: var(--cream);
    padding: 90px 40px;
  }

  .promise-head{
    text-align:center;
    max-width: 640px;
    margin: 0 auto 46px;
  }

  .promise-head h2{
    font-size: 30px;
    margin-bottom: 14px;
  }

  .promise-head p{
    font-size: 15.5px;
    font-weight:600;
    opacity:.85;
  }

  .promise-grid{
    max-width: 1100px;
    margin: 0 auto;
    display:grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 22px;
  }

  .promise-item{
    background: var(--blue);
    color: var(--white);
    border-radius: 16px;
    padding: 26px 22px;
    text-align:center;
    box-shadow: 0 10px 24px rgba(123,184,240,.35);
  }

  .promise-item svg{
    width: 30px;
    height: 30px;
    margin: 0 auto 14px;
  }

  .promise-item h3{
    font-family:'Nunito', sans-serif;
    font-size: 15.5px;
    font-weight:800;
    margin-bottom: 8px;
  }

  .promise-item p{
    font-size: 13px;
    font-weight:600;
    opacity:.92;
    line-height:1.5;
  }

  /* ===== VALUES ===== */

  .values{
    padding: 90px 0;
  }

  .values-head{
    text-align:center;
    max-width: 640px;
    margin: 0 auto 46px;
  }

  .values-head h2{
    font-size: 30px;
    margin-bottom: 14px;
  }

  .values-head p{
    font-size: 15.5px;
    font-weight:600;
    opacity:.85;
  }

  .values-grid{
    max-width: 1200px;
    margin: 0 auto;
    display:grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 26px;
  }

  .value-card{
    background: var(--white);
    border: 1.5px solid #eef1f5;
    border-radius: 18px;
    padding: 30px 26px;
    box-shadow: 0 14px 30px rgba(0,0,0,.04);
  }

  .value-icon{
    width: 52px;
    height: 52px;
    border-radius: 14px;
    background: var(--cream-light);
    display:flex;
    align-items:center;
    justify-content:center;
    margin-bottom: 18px;
  }

  .value-icon svg{
    width: 26px;
    height: 26px;
    color: var(--blue-dark);
  }

  .value-card h3{
    font-size: 18px;
    margin-bottom: 8px;
  }

  .value-card p{
    font-size: 14px;
    font-weight:600;
    color: var(--ink);
    opacity:.8;
    line-height:1.6;
  }

  /* ===== MEET THE TEAM ===== */

  .team{
    background: var(--cream-light);
    padding: 90px 40px;
  }

  .team-head{
    text-align:center;
    max-width: 640px;
    margin: 0 auto 50px;
  }

  .team-head .kicker{
    display:block;
    color: var(--blue-dark);
    font-weight:800;
    font-size: 13px;
    letter-spacing:.05em;
    text-transform:uppercase;
    margin-bottom: 10px;
  }

  .team-head h2{
    font-size: 30px;
    margin-bottom: 14px;
  }

  .team-head p{
    font-size: 15.5px;
    font-weight:600;
    opacity:.85;
  }

  .team-grid{
    max-width: 1080px;
    margin: 0 auto;
    display:flex;
    flex-wrap:wrap;
    justify-content:center;
    gap: 40px 32px;
  }

  .team-card{
    width: 300px;
    background: var(--white);
    border-radius: 18px;
    padding: 0 0 26px;
    text-align:center;
    box-shadow: 0 16px 34px rgba(31,36,48,.06);
    overflow:hidden;
  }

  .team-photo{
    width: 148px;
    height: 148px;
    margin: 34px auto 20px;
    border-radius: 50%;
    background: var(--cream);
    border: 2px dashed var(--blue);
    object-fit: cover;
    display:block;
  }

  .team-card h3{
    font-size: 17px;
    margin-bottom: 4px;
  }

  .team-card .role{
    display:block;
    color: var(--blue-dark);
    font-weight:800;
    font-size: 12.5px;
    letter-spacing:.03em;
    text-transform:uppercase;
    margin-bottom: 12px;
  }

  .team-card p.bio{
    font-size: 13.5px;
    font-weight:600;
    color: var(--ink);
    opacity:.7;
    padding: 0 22px;
    line-height:1.6;
  }

  @media (max-width: 640px){
    .team-card{ width: 100%; max-width: 320px; }
  }

  /* ===== CTA BAND ===== */

  .about-cta{
    background: var(--ink);
    padding: 70px 40px;
    text-align:center;
    color: var(--white);
  }

  .about-cta h2{
    font-size: 28px;
    margin-bottom: 12px;
  }

  .about-cta p{
    font-size: 15px;
    font-weight:600;
    opacity:.75;
    margin-bottom: 28px;
  }

  .about-cta .cta-row{
    display:flex;
    justify-content:center;
    gap: 16px;
    flex-wrap:wrap;
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

  .btn-outline{
    display:inline-block;
    background: transparent;
    color: var(--white);
    font-weight: 700;
    border: 1.5px solid rgba(255,255,255,.4);
    border-radius: 8px;
    padding: 12px 30px;
    cursor:pointer;
    font-size: 15px;
    transition: border-color .2s ease, transform .2s ease;
  }
  .btn-outline:hover{ border-color: #fff; transform: translateY(-1px); }

  /* ===== FOOTER (matches FurryCorner.php) ===== */

  footer{
    width: 100%;
    padding: 70px 0px 20px;
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

  @media (max-width: 900px){
    .nav-links{ display:none; }
    .story-row{ grid-template-columns: 1fr; }
    .story-row.reverse .story-art{ order: 0; }
    .promise-grid{ grid-template-columns: repeat(2, 1fr); }
    .values-grid{ grid-template-columns: 1fr 1fr; }
    .footer-grid{ grid-template-columns: 1fr 1fr; }
  }

  @media (max-width: 480px){
    .container, .navbar, .about-hero, .promise, .about-cta, .team{ padding-left:20px; padding-right:20px; }
    .promise-grid{ grid-template-columns: 1fr; }
    .values-grid{ grid-template-columns: 1fr; }
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
      <li><a href="about.php" class="active">About Us</a></li>
      <li><a href="contact.php">Contact Us</a></li>
    </ul>
  </div>
  <div class="nav-icons">

  <button
        type="button"
        id="searchToggle"
        class="nav-search-btn"
        aria-label="Search"
    >
        <svg
            viewBox="0 0 24 24"
            fill="none"
            stroke="currentColor"
            stroke-width="2"
        >
            <circle
                cx="11"
                cy="11"
                r="7"
            />

            <line
                x1="21"
                y1="21"
                x2="16.65"
                y2="16.65"
            />
        </svg>
    </button>

    <div
        class="search-overlay"
        id="searchOverlay"
    >

        <div style="width:100%; max-width:760px;">

            <div class="search-box">

                <svg
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2"
                >
                    <circle
                        cx="11"
                        cy="11"
                        r="7"
                    />

                    <line
                        x1="21"
                        y1="21"
                        x2="16.65"
                        y2="16.65"
                    />
                </svg>


                <input
                    type="text"
                    id="searchInput"
                    placeholder="Search products..."
                    autocomplete="off"
                >


                <button
                    type="button"
                    class="search-close"
                    id="searchClose"
                    aria-label="Close search"
                >

                    <svg
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2"
                    >
                        <line
                            x1="18"
                            y1="6"
                            x2="6"
                            y2="18"
                        />

                        <line
                            x1="6"
                            y1="6"
                            x2="18"
                            y2="18"
                        />
                    </svg>

                </button>

            </div>


            <div
                class="search-results-hint"
                id="searchResultsHint"
            ></div>

        </div>

    </div>

    <a href="signin.php" id="profileLink">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
        <circle cx="12" cy="8" r="4"/><path d="M4 21c0-4 4-6 8-6s8 2 8 6"/>
      </svg>
    </a>

    <a href="cart.php" class="cart-link" aria-label="Shopping cart">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
        <circle cx="9" cy="21" r="1"/>
        <circle cx="20" cy="21" r="1"/>
        <path d="M1 1h4l2.6 13.4a2 2 0 002 1.6h9.7a2 2 0 002-1.6L23 6H6"/>
      </svg>
      <span class="cart-badge" id="cartBadge">0</span>
    </a>
  </div>
</nav>

<!-- ===== ABOUT HERO ===== -->

<header class="about-hero">
  <span class="eyebrow">Our Story</span>
  <h1>Every corner of FurryCorner<br>started with one wagging tail</h1>
  <p>We're a small team of pet lovers who got tired of running between five different shops just to take care of one dog. So we built the corner we wished existed.</p>
</header>

<!-- ===== STORY ===== -->

<section class="story">
  <div class="container">

    <div class="story-row">
      <div class="story-art">
        <img src="images/about1.jpg" alt="FurryCorner founders with a dog">
      </div>
      <div class="story-text">
        <span class="kicker">How it started</span>
        <h2>Too many stops for one happy pet</h2>
        <p>It began with a simple, familiar frustration: one shop for food, another for a decent groomer, and a third for anything resembling proper vet care. Every errand meant a different queue, a different price list, and a different set of strangers deciding what was best for our pets.</p>
        <p>We wanted a place where a pet's whole world — meals, grooming, boarding, care — lived under one roof, run by people who genuinely liked animals more than spreadsheets. That idea became FurryCorner PH.</p>
      </div>
    </div>

    <div class="story-row reverse">
      <div class="story-art">
        <img src="images/about2.jpg" alt="FurryCorner team preparing pet products">
      </div>
      <div class="story-text">
        <span class="kicker">How we grew</span>
        <h2>Built one trusted paw print at a time</h2>
        <p>We started small — a tight shelf of food and treats we'd actually feed our own pets. As neighbors kept coming back, we brought in trusted groomers, boarding partners, and clinics who shared the same standards we held ourselves to.</p>
        <p>Today, FurryCorner is still hand-picked and still personal. Every product on our shelves and every service on our calendar is something we'd trust with our own dogs and cats.</p>
      </div>
    </div>

  </div>
</section>

<!-- ===== PROMISE BAND ===== -->

<section class="promise">
  <div class="promise-head">
    <h2>What we promise every pet parent</h2>
    <p>This is the standard we hold every product, partner, and person on our team to.</p>
  </div>

  <div class="promise-grid">

    <div class="promise-item">
      <svg viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4.5 8-11V5l-8-3-8 3v6c0 6.5 8 11 8 11z"/></svg>
      <h3>Trusted &amp; Vetted</h3>
      <p>Every product and partner is checked before it earns a spot on FurryCorner.</p>
    </div>

    <div class="promise-item">
      <svg viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20.59 13.41L11 3.83A2 2 0 009.61 3H4a1 1 0 00-1 1v5.61a2 2 0 00.59 1.42l9.58 9.58a2 2 0 002.82 0l4.6-4.6a2 2 0 000-2.82z"/><circle cx="7.5" cy="7.5" r="1.5"/></svg>
      <h3>Honest Pricing</h3>
      <p>No inflated tags, no fine print — just fair prices for good care.</p>
    </div>

    <div class="promise-item">
      <svg viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="8" r="4"/><path d="M4 21c0-4 4-6 8-6s8 2 8 6"/></svg>
      <h3>Real People Who Care</h3>
      <p>Every message and booking is handled by someone who actually loves pets.</p>
    </div>

    <div class="promise-item">
      <svg viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="1" y="7" width="15" height="10"/><path d="M16 10h4l3 3v4h-7z"/><circle cx="5.5" cy="19.5" r="1.5"/><circle cx="18.5" cy="19.5" r="1.5"/></svg>
      <h3>Reliable Delivery</h3>
      <p>Fast, careful delivery — because your pet's meals shouldn't be late.</p>
    </div>

  </div>
</section>

<!-- ===== VALUES ===== -->

<section class="values">
  <div class="container">

    <div class="values-head">
      <h2>What drives us</h2>
      <p>The values behind every decision we make at FurryCorner.</p>
    </div>

    <div class="values-grid">

      <div class="value-card">
        <div class="value-icon">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20.84 4.61a5.5 5.5 0 00-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 00-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 000-7.78z"/></svg>
        </div>
        <h3>Compassion</h3>
        <p>Every recommendation starts with what's genuinely best for the animal, not the sale.</p>
      </div>

      <div class="value-card">
        <div class="value-icon">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4.5 8-11V5l-8-3-8 3v6c0 6.5 8 11 8 11z"/></svg>
        </div>
        <h3>Trust</h3>
        <p>We only carry what we'd hand to our own pets — nothing added just to fill a shelf.</p>
      </div>

      <div class="value-card">
        <div class="value-icon">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><path d="M12 6v6l4 2"/></svg>
        </div>
        <h3>Consistency</h3>
        <p>Same quality, same care, whether it's your first order or your fiftieth.</p>
      </div>

      <div class="value-card">
        <div class="value-icon">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 00-3-3.87"/><path d="M16 3.13a4 4 0 010 7.75"/></svg>
        </div>
        <h3>Community</h3>
        <p>We grew because neighbors told neighbors — that word-of-mouth trust still guides us.</p>
      </div>

      <div class="value-card">
        <div class="value-icon">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 11-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
        </div>
        <h3>Quality First</h3>
        <p>From kibble to grooming appointments, quality is checked before it's ever offered.</p>
      </div>

      <div class="value-card">
        <div class="value-icon">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20.59 13.41L11 3.83A2 2 0 009.61 3H4a1 1 0 00-1 1v5.61a2 2 0 00.59 1.42l9.58 9.58a2 2 0 002.82 0l4.6-4.6a2 2 0 000-2.82z"/><circle cx="7.5" cy="7.5" r="1.5"/></svg>
        </div>
        <h3>Fairness</h3>
        <p>Transparent pricing on everything, so pet care never feels like a gamble.</p>
      </div>

    </div>
  </div>
</section>

<!-- ===== MEET THE TEAM ===== -->

<section class="team">
  <div class="team-head">
    <span class="kicker">Meet the Team</span>
    <h2>The people behind FurryCorner</h2>
    <p>The humans (and honorary pets) who pick every product, vet every partner, and keep this corner running.</p>
  </div>

  <div class="team-grid">

    <div class="team-card">
      <img class="team-photo" src="images/Oira.jpg" alt="Team member 1 photo">
      <h3>Team Leader</h3>
      <span class="role">Oira, Jhamylle Rhon</span>
      <p class="bio">Maki's Furrent, a Feline.</p>
    </div>

    <div class="team-card">
      <img class="team-photo" src="images/Buenavista.jpg" alt="Team member 2 photo">
      <h3>Team Member</h3>
      <span class="role">Buenavista, Jocielle</span>
      <p class="bio">Chico's Hooman, a Dog.</p>
    </div>

    <div class="team-card">
      <img class="team-photo" src="images/Noor.png" alt="Team member 3 photo">
      <h3>Team Member</h3>
      <span class="role">Noor, Ilham</span>
      <p class="bio">A Fur Friend Lover.</p>
    </div>

    <div class="team-card">
      <img class="team-photo" src="https://placehold.co/300x300/FCE3C0/5CA3E8?text=Photo+4" alt="Team member 4 photo">
      <h3>Team Member</h3>
      <span class="role">Pardo, Carl Francis</span>
      <p class="bio">Sasa's Pawrent, a Dog.</p>
    </div>

    <div class="team-card">
      <img class="team-photo" src="https://placehold.co/300x300/FCE3C0/5CA3E8?text=Photo+5" alt="Team member 5 photo">
      <h3>Team Member</h3>
      <span class="role">Torres, Rodelyn</span>
      <p class="bio">Casper's Purrson, a Cat.</p>
    </div>

  </div>
</section>

<!-- ===== CTA ===== -->

<section class="about-cta">
  <h2>Ready to give your pet the FurryCorner treatment?</h2>
  <p>Browse hand-picked products or book a service your pet will actually enjoy.</p>
  <div class="cta-row">
    <a href="AllProducts.php" class="btn">Shop Products</a>
    <a href="services.php" class="btn-outline">Book a Service</a>
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
        <a href="about.php">About Us</a>
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

  function updateCartBadge(){
    const badge = document.getElementById('cartBadge');
    if(!badge){ return; }

    let cart = [];
    try{
      cart = JSON.parse(localStorage.getItem('cart')) || [];
    }catch(error){
      cart = [];
    }

    const totalItems = cart.reduce((total, item) => {
      const quantity = Number(item.quantity) || 0;
      return total + quantity;
    }, 0);

    if(totalItems > 0){
      badge.textContent = totalItems > 99 ? '99+' : totalItems;
      badge.style.display = 'flex';
    }else{
      badge.style.display = 'none';
    }
  }

  updateCartBadge();
  window.addEventListener('pageshow', updateCartBadge);
  window.addEventListener('storage', function(event){
    if(event.key === 'cart'){ updateCartBadge(); }
  });

  const profileLink = document.getElementById("profileLink");
  const loggedUser = localStorage.getItem("loggedInUser");
  if (loggedUser) {
    profileLink.href = "profile.php";
  } else {
    profileLink.href = "signin.php";
  }
/* =====================================================
   SEARCH
===================================================== */

const searchToggle =
    document.getElementById('searchToggle');

const searchOverlay =
    document.getElementById('searchOverlay');

const searchInput =
    document.getElementById('searchInput');

const searchClose =
    document.getElementById('searchClose');


function openSearch(){

    searchOverlay.classList.add('open');

    searchInput.focus();

}


function closeSearch(){

    searchOverlay.classList.remove('open');

    searchInput.value = '';

}


searchToggle.addEventListener(
    'click',
    openSearch
);


searchClose.addEventListener(
    'click',
    closeSearch
);


searchOverlay.addEventListener(
    'click',
    function(e){

        if(e.target === searchOverlay){

            closeSearch();

        }

    }
);


/* =====================================================
   SEARCH PRODUCT
===================================================== */

searchInput.addEventListener(
    'keydown',
    function(e){

        if(e.key !== 'Enter')
            return;

        const keyword =
            searchInput.value.trim();

        if(!keyword)
            return;

        window.location.href =
            'AllProducts.php?search=' +
            encodeURIComponent(keyword);

    }
);


/* =====================================================
   ESCAPE
===================================================== */

document.addEventListener(
    'keydown',
    function(e){

        if(e.key === 'Escape'){

            closeSearch();

        }

    }
);
</script>

</body>
</html>
<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Kape Na! - Coffee Products</title>
   <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" />
   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
   <style>
      /* Embedded CSS to avoid path issues */
      @import url('https://fonts.googleapis.com/css2?family=Anton&display=swap');

      :root {
         --yellow: black;
         --red: #e74c3c;
         --white: #fff;
         --black: #222;
         --light-color: #777;
         --border: .2rem solid var(--black);
         --main-color: #d3ad7f;
         --bg: #856731bd;
         --box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.1);
      }

      * {
         margin: 0;
         padding: 0;
         box-sizing: border-box;
         outline: none;
         border: none;
         text-decoration: none;
         font-family: 'Anton', sans-serif;
      }

      *::selection {
         background-color: var(--white);
         color: var(--white);
      }

      ::-webkit-scrollbar {
         height: .5rem;
         width: 1rem;
      }

      ::-webkit-scrollbar-track {
         background-color: transparent;
      }

      ::-webkit-scrollbar-thumb {
         background-color: var(--yellow);
      }

      html {
         font-size: 62.5%;
         overflow-x: hidden;
         scroll-behavior: smooth;
         scroll-padding-top: 7rem;
      }

      body {
         background: var(--bg);
         color: #fff;
      }

      section {
         margin: 0 auto;
         max-width: 1200px;
         padding: 2rem;
      }

      .title {
         text-align: center;
         margin-bottom: 2.5rem;
         font-size: 4rem;
         color: var(--white);
         text-transform: uppercase;
         text-underline-offset: 1rem;
      }

      .btn {
         margin-top: 1rem;
         display: inline-block;
         font-size: 2rem;
         padding: 1rem 3rem;
         cursor: pointer;
         text-transform: capitalize;
         transition: .2s linear;
         background-color: var(--yellow);
         color: var(--white);
      }

      .btn:hover {
         letter-spacing: .2rem;
      }

      /* Success message styling */
      .success-message {
         color: #2ecc71;
         font-size: 1.6rem;
         text-align: center;
         padding: 1rem;
         background: rgba(46, 204, 113, 0.1);
         border-radius: 0.5rem;
         margin: 1rem auto;
         max-width: 1200px;
         border: 1px solid #2ecc71;
      }

      /* Header styles */
      .header {
         position: sticky;
         top: 0;
         left: 0;
         right: 0;
         background-color: var(--black);
         z-index: 1000;
         padding: 1.5rem 2rem;
         box-shadow: var(--box-shadow);
      }

      .header .flex {
         display: flex;
         align-items: center;
         justify-content: space-between;
      }

      .header .logo {
         font-size: 2.5rem;
         color: var(--white);
      }

      .header .logo i {
         color: var(--main-color);
         margin-right: .5rem;
      }

      .header .navbar a {
         margin: 0 1rem;
         font-size: 2rem;
         color: var(--white);
      }

      .header .navbar a:hover {
         color: var(--main-color);
      }

      /* Cart Count Badge */
      .cart-count {
         position: absolute;
         top: -8px;
         right: -8px;
         background-color: var(--main-color);
         color: var(--black);
         border-radius: 50%;
         width: 20px;
         height: 20px;
         display: flex;
         align-items: center;
         justify-content: center;
         font-size: 1.2rem;
         font-weight: bold;
      }

      /* User Profile Styles */
      .user-profile {
         display: flex;
         align-items: center;
         gap: 1rem;
         margin-left: 2rem;
      }

      .user-profile .user-info {
         display: flex;
         align-items: center;
         gap: 1rem;
         color: var(--white);
         font-size: 1.6rem;
      }

      .user-profile .user-icon {
         font-size: 2.5rem;
         color: var(--main-color);
      }

      .user-profile .dropdown {
         position: relative;
         display: inline-block;
      }

      .user-profile .dropdown-content {
         display: none;
         position: absolute;
         right: 0;
         background-color: var(--black);
         min-width: 200px;
         box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
         z-index: 1001;
         border: var(--border);
         border-radius: 0.5rem;
      }

      .user-profile .dropdown-content a {
         color: var(--white);
         padding: 1.2rem 1.6rem;
         text-decoration: none;
         display: block;
         font-size: 1.6rem;
         border-bottom: 1px solid var(--light-color);
      }

      .user-profile .dropdown-content a:hover {
         background-color: var(--main-color);
         color: var(--black);
      }

      .user-profile .dropdown:hover .dropdown-content {
         display: block;
      }

      .user-profile .user-name {
         cursor: pointer;
         padding: 0.5rem 1rem;
         border-radius: 0.5rem;
         transition: background-color 0.3s;
      }

      .user-profile .user-name:hover {
         background-color: rgba(211, 173, 127, 0.1);
      }

      .auth-buttons {
         display: flex;
         gap: 1rem;
         align-items: center;
      }

      .auth-buttons a {
         color: var(--white);
         font-size: 1.8rem;
         padding: 0.5rem 1.5rem;
         border-radius: 0.5rem;
         transition: all 0.3s;
      }

      .auth-buttons a:hover {
         color: var(--main-color);
         background-color: rgba(211, 173, 127, 0.1);
      }

      /* Dashboard specific styles */
      .dashboard-welcome {
         text-align: center;
         margin: 2rem auto;
         padding: 2rem;
         background-color: var(--black);
         border-radius: 1rem;
         max-width: 1200px;
         width: 90%;
      }

      .dashboard-welcome h2 {
         font-size: 3rem;
         margin-bottom: 1rem;
         color: var(--main-color);
      }

      .dashboard-welcome p {
         font-size: 1.8rem;
         color: var(--light-color);
      }

      /* Coffee Products Styles */
      .products {
         padding: 2rem;
         margin: 2rem auto;
         max-width: 1200px;
      }

      .products-container {
         display: grid;
         grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
         gap: 2rem;
         align-items: stretch;
      }

      .product-box {
         background: var(--black);
         border: var(--border);
         padding: 2rem;
         text-align: center;
         transition: transform 0.3s, background-color 0.3s;
         display: flex;
         flex-direction: column;
         justify-content: space-between;
         height: 100%;
         min-height: 350px;
      }

      .product-box:hover {
         transform: translateY(-10px);
         background-color: var(--white);
      }

      .product-box:hover h3,
      .product-box:hover .price,
      .product-box:hover .quantity-display {
         color: var(--black);
      }

      .product-box .product-image {
         width: 100%;
         height: 150px;
         object-fit: cover;
         border-radius: 0.5rem;
         margin-bottom: 1.5rem;
         border: 2px solid var(--main-color);
      }

      .product-box h3 {
         font-size: 2.5rem;
         color: var(--white);
         text-transform: uppercase;
         margin-bottom: 1rem;
      }

      .product-box .price {
         font-size: 2.2rem;
         color: var(--main-color);
         margin-bottom: 1rem;
      }

      .quantity-controls {
         display: flex;
         align-items: center;
         justify-content: center;
         margin: 1rem 0;
      }

      .quantity-btn {
         background-color: var(--main-color);
         color: var(--black);
         width: 3rem;
         height: 3rem;
         border-radius: 50%;
         display: flex;
         align-items: center;
         justify-content: center;
         font-size: 1.8rem;
         cursor: pointer;
         transition: background-color 0.3s;
      }

      .quantity-btn:hover {
         background-color: var(--yellow);
         color: var(--white);
      }

      .quantity-display {
         font-size: 2rem;
         color: var(--white);
         background: var(--yellow);
         padding: 0.5rem 1.5rem;
         border-radius: 0.5rem;
         margin: 0 1rem;
         min-width: 5rem;
         text-align: center;
      }

      .add-to-cart-btn {
         background-color: var(--main-color);
         color: var(--black);
         font-size: 1.8rem;
         padding: 1rem 2rem;
         border-radius: 0.5rem;
         cursor: pointer;
         transition: background-color 0.3s;
         margin-top: 1rem;
         width: 100%;
      }

      .add-to-cart-btn:hover {
         background-color: var(--yellow);
         color: var(--white);
         letter-spacing: .1rem;
      }

      /* Footer styles */
      .footer {
         background: var(--black);
         padding: 3rem 2rem;
         text-align: center;
         margin-top: 5rem;
      }

      .footer .grid {
         display: grid;
         grid-template-columns: repeat(auto-fit, minmax(27rem, 1fr));
         gap: 1.5rem;
         align-items: flex-start;
      }

      .footer .grid .box {
         text-align: center;
         padding: 2rem;
         border: var(--border);
      }

      .footer .grid .box h3 {
         font-size: 2.2rem;
         margin-bottom: 1.5rem;
         color: var(--white);
         text-transform: capitalize;
      }

      .footer .grid .box a,
      .footer .grid .box p {
         display: block;
         padding: 0.7rem 0;
         font-size: 1.7rem;
         color: var(--light-color);
      }

      .footer .grid .box a:hover {
         color: var(--white);
         text-decoration: underline;
      }

      .footer .grid .box .share {
         margin-top: 1rem;
      }

      .footer .grid .box .share a {
         display: inline-block;
         margin: 0 0.5rem;
         height: 4rem;
         width: 4rem;
         line-height: 4rem;
         font-size: 1.8rem;
         background: var(--white);
         color: var(--black);
         border-radius: 50%;
      }

      .footer .grid .box .share a:hover {
         background: var(--main-color);
         color: var(--white);
      }

      .footer .grid .box .dateinfo {
         display: flex;
         justify-content: space-between;
         padding: 0.5rem 0;
      }

      .footer .grid .box .dateinfo p,
      .footer .grid .box .dateinfo samp {
         font-size: 1.6rem;
         color: var(--light-color);
      }

      .footer .grid .box .phone p {
         display: flex;
         align-items: center;
         justify-content: center;
         gap: 1rem;
      }

      .footer .grid .box .phone1 h3 {
         margin-top: 2rem;
      }

      .footer .credit {
         margin-top: 2.5rem;
         padding: 2rem 1rem;
         border-top: var(--border);
         font-size: 2rem;
         color: var(--white);
      }

      .footer .credit span {
         color: var(--main-color);
      }

      .footer .credit a {
         color: var(--main-color);
      }

      .footer .credit a:hover {
         text-decoration: underline;
      }

      /* Media queries */
      @media (max-width: 991px) {
         html {
            font-size: 55%;
         }
      }

      @media (max-width: 768px) {
         .header .navbar {
            position: absolute;
            top: 99%;
            left: 0;
            right: 0;
            background-color: var(--black);
            clip-path: polygon(0 0, 100% 0, 100% 0, 0 0);
            transition: 0.3s linear;
         }

         .header .navbar.active {
            clip-path: polygon(0 0, 100% 0, 100% 100%, 0 100%);
         }

         .header .navbar a {
            display: block;
            margin: 2rem;
            font-size: 2.2rem;
         }

         .products-container {
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
         }
         
         .contact .row {
            flex-direction: column;
         }
         
         .subscribe .email {
            width: 80%;
         }
      }

      @media (max-width: 450px) {
         html {
            font-size: 50%;
         }
         
         .title {
            font-size: 3rem;
         }

         .products-container {
            grid-template-columns: 1fr;
         }
      }
   </style>
</head>

<body>
   <!-- Header section -->
   <header class="header">
      <div class="flex">
         <a href="{{ route('customer.home') }}" class="logo">Kape Na! <i class="fas fa-coffee"></i></a>
         <nav class="navbar">
            <a href="{{ route('customer.home') }}">Home</a>
            <a href="{{ route('menu') }}">Menu</a>
            <a href="{{ route('customer.cart') }}" class="cart-link">
               Cart 
               <span id="cart-count" class="cart-count">0</span>
            </a>
         </nav>
         
         <div class="auth-section">
            @auth
               <!-- User Profile when logged in -->
               <div class="user-profile">
                  <div class="dropdown">
                     <div class="user-info user-name">
                        <i class="fas fa-user-circle user-icon"></i>
                        <span>{{ Auth::user()->name }}</span>
                        <i class="fas fa-chevron-down" style="font-size: 1.2rem; margin-left: 0.5rem;"></i>
                     </div>
                     <div class="dropdown-content">
                        <a href="#"><i class="fas fa-user"></i> My Profile</a>
                        <a href="{{ route('customer.cart') }}">Cart</a>
                        <a href="#"><i class="fas fa-cog"></i> Settings</a>
                        <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                           @csrf
                           <a href="#" onclick="event.preventDefault(); this.closest('form').submit();">
                              <i class="fas fa-sign-out-alt"></i> Logout
                           </a>
                        </form>
                     </div>
                  </div>
               </div>
            @else
               <!-- Login/Register buttons when not logged in -->
               <div class="auth-buttons">
                  <a href="{{ route('login') }}">Login</a>
                  <a href="{{ route('register') }}">Register</a>
               </div>
            @endauth
         </div>
      </div>
   </header>

   <!-- Success Messages -->
   @if(session('success'))
      <div class="success-message">
         {{ session('success') }}
      </div>
   @endif

   <!-- Dashboard Welcome Section -->
   <section class="dashboard-welcome">
      <h2>CATEGORY</h2>
   </section>

   <!-- Coffee Products Section -->
   <section class="products">
      <h1 class="title">Coffee Products</h1>
      <div class="products-container">
         <div class="product-box">
            <img src="{{ asset('uploaded_img/cappuccino-1659544996.png') }}" alt="Cappuccino" class="product-image">
            <h3>Cappuccino</h3>
            <p class="price">$200</p>
            <div class="quantity-controls">
               <div class="quantity-btn minus">-</div>
               <div class="quantity-display">1</div>
               <div class="quantity-btn plus">+</div>
            </div>
            <button class="add-to-cart-btn" data-id="1" data-name="Cappuccino" data-price="200" data-image="{{ asset('uploaded_img/cappuccino-1659544996.png') }}">Add to Cart</button>
         </div>

         <div class="product-box">
            <img src="{{ asset('uploaded_img/cortado-1659544996.webp') }}" alt="Cortado" class="product-image">
            <h3>Cortado</h3>
            <p class="price">$20</p>
            <div class="quantity-controls">
               <div class="quantity-btn minus">-</div>
               <div class="quantity-display">1</div>
               <div class="quantity-btn plus">+</div>
            </div>
            <button class="add-to-cart-btn" data-id="2" data-name="Cortado" data-price="20" data-image="{{ asset('uploaded_img/cortado-1659544996.webp') }}">Add to Cart</button>
         </div>

         <div class="product-box">
            <img src="{{ asset('uploaded_img/latte-1659544996.webp') }}" alt="Latte" class="product-image">
            <h3>Latte</h3>
            <p class="price">$20</p>
            <div class="quantity-controls">
               <div class="quantity-btn minus">-</div>
               <div class="quantity-display">1</div>
               <div class="quantity-btn plus">+</div>
            </div>
            <button class="add-to-cart-btn" data-id="3" data-name="Latte" data-price="20" data-image="{{ asset('uploaded_img/latte-1659544996.webp') }}">Add to Cart</button>
         </div>

         <div class="product-box">
            <img src="{{ asset('uploaded_img/red-eye-1659544996.webp') }}" alt="Red Eye" class="product-image">
            <h3>Red Eye</h3>
            <p class="price">$20</p>
            <div class="quantity-controls">
               <div class="quantity-btn minus">-</div>
               <div class="quantity-display">1</div>
               <div class="quantity-btn plus">+</div>
            </div>
            <button class="add-to-cart-btn" data-id="4" data-name="Red Eye" data-price="20" data-image="{{ asset('uploaded_img/red-eye-1659544996.webp') }}">Add to Cart</button>
         </div>

         <div class="product-box">
            <img src="{{ asset('uploaded_img/mocha-1659544996.webp') }}" alt="Mocha" class="product-image">
            <h3>Mocha</h3>
            <p class="price">$20</p>
            <div class="quantity-controls">
               <div class="quantity-btn minus">-</div>
               <div class="quantity-display">1</div>
               <div class="quantity-btn plus">+</div>
            </div>
            <button class="add-to-cart-btn" data-id="5" data-name="Mocha" data-price="20" data-image="{{ asset('uploaded_img/mocha-1659544996.webp') }}">Add to Cart</button>
         </div>

         <div class="product-box">
            <img src="{{ asset('uploaded_img/raf-1659544996.webp') }}" alt="Raf" class="product-image">
            <h3>Raf</h3>
            <p class="price">$20</p>
            <div class="quantity-controls">
               <div class="quantity-btn minus">-</div>
               <div class="quantity-display">1</div>
               <div class="quantity-btn plus">+</div>
            </div>
            <button class="add-to-cart-btn" data-id="6" data-name="Raf" data-price="20" data-image="{{ asset('uploaded_img/raf-1659544996.webp') }}">Add to Cart</button>
         </div>

         <div class="product-box">
            <img src="{{ asset('uploaded_img/macchiato-1659544996.webp') }}" alt="Macchiato" class="product-image">
            <h3>Macchiato</h3>
            <p class="price">$20</p>
            <div class="quantity-controls">
               <div class="quantity-btn minus">-</div>
               <div class="quantity-display">1</div>
               <div class="quantity-btn plus">+</div>
            </div>
            <button class="add-to-cart-btn" data-id="7" data-name="Macchiato" data-price="20" data-image="{{ asset('uploaded_img/macchiato-1659544996.webp') }}">Add to Cart</button>
         </div>

         <div class="product-box">
            <img src="{{ asset('uploaded_img/cold-brew-1659544996.webp') }}" alt="Cold Brew" class="product-image">
            <h3>Cold Brew</h3>
            <p class="price">$20</p>
            <div class="quantity-controls">
               <div class="quantity-btn minus">-</div>
               <div class="quantity-display">1</div>
               <div class="quantity-btn plus">+</div>
            </div>
            <button class="add-to-cart-btn" data-id="8" data-name="Cold Brew" data-price="20" data-image="{{ asset('uploaded_img/cold-brew-1659544996.webp') }}">Add to Cart</button>
         </div>

         <div class="product-box">
            <img src="{{ asset('uploaded_img/espresso-con-panna-1659544996.webp') }}" alt="Espresso Con Panna" class="product-image">
            <h3>Espresso Con Panna</h3>
            <p class="price">$200</p>
            <div class="quantity-controls">
               <div class="quantity-btn minus">-</div>
               <div class="quantity-display">1</div>
               <div class="quantity-btn plus">+</div>
            </div>
            <button class="add-to-cart-btn" data-id="9" data-name="Espresso Con Panna" data-price="200" data-image="{{ asset('uploaded_img/espresso-con-panna-1659544996.webp') }}">Add to Cart</button>
         </div>

         <div class="product-box">
            <img src="{{ asset('uploaded_img/cafe-cubano-1659544996.webp') }}" alt="Café Cubano" class="product-image">
            <h3>Café Cubano</h3>
            <p class="price">$20</p>
            <div class="quantity-controls">
               <div class="quantity-btn minus">-</div>
               <div class="quantity-display">1</div>
               <div class="quantity-btn plus">+</div>
            </div>
            <button class="add-to-cart-btn" data-id="10" data-name="Café Cubano" data-price="20" data-image="{{ asset('uploaded_img/cafe-cubano-1659544996.webp') }}">Add to Cart</button>
         </div>

         <div class="product-box">
            <img src="{{ asset('uploaded_img/espresso-romano-1659544996.webp') }}" alt="Espresso Romano" class="product-image">
            <h3>Espresso Romano</h3>
            <p class="price">$20</p>
            <div class="quantity-controls">
               <div class="quantity-btn minus">-</div>
               <div class="quantity-display">1</div>
               <div class="quantity-btn plus">+</div>
            </div>
            <button class="add-to-cart-btn" data-id="11" data-name="Espresso Romano" data-price="20" data-image="{{ asset('uploaded_img/espresso-romano-1659544996.webp') }}">Add to Cart</button>
         </div>

         <div class="product-box">
            <img src="{{ asset('uploaded_img/long-black-1659544996.webp') }}" alt="Long Black" class="product-image">
            <h3>Long Black</h3>
            <p class="price">$20</p>
            <div class="quantity-controls">
               <div class="quantity-btn minus">-</div>
               <div class="quantity-display">1</div>
               <div class="quantity-btn plus">+</div>
            </div>
            <button class="add-to-cart-btn" data-id="12" data-name="Long Black" data-price="20" data-image="{{ asset('uploaded_img/long-black-1659544996.webp') }}">Add to Cart</button>
         </div>

         <div class="product-box">
            <img src="{{ asset('uploaded_img/caffe-breve-1659544996.webp') }}" alt="Caffè Breve" class="product-image">
            <h3>Caffè Breve</h3>
            <p class="price">$20</p>
            <div class="quantity-controls">
               <div class="quantity-btn minus">-</div>
               <div class="quantity-display">1</div>
               <div class="quantity-btn plus">+</div>
            </div>
            <button class="add-to-cart-btn" data-id="13" data-name="Caffè Breve" data-price="20" data-image="{{ asset('uploaded_img/caffe-breve-1659544996.webp') }}">Add to Cart</button>
         </div>

         <div class="product-box">
            <img src="{{ asset('uploaded_img/affogato-1659544996.webp') }}" alt="Affogato" class="product-image">
            <h3>Affogato</h3>
            <p class="price">$20</p>
            <div class="quantity-controls">
               <div class="quantity-btn minus">-</div>
               <div class="quantity-display">1</div>
               <div class="quantity-btn plus">+</div>
            </div>
            <button class="add-to-cart-btn" data-id="14" data-name="Affogato" data-price="20" data-image="{{ asset('uploaded_img/affogato-1659544996.webp') }}">Add to Cart</button>
         </div>

         <div class="product-box">
            <img src="{{ asset('uploaded_img/quad-shots-1659544996.webp') }}" alt="Quad Shots" class="product-image">
            <h3>Quad Shots</h3>
            <p class="price">$20</p>
            <div class="quantity-controls">
               <div class="quantity-btn minus">-</div>
               <div class="quantity-display">1</div>
               <div class="quantity-btn plus">+</div>
            </div>
            <button class="add-to-cart-btn" data-id="15" data-name="Quad Shots" data-price="20" data-image="{{ asset('uploaded_img/quad-shots-1659544996.webp') }}">Add to Cart</button>
         </div>

         <div class="product-box">
            <img src="{{ asset('uploaded_img/mexican-coffee-1659544996.webp') }}" alt="Mexican Coffee" class="product-image">
            <h3>Mexican Coffee</h3>
            <p class="price">$20</p>
            <div class="quantity-controls">
               <div class="quantity-btn minus">-</div>
               <div class="quantity-display">1</div>
               <div class="quantity-btn plus">+</div>
            </div>
            <button class="add-to-cart-btn" data-id="16" data-name="Mexican Coffee" data-price="20" data-image="{{ asset('uploaded_img/mexican-coffee-1659544996.webp') }}">Add to Cart</button>
         </div>
      </div>
   </section>

   <!-- Dashboard Welcome Section -->
   <section class="dashboard-welcome">
      <h2>CATEGORY</h2>
   </section>

   <!-- Special Dishes Products Section -->
   <section class="products">
      <h1 class="title">Special Dishes Products</h1>
      <div class="products-container">
         <div class="product-box">
            <img src="{{ asset('project images/pizza-5.png') }}" alt="Mushroom & Meat Pizza" class="product-image">
            <h3>Mushroom & Meat Pizza</h3>
            <p class="price">$200</p>
            <div class="quantity-controls">
               <div class="quantity-btn minus">-</div>
               <div class="quantity-display">1</div>
               <div class="quantity-btn plus">+</div>
            </div>
            <button class="add-to-cart-btn" data-id="17" data-name="Mushroom & Meat Pizza" data-price="200" data-image="{{ asset('project images/pizza-5.png') }}">Add to Cart</button>
         </div>

         <div class="product-box">
            <img src="{{ asset('project images/pizza-1.png') }}" alt="Vegetable Pizza" class="product-image">
            <h3>Vegetable Pizza</h3>
            <p class="price">$20</p>
            <div class="quantity-controls">
               <div class="quantity-btn minus">-</div>
               <div class="quantity-display">1</div>
               <div class="quantity-btn plus">+</div>
            </div>
            <button class="add-to-cart-btn" data-id="18" data-name="Vegetable Pizza" data-price="20" data-image="{{ asset('project images/pizza-1.png') }}">Add to Cart</button>
         </div>

         <div class="product-box">
            <img src="{{ asset('project images/pizza-2.png') }}" alt="Pepperoni & Tomato Pizza" class="product-image">
            <h3>Pepperoni & Tomato Pizza</h3>
            <p class="price">$20</p>
            <div class="quantity-controls">
               <div class="quantity-btn minus">-</div>
               <div class="quantity-display">1</div>
               <div class="quantity-btn plus">+</div>
            </div>
            <button class="add-to-cart-btn" data-id="19" data-name="Pepperoni & Tomato Pizza" data-price="20" data-image="{{ asset('project images/pizza-2.png') }}">Add to Cart</button>
         </div>

         <div class="product-box">
            <img src="{{ asset('project images/pizza-4.png') }}" alt="Cheese Pizza" class="product-image">
            <h3>Cheese Pizza</h3>
            <p class="price">$20</p>
            <div class="quantity-controls">
               <div class="quantity-btn minus">-</div>
               <div class="quantity-display">1</div>
               <div class="quantity-btn plus">+</div>
            </div>
            <button class="add-to-cart-btn" data-id="20" data-name="Cheese Pizza" data-price="20" data-image="{{ asset('project images/pizza-4.png') }}">Add to Cart</button>
         </div>

         <div class="product-box">
            <img src="{{ asset('project images/burger-2.png') }}" alt="Crispy Chicken Burger" class="product-image">
            <h3>Crispy Chicken Burger</h3>
            <p class="price">$20</p>
            <div class="quantity-controls">
               <div class="quantity-btn minus">-</div>
               <div class="quantity-display">1</div>
               <div class="quantity-btn plus">+</div>
            </div>
            <button class="add-to-cart-btn" data-id="21" data-name="Crispy Chicken Burger" data-price="20" data-image="{{ asset('project images/burger-2.png') }}">Add to Cart</button>
         </div>

         <div class="product-box">
            <img src="{{ asset('project images/burger-1.png') }}" alt="Beef Cheeseburger" class="product-image">
            <h3>Beef Cheeseburger</h3>
            <p class="price">$20</p>
            <div class="quantity-controls">
               <div class="quantity-btn minus">-</div>
               <div class="quantity-display">1</div>
               <div class="quantity-btn plus">+</div>
            </div>
            <button class="add-to-cart-btn" data-id="22" data-name="Beef Cheeseburger" data-price="20" data-image="{{ asset('project images/burger-1.png') }}">Add to Cart</button>
         </div>

         <div class="product-box">
            <img src="{{ asset('project images/dish-2.png') }}" alt="Pasta Dish" class="product-image">
            <h3>Pasta Dish</h3>
            <p class="price">$20</p>
            <div class="quantity-controls">
               <div class="quantity-btn minus">-</div>
               <div class="quantity-display">1</div>
               <div class="quantity-btn plus">+</div>
            </div>
            <button class="add-to-cart-btn" data-id="23" data-name="Pasta Dish" data-price="20" data-image="{{ asset('project images/dish-2.png') }}">Add to Cart</button>
         </div>

         <div class="product-box">
            <img src="{{ asset('project images/dish-1.png') }}" alt="Plain Spaghetti Noodles" class="product-image">
            <h3>Plain Spaghetti Noodles</h3>
            <p class="price">$20</p>
            <div class="quantity-controls">
               <div class="quantity-btn minus">-</div>
               <div class="quantity-display">1</div>
               <div class="quantity-btn plus">+</div>
            </div>
            <button class="add-to-cart-btn" data-id="24" data-name="Plain Spaghetti Noodles" data-price="20" data-image="{{ asset('project images/dish-1.png') }}">Add to Cart</button>
         </div>
      </div>
   </section>

   <!-- Dashboard Welcome Section -->
   <section class="dashboard-welcome">
      <h2>CATEGORY</h2>
   </section>

   <!-- Drink Products Section -->
   <section class="products">
      <h1 class="title">Drink Products</h1>
      <div class="products-container">
         <div class="product-box">
            <img src="{{ asset('project images/drink-1.png') }}" alt="Orange Juice" class="product-image">
            <h3>Orange Juice</h3>
            <p class="price">$200</p>
            <div class="quantity-controls">
               <div class="quantity-btn minus">-</div>
               <div class="quantity-display">1</div>
               <div class="quantity-btn plus">+</div>
            </div>
            <button class="add-to-cart-btn" data-id="25" data-name="Orange Juice" data-price="200" data-image="{{ asset('project images/drink-1.png') }}">Add to Cart</button>
         </div>

         <div class="product-box">
            <img src="{{ asset('project images/drink-3.png') }}" alt="Mojito or Mint and Lime Cooler" class="product-image">
            <h3>Mojito or Mint and Lime Cooler</h3>
            <p class="price">$20</p>
            <div class="quantity-controls">
               <div class="quantity-btn minus">-</div>
               <div class="quantity-display">1</div>
               <div class="quantity-btn plus">+</div>
            </div>
            <button class="add-to-cart-btn" data-id="26" data-name="Mojito or Mint and Lime Cooler" data-price="20" data-image="{{ asset('project images/drink-3.png') }}">Add to Cart</button>
         </div>

         <div class="product-box">
            <img src="{{ asset('project images/drink-4.png') }}" alt="Fruity/Red Iced Tea or Iced Fruit Juice" class="product-image">
            <h3>Fruity/Red Iced Tea or Iced Fruit Juice</h3>
            <p class="price">$20</p>
            <div class="quantity-controls">
               <div class="quantity-btn minus">-</div>
               <div class="quantity-display">1</div>
               <div class="quantity-btn plus">+</div>
            </div>
            <button class="add-to-cart-btn" data-id="27" data-name="Fruity/Red Iced Tea or Iced Fruit Juice" data-price="20" data-image="{{ asset('project images/drink-4.png') }}">Add to Cart</button>
         </div>

         <div class="product-box">
            <img src="{{ asset('project images/drink-5.png') }}" alt="Strawberry Cocktail or Mocktail" class="product-image">
            <h3>Strawberry Cocktail or Mocktail</h3>
            <p class="price">$20</p>
            <div class="quantity-controls">
               <div class="quantity-btn minus">-</div>
               <div class="quantity-display">1</div>
               <div class="quantity-btn plus">+</div>
            </div>
            <button class="add-to-cart-btn" data-id="28" data-name="Strawberry Cocktail or Mocktail" data-price="20" data-image="{{ asset('project images/drink-5.png') }}">Add to Cart</button>
         </div>
      </div>
   </section>

   <!-- Dashboard Welcome Section -->
   <section class="dashboard-welcome">
      <h2>CATEGORY</h2>
   </section>

   <!-- Dessert Products Section -->
   <section class="products">
      <h1 class="title">Dessert Products</h1>
      <div class="products-container">
         <div class="product-box">
            <img src="{{ asset('project images/dessert-1.png') }}" alt="Strawberry Frappé or Smoothie" class="product-image">
            <h3>Strawberry Frappé or Smoothie</h3>
            <p class="price">$200</p>
            <div class="quantity-controls">
               <div class="quantity-btn minus">-</div>
               <div class="quantity-display">1</div>
               <div class="quantity-btn plus">+</div>
            </div>
            <button class="add-to-cart-btn" data-id="29" data-name="Strawberry Frappé or Smoothie" data-price="200" data-image="{{ asset('project images/dessert-1.png') }}">Add to Cart</button>
         </div>

         <div class="product-box">
            <img src="{{ asset('project images/dessert-3.png') }}" alt="Caramel Oreo Sundae or Soft Serve Parfait" class="product-image">
            <h3>Caramel Oreo Sundae or Soft Serve Parfait</h3>
            <p class="price">$20</p>
            <div class="quantity-controls">
               <div class="quantity-btn minus">-</div>
               <div class="quantity-display">1</div>
               <div class="quantity-btn plus">+</div>
            </div>
            <button class="add-to-cart-btn" data-id="30" data-name="Caramel Oreo Sundae or Soft Serve Parfait" data-price="20" data-image="{{ asset('project images/dessert-3.png') }}">Add to Cart</button>
         </div>

         <div class="product-box">
            <img src="{{ asset('project images/dessert-4.png') }}" alt="Chocolate Cupcake with Whipped Cream and Cherry" class="product-image">
            <h3>Chocolate Cupcake with Whipped Cream and Cherry</h3>
            <p class="price">$20</p>
            <div class="quantity-controls">
               <div class="quantity-btn minus">-</div>
               <div class="quantity-display">1</div>
               <div class="quantity-btn plus">+</div>
            </div>
            <button class="add-to-cart-btn" data-id="31" data-name="Chocolate Cupcake with Whipped Cream and Cherry" data-price="20" data-image="{{ asset('project images/dessert-4.png') }}">Add to Cart</button>
         </div>

         <div class="product-box">
            <img src="{{ asset('project images/dessert-5.png') }}" alt="Strawberry Ice Cream Sundae" class="product-image">
            <h3>Strawberry Ice Cream Sundae</h3>
            <p class="price">$20</p>
            <div class="quantity-controls">
               <div class="quantity-btn minus">-</div>
               <div class="quantity-display">1</div>
               <div class="quantity-btn plus">+</div>
            </div>
            <button class="add-to-cart-btn" data-id="32" data-name="Strawberry Ice Cream Sundae" data-price="20" data-image="{{ asset('project images/dessert-5.png') }}">Add to Cart</button>
         </div>
      </div>
   </section>

   <!-- Footer section -->
   <footer class="footer">
      <section class="grid">
         <div class="box">
            <h3> Cafe Shop <i class="fas fa-shopping-basket"></i> </h3>
            <div class="share">
               <a href="https://www.facebook.com/jemhail" class="fab fa-facebook-f"></a>
               <a href="https://www.instagram.com/jembo.magbanua/" class="fab fa-instagram"></a>
               <a href="http://linkedin.com/in/jembo-magbanua-b49b6b2b2/" class="fab fa-linkedin"></a>
            </div>
         </div>

         <div class="box">
            <h3>Opening Hours</h3>
            <div class="dateinfo">
               <p>MONDAY </p> <samp>2:00PM - 2:00AM</samp>
            </div>
            <div class="dateinfo">
               <p>TUESDAY </p> <samp>2:00PM - 2:00AM</samp>
            </div>
            <div class="dateinfo">
               <p>WEDNESDAY </p><samp>2:00PM - 2:00AM</samp>
            </div>
            <div class="dateinfo">
               <p>THURSDAY </p><samp>2:00PM - 2:00AM</samp>
            </div>
            <div class="dateinfo">
               <p>FRIDAY </p> <samp>2:00PM - 2:00AM</samp>
            </div>
            <div class="dateinfo">
               <p>SATURDAY </p> <samp>2:00PM - 2:00AM</samp>
            </div>
            <div class="dateinfo">
               <p>SUNDAY </p><samp>CLOSE!</samp>
            </div>
         </div>

         <div class="box">
            <h3>contact info</h3>
            <div class="phone">
               <p> <i class="fas fa-phone"></i> +639914677225 </p>
               <p> <i class="fas fa-phone"></i> +639512592678 </p>
               <p> <i class="fas fa-envelope"></i> magbanuajembo17@gmail.com </p>
            </div>

            <div class="phone1">
               <h3>Branch Location</h3>
               <p> <i class="fas fa-map-marker-alt"></i> Caraga State University - Main Campus </p>
               <p> <i class="fas fa-envelope"></i> magbanuajembo17@gmail.com </p>
            </div>
         </div>
      </section>

      <div class="credit">&copy; copyright @ {{ date('Y') }} by <span>Cafe Shop</span> | <a>Magbanua, Jembo</a> | all rights reserved!</div>
   </footer>

   <script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>
   <script>
      // Cart functionality
      class Cart {
         constructor() {
            this.items = this.loadCart();
         }

         // Load cart from localStorage
         loadCart() {
            const cart = localStorage.getItem('cart');
            return cart ? JSON.parse(cart) : [];
         }

         // Save cart to localStorage
         saveCart() {
            localStorage.setItem('cart', JSON.stringify(this.items));
         }

         // Add item to cart
         addItem(productId, name, price, image, quantity) {
            const existingItem = this.items.find(item => item.id === productId);
            
            if (existingItem) {
               existingItem.quantity += quantity;
            } else {
               this.items.push({
                  id: productId,
                  name: name,
                  price: price,
                  image: image,
                  quantity: quantity
               });
            }
            
            this.saveCart();
            this.updateCartCount();
         }

         // Remove item from cart
         removeItem(productId) {
            this.items = this.items.filter(item => item.id !== productId);
            this.saveCart();
            this.updateCartCount();
         }

         // Update item quantity
         updateQuantity(productId, quantity) {
            const item = this.items.find(item => item.id === productId);
            if (item) {
               item.quantity = quantity;
               this.saveCart();
            }
         }

         // Get total items count
         getTotalItems() {
            return this.items.reduce((total, item) => total + item.quantity, 0);
         }

         // Get cart total price
         getTotalPrice() {
            return this.items.reduce((total, item) => total + (item.price * item.quantity), 0);
         }

         // Update cart count in header
         updateCartCount() {
            const cartCount = document.getElementById('cart-count');
            if (cartCount) {
               cartCount.textContent = this.getTotalItems();
            }
         }

         // Clear cart
         clearCart() {
            this.items = [];
            this.saveCart();
            this.updateCartCount();
         }
      }

      // Initialize cart
      const cart = new Cart();

      // Quantity controls functionality
      document.querySelectorAll('.quantity-btn').forEach(button => {
         button.addEventListener('click', function() {
            const display = this.parentElement.querySelector('.quantity-display');
            let quantity = parseInt(display.textContent);
            
            if (this.classList.contains('plus')) {
               quantity++;
            } else if (this.classList.contains('minus') && quantity > 1) {
               quantity--;
            }
            
            display.textContent = quantity;
         });
      });

      // Add to cart functionality
      document.querySelectorAll('.add-to-cart-btn').forEach(button => {
         button.addEventListener('click', function() {
            const productBox = this.closest('.product-box');
            const productId = this.getAttribute('data-id');
            const productName = this.getAttribute('data-name');
            const productPrice = parseFloat(this.getAttribute('data-price'));
            const productImage = this.getAttribute('data-image');
            const quantity = parseInt(productBox.querySelector('.quantity-display').textContent);
            
            // Add item to cart
            cart.addItem(productId, productName, productPrice, productImage, quantity);
            
            // Show success message
            const successMessage = document.createElement('div');
            successMessage.className = 'success-message';
            successMessage.textContent = `Added ${quantity} x ${productName} to cart!`;
            
            // Remove any existing success message
            const existingMessage = document.querySelector('.success-message');
            if (existingMessage && !existingMessage.id) {
               existingMessage.remove();
            }
            
            // Insert the success message before the products section
            document.querySelector('.products').insertBefore(successMessage, document.querySelector('.products-container'));
            
            // Remove success message after 3 seconds
            setTimeout(() => {
               successMessage.remove();
            }, 3000);
            
            // Reset quantity to 1
            productBox.querySelector('.quantity-display').textContent = '1';
         });
      });

      // Initialize cart count on page load
      document.addEventListener('DOMContentLoaded', function() {
         cart.updateCartCount();
      });
   </script>
</body>
</html>
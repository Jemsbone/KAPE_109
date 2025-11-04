<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Kape Na! - Drink Products</title>
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
         position: relative;
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

      /* About section */
      .about .row {
         display: flex;
         align-items: center;
         flex-wrap: wrap;
         gap: 1.5rem;
         background-color: var(--black);
         padding: 2rem;
      }

      .about .row .image {
         flex: 1 1 40rem;
      }

      .about .row .image img {
         width: 100%;
         border-radius: 1rem;
      }

      .about .row .content {
         flex: 1 1 40rem;
         text-align: center;
      }

      .about .row .content h3 {
         font-size: 3rem;
         color: var(--white);
         text-transform: capitalize;
         margin-bottom: 1rem;
      }

      .about .row .content p {
         padding: 1rem 0;
         line-height: 2;
         font-size: 1.6rem;
         color: var(--light-color);
      }

      /* Subscribe section */
      .subscribe {
         text-align: center;
         margin: 4rem 0;
      }

      .subscribe p {
         font-size: 2rem;
         color: var(--light-color);
         margin-bottom: 2rem;
      }

      .subscribe .email {
         width: 50%;
         padding: 1.5rem;
         font-size: 1.8rem;
         border-bottom: 2px solid var(--white);
         background: transparent;
         color: var(--white);
         margin-right: 1rem;
      }

      /* Contact section */
      .contact .row {
         display: flex;
         align-items: center;
         flex-wrap: wrap;
         gap: 1.5rem;
      }

      .contact .row .map {
         flex: 1 1 40rem;
      }

      .contact .row .map iframe {
         width: 100%;
         height: 40rem;
         border: var(--border);
         border-radius: 1rem;
      }

      .contact .row form {
         flex: 1 1 40rem;
         padding: 2rem;
         text-align: center;
      }

      .contact .row form h3 {
         font-size: 2.5rem;
         color: var(--white);
         margin-bottom: 1rem;
         text-transform: capitalize;
      }

      .contact .row form .box {
         margin: .7rem 0;
         font-size: 1.8rem;
         color: var(--white);
         border-bottom: var(--border);
         padding: 1.4rem;
         width: 100%;
         background: transparent;
      }

      .contact .row form textarea {
         height: 20rem;
         resize: none;
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
            <a href="{{ route('about') }}">About</a>
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
                        <a href="{{ route('customer.profile') }}"><i class="fas fa-user"></i> My Profile</a>
                        <a href="{{ route('customer.cart') }}"><i class="fas fa-shopping-cart"></i> Cart</a>
                        <a href="{{ route('customer.settings') }}"><i class="fas fa-cog"></i> Settings</a>
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

   <!-- about section starts  -->
   <section class="about">
      <div class="row">
         <div class="image">
            <img src="{{ asset('images/coffee-shop-1209863_1280.jpg') }}" alt="Why Choose Us">
         </div>
         <div class="content">
            <h3>why choose us?</h3>
            <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Deserunt, neque debitis incidunt qui ipsum sed doloremque a molestiae in veritatis ullam similique sunt aliquam dolores dolore? Quasi atque debitis nobis!</p>
            <a href="{{ route('menu') }}" class="btn">our menu</a>
         </div>
      </div>
   </section>

   <!-- Subscribe section -->
   <section class="subscribe">
      <p>Get the latest update about our products</p>
      <form action="" method="post">
         <input type="email" name="email" class="email" placeholder="Enter your email" required>
         <input type="submit" value="subscribe" class="btn">
      </form>
   </section>

   <!-- Contact section -->
   <section class="contact">
      <div class="row">
         <div class="map">
            <iframe class="minmap" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15777.467380763725!2d125.60962806977538!3d8.956199999999997!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3301ceb3eb7f5e0f%3A0x4a5f5b04a5b5b5b5!2sCaraga%20State%20University%20-%20Ampayon%20Campus!5e1!3m2!1sen!2sbd!4v1660587920897!5m2!1sen!2sbd" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
         </div>

         <form action="" method="post">
            <h3>Contact Us !</h3>
            <input type="text" name="name" maxlength="50" class="box" placeholder="Enter Your Name" required>
            <input type="email" name="email" maxlength="50" class="box" placeholder="Enter Your Email" required>
            <textarea name="msg" class="box" required placeholder="Enter Your Message" maxlength="500" cols="30" rows="10"></textarea>
            <input type="submit" value="send" name="send" class="btn">
         </form>
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
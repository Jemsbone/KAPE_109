<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Kape Na! - My Cart</title>
   <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" />
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
   <style>
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

      .header .icons div {
         font-size: 2.5rem;
         color: var(--white);
         margin-left: 1.7rem;
         cursor: pointer;
      }

      .header .icons div:hover {
         color: var(--main-color);
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

      .success-message {
         background-color: rgba(46, 204, 113, 0.2);
         color: #2ecc71;
         padding: 1rem 2rem;
         margin: 1rem auto;
         max-width: 1200px;
         border-radius: 0.5rem;
         font-size: 1.6rem;
         text-align: center;
         border: 1px solid #2ecc71;
      }

      /* Cart Section Styles */
      .cart-section {
         min-height: 70vh;
         padding: 2rem;
      }

      .cart-container {
         display: grid;
         grid-template-columns: 2fr 1fr;
         gap: 3rem;
         margin-top: 2rem;
      }

      @media (max-width: 768px) {
         .cart-container {
            grid-template-columns: 1fr;
         }
      }

      .cart-items {
         background-color: var(--black);
         border: var(--border);
         border-radius: 1rem;
         padding: 2rem;
      }

      .cart-item {
         display: grid;
         grid-template-columns: 1fr 2fr 1fr 1fr 1fr;
         gap: 1.5rem;
         align-items: center;
         padding: 1.5rem 0;
         border-bottom: 1px solid rgba(255, 255, 255, 0.1);
      }

      @media (max-width: 768px) {
         .cart-item {
            grid-template-columns: 1fr 2fr;
            grid-template-rows: auto auto auto;
            gap: 1rem;
         }
         
         .item-image {
            grid-column: 1;
            grid-row: 1 / 3;
         }
         
         .item-details {
            grid-column: 2;
            grid-row: 1;
         }
         
         .item-quantity {
            grid-column: 1;
            grid-row: 3;
         }
         
         .item-price {
            grid-column: 2;
            grid-row: 2;
         }
         
         .item-remove {
            grid-column: 2;
            grid-row: 3;
            justify-self: end;
         }
      }

      .item-image {
         width: 80px;
         height: 80px;
         border-radius: 0.5rem;
         overflow: hidden;
      }

      .item-image img {
         width: 100%;
         height: 100%;
         object-fit: cover;
      }

      .item-details h3 {
         font-size: 1.8rem;
         color: var(--white);
         margin-bottom: 0.5rem;
      }

      .item-details p {
         font-size: 1.4rem;
         color: var(--light-color);
      }

      .item-quantity {
         display: flex;
         align-items: center;
         gap: 1rem;
      }

      .quantity-btn {
         width: 3rem;
         height: 3rem;
         background-color: var(--main-color);
         color: var(--black);
         border-radius: 50%;
         display: flex;
         align-items: center;
         justify-content: center;
         cursor: pointer;
         font-size: 1.6rem;
         transition: all 0.3s;
      }

      .quantity-btn:hover {
         background-color: #c19a6b;
      }

      .quantity-input {
         width: 5rem;
         text-align: center;
         font-size: 1.6rem;
         background: transparent;
         color: var(--white);
         border: 1px solid var(--light-color);
         border-radius: 0.5rem;
         padding: 0.5rem;
      }

      .item-price {
         font-size: 1.8rem;
         color: var(--main-color);
         font-weight: bold;
      }

      .item-remove {
         color: var(--red);
         font-size: 2rem;
         cursor: pointer;
         transition: all 0.3s;
      }

      .item-remove:hover {
         color: #c0392b;
      }

      .cart-summary {
         background-color: var(--black);
         border: var(--border);
         border-radius: 1rem;
         padding: 2rem;
         height: fit-content;
      }

      .summary-title {
         font-size: 2.2rem;
         color: var(--white);
         margin-bottom: 1.5rem;
         text-align: center;
         border-bottom: 1px solid var(--light-color);
         padding-bottom: 1rem;
      }

      .summary-row {
         display: flex;
         justify-content: space-between;
         align-items: center;
         padding: 1rem 0;
         border-bottom: 1px solid rgba(255, 255, 255, 0.1);
      }

      .summary-label {
         font-size: 1.6rem;
         color: var(--white);
      }

      .summary-value {
         font-size: 1.6rem;
         color: var(--main-color);
      }

      .summary-total {
         font-size: 2rem;
         font-weight: bold;
         margin-top: 1rem;
      }

      .checkout-btn {
         width: 100%;
         padding: 1.5rem;
         background-color: var(--main-color);
         color: var(--black);
         font-size: 1.8rem;
         border-radius: 0.5rem;
         cursor: pointer;
         margin-top: 2rem;
         transition: all 0.3s;
         text-align: center;
         display: block;
      }

      .checkout-btn:hover {
         background-color: #c19a6b;
         letter-spacing: .1rem;
      }

      .continue-shopping {
         display: block;
         text-align: center;
         margin-top: 1.5rem;
         font-size: 1.6rem;
         color: var(--main-color);
         transition: all 0.3s;
      }

      .continue-shopping:hover {
         color: var(--white);
         text-decoration: underline;
      }

      .empty-cart {
         text-align: center;
         padding: 4rem 2rem;
         grid-column: 1 / -1;
      }

      .empty-cart-icon {
         font-size: 8rem;
         color: var(--light-color);
         margin-bottom: 2rem;
      }

      .empty-cart h3 {
         font-size: 2.5rem;
         color: var(--white);
         margin-bottom: 1.5rem;
      }

      .empty-cart p {
         font-size: 1.6rem;
         color: var(--light-color);
         margin-bottom: 2rem;
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
      }

      @media (max-width: 450px) {
         html {
            font-size: 50%;
         }
         
         .title {
            font-size: 3rem;
         }
      }
   </style>
</head>

<body>
   <!-- Updated Header section -->
   <header class="header">
      <div class="flex">
         <a href="{{ route('customer.home') }}" class="logo">Kape Na! <i class="fas fa-coffee"></i></a>
         <nav class="navbar">
            <a href="{{ route('customer.home') }}">Home</a>
            <a href="{{ route('customer.cmenu') }}">Menu</a>
            <a href="{{ route('customer.cart') }}">Cart</a>
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

   <!-- Cart Section -->
   <section class="cart-section">
      <h1 class="title">My Cart</h1>
      
      <!-- Cart Container -->
      <div class="cart-container">
         <!-- Cart Items -->
         <div class="cart-items" id="cart-items-container">
            <!-- Cart items will be dynamically inserted here -->
         </div>
         
         <!-- Cart Summary -->
         <div class="cart-summary">
            <h3 class="summary-title">Order Summary</h3>
            
            <div class="summary-row">
               <span class="summary-label">Subtotal</span>
               <span class="summary-value" id="subtotal">$0</span>
            </div>
            
            <div class="summary-row">
               <span class="summary-label">Service Fee</span>
               <span class="summary-value" id="service-fee">$0</span>
            </div>
            
            <div class="summary-row">
               <span class="summary-label">Tax</span>
               <span class="summary-value" id="tax">$0</span>
            </div>
            
            <div class="summary-row summary-total">
               <span class="summary-label">Total</span>
               <span class="summary-value" id="total">$0</span>
            </div>
            
            <button class="checkout-btn">Proceed to Checkout</button>
            <a href="{{ route('customer.cmenu') }}" class="continue-shopping">Continue Shopping</a>
         </div>
         
         <!-- Empty Cart Message -->
         <div class="empty-cart" id="empty-cart" style="display: none;">
            <i class="fas fa-shopping-cart empty-cart-icon"></i>
            <h3>Your Cart is Empty</h3>
            <p>Looks like you haven't added anything to your cart yet.</p>
            <a href="{{ route('customer.cmenu') }}" class="btn">Browse Menu</a>
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

      // Render cart items
      function renderCartItems() {
         const cartItemsContainer = document.getElementById('cart-items-container');
         const emptyCartMessage = document.getElementById('empty-cart');
         const subtotalElement = document.getElementById('subtotal');
         const serviceFeeElement = document.getElementById('service-fee');
         const taxElement = document.getElementById('tax');
         const totalElement = document.getElementById('total');

         if (cart.items.length === 0) {
            cartItemsContainer.style.display = 'none';
            emptyCartMessage.style.display = 'block';
            subtotalElement.textContent = '$0';
            serviceFeeElement.textContent = '$0';
            taxElement.textContent = '$0';
            totalElement.textContent = '$0';
            return;
         }

         cartItemsContainer.style.display = 'block';
         emptyCartMessage.style.display = 'none';

         // Clear existing items
         cartItemsContainer.innerHTML = '';

         // Calculate totals
         const subtotal = cart.getTotalPrice();
         const serviceFee = subtotal * 0.05; // 5% service fee
         const tax = subtotal * 0.1; // 10% tax
         const total = subtotal + serviceFee + tax;

         // Update summary
         subtotalElement.textContent = `$${subtotal.toFixed(2)}`;
         serviceFeeElement.textContent = `$${serviceFee.toFixed(2)}`;
         taxElement.textContent = `$${tax.toFixed(2)}`;
         totalElement.textContent = `$${total.toFixed(2)}`;

         // Render each cart item
         cart.items.forEach(item => {
            const cartItem = document.createElement('div');
            cartItem.className = 'cart-item';
            cartItem.innerHTML = `
               <div class="item-image">
                  <img src="${item.image}" alt="${item.name}">
               </div>
               <div class="item-details">
                  <h3>${item.name}</h3>
                  <p>Price: $${item.price}</p>
               </div>
               <div class="item-quantity">
                  <span class="quantity-btn minus" data-id="${item.id}">-</span>
                  <input type="number" class="quantity-input" value="${item.quantity}" min="1" data-id="${item.id}">
                  <span class="quantity-btn plus" data-id="${item.id}">+</span>
               </div>
               <div class="item-price">$${(item.price * item.quantity).toFixed(2)}</div>
               <div class="item-remove" data-id="${item.id}">
                  <i class="fas fa-trash"></i>
               </div>
            `;
            cartItemsContainer.appendChild(cartItem);
         });

         // Add event listeners to quantity buttons and remove buttons
         document.querySelectorAll('.quantity-btn.minus').forEach(button => {
            button.addEventListener('click', function() {
               const productId = this.getAttribute('data-id');
               const input = this.nextElementSibling;
               let quantity = parseInt(input.value);
               
               if (quantity > 1) {
                  quantity--;
                  input.value = quantity;
                  cart.updateQuantity(productId, quantity);
                  renderCartItems();
               }
            });
         });

         document.querySelectorAll('.quantity-btn.plus').forEach(button => {
            button.addEventListener('click', function() {
               const productId = this.getAttribute('data-id');
               const input = this.previousElementSibling;
               let quantity = parseInt(input.value);
               
               quantity++;
               input.value = quantity;
               cart.updateQuantity(productId, quantity);
               renderCartItems();
            });
         });

         document.querySelectorAll('.quantity-input').forEach(input => {
            input.addEventListener('change', function() {
               const productId = this.getAttribute('data-id');
               let quantity = parseInt(this.value);
               
               if (quantity < 1) {
                  quantity = 1;
                  this.value = 1;
               }
               
               cart.updateQuantity(productId, quantity);
               renderCartItems();
            });
         });

         document.querySelectorAll('.item-remove').forEach(button => {
            button.addEventListener('click', function() {
               const productId = this.getAttribute('data-id');
               cart.removeItem(productId);
               renderCartItems();
               
               // Show success message
               const successMessage = document.getElementById('success-message');
               successMessage.textContent = 'Item removed from cart!';
               successMessage.style.display = 'block';
               
               setTimeout(() => {
                  successMessage.style.display = 'none';
               }, 3000);
            });
         });
      }

      // Initialize cart on page load
      document.addEventListener('DOMContentLoaded', function() {
         cart.updateCartCount();
         renderCartItems();
      });
   </script>
</body>
</html>
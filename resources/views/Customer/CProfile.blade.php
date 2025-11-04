<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Kape Na! - My Profile</title>
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

      .error-message {
         background-color: rgba(231, 76, 60, 0.2);
         color: #e74c3c;
         padding: 1rem 2rem;
         margin: 1rem auto;
         max-width: 1200px;
         border-radius: 0.5rem;
         font-size: 1.6rem;
         text-align: center;
         border: 1px solid #e74c3c;
      }

      /* Profile Section Styles */
      .profile-section {
         min-height: 70vh;
         padding: 2rem;
      }

      .profile-container {
         display: grid;
         grid-template-columns: 1fr;
         gap: 3rem;
         margin-top: 2rem;
      }

      /* Personal Information Card */
      .info-card {
         background-color: var(--black);
         border: var(--border);
         border-radius: 1rem;
         padding: 3rem;
      }

      .info-card h2 {
         font-size: 2.8rem;
         color: var(--main-color);
         margin-bottom: 2rem;
         text-align: center;
         border-bottom: 2px solid var(--main-color);
         padding-bottom: 1rem;
      }

      .info-grid {
         display: grid;
         grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
         gap: 2rem;
         margin-top: 2rem;
      }

      .info-item {
         padding: 1.5rem;
         background-color: rgba(255, 255, 255, 0.05);
         border-radius: 0.5rem;
         transition: all 0.3s;
      }

      .info-item:hover {
         background-color: rgba(211, 173, 127, 0.1);
         transform: translateY(-3px);
      }

      .info-item label {
         display: block;
         font-size: 1.4rem;
         color: var(--light-color);
         margin-bottom: 0.5rem;
         text-transform: uppercase;
      }

      .info-item .value {
         font-size: 1.8rem;
         color: var(--white);
         word-wrap: break-word;
      }

      .info-item i {
         color: var(--main-color);
         margin-right: 1rem;
         font-size: 2rem;
      }

      /* Order History Section */
      .orders-section {
         background-color: var(--black);
         border: var(--border);
         border-radius: 1rem;
         padding: 3rem;
         margin-top: 3rem;
      }

      .orders-section h2 {
         font-size: 2.8rem;
         color: var(--main-color);
         margin-bottom: 2rem;
         text-align: center;
         border-bottom: 2px solid var(--main-color);
         padding-bottom: 1rem;
      }

      .order-card {
         background-color: rgba(255, 255, 255, 0.05);
         border-left: 4px solid var(--main-color);
         padding: 2rem;
         margin-bottom: 2rem;
         border-radius: 0.5rem;
         transition: all 0.3s;
      }

      .order-card:hover {
         background-color: rgba(211, 173, 127, 0.1);
         transform: translateX(5px);
      }

      .order-header {
         display: flex;
         justify-content: space-between;
         align-items: center;
         margin-bottom: 1.5rem;
         flex-wrap: wrap;
         gap: 1rem;
      }

      .order-number {
         font-size: 2rem;
         color: var(--white);
         font-weight: bold;
      }

      .order-status {
         padding: 0.5rem 1.5rem;
         border-radius: 2rem;
         font-size: 1.4rem;
         text-transform: uppercase;
      }

      .order-status.paid {
         background-color: rgba(46, 204, 113, 0.2);
         color: #2ecc71;
         border: 1px solid #2ecc71;
      }

      .order-status.pending {
         background-color: rgba(241, 196, 15, 0.2);
         color: #f1c40f;
         border: 1px solid #f1c40f;
      }

      .order-details {
         display: grid;
         grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
         gap: 1.5rem;
         margin-top: 1rem;
      }

      .order-detail-item {
         font-size: 1.6rem;
         color: var(--light-color);
      }

      .order-detail-item strong {
         color: var(--white);
         display: block;
         margin-bottom: 0.5rem;
      }

      .order-detail-item .highlight {
         color: var(--main-color);
         font-size: 2rem;
         font-weight: bold;
      }

      .empty-orders {
         text-align: center;
         padding: 4rem 2rem;
      }

      .empty-orders-icon {
         font-size: 8rem;
         color: var(--light-color);
         margin-bottom: 2rem;
      }

      .empty-orders h3 {
         font-size: 2.5rem;
         color: var(--white);
         margin-bottom: 1.5rem;
      }

      .empty-orders p {
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

         .info-grid {
            grid-template-columns: 1fr;
         }

         .order-header {
            flex-direction: column;
            align-items: flex-start;
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
   <!-- Header section -->
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

   <!-- Error Messages -->
   @if(session('error'))
      <div class="error-message">
         {{ session('error') }}
      </div>
   @endif

   <!-- Profile Section -->
   <section class="profile-section">
      <h1 class="title">My Profile</h1>
      
      <div class="profile-container">
         <!-- Personal Information Card -->
         <div class="info-card">
            <h2><i class="fas fa-user-circle"></i> Personal Information</h2>
            
            <div class="info-grid">
               <div class="info-item">
                  <label><i class="fas fa-user"></i> Full Name</label>
                  <div class="value">{{ $user->name }}</div>
               </div>
               
               <div class="info-item">
                  <label><i class="fas fa-envelope"></i> Email Address</label>
                  <div class="value">{{ $user->email }}</div>
               </div>
               
               <div class="info-item">
                  <label><i class="fas fa-phone"></i> Phone Number</label>
                  <div class="value">{{ $user->phone }}</div>
               </div>
               
               <div class="info-item">
                  <label><i class="fas fa-map-marker-alt"></i> Address</label>
                  <div class="value">{{ $user->address }}</div>
               </div>
               
               <div class="info-item">
                  <label><i class="fas fa-calendar-alt"></i> Member Since</label>
                  <div class="value">{{ $user->created_at->format('F j, Y') }}</div>
               </div>
               
               <div class="info-item">
                  <label><i class="fas fa-check-circle"></i> Email Verified</label>
                  <div class="value">
                     @if($user->email_verified_at)
                        <span style="color: #2ecc71;">✓ Verified</span>
                     @else
                        <span style="color: #e74c3c;">✗ Not Verified</span>
                     @endif
                  </div>
               </div>
            </div>
         </div>
      </div>

      <!-- Order History Section -->
      <div class="orders-section">
         <h2><i class="fas fa-shopping-bag"></i> Order History</h2>
         
         @if($orders->count() > 0)
            @foreach($orders as $order)
               <div class="order-card">
                  <div class="order-header">
                     <span class="order-number">
                        <i class="fas fa-receipt"></i> Order #{{ $order->order_number }}
                     </span>
                     <span class="order-status {{ strtolower($order->payment_status) }}">
                        {{ $order->payment_status }}
                     </span>
                  </div>
                  
                  <div class="order-details">
                     <div class="order-detail-item">
                        <strong><i class="fas fa-box"></i> Order Name:</strong>
                        {{ $order->order_name }}
                     </div>
                     
                     <div class="order-detail-item">
                        <strong><i class="fas fa-credit-card"></i> Payment Method:</strong>
                        {{ ucfirst($order->order_payment_method) }}
                     </div>
                     
                     <div class="order-detail-item">
                        <strong><i class="fas fa-calendar"></i> Order Date:</strong>
                        {{ $order->order_date->format('F j, Y g:i A') }}
                     </div>
                     
                     <div class="order-detail-item">
                        <strong><i class="fas fa-dollar-sign"></i> Total Amount:</strong>
                        <span class="highlight">${{ number_format($order->order_total_price, 2) }}</span>
                     </div>
                  </div>
               </div>
            @endforeach
         @else
            <div class="empty-orders">
               <i class="fas fa-shopping-bag empty-orders-icon"></i>
               <h3>No Orders Yet</h3>
               <p>You haven't placed any orders yet. Start shopping now!</p>
               <a href="{{ route('customer.cmenu') }}" class="btn">Browse Menu</a>
            </div>
         @endif
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
</body>
</html>


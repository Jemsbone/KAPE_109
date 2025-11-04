<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Kape Na! - Settings</title>
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

      /* Settings Section Styles */
      .settings-section {
         min-height: 70vh;
         padding: 2rem;
      }

      .settings-container {
         max-width: 800px;
         margin: 2rem auto;
      }

      .settings-card {
         background-color: var(--black);
         border: var(--border);
         border-radius: 1rem;
         padding: 3rem;
         margin-bottom: 3rem;
      }

      .settings-card h2 {
         font-size: 2.8rem;
         color: var(--main-color);
         margin-bottom: 2rem;
         text-align: center;
         border-bottom: 2px solid var(--main-color);
         padding-bottom: 1rem;
      }

      .danger-zone {
         background-color: rgba(231, 76, 60, 0.1);
         border: 2px solid var(--red);
         border-radius: 1rem;
         padding: 3rem;
      }

      .danger-zone h2 {
         color: var(--red);
         border-bottom-color: var(--red);
      }

      .warning-box {
         background-color: rgba(241, 196, 15, 0.1);
         border-left: 4px solid #f1c40f;
         padding: 2rem;
         margin: 2rem 0;
         border-radius: 0.5rem;
      }

      .warning-box i {
         color: #f1c40f;
         font-size: 2.5rem;
         margin-right: 1rem;
         vertical-align: middle;
      }

      .warning-box p {
         font-size: 1.6rem;
         color: var(--white);
         line-height: 1.8;
         display: inline;
      }

      .warning-list {
         list-style: none;
         margin: 2rem 0;
         padding: 0;
      }

      .warning-list li {
         font-size: 1.6rem;
         color: var(--light-color);
         padding: 1rem 0;
         padding-left: 3rem;
         position: relative;
      }

      .warning-list li::before {
         content: "⚠";
         position: absolute;
         left: 0;
         color: #f1c40f;
         font-size: 2rem;
      }

      .delete-form {
         margin-top: 3rem;
      }

      .form-group {
         margin-bottom: 2rem;
      }

      .form-group label {
         display: block;
         font-size: 1.6rem;
         color: var(--white);
         margin-bottom: 1rem;
      }

      .form-group input {
         width: 100%;
         padding: 1.5rem;
         font-size: 1.6rem;
         background-color: rgba(255, 255, 255, 0.1);
         border: 1px solid var(--light-color);
         border-radius: 0.5rem;
         color: var(--white);
         transition: all 0.3s;
      }

      .form-group input:focus {
         border-color: var(--red);
         background-color: rgba(255, 255, 255, 0.15);
      }

      .form-group input::placeholder {
         color: var(--light-color);
      }

      .delete-btn {
         width: 100%;
         padding: 1.5rem;
         font-size: 1.8rem;
         background-color: var(--red);
         color: var(--white);
         border-radius: 0.5rem;
         cursor: pointer;
         transition: all 0.3s;
         text-align: center;
         display: block;
         border: none;
      }

      .delete-btn:hover {
         background-color: #c0392b;
         letter-spacing: .1rem;
      }

      .cancel-btn {
         display: block;
         text-align: center;
         margin-top: 1.5rem;
         font-size: 1.6rem;
         color: var(--main-color);
         transition: all 0.3s;
      }

      .cancel-btn:hover {
         color: var(--white);
         text-decoration: underline;
      }

      /* Modal Styles */
      .modal {
         display: none;
         position: fixed;
         z-index: 9999;
         left: 0;
         top: 0;
         width: 100%;
         height: 100%;
         background-color: rgba(0, 0, 0, 0.8);
      }

      .modal-content {
         background-color: var(--black);
         margin: 10% auto;
         padding: 3rem;
         border: var(--border);
         border-radius: 1rem;
         width: 90%;
         max-width: 500px;
         box-shadow: 0 4px 6px rgba(0, 0, 0, 0.3);
      }

      .modal-header {
         text-align: center;
         margin-bottom: 2rem;
      }

      .modal-header i {
         font-size: 6rem;
         color: var(--red);
         margin-bottom: 1rem;
      }

      .modal-header h3 {
         font-size: 2.5rem;
         color: var(--white);
      }

      .modal-body {
         font-size: 1.6rem;
         color: var(--light-color);
         text-align: center;
         margin-bottom: 2rem;
         line-height: 1.8;
      }

      .modal-buttons {
         display: flex;
         gap: 1rem;
      }

      .modal-btn {
         flex: 1;
         padding: 1.5rem;
         font-size: 1.8rem;
         border-radius: 0.5rem;
         cursor: pointer;
         transition: all 0.3s;
         text-align: center;
         border: none;
      }

      .modal-btn-cancel {
         background-color: var(--light-color);
         color: var(--white);
      }

      .modal-btn-cancel:hover {
         background-color: #555;
      }

      .modal-btn-delete {
         background-color: var(--red);
         color: var(--white);
      }

      .modal-btn-delete:hover {
         background-color: #c0392b;
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

         .modal-buttons {
            flex-direction: column;
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

   <!-- Settings Section -->
   <section class="settings-section">
      <h1 class="title">Account Settings</h1>
      
      <div class="settings-container">
         <!-- Danger Zone - Delete Account -->
         <div class="danger-zone">
            <h2><i class="fas fa-exclamation-triangle"></i> Danger Zone</h2>
            
            <div class="warning-box">
               <i class="fas fa-info-circle"></i>
               <p><strong>Warning:</strong> Deleting your account is permanent and cannot be undone.</p>
            </div>

            <ul class="warning-list">
               <li>All your personal information will be permanently deleted</li>
               <li>Your order history will be preserved but disassociated from your account</li>
               <li>You will be immediately logged out</li>
               <li>You will need to create a new account to use our services again</li>
            </ul>

            <form id="deleteAccountForm" method="POST" action="{{ route('customer.delete-account') }}">
               @csrf
               @method('DELETE')
               
               <div class="form-group">
                  <label for="password">
                     <i class="fas fa-lock"></i> Confirm your password to delete your account
                  </label>
                  <input 
                     type="password" 
                     id="password" 
                     name="password" 
                     placeholder="Enter your current password"
                     required
                  >
               </div>

               <button type="button" class="delete-btn" onclick="showConfirmationModal()">
                  <i class="fas fa-trash-alt"></i> Delete My Account
               </button>
            </form>

            <a href="{{ route('customer.profile') }}" class="cancel-btn">
               <i class="fas fa-arrow-left"></i> Cancel and Go Back to Profile
            </a>
         </div>
      </div>
   </section>

   <!-- Confirmation Modal -->
   <div id="confirmationModal" class="modal">
      <div class="modal-content">
         <div class="modal-header">
            <i class="fas fa-exclamation-triangle"></i>
            <h3>Are You Absolutely Sure?</h3>
         </div>
         <div class="modal-body">
            <p>This action cannot be undone. This will permanently delete your account and remove all your personal data from our servers.</p>
            <p style="margin-top: 1rem;"><strong>Please type your password to confirm.</strong></p>
         </div>
         <div class="modal-buttons">
            <button class="modal-btn modal-btn-cancel" onclick="closeConfirmationModal()">
               <i class="fas fa-times"></i> Cancel
            </button>
            <button class="modal-btn modal-btn-delete" onclick="confirmDelete()">
               <i class="fas fa-check"></i> Yes, Delete My Account
            </button>
         </div>
      </div>
   </div>

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
      // Modal functions
      function showConfirmationModal() {
         const password = document.getElementById('password').value;
         
         if (!password) {
            alert('Please enter your password first.');
            return;
         }
         
         document.getElementById('confirmationModal').style.display = 'block';
      }

      function closeConfirmationModal() {
         document.getElementById('confirmationModal').style.display = 'none';
      }

      function confirmDelete() {
         document.getElementById('deleteAccountForm').submit();
      }

      // Close modal when clicking outside of it
      window.onclick = function(event) {
         const modal = document.getElementById('confirmationModal');
         if (event.target == modal) {
            closeConfirmationModal();
         }
      }

      // Auto-hide success/error messages after 5 seconds
      setTimeout(function() {
         const successMsg = document.querySelector('.success-message');
         const errorMsg = document.querySelector('.error-message');
         
         if (successMsg) {
            successMsg.style.display = 'none';
         }
         if (errorMsg) {
            errorMsg.style.display = 'none';
         }
      }, 5000);
   </script>
</body>
</html>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Confirmation - Kape Na!</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Anton&family=Poppins:wght@300;400;600;700&display=swap');
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Poppins', Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            background: linear-gradient(135deg, #856731 0%, #d3ad7f 100%);
            padding: 20px;
        }
        
        .email-wrapper {
            max-width: 650px;
            margin: 0 auto;
            background: #ffffff;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.3);
        }
        
        .header {
            background: linear-gradient(135deg, #222 0%, #333 100%);
            color: white;
            padding: 40px 30px;
            text-align: center;
            position: relative;
            overflow: hidden;
        }
        
        .header::before {
            content: '☕';
            position: absolute;
            font-size: 150px;
            opacity: 0.1;
            top: -30px;
            right: -20px;
            transform: rotate(-15deg);
        }
        
        .header h1 {
            font-family: 'Anton', sans-serif;
            font-size: 42px;
            margin-bottom: 10px;
            color: #d3ad7f;
            text-transform: uppercase;
            letter-spacing: 2px;
            position: relative;
            z-index: 1;
        }
        
        .header .coffee-icon {
            font-size: 50px;
            margin-bottom: 10px;
            display: inline-block;
            animation: steam 2s ease-in-out infinite;
        }
        
        @keyframes steam {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-5px); }
        }
        
        .header h2 {
            font-size: 22px;
            font-weight: 300;
            color: #fff;
            margin-top: 10px;
        }
        
        .success-banner {
            background: linear-gradient(135deg, #27ae60 0%, #2ecc71 100%);
            color: white;
            padding: 20px;
            text-align: center;
            font-size: 18px;
            font-weight: 600;
        }
        
        .success-banner::before {
            content: '✓';
            display: inline-block;
            width: 30px;
            height: 30px;
            background: white;
            color: #27ae60;
            border-radius: 50%;
            margin-right: 10px;
            line-height: 30px;
            font-weight: bold;
        }
        
        .content {
            padding: 40px 30px;
        }
        
        .greeting {
            font-size: 20px;
            margin-bottom: 15px;
            color: #222;
            font-weight: 600;
        }
        
        .intro-text {
            color: #555;
            margin-bottom: 30px;
            font-size: 15px;
        }
        
        .order-info-card {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            border-left: 5px solid #d3ad7f;
            padding: 25px;
            margin-bottom: 30px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }
        
        .order-info-card h3 {
            color: #d3ad7f;
            margin-bottom: 20px;
            font-size: 20px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        
        .info-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 15px;
        }
        
        .info-item {
            padding: 10px 0;
        }
        
        .info-label {
            font-size: 12px;
            color: #777;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 5px;
            font-weight: 600;
        }
        
        .info-value {
            font-size: 15px;
            color: #222;
            font-weight: 600;
        }
        
        .status-paid {
            display: inline-block;
            background: #27ae60;
            color: white;
            padding: 5px 15px;
            border-radius: 20px;
            font-size: 13px;
            font-weight: 600;
            text-transform: uppercase;
        }
        
        .status-pending {
            display: inline-block;
            background: #f39c12;
            color: white;
            padding: 5px 15px;
            border-radius: 20px;
            font-size: 13px;
            font-weight: 600;
            text-transform: uppercase;
        }
        
        .order-details {
            background: white;
            border: 2px solid #e9ecef;
            border-radius: 10px;
            overflow: hidden;
            margin-bottom: 30px;
        }
        
        .order-details h3 {
            background: #222;
            color: white;
            padding: 15px 20px;
            margin: 0;
            font-size: 18px;
            font-weight: 600;
        }
        
        .order-items {
            padding: 0;
        }
        
        .order-item {
            display: grid;
            grid-template-columns: 2fr 1fr 1fr 1fr;
            gap: 15px;
            padding: 20px;
            border-bottom: 1px solid #e9ecef;
            align-items: center;
        }
        
        .order-item:last-child {
            border-bottom: none;
        }
        
        .order-item:hover {
            background: #f8f9fa;
        }
        
        .item-name {
            font-weight: 600;
            color: #222;
            font-size: 15px;
        }
        
        .item-quantity {
            color: #555;
            text-align: center;
        }
        
        .item-price {
            color: #d3ad7f;
            font-weight: 600;
            text-align: center;
        }
        
        .item-subtotal {
            color: #222;
            font-weight: 700;
            text-align: right;
            font-size: 16px;
        }
        
        .order-summary {
            background: linear-gradient(135deg, #222 0%, #333 100%);
            color: white;
            padding: 25px;
            border-radius: 10px;
            margin-bottom: 30px;
        }
        
        .summary-row {
            display: flex;
            justify-content: space-between;
            padding: 10px 0;
            font-size: 15px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }
        
        .summary-row:last-child {
            border-bottom: none;
        }
        
        .summary-row.total {
            border-top: 2px solid #d3ad7f;
            margin-top: 10px;
            padding-top: 20px;
            font-size: 22px;
            font-weight: 700;
        }
        
        .summary-label {
            color: #d3ad7f;
        }
        
        .summary-value {
            font-weight: 600;
        }
        
        .total .summary-value {
            color: #d3ad7f;
            font-size: 26px;
        }
        
        .next-steps {
            background: #fff3cd;
            border-left: 5px solid #ffc107;
            padding: 20px;
            margin-bottom: 30px;
            border-radius: 5px;
        }
        
        .next-steps h4 {
            color: #856404;
            margin-bottom: 15px;
            font-size: 16px;
            font-weight: 700;
        }
        
        .next-steps ul {
            margin-left: 20px;
            color: #856404;
        }
        
        .next-steps li {
            margin-bottom: 8px;
            font-size: 14px;
        }
        
        .footer {
            background: #f8f9fa;
            padding: 30px;
            text-align: center;
            color: #666;
        }
        
        .footer h3 {
            color: #222;
            margin-bottom: 20px;
            font-size: 20px;
        }
        
        .footer p {
            margin-bottom: 10px;
            font-size: 14px;
        }
        
        .contact-info {
            background: white;
            padding: 20px;
            border-radius: 10px;
            margin: 20px 0;
            display: inline-block;
        }
        
        .contact-item {
            margin: 10px 0;
            font-size: 14px;
            color: #555;
        }
        
        .contact-item strong {
            color: #d3ad7f;
            margin-right: 5px;
        }
        
        .social-links {
            margin-top: 20px;
        }
        
        .social-links a {
            display: inline-block;
            margin: 0 10px;
            color: #d3ad7f;
            text-decoration: none;
            font-size: 14px;
            font-weight: 600;
        }
        
        .social-links a:hover {
            color: #222;
        }
        
        .copyright {
            margin-top: 20px;
            font-size: 12px;
            color: #999;
        }
        
        @media only screen and (max-width: 600px) {
            .email-wrapper {
                border-radius: 0;
            }
            
            .header h1 {
                font-size: 32px;
            }
            
            .content {
                padding: 20px 15px;
            }
            
            .info-grid {
                grid-template-columns: 1fr;
            }
            
            .order-item {
                grid-template-columns: 1fr;
                gap: 10px;
                text-align: left;
            }
            
            .item-quantity,
            .item-price,
            .item-subtotal {
                text-align: left;
            }
        }
    </style>
</head>
<body>
    <div class="email-wrapper">
        <!-- Header -->
        <div class="header">
            <div class="coffee-icon">☕</div>
            <h1>Kape Na!</h1>
            <h2>Your Premium Coffee Experience</h2>
        </div>
        
        <!-- Success Banner -->
        <div class="success-banner">
            Order Confirmed Successfully!
        </div>
        
        <!-- Main Content -->
        <div class="content">
            <!-- Greeting -->
            <div class="greeting">Hello {{ $user->name }}! 👋</div>
            <p class="intro-text">
                Thank you for your order! We're excited to prepare your delicious items. 
                Your order has been received and is being processed.
            </p>
            
            <!-- Order Information Card -->
            <div class="order-info-card">
                <h3>📋 Order Information</h3>
                <div class="info-grid">
                    <div class="info-item">
                        <div class="info-label">Order Number</div>
                        <div class="info-value">#{{ $order->order_number }}</div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">Order Date</div>
                        <div class="info-value">{{ $order->order_date->format('M j, Y') }}</div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">Customer</div>
                        <div class="info-value">{{ $user->name }}</div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">Email</div>
                        <div class="info-value">{{ $user->email }}</div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">Payment Method</div>
                        <div class="info-value">{{ ucfirst(str_replace('_', ' ', $order->order_payment_method)) }}</div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">Payment Status</div>
                        <div class="info-value">
                            <span class="status-{{ $order->payment_status }}">{{ ucfirst($order->payment_status) }}</span>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Order Details -->
            <div class="order-details">
                <h3>🛒 Order Details</h3>
                <div class="order-items">
                    @foreach($cartData as $item)
                    <div class="order-item">
                        <div class="item-name">{{ $item['name'] }}</div>
                        <div class="item-quantity">Qty: {{ $item['quantity'] }}</div>
                        <div class="item-price">${{ number_format($item['price'], 2) }}</div>
                        <div class="item-subtotal">${{ number_format($item['price'] * $item['quantity'], 2) }}</div>
                    </div>
                    @endforeach
                </div>
            </div>
            
            <!-- Order Summary -->
            <div class="order-summary">
                <div class="summary-row">
                    <span class="summary-label">Subtotal</span>
                    <span class="summary-value">${{ number_format($orderSummary['subtotal'], 2) }}</span>
                </div>
                <div class="summary-row">
                    <span class="summary-label">Service Fee (5%)</span>
                    <span class="summary-value">${{ number_format($orderSummary['serviceFee'], 2) }}</span>
                </div>
                <div class="summary-row">
                    <span class="summary-label">Tax (10%)</span>
                    <span class="summary-value">${{ number_format($orderSummary['tax'], 2) }}</span>
                </div>
                <div class="summary-row total">
                    <span class="summary-label">Total Amount</span>
                    <span class="summary-value">${{ number_format($orderSummary['total'], 2) }}</span>
                </div>
            </div>
            
            <!-- Next Steps -->
            <div class="next-steps">
                <h4>📌 What's Next?</h4>
                <ul>
                    <li>Your order is being prepared by our team</li>
                    <li>You'll receive a notification when your order is ready for pickup</li>
                    <li>Please bring this order confirmation email when picking up</li>
                    <li>Estimated preparation time: 15-20 minutes</li>
                </ul>
            </div>
        </div>
        
        <!-- Footer -->
        <div class="footer">
            <h3>Thank You for Choosing Kape Na! ❤️</h3>
            <p>We appreciate your business and look forward to serving you!</p>
            
            <div class="contact-info">
                <div class="contact-item">
                    <strong>📧 Email:</strong> berderajembo99@gmail.com
                </div>
                <div class="contact-item">
                    <strong>📞 Phone:</strong> +639914677225 / +639512592678
                </div>
                <div class="contact-item">
                    <strong>📍 Location:</strong> Caraga State University - Main Campus
                </div>
                <div class="contact-item">
                    <strong>🕐 Hours:</strong> Monday - Saturday: 2:00 PM - 2:00 AM
                </div>
            </div>
            
            <div class="social-links">
                <a href="https://www.facebook.com/jemhail">Facebook</a> |
                <a href="https://www.instagram.com/jembo.magbanua/">Instagram</a> |
                <a href="http://linkedin.com/in/jembo-magbanua-b49b6b2b2/">LinkedIn</a>
            </div>
            
            <div class="copyright">
                &copy; {{ date('Y') }} Kape Na! All rights reserved.<br>
                This email was sent to {{ $user->email }} because you placed an order with us.
            </div>
        </div>
    </div>
</body>
</html>
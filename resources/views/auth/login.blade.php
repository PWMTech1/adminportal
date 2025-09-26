<?php
use Illuminate\Support\Facades\DB;

$conn = DB::connection();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <title>Pinnacle Wound Care - Clinician Portal</title>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="../css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/plugins.css" rel="stylesheet" type="text/css" />
    <link href="../css/form-2.css" rel="stylesheet" type="text/css" />
    <style>
        * {
            font-family: 'Manrope', sans-serif !important;
        }
        
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            margin: 0;
            padding: 0;
        }
        
        .login-container {
            min-height: 100vh;
            display: flex;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        
        .login-left {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #fff;
            padding: 3rem 2rem;
            position: relative;
        }
        
        .login-left::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grain" width="100" height="100" patternUnits="userSpaceOnUse"><circle cx="25" cy="25" r="1" fill="%23f0f0f0"/><circle cx="75" cy="75" r="1" fill="%23f0f0f0"/><circle cx="50" cy="10" r="0.5" fill="%23e0e0e0"/><circle cx="10" cy="60" r="0.5" fill="%23e0e0e0"/><circle cx="90" cy="40" r="0.5" fill="%23e0e0e0"/></pattern></defs><rect width="100" height="100" fill="url(%23grain)"/></svg>') repeat;
            opacity: 0.3;
            pointer-events: none;
        }
        
        .login-right {
            flex: 1;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 3rem 2rem;
            color: white;
            position: relative;
            overflow: hidden;
        }
        
        .login-right::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
            animation: float 6s ease-in-out infinite;
        }
        
        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-20px) rotate(180deg); }
        }
        
        .login-form-container {
            width: 100%;
            max-width: 400px;
            position: relative;
            z-index: 1;
        }
        
        .login-title {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
            color: #1a1a1a;
            line-height: 1.2;
        }
        
        .login-subtitle {
            color: #666;
            margin-bottom: 2.5rem;
            font-size: 1.1rem;
        }
        
        .form-group {
            margin-bottom: 1.5rem;
        }
        
        .form-label {
            font-weight: 500;
            color: #333;
            margin-bottom: 0.5rem;
            display: block;
        }
        
        .form-control {
            border: 2px solid #e1e5e9;
            border-radius: 12px;
            padding: 14px 18px;
            font-size: 16px;
            transition: all 0.3s ease;
            background: #fff;
        }
        
        .form-control:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.15);
            outline: none;
        }
        
        .btn-login {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            border-radius: 12px;
            padding: 14px 24px;
            font-weight: 600;
            color: white;
            width: 100%;
            transition: all 0.3s ease;
            font-size: 16px;
        }
        
        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(102, 126, 234, 0.4);
        }
        
        .btn-login:disabled {
            opacity: 0.7;
            cursor: not-allowed;
            transform: none;
        }
        
        .btn-login:disabled:hover {
            transform: none;
            box-shadow: none;
        }
        
        .spinner {
            animation: spin 1s linear infinite;
            margin-right: 8px;
        }
        
        @keyframes spin {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }
        
        .btn-loading {
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .login-logo {
            width: 200px;
            height: auto;
            margin-bottom: 1.5rem;
            display: block;
            margin-left: auto;
            margin-right: auto;
        }
        
        .social-login {
            display: flex;
            gap: 1rem;
            margin-bottom: 2rem;
        }
        
        .btn-social {
            flex: 1;
            padding: 14px;
            border: 2px solid #e1e5e9;
            border-radius: 12px;
            background: white;
            color: #333;
            text-decoration: none;
            text-align: center;
            transition: all 0.3s ease;
            font-weight: 500;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }
        
        .btn-social:hover {
            background: #f8f9fa;
            color: #333;
            text-decoration: none;
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }
        
        .slider-container {
            position: relative;
            width: 100%;
            max-width: 500px;
            margin: 0 auto;
        }
        
        .slider {
            position: relative;
            overflow: hidden;
            border-radius: 20px;
        }
        
        .slider-track {
            display: flex;
            transition: transform 0.8s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        .slide {
            min-width: 100%;
            text-align: center;
            padding: 2rem;
        }
        
        .slide h4 {
            font-size: 1.8rem;
            font-weight: 600;
            margin-bottom: 1rem;
            color: white;
        }
        
        .slide p {
            font-size: 1.1rem;
            opacity: 0.9;
            line-height: 1.6;
            margin-bottom: 1.5rem;
        }
        
        .slide-img {
            width: 120px;
            height: 120px;
            background: rgba(255, 255, 255, 0.15);
            border-radius: 50%;
            margin: 0 auto 1.5rem;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 3rem;
            backdrop-filter: blur(10px);
            border: 2px solid rgba(255, 255, 255, 0.2);
        }
        
        .slider-dots {
            display: flex;
            justify-content: center;
            gap: 0.75rem;
            margin-top: 2.5rem;
        }
        
        .dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.4);
            cursor: pointer;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
        }
        
        .dot::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 0;
            height: 0;
            background: rgba(255, 255, 255, 0.8);
            border-radius: 50%;
            transform: translate(-50%, -50%);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        .dot.active {
            background: rgba(255, 255, 255, 0.9);
            transform: scale(1.3);
            box-shadow: 0 0 0 2px rgba(255, 255, 255, 0.3);
        }
        
        .dot.active::before {
            width: 100%;
            height: 100%;
        }
        
        .dot:hover {
            background: rgba(255, 255, 255, 0.6);
            transform: scale(1.1);
        }
        
        .btn-outline-light {
            border: 2px solid rgba(255, 255, 255, 0.3);
            color: white;
            padding: 10px 24px;
            border-radius: 25px;
            text-decoration: none;
            transition: all 0.3s ease;
            font-weight: 500;
        }
        
        .btn-outline-light:hover {
            background: rgba(255, 255, 255, 0.1);
            color: white;
            text-decoration: none;
            transform: translateY(-2px);
        }
        
        .divider {
            text-align: center;
            margin: 2rem 0;
            position: relative;
        }
        
        .divider::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 0;
            right: 0;
            height: 1px;
            background: #ddd;
        }
        
        .divider span {
            background: white;
            padding: 0 1rem;
            color: #666;
            font-weight: 500;
        }
        
        .form-check {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        
        .form-check-input {
            margin: 0;
        }
        
        .form-check-label {
            margin: 0;
            font-weight: 500;
            color: #333;
        }
        
        @media (max-width: 768px) {
            .login-container {
                flex-direction: column;
            }
            
            .login-right {
                display: none;
            }
            
            .login-left {
                padding: 2rem 1rem;
            }
            
            .login-title {
                font-size: 2rem;
            }
        }
    </style>
</head>
<body>
    <div class="login-container">
        <!-- Left Side - Login Form -->
        <div class="login-left">
            <div class="login-form-container">
                <img src="https://www.pinnaclewoundmanagement.com/images/pinnacle-logo-color.png" alt="Pinnacle Wound Management" class="login-logo">
                <h1 class="login-title">Login</h1>
                
                <form method="POST" action="\login">
                    @csrf
                    <div class="form-group">
                        <label for="email" class="form-label">Email Address</label>
                        <input type="email" name="email" id="email" class="form-control" placeholder="Enter your email" value="{{old('email')}}" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" name="password" id="password" class="form-control" placeholder="Enter your password" required>
                    </div>
                    
                    <button type="submit" class="btn btn-login" id="loginBtn">
                        <span class="btn-text">Sign In</span>
                        <span class="btn-loading" style="display: none;">
                            <svg class="spinner" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M21 12a9 9 0 11-6.219-8.56"/>
                            </svg>
                            Processing...
                        </span>
                    </button>
                    
                    @if($errors->any())
                    <div class="alert alert-danger mt-3">{{$errors->first()}}</div>
                    @endif
                </form>
               
            </div>
        </div>
        
        <!-- Right Side - Feature Content with Slider -->
        <div class="login-right">
            <div class="slider-container">
                <div class="slider">
                    <div class="slider-track" id="sliderTrack">
                        <div class="slide">
                            <div class="slide-img">🏥</div>
                            <h4>Clinician Efficiency Tracking</h4>
                            <p>Monitor and analyze clinician performance metrics, patient visit statistics, and treatment outcomes to optimize wound care delivery and improve patient outcomes.</p>
                        </div>
                        
                        <div class="slide">
                            <div class="slide-img">📝</div>
                            <h4>Digital Medical Notes</h4>
                            <p>Streamline documentation with comprehensive wound assessment tools, treatment plans, and progress tracking to ensure accurate patient care records.</p>
                        </div>
                        
                        <div class="slide">
                            <div class="slide-img">📊</div>
                            <h4>Advanced Analytics</h4>
                            <p>Gain insights with detailed reports on wound healing progress, clinician productivity, and treatment effectiveness to drive better clinical decisions.</p>
                        </div>
                    </div>
                </div>
                
                <div class="slider-dots">
                    <span class="dot active" onclick="currentSlide(1)"></span>
                    <span class="dot" onclick="currentSlide(2)"></span>
                    <span class="dot" onclick="currentSlide(3)"></span>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Scripts -->
    <script src="assets/js/libs/jquery-3.1.1.min.js"></script>
    <script src="bootstrap/js/popper.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/authentication/form-2.js"></script>
    
    <script>
        let slideIndex = 1;
        let slideInterval;
        
        function showSlide(n) {
            const sliderTrack = document.getElementById('sliderTrack');
            const dots = document.querySelectorAll('.dot');
            
            if (n > 3) { slideIndex = 1; }
            if (n < 1) { slideIndex = 3; }
            
            // Calculate transform position for smooth right-to-left sliding
            const translateX = -(slideIndex - 1) * 100;
            sliderTrack.style.transform = `translateX(${translateX}%)`;
            
            // Remove active class from all dots
            dots.forEach(dot => {
                dot.classList.remove('active');
            });
            
            // Add active class to current dot
            dots[slideIndex - 1].classList.add('active');
        }
        
        function currentSlide(n) {
            clearInterval(slideInterval);
            slideIndex = n;
            showSlide(slideIndex);
            startSlider();
        }
        
        function nextSlide() {
            slideIndex++;
            showSlide(slideIndex);
        }
        
        function startSlider() {
            slideInterval = setInterval(nextSlide, 4000); // Change slide every 4 seconds
        }
        
        // Initialize slider
        document.addEventListener('DOMContentLoaded', function() {
            showSlide(slideIndex);
            startSlider();
            
            // Pause slider on hover
            const slider = document.querySelector('.slider');
            slider.addEventListener('mouseenter', function() {
                clearInterval(slideInterval);
            });
            
            slider.addEventListener('mouseleave', function() {
                startSlider();
            });
            
            // Handle login form submission
            const loginForm = document.querySelector('form[method="POST"]');
            const loginBtn = document.getElementById('loginBtn');
            const btnText = document.querySelector('.btn-text');
            const btnLoading = document.querySelector('.btn-loading');
            
            if (loginForm && loginBtn) {
                loginForm.addEventListener('submit', function() {
                    // Show loading state
                    btnText.style.display = 'none';
                    btnLoading.style.display = 'flex';
                    loginBtn.disabled = true;
                });
            }
        });
    </script>
</body>
</html>
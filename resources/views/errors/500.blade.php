<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>500 - Server Error</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: #f8fafc;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .error-container {
            background: white;
            border-radius: 12px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            padding: 40px;
            text-align: center;
            max-width: 400px;
            width: 100%;
        }

        .loader {
            width: 40px;
            height: 40px;
            border: 4px solid #f3f3f3;
            border-top: 4px solid #ef4444;
            border-radius: 50%;
            animation: spin 1s linear infinite;
            margin: 0 auto 20px;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        .matdash-img {
            width: 120px;
            height: 120px;
            margin: 0 auto 20px;
            display: block;
        }

        .matdash-img img {
            width: 100%;
            height: 100%;
            object-fit: contain;
        }

        .error-icon {
            width: 60px;
            height: 60px;
            margin: 0 auto 20px;
            display: block;
            color: #ef4444;
        }

        .error-icon svg {
            width: 100%;
            height: 100%;
        }

        .error-title {
            font-size: 2.5rem;
            font-weight: 700;
            color: #1f2937;
            margin-bottom: 10px;
        }

        .error-subtitle {
            font-size: 1.125rem;
            font-weight: 500;
            color: #6b7280;
            margin-bottom: 30px;
            line-height: 1.5;
        }

        .btn-primary {
            background: #ef4444;
            color: white;
            padding: 12px 24px;
            border: none;
            border-radius: 8px;
            font-weight: 600;
            text-decoration: none;
            display: inline-block;
            transition: all 0.3s ease;
            font-size: 0.875rem;
        }

        .btn-primary:hover {
            background: #dc2626;
            color: white;
            text-decoration: none;
            transform: translateY(-1px);
        }

        @media (max-width: 768px) {
            .error-container {
                padding: 30px 20px;
                margin: 20px;
            }
            
            .error-title {
                font-size: 2rem;
            }
            
            .error-subtitle {
                font-size: 1rem;
            }
        }
    </style>
</head>
<body>
    <div class="error-container">
        <div class="loader"></div>
        <div class="matdash-img">
            <img src="https://www.pinnaclewoundmanagement.com/images/pinnacle-logo-color.png" alt="Pinnacle Wound Management Logo">
        </div>
        
        <div class="error-icon">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"></path>
                <line x1="12" y1="9" x2="12" y2="13"></line>
                <line x1="12" y1="17" x2="12.01" y2="17"></line>
            </svg>
        </div>
        
        <h1 class="error-title">500</h1>
        <h2 class="error-subtitle">Internal Server Error</h2>
        
        <a href="/" class="btn-primary">Go Back to Home</a>
    </div>
</body>
</html>

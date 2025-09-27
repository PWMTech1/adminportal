<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Pinnacle Wound Management</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #333;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
        }
        .email-container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            border-radius: 12px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }
        .header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 30px 40px;
            text-align: center;
        }
        .header h1 {
            margin: 0;
            font-size: 28px;
            font-weight: 600;
        }
        .header p {
            margin: 10px 0 0 0;
            font-size: 16px;
            opacity: 0.9;
        }
        .content {
            padding: 40px;
        }
        .welcome-section {
            text-align: center;
            margin-bottom: 30px;
        }
        .welcome-section h2 {
            color: #2c3e50;
            font-size: 24px;
            margin: 0 0 15px 0;
            font-weight: 600;
        }
        .welcome-section p {
            color: #7f8c8d;
            font-size: 16px;
            margin: 0;
        }
        .credentials-box {
            background-color: #f8f9fa;
            border: 2px solid #e9ecef;
            border-radius: 8px;
            padding: 25px;
            margin: 25px 0;
        }
        .credentials-box h3 {
            color: #495057;
            font-size: 18px;
            margin: 0 0 20px 0;
            font-weight: 600;
        }
        .credential-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 12px 0;
            border-bottom: 1px solid #dee2e6;
        }
        .credential-item:last-child {
            border-bottom: none;
        }
        .credential-label {
            font-weight: 600;
            color: #495057;
            font-size: 14px;
        }
        .credential-value {
            color: #212529;
            font-size: 14px;
            font-family: 'Courier New', monospace;
            background-color: #ffffff;
            padding: 6px 12px;
            border-radius: 4px;
            border: 1px solid #ced4da;
        }
        .login-section {
            text-align: center;
            margin: 30px 0;
        }
        .login-button {
            display: inline-block;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 15px 30px;
            text-decoration: none;
            border-radius: 8px;
            font-weight: 600;
            font-size: 16px;
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
            transition: all 0.3s ease;
        }
        .login-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(102, 126, 234, 0.4);
        }
        .instructions {
            background-color: #e3f2fd;
            border-left: 4px solid #2196f3;
            padding: 20px;
            margin: 25px 0;
            border-radius: 0 8px 8px 0;
        }
        .instructions h4 {
            color: #1976d2;
            margin: 0 0 10px 0;
            font-size: 16px;
            font-weight: 600;
        }
        .instructions p {
            color: #424242;
            margin: 0;
            font-size: 14px;
        }
        .footer {
            background-color: #f8f9fa;
            padding: 25px 40px;
            text-align: center;
            border-top: 1px solid #e9ecef;
        }
        .footer p {
            color: #6c757d;
            font-size: 14px;
            margin: 0;
        }
        .logo {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 10px;
        }
        @media (max-width: 600px) {
            .email-container {
                margin: 0;
                border-radius: 0;
            }
            .header, .content, .footer {
                padding: 20px;
            }
            .credential-item {
                flex-direction: column;
                align-items: flex-start;
                gap: 8px;
            }
        }
    </style>
</head>
<body>
    <div class="email-container">
        <!-- Header -->
        <div class="header">
            <div class="logo">🏥 Pinnacle Wound Management</div>
            <h1>Welcome to Our Portal</h1>
            <p>Your account has been successfully created</p>
        </div>

        <!-- Main Content -->
        <div class="content">
            <!-- Welcome Section -->
            <div class="welcome-section">
                <h2>Hello, {{$user->firstname}} {{$user->lastname}}!</h2>
                @if($loginUrl)
                    <p>Welcome to <strong>{{$loginUrl}}</strong></p>
                    @if($loginUrl == 'portal.innovativemedsolution.com')
                        <p style="color: #7f8c8d; font-size: 14px; margin-top: 10px;">
                            This portal allows access to retrieve your residents progress notes for services rendered by a Pinnacle Wound Management affiliated provider.
                        </p>
                    @endif
                @else
                    @if($user->roleid == 5 || $user->roleid == 6)
                        <p>Welcome to <strong>portal.innovativemedsolution.com</strong></p>
                        <p style="color: #7f8c8d; font-size: 14px; margin-top: 10px;">
                            This portal allows access to retrieve your residents progress notes for services rendered by a Pinnacle Wound Management affiliated provider.
                        </p>
                    @else
                        <p>Welcome to <strong>admin.innovativemedsolution.com</strong></p>
                    @endif
                @endif
            </div>

            <!-- Credentials Box -->
            <div class="credentials-box">
                <h3>🔐 Your Login Credentials</h3>
                <div class="credential-item">
                    <span class="credential-label">Email Address:</span>
                    <span class="credential-value">{{$user['email']}}</span>
                </div>
                <div class="credential-item">
                    <span class="credential-label">Temporary Password:</span>
                    <span class="credential-value">{{$password}}</span>
                </div>
            </div>

            <!-- Instructions -->
            <div class="instructions">
                <h4>📋 Next Steps</h4>
                <p>Please login with the credentials above and change your password to something secure. For security reasons, we recommend using a strong password with a combination of letters, numbers, and special characters.</p>
            </div>

            <!-- Login Button -->
            <div class="login-section">
                @if($loginUrl)
                    <a href="https://{{$loginUrl}}/login" class="login-button">🚀 Login to Your Account</a>
                @else
                    @if($user->roleid == 5 || $user->roleid == 6)
                        <a href="https://portal.innovativemedsolution.com/login" class="login-button">🚀 Login to Portal</a>
                    @else
                        <a href="https://admin.innovativemedsolution.com/login" class="login-button">🚀 Login to Admin</a>
                    @endif
                @endif
            </div>
        </div>

        <!-- Footer -->
        <div class="footer">
            <p>© {{date('Y')}} Pinnacle Wound Management. All rights reserved.</p>
            <p>If you have any questions, please contact our support team.</p>
        </div>
    </div>
</body>
</html>

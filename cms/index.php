<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>CMS Login — Bonnd</title>
  
  <!-- Favicon & App Icons -->
  <link rel="icon" type="image/png" href="/cms/assets/bonnd-mark.png">
  <link rel="apple-touch-icon" href="/cms/assets/bonnd-mark.png">
  
  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
  
  <!-- PWA Manifest -->
  <!-- <link rel="manifest" href="/cms/manifest.json"> -->

  <style>
    :root {
      --teal: #00B2DA;
      --bg: #F7F5F2;
      --white: #FFFFFF;
      --black: #000000;
      --muted: #666666;
      --border: #E5E7EB;
      --ease: cubic-bezier(0.16, 1, 0.3, 1);
    }

    * { box-sizing: border-box; margin: 0; padding: 0; }
    
    body {
      font-family: 'Inter', sans-serif;
      background-color: var(--bg);
      color: var(--black);
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: clamp(20px, 5vw, 40px);
    }

    /* CARD CONTAINER */
    .login-wrapper {
      width: 100%;
      max-width: 1040px;
      background: var(--white);
      border-radius: 20px;
      box-shadow: 0 20px 40px rgba(0,0,0,0.04);
      display: flex;
      overflow: hidden;
      min-height: 640px;
    }

    /* LEFT SIDE - FORM */
    .login-form-side {
      flex: 1;
      padding: clamp(40px, 8vw, 80px);
      display: flex;
      flex-direction: column;
      justify-content: center;
    }
    
    .login-header {
      margin-bottom: 40px;
      text-align: center; /* Centers the title and subtitle */
    }

    /* BRAND LOGO */
    .brand-logo {
      height: clamp(20px, 2.5vw, 26px); /* Scaled down to be smaller on all screens */
      width: auto;
      display: block;
      margin: 0 auto 32px auto; /* Centers logo horizontally and adds breathing room below */
    }
    
    .login-title {
      font-size: clamp(28px, 3vw, 36px);
      font-weight: 700;
      letter-spacing: -0.03em;
      margin-bottom: 8px;
    }
    
    .login-subtitle {
      font-size: 15px;
      color: var(--muted);
      line-height: 1.6;
    }

    /* FORM ELEMENTS */
    .form-group {
      margin-bottom: 24px;
    }
    
    .form-label {
      display: block;
      font-size: 13.5px;
      font-weight: 600;
      margin-bottom: 8px;
      color: #333;
      text-align: left; /* Keeps labels left-aligned while header is centered */
    }
    
    .input-wrap {
      position: relative;
    }
    
    .form-input {
      width: 100%;
      padding: 15px 16px;
      font-family: 'Inter', sans-serif;
      font-size: 15px;
      color: var(--black);
      border: 1px solid var(--border);
      border-radius: 10px;
      outline: none;
      transition: border-color 0.2s var(--ease), box-shadow 0.2s var(--ease);
      appearance: none;
    }
    
    .form-input::placeholder { color: #aaa; }
    
    .form-input:focus {
      border-color: var(--teal);
      box-shadow: 0 0 0 4px rgba(0, 178, 218, 0.12);
    }

    /* EYE ICON TOGGLE */
    .toggle-password {
      position: absolute;
      right: 14px;
      top: 50%;
      transform: translateY(-50%);
      background: none;
      border: none;
      cursor: pointer;
      color: #999;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 4px;
      transition: color 0.2s;
    }
    
    .toggle-password:hover { color: var(--teal); }

    /* SUBMIT BUTTON */
    .btn-login {
      width: 100%;
      background: var(--teal);
      color: var(--white);
      font-family: 'Inter', sans-serif;
      font-size: 15px;
      font-weight: 600;
      letter-spacing: 0.02em;
      padding: 16px;
      border: none;
      border-radius: 10px;
      cursor: pointer;
      margin-top: 8px;
      transition: background 0.2s var(--ease), transform 0.2s var(--ease), box-shadow 0.2s var(--ease);
    }
    
    .btn-login:hover {
      background: #009bbf;
      transform: translateY(-1px);
      box-shadow: 0 8px 20px rgba(0, 178, 218, 0.25);
    }

    /* RIGHT SIDE - IMAGE */
    .login-image-side {
      flex: 1.1; 
      background-image: url('/cms/assets/login-image.jpg');
      background-size: cover;
      background-position: center;
      background-repeat: no-repeat;
      background-color: #eaeaea; 
    }

    /* RESPONSIVE DESIGN */
    @media (max-width: 900px) {
      .login-image-side {
        display: none; 
      }
      .login-wrapper {
        max-width: 480px;
        min-height: auto;
      }
      .login-form-side {
        padding: clamp(32px, 6vw, 48px);
      }
    }
  </style>
</head>
<body>

  <div class="login-wrapper">
    <!-- LEFT SIDE: FORM -->
    <div class="login-form-side">
      <div class="login-header">
        <!-- Brand Logo -->
        <img src="/cms/assets/bonnd-logo.png" alt="Bonnd Logo" class="brand-logo">
        <h1 class="login-title">Welcome back!</h1>
        <p class="login-subtitle">Login to make changes on website</p>
      </div>

      <form action="auth.php" method="POST">
        <div class="form-group">
          <label for="username" class="form-label">Username</label>
          <input type="text" id="username" name="username" class="form-input" placeholder="Enter your username" required>
        </div>
        
        <div class="form-group">
          <label for="password" class="form-label">Password</label>
          <div class="input-wrap">
            <input type="password" id="password" name="password" class="form-input" placeholder="Enter your password" required>
            
            <button type="button" class="toggle-password" id="toggleBtn" aria-label="Toggle password visibility">
              <!-- Eye Icon (Visible) -->
              <svg id="eyeShow" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z" />
                <circle cx="12" cy="12" r="3" />
              </svg>
              <!-- Eye Off Icon (Hidden state) -->
              <svg id="eyeHide" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="display:none;">
                <path d="M9.88 9.88a3 3 0 1 0 4.24 4.24" />
                <path d="M10.73 5.08A10.43 10.43 0 0 1 12 5c7 0 10 7 10 7a13.16 13.16 0 0 1-1.67 2.68" />
                <path d="M6.61 6.61A13.526 13.526 0 0 0 2 12s3 7 10 7a9.74 9.74 0 0 0 5.39-1.61" />
                <line x1="2" y1="2" x2="22" y2="22" />
              </svg>
            </button>
          </div>
        </div>

        <button type="submit" class="btn-login">Login</button>
      </form>
    </div>

    <!-- RIGHT SIDE: IMAGE -->
    <div class="login-image-side"></div>
  </div>

  <script>
    // Eye Icon Toggle Logic
    const passwordInput = document.getElementById('password');
    const toggleBtn = document.getElementById('toggleBtn');
    const eyeShow = document.getElementById('eyeShow');
    const eyeHide = document.getElementById('eyeHide');

    toggleBtn.addEventListener('click', () => {
      if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        eyeShow.style.display = 'none';
        eyeHide.style.display = 'block';
      } else {
        passwordInput.type = 'password';
        eyeShow.style.display = 'block';
        eyeHide.style.display = 'none';
      }
    });
  </script>
</body>
</html>
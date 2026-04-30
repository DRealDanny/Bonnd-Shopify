<?php
session_start();

// PROTECT THE ROUTE: If not logged in, kick back to login page
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard — Bonnd CMS</title>
  
  <link rel="icon" type="image/png" href="/cms/assets/bonnd-mark.png">
  <link rel="apple-touch-icon" href="/cms/assets/bonnd-mark.png">
  
  <!-- PWA Manifest link required for the Install App prompt -->
  <link rel="manifest" href="manifest.json">
  
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
  
  <style>
    :root {
      --dark: #062E35;
      --teal: #00B2DA;
      --bg: #F5F7F9; /* Softer, cooler gray for SaaS background */
      --white: #FFFFFF;
      --text: #111827;
      --muted: #6B7280;
      --border: #E5E7EB;
      --sidebar-w: 260px;
      --ease: cubic-bezier(0.16, 1, 0.3, 1);
    }

    * { box-sizing: border-box; margin: 0; padding: 0; }
    
    body {
      font-family: 'Inter', sans-serif;
      background-color: var(--bg);
      color: var(--text);
      display: flex;
      min-height: 100vh;
      overflow-x: hidden;
    }

    /* SIDEBAR */
    .sidebar {
      width: var(--sidebar-w);
      background-color: var(--dark);
      color: var(--white);
      display: flex;
      flex-direction: column;
      position: fixed;
      top: 0; bottom: 0; left: 0;
      z-index: 100;
    }

    .sb-header {
      padding: 24px;
      border-bottom: 1px solid rgba(255,255,255,0.1);
      display: flex;
      align-items: center;
      gap: 12px;
    }

    .sb-logo { height: 24px; width: auto; filter: brightness(0) invert(1); /* Makes logo white */ }
    
    .sb-nav {
      padding: 24px 16px;
      flex: 1;
      display: flex;
      flex-direction: column;
      gap: 8px;
    }

    .nav-item {
      display: flex;
      align-items: center;
      gap: 12px;
      padding: 12px 16px;
      color: rgba(255,255,255,0.7);
      text-decoration: none;
      font-weight: 500;
      font-size: 14px;
      border-radius: 8px;
      transition: all 0.2s;
    }

    .nav-item:hover { background: rgba(255,255,255,0.05); color: var(--white); }
    .nav-item.active { background: var(--teal); color: var(--white); }
    
    .sb-footer { padding: 24px; border-top: 1px solid rgba(255,255,255,0.1); }
    .logout-btn { color: #ff6b6b; text-decoration: none; font-size: 14px; font-weight: 500; display: flex; align-items: center; gap: 8px; }

    /* MAIN CONTENT */
    .main-wrap {
      flex: 1;
      margin-left: var(--sidebar-w);
      display: flex;
      flex-direction: column;
    }

    /* TOP HEADER */
    .top-header {
      height: 72px;
      background: var(--white);
      border-bottom: 1px solid var(--border);
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 0 40px;
      position: sticky;
      top: 0;
      z-index: 90;
    }

    .header-title { font-size: 18px; font-weight: 600; }

    /* INSTALL APP BUTTON (Hidden by default, shown via JS) */
    #installPWA {
      display: none; 
      background: var(--teal);
      color: var(--white);
      border: none;
      padding: 10px 20px;
      border-radius: 6px;
      font-family: 'Inter', sans-serif;
      font-size: 13px;
      font-weight: 600;
      cursor: pointer;
      box-shadow: 0 4px 12px rgba(0, 178, 218, 0.2);
      transition: background 0.2s, transform 0.2s;
    }
    #installPWA:hover { background: #009bbf; transform: translateY(-1px); }

    /* DASHBOARD CONTENT */
    .content { padding: 40px; max-width: 1200px; }
    
    .welcome-card {
      background: var(--white);
      padding: 32px;
      border-radius: 16px;
      box-shadow: 0 4px 6px rgba(0,0,0,0.02);
      border: 1px solid var(--border);
      margin-bottom: 32px;
    }
    
    .welcome-card h2 { font-size: 24px; font-weight: 700; margin-bottom: 8px; letter-spacing: -0.02em; }
    .welcome-card p { color: var(--muted); font-size: 15px; }

    /* GRID FOR FUTURE CMS TOOLS */
    .grid {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
      gap: 24px;
    }

    .card {
      background: var(--white);
      padding: 24px;
      border-radius: 12px;
      border: 1px solid var(--border);
      box-shadow: 0 2px 4px rgba(0,0,0,0.01);
      transition: transform 0.2s, box-shadow 0.2s;
      cursor: pointer;
    }
    .card:hover { transform: translateY(-2px); box-shadow: 0 12px 24px rgba(0,0,0,0.04); }
    .card h3 { font-size: 16px; font-weight: 600; margin-bottom: 8px; }
    .card p { font-size: 13.5px; color: var(--muted); }

    @media (max-width: 768px) {
      .sidebar { transform: translateX(-100%); }
      .main-wrap { margin-left: 0; }
      .top-header { padding: 0 20px; }
      .content { padding: 20px; }
    }
  </style>
</head>
<body>

  <!-- SIDEBAR -->
  <aside class="sidebar">
    <div class="sb-header">
      <img src="/cms/assets/bonnd-mark.png" alt="Bonnd" class="sb-logo" style="width: 28px; height: 28px;">
      <span style="font-weight: 700; font-size: 16px; letter-spacing: 1px;">CMS</span>
    </div>
    <nav class="sb-nav">
      <a href="#" class="nav-item active">Dashboard</a>
      <a href="#" class="nav-item">Pages</a>
      <a href="#" class="nav-item">Products</a>
      <a href="#" class="nav-item">Settings</a>
    </nav>
    <div class="sb-footer">
      <a href="logout.php" class="logout-btn">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" y1="12" x2="9" y2="12"/></svg>
        Sign Out
      </a>
    </div>
  </aside>

  <!-- MAIN AREA -->
  <main class="main-wrap">
    <header class="top-header">
      <div class="header-title">Overview</div>
      
      <!-- PWA INSTALL BUTTON -->
      <button id="installPWA">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="display:inline-block; vertical-align:middle; margin-right:6px;"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg>
        Install App
      </button>
    </header>

    <div class="content">
      <div class="welcome-card">
        <h2>Welcome back, <?php echo htmlspecialchars($_SESSION['user']); ?>.</h2>
        <p>Your Bonnd storefront is healthy. Select a module below to push live changes to Shopify.</p>
      </div>

      <!-- CMS MODULES GRID -->
      <div class="grid">
        <div class="card">
          <h3>Homepage Editor</h3>
          <p>Update hero text, mission statements, and feature blocks on the main landing page.</p>
        </div>
        <div class="card">
          <h3>Contact Settings</h3>
          <p>Update support email, FAQ links, and routing information.</p>
        </div>
        <div class="card">
          <h3>Product Data</h3>
          <p>Manage ingredient lists, usage instructions, and warning labels.</p>
        </div>
      </div>
    </div>
  </main>

  <!-- PWA INSTALL LOGIC -->
  <script>
    let deferredPrompt;
    const installBtn = document.getElementById('installPWA');

    window.addEventListener('beforeinstallprompt', (e) => {
      // Prevent Chrome 67 and earlier from automatically showing the prompt
      e.preventDefault();
      // Stash the event so it can be triggered later.
      deferredPrompt = e;
      // Update UI to notify the user they can add to home screen
      installBtn.style.display = 'block';
    });

    installBtn.addEventListener('click', async () => {
      if (deferredPrompt !== null) {
        deferredPrompt.prompt();
        const { outcome } = await deferredPrompt.userChoice;
        if (outcome === 'accepted') {
          console.log('User accepted the install prompt');
        }
        deferredPrompt = null;
        installBtn.style.display = 'none';
      }
    });

    // Register Service Worker
    if ('serviceWorker' in navigator) {
      window.addEventListener('load', () => {
        navigator.serviceWorker.register('/cms/sw.js').then(registration => {
          console.log('SW registered: ', registration);
        }).catch(registrationError => {
          console.log('SW registration failed: ', registrationError);
        });
      });
    }
  </script>
</body>
</html>
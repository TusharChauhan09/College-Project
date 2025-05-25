<?php
// Get email from session if available
if (isset($_SESSION['email'])) {
  $email = $_SESSION['email'];
} else if (session_status() == PHP_SESSION_NONE) {
  session_start();
  $email = isset($_SESSION['email']) ? $_SESSION['email'] : '';
}
?>
<!doctype html>
<html>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="src/output.css" rel="stylesheet">
  <link href="src/optimized-effects.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
    integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

  <style>
    /* Modern UI enhancements */
    body {
      font-family: 'Inter', sans-serif;
    }

    .logo-container {
      position: relative;
    }

    .logo-container:after {
      content: '';
      position: absolute;
      inset: 0;
      border-radius: 50%;
      padding: 2px;
      background: linear-gradient(45deg, #4f46e5, #6366f1);
      -webkit-mask: linear-gradient(#fff 0 0) content-box, linear-gradient(#fff 0 0);
      -webkit-mask-composite: xor;
      mask-composite: exclude;
    }

    .nav-container {
      backdrop-filter: blur(16px);
      -webkit-backdrop-filter: blur(16px);
    }

    .nav-link {
      position: relative;
      overflow: hidden;
    }

    .nav-link::before {
      content: '';
      position: absolute;
      bottom: 0;
      left: 0;
      width: 0;
      height: 2px;
      background: linear-gradient(90deg, #4f46e5, #6366f1);
      z-index: -1;
    }

    .nav-link:hover::before {
      width: 100%;
    }

    .btn-glow:hover {
      box-shadow: 0 0 15px rgba(79, 70, 229, 0.5);
    }

    .profile-ring {
      position: relative;
    }

    .profile-ring::after {
      content: '';
      position: absolute;
      top: -3px;
      left: -3px;
      right: -3px;
      bottom: -3px;
      border-radius: 50%;
      background: linear-gradient(45deg, #4f46e5, #6366f1);
      z-index: -1;
      opacity: 0;
    }

    .profile-ring:hover::after {
      opacity: 1;
    }

    /* Responsive fixes */
    @media (max-width: 768px) {
      .brand-text {
        display: none;
      }

      .desktop-nav-links {
        display: none !important;
      }

      .search-container {
        display: none !important;
      }
    }

    @media (min-width: 769px) {
      .mobile-only {
        display: none !important;
      }

      .desktop-nav-links {
        display: flex !important;
      }

      .search-container {
        display: block !important;
      }
    }

    @media (max-width: 640px) {
      .container {
        padding-left: 0.75rem;
        padding-right: 0.75rem;
      }
    }
  </style>
</head>

<body class="overflow-x-hidden text-white">

  <div class="nav-container fixed top-0 z-50 w-full bg-gray-950 rounded-2xl shadow-2xl mb-[40px]">
    <!-- Gradient overlay with enhanced blur -->
    <div
      class="absolute inset-0 bg-gradient-to-r from-blue-600/20 via-purple-600/20 to-pink-600/20 opacity-80 backdrop-blur-xl rounded-b-2xl">
    </div>

    <div class="container relative z-10 mx-auto px-6 flex justify-between items-center h-[80px]">
      <!-- Logo and Navigation Links -->
      <div id="nav" class="flex items-center gap-10">
        <div class="text-3xl font-bold flex items-center">
          <div
            class="logo-container mr-3 flex items-center justify-center w-10 h-10 md:w-12 md:h-12 rounded-full bg-gradient-to-r from-indigo-600 to-indigo-500 shadow-lg shadow-indigo-500/20 overflow-hidden">
            <i class="fa-solid fa-building text-white text-xl md:text-2xl"></i>
          </div>
        </div>
        <div class="desktop-nav-links items-center space-x-8 hidden md:flex">
          <!-- Navigation Links with enhanced effects - only visible on desktop -->
          <a class="nav-link text-gray-200 hover:text-white font-medium tracking-wide transition-all duration-300 px-4 py-2 rounded-lg hover:bg-white/5"
            href="/new">
            <i class="fa-solid fa-home mr-2 text-indigo-400"></i>Home
          </a>
          <a class="nav-link text-gray-200 hover:text-white font-medium tracking-wide transition-all duration-300 px-4 py-2 rounded-lg hover:bg-white/5"
            href="/new/chat.php">
            <i class="fa-solid fa-comments mr-2 text-indigo-300"></i>Chat
          </a>
          <a class="nav-link text-gray-200 hover:text-white font-medium tracking-wide transition-all duration-300 px-4 py-2 rounded-lg hover:bg-white/5"
            href="/new/about.php">
            <i class="fa-solid fa-info-circle mr-2 text-indigo-300"></i>About
          </a>
        </div>
      </div>

      <!-- Search Bar with enhanced glass effect -->
      <div id="nav" class="search-container mx-4">
        <form id="searchForm" method="GET" action="" class="relative">
          <input
            class="w-[320px] pl-10 pr-5 py-3 rounded-full bg-white/5 text-gray-200 border border-gray-600/30 focus:border-blue-500/50 focus:outline-none focus:ring-2 focus:ring-blue-500/20 placeholder-gray-400 transition-all duration-300 backdrop-blur-2xl hover:bg-white/10 shadow-inner"
            type="text" name="search" placeholder="Search by position..."
            value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>" />
          <button type="submit"
            class="absolute top-1/2 left-3 transform -translate-y-1/2 text-gray-400 hover:text-blue-400 transition-all duration-300 hover:scale-110 z-10">
            <i class="fa-solid fa-search"></i>
          </button>
        </form>
      </div>

      <!-- Right Side Actions -->
      <div class="flex items-center gap-5">
        <!-- Desktop Post Button with enhanced gradient -->
        <a class="btn-glow hidden sm:flex items-center px-6 py-3 rounded-full bg-gradient-to-r from-indigo-600 to-indigo-500 hover:from-indigo-500 hover:to-indigo-400 text-white font-medium shadow-lg shadow-indigo-500/20 hover:shadow-indigo-500/40 transition-all duration-300 transform hover:-translate-y-0.5 backdrop-blur-xl border border-white/10"
          href="/new/post.php">
          <i class="fa-solid fa-plus mr-2 animate-pulse"></i> Post
        </a>

        <!-- Mobile Post Button -->
        <a class="btn-glow sm:hidden flex items-center justify-center w-11 h-11 rounded-full bg-gradient-to-r from-indigo-600 to-indigo-500 hover:from-indigo-500 hover:to-indigo-400 text-white shadow-lg shadow-indigo-500/20 hover:shadow-indigo-500/40 transition-all duration-300 transform hover:-translate-y-0.5 backdrop-blur-xl border border-white/10"
          href="/new/post.php">
          <i class="fa-solid fa-plus animate-pulse"></i>
        </a>

        <!-- Settings Button -->
        <a href="/new/theme.php" class="group" title="Settings">
          <div
            class="flex items-center justify-center w-10 h-10 md:w-12 md:h-12 rounded-full bg-white/5 hover:bg-gradient-to-r hover:from-indigo-500/20 hover:to-blue-500/20 text-gray-300 hover:text-white transition-all duration-300 shadow-lg shadow-black/20 backdrop-blur-2xl border border-gray-600/20 group-hover:border-blue-500/40">
            <i class="fa-solid fa-gear transition-all duration-500 group-hover:rotate-90"></i>
          </div>
        </a>

        <a href="/new/profile.php" class="group">
          <div
            class="profile-ring w-10 h-10 md:w-12 md:h-12 rounded-full overflow-hidden border-2 border-gray-600/30 group-hover:border-blue-500/60 transition-all duration-300 shadow-lg shadow-black/20 backdrop-blur-xl">
            <?php
            if (!empty($email)) {
              $res = mysqli_query($conn, "SELECT * FROM application WHERE a_email = '$email'");
              if ($res && mysqli_num_rows($res) > 0) {
                $row = mysqli_fetch_array($res);
                echo '<img src="Profile/' . $row['a_profile'] . '" alt="Profile" class="w-full h-full object-cover transform transition-transform duration-500 group-hover:scale-110">';
              } else {
                echo '<img src="img/default-avatar.jpg" alt="Profile" class="w-full h-full object-cover transform transition-transform duration-500 group-hover:scale-110">';
              }
            } else {
              echo '<img src="img/default-avatar.jpg" alt="Profile" class="w-full h-full object-cover transform transition-transform duration-500 group-hover:scale-110">';
            }
            ?>
          </div>
        </a>

        <a class="flex items-center justify-center w-10 h-10 md:w-12 md:h-12 rounded-full bg-white/5 hover:bg-gradient-to-r hover:from-red-500/20 hover:to-orange-500/20 text-gray-300 hover:text-white transition-all duration-300 shadow-lg shadow-black/20 backdrop-blur-2xl border border-gray-600/20"
          href="logout.php" title="Logout">
          <i class="fa-solid fa-sign-out-alt transition-transform duration-300 hover:scale-110"></i>
        </a>

        <button
          class="md:hidden p-2.5 rounded-full bg-white/5 hover:bg-gradient-to-r hover:from-blue-500/20 hover:to-purple-500/20 text-gray-300 hover:text-white focus:outline-none transition-all duration-300 backdrop-blur-2xl border border-gray-600/20"
          id="mobile-menu-button">
          <i class="fa-solid fa-bars text-xl"></i>
        </button>
      </div>
    </div>

    <div id="mobile-menu"
      class="hidden md:hidden bg-gray-900/90 backdrop-blur-2xl rounded-b-2xl mx-4 pb-4 px-4 shadow-2xl mt-1 border border-gray-700/20">
      <div class="pt-4 pb-3 space-y-4">
        <div class="border-b border-gray-700/50 pb-2 mb-3 mobile-only">
          <h3 class="text-sm uppercase text-gray-400 font-semibold mb-3 px-2">Navigation</h3>
          <a class="block text-gray-200 hover:text-white font-medium transition-all duration-300 relative group backdrop-blur-md px-4 py-3 rounded-lg hover:bg-gradient-to-r hover:from-indigo-600/20 hover:to-indigo-500/20"
            href="/new">
            <i class="fa-solid fa-home mr-2 text-indigo-400"></i> Home
          </a>
          <a class="block text-gray-200 hover:text-white font-medium transition-all duration-300 relative group backdrop-blur-md px-4 py-3 rounded-lg hover:bg-gradient-to-r hover:from-indigo-600/20 hover:to-indigo-500/20"
            href="/new/chat.php">
            <i class="fa-solid fa-comments mr-2 text-indigo-300"></i> Chat
          </a>
          <a class="block text-gray-200 hover:text-white font-medium transition-all duration-300 relative group backdrop-blur-md px-4 py-3 rounded-lg hover:bg-gradient-to-r hover:from-indigo-600/20 hover:to-indigo-500/20"
            href="/new/about.php">
            <i class="fa-solid fa-info-circle mr-2 text-indigo-300"></i> About
          </a>
          <a class="block text-gray-200 hover:text-white font-medium transition-all duration-300 relative group backdrop-blur-md px-4 py-3 rounded-lg hover:bg-gradient-to-r hover:from-indigo-600/20 hover:to-indigo-500/20"
            href="/new/theme.php">
            <i class="fa-solid fa-gear mr-2 text-blue-400"></i> Settings
          </a>
        </div>

        <form id="mobileSearchForm" method="GET" action="" class="relative mt-4">
          <input
            class="w-full pl-10 pr-5 py-3 rounded-full bg-white/5 text-gray-200 border border-gray-600/30 focus:border-blue-500/50 focus:outline-none focus:ring-2 focus:ring-blue-500/20 placeholder-gray-400 transition-all duration-300 backdrop-blur-2xl hover:bg-white/10 shadow-inner"
            type="text" name="search" placeholder="Search by position..."
            value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>" />
          <button type="submit"
            class="absolute top-1/2 left-3 transform -translate-y-1/2 text-gray-400 hover:text-blue-400 transition-all duration-300 hover:scale-110 z-10">
            <i class="fa-solid fa-search"></i>
          </button>
        </form>
      </div>
    </div>
  </div>

  </div>

  <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js"
    integrity="sha512-7eHRwcbYkK4d9g/6tD/mhkf++eoTHwpNM9woBxtPUBWm67zeAfFC+HrdoE2GanKeocly/VxeLvIqwvCdk7qScg=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script src="./notifications.js"></script>
  <script>
    const mobileMenuButton = document.getElementById('mobile-menu-button');
    const mobileMenu = document.getElementById('mobile-menu');

    if (mobileMenuButton && mobileMenu) {
      mobileMenuButton.addEventListener('click', () => {
        mobileMenu.classList.toggle('hidden');
      });
    }

    document.addEventListener('DOMContentLoaded', function () {
      const urlParams = new URLSearchParams(window.location.search);

      if (urlParams.has('posted')) {
        notifications.success('Your post has been published successfully!');

        const newUrl = window.location.pathname + window.location.hash;
        window.history.replaceState({}, document.title, newUrl);
      }

      applyTheme();
    });

    function applyTheme() {
      const currentTheme = localStorage.getItem('theme') || 'dark';
      document.documentElement.classList.toggle('light-mode', currentTheme === 'light');
    }

    (function () {
      const currentTheme = localStorage.getItem('theme') || 'dark';
      document.documentElement.classList.toggle('light-mode', currentTheme === 'light');
    })();
  </script>
</body>

</html>
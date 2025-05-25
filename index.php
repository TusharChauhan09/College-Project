<?php
// First, create the database and tables if needed
$conn = require './create_tables.php';

// Start the session if not already started
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Skip authentication check for index page to allow new users to sign up
// We'll handle authentication in specific pages that need it
?>
<!doctype html>
<html>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="src/output.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
    integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />

  <script src="./theme-script.js"></script>

  <script>
    (function () {
      const currentTheme = localStorage.getItem('theme') || 'dark';
      document.documentElement.classList.toggle('light-mode', currentTheme === 'light');
    })();
  </script>

  <style>
    /* Light mode styles for index page */
    :root {
      --bg-dark: #374151;
      --bg-light: #dbd6b2;
      --text-dark: #f3f4f6;
      --text-light: #0f172a;
    }

    body.bg-gray-700 {
      background-color: var(--bg-dark);
      transition: background-color 0.3s ease;
    }

    html.light-mode body.bg-gray-700 {
      background-color: var(--bg-light);
      color: var(--text-light);
    }

    /* Content positioning */
    .page-content {
      position: relative;
      z-index: 10;
    }

    /* Animated Background - Aurora Effect */
    .aurora {
      position: fixed;
      width: 100vw;
      height: 100vh;
      top: 0;
      left: 0;
      z-index: 2;
      pointer-events: none;
      overflow: hidden;
    }

    .aurora__item {
      overflow: hidden;
      position: absolute;
      width: 80%;
      height: 80%;
      background: linear-gradient(90deg, #3b82f6 0%, #8b5cf6 50%, #ec4899 100%);
      border-radius: 37% 29% 27% 27% / 28% 25% 41% 37%;
      filter: blur(100px);
      opacity: 0.1;
      animation: aurora 25s ease infinite;
    }

    .aurora__item:nth-of-type(1) {
      top: -30%;
      left: -20%;
      animation-delay: 0s;
    }

    .aurora__item:nth-of-type(2) {
      bottom: -30%;
      right: -20%;
      animation-delay: -5s;
    }

    @keyframes aurora {
      0% {
        transform: rotate(0deg) scale(1);
      }

      50% {
        transform: rotate(180deg) scale(1.2);
      }

      100% {
        transform: rotate(360deg) scale(1);
      }
    }

    /* Particles Background */
    #particles-js {
      position: fixed;
      width: 100vw;
      height: 100vh;
      top: 0;
      left: 0;
      z-index: 1;
      pointer-events: none;
      overflow: hidden;
    }

    /* Light mode adjustments */
    html.light-mode .aurora__item {
      opacity: 0.05;
    }

    html.light-mode .aurora__item:nth-of-type(1) {
      background: linear-gradient(90deg, #4f46e5 0%, #7c3aed 50%, #db2777 100%);
    }

    html.light-mode .aurora__item:nth-of-type(2) {
      background: linear-gradient(90deg, #eab308 0%, #ea580c 50%, #db2777 100%);
    }
  </style>
</head>

<body class=" bg-gray-700    ">
  <div id="particles-js"></div>
  <div class="aurora">
    <div class="aurora__item"></div>
    <div class="aurora__item"></div>
  </div>

  <div class="page-content">
    <?php
    require './nav.php';
    echo '<br><br><br>';


    // require './signup.php';
    // require './login.php';
    
    require './cardsAll.php';
    // require './cards.php';
    
    // require './about.php';
    // require './application.php';
    // require './profile.php';
    
    require './footer.php';
    ?>
  </div>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js"
    integrity="sha512-7eHRwcbYkK4d9g/6tD/mhkf++eoTHwpNM9woBxtPUBWm67zeAfFC+HrdoE2GanKeocly/VxeLvIqwvCdk7qScg=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script src="./animation.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/particles.js/2.0.0/particles.min.js"></script>
  <script>
    // Initialize particles.js
    particlesJS('particles-js', {
      particles: {
        number: { value: 50, density: { enable: true, value_area: 800 } },
        color: { value: '#ffffff' },
        shape: { type: 'circle' },
        opacity: {
          value: 0.2,
          random: true,
          animation: { enable: true, speed: 1, minimumValue: 0.1, sync: false }
        },
        size: {
          value: 3,
          random: true,
          animation: { enable: true, speed: 2, minimumValue: 0.3, sync: false }
        },
        move: {
          enable: true,
          speed: 1,
          direction: 'none',
          random: false,
          straight: false,
          outModes: { default: 'out' },
          attract: { enable: false, rotateX: 600, rotateY: 1200 }
        }
      },
      interactivity: {
        detectsOn: 'canvas',
        events: {
          onhover: { enable: true, mode: 'repulse' },
          resize: true
        },
        modes: {
          repulse: { distance: 100, duration: 0.4 }
        }
      },
      retina_detect: true
    });

    function applyTheme() {
      const currentTheme = localStorage.getItem('theme') || 'dark';
      if (currentTheme === 'light') {
        if (window.pJSDom && window.pJSDom[0] && window.pJSDom[0].pJS) {
          window.pJSDom[0].pJS.particles.color.value = '#475569';
        }
      }
    }

    document.addEventListener('DOMContentLoaded', function () {
      applyTheme();
    });
  </script>
</body>

</html>

<!-- chat bot -->

<!-- dark mode  -->
<!-- about  -->
<!-- card form database -->
<!--  -->
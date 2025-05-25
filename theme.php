<?php require './auth.php'; ?>
<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="src/output.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <script>
        (function () {
            const currentTheme = localStorage.getItem('theme') || 'dark';
            document.documentElement.classList.toggle('light-mode', currentTheme === 'light');
        })();
    </script>

    <style>
        body {
            font-family: 'Inter', sans-serif;
            min-height: 100vh;
            width: 100vw;
            overflow-x: hidden;
            position: relative;
        }

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

        /* Particles background */
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

        /* Theme toggle animation and styles */
        .theme-container {
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            transition: all 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            transform-style: preserve-3d;
            perspective: 1500px;
        }

        .theme-container:hover {
            transform: translateY(-8px) rotateX(5deg) rotateY(5deg);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
        }

        .theme-toggle {
            background: #111827;
            position: relative;
            height: 3rem;
            width: 6rem;
            border-radius: 3rem;
            transition: all 0.3s ease-in-out;
            cursor: pointer;
            overflow: hidden;
        }

        .theme-toggle::before {
            content: '';
            display: block;
            height: 2.4rem;
            width: 2.4rem;
            position: absolute;
            top: 0.3rem;
            left: 0.3rem;
            background: linear-gradient(40deg, #fbbf24, #f59e0b);
            border-radius: 50%;
            box-shadow: 0 0 25px rgba(251, 191, 36, 0.4);
            transition: all 0.3s ease-in-out;
            transform: translateX(0);
            z-index: 10;
        }

        .theme-toggle.light-mode::before {
            transform: translateX(3rem);
            background: linear-gradient(40deg, #e5e7eb, #9ca3af);
            box-shadow: 0 0 25px rgba(156, 163, 175, 0.4);
        }

        /* Stars and moon */
        .stars {
            position: absolute;
            top: 0.7rem;
            left: 1rem;
            width: 4rem;
            height: 1.6rem;
            transition: all 0.3s ease-in-out;
            opacity: 1;
        }

        .star {
            position: absolute;
            background: #fff;
            border-radius: 50%;
            transition: all 0.3s ease-in-out;
        }

        .star:nth-child(1) {
            width: 0.15rem;
            height: 0.15rem;
            top: 0.5rem;
            left: 2.5rem;
        }

        .star:nth-child(2) {
            width: 0.2rem;
            height: 0.2rem;
            top: 0.2rem;
            left: 3.5rem;
        }

        .star:nth-child(3) {
            width: 0.15rem;
            height: 0.15rem;
            top: 1rem;
            left: 4.2rem;
        }

        .star:nth-child(4) {
            width: 0.1rem;
            height: 0.1rem;
            top: 0.6rem;
            left: 5rem;
        }

        .theme-toggle.light-mode .stars {
            opacity: 0;
        }

        /* Clouds */
        .clouds {
            position: absolute;
            top: 0.7rem;
            left: 3.2rem;
            width: 2.4rem;
            height: 1.6rem;
            transition: all 0.3s ease-in-out;
            opacity: 0;
        }

        .cloud {
            position: absolute;
            background: #fff;
            border-radius: 1rem;
        }

        .cloud:nth-child(1) {
            width: 1.2rem;
            height: 0.3rem;
            top: 0.35rem;
            left: 0.5rem;
        }

        .cloud:nth-child(2) {
            width: 0.8rem;
            height: 0.2rem;
            top: 0.65rem;
            left: 0.4rem;
        }

        .theme-toggle.light-mode .clouds {
            opacity: 1;
        }

        .theme-toggle:active::before {
            transform: scale(0.9);
        }

        /* Settings card animations */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .settings-card {
            animation: fadeIn 0.6s ease-out forwards;
        }

        /* Light mode styles */
        :root {
            --background-dark: #0f172a;
            --background-light: #dbd6b2;
            --text-dark: #f8fafc;
            --text-light: #0f172a;
        }

        .light-mode body {
            background-color: var(--background-light);
            color: var(--text-light);
        }

        html.light-mode .nav-container {
            background-color: #dbd6b2 !important;
            /* Light cream for light mode */
        }

        html.light-mode .footer-gradient {
            background: linear-gradient(135deg, #dbd6b2 0%, #c5c1a0 100%) !important;
        }

        /* Theme mode indicator flare */
        .mode-indicator {
            position: relative;
            overflow: hidden;
        }

        .mode-indicator::after {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: linear-gradient(45deg, transparent, rgba(255, 255, 255, 0.1), transparent);
            transform: rotate(45deg);
            animation: flare 2s infinite;
        }

        @keyframes flare {
            0% {
                transform: translateX(-100%) rotate(45deg);
            }

            100% {
                transform: translateX(100%) rotate(45deg);
            }
        }

        html.light-mode .mode-indicator h3,
        html.light-mode .text-xl.font-semibold.text-white {
            color: #0f172a !important;
        }

        html.light-mode .text-gray-400.text-sm {
            color: #334155 !important;
        }

        html.light-mode .text-center.mb-8 p {
            color: #334155 !important;
        }

        /* Light mode appearance for settings card and container */
        html.light-mode .settings-card {
            background-color: rgba(219, 214, 178, 0.8) !important;
            border-color: rgba(197, 193, 160, 0.5) !important;
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04) !important;
        }

        html.light-mode .theme-container {
            background-color: rgba(208, 202, 166, 0.7) !important;
            border-color: rgba(197, 193, 160, 0.5) !important;
        }

        html.light-mode .bg-gray-800\/70 {
            background-color: rgba(208, 202, 166, 0.7) !important;
        }

        html.light-mode .text-center.mb-8 h1 {
            background: linear-gradient(to right, #1e40af, #4f46e5, #6d28d9);
            -webkit-background-clip: text;
            background-clip: text;
        }

        html.light-mode .fa-moon.text-indigo-300 {
            color: #4338ca !important;
        }

        html.light-mode .fa-sun.text-yellow-300 {
            color: #d97706 !important;
        }

        /* Theme toggle in light mode */
        html.light-mode .theme-toggle {
            background: #c5c1a0;
        }

        html.light-mode .theme-toggle::before {
            background: linear-gradient(40deg, #eab308, #d97706);
            box-shadow: 0 0 25px rgba(251, 191, 36, 0.4);
        }

        html.light-mode .cloud {
            background: #f8fafc;
        }

        /* Current Theme card in light mode */
        html.light-mode .mode-indicator.bg-gray-800\/70 {
            background-color: rgba(208, 202, 166, 0.7) !important;
            border-color: rgba(197, 193, 160, 0.5) !important;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -1px rgba(0, 0, 0, 0.03) !important;
        }

        /* Better contrast for light mode sun icon */
        html.light-mode #currentThemeIcon.from-amber-500 {
            background: linear-gradient(to right, #eab308, #d97706) !important;
            border: 2px solid rgba(255, 255, 255, 0.8);
        }

        /* Theme selection card improvements */
        html.light-mode .theme-choice {
            background-color: rgba(219, 214, 178, 0.6) !important;
            border-color: rgba(197, 193, 160, 0.7) !important;
            transition: all 0.3s ease;
        }

        html.light-mode .theme-choice:hover {
            background-color: rgba(208, 202, 166, 0.8) !important;
            transform: translateY(-2px);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05) !important;
        }

        html.light-mode .theme-choice.selected {
            background-color: rgba(208, 202, 166, 0.9) !important;
            border-color: #b4af8c !important;
            box-shadow: 0 0 15px rgba(197, 193, 160, 0.5) !important;
        }

        /* Header improvements for light mode */
        html.light-mode header.bg-gray-800 {
            background-color: #f3f1e3 !important;
            border-bottom: 1px solid rgba(197, 193, 160, 0.5);
        }

        html.light-mode header h1.text-white {
            color: #4b5563 !important;
        }

        html.light-mode header button.hover\:bg-gray-700 {
            background-color: transparent !important;
        }

        html.light-mode header button.hover\:bg-gray-700:hover {
            background-color: rgba(208, 202, 166, 0.5) !important;
        }

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

<body class="overflow-x-hidden bg-gray-900 text-white min-h-screen">
    <div id="particles-js"></div>
    <div class="aurora">
        <div class="aurora__item"></div>
        <div class="aurora__item"></div>
    </div>

    <div class="relative z-20">
        <?php require './nav.php'; ?>
    </div>

    <div class="relative z-10 container mx-auto px-4 py-24 flex justify-center">
        <div
            class="settings-card bg-gray-900/80 backdrop-blur-xl border border-gray-700/30 rounded-3xl p-8 w-full max-w-2xl shadow-2xl mt-10">
            <div class="text-center mb-8">
                <h1
                    class="text-3xl md:text-4xl font-bold bg-gradient-to-r from-blue-400 via-indigo-400 to-purple-400 bg-clip-text text-transparent">
                    Appearance Settings
                </h1>
                <p class="text-gray-400 mt-3">Customize your experience with theme preferences</p>
            </div>

            <div class="theme-container bg-gray-800/70 rounded-xl p-6 mb-8 backdrop-blur-xl border border-gray-700/30">
                <div class="flex flex-col md:flex-row items-center justify-between gap-6">
                    <div>
                        <h2 class="text-xl font-semibold text-white mb-2">Theme Preference</h2>
                        <p class="text-gray-400 text-sm">Choose between light and dark mode for your interface</p>
                    </div>

                    <div class="flex items-center gap-4">
                        <span class="text-gray-400">
                            <i class="fa-solid fa-moon text-indigo-300"></i>
                        </span>

                        <div id="themeToggle" class="theme-toggle">
                            <div class="stars">
                                <div class="star"></div>
                                <div class="star"></div>
                                <div class="star"></div>
                                <div class="star"></div>
                            </div>
                            <div class="clouds">
                                <div class="cloud"></div>
                                <div class="cloud"></div>
                            </div>
                        </div>

                        <span class="text-gray-400">
                            <i class="fa-solid fa-sun text-yellow-300"></i>
                        </span>
                    </div>
                </div>
            </div>

            <div class="flex flex-col md:flex-row justify-between gap-6">
                <div
                    class="mode-indicator p-6 bg-gray-800/70 rounded-xl border border-gray-700/30 flex-1 backdrop-blur-xl">
                    <h3 class="text-lg font-semibold text-white mb-3">Current Theme</h3>
                    <div class="flex items-center gap-3">
                        <div id="currentThemeIcon"
                            class="w-10 h-10 rounded-full bg-gradient-to-r from-indigo-600 to-purple-600 flex items-center justify-center text-white">
                            <i class="fa-solid fa-moon"></i>
                        </div>
                        <div>
                            <p id="currentThemeText" class="font-medium text-white">Dark Mode</p>
                            <p class="text-gray-400 text-sm">Better for night viewing</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="relative z-10 mt-20">
        <?php require './footer.php'; ?>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const themeToggle = document.getElementById('themeToggle');
            const currentThemeIcon = document.getElementById('currentThemeIcon');
            const currentThemeText = document.getElementById('currentThemeText');

            const currentTheme = localStorage.getItem('theme') || 'dark';

            if (currentTheme === 'light') {
                themeToggle.classList.add('light-mode');
                document.documentElement.classList.add('light-mode');
                currentThemeIcon.innerHTML = '<i class="fa-solid fa-sun"></i>';
                currentThemeIcon.className = 'w-10 h-10 rounded-full bg-gradient-to-r from-amber-500 to-yellow-400 flex items-center justify-center text-white';
                currentThemeText.textContent = 'Light Mode';
                currentThemeText.className = 'font-medium text-slate-900';
                document.querySelector('.text-gray-400.text-sm').className = 'text-slate-700 text-sm';
            } else {
                themeToggle.classList.remove('light-mode');
                document.documentElement.classList.remove('light-mode');
                currentThemeIcon.innerHTML = '<i class="fa-solid fa-moon"></i>';
                currentThemeIcon.className = 'w-10 h-10 rounded-full bg-gradient-to-r from-indigo-600 to-purple-600 flex items-center justify-center text-white';
                currentThemeText.textContent = 'Dark Mode';
                currentThemeText.className = 'font-medium text-white';
                document.querySelector('.text-gray-400.text-sm').className = 'text-gray-400 text-sm';
            }

            themeToggle.addEventListener('click', function () {
                this.classList.toggle('light-mode');

                const isLightMode = this.classList.contains('light-mode');

                localStorage.setItem('theme', isLightMode ? 'light' : 'dark');

                document.documentElement.classList.toggle('light-mode', isLightMode);

                if (isLightMode) {
                    currentThemeIcon.innerHTML = '<i class="fa-solid fa-sun"></i>';
                    currentThemeIcon.className = 'w-10 h-10 rounded-full bg-gradient-to-r from-amber-500 to-yellow-400 flex items-center justify-center text-white';
                    currentThemeText.textContent = 'Light Mode';
                    currentThemeText.className = 'font-medium text-slate-900';
                    document.querySelector('.text-gray-400.text-sm').className = 'text-slate-700 text-sm';
                } else {
                    currentThemeIcon.innerHTML = '<i class="fa-solid fa-moon"></i>';
                    currentThemeIcon.className = 'w-10 h-10 rounded-full bg-gradient-to-r from-indigo-600 to-purple-600 flex items-center justify-center text-white';
                    currentThemeText.textContent = 'Dark Mode';
                    currentThemeText.className = 'font-medium text-white';
                    document.querySelector('.text-gray-400.text-sm').className = 'text-gray-400 text-sm';
                }

                const settingsCard = document.querySelector('.settings-card');
                settingsCard.style.animation = 'none';
                setTimeout(() => {
                    settingsCard.style.animation = 'fadeIn 0.4s ease-out forwards';
                }, 10);

                if (isLightMode) {
                    if (window.pJSDom && window.pJSDom[0] && window.pJSDom[0].pJS) {
                        window.pJSDom[0].pJS.particles.color.value = '#475569';
                        window.pJSDom[0].pJS.fn.particlesRefresh();
                    }
                } else {
                    if (window.pJSDom && window.pJSDom[0] && window.pJSDom[0].pJS) {
                        window.pJSDom[0].pJS.particles.color.value = '#ffffff';
                        window.pJSDom[0].pJS.fn.particlesRefresh();
                    }
                }
            });
        });
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/particles.js/2.0.0/particles.min.js"></script>
    <script>
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

        // Adjust particles for light mode
        function applyParticlesTheme() {
            const currentTheme = localStorage.getItem('theme') || 'dark';
            if (currentTheme === 'light') {
                if (window.pJSDom && window.pJSDom[0] && window.pJSDom[0].pJS) {
                    window.pJSDom[0].pJS.particles.color.value = '#475569';
                }
            }
        }

        // Apply theme to particles when page loads
        document.addEventListener('DOMContentLoaded', function () {
            applyParticlesTheme();
        });
    </script>
</body>

</html>
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
    <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
    <script src="https://cdn.jsdelivr.net/npm/kute.js@2.1.2/dist/kute.min.js"></script>
    <style>
        /* Light and dark mode styles */
        :root {
            --bg-color-dark: #000000;
            --bg-color-light: #dbd6b2;
            --card-bg-dark: #1f2937;
            --card-bg-light: #d0caa6;
            --border-dark: rgba(75, 85, 99, 0.3);
            --border-light: rgba(197, 193, 160, 0.5);
            --text-primary-dark: #f3f4f6;
            --text-primary-light: #0f172a;
            --text-secondary-dark: #9ca3af;
            --text-secondary-light: #334155;
        }

        body {
            background-color: var(--bg-color-dark);
            color: var(--text-primary-dark);
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        /* Light mode styles */
        html.light-mode body {
            background-color: var(--bg-color-light);
            color: var(--text-primary-light);
        }

        html.light-mode .bg-gray-900 {
            background-color: var(--card-bg-light);
        }

        html.light-mode .text-gray-100 {
            color: var(--text-primary-light);
        }

        html.light-mode .text-gray-400 {
            color: var(--text-secondary-light);
        }

        html.light-mode .text-white {
            color: var(--text-primary-light);
        }

        html.light-mode .border-gray-700 {
            border-color: var(--border-light);
        }

        html.light-mode .bg-indigo-900 {
            background-color: #e0e7ff;
        }

        html.light-mode .text-indigo-200 {
            color: #4338ca;
        }

        html.light-mode .text-indigo-300 {
            color: #4f46e5;
        }

        /* Keep banner text white in both themes */
        .banner-text {
            color: #ffffff !important;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
        }

        html.light-mode .banner-text {
            color: #ffffff !important;
        }

        /* Button styles */
        .banner-button {
            color: #ffffff !important;
            background-color: rgba(31, 41, 55, 0.9) !important;
            transition: all 0.3s ease !important;
            text-shadow: 0 1px 2px rgba(0, 0, 0, 0.2);
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        }

        .banner-button:hover {
            background-color: rgba(55, 65, 81, 0.9) !important;
            transform: translateY(-2px);
            box-shadow: 0 6px 8px -1px rgba(0, 0, 0, 0.2), 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        }

        html.light-mode .banner-button {
            color: #ffffff !important;
            background-color: rgba(31, 41, 55, 0.9) !important;
        }

        .team-card {
            background: var(--card-bg-dark);
            border: 1px solid var(--border-dark);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            transform: translateY(0);
            backdrop-filter: blur(10px);
        }

        html.light-mode .team-card {
            background: var(--card-bg-light);
            border-color: var(--border-light);
        }

        .team-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.2), 0 10px 10px -5px rgba(0, 0, 0, 0.1);
        }

        .profile-image-wrap {
            position: relative;
            transition: transform 0.3s ease;
            transform-style: preserve-3d;
        }

        .team-card:hover .profile-image-wrap {
            transform: rotateY(10deg) rotateX(10deg);
        }

        .team-card:hover .profile-image {
            transform: scale(1.05);
            filter: brightness(1.1);
        }

        .profile-image {
            transition: all 0.3s ease;
        }

        .role-badge {
            background: linear-gradient(135deg, #4f46e5, #7c3aed);
            transition: all 0.3s ease;
        }

        .team-card:hover .role-badge {
            transform: translateY(-2px);
            box-shadow: 0 10px 15px -3px rgba(79, 70, 229, 0.3);
        }

        .social-links a {
            transition: all 0.3s ease;
        }

        .social-links a:hover {
            transform: translateY(-3px);
            color: #4f46e5;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .team-card {
            animation: fadeInUp 0.6s ease-out forwards;
        }

        .team-card:nth-child(2) {
            animation-delay: 0.2s;
        }

        .team-card:nth-child(3) {
            animation-delay: 0.4s;
        }

        .team-card:nth-child(4) {
            animation-delay: 0.6s;
        }
    </style>
</head>

<body class=" bg-black ">

    <?php require './nav.php';
    echo '<br><br><br>';
    ?>

    <!-- <div class=" relative  ">
        <div class="container ">
            <img class=" w-full h-200"
                src="https://images.unsplash.com/photo-1624139283078-74a0492f2ee3?q=80&w=1227&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                alt="">
        </div>
        <div class=" text-white absolute top-1/2 -translate-y-1/2 left-1/2 -translate-x-1/2 transform ">
            <div class=" flex flex-col justify-center items-center">
                <h1 class=" text-6xl text-white font-bold ">Be Who You</h1>
                <h1 class=" text-6xl text-white font-bold  pb-4">Really Are</h1>
                <pre class="pb-4 ">Cache your next opportunity and unlock a brighter career!</pre>
                <a class="cursor-pointer bg-gray-800 hover:bg-gray-600 transition-all ease-in delay-75  text-white rounded-3xl p-5 "
                    href="/new">Get Started</a>
            </div>
        </div>
    </div> -->

    <!-- Responsive banner with mobile optimizations -->
    <div class="relative w-full">
        <div class="w-full">
            <img class="w-full h-64 md:h-96 lg:h-screen object-cover"
                src="https://images.unsplash.com/photo-1624139283078-74a0492f2ee3?q=80&w=1227&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                alt="Banner image">
        </div>
        <div class="text-white absolute top-1/2 -translate-y-1/2 left-1/2 -translate-x-1/2 transform w-full px-4">
            <div class="flex flex-col justify-center items-center text-center">
                <h1 class="banner-text text-3xl md:text-4xl lg:text-6xl font-bold leading-tight">Be Who You</h1>
                <h1 class="banner-text text-3xl md:text-4xl lg:text-6xl font-bold pb-2 md:pb-4 leading-tight">Really Are
                </h1>
                <pre class="banner-text pb-2 md:pb-4 text-sm">Cache your next opportunity and 
unlock a brighter career!</pre>
                <a class="banner-button cursor-pointer rounded-3xl px-6 py-3 md:px-8 md:py-4 text-sm md:text-base font-medium"
                    href="/new">Get Started</a>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 place-items-center gap-10 my-5 container mx-auto px-4">
        <!-- 1 -->
        <div class="team-card rounded-xl shadow-xl overflow-hidden max-w-sm w-full text-gray-100 p-6">
            <!-- Profile Image -->
            <div class="flex justify-center mb-6">
                <div
                    class="profile-image-wrap rounded-full bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500 p-1">
                    <div class="rounded-full overflow-hidden h-24 w-24">
                        <img src="https://images.unsplash.com/photo-1438761681033-6461ffad8d80?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                            class="profile-image w-full h-full object-cover" alt="Profile Image">
                    </div>
                </div>
            </div>
            <!-- Name and IDs -->
            <div class="text-center mb-6">
                <h2
                    class="text-2xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-indigo-400 to-purple-400 mb-2">
                    John Doe</h2>
                <div class="flex justify-center space-x-4 text-sm text-gray-400">
                    <div>
                        <div class="flex justify-center gap-x-1 text-[20px]">
                            <p class="font-bold">Reg. No.</p>
                            <p>12310419</p>
                        </div>
                        <div class="flex justify-center gap-x-1 text-[20px]">
                            <p class="font-bold">Roll No.</p>
                            <p>10</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Description -->
            <div class="mb-6">
                <h3
                    class="text-lg font-semibold mb-2 text-transparent bg-clip-text bg-gradient-to-r from-purple-400 to-pink-400">
                    About</h3>
                <p class="text-gray-400 text-sm leading-relaxed">
                    A passionate software developer with expertise in front-end technologies. Focused on
                    creating accessible
                    and responsive user interfaces with attention to detail and performance optimization.
                </p>
            </div>

            <!-- Role -->
            <div class="mb-6">
                <h3
                    class="text-lg font-semibold mb-2 text-transparent bg-clip-text bg-gradient-to-r from-purple-400 to-pink-400">
                    Role</h3>
                <div class="role-badge px-4 py-2 rounded-full text-sm inline-block text-white font-medium">
                    Frontend Lead Developer
                </div>
            </div>

            <!-- Social Links -->
            <div class="pt-4 border-t border-gray-700/30">
                <div class="social-links flex justify-center space-x-6">
                    <!-- GitHub -->
                    <a href="https://github.com/johndoe" class="text-gray-400 hover:text-white">
                        <i class="fab fa-github text-xl"></i>
                    </a>

                    <!-- Twitter -->
                    <a href="https://twitter.com/johndoe" class="text-gray-400 hover:text-white">
                        <i class="fab fa-twitter text-xl"></i>
                    </a>
                </div>
            </div>
        </div>

        <!-- 2 -->
        <div class="team-card rounded-xl shadow-xl overflow-hidden max-w-sm w-full text-gray-100 p-6">
            <!-- Profile Image -->
            <div class="flex justify-center mb-6">
                <div
                    class="profile-image-wrap rounded-full bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500 p-1">
                    <div class="rounded-full overflow-hidden h-24 w-24">
                        <img src="https://images.unsplash.com/photo-1438761681033-6461ffad8d80?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                            class="profile-image w-full h-full object-cover" alt="Profile Image">
                    </div>
                </div>
            </div>
            <!-- Name and IDs -->
            <div class="text-center mb-6">
                <h2
                    class="text-2xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-indigo-400 to-purple-400 mb-2">
                    John Doe</h2>
                <div class="flex justify-center space-x-4 text-sm text-gray-400">
                    <div>
                        <div class="flex justify-center gap-x-1 text-[20px]">
                            <p class="font-bold">Reg. No.</p>
                            <p>12310419</p>
                        </div>
                        <div class="flex justify-center gap-x-1 text-[20px]">
                            <p class="font-bold">Roll No.</p>
                            <p>10</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Description -->
            <div class="mb-6">
                <h3
                    class="text-lg font-semibold mb-2 text-transparent bg-clip-text bg-gradient-to-r from-purple-400 to-pink-400">
                    About</h3>
                <p class="text-gray-400 text-sm leading-relaxed">
                    A passionate software developer with expertise in front-end technologies. Focused on
                    creating accessible
                    and responsive user interfaces with attention to detail and performance optimization.
                </p>
            </div>

            <!-- Role -->
            <div class="mb-6">
                <h3
                    class="text-lg font-semibold mb-2 text-transparent bg-clip-text bg-gradient-to-r from-purple-400 to-pink-400">
                    Role</h3>
                <div class="role-badge px-4 py-2 rounded-full text-sm inline-block text-white font-medium">
                    Frontend Lead Developer
                </div>
            </div>

            <!-- Social Links -->
            <div class="pt-4 border-t border-gray-700/30">
                <div class="social-links flex justify-center space-x-6">
                    <!-- GitHub -->
                    <a href="https://github.com/johndoe" class="text-gray-400 hover:text-white">
                        <i class="fab fa-github text-xl"></i>
                    </a>

                    <!-- Twitter -->
                    <a href="https://twitter.com/johndoe" class="text-gray-400 hover:text-white">
                        <i class="fab fa-twitter text-xl"></i>
                    </a>
                </div>
            </div>
        </div>

        <!-- 3 -->
        <div class="team-card rounded-xl shadow-xl overflow-hidden max-w-sm w-full text-gray-100 p-6">
            <!-- Profile Image -->
            <div class="flex justify-center mb-6">
                <div
                    class="profile-image-wrap rounded-full bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500 p-1">
                    <div class="rounded-full overflow-hidden h-24 w-24">
                        <img src="https://images.unsplash.com/photo-1438761681033-6461ffad8d80?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                            class="profile-image w-full h-full object-cover" alt="Profile Image">
                    </div>
                </div>
            </div>
            <!-- Name and IDs -->
            <div class="text-center mb-6">
                <h2
                    class="text-2xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-indigo-400 to-purple-400 mb-2">
                    John Doe</h2>
                <div class="flex justify-center space-x-4 text-sm text-gray-400">
                    <div>
                        <div class="flex justify-center gap-x-1 text-[20px]">
                            <p class="font-bold">Reg. No.</p>
                            <p>12310419</p>
                        </div>
                        <div class="flex justify-center gap-x-1 text-[20px]">
                            <p class="font-bold">Roll No.</p>
                            <p>10</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Description -->
            <div class="mb-6">
                <h3
                    class="text-lg font-semibold mb-2 text-transparent bg-clip-text bg-gradient-to-r from-purple-400 to-pink-400">
                    About</h3>
                <p class="text-gray-400 text-sm leading-relaxed">
                    A passionate software developer with expertise in front-end technologies. Focused on
                    creating accessible
                    and responsive user interfaces with attention to detail and performance optimization.
                </p>
            </div>

            <!-- Role -->
            <div class="mb-6">
                <h3
                    class="text-lg font-semibold mb-2 text-transparent bg-clip-text bg-gradient-to-r from-purple-400 to-pink-400">
                    Role</h3>
                <div class="role-badge px-4 py-2 rounded-full text-sm inline-block text-white font-medium">
                    Frontend Lead Developer
                </div>
            </div>

            <!-- Social Links -->
            <div class="pt-4 border-t border-gray-700/30">
                <div class="social-links flex justify-center space-x-6">
                    <!-- GitHub -->
                    <a href="https://github.com/johndoe" class="text-gray-400 hover:text-white">
                        <i class="fab fa-github text-xl"></i>
                    </a>

                    <!-- Twitter -->
                    <a href="https://twitter.com/johndoe" class="text-gray-400 hover:text-white">
                        <i class="fab fa-twitter text-xl"></i>
                    </a>
                </div>
            </div>
        </div>

        <!-- 4 -->
        <div class="team-card rounded-xl shadow-xl overflow-hidden max-w-sm w-full text-gray-100 p-6">
            <!-- Profile Image -->
            <div class="flex justify-center mb-6">
                <div
                    class="profile-image-wrap rounded-full bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500 p-1">
                    <div class="rounded-full overflow-hidden h-24 w-24">
                        <img src="https://images.unsplash.com/photo-1438761681033-6461ffad8d80?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                            class="profile-image w-full h-full object-cover" alt="Profile Image">
                    </div>
                </div>
            </div>
            <!-- Name and IDs -->
            <div class="text-center mb-6">
                <h2
                    class="text-2xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-indigo-400 to-purple-400 mb-2">
                    John Doe</h2>
                <div class="flex justify-center space-x-4 text-sm text-gray-400">
                    <div>
                        <div class="flex justify-center gap-x-1 text-[20px]">
                            <p class="font-bold">Reg. No.</p>
                            <p>12310419</p>
                        </div>
                        <div class="flex justify-center gap-x-1 text-[20px]">
                            <p class="font-bold">Roll No.</p>
                            <p>10</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Description -->
            <div class="mb-6">
                <h3
                    class="text-lg font-semibold mb-2 text-transparent bg-clip-text bg-gradient-to-r from-purple-400 to-pink-400">
                    About</h3>
                <p class="text-gray-400 text-sm leading-relaxed">
                    A passionate software developer with expertise in front-end technologies. Focused on
                    creating accessible
                    and responsive user interfaces with attention to detail and performance optimization.
                </p>
            </div>

            <!-- Role -->
            <div class="mb-6">
                <h3
                    class="text-lg font-semibold mb-2 text-transparent bg-clip-text bg-gradient-to-r from-purple-400 to-pink-400">
                    Role</h3>
                <div class="role-badge px-4 py-2 rounded-full text-sm inline-block text-white font-medium">
                    Frontend Lead Developer
                </div>
            </div>

            <!-- Social Links -->
            <div class="pt-4 border-t border-gray-700/30">
                <div class="social-links flex justify-center space-x-6">
                    <!-- GitHub -->
                    <a href="https://github.com/johndoe" class="text-gray-400 hover:text-white">
                        <i class="fab fa-github text-xl"></i>
                    </a>

                    <!-- Twitter -->
                    <a href="https://twitter.com/johndoe" class="text-gray-400 hover:text-white">
                        <i class="fab fa-twitter text-xl"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <?php
    require './footer.php';
    ?>

    <script>
        // Apply theme from localStorage
        document.addEventListener('DOMContentLoaded', function () {
            const currentTheme = localStorage.getItem('theme') || 'dark';
            document.documentElement.classList.toggle('light-mode', currentTheme === 'light');
        });
    </script>
</body>

</html>
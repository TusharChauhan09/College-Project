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
            <div class="flex justify-center mb-6">
                <div
                    class="profile-image-wrap rounded-full bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500 p-1">
                    <div class="rounded-full overflow-hidden h-24 w-24">
                        <img src="
                        data:image/jpeg;base64,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
                        "
                            class="profile-image w-full h-full object-cover" alt="Profile Image">
                    </div>
                </div>
            </div>
            <div class="text-center mb-6">
                <h2
                    class="text-2xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-indigo-400 to-purple-400 mb-2">
                    Tushar</h2>
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


            <div class="mb-6">
                <h3
                    class="text-lg font-semibold mb-2 text-transparent bg-clip-text bg-gradient-to-r from-purple-400 to-pink-400">
                    Role</h3>
                <div class="role-badge px-4 py-2 rounded-full text-sm inline-block text-white font-medium">
                    Frontend Developer
                </div>
            </div>

            <div class="pt-4 border-t border-gray-700/30">
                <div class="social-links flex justify-center space-x-6">
                    <a href="https://github.com/tusharchauhan09" class="text-gray-400 hover:text-white">
                        <i class="fab fa-github text-xl"></i>
                    </a>

                    <a href="https://twitter.com/johndoe" class="text-gray-400 hover:text-white">
                        <i class="fab fa-twitter text-xl"></i>
                    </a>
                </div>
            </div>
        </div>

        <div class="team-card rounded-xl shadow-xl overflow-hidden max-w-sm w-full text-gray-100 p-6">
            <div class="flex justify-center mb-6">
                <div
                    class="profile-image-wrap rounded-full bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500 p-1">
                    <div class="rounded-full overflow-hidden h-24 w-24">
                        <img src="
                        data:image/jpeg;base64,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
                        "
                            class="profile-image w-full h-full object-cover" alt="Profile Image">
                    </div>
                </div>
            </div>
                <div class="text-center mb-6">
                <h2
                    class="text-2xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-indigo-400 to-purple-400 mb-2">
                    Vansh Tyagi</h2>
                <div class="flex justify-center space-x-4 text-sm text-gray-400">
                    <div>
                        <div class="flex justify-center gap-x-1 text-[20px]">
                            <p class="font-bold">Reg. No.</p>
                            <p>12309113</p>
                        </div>
                        <div class="flex justify-center gap-x-1 text-[20px]">
                            <p class="font-bold">Roll No.</p>
                            <p>11</p>
                        </div>
                    </div>
                </div>
            </div>


            <div class="mb-6">
                <h3
                    class="text-lg font-semibold mb-2 text-transparent bg-clip-text bg-gradient-to-r from-purple-400 to-pink-400">
                    Role</h3>
                <div class="role-badge px-4 py-2 rounded-full text-sm inline-block text-white font-medium">
                    Frontend Developer
                </div>
            </div>

            <div class="pt-4 border-t border-gray-700/30">
                <div class="social-links flex justify-center space-x-6">
                    <a href="https://github.com/tusharchauhan09" class="text-gray-400 hover:text-white">
                        <i class="fab fa-github text-xl"></i>
                    </a>

                    <a href="https://twitter.com/johndoe" class="text-gray-400 hover:text-white">
                        <i class="fab fa-twitter text-xl"></i>
                    </a>
                </div>
            </div>
        </div>

        <div class="team-card rounded-xl shadow-xl overflow-hidden max-w-sm w-full text-gray-100 p-6">
            <div class="flex justify-center mb-6">
                <div
                    class="profile-image-wrap rounded-full bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500 p-1">
                    <div class="rounded-full overflow-hidden h-24 w-24">
                        <img src="
                        data:image/jpeg;base64,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
                        "
                            class="profile-image w-full h-full object-cover" alt="Profile Image">
                    </div>
                </div>
            </div>
            <div class="text-center mb-6">
                <h2
                    class="text-2xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-indigo-400 to-purple-400 mb-2">
                    Anurag sharma </h2>
                <div class="flex justify-center space-x-4 text-sm text-gray-400">
                    <div>
                        <div class="flex justify-center gap-x-1 text-[20px]">
                            <p class="font-bold">Reg. No.</p>
                            <p>12307669</p>
                        </div>
                        <div class="flex justify-center gap-x-1 text-[20px]">
                            <p class="font-bold">Roll No.</p>
                            <p></p>
                        </div>
                    </div>
                </div>
            </div>


            <div class="mb-6">
                <h3
                    class="text-lg font-semibold mb-2 text-transparent bg-clip-text bg-gradient-to-r from-purple-400 to-pink-400">
                    Role</h3>
                <div class="role-badge px-4 py-2 rounded-full text-sm inline-block text-white font-medium">
                    Frontend Developer
                </div>
            </div>

            <div class="pt-4 border-t border-gray-700/30">
                <div class="social-links flex justify-center space-x-6">
                    <a href="https://github.com/tusharchauhan09" class="text-gray-400 hover:text-white">
                        <i class="fab fa-github text-xl"></i>
                    </a>

                    <a href="https://twitter.com/johndoe" class="text-gray-400 hover:text-white">
                        <i class="fab fa-twitter text-xl"></i>
                    </a>
                </div>
            </div>
        </div>

        <div class="team-card rounded-xl shadow-xl overflow-hidden max-w-sm w-full text-gray-100 p-6">
            <div class="flex justify-center mb-6">
                <div
                    class="profile-image-wrap rounded-full bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500 p-1">
                    <div class="rounded-full overflow-hidden h-24 w-24">
                        <img src="
                        data:image/jpeg;base64,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
                        "
                            class="profile-image w-full h-full object-cover" alt="Profile Image">
                    </div>
                </div>
            </div>
            <div class="text-center mb-6">
                <h2
                    class="text-2xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-indigo-400 to-purple-400 mb-2">
                    Harsh Kumar </h2>
                <div class="flex justify-center space-x-4 text-sm text-gray-400">
                    <div>
                        <div class="flex justify-center gap-x-1 text-[20px]">
                            <p class="font-bold">Reg. No.</p>
                            <p>12307768</p>
                        </div>
                        <div class="flex justify-center gap-x-1 text-[20px]">
                            <p class="font-bold">Roll No.</p>
                            <p>33</p>
                        </div>
                    </div>
                </div>
            </div>


            <div class="mb-6">
                <h3
                    class="text-lg font-semibold mb-2 text-transparent bg-clip-text bg-gradient-to-r from-purple-400 to-pink-400">
                    Role</h3>
                <div class="role-badge px-4 py-2 rounded-full text-sm inline-block text-white font-medium">
                    Frontend Developer
                </div>
            </div>

            <div class="pt-4 border-t border-gray-700/30">
                <div class="social-links flex justify-center space-x-6">
                    <a href="https://github.com/tusharchauhan09" class="text-gray-400 hover:text-white">
                        <i class="fab fa-github text-xl"></i>
                    </a>

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
        document.addEventListener('DOMContentLoaded', function () {
            const currentTheme = localStorage.getItem('theme') || 'dark';
            document.documentElement.classList.toggle('light-mode', currentTheme === 'light');
        });
    </script>
</body>

</html>
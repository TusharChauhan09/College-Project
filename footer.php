<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="src/output.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        .footer-gradient {
            background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%);
        }

        .social-icon {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
        }

        .social-icon:hover {
            transform: translateY(-5px);
        }

        .social-icon::after {
            content: '';
            position: absolute;
            width: 100%;
            height: 100%;
            background: currentColor;
            border-radius: 50%;
            opacity: 0.1;
            transform: scale(0);
            transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .social-icon:hover::after {
            transform: scale(1.5);
        }

        .footer-link {
            transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            display: inline-block;
        }

        .footer-link::after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            bottom: -2px;
            left: 0;
            background: linear-gradient(90deg, #3b82f6, #60a5fa);
            transition: width 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .footer-link:hover::after {
            width: 100%;
        }

        .contact-icon {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .contact-icon:hover {
            transform: scale(1.1) rotate(5deg);
        }

        .section-border {
            border-color: rgba(148, 163, 184, 0.1);
        }

        .copyright-bg {
            background: rgba(15, 23, 42, 0.5);
            backdrop-filter: blur(8px);
        }

        @keyframes float {
            0% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-5px);
            }

            100% {
                transform: translateY(0px);
            }
        }

        .float-animation {
            animation: float 3s ease-in-out infinite;
        }

        /* Light mode styles */
        html.light-mode .footer-gradient {
            background: linear-gradient(135deg, #dbd6b2 0%, #c5c1a0 100%);
            color: #334155;
        }

        html.light-mode .text-gray-300 {
            color: #475569;
        }

        html.light-mode .text-blue-200 {
            color: #1e40af;
        }

        html.light-mode .text-blue-400 {
            color: #3b82f6;
        }

        html.light-mode .text-gray-400 {
            color: #64748b;
        }

        html.light-mode .text-indigo-400 {
            color: #4f46e5;
        }

        html.light-mode .text-indigo-300 {
            color: #6366f1;
        }

        html.light-mode .text-blue-300 {
            color: #3b82f6;
        }

        html.light-mode .border-gray-700\/50 {
            border-color: rgba(197, 193, 160, 0.5);
        }

        html.light-mode .section-border {
            border-color: rgba(148, 163, 184, 0.2);
        }

        html.light-mode .copyright-bg {
            background: rgba(219, 214, 178, 0.7);
        }
    </style>
</head>

<body>
    <footer class="footer-gradient text-gray-300 w-full">
        <section class="flex flex-col md:flex-row justify-center md:justify-between p-6 border-b section-border">
            <div class="hidden md:block">
                <span class="text-lg font-medium text-blue-200">Get connected with us on social networks:</span>
            </div>

            <div class="flex space-x-6 mt-4 md:mt-0">
                <a href="#" class="social-icon text-blue-400 hover:text-blue-300">
                    <i class="fab fa-facebook-f text-xl"></i>
                </a>
                <a href="#" class="social-icon text-sky-400 hover:text-sky-300">
                    <i class="fab fa-twitter text-xl"></i>
                </a>
                <a href="#" class="social-icon text-red-400 hover:text-red-300">
                    <i class="fab fa-google text-xl"></i>
                </a>
                <a href="#" class="social-icon text-pink-400 hover:text-pink-300">
                    <i class="fab fa-instagram text-xl"></i>
                </a>
                <a href="#" class="social-icon text-blue-400 hover:text-blue-300">
                    <i class="fab fa-linkedin text-xl"></i>
                </a>
                <a href="#" class="social-icon text-gray-400 hover:text-gray-300">
                    <i class="fab fa-github text-xl"></i>
                </a>
            </div>
        </section>

        <section class="container mx-auto text-center md:text-left py-12 px-4">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-10">
                <!-- Company Info -->
                <div>
                    <h6 class="text-2xl font-bold mb-6 flex items-center text-blue-200">
                        <i class="fas fa-gem mr-3 text-blue-400 float-animation"></i>Jobify
                    </h6>
                    
                </div>

                <div>
                    <h6 class="text-2xl font-bold mb-6 text-blue-200">Products</h6>
                    <ul class="space-y-3">
                        <li><a href="#" class="footer-link text-gray-400 hover:text-blue-300">Home</a></li>
                        <li><a href="#" class="footer-link text-gray-400 hover:text-blue-300">About</a></li>
                        <li><a href="#" class="footer-link text-gray-400 hover:text-blue-300">Profile</a></li>
                        <li><a href="#" class="footer-link text-gray-400 hover:text-blue-300">chat</a></li>
                    </ul>
                </div>

                <div>
                    <h6 class="text-2xl font-bold mb-6 text-blue-200">Useful Links</h6>
                    <ul class="space-y-3">
                        <li><a href="#" class="footer-link text-gray-400 hover:text-blue-300">Pricing</a></li>
                        <li><a href="#" class="footer-link text-gray-400 hover:text-blue-300">Settings</a></li>
                        <li><a href="#" class="footer-link text-gray-400 hover:text-blue-300">Orders</a></li>
                        <li><a href="#" class="footer-link text-gray-400 hover:text-blue-300">Help</a></li>
                    </ul>
                </div>

                <div>
                    <h6 class="text-2xl font-bold mb-6 text-blue-200">Contact</h6>
                    <ul class="space-y-3">
                        <li class="flex items-center group">
                            <i class="fas fa-home mr-3 contact-icon text-blue-400 group-hover:text-blue-300"></i>
                            <span class="text-gray-400 group-hover:text-blue-300 transition-colors">New York, NY 10012,
                                US</span>
                        </li>
                        <li class="flex items-center group">
                            <i class="fas fa-envelope mr-3 contact-icon text-blue-400 group-hover:text-blue-300"></i>
                            <span
                                class="text-gray-400 group-hover:text-blue-300 transition-colors">info@example.com</span>
                        </li>
                        <li class="flex items-center group">
                            <i class="fas fa-phone mr-3 contact-icon text-blue-400 group-hover:text-blue-300"></i>
                            <span class="text-gray-400 group-hover:text-blue-300 transition-colors">+ 01 234 567
                                88</span>
                        </li>
                        <li class="flex items-center group">
                            <i class="fas fa-print mr-3 contact-icon text-blue-400 group-hover:text-blue-300"></i>
                            <span class="text-gray-400 group-hover:text-blue-300 transition-colors">+ 01 234 567
                                89</span>
                        </li>
                    </ul>
                </div>
            </div>
        </section>

        <div class="text-center p-6 copyright-bg text-gray-400">
            <p>&copy; 2023 Copyright:
                <a class="text-blue-400 font-bold hover:text-blue-300 transition-colors" href="#">Jobify</a>
            </p>
        </div>
    </footer>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const currentTheme = localStorage.getItem('theme') || 'dark';
            document.documentElement.classList.toggle('light-mode', currentTheme === 'light');
        });
    </script>
</body>

</html>
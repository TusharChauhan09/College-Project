<?php require './auth.php' ; ?>


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
            /* #blob1 {
                overflow: hidden;
                width: 16rem;
                height: 16rem;
                border-radius: 42% 56% 72% 28% / 42% 42% 56% 48%;
                background: url(https://images.unsplash.com/photo-1438761681033-6461ffad8d80?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D);
                background-size: cover;
                background-position: center;
                animation: morph1 3.75s linear infinite;
            }

            #blob2 {
                overflow: hidden;
                width: 16rem;
                height: 16rem;
                border-radius: 42% 56% 72% 28% / 42% 42% 56% 48%;
                background: url(https://images.unsplash.com/photo-1438761681033-6461ffad8d80?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D);
                background-size: cover;
                background-position: center;
                animation: morph2 3.75s linear infinite;
            }

            #blob3 {
                overflow: hidden;
                width: 16rem;
                height: 16rem;
                border-radius: 42% 56% 72% 28% / 42% 42% 56% 48%;
                background: url(https://images.unsplash.com/photo-1438761681033-6461ffad8d80?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D);
                background-size: cover;
                background-position: center;
                animation: morph2 3.75s linear infinite;
            }

            #blob4 {
                overflow: hidden;
                width: 16rem;
                height: 16rem;
                border-radius: 42% 56% 72% 28% / 42% 42% 56% 48%;
                background: url(https://images.unsplash.com/photo-1438761681033-6461ffad8d80?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D);
                background-size: cover;
                background-position: center;
                animation: morph1 3.75s linear infinite;
            }

            @keyframes morph1 {
                0% {
                    border-radius: 42% 56% 72% 28% / 42% 42% 56% 48%;
                }

                35% {
                    border-radius: 72% 36% 41% 46% / 72% 41% 72% 37%;
                }

                66% {
                    border-radius: 100% 56% 56% 100% / 100% 100% 56% 36%;
                }
            }

            @keyframes morph2 {
                0% {
                    border-radius: 30% 23% 80% 24% / 32% 42% 53% 89%;
                }

                35% {
                    border-radius: 72% 36% 41% 46% / 72% 41% 93% 23%;
                }

                66% {
                    border-radius: 80% 36% 16% 90% / 90% 80% 32% 36%;
                }

                90% {
                    border-radius: 100% 36% 16% 100% / 100% 100% 89% 76%;
                }
            } */
        </style>
    </head>

    <body class=" bg-black ">

        <?php require './nav.php';
        echo '<br><br><br>';
        ?>

        <div class=" relative  ">
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
                        href="/project">Get Started</a>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 place-items-center gap-10 my-5 container mx-auto px-4">
            <!-- 1 -->
            <div class="bg-gray-900 rounded-xl shadow-xl overflow-hidden max-w-sm w-full text-gray-100 p-6">
                <!-- Profile Image -->
                <div class="flex justify-center mb-6">
                    <div class="rounded-full bg-gray-800 border-2 border-indigo-500 h-24 w-24 overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1438761681033-6461ffad8d80?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                            class="w-full h-full object-cover" alt="Profile Image">
                    </div>
                </div>
                <!-- Name and IDs -->
                <div class="text-center mb-6">
                    <h2 class="text-2xl font-bold text-white mb-2">John Doe</h2>
                    <div class="flex justify-center space-x-4 text-sm text-gray-400">
                        <div>
                            <div class=" flex  justify-center gap-x-1 text-[20px ]  ">
                                <p class=" font-bold  ">Reg. No.</p>
                                </>
                                <p class="">12310419</p>
                            </div>
                            <div class=" flex  justify-center gap-x-1 text-[20px ] ">
                                <p class=" font-bold  ">Roll No.</p>
                                </p>
                                <p class="">10</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Description -->
                <div class="mb-6">
                    <h3 class="text-lg font-semibold mb-2 text-indigo-300">About</h3>
                    <p class="text-gray-400 text-sm">
                        A passionate software developer with expertise in front-end technologies. Focused on
                        creating accessible
                        and responsive user interfaces with attention to detail and performance optimization.
                    </p>
                </div>

                <!-- Role -->
                <div class="mb-6">
                    <h3 class="text-lg font-semibold mb-2 text-indigo-300">Project Role</h3>
                    <div class="bg-indigo-900 text-indigo-200 px-4 py-1 rounded-full text-sm inline-block">
                        Frontend Lead Developer
                    </div>
                </div>

                <!-- Social Links -->
                <div class="pt-4 border-t border-gray-700">
                    <div class="flex justify-center space-x-6">
                        <!-- GitHub -->
                        <a href="https://github.com/johndoe" class="text-gray-400 hover:text-white transition-colors">
                            <i class="fab fa-github text-xl"></i>
                        </a>

                        <!-- Twitter -->
                        <a href="https://twitter.com/johndoe" class="text-gray-400 hover:text-white transition-colors">
                            <i class="fab fa-twitter text-xl"></i>
                        </a>
                    </div>
                </div>
            </div>

            <!-- 2 -->
            <div class="bg-gray-900 rounded-xl shadow-xl overflow-hidden max-w-sm w-full text-gray-100 p-6">
                    <!-- Profile Image -->
                    <div class="flex justify-center mb-6">
                        <div class="rounded-full bg-gray-800 border-2 border-indigo-500 h-24 w-24 overflow-hidden">
                            <img src="https://images.unsplash.com/photo-1438761681033-6461ffad8d80?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                                class="w-full h-full object-cover" alt="Profile Image">
                        </div>
                    </div>
                    <!-- Name and IDs -->
                    <div class="text-center mb-6">
                        <h2 class="text-2xl font-bold text-white mb-2">John Doe</h2>
                        <div class="flex justify-center space-x-4 text-sm text-gray-400">
                            <div>
                                <div class=" flex  justify-center gap-x-1 text-[20px ]  ">
                                    <p class=" font-bold  ">Reg. No.</p>
                                    </p>
                                    <p class="">12310419</p>
                                </div>
                                <div class=" flex  justify-center gap-x-1 text-[20px ] ">
                                    <p class=" font-bold  ">Roll No.</p>
                                    </p>
                                    <p class="">10</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Description -->
                    <div class="mb-6">
                        <h3 class="text-lg font-semibold mb-2 text-indigo-300">About</h3>
                        <p class="text-gray-400 text-sm">
                            A passionate software developer with expertise in front-end technologies. Focused on
                            creating accessible
                            and responsive user interfaces with attention to detail and performance optimization.
                        </p>
                    </div>

                    <!-- Role -->
                    <div class="mb-6">
                        <h3 class="text-lg font-semibold mb-2 text-indigo-300">Project Role</h3>
                        <div class="bg-indigo-900 text-indigo-200 px-4 py-1 rounded-full text-sm inline-block">
                            Frontend Lead Developer
                        </div>
                    </div>

                    <!-- Social Links -->
                    <div class="pt-4 border-t border-gray-700">
                        <div class="flex justify-center space-x-6">
                            <!-- GitHub -->
                            <a href="https://github.com/johndoe"
                                class="text-gray-400 hover:text-white transition-colors">
                                <i class="fab fa-github text-xl"></i>
                            </a>

                            <!-- Twitter -->
                            <a href="https://twitter.com/johndoe"
                                class="text-gray-400 hover:text-white transition-colors">
                                <i class="fab fa-twitter text-xl"></i>
                            </a>
                        </div>
                    </div>
            </div>

            <!-- 3 -->
            <div class="bg-gray-900 rounded-xl shadow-xl overflow-hidden max-w-sm w-full text-gray-100 p-6">
                    <!-- Profile Image -->
                    <div class="flex justify-center mb-6">
                        <div class="rounded-full bg-gray-800 border-2 border-indigo-500 h-24 w-24 overflow-hidden">
                            <img src="https://images.unsplash.com/photo-1438761681033-6461ffad8d80?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                                class="w-full h-full object-cover" alt="Profile Image">
                        </div>
                    </div>
                    <!-- Name and IDs -->
                    <div class="text-center mb-6">
                        <h2 class="text-2xl font-bold text-white mb-2">John Doe</h2>
                        <div class="flex justify-center space-x-4 text-sm text-gray-400">
                            <div>
                                <div class=" flex  justify-center gap-x-1 text-[20px ]  ">
                                    <p class=" font-bold  ">Reg. No.</p>
                                    </p>
                                    <p class="">12310419</p>
                                </div>
                                <div class=" flex  justify-center gap-x-1 text-[20px ] ">
                                    <p class=" font-bold  ">Roll No.</p>
                                    </p>
                                    <p class="">10</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Description -->
                    <div class="mb-6">
                        <h3 class="text-lg font-semibold mb-2 text-indigo-300">About</h3>
                        <p class="text-gray-400 text-sm">
                            A passionate software developer with expertise in front-end technologies. Focused on
                            creating accessible
                            and responsive user interfaces with attention to detail and performance optimization.
                        </p>
                    </div>

                    <!-- Role -->
                    <div class="mb-6">
                        <h3 class="text-lg font-semibold mb-2 text-indigo-300">Project Role</h3>
                        <div class="bg-indigo-900 text-indigo-200 px-4 py-1 rounded-full text-sm inline-block">
                            Frontend Lead Developer
                        </div>
                    </div>

                    <!-- Social Links -->
                    <div class="pt-4 border-t border-gray-700">
                        <div class="flex justify-center space-x-6">
                            <!-- GitHub -->
                            <a href="https://github.com/johndoe"
                                class="text-gray-400 hover:text-white transition-colors">
                                <i class="fab fa-github text-xl"></i>
                            </a>

                            <!-- Twitter -->
                            <a href="https://twitter.com/johndoe"
                                class="text-gray-400 hover:text-white transition-colors">
                                <i class="fab fa-twitter text-xl"></i>
                            </a>
                        </div>
                    </div>
            </div>

            <!-- 4 -->
            <div class="bg-gray-900 rounded-xl shadow-xl overflow-hidden max-w-sm w-full text-gray-100 p-6">
                    <!-- Profile Image -->
                    <div class="flex justify-center mb-6">
                        <div class="rounded-full bg-gray-800 border-2 border-indigo-500 h-24 w-24 overflow-hidden">
                            <img src="https://images.unsplash.com/photo-1438761681033-6461ffad8d80?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                                class="w-full h-full object-cover" alt="Profile Image">
                        </div>
                    </div>
                    <!-- Name and IDs -->
                    <div class="text-center mb-6">
                        <h2 class="text-2xl font-bold text-white mb-2">John Doe</h2>
                        <div class="flex justify-center space-x-4 text-sm text-gray-400">
                            <div>
                                <div class=" flex  justify-center gap-x-1 text-[20px ]  ">
                                    <p class=" font-bold  ">Reg. No.</p>
                                    </p>
                                    <p class="">12310419</p>
                                </div>
                                <div class=" flex  justify-center gap-x-1 text-[20px ] ">
                                    <p class=" font-bold  ">Roll No.</p>
                                    </p>
                                    <p class="">10</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Description -->
                    <div class="mb-6">
                        <h3 class="text-lg font-semibold mb-2 text-indigo-300">About</h3>
                        <p class="text-gray-400 text-sm">
                            A passionate software developer with expertise in front-end technologies. Focused on
                            creating accessible
                            and responsive user interfaces with attention to detail and performance optimization.
                        </p>
                    </div>

                    <!-- Role -->
                    <div class="mb-6">
                        <h3 class="text-lg font-semibold mb-2 text-indigo-300">Project Role</h3>
                        <div class="bg-indigo-900 text-indigo-200 px-4 py-1 rounded-full text-sm inline-block">
                            Frontend Lead Developer
                        </div>
                    </div>

                    <!-- Social Links -->
                    <div class="pt-4 border-t border-gray-700">
                        <div class="flex justify-center space-x-6">
                            <!-- GitHub -->
                            <a href="https://github.com/johndoe"
                                class="text-gray-400 hover:text-white transition-colors">
                                <i class="fab fa-github text-xl"></i>
                            </a>

                            <!-- Twitter -->
                            <a href="https://twitter.com/johndoe"
                                class="text-gray-400 hover:text-white transition-colors">
                                <i class="fab fa-twitter text-xl"></i>
                            </a>
                        </div>
                    </div>
            </div>
        </div>

        <?php
        require './footer.php';
        ?>

    </body>
    </body>

    </html>
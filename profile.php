<?php
require './auth.php';

if (isset($_POST['submit'])) {
    $file_name1 = $_FILES['profile']['name'];
    $tmp_name1 = $_FILES['profile']['tmp_name'];

    $file_name2 = $_FILES['resume']['name'];
    $tmp_name2 = $_FILES['resume']['tmp_name'];

    $folder1 = 'Profile/' . $file_name1;
    $folder2 = 'Resume/' . $file_name2;
    $post = $_POST['post'];
    $about = $_POST['about'];

    $email = $_SESSION['email'];


    $check = mysqli_query($conn, "SELECT * FROM application WHERE a_email = '$email'");
    if (mysqli_num_rows($check) > 0) {
        // Email exists, update the record
        $query = mysqli_query($conn, "UPDATE application SET 
                a_post = '$post', 
                a_about = '$about', 
                a_resume = '$file_name2', 
                a_profile = '$file_name1'
                WHERE a_email = '$email'");
    } else {
        // Email does not exist, insert new record
        $query = mysqli_query($conn, "INSERT INTO application (a_post, a_about, a_resume, a_profile, a_email) 
            VALUES ('$post', '$about', '$file_name2', '$file_name1', '$email')");
    }

    if (move_uploaded_file($tmp_name1, $folder1) && move_uploaded_file($tmp_name2, $folder2)) {
        echo "<h2>suc</h2>";
    } else {
        echo "<h2>fail</h2>";
    }
}

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
    <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/particles.js/2.0.0/particles.min.js"></script>
    <style>
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

        .profile-card {
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            transition: all 0.6s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            transform-style: preserve-3d;
            perspective: 1500px;
            position: relative;
            z-index: 10;
            opacity: 1;
            visibility: visible;
        }

        .profile-card:hover {
            transform: translateY(-8px) rotateX(5deg) rotateY(5deg);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
        }

        .profile-image-container {
            position: relative;
            z-index: 1;
            width: 128px;
            height: 128px;
            border-radius: 50%;
            overflow: hidden;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            padding: 3px;
            background: linear-gradient(45deg, #3b82f6, #8b5cf6, #ec4899);
            flex-shrink: 0;
        }

        .profile-image {
            transition: transform 0.3s ease;
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 50%;
            border: 3px solid #1f2937;
            aspect-ratio: 1/1;
        }

        .profile-image:hover {
            transform: scale(1.1);
        }

        .badge {
            position: relative;
            overflow: hidden;
        }

        .badge::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: linear-gradient(45deg,
                    transparent,
                    rgba(255, 255, 255, 0.1),
                    transparent);
            transform: rotate(45deg);
            animation: shine 3s infinite;
        }

        @keyframes shine {
            0% {
                transform: translateX(-100%) rotate(45deg);
            }

            100% {
                transform: translateX(100%) rotate(45deg);
            }
        }

        .update-btn {
            position: relative;
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .update-btn::after {
            content: '';
            position: absolute;
            width: 100%;
            height: 100%;
            top: 0;
            left: -100%;
            background: linear-gradient(90deg,
                    transparent,
                    rgba(255, 255, 255, 0.2),
                    transparent);
            transition: 0.5s;
        }

        .update-btn:hover::after {
            left: 100%;
        }

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

        body {
            min-height: 100vh;
            width: 100vw;
            overflow-x: hidden;
            position: relative;
        }

        /* Light mode styles */
        :root {
            --bg-gradient-dark: linear-gradient(to bottom right, #111827, #1f2937, #111827);
            --bg-gradient-light: linear-gradient(to bottom right, #dbd6b2, #c5c1a0, #dbd6b2);
            --card-bg-dark: linear-gradient(to bottom right, rgba(17, 24, 39, 0.8), rgba(31, 41, 55, 0.8));
            --card-bg-light: linear-gradient(to bottom right, rgba(219, 214, 178, 0.8), rgba(197, 193, 160, 0.8));
            --card-border-dark: rgba(75, 85, 99, 0.3);
            --card-border-light: rgba(197, 193, 160, 0.5);
            --text-primary-dark: #f3f4f6;
            --text-primary-light: #0f172a;
            --text-secondary-dark: #9ca3af;
            --text-secondary-light: #334155;
        }

        /* Apply theme styles */
        html.light-mode body {
            background: var(--bg-gradient-light);
            color: var(--text-primary-light);
        }

        html.light-mode .profile-card {
            background: var(--card-bg-light);
            border-color: var(--card-border-light);
            color: var(--text-primary-light);
        }

        html.light-mode .profile-image {
            border-color: #e2e8f0;
        }

        html.light-mode .aurora__item {
            opacity: 0.05;
        }

        /* Add responsive styles */
        @media (max-width: 640px) {
            .result {
                flex-direction: column;
                padding: 1rem;
            }

            .profile-card {
                width: 100%;
                margin-bottom: 2rem;
            }
        }
    </style>
</head>

<body class="overflow-x-hidden bg-gradient-to-br from-gray-900 via-gray-800 to-gray-900 min-h-screen w-full">
    <div id="particles-js"></div>
    <div class="aurora">
        <div class="aurora__item"></div>
        <div class="aurora__item"></div>
    </div>


    <div class="relative top-0 w-full">
        <?php require './nav.php'; ?>
    </div>

    <div class="result relative z-20 sm:flex-col md:flex md:flex-row justify-center gap-8 m-10 mb-48">
        <div
            class="profile-card w-100 h-auto bg-gradient-to-br from-gray-900/80 to-gray-800/80 rounded-3xl shadow-2xl border border-gray-700/30 flex flex-col items-center justify-center p-8 relative overflow-hidden flex-shrink-0">
            <div class="profile-image-container mb-6">
                <img src="Profile/<?php echo $row['a_profile'] ?>" alt="Profile" class="profile-image">
            </div>

            <div class="text-center relative z-10">
                <h2
                    class="text-3xl font-bold bg-gradient-to-r from-blue-400 via-purple-400 to-pink-400 bg-clip-text text-transparent mb-3">
                    <?php
                    $res = mysqli_query($conn, " SELECT * FROM user WHERE email = '$email' ");
                    while ($row = mysqli_fetch_array($res)) {
                        echo $row['name'];
                    }
                    ?>
                </h2>

                <div
                    class="flex items-center justify-center mt-3 text-gray-300 text-sm backdrop-blur-sm bg-white/5 rounded-full px-4 py-2">
                    <i class="fa-regular fa-calendar mr-2 text-blue-400"></i>
                    <span>
                        <?php
                        $res = mysqli_query($conn, " SELECT * FROM application WHERE a_email = '$email' ");
                        while ($row = mysqli_fetch_array($res)) {
                            echo $row['a_date'];
                        }
                        ?>
                    </span>
                </div>

                <div class="mt-6 space-y-3">
                    <div
                        class="badge inline-block bg-gradient-to-r from-blue-600/90 to-indigo-600/90 text-white text-sm font-medium px-5 py-2 rounded-full shadow-lg backdrop-blur-sm">
                        <?php
                        $res = mysqli_query($conn, " SELECT * FROM application WHERE a_email = '$email' ");
                        while ($row = mysqli_fetch_array($res)) {
                            echo $row['a_post'];
                        }
                        ?>
                    </div>

                    <div>
                        <div
                            class="badge inline-block bg-gradient-to-r from-purple-600/90 to-pink-600/90 text-white text-sm font-medium px-5 py-2 rounded-full shadow-lg backdrop-blur-sm">
                            <?php
                            $res = mysqli_query($conn, " SELECT * FROM application WHERE a_email = '$email' ");
                            while ($row = mysqli_fetch_array($res)) {
                                echo $row['a_role'];
                            }
                            ?>
                        </div>
                    </div>
                </div>

                <div class="card my-2">
                    <button onclick="loadApplication()"
                        class="update-btn px-8 py-3 bg-gradient-to-r from-purple-600 to-pink-600 hover:from-purple-500 hover:to-pink-500 text-white font-medium rounded-full shadow-lg transition-all duration-300 hover:-translate-y-1 hover:shadow-2xl">
                        <i class="fa-solid fa-pen-to-square mr-2"></i>
                        Update Profile
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="relative bottom-0 w-full z-10 mt-20">
        <?php require './footer.php'; ?>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js"></script>
    <script src="./loadApplication.js"></script>

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

        function applyTheme() {
            const currentTheme = localStorage.getItem('theme') || 'dark';
            document.documentElement.classList.toggle('light-mode', currentTheme === 'light');

            if (currentTheme === 'light') {
                if (window.pJSDom && window.pJSDom[0] && window.pJSDom[0].pJS) {
                    window.pJSDom[0].pJS.particles.color.value = '#475569';
                }
            }
        }

        document.addEventListener('DOMContentLoaded', function () {
            applyTheme();
        });

        document.addEventListener('DOMContentLoaded', function () {
            const profileCard = document.querySelector('.profile-card');
            if (profileCard) {
                profileCard.style.opacity = '1';
                profileCard.style.visibility = 'visible';
            }

            const tl = gsap.timeline({
                defaults: { ease: 'power3.out' },
                onStart: function () {
                    gsap.set(['.profile-card', '.profile-image-container', '.text-center > *', '.badge', '.update-btn'], {
                        visibility: 'visible',
                        opacity: 1
                    });
                }
            });

            tl.from('.aurora__item', {
                opacity: 0,
                duration: 2,
                stagger: 0.3
            })
                .from('.profile-card', {
                    y: 50,
                    opacity: 0,
                    duration: 1.2,
                    backdropFilter: 'blur(0px)',
                }, '-=1.5')
                .from('.profile-image-container', {
                    opacity: 0,
                    duration: 0.8,
                }, '-=0.8')
                .from('.text-center > *', {
                    y: 30,
                    opacity: 0,
                    duration: 0.8,
                    stagger: 0.2
                }, '-=0.5')
                .from('.badge', {
                    scale: 0.8,
                    opacity: 0,
                    duration: 0.6,
                    stagger: 0.2,
                    ease: 'back.out(1.7)'
                }, '-=0.5')
                .from('.update-btn', {
                    y: 20,
                    opacity: 0,
                    duration: 0.6,
                    ease: 'back.out(1.7)'
                }, '-=0.3');
        });
    </script>
</body>

</html>



<!--  add this in profile  -->
<!-- and add a change button to eddit it and remove session  -->
<!-- if not session then only be edditted else not -->
<!-- if not session then only be edditted else not -->
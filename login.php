<?php
// First, create the database and tables if needed
$conn = require './create_tables.php';

// Start the session if not already started
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$login = false;
$show_error = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Use prepared statement to prevent SQL injection
    $stmt = $conn->prepare("SELECT * FROM user WHERE email=?");
    if (!$stmt) {
        die("Prepare failed: " . $conn->error);
    }
    
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row["password"])) {
            $login = true;
            $_SESSION["loggedin"] = true;
            $_SESSION["email"] = $email;
            header("location: about.php");
            exit();
        } else {
            $show_error = "Invalid Credentials";
            //     $_SESSION["email"] = $email;

            //     $_SESSION['email'] = $email;
            //     header("location: about.php ");
            //   }
            //   else{
            //     $show_error = "Invalid Credentials";
            //   }

        }
    } else {
        $show_error = "Invalid Credentials or Need to Sign-up first";
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
</head>

<body class="overflow-hidden  ">

    <div style="background-image: url('./img/bg1.jpg'); background-size: cover; background-position: center; background-repeat: no-repeat;"
        class="relative flex flex-col min-w-screen h-screen items-center justify-center ">

        <?php
        if ($login) {
            echo '<div class="relative p-4  text-green-800 border border-green-300 rounded-lg bg-green-50" role="alert">
                <strong>Success!</strong> You are Logged-in!!!!
                <button type="button" class="absolute top-2 right-2 text-green-800 hover:text-green-900" onclick="this.parentElement.remove()" aria-label="Close">
                    ✖
                </button>
            </div>';
        }

        if ($show_error) {
            echo '<div class="relative p-4 pr-10  text-red-800 border border-red-700 rounded-lg bg-red-100" role="alert">
                <strong>!</strong> ' . $show_error . '
                <button type="button" class="absolute top-2 right-2 text-red-700 hover:text-red-700" onclick="this.parentElement.remove()" aria-label="Close">
                    ✖
                </button>
              </div>';
        }

        ?>

        <div style="background-image: url('./img/bg1.jpg'); background-size: cover; background-position: center; background-repeat: no-repeat;"
            class="relative flex justify-center items-center min-w-screen h-screen bg-indigo-500  ">
            <div id="b"
                class="flex flex-col lg:flex-row h-4/5 w-4/5 bg-amber-50 rounded-2xl overflow-hidden border shadow-2xl shadow-black z-20  ">
                <div class="bg-white h-full w-full lg:w-2/5 lg:h-full flex flex-col p-4 gap-7">

                    <!-- logo -->
                    <div class="flex justify-between text-3xl mb-[30px]">
                        <i id="drop" class="fa-solid fa-droplet"></i>
                        <i id="water" class="fa-solid fa-water"></i>
                    </div>

                    <!-- signup -->
                    <div id="a" class="flex flex-col items-center mb-[30px]">
                        <div class="font-bold text-5xl">
                            <h1>LogIn</h1>
                        </div>
                        <div>
                            <p>stay connected with us !</p>
                        </div>
                    </div>

                    <!-- form -->
                    <div id="a" class=" flex flex-col justify-center items-center text-2xl ">
                        <form action="/new/login.php" method="post">
                            <div class=" flex gap-[20px] mb-[10px]">
                                <label for="email"><i class="fa-solid fa-envelope"></i></label>
                                <input type="text" id="email" name="email"
                                    class="w-80 h-10 border-2 px-2 placeholder:text-[16px] rounded-xl text-[16px]"
                                    placeholder="email...">
                            </div>
                            <div class=" flex gap-[20px] mb-[40px]">
                                <label class="pr-[3px]" for="password"><i class="fa-solid fa-lock"></i></label>
                                <input type="password" id="password" name="password"
                                    class="w-80 h-10 border-2 px-2 placeholder:text-[16px] text-[16px] rounded-xl "
                                    placeholder="password...">
                            </div>
                            <div class=" flex justify-center ">
                                <button type="submit"
                                    class=" bg-indigo-500 border-2 py-2 px-4 text-[20px] rounded-2xl hover:bg-indigo-600">Login</button>
                            </div>
                        </form>
                    </div>

                    <!-- signup -->
                    <div id="a" class=" flex justify-center  ">
                        <pre>Don't have an account...! </pre><a href="/new/signup.php">
                            <pre class=" text-indigo-800 ">SignUp</pre>
                        </a>
                    </div>

                </div>
                <!-- Image -->
                <div class="bg-pink-400  w-0 lg:w-3/5 lg:h-full flex justify-center items-center">
                    <img src="./img/bg1.jpg" class="w-full h-full" alt="">
                </div>
            </div>
        </div>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js"
            integrity="sha512-7eHRwcbYkK4d9g/6tD/mhkf++eoTHwpNM9woBxtPUBWm67zeAfFC+HrdoE2GanKeocly/VxeLvIqwvCdk7qScg=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script>
            // login sign up
            gsap.from("#b", {
                y: 100,
                duration: 1
            })

            gsap.from("#drop", {
                y: -30,
                duration: 1,
                opacity: 0,
                delay: 1
            })

            gsap.from("#water", {
                x: 30,
                opacity: 0,
                duration: 2,
            })

            gsap.from("#a", {
                y: 100,
                duration: 2,
            })
        </script>
    </div>
    </div>
    </div>
</body>

</html>
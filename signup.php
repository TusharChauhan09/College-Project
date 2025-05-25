<?php
// First, create the database and tables if needed
$conn = require './create_tables.php';

// Start the session if not already started
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$show_alert = false;
$show_error = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $confirmpassword = $_POST['confirmpassword'];
    $permission = mysqli_real_escape_string($conn, $_POST['permission']);

    if ($password != $confirmpassword) {
        $show_error = "Passwords do not match!";
    } else {
        $user_existSql = "SELECT * FROM user WHERE email = ?";
        $stmt = mysqli_prepare($conn, $user_existSql);
        if (!$stmt) {
            die("Prepare failed: " . mysqli_error($conn));
        }
        mysqli_stmt_bind_param($stmt, "s", $email);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $user_exist_num = mysqli_num_rows($result);

        if ($user_exist_num > 0) {
            $show_error = "User already exists";
        } else {
            $hash = password_hash($password, PASSWORD_DEFAULT);

            $sql = "INSERT INTO user (name, email, password, status, date, permission) VALUES (?, ?, ?, ?, current_timestamp(), ?)";
            $stmt = mysqli_prepare($conn, $sql);
            if (!$stmt) {
                die("Prepare failed: " . mysqli_error($conn));
            }
            $status = ($permission == 0) ? 0 : 1;
            mysqli_stmt_bind_param($stmt, "ssssi", $name, $email, $hash, $status, $permission);

            $query = "INSERT INTO application (a_date, a_email, a_role) VALUES (current_timestamp(), ?, ?)";
            $stmt2 = mysqli_prepare($conn, $query);
            if (!$stmt2) {
                die("Prepare failed: " . mysqli_error($conn));
            }
            $status2 = ($permission == 0) ? "Applicant" : "Recruiter";
            mysqli_stmt_bind_param($stmt2, "ss", $email, $status2);
            mysqli_stmt_execute($stmt2);

            if (mysqli_stmt_execute($stmt)) {
                $show_alert = true;

                $login = true;
                session_start();
                $_SESSION["loggedin"] = true;
                $_SESSION["email"] = $email;
                header("location: about.php ");

            } else {
                $show_error = "Can't able to signUp: " . mysqli_error($conn);
            }
        }
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

<body>

    <div style="background-image: url('./img/bg2.jpg'); background-size: cover; background-position: center; background-repeat: no-repeat;"
        class="relative flex flex-col justify-center items-center min-w-screen h-screen ">

        <?php
        if ($show_alert) {
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

        <div style="background-image: url('./img/bg2.jpg'); background-size: cover; background-position: center; background-repeat: no-repeat;"
            class="relative flex justify-center items-center min-w-screen h-screen ">
            <div id="b"
                class="flex flex-col lg:flex-row h-4/5 w-4/5 bg-amber-50 rounded-2xl overflow-hidden border shadow-2xl shadow-black z-20 ">
                <div class="bg-white h-full w-full lg:w-2/5 lg:h-full flex flex-col p-4 gap-7">

                    <!-- logo -->
                    <div class="flex justify-between text-3xl mb-[30px]">
                        <i id="drop" class="fa-solid fa-droplet"></i>
                        <i id="water" class="fa-solid fa-water"></i>
                    </div>

                    <!-- signup -->
                    <div id="a" class="flex flex-col items-center mb-[30px]">
                        <div class="font-bold text-5xl">
                            <h1>SignUp</h1>
                        </div>
                        <div>
                            <p>stay connected with us !</p>
                        </div>
                    </div>

                    <!-- form -->
                    <div id="a" class=" flex flex-col justify-center items-center text-2xl ">
                        <form action="/new/signup.php" method="post">
                            <div class=" flex gap-[13px] mb-[10px]">
                                <label class for="name"><i class="fa-solid fa-signature"></i></label>
                                <input type="text" id="name" name="name"
                                    class="w-80 h-10 border-2 px-2 placeholder:text-[16px] rounded-xl text-[16px]"
                                    placeholder="name...">
                            </div>
                            <div class=" flex gap-[20px] mb-[10px]">
                                <label for="email"><i class="fa-solid fa-envelope"></i></label>
                                <input type="text" id="email" name="email"
                                    class="w-80 h-10 border-2 px-2 placeholder:text-[16px] rounded-xl text-[16px]"
                                    placeholder="email...">
                            </div>
                            <div class=" flex gap-[20px] mb-[10px]">
                                <label class="pr-[3px]" for="password"><i class="fa-solid fa-lock"></i></label>
                                <input type="password" name="password" id="password"
                                    class="w-80 h-10 border-2 px-2 placeholder:text-[16px] text-[16px] rounded-xl "
                                    placeholder="password...">
                            </div>
                            <div class=" flex gap-[20px] mb-[40px]">
                                <input type="password" id="confirmpassword" name="confirmpassword"
                                    class="w-80 h-10 border-2 px-2 placeholder:text-[16px] text-[16px] rounded-xl ml-[44px] "
                                    placeholder="confirm password...">
                            </div>

                            <div class="gap-[10px] mb-[5px] flex justify-center items-center">
                                <label class="text-lg font-bold p-[5px]" for="applicant">Select</label>
                                <div class="flex items-center gap-[5px]">
                                    <input type="radio" name="permission" id="applicant" class="accent-amber-500"
                                        value="0">
                                    <label class="text-[15px]" for="applicant">Applicant</label>
                                </div>
                                <div class="flex items-center gap-[5px]">
                                    <input type="radio" name="permission" id="recruiter" class="accent-amber-500"
                                        value="1">
                                    <label class="text-[15px]" for="recruiter">Recruiter</label>
                                </div>
                            </div>

                            <div class=" flex justify-center ">
                                <button type="sumbit"
                                    class=" bg-amber-400 border-2 py-2 px-4 text-[20px] rounded-2xl hover:bg-amber-600">signup</button>
                            </div>
                        </form>
                    </div>

                    <!-- signup -->
                    <div id="a" class=" flex justify-center  ">
                        <pre>Already have an account...! </pre><a href="login.php">
                            <pre class=" text-amber-400  ">LogIn</pre>
                        </a>
                    </div>

                </div>
                <!-- Image -->
                <div class="bg-pink-400 w-0 lg:w-3/5 lg:h-full flex justify-center items-center">
                    <img src="./img/bg2.jpg" class="w-full h-full " alt="">
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
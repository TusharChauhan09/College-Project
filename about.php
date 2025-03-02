<!doctype html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="src/output.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
  <script src="https://cdn.jsdelivr.net/npm/kute.js@2.1.2/dist/kute.min.js"></script>
  <style>
    .blob {
        overflow: hidden;
        width: 16rem;
        height: 16rem;
        border-radius: 42% 56% 72% 28% / 42% 42% 56% 48%;
        background: url(https://images.unsplash.com/photo-1438761681033-6461ffad8d80?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D);
        background-size: cover;
        background-position: center;
        animation: morph 3.75s linear infinite;
    }

    @keyframes morph {
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

  </style>
</head>
<body class=" bg-black overflow-x-hidden ">

    <?php require './nav.php';
        echo '<br><br><br>';
    ?>

    <div class=" relative ">
        <div class="container">
            <img class=" min-w-screen h-200" src="https://images.unsplash.com/photo-1624139283078-74a0492f2ee3?q=80&w=1227&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="">
        </div>
        <div class=" text-white absolute top-1/2 -translate-y-1/2 left-1/2 -translate-x-1/2 transform ">
            <div class=" flex flex-col justify-center items-center">
                <h1  class=" text-6xl text-white font-bold ">Be Who You</h1>
                <h1 class=" text-6xl text-white font-bold  pb-4">Really Are</h1>
                <pre class="pb-4 " >Cache your next opportunity and unlock a brighter career!</pre>
                <a class="cursor-pointer bg-gray-800 hover:bg-gray-600 transition-all ease-in delay-75  text-white rounded-3xl p-5 " href="/project">Get Started</a> 
            </div>
        </div>
    </div>
    <div class=" min-w-screen container text-white bg-black h-150 ">
        <div class="flex justify-between items-center">
            <!-- <svg id="visual" viewBox="0 0 900 600" width="600" height="400" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1">
                <g transform="translate(460.2970212722319 335.67629382764875)">
                    <path id="blob11" d="M115.9 -130.7C150.7 -81.1 179.9 -40.5 183.9 4C187.9 48.6 166.8 97.1 131.9 122.1C97.1 147.1 48.6 148.6 -11.1 159.6C-70.7 170.7 -141.4 191.4 -175.6 166.4C-209.8 141.4 -207.4 70.7 -201.4 6C-195.4 -58.7 -185.7 -117.4 -151.5 -167C-117.4 -216.7 -58.7 -257.4 -9.1 -248.3C40.5 -239.2 81.1 -180.4 115.9 -130.7" fill="#001122"></path>
                </g>
                <g transform="translate(460.5094619040851 297.2489913240957)" style="visibility: hidden;" >
                    <path id="blob12" d="M120.8 -109.6C163.3 -78.3 209.1 -39.1 223.3 14.1C237.4 67.4 219.8 134.8 177.3 159.8C134.8 184.8 67.4 167.4 7.1 160.3C-53.3 153.3 -106.5 156.5 -156.5 131.5C-206.5 106.5 -253.3 53.3 -248.8 4.5C-244.3 -44.3 -188.6 -88.6 -138.6 -120C-88.6 -151.3 -44.3 -169.6 -2.6 -167.1C39.1 -164.5 78.3 -140.9 120.8 -109.6" fill="#001122"></path>
                </g>
            </svg>
            <script>
                const tween = KUTE.fromTo(
                '#blob11',
                { path: '#blob11' },
                { path: '#blob12' },
                { repeat: 999, duration: 5000, yoyo: true }
                ).start();
            </script> -->
            <div class="blob"></div>
            <div class="blob"></div>
            <div class="blob"></div>
            <div class="blob"></div>
        </div>
    </div>    

    <?php
        require './footer.php';
    ?>

    </body>
</body>
</html>


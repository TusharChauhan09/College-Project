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

<body class=" overflow-x-hidden">

  <div
    class="fixed top-0 z-10  w-full h-[70px] flex justify-between  items-center p-3 bg-gray-900  text-white font-semibold  mb-[40px]  ">
    <!-- logo -->
    <div id="nav" class="flex gap-[30px] text-md">
      <div class="">
        <i class="text-gray-300 hover:text-white fa-solid fa-droplet"></i>
      </div>
      <div>
        <!-- home -->
        <a class="text-gray-300 hover:text-white" href="/project">Home</a>
      </div>
      <div class="">
        <a class="text-gray-300 hover:text-white" href="/project/about.php">About</a>
      </div>
    </div>

    <div id="nav" class=" flex justify-center items-center text-black gap-[40px]  text-md ">
      <div class="hidden md:block relative">
        <input class="w-[300px] border-2 border-black rounded-2xl p-2 bg-gray-700 text-gray-300 hover:bg-gray-800 pr-10"
          type="text" placeholder="Search..." />
        <div class="absolute top-1/2 right-3 transform -translate-y-1/2 text-xl text-gray-300">
          <!-- <i class="fa-solid fa-magnifying-glass"></i> -->
        </div>
      </div>
    </div>

    <div class="flex gap-5 ">
      <a class="text-gray-300 hover:text-white" href="/project/profile.php">Profile</a>
      <a class="text-gray-300 hover:text-white" href="logout.php"> LogOut</a>
    </div>

  </div>

  </div>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js"
    integrity="sha512-7eHRwcbYkK4d9g/6tD/mhkf++eoTHwpNM9woBxtPUBWm67zeAfFC+HrdoE2GanKeocly/VxeLvIqwvCdk7qScg=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script>
    gsap.from("#nav > div", {
      y: -30,
      opacity: 0,
      duration: 2,
      stagger: 0.3,
      ease: "power2.out"
    });
  </script>
</body>

</html>
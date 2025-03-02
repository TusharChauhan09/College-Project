<!doctype html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="src/output.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
</head>
<body class="bg-gray-700 overflow-x-hidden ">
    
    <?php require './nav.php';
        echo '<br><br><br>';
    ?>

    <div class=" flex flex-col md:flex-row items-center justify-around gap-8 m-20  ">

        <!-- profile -->
        
            <div class=" w-95 h-95 md:w-110 md:h-110 bg-gray-900 text-gray-600  rounded-3xl shadow-lg border  flex flex-col items-center justify-center p-6 relative overflow-hidden">
                <!-- Background accent elements -->
                <div class="absolute top-0 right-0 w-16 h-16 bg-blue-500 opacity-10 rounded-full -mr-6 -mt-6"></div>
                <div class="absolute bottom-0 left-0 w-20 h-20 bg-purple-500 opacity-10 rounded-full -ml-10 -mb-10"></div>
                
                <!-- Circular Profile Image with ring -->
                <div class="w-24 h-24 rounded-full overflow-hidden mb-4 ring-4 ring-gray-400  shadow-md relative z-5">
                    <img src="https://images.unsplash.com/photo-1438761681033-6461ffad8d80?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="Profile Image" class="w-full h-full object-cover">
                </div>
                
                <!-- Profile Information -->
                <div class="text-center relative z-5">
                    <h2 class="text-xl font-bold text-gray-400">Jane Doe</h2>
                    <div class="flex items-center justify-center mt-1 text-gray-400 text-sm">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                    <span>Joined on March 2, 2023</span>
                    </div>
                    
                    <!-- Role badge -->
                    <div class="mt-3">
                    <span class="bg-blue-100 text-blue-800 text-xs font-medium px-3 py-1 rounded-full">Senior Developer</span>
                    </div>
                </div>

            </div>
        

        <!-- update -->
        <div class=" flex-1  w-full h-full " >
            <?php 
                require './application.php'
            ?>
        </div>


    </div>

    <?php 
        require './footer.php';
    ?>


<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js" integrity="sha512-7eHRwcbYkK4d9g/6tD/mhkf++eoTHwpNM9woBxtPUBWm67zeAfFC+HrdoE2GanKeocly/VxeLvIqwvCdk7qScg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>

</script>
</body>
</html>



<!--  add this in profile  -->
<!-- and add a change button to eddit it and remove session  -->
<!-- if not session then only can be eddited else not -->

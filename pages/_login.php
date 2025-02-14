<?php

echo
'
    <div style="background-image: url(\'./img/img1.jpg\'); background-size: cover; background-position: center; background-repeat: no-repeat;" class="relative flex justify-center items-center min-w-screen h-screen bg-indigo-500  ">
        <div id="b" class="flex flex-col lg:flex-row h-4/5 w-4/5 bg-amber-50 rounded-2xl overflow-hidden border shadow-2xl shadow-black z-20 z-10 ">
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
                <div id="a" class=" flex flex-col justify-center items-center text-2xl " >
                    <form action="">
                        <div class=" flex gap-[20px] mb-[10px]" >
                            <label for="loginemail"><i class="fa-solid fa-envelope"></i></label>
                            <input type="text" id="loginemail" class="w-80 h-10 border-2 px-2 placeholder:text-[16px] rounded-xl text-[16px]"  placeholder="email..." >
                        </div>
                        <div class=" flex gap-[20px] mb-[40px]">
                            <label class="pr-[3px]" for="loginpassword"><i class="fa-solid fa-lock"></i></label>
                            <input type="password" id="loginpassword" class="w-80 h-10 border-2 px-2 placeholder:text-[16px] text-[16px] rounded-xl " placeholder="password...">
                        </div>
                        <div class=" flex justify-center ">
                            <button type="sumbit" class=" bg-indigo-500 border-2 py-2 px-4 text-[20px] rounded-2xl hover:bg-indigo-600" >Login</button>
                        </div>
                    </form>
                </div>

                <!-- signup -->
                <div id="a" class=" flex justify-center  " >
                    <pre>Dont have an account...! </pre><a href="#"> <pre class=" text-indigo-800 ">SignUp</pre> </a>
                </div>

            </div>
            <!-- Image -->
            <div class="bg-pink-400 w-0 lg:w-3/5 lg:h-full flex justify-center items-center">
                 <img src="./img/img1.jpg" class="w-full h-full" alt="">
            </div>
        </div>
    </div>

';

?>
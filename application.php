<!doctype html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="src/output.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
</head>
<body class=" overflow-x-hidden ">
    
<div class="max-w-2xl w-full  mx-auto p-6 bg-gray-900 text-white rounded-3xl shadow-lg">
    <form class="space-y-6">
        <!-- Post Section -->
        <div>
            <label for="post" class="block text-sm font-medium mb-2">Position Applying For</label>
            <input 
                type="text" 
                id="post" 
                name="post" 
                required
                class=" text-gray-400 w-full px-4 py-2 bg-white/10 border border-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500  placeholder-gray-600"
                placeholder="Enter your role"
            >
        </div>

        <!-- About Section -->
        <div>
            <label for="about" class="block text-sm font-medium mb-2">About Yourself</label>
            <textarea 
                id="about" 
                name="about" 
                rows="6"
                required
                class=" text-gray-400 w-full px-4 py-2 bg-white/10 border border-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500  placeholder-gray-600"
                placeholder="Tell us about yourself..."
            ></textarea>
        </div>

        <!-- Upload Resume Section -->
        <div>
            <label for="resume" class="block text-sm font-medium mb-2">Upload Resume</label>
            <div class="relative">
                <input 
                    type="file" 
                    id="resume" 
                    name="resume" 
                    accept="image/*"
                    required
                    class="opacity-0 absolute w-full h-full cursor-pointer"
                >
                <button 
                    type="button"
                    class="w-full px-4 py-2 bg-blue-700 text-white rounded-lg hover:bg-blue-600 transition-all duration-300 flex items-center justify-center gap-2"
                >
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                    </svg>
                    Upload Resume
                </button>
            </div>
            <p class="mt-1 text-xs text-gray-400">JPG, PNG, JPEG</p>
        </div>

        <!-- Submit Button -->
        <div class="text-center">
            <button 
                type="submit"
                class="px-6 py-2 bg-blue-700 text-white font-semibold rounded-lg hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all duration-300"
            >
                Submit
            </button>
        </div>
    </form>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js" integrity="sha512-7eHRwcbYkK4d9g/6tD/mhkf++eoTHwpNM9woBxtPUBWm67zeAfFC+HrdoE2GanKeocly/VxeLvIqwvCdk7qScg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>

</script>
</body>
</html>



<!--  add this in profile  -->
<!-- and add a change button to eddit it and remove session  -->
<!-- if not session then only can be eddited else not -->

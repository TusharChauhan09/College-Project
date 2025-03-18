<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        linkedin: {
                            blue: '#0a66c2',
                            dark: '#283e4a'
                        }
                    },
                    boxShadow: {
                        card: '0 4px 6px rgba(0, 0, 0, 0.2), 0 0 0 1px rgba(255, 255, 255, 0.05)'
                    }
                }
            }
        }
    </script>
</head>

<body class="bg-gray-900 text-gray-200 flex items-center justify-center min-h-screen p-4">
    <div class="max-w-md w-full">
        <!-- Profile Card -->
        <div class="bg-gray-800 rounded-lg shadow-card overflow-hidden">
            <!-- Header -->
            <div class="bg-linkedin-dark text-white h-auto p-2  flex flex-col items-center justify-center px-4 rounded-lg shadow-md">
                <p id="quote" class="text-sm font-medium italic text-center"><i class="fa-solid fa-circle-notch animate-spin "></i></p>
                <p id="author" class="text-xs font-light mt-1 text-gray-300"></p>
            </div>


            <!-- Profile Info -->
            <div class="px-6 pt-4 pb-6">
                <div class="flex items-start mb-4">
                    <div class="relative -mt-12">
                        <img class="h-20 w-20 rounded-full object-cover border-4 border-gray-800 shadow"
                            src="https://images.unsplash.com/photo-1438761681033-6461ffad8d80?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                            alt="Profile photo">
                    </div>
                    <div class="ml-4 pt-2">
                        <h2 class="text-xl font-bold text-white">Tushar Chauhan</h2>
                        <p class="text-gray-400">Student</p>
                        <p class="text-gray-500 text-sm mt-1">
                            <i class="far fa-calendar-alt mr-1"></i> 13 Jan
                        </p>
                    </div>
                </div>

                <!-- Resume Section -->
                <div class="mt-6">
                    <h3 class="font-semibold text-gray-300 mb-3 flex items-center">
                        <i class="far fa-file-alt mr-2 text-linkedin-blue"></i>
                        Resume
                    </h3>
                    <div class="border border-gray-700 rounded-lg overflow-hidden">
                        <img class="w-full object-contain"
                            src="https://d.novoresume.com/images/doc/tech-resume-template.png" alt="Resume preview">
                        <div class="bg-gray-700 px-4 py-3 border-t border-gray-600 flex justify-between items-center">
                            <span class="text-sm text-gray-300">Resume preview</span>
                            <button
                                class="text-linkedin-blue text-sm font-medium hover:text-blue-300 transition-colors">View</button>
                        </div>
                    </div>
                </div>

                <!-- Actions -->
                <div class="mt-6 flex justify-around ">
                    <button
                        class="bg-linkedin-blue text-white px-4 py-2 rounded font-medium hover:bg-blue-700 transition-colors flex items-center">
                        <i class="fa-solid fa-check fa-fade mr-1"></i> Accept 
                    </button>
                    <button
                        class="bg-linkedin-blue text-white px-4 py-2 rounded font-medium hover:bg-blue-700 transition-colors flex items-center">
                        <i class="fa-solid fa-xmark fa-fade mr-1"></i> Reject
                    </button>
                    
                    <a href="mailto:example@gmail.com" target="_blank">
                    <button
                        class="border border-gray-600 text-gray-300 px-4 py-2 rounded font-medium hover:bg-gray-700 transition-colors">
                        <i class="far fa-envelope mr-2"></i> Inquiry
                    </a>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js"></script>
    <script>
        // Simple animation for card
        gsap.from(".bg-gray-800", {
            duration: 0.8,
            y: 30,
            opacity: 0,
            ease: "power2.out"
        });

        fetch('https://dummyjson.com/quotes/random')
          .then(res => res.json())
          .then(data => {
              document.getElementById('quote').innerText = `"${data.quote}"`;
              document.getElementById('author').innerText = `--by ${data.author}`;
          })
          .catch(error => console.error('Error fetching quote:', error));





    </script>
</body>

</html>    
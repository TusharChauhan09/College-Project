<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Applications</title>
    <link href="src/output.css" rel="stylesheet">
    <link href="src/optimized-effects.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
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

<body class="bg-gray-900 text-gray-200 flex items-center justify-center min-h-screen p-4 ">
    <div class="max-w-200 w-200 grid grid-cols-1 md:grid-cols-2  lg:grid-cols-3    ">
        <!-- Profile Card -->
        <!-- 1. -->
        <div class="bg-gray-800 rounded-lg shadow-card overflow-hidden m-10">
            <!-- Header -->
            <div
                class="bg-linkedin-dark text-white h-auto p-2  flex flex-col items-center justify-center px-4 rounded-lg shadow-md">
                <p id="quote" class="text-sm font-medium italic text-center"><i
                        class="fa-solid fa-circle-notch animate-spin "></i></p>
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
                <div class="mt-6 flex flex-col gap-2 justify-center " id="action-buttons">
                    <button onclick="acceptEmail('itget4010@gmail.com')"
                        class="  bg-linkedin-blue text-white px-4 py-2 mr-1 rounded font-medium hover:bg-blue-700 transition-colors flex items-center justify-center ">
                        <i class="fa-solid fa-check fa-fade mr-1"></i> Accept
                    </button>
                    <button onclick="rejectEmail('itget4010@gmail.com')"
                        class="bg-linkedin-blue text-white px-4 py-2 mr-1 rounded font-medium hover:bg-red-700 transition-colors flex items-center">
                        <i class="fa-solid fa-xmark fa-fade mr-1"></i> Reject
                    </button>

                    <a href="mailto:example@gmail.com" target="_blank">
                        <button
                            class="border border-gray-600 text-gray-300 px-4 py-2 rounded font-medium hover:bg-gray-700 transition-colors">
                            <i class="far fa-envelope mr-2"></i> Inquiry
                    </a>
                </div>

                <!-- Pending State (Hidden by default) -->
                <div id="pending-state" class="mt-6 flex-col gap-2 justify-center hidden">
                    <div
                        class="bg-gradient-to-r from-yellow-600 to-amber-500 text-white px-4 py-3 rounded font-medium flex items-center justify-center shadow-lg border border-yellow-400">
                        <i class="fa-solid fa-clock fa-spin-pulse mr-2 text-yellow-200"></i> Processing Request...
                    </div>
                    <p class="text-gray-400 text-sm text-center mt-2">Your request is being processed. Please wait.</p>
                </div>

                <!-- Success State (Hidden by default) -->
                <div id="success-state" class="mt-6 flex-col gap-2 justify-center hidden">
                    <div class="bg-green-700 text-white px-4 py-3 rounded font-medium flex items-center justify-center">
                        <i class="fa-solid fa-check-circle mr-2"></i> <span id="success-message">Request
                            Processed</span>
                    </div>
                </div>

                <!-- Error State (Hidden by default) -->
                <div id="error-state" class="mt-6 flex-col gap-2 justify-center hidden">
                    <div class="bg-red-700 text-white px-4 py-3 rounded font-medium flex items-center justify-center">
                        <i class="fa-solid fa-exclamation-circle mr-2"></i> <span id="error-message">An error
                            occurred</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- 2. -->


    </div>

    <script>

        function acceptEmail(x) {
            document.getElementById('action-buttons').style.display = 'none';
            document.getElementById('pending-state').classList.remove('hidden');
            let formData = new FormData();
            formData.append('x', x);

            fetch('accept.php', {
                method: 'POST',
                body: formData
            })
                .then(res => res.json())
                .then(data => {
                    console.log(data);
                    document.getElementById('pending-state').classList.add('hidden');
                    document.getElementById('success-state').classList.remove('hidden');
                    document.getElementById('success-message').innerText = 'Application Accepted';
                })
                .catch(error => {
                    console.error('Error accepting email:', error);
                    document.getElementById('pending-state').classList.add('hidden');
                    document.getElementById('error-state').classList.remove('hidden');
                    document.getElementById('error-message').innerText = 'Failed to accept application';
                });
        }

        function rejectEmail(x) {
            document.getElementById('action-buttons').style.display = 'none';
            document.getElementById('pending-state').classList.remove('hidden');
            let formData = new FormData();
            formData.append('x', x);

            fetch('reject.php', {
                method: 'POST',
                body: formData
            })
                .then(res => res.json())
                .then(data => {
                    console.log(data);
                    document.getElementById('pending-state').classList.add('hidden');
                    document.getElementById('success-state').classList.remove('hidden');
                    document.getElementById('success-message').innerText = 'Application Rejected';
                })
                .catch(error => {
                    console.error('Error rejecting email:', error);
                    document.getElementById('pending-state').classList.add('hidden');
                    document.getElementById('error-state').classList.remove('hidden');
                    document.getElementById('error-message').innerText = 'Failed to reject application';
                });
        }

        fetch('https://dummyjson.com/quotes/random')
            .then(res => res.json())
            .then(data => {
                document.querySelector('#quote').innerText = `"${data.quote}"`;
                document.querySelector('#author').innerText = `--by ${data.author}`;
            })
            .catch(error => console.error('Error fetching quote:', error));
    </script>
</body>

</html>
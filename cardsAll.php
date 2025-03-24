<?php

echo '<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 sm:gap-8">';

$res = mysqli_query($conn, "SELECT * FROM post");
while ($row = mysqli_fetch_array($res)) {
    $email = $row['p_email'];
    $name = $row['p_name'];
    $profile = $row['p_profile'];
    $resume = $row['p_resume'];
    $about = $row['p_about'];
    $post = $row['p_post'];
    $date = $row['p_date'];

    echo '
    <!-- Profile Card -->
    <div class="bg-gray-800 rounded-lg shadow-card overflow-hidden m-10">
        <!-- Header -->
        <div class="bg-gray-500  text-white p-2 sm:p-3 flex flex-col items-center justify-center rounded-lg shadow-md">
            <p class="quote text-sm font-medium italic text-center"><i class="fa-solid fa-circle-notch animate-spin"></i></p>
            <p class="author text-xs font-light mt-1 text-gray-300"></p>
        </div>

        <!-- Profile Info -->
        <div class="p-4 sm:p-6">
            <div class="flex items-start gap-4">
                <div class="relative -mt-12">
                    <img class="h-20 w-20 rounded-full object-cover border-4 border-gray-800 shadow"
                        src="Profile/' . $profile . '"
                        alt="Profile photo of ' . $name . '">
                </div>
                <div class="flex-1">
                    <h2 class="text-xl font-bold text-white">' . $name . '</h2>
                    <span class="inline-block bg-blue-100 text-blue-800 text-xs font-medium px-3 py-1 rounded-full mt-2">
                        ' . $post . '
                    </span>
                    <p class="text-gray-500 text-sm mt-2">
                        <i class="far fa-calendar-alt mr-1"></i>' . $date . '
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
                    <img class="w-full h-full object-contain min-h-[300px]"
                        src="Resume/' . $resume . '" 
                        alt="Resume preview for ' . $name . '">
                    <div class="bg-gray-700 px-4 py-3 border-t border-gray-600 flex justify-between items-center">
                        <span class="text-sm text-gray-300">Resume preview</span>
                        <button class="text-linkedin-blue text-sm font-medium hover:text-blue-300 transition-colors">
                            View
                        </button>
                    </div>
                </div>
            </div>

            <!-- Actions -->
            <div class="mt-6 flex flex-col sm:flex-row gap-2 sm:gap-4 justify-center sm:justify-around">
                <button class="bg-linkedin-blue text-white px-4 py-2 rounded bg-blue-700 font-medium hover:bg-blue-600 transition-colors flex items-center justify-center">
                    <i class="fa-solid fa-check fa-fade mr-1"></i> Accept 
                </button>
                <button class=" text-white px-4 py-2 rounded bg-red-700 font-medium hover:bg-red-600 transition-colors flex items-center justify-center">
                    <i class="fa-solid fa-xmark fa-fade mr-1"></i> Reject
                </button>
                <a href="mailto:' . $email . '" target="_blank" class="w-full sm:w-auto">
                    <button class="w-full sm:w-auto border border-gray-600 text-gray-300 px-4 py-2 rounded font-medium hover:bg-gray-700 transition-colors flex items-center justify-center">
                        <i class="far fa-envelope mr-2"></i> Inquiry
                    </button>
                </a>
            </div>
        </div>
    </div>';
}

echo '</div>';

echo '<script>
    // Simple animation for card
    gsap.from(".bg-gray-800", {
        duration: 0.8,
        y: 30,
        opacity: 0,
        stagger: 0.2,
        ease: "power2.out"
    });

    // Fetch quotes for each card
    document.querySelectorAll(".quote").forEach((quoteElement, index) => {
        const authorElement = quoteElement.nextElementSibling;
        fetch("https://dummyjson.com/quotes/random")
            .then(res => res.json())
            .then(data => {
                quoteElement.innerHTML = `"${data.quote}"`;
                authorElement.innerHTML = `--by ${data.author}`;
            })
            .catch(error => console.error("Error fetching quote:", error));
    });
</script>';
?>
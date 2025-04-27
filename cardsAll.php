<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Applications</title>
    <link href="src/output.css" rel="stylesheet">
    <link href="src/optimized-effects.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        html.light-mode .bg-gray-900 {
            background-color: #dbd6b2;
        }

        html.light-mode .bg-gray-800 {
            background-color: #d0caa6;
        }

        html.light-mode .text-white {
            color: #0f172a;
        }

        html.light-mode .text-gray-300,
        html.light-mode .text-gray-400 {
            color: #334155;
        }

        html.light-mode .border-gray-700 {
            border-color: #c5c1a0;
        }

        html.light-mode .ring-gray-700 {
            --tw-ring-color: #c5c1a0;
        }

        html.light-mode .bg-gradient-to-r.from-gray-900.via-purple-900.to-gray-900 {
            background: linear-gradient(to right, #dbd6b2, #d0caa6, #dbd6b2);
        }

        html.light-mode .shadow-card {
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
        }

        html.light-mode .bg-gray-900\/80 {
            background-color: rgba(219, 214, 178, 0.8);
        }

        html.light-mode .bg-black\/20 {
            background-color: rgba(0, 0, 0, 0.1);
        }
    </style>
</head>

<body>
    <?php

    echo '<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-6">';

    $search = isset($_GET['search']) ? mysqli_real_escape_string($conn, $_GET['search']) : '';

    if (!empty($search)) {
        $res = mysqli_query($conn, "SELECT * FROM post WHERE p_post LIKE '%$search%'");

        if (mysqli_num_rows($res) == 0) {
            echo '<div class="col-span-3 text-center p-10">
            <div class="bg-gray-800 rounded-lg shadow-card p-8">
                <i class="fa-solid fa-search text-4xl text-gray-400 mb-4"></i>
                <h3 class="text-xl font-bold text-white mb-2">No results found</h3>
                <p class="text-gray-400">No positions matching "' . htmlspecialchars($search) . '" were found.</p>
                <a href="?" class="inline-block mt-4 px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                    Clear search
                </a>
            </div>
        </div>';
        }
    } else {
        $res = mysqli_query($conn, "SELECT * FROM post");
    }

    // Display search results count if search is active
    if (!empty($search) && mysqli_num_rows($res) > 0) {
        echo '<div class="col-span-3 mb-4 px-10">
        <div class="bg-gray-800 rounded-lg p-4 text-gray-300">
            <span class="font-semibold">Search results for: </span>
            <span class="text-white">"' . htmlspecialchars($search) . '"</span>
            <span class="ml-2">(' . mysqli_num_rows($res) . ' results found)</span>
            <a href="?" class="ml-4 text-blue-400 hover:text-blue-300">
                <i class="fa-solid fa-times-circle mr-1"></i>Clear
            </a>
        </div>
    </div>';
    }

    while ($row = mysqli_fetch_array($res)) {
        $email = $row['p_email'];
        $name = $row['p_name'];
        $profile = $row['p_profile'];
        $resume = $row['p_resume'];
        $about = $row['p_about'];
        $post = $row['p_post'];
        $date = $row['p_date'];
        $p = 0;

        echo '
    <div class="card-animate bg-gray-900 rounded-xl shadow-card overflow-hidden mb-8 transition-all duration-500 hover:shadow-xl opacity-0 translate-y-8" id="card-' . $email . '">
        <!-- Quote Section with Animation -->
        <div class="quote-section bg-gradient-to-r from-gray-900 via-purple-900 to-gray-900 text-white p-6 relative overflow-hidden">
            <div class="relative z-10 transform transition-transform duration-300 hover:scale-[1.02]">
                <p class="quote text-lg font-medium  leading-relaxed animate-fade-in">
                    <i class="fa-solid fa-circle-notch animate-spin"></i>
                </p>
                <p class="author text-sm font-light mt-2 text-gray-300 animate-fade-in"></p>
            </div>
            <div class="absolute inset-0 bg-gradient-to-r from-purple-500/10 via-violet-500/10 to-transparent backdrop-blur-md"></div>
            <div class="absolute inset-0 bg-black/20 backdrop-blur-sm"></div>
        </div>

        <!-- Profile Section with Hover Animation -->
        <div class="p-6">
            <div class="flex items-start gap-4 mb-6 transform transition-all duration-300 hover:translate-x-1">
                <div class="shrink-0">
                    <div class="h-24 w-24 rounded-xl ring-4 ring-gray-700 overflow-hidden transform transition-all duration-300 hover:scale-105 hover:ring-purple-500/50">
                        <img class="h-full w-full object-cover transition-transform duration-500 hover:scale-110"
                            src="Profile/' . $profile . '"
                            alt="' . $name . '">
                    </div>
                </div>
                <div class="flex-1 min-w-0">
                    <h2 class="text-2xl font-bold text-white mb-2 transform transition-all duration-300 hover:translate-x-1">' . $name . '</h2>
                    <div class="flex flex-wrap gap-2">
                        <span class="inline-flex items-center px-4 py-2 rounded-lg text-sm font-medium bg-blue-100 text-blue-800 transform transition-all duration-300 hover:scale-105 hover:shadow-lg">
                            <i class="fas fa-briefcase mr-2"></i>' . $post . '
                        </span>
                        <span class="inline-flex items-center text-gray-400 text-sm transform transition-all duration-300">
                            <i class="far fa-calendar-alt mr-2"></i>' . $date . '
                        </span>
                    </div>
                </div>
            </div>

            <!-- Main Content Area -->
            <div class="flex flex-col md:flex-row gap-6">
                <!-- Action Buttons with Hover Effects -->
                <div class="md:w-1/3">
                   <div class="mt-6 flex flex-col gap-2 justify-center" id="action-buttons-' . $email . '" ' . ($p == 3 ? 'style="display:none;"' : '') . '>
                <button onclick="acceptEmail(\'' . $email . '\')" ' . ($p == 1 || $p == 2 ? 'disabled' : '') . ' 
                    class=" text-white px-4 py-2 rounded bg-blue-700 font-medium hover:bg-blue-600 transition-colors flex items-center justify-center ' . ($p == 1 || $p == 2 ? 'opacity-50 cursor-not-allowed' : '') . '">
                    <i class="fa-solid fa-check fa-fade mr-1"></i>Accept 
                </button>
                <button onclick="rejectEmail(\'' . $email . '\')" ' . ($p == 1 || $p == 2 ? 'disabled' : '') . ' class=" text-white px-4 py-2 rounded bg-red-700 font-medium hover:bg-red-600 transition-colors flex items-center justify-center ' . ($p == 1 || $p == 2 ? 'opacity-50 cursor-not-allowed' : '') . '">
                    <i class="fa-solid fa-xmark fa-fade mr-1"></i> Reject
                </button>
                <a href="mailto:' . $email . '" target="_blank" class="w-full sm:w-auto">
                    <button class="w-full sm:w-auto border border-gray-600 text-gray-300 px-4 py-2 rounded font-medium hover:bg-gray-700 transition-colors flex items-center justify-center">
                        <i class="far fa-envelope mr-2"></i> Inquiry
                    </button>
                </a>
            </div> 

                    <!-- States -->
                    <div id="pending-state-' . $email . '" class="mt-6 ' . ($p == 3 ? '' : 'hidden') . '">
                        <div class="bg-gradient-to-r from-yellow-600 to-amber-500 text-white px-6 py-3 rounded-lg font-medium flex items-center justify-center">
                            <i class="fa-solid fa-clock fa-spin-pulse mr-2"></i> Processing Request...
                        </div>
                    </div>
                    
                    <div id="success-state-' . $email . '" class="mt-6 ' . ($p == 1 ? '' : 'hidden') . '">
                        <div class="bg-green-600 text-white px-6 py-3 rounded-lg font-medium flex items-center justify-center">
                            <i class="fa-solid fa-check-circle mr-2"></i> Application Accepted
                        </div>
                    </div>
                    
                    <div id="rejected-state-' . $email . '" class="mt-6 ' . ($p == 2 ? '' : 'hidden') . '">
                        <div class="bg-red-600 text-white px-6 py-3 rounded-lg font-medium flex items-center justify-center">
                            <i class="fa-solid fa-times-circle mr-2"></i> Application Rejected
                        </div>
                    </div>
                </div>

                <!-- Resume Section with Hover Animation -->
                <div class="md:w-2/3">
                    <div class="h-full border border-gray-700 rounded-xl overflow-hidden transform transition-all duration-300 hover:shadow-2xl hover:border-purple-500/30">
                        <div class="h-[600px] relative group">
                            <img class="w-full h-full object-cover transition-all duration-500 group-hover:scale-105"
                                src="Resume/' . $resume . '" 
                                alt="Resume preview">
                            <div class="absolute inset-0 bg-gradient-to-t from-gray-900 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-all duration-300"></div>
                            <div class="absolute bottom-0 left-0 right-0 p-4 bg-gray-900/80 backdrop-blur-sm transform translate-y-full group-hover:translate-y-0 transition-all duration-300">
                                <div class="flex items-center justify-between">
                                    <span class="text-sm text-gray-300">Click to view full resume</span>
                                    <button onclick="openResumeModal(\'Resume/' . $resume . '\', \'' . $name . '\')" 
                                        class="text-blue-400 text-sm font-medium hover:text-blue-300 transition-colors flex items-center group">
                                        View full size 
                                        <i class="fas fa-external-link-alt ml-2 transform transition-transform duration-300 group-hover:translate-x-1"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>';
    }

    echo '</div>';

    echo '<script src="./notifications.js"></script>';

    echo '<script>
document.addEventListener("DOMContentLoaded", function() {
    const cards = document.querySelectorAll(".card-animate");
    
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = "1";
                entry.target.style.transform = "translateY(0)";
                observer.unobserve(entry.target);
            }
        });
    }, {
        threshold: 0.1,
        rootMargin: "50px"
    });

    cards.forEach(card => {
        observer.observe(card);
    });

    // Enhanced hover effects for buttons
    const buttons = document.querySelectorAll("button");
    buttons.forEach(button => {
        button.addEventListener("mouseover", function(e) {
            const x = e.pageX - button.offsetLeft;
            const y = e.pageY - button.offsetTop;
            
            button.style.setProperty("--x", x + "px");
            button.style.setProperty("--y", y + "px");
        });
    });

    // Smooth state transitions
    function animateStateChange(element, newState) {
        element.style.opacity = "0";
        element.style.transform = "translateY(-10px)";
        
        setTimeout(() => {
            element.innerHTML = newState;
            element.style.opacity = "1";
            element.style.transform = "translateY(0)";
        }, 300);
    }

    // Enhanced quote loading animation
    document.querySelectorAll(".quote").forEach((quoteElement, index) => {
        const authorElement = quoteElement.nextElementSibling;
        
        fetch("https://dummyjson.com/quotes/random")
            .then(res => res.json())
            .then(data => {
                setTimeout(() => {
                    quoteElement.style.opacity = "0";
                    setTimeout(() => {
                        quoteElement.innerHTML = `"${data.quote}"`;
                        quoteElement.style.opacity = "1";
                        
                        authorElement.style.opacity = "0";
                        setTimeout(() => {
                            authorElement.innerHTML = `--by ${data.author}`;
                            authorElement.style.opacity = "1";
                        }, 200);
                    }, 300);
                }, index * 100);
            });
    });
});

// Function to handle accept button click
function acceptEmail(x) {
        // Hide action buttons and show pending state
        document.getElementById("action-buttons-" + x).style.display = "none";
        document.getElementById("pending-state-" + x).classList.remove("hidden");
        
        let formData = new FormData();
        formData.append("x", x);

        fetch("accept.php", {
            method: "POST",
            body: formData
        })
        .then(res => res.json())
        .then(data => {
            console.log(data);
            // Hide pending state and show success state
            document.getElementById("pending-state-" + x).classList.add("hidden");
            document.getElementById("success-state-" + x).classList.remove("hidden");
            
            // Show success notification
            notifications.success("Application accepted successfully! An email has been sent to the applicant.");
        })
        .catch(error => {
            console.error("Error accepting email:", error);
            // On error, show action buttons again
            document.getElementById("pending-state-" + x).classList.add("hidden");
            document.getElementById("action-buttons-" + x).style.display = "flex";
            
            // Show error notification
            notifications.error("Failed to accept application. Please try again.");
        });
    }

    function rejectEmail(x) {
        // Hide action buttons and show pending state
        document.getElementById("action-buttons-" + x).style.display = "none";
        document.getElementById("pending-state-" + x).classList.remove("hidden");
        
        let formData = new FormData();
        formData.append("x", x);

        fetch("reject.php", {
            method: "POST",
            body: formData
        })
        .then(res => res.json())
        .then(data => {
            console.log(data);
            // Hide pending state and show rejected state
            document.getElementById("pending-state-" + x).classList.add("hidden");
            document.getElementById("rejected-state-" + x).classList.remove("hidden");
            
            // Show rejection notification
            notifications.info("Application rejected. An email has been sent to the applicant.");
        })
        .catch(error => {
            console.error("Error rejecting email:", error);
            // On error, show action buttons again
            document.getElementById("pending-state-" + x).classList.add("hidden");
            document.getElementById("action-buttons-" + x).style.display = "flex";
            
            // Show error notification
            notifications.error("Failed to reject application. Please try again.");
        });
    }
// Function to remove pending state
function removePendingState(email) {
    let formData = new FormData();
    formData.append("x", email);

    fetch("removePending.php", {
        method: "POST",
        body: formData
    })
    .then(res => res.json())
    .then(data => {
        console.log(data);
        document.querySelector("#pending-state-" + email).classList.add("hidden");
        document.querySelector("#action-buttons-" + email).style.display = "flex";
    })
    .catch(error => {
        console.error("Error removing pending state:", error);
        notifications.error("Error: " + error.message);
    });
}
</script>';

    echo '<style>
/* Add these styles for animations */
.card-animate {
    transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
}

.animate-fade-in {
    opacity: 0;
    animation: fadeIn 0.5s ease-out forwards;
}

@keyframes fadeIn {
    from { opacity: 0; transform: translateY(10px); }
    to { opacity: 1; transform: translateY(0); }
}

button {
    position: relative;
    overflow: hidden;
}

button::after {
    content: "";
    position: absolute;
    width: 5px;
    height: 5px;
    background: rgba(255, 255, 255, 0.5);
    border-radius: 50%;
    transform: scale(0);
    transition: transform 0.5s;
    left: var(--x);
    top: var(--y);
}

button:hover::after {
    transform: scale(50);
    opacity: 0;
}
</style>';

    // Add the Resume Modal HTML
    echo '<!-- Resume Modal -->
<div id="resumeModal" class="fixed inset-0 z-50 hidden">
    <!-- Modal Backdrop -->
    <div class="absolute inset-0 bg-black/80 backdrop-blur-sm transition-opacity duration-300" id="modalBackdrop"></div>
    
    <!-- Modal Content -->
    <div class="fixed inset-4 md:inset-10 flex items-center justify-center z-50">
        <div class="bg-gray-900 rounded-xl shadow-2xl w-full h-full relative overflow-hidden transform transition-all duration-300 scale-95 opacity-0" id="modalContent">
            <!-- Modal Header with Controls -->
            <div class="absolute top-0 left-0 right-0 p-4 bg-gray-800/80 backdrop-blur-sm flex justify-between items-center z-50">
                <div class="flex space-x-2">
                    <button class="text-gray-300 hover:text-white p-2 rounded-full bg-gray-700/50 hover:bg-gray-600/50 transition-all duration-300" onclick="zoomIn()">
                        <i class="fas fa-search-plus text-xl"></i>
                    </button>
                    <button class="text-gray-300 hover:text-white p-2 rounded-full bg-gray-700/50 hover:bg-gray-600/50 transition-all duration-300" onclick="zoomOut()">
                        <i class="fas fa-search-minus text-xl"></i>
                    </button>
                    <button class="text-gray-300 hover:text-white p-2 rounded-full bg-gray-700/50 hover:bg-gray-600/50 transition-all duration-300" onclick="resetZoom()">
                        <i class="fas fa-undo text-xl"></i>
                    </button>
                </div>
                
                <div class="flex space-x-2">
                    <button class="text-gray-300 hover:text-white p-2 rounded-full bg-gray-700/50 hover:bg-gray-600/50 transition-all duration-300" id="downloadButton">
                        <i class="fas fa-download text-xl"></i>
                    </button>
                    <button class="text-gray-300 hover:text-white p-2 rounded-full bg-gray-700/50 hover:bg-gray-600/50 transition-all duration-300" onclick="closeResumeModal()">
                        <i class="fas fa-times text-xl"></i>
                    </button>
                </div>
            </div>
            
            <!-- Image Container -->
            <div class="w-full h-full flex items-center justify-center overflow-hidden" id="imageContainer">
                <img src="" alt="Resume Preview" id="modalImage" class="max-w-full max-h-full object-contain transition-transform duration-300">
            </div>
        </div>
    </div>
</div>';

    // Add the Resume Modal JavaScript
    echo '<script>
let currentZoom = 1;
const zoomStep = 0.25;
const maxZoom = 3;
const minZoom = 0.5;

function openResumeModal(imageSrc, name) {
    const modal = document.getElementById("resumeModal");
    const modalContent = document.getElementById("modalContent");
    const modalImage = document.getElementById("modalImage");
    const downloadButton = document.getElementById("downloadButton");
    
    // Set image source
    modalImage.src = imageSrc;
    modalImage.alt = "Resume of " + name;
    
    // Setup download button
    downloadButton.onclick = () => {
        // Create a temporary link element
        const link = document.createElement("a");
        link.href = imageSrc;
        link.download = "Resume-" + name.replace(/\s+/g, "-") + ".pdf";
        
        // Append to body, click, and remove
        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);
    };
    
    // Show modal with animation
    modal.classList.remove("hidden");
    setTimeout(() => {
        modalContent.classList.remove("scale-95", "opacity-0");
        modalContent.classList.add("scale-100", "opacity-100");
    }, 50);
    
    // Add keyboard listeners
    document.addEventListener("keydown", handleKeyPress);
    
    // Reset zoom
    resetZoom();
}

function closeResumeModal() {
    const modal = document.getElementById("resumeModal");
    const modalContent = document.getElementById("modalContent");
    
    modalContent.classList.remove("scale-100", "opacity-100");
    modalContent.classList.add("scale-95", "opacity-0");
    
    setTimeout(() => {
        modal.classList.add("hidden");
    }, 300);
    
    // Remove keyboard listeners
    document.removeEventListener("keydown", handleKeyPress);
}

function handleKeyPress(e) {
    if (e.key === "Escape") {
        closeResumeModal();
    } else if (e.key === "+" || e.key === "=") {
        zoomIn();
    } else if (e.key === "-") {
        zoomOut();
    } else if (e.key === "0") {
        resetZoom();
    }
}

function zoomIn() {
    if (currentZoom < maxZoom) {
        currentZoom += zoomStep;
        updateZoom();
    }
}

function zoomOut() {
    if (currentZoom > minZoom) {
        currentZoom -= zoomStep;
        updateZoom();
    }
}

function resetZoom() {
    currentZoom = 1;
    updateZoom();
}

function updateZoom() {
    const modalImage = document.getElementById("modalImage");
    modalImage.style.transform = `scale(${currentZoom})`;
}

// Close modal when clicking outside
document.getElementById("modalBackdrop").addEventListener("click", (e) => {
    if (e.target === e.currentTarget) {
        closeResumeModal();
    }
});
</script>';
    ?>
</body>

</html>
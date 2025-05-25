<?php
require './auth.php';

if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}

$create_table = "CREATE TABLE IF NOT EXISTS chat_messages (
    id INT AUTO_INCREMENT PRIMARY KEY,
    sender_email VARCHAR(255),
    sender_name VARCHAR(255),
    message TEXT,
    timestamp DATETIME DEFAULT CURRENT_TIMESTAMP,
    is_read BOOLEAN DEFAULT FALSE
)";

if (!mysqli_query($conn, $create_table)) {
    die("Error creating chat table: " . mysqli_error($conn));
}

$email = $_SESSION['email'];
$result = mysqli_query($conn, "SELECT name FROM user WHERE email = '$email'");
if (!$result) {
    die("Error fetching user data: " . mysqli_error($conn));
}
$user = mysqli_fetch_assoc($result);
$current_user_name = $user['name'];

if (isset($_POST['message']) && !empty($_POST['message'])) {
    $message = mysqli_real_escape_string($conn, $_POST['message']);
    $insert_query = "INSERT INTO chat_messages (sender_email, sender_name, message) 
                    VALUES ('$email', '$current_user_name', '$message')";
    if (!mysqli_query($conn, $insert_query)) {
        die("Error sending message: " . mysqli_error($conn));
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat Room</title>
    <link href="src/output.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <script>
        
        (function () {
            const currentTheme = localStorage.getItem('theme') || 'dark';
            document.documentElement.classList.toggle('light-mode', currentTheme === 'light');
        })();
    </script>
    <style>
        body {
            font-family: 'Inter', sans-serif;
            min-height: 100vh;
            width: 100vw;
            overflow-x: hidden;
            position: relative;
            background-color: var(--background-dark);
            color: var(--text-dark);
        }

        .chat-wrapper {
            padding-top: 5rem;
            min-height: 100vh;
            position: relative;
            z-index: 10;
        }

        html.light-mode .chat-wrapper {
            background-color: var(--background-light);
        }

        .chat-container {
            background-color: rgba(17, 24, 39, 0.8);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 1.5rem;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
            transition: all 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            transform-style: preserve-3d;
            perspective: 1500px;
        }

        html.light-mode .chat-container {
            background-color: rgba(219, 214, 178, 0.8);
            border-color: rgba(197, 193, 160, 0.5);
        }

        .chat-container:hover {
            transform: translateY(-8px) rotateX(5deg) rotateY(5deg);
            box-shadow: 0 30px 60px rgba(0, 0, 0, 0.4);
        }

        html.light-mode .chat-container:hover {
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.15);
        }

        /* Enhanced animations for aurora effect */
        .aurora {
            position: fixed;
            width: 100vw;
            height: 100vh;
            top: 0;
            left: 0;
            z-index: 2;
            pointer-events: none;
            overflow: hidden;
        }

        .aurora__item {
            overflow: hidden;
            position: absolute;
            width: 80%;
            height: 80%;
            background: linear-gradient(90deg, #3b82f6 0%, #8b5cf6 50%, #ec4899 100%);
            border-radius: 37% 29% 27% 27% / 28% 25% 41% 37%;
            filter: blur(100px);
            opacity: 0.1;
            animation: aurora 25s ease infinite;
        }

        .aurora__item:nth-of-type(1) {
            top: -30%;
            left: -20%;
            animation-delay: 0s;
            background: linear-gradient(90deg, #3b82f6 0%, #8b5cf6 50%, #ec4899 100%);
        }

        .aurora__item:nth-of-type(2) {
            bottom: -30%;
            right: -20%;
            animation-delay: -5s;
            background: linear-gradient(90deg, #eab308 0%, #ea580c 50%, #db2777 100%);
        }

        html.light-mode .aurora__item {
            opacity: 0.05;
        }

        html.light-mode .aurora__item:nth-of-type(1) {
            background: linear-gradient(90deg, #4f46e5 0%, #7c3aed 50%, #db2777 100%);
        }

        html.light-mode .aurora__item:nth-of-type(2) {
            background: linear-gradient(90deg, #eab308 0%, #ea580c 50%, #db2777 100%);
        }

        @keyframes aurora {
            0% {
                transform: rotate(0deg) scale(1);
            }

            50% {
                transform: rotate(180deg) scale(1.2);
            }

            100% {
                transform: rotate(360deg) scale(1);
            }
        }

        /* Particles background */
        #particles-js {
            position: fixed;
            width: 100vw;
            height: 100vh;
            top: 0;
            left: 0;
            z-index: 1;
            pointer-events: none;
            overflow: hidden;
        }

        html.light-mode body {
            background-color: var(--background-light);
            color: var(--text-light);
        }

        html.light-mode .aurora__item {
            opacity: 0.05;
        }

        html.light-mode .aurora__item:nth-of-type(1) {
            background: linear-gradient(90deg, #4f46e5 0%, #7c3aed 50%, #db2777 100%);
        }

        html.light-mode .aurora__item:nth-of-type(2) {
            background: linear-gradient(90deg, #eab308 0%, #ea580c 50%, #db2777 100%);
        }

        /* Base theme variables from theme.php */
        :root {
            --background-dark: #0f172a;
            --background-light: #dbd6b2;
            --text-dark: #f8fafc;
            --text-light: #0f172a;
        }

        /* Chat specific styles with theme integration */
        .message-container {
            height: calc(100vh - 200px);
            max-height: 800px;
            overflow-y: auto;
            scroll-behavior: smooth;
            padding: 1rem 1.5rem;
            background-color: rgba(17, 24, 39, 0.4);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 1rem;
            transition: all 0.3s ease;
        }

        html.light-mode .message-container {
            background-color: rgba(219, 214, 178, 0.4);
            border-color: rgba(197, 193, 160, 0.5);
        }

        .message-container::-webkit-scrollbar {
            width: 6px;
        }

        .message-container::-webkit-scrollbar-track {
            background: rgba(255, 255, 255, 0.1);
            border-radius: 3px;
        }

        .message-container::-webkit-scrollbar-thumb {
            background: rgba(255, 255, 255, 0.2);
            border-radius: 3px;
        }

        html.light-mode .message-container::-webkit-scrollbar-track {
            background: rgba(0, 0, 0, 0.1);
        }

        html.light-mode .message-container::-webkit-scrollbar-thumb {
            background: rgba(0, 0, 0, 0.2);
        }

        .message {
            animation: fadeIn 0.3s ease-out;
            background-color: rgba(31, 41, 55, 0.6);
            backdrop-filter: blur(8px);
            -webkit-backdrop-filter: blur(8px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 1rem;
            padding: 1.5rem;
            margin-bottom: 1rem;
            transition: all 0.3s ease;
            max-width: 100%;
            margin-left: auto;
            margin-right: auto;
        }

        html.light-mode .message {
            background-color: rgba(208, 202, 166, 0.7);
            border-color: rgba(197, 193, 160, 0.5);
        }

        .message:hover {
            transform: translateY(-2px);
            background-color: rgba(31, 41, 55, 0.8);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        html.light-mode .message:hover {
            background-color: rgba(208, 202, 166, 0.8);
        }

        .message-content {
            color: var(--text-dark);
        }

        html.light-mode .message-content {
            color: var(--text-light);
        }

        .profile-image {
            width: 48px;
            height: 48px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.25rem;
            border-radius: 9999px;
            background: linear-gradient(to right, #4f46e5, #6366f1);
            color: white;
            transition: transform 0.3s ease;
        }

        html.light-mode .profile-image {
            background: linear-gradient(to right, #4338ca, #4f46e5);
        }

        .profile-image:hover {
            transform: scale(1.05);
        }

        .message-meta {
            color: rgba(255, 255, 255, 0.6);
        }

        html.light-mode .message-meta {
            color: rgba(15, 23, 42, 0.6);
        }

        .verified-badge {
            color: #4f46e5;
        }

        html.light-mode .verified-badge {
            color: #4338ca;
        }

        .message-input-wrapper {
            position: relative;
            padding: 1rem;
            margin: 1rem;
            background-color: rgba(17, 24, 39, 0.8);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 1rem;
            transition: all 0.3s ease;
        }

        html.light-mode .message-input-wrapper {
            background-color: rgba(219, 214, 178, 0.8);
            border-color: rgba(197, 193, 160, 0.5);
        }

        .message-input {
            width: 100%;
            background: transparent;
            border: none;
            color: var(--text-dark);
            font-size: 1rem;
            padding: 0.5rem;
            outline: none;
        }

        html.light-mode .message-input {
            color: var(--text-light);
        }

        .message-input::placeholder {
            color: rgba(255, 255, 255, 0.5);
        }

        html.light-mode .message-input::placeholder {
            color: rgba(15, 23, 42, 0.5);
        }

        .post-button {
            background: linear-gradient(to right, #4f46e5, #6366f1);
            color: white;
            padding: 0.5rem 1.5rem;
            border-radius: 9999px;
            font-weight: 600;
            transition: all 0.3s ease;
            opacity: 0.5;
            cursor: not-allowed;
        }

        .post-button.active {
            opacity: 1;
            cursor: pointer;
        }

        .post-button.active:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(79, 70, 229, 0.3);
        }

        .message-actions {
            display: flex;
            gap: 1.5rem;
            margin-top: 1rem;
            padding: 0.5rem;
        }

        .message-action {
            color: rgba(255, 255, 255, 0.6);
            transition: all 0.3s ease;
            padding: 0.5rem;
            border-radius: 9999px;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        html.light-mode .message-action {
            color: rgba(15, 23, 42, 0.6);
        }

        .message-action:hover {
            transform: translateY(-2px);
        }

        .message-action.heart:hover {
            color: #ef4444;
            background-color: rgba(239, 68, 68, 0.1);
        }

        .message-action.comment:hover {
            color: #3b82f6;
            background-color: rgba(59, 130, 246, 0.1);
        }

        .message-action.share:hover {
            color: #10b981;
            background-color: rgba(16, 185, 129, 0.1);
        }

        .message-action.liked {
            color: #ef4444;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Aurora effect integration */
        .chat-wrapper {
            position: relative;
            z-index: 10;
        }

        /* Responsive design */
        @media (max-width: 768px) {
            .message-container {
                height: calc(100vh - 250px);
            }

            .message-actions {
                flex-wrap: wrap;
            }
        }

        /* Light mode styles */
        html.light-mode .chat-container {
            background-color: rgba(255, 255, 255, 0.95);
            border-color: rgba(230, 230, 230, 1);
        }

        html.light-mode .message {
            background-color: rgba(208, 202, 166, 0.7);
            border-color: rgba(197, 193, 160, 0.5);
        }

        html.light-mode .message:hover {
            background-color: rgba(208, 202, 166, 0.8);
        }

        html.light-mode .chat-wrapper {
            background-color: var(--background-light);
        }

        html.light-mode .message-input {
            color: var(--text-light);
        }

        html.light-mode .message-input::placeholder {
            color: rgba(15, 23, 42, 0.5);
        }

        /* Add padding for navbar */
        .chat-wrapper {
            padding-top: 5rem;
            min-height: 100vh;
            background-color: rgb(17, 24, 39);
        }

        html.light-mode .chat-wrapper {
            background-color: rgb(247, 247, 247);
        }

        .chat-container {
            display: flex;
            flex-direction: column;
            max-height: calc(100vh - 100px);
        }

        .message-content {
            padding-left: 1rem;
            flex: 1;
        }

        /* New Post button styling */
        .new-post-button {
            position: fixed;
            bottom: 2rem;
            right: 2rem;
            background: linear-gradient(to right, #4f46e5, #6366f1);
            color: white;
            padding: 0.75rem 1.5rem;
            border-radius: 9999px;
            font-weight: 600;
            box-shadow: 0 4px 12px rgba(79, 70, 229, 0.3);
            transition: all 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            z-index: 50;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            transform-style: preserve-3d;
            perspective: 1000px;
        }

        html.light-mode .new-post-button {
            background: linear-gradient(to right, #4338ca, #4f46e5);
            box-shadow: 0 4px 12px rgba(67, 56, 202, 0.3);
        }

        .new-post-button:hover {
            transform: translateY(-2px) scale(1.05);
            box-shadow: 0 6px 20px rgba(79, 70, 229, 0.4);
        }

        html.light-mode .new-post-button:hover {
            box-shadow: 0 6px 20px rgba(67, 56, 202, 0.4);
        }

        .new-post-button i {
            font-size: 1.2rem;
            transition: transform 0.3s ease;
        }

        .new-post-button:hover i {
            transform: rotate(90deg);
        }

        /* Post form overlay styling */
        .post-form-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(15, 23, 42, 0.8);
            z-index: 100;
            backdrop-filter: blur(8px);
            -webkit-backdrop-filter: blur(8px);
        }

        html.light-mode .post-form-overlay {
            background-color: rgba(219, 214, 178, 0.8);
        }

        /* Post form container styling */
        .post-form-container {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 90%;
            max-width: 600px;
            background-color: rgba(17, 24, 39, 0.95);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 1.5rem;
            padding: 1.5rem;
            z-index: 101;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
            transition: all 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            transform-style: preserve-3d;
            perspective: 1500px;
        }

        html.light-mode .post-form-container {
            background-color: rgba(219, 214, 178, 0.95);
            border-color: rgba(197, 193, 160, 0.5);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.2);
        }

        .post-form-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        html.light-mode .post-form-header {
            border-color: rgba(197, 193, 160, 0.5);
        }

        .post-form-header h2 {
            font-size: 1.5rem;
            font-weight: 700;
            background: linear-gradient(to right, #4f46e5, #6366f1);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
        }

        html.light-mode .post-form-header h2 {
            background: linear-gradient(to right, #4338ca, #4f46e5);
            -webkit-background-clip: text;
            background-clip: text;
        }

        .close-button {
            color: rgba(255, 255, 255, 0.6);
            padding: 0.5rem;
            border-radius: 9999px;
            transition: all 0.3s ease;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(4px);
            -webkit-backdrop-filter: blur(4px);
        }

        html.light-mode .close-button {
            color: rgba(15, 23, 42, 0.6);
            background: rgba(197, 193, 160, 0.3);
        }

        .close-button:hover {
            color: white;
            background: rgba(255, 255, 255, 0.2);
            transform: rotate(90deg);
        }

        html.light-mode .close-button:hover {
            color: rgba(15, 23, 42, 0.9);
            background: rgba(197, 193, 160, 0.5);
        }

        /* Message form styling */
        #messageForm {
            display: flex;
            flex-direction: column;
            gap: 1.5rem;
        }

        .message-input-wrapper {
            background-color: rgba(31, 41, 55, 0.6);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 1rem;
            padding: 1rem;
            transition: all 0.3s ease;
        }

        html.light-mode .message-input-wrapper {
            background-color: rgba(208, 202, 166, 0.6);
            border-color: rgba(197, 193, 160, 0.5);
        }

        .message-input-wrapper:focus-within {
            border-color: #4f46e5;
            box-shadow: 0 0 0 2px rgba(79, 70, 229, 0.2);
        }

        html.light-mode .message-input-wrapper:focus-within {
            border-color: #4338ca;
            box-shadow: 0 0 0 2px rgba(67, 56, 202, 0.2);
        }

        .character-count {
            position: absolute;
            right: 1rem;
            bottom: 1rem;
            font-size: 0.875rem;
            color: rgba(255, 255, 255, 0.5);
            transition: all 0.3s ease;
        }

        html.light-mode .character-count {
            color: rgba(15, 23, 42, 0.5);
        }

        .character-count.near-limit {
            color: #eab308;
        }

        .character-count.at-limit {
            color: #ef4444;
        }

        /* Post button styling */
        .post-button {
            background: linear-gradient(to right, #4f46e5, #6366f1);
            color: white;
            padding: 0.75rem 2rem;
            border-radius: 9999px;
            font-weight: 600;
            transition: all 0.3s ease;
            opacity: 0.5;
            cursor: not-allowed;
            box-shadow: 0 4px 12px rgba(79, 70, 229, 0.3);
        }

        html.light-mode .post-button {
            background: linear-gradient(to right, #4338ca, #4f46e5);
            box-shadow: 0 4px 12px rgba(67, 56, 202, 0.3);
        }

        .post-button.active {
            opacity: 1;
            cursor: pointer;
        }

        .post-button.active:hover {
            transform: translateY(-2px) scale(1.05);
            box-shadow: 0 6px 20px rgba(79, 70, 229, 0.4);
        }

        html.light-mode .post-button.active:hover {
            box-shadow: 0 6px 20px rgba(67, 56, 202, 0.4);
        }

        /* Update message text colors */
        .message-content {
            color: var(--text-dark);
        }

        html.light-mode .message-content {
            color: var(--text-light);
        }

        .text-white {
            color: var(--text-dark);
        }

        html.light-mode .text-white {
            color: var(--text-light);
        }

        /* Update message background */
        .message {
            background-color: rgba(31, 41, 55, 0.6);
            border: 1px solid rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(8px);
            -webkit-backdrop-filter: blur(8px);
        }

        /* Update chat container background */
        .chat-container {
            background-color: rgba(17, 24, 39, 0.8);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
        }

        /* Update message meta text */
        .message-meta {
            color: rgba(255, 255, 255, 0.6);
        }

        html.light-mode .message-meta {
            color: rgba(15, 23, 42, 0.6);
        }

        /* Update timestamp color */
        .text-gray-500 {
            color: rgba(255, 255, 255, 0.5);
        }

        html.light-mode .text-gray-500 {
            color: rgba(15, 23, 42, 0.5);
        }

        /* Update message text */
        .message div.mt-2 {
            color: var(--text-dark);
        }

        html.light-mode .message div.mt-2 {
            color: var(--text-light);
        }

        /* Update container responsiveness */
        .container {
            width: 100%;
            max-width: none;
            padding-left: 1rem;
            padding-right: 1rem;
        }

        @media (min-width: 640px) {
            .container {
                padding-left: 2rem;
                padding-right: 2rem;
            }
        }

        @media (min-width: 1024px) {
            .container {
                padding-left: 4rem;
                padding-right: 4rem;
            }
        }

        /* Adjust message container for wider screens */
        .message-container {
            height: calc(100vh - 200px);
            max-height: 800px;
            overflow-y: auto;
        }

        @media (min-width: 1536px) {
            .message-container {
                max-height: 900px;
            }
        }

        /* Adjust message layout for wider screens */
        .message {
            max-width: 100%;
            margin-left: auto;
            margin-right: auto;
        }

        @media (min-width: 1024px) {
            .message {
                padding: 2rem;
            }
        }
    </style>
</head>

<body class="overflow-x-hidden bg-gray-900 text-white min-h-screen">
    <div id="particles-js"></div>
    <div class="aurora">
        <div class="aurora__item"></div>
        <div class="aurora__item"></div>
    </div>

    <div class="relative z-20">
        <?php require './nav.php'; ?>
    </div>

    <div class="relative z-10 container mx-auto px-4 py-24 flex justify-center">
        <div
            class="chat-container bg-gray-900/80 backdrop-blur-xl border border-gray-700/30 rounded-3xl p-8 w-full max-w-[90%] xl:max-w-[80%] 2xl:max-w-[70%] shadow-2xl mt-10">
            
            <div
                class="border-b border-gray-700/30 p-4 sticky top-0 backdrop-blur-lg bg-gray-800/90 z-10 rounded-t-3xl">
                <div class="flex items-center justify-end">
                    <div class="flex items-center gap-2">
                        <div
                            class="w-10 h-10 rounded-full bg-gradient-to-r from-blue-600 to-purple-600 flex items-center justify-center text-white text-sm font-medium profile-image cursor-pointer">
                            <?php echo strtoupper(substr($current_user_name, 0, 1)); ?>
                        </div>
                    </div>
                </div>
            </div>

            
            <button class="new-post-button m-5 " id="newPostButton">
                <i class="fas fa-feather"></i>
                New Post
            </button>

            
            <div class="post-form-overlay" id="postFormOverlay">
                <div class="post-form-container">
                    <div class="post-form-header">
                        <h2>Create a post</h2>
                        <button class="close-button" id="closeFormButton">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                    <form id="messageForm" class="flex flex-col gap-4">
                        <div class="flex gap-4 items-start">
                            <div
                                class="w-12 h-12 rounded-full bg-gradient-to-r from-indigo-600 to-purple-600 flex-shrink-0 flex items-center justify-center text-white font-medium">
                                <?php echo strtoupper(substr($current_user_name, 0, 1)); ?>
                            </div>
                            <div class="flex-1 message-input-wrapper">
                                <textarea id="messageInput" name="message" rows="4"
                                    class="message-input w-full bg-transparent resize-none border-none focus:outline-none focus:ring-0"
                                    placeholder="What's happening?" maxlength="280"></textarea>
                                <div class="character-count">280</div>
                            </div>
                        </div>
                        <div class="flex justify-end mt-2">
                            <button type="submit" disabled class="post-button">
                                Post
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            
            <div class="message-container" id="messageContainer">
                <?php
                $messages_query = "SELECT m.*, 
                    (SELECT COUNT(*) FROM chat_likes WHERE message_id = m.id) as like_count,
                    EXISTS(SELECT 1 FROM chat_likes WHERE message_id = m.id AND user_email = '$email') as is_liked
                    FROM chat_messages m 
                    ORDER BY timestamp DESC LIMIT 50";
                $messages_result = mysqli_query($conn, $messages_query);

                if (!$messages_result) {
                    echo '<div class="text-red-500 p-4">Error loading messages: ' . mysqli_error($conn) . '</div>';
                } else {
                    $messages = array();
                    while ($message = mysqli_fetch_assoc($messages_result)) {
                        array_unshift($messages, $message);
                    }

                    foreach ($messages as $message) {
                        $is_sender = $message['sender_email'] === $email;
                        $is_liked = $message['is_liked'];
                        ?>
                        <div class="message" data-message-id="<?php echo $message['id']; ?>">
                            <div class="flex gap-4">
                                <div class="profile-image">
                                    <?php echo strtoupper(substr($message['sender_name'], 0, 1)); ?>
                                </div>
                                <div class="message-content flex-1">
                                    <div class="flex items-center gap-1 message-meta">
                                        <span class="font-bold hover:underline cursor-pointer">
                                            <?php echo htmlspecialchars($message['sender_name']); ?>
                                        </span>
                                        <?php if ($is_sender): ?>
                                            <i class="fas fa-check-circle verified-badge text-sm"></i>
                                        <?php endif; ?>
                                        <span class="text-gray-500 text-sm">•
                                            <?php echo date('M j', strtotime($message['timestamp'])); ?></span>
                                    </div>
                                    <div class="mt-2 mb-3">
                                        <?php echo htmlspecialchars($message['message']); ?>
                                    </div>
                                    <div class="message-actions">
                                        <button class="message-action comment">
                                            <i class="far fa-comment"></i>
                                            <span>0</span>
                                        </button>
                                        <button class="message-action heart <?php echo $is_liked ? 'liked' : ''; ?>"
                                            onclick="toggleLike(<?php echo $message['id']; ?>)">
                                            <i class="<?php echo $is_liked ? 'fas' : 'far'; ?> fa-heart"></i>
                                            <span><?php echo $message['like_count']; ?></span>
                                        </button>
                                        <button class="message-action share">
                                            <i class="far fa-share-square"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                }
                ?>
            </div>
        </div>
    </div>

    <script>
        const messageForm = document.getElementById('messageForm');
        const messageInput = document.getElementById('messageInput');
        const messageContainer = document.getElementById('messageContainer');
        const characterCount = document.querySelector('.character-count');
        const postButton = messageForm.querySelector('button[type="submit"]');
        let lastMessageId = 0;

        
        async function initializeTables() {
            try {
                const response = await fetch('chat_handler.php?action=create_tables');
                const result = await response.text();
                console.log('Table creation result:', result);
            } catch (error) {
                console.error('Error creating tables:', error);
            }
        }

        
        initializeTables();

        const messages = document.querySelectorAll('.message');
        if (messages.length > 0) {
            const lastMessage = messages[messages.length - 1];
            lastMessageId = parseInt(lastMessage.dataset.messageId) || 0;
        }

        messageInput.addEventListener('input', () => {
            const remaining = 280 - messageInput.value.length;
            characterCount.textContent = remaining;

            if (remaining === 280) {
                postButton.disabled = true;
                postButton.classList.remove('active');
            } else {
                postButton.disabled = false;
                postButton.classList.add('active');
            }

            if (remaining <= 20) {
                characterCount.classList.add('near-limit');
            } else {
                characterCount.classList.remove('near-limit');
            }

            if (remaining <= 0) {
                characterCount.classList.add('at-limit');
            } else {
                characterCount.classList.remove('at-limit');
            }
        });

        messageInput.addEventListener('input', function () {
            this.style.height = 'auto';
            this.style.height = (this.scrollHeight) + 'px';
        });

        function scrollToBottom() {
            messageContainer.scrollTop = messageContainer.scrollHeight;
        }

        function formatTime(timestamp) {
            const date = new Date(timestamp);
            return date.toLocaleString('en-US', {
                month: 'short',
                day: 'numeric',
                hour: 'numeric',
                minute: 'numeric',
                hour12: true
            });
        }

        function createMessageHTML(message) {
            const isLiked = message.is_liked ? 'liked' : '';
            const heartIcon = message.is_liked ? 'fas' : 'far';

            return `
                <div class="message" data-message-id="${message.id}">
                    <div class="flex gap-4">
                        <div class="profile-image">
                            ${message.sender_name.charAt(0).toUpperCase()}
                        </div>
                        <div class="message-content flex-1">
                            <div class="flex items-center gap-1 message-meta">
                                <span class="font-bold hover:underline cursor-pointer">
                                    ${message.sender_name}
                                </span>
                                ${message.is_sender ? '<i class="fas fa-check-circle verified-badge text-sm"></i>' : ''}
                                <span class="text-gray-500 text-sm">• ${formatTime(message.timestamp)}</span>
                            </div>
                            <div class="text-white mt-2">
                                ${message.message}
                            </div>
                            <div class="message-actions">
                                <button class="message-action comment">
                                    <i class="far fa-comment"></i>
                                    <span>0</span>
                                </button>
                                <button class="message-action heart ${isLiked}" onclick="toggleLike(${message.id})">
                                    <i class="${heartIcon} fa-heart"></i>
                                    <span>${message.like_count || 0}</span>
                                </button>
                                <button class="message-action share">
                                    <i class="far fa-share-square"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            `;
        }

        async function toggleLike(messageId) {
            try {
                const response = await fetch('toggle_like.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({ message_id: messageId })
                });

                if (response.ok) {
                    const button = document.querySelector(`[data-message-id="${messageId}"] .heart`);
                    const icon = button.querySelector('i');
                    const count = button.querySelector('span');

                    button.classList.toggle('liked');
                    if (button.classList.contains('liked')) {
                        icon.classList.replace('far', 'fas');
                        count.textContent = parseInt(count.textContent) + 1;
                    } else {
                        icon.classList.replace('fas', 'far');
                        count.textContent = parseInt(count.textContent) - 1;
                    }
                }
            } catch (error) {
                console.error('Error toggling like:', error);
            }
        }

        async function fetchNewMessages() {
            try {
                const response = await fetch(`chat_handler.php?last_id=${lastMessageId}`);
                const newMessages = await response.json();

                if (newMessages.length > 0) {
                    newMessages.forEach(message => {
                        messageContainer.insertAdjacentHTML('beforeend', createMessageHTML(message));
                        lastMessageId = Math.max(lastMessageId, message.id);
                    });
                    scrollToBottom();
                }
            } catch (error) {
                console.error('Error loading messages:', error);
            }
        }

        scrollToBottom();

        const newPostButton = document.getElementById('newPostButton');
        const postFormOverlay = document.getElementById('postFormOverlay');
        const closeFormButton = document.getElementById('closeFormButton');

        newPostButton.addEventListener('click', () => {
            postFormOverlay.style.display = 'block';
            document.body.style.overflow = 'hidden'; 
            messageInput.focus(); 
        });

        function hidePostForm() {
            postFormOverlay.style.display = 'none';
            document.body.style.overflow = ''; 
            messageInput.value = '';
            characterCount.textContent = '280'; 
            postButton.disabled = true;
            postButton.classList.remove('active');
        }

        closeFormButton.addEventListener('click', (e) => {
            e.preventDefault();
            hidePostForm();
        });

        postFormOverlay.addEventListener('click', (e) => {
            if (e.target === postFormOverlay) {
                hidePostForm();
            }
        });

        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape' && postFormOverlay.style.display === 'block') {
                hidePostForm();
            }
        });

        messageForm.addEventListener('submit', async (e) => {
            e.preventDefault();
            const message = messageInput.value.trim();

            if (message) {
                const formData = new FormData();
                formData.append('message', message);

                try {
                    const response = await fetch('chat.php', {
                        method: 'POST',
                        body: formData
                    });

                    if (response.ok) {
                        hidePostForm(); 
                        await fetchNewMessages();
                    }
                } catch (error) {
                    console.error('Error sending message:', error);
                }
            }
        });

        const loadingIndicator = document.createElement('div');
        loadingIndicator.className = 'hidden fixed bottom-4 right-4 bg-blue-600 text-white px-4 py-2 rounded-full shadow-lg';
        loadingIndicator.innerHTML = '<i class="fas fa-sync fa-spin mr-2"></i> Updating...';
        document.body.appendChild(loadingIndicator);

        let loadingTimeout;
        const originalFetch = window.fetch;
        window.fetch = async (...args) => {
            loadingIndicator.classList.remove('hidden');
            try {
                const response = await originalFetch(...args);
                return response;
            } finally {
                clearTimeout(loadingTimeout);
                loadingTimeout = setTimeout(() => {
                    loadingIndicator.classList.add('hidden');
                }, 500);
            }
        };

        document.querySelectorAll('.profile-image').forEach(image => {
            image.addEventListener('mouseenter', () => {
                image.style.transform = 'scale(1.05)';
            });
            image.addEventListener('mouseleave', () => {
                image.style.transform = 'scale(1)';
            });
        });
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/particles.js/2.0.0/particles.min.js"></script>
    <script>
        particlesJS('particles-js', {
            particles: {
                number: { value: 50, density: { enable: true, value_area: 800 } },
                color: { value: '#ffffff' },
                shape: { type: 'circle' },
                opacity: {
                    value: 0.2,
                    random: true,
                    animation: { enable: true, speed: 1, minimumValue: 0.1, sync: false }
                },
                size: {
                    value: 3,
                    random: true,
                    animation: { enable: true, speed: 2, minimumValue: 0.3, sync: false }
                },
                move: {
                    enable: true,
                    speed: 1,
                    direction: 'none',
                    random: false,
                    straight: false,
                    outModes: { default: 'out' },
                    attract: { enable: false, rotateX: 600, rotateY: 1200 }
                }
            },
            interactivity: {
                detectsOn: 'canvas',
                events: {
                    onhover: { enable: true, mode: 'repulse' },
                    resize: true
                },
                modes: {
                    repulse: { distance: 100, duration: 0.4 }
                }
            },
            retina_detect: true
        });

        function applyParticlesTheme() {
            const currentTheme = localStorage.getItem('theme') || 'dark';
            if (currentTheme === 'light') {
                if (window.pJSDom && window.pJSDom[0] && window.pJSDom[0].pJS) {
                    window.pJSDom[0].pJS.particles.color.value = '#475569';
                }
            }
        }

        document.addEventListener('DOMContentLoaded', function () {
            applyParticlesTheme();
        });
    </script>
</body>

</html>
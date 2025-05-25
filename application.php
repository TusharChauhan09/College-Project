<?php
require './auth.php';
?>

<div
    class="application-form bg-gradient-to-br from-gray-900/80 to-gray-800/80 p-6 rounded-3xl border border-gray-700/30 backdrop-blur-xl shadow-2xl max-w-md mx-auto mt-12">
    <form action="profile.php" method="POST" enctype="multipart/form-data" class="space-y-6">
        <div class="space-y-2">
            <label class="block text-sm font-medium text-gray-300">Profile Image</label>
            <div class="mt-1 flex items-center justify-center w-full">
                <label
                    class="w-full flex flex-col items-center px-4 py-6 bg-gray-800/50 text-gray-300 rounded-xl border-2 border-gray-700/30 border-dashed cursor-pointer hover:bg-gray-800/70 transition-all duration-300">
                    <svg class="w-8 h-8 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                    <span class="text-sm">Upload Profile Image</span>
                    <input type="file" name="profile" class="hidden" accept="image/*" required>
                </label>
            </div>
        </div>

        <div class="space-y-2">
            <label class="block text-sm font-medium text-gray-300">Resume</label>
            <div class="mt-1 flex items-center justify-center w-full">
                <label
                    class="w-full flex flex-col items-center px-4 py-6 bg-gray-800/50 text-gray-300 rounded-xl border-2 border-gray-700/30 border-dashed cursor-pointer hover:bg-gray-800/70 transition-all duration-300">
                    <svg class="w-8 h-8 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                        </path>
                    </svg>
                    <span class="text-sm">Upload Resume (PDF)</span>
                    <input type="file" name="resume" class="hidden" accept="image/*" required>
                </label>
            </div>
        </div>

        <div class="space-y-2">
            <label class="block text-sm font-medium text-gray-300">Position</label>
            <select name="post" required
                class="w-full px-4 py-2.5 bg-gray-800/50 border border-gray-700/30 rounded-xl text-gray-300 focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all duration-300">
                <option value="">Select Position</option>
                <option value="Frontend Developer">Frontend Developer</option>
                <option value="Backend Developer">Backend Developer</option>
                <option value="Full Stack Developer">Full Stack Developer</option>
                <option value="UI/UX Designer">UI/UX Designer</option>
                <option value="Product Manager">Product Manager</option>
            </select>
        </div>

        <div class="space-y-2">
            <label class="block text-sm font-medium text-gray-300">About You</label>
            <textarea name="about" rows="4" required
                class="w-full px-4 py-2.5 bg-gray-800/50 border border-gray-700/30 rounded-xl text-gray-300 focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all duration-300 resize-none"
                placeholder="Tell us about yourself..."></textarea>
        </div>

        <div class="flex justify-end space-x-4">
            <button type="submit" name="submit"
                class="px-6 py-2.5 bg-gradient-to-r from-purple-600 to-pink-600 text-white font-medium rounded-xl shadow-lg transition-all duration-300 hover:from-purple-500 hover:to-pink-500 hover:-translate-y-1 hover:shadow-xl focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500">
                Submit Application
            </button>
        </div>
    </form>
</div>

<style>
    html.light-mode .application-form {
        background: linear-gradient(to bottom right, rgba(219, 214, 178, 0.8), rgba(197, 193, 160, 0.8));
        border-color: rgba(197, 193, 160, 0.5);
    }

    html.light-mode .application-form label {
        color: var(--text-primary-light);
    }

    html.light-mode .application-form select,
    html.light-mode .application-form textarea {
        background-color: rgba(255, 255, 255, 0.1);
        border-color: rgba(197, 193, 160, 0.5);
        color: var(--text-primary-light);
    }

    html.light-mode .application-form select option {
        background-color: var(--bg-color-light);
        color: var(--text-primary-light);
    }

    html.light-mode .application-form label[for="profile"],
    html.light-mode .application-form label[for="resume"] {
        background-color: rgba(255, 255, 255, 0.1);
        border-color: rgba(197, 193, 160, 0.5);
        color: var(--text-primary-light);
    }

    input[type="file"]::file-selector-button {
        display: none;
    }

    .application-form {
        animation: fadeIn 0.5s ease-out;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(20px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .application-form select:focus,
    .application-form textarea:focus {
        box-shadow: 0 0 0 2px rgba(99, 102, 241, 0.2);
    }

    .application-form label:hover {
        transform: translateY(-1px);
    }
</style>
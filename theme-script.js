// Apply theme immediately when script is loaded
(function () {
  const currentTheme = localStorage.getItem("theme") || "dark";
  document.documentElement.classList.toggle(
    "light-mode",
    currentTheme === "light"
  );

  // Add CSS variables for theme colors
  document.documentElement.style.setProperty("--background-dark", "#0f172a");
  document.documentElement.style.setProperty("--background-light", "#dbd6b2");
  document.documentElement.style.setProperty("--text-dark", "#f8fafc");
  document.documentElement.style.setProperty("--text-light", "#1e293b");

  // Apply basic styles for common elements
  if (currentTheme === "light") {
    // Add light mode styles for body and common elements
    const styleElement = document.createElement("style");
    styleElement.textContent = `
      body { 
        background-color: #dbd6b2 !important; 
        color: #1e293b !important;
      }
      .bg-gray-900, .bg-gray-800 { 
        background-color: #dbd6b2 !important; 
      }
      .text-white, .text-gray-100 { 
        color: #0f172a !important; 
      }
      .text-gray-300, .text-gray-400 { 
        color: #334155 !important; 
      }
      .border-gray-700 { 
        border-color: #c5c1a0 !important; 
      }
      .bg-gradient-to-r { 
        background: linear-gradient(to right, #dbd6b2, #d0caa6, #dbd6b2) !important; 
      }
    `;
    document.head.appendChild(styleElement);
  }
})();

// Listen for DOM content loaded to initialize theme controls if they exist
document.addEventListener("DOMContentLoaded", function () {
  // Add theme toggle listener if toggle exists
  const themeToggle = document.getElementById("themeToggle");
  if (themeToggle) {
    themeToggle.addEventListener("click", function () {
      toggleTheme();
    });
  }
});

// Function to toggle theme
function toggleTheme() {
  const currentTheme = localStorage.getItem("theme") || "dark";
  const newTheme = currentTheme === "dark" ? "light" : "dark";

  localStorage.setItem("theme", newTheme);
  document.documentElement.classList.toggle("light-mode", newTheme === "light");

  // Reload page to apply all styles properly
  window.location.reload();
}

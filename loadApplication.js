function loadApplication() {
  fetch("application.php")
    .then((response) => response.text())
    .then((data) => {
      let newDiv = document.createElement("div");
      newDiv.innerHTML = data;
      document.querySelector(".result").appendChild(newDiv); // Append to .result
    })
    .catch((error) => console.error("Error loading application:", error));

  // Hide the Update Profile button
  const updateButton = document.querySelector(".update-btn");
  if (updateButton) {
    updateButton.style.display = "none";
  }

  let newDiv = document.createElement("div");
  newDiv.id = "cancel";
  newDiv.classList.add(
    "group",
    "py-2",
    "px-4",
    "bg-red-300",
    "mt-10",
    "text-gray-300",
    "border",
    "rounded-xl",
    "font-bold",
    "hover:cursor-pointer",
    "hover:bg-gray-800"
  );
  newDiv.innerHTML = `
        <button class="px-4 py-2  rounded-md transition cursor-pointer " onclick="unloadApplication()">
            Cancel
        </button>
        `;
  document.querySelector(".card").appendChild(newDiv);
}

// function cancel() {
//     fetch("application.php") // Fetch the PHP file
//         .then(response => response.text()) // Convert response to text
//         .then(data => {
//             let newDiv = document.createElement("div"); // Create a new div
//             newDiv.innerHTML = data; // Add fetched content inside it
//             document.querySelector(".result").appendChild(newDiv); // Append to .result
//         })
//         .catch(error => console.error("Error loading application:", error));
// }

function unloadApplication() {
  let resultContainer1 = document.querySelector(".result");
  if (resultContainer1.lastElementChild) {
    resultContainer1.removeChild(resultContainer1.lastElementChild); // Remove the last child
  }
  let resultContainer2 = document.querySelector(".card");
  if (resultContainer2.lastElementChild) {
    resultContainer2.removeChild(resultContainer2.lastElementChild); // Remove the last child
  }

  // Show the Update Profile button again
  const updateButton = document.querySelector(".update-btn");
  if (updateButton) {
    updateButton.style.display = "inline-flex";
  }
}

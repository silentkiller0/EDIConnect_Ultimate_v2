const navItems = document.querySelectorAll(".nav-item");

navItems.forEach((navItem, i) => {
  navItem.addEventListener("click", () => {
    navItems.forEach((item, j) => {
      item.className = "nav-item";
    });
    navItem.className = "nav-item active";
  });
});

// JavaScript code to allow only one checkbox to be checked at a time
const checkboxes = document.querySelectorAll('.filtre-ck');
checkboxes.forEach((checkbox) => {
  checkbox.addEventListener('change', () => {
    if (checkbox.checked) {
      checkboxes.forEach((cb) => {
        if (cb !== checkbox) {
          cb.checked = false;
        }
      });
    }
  });
});

// Function to generate the URL
function generateURL() {
  // Logic to generate the URL
  var generatedURL = "http://example.com"; // Replace with your generated URL
  document.getElementById("generated-url").textContent = generatedURL;
}

// Function to copy the URL to the clipboard
function copyURL() {
  var urlElement = document.getElementById("generated-url");
  var range = document.createRange();
  range.selectNode(urlElement);
  window.getSelection().removeAllRanges(); // Clear any current selection
  window.getSelection().addRange(range); // Add the text to the selection range
  document.execCommand("copy"); // Copy the selected text to the clipboard
  window.getSelection().removeAllRanges(); // Clear the selection range
  alert("Lien copié !");
}

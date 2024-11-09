// js for navigation bar

fetch("nav.html")
.then((response) => response.text())
.then((html) => {
  document.getElementById("includedContent").innerHTML = html;
});


fetch("footer.html")
  .then((response) => response.text())
  .then((html) => {
    document.getElementById("includedContent0").innerHTML = html;
  });

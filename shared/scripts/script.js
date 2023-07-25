function showElement(element) {
    element.style.transition = "visibility 0s, opacity 0.3s";
    element.style.visibility = "visible"
    element.style.opacity = "1"
}

function hideElement(element) {
    element.style.transition = "visibility 0s linear 0.3s, opacity 0.3s";
    element.style.visibility = "hidden"
    element.style.opacity = "0"
}

function colorElement(element) {
    element.style.transition = " 2s filter linear";
    element.style.transition = " 2s -webkit-filter linear";
    element.style.filter = "grayscale(0) blur(5px)";
    element.style.webkitFilter = "grayscale(0) blur(5px)";
}

function colorOnlyElement(element) {
    element.style.transition = " 2s filter linear";
    element.style.transition = " 2s -webkit-filter linear";
    element.style.filter = "grayscale(0)";
    element.style.webkitFilter = "grayscale(0)";
}

function grayOnlyElement(element) {
    element.style.transition = " 0.4s filter linear";
    element.style.transition = " 0.4s -webkit-filter linear";
    element.style.filter = "grayscale(1)";
    element.style.webkitFilter = "grayscale(1)";
}

function grayElement(element) {
    element.style.transition = " 0.4s filter linear";
    element.style.transition = " 0.4s -webkit-filter linear";
    element.style.filter = "grayscale(1) blur(0)";
    element.style.webkitFilter = "grayscale(1) blur(0)";
}

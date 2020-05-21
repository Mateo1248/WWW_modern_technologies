var header = document.getElementsByTagName("header")[0];
var main = document.getElementsByTagName("main")[0];
var footer = document.getElementsByTagName("footer")[0];

header.onmouseenter = function(e) {
    header.style.border = "2px solid black";
}

main.onmouseenter = function(e) {
    main.style.border = "2px solid black";
}

footer.onmouseenter = function(e) {
    footer.style.border = "2px solid black";
}


header.onmouseleave = function(e) {
    header.style.border = "none";
}

main.onmouseleave = function(e) {
    main.style.border = "none";
}

footer.onmouseleave = function(e) {
    footer.style.border = "none";
}
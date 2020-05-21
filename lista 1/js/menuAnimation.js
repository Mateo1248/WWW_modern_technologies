var width = 0;
var clicked = false;

//get elements
var header = document.getElementsByTagName("header")[0];
var body = document.getElementsByTagName("body")[0];
var menu = header.getElementsByTagName("nav")[0];

//get menu width
var menuWidth = 280;
var resizeWidth = menuWidth / 2;

//get font size
var fontSize = parseFloat(window.getComputedStyle(header, null).getPropertyValue("font-size"));
var resizeFont = fontSize / 2;

//draw arrow
var arrowDiv = document.createElement("div");
arrowDiv.style.width = resizeWidth;
arrowDiv.style.marginTop = "20px";
arrowDiv.style.textAlign = "center";
arrowDiv.style.alignSelf = "center";

arrowDiv.innerHTML += `
<svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="80" height="80" viewBox="0 0 172 172"style=" fill:#000000;"><g fill="none" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode: normal"><path d="M0,172v-172h172v172z" fill="none"></path><g fill="#ecf0f1"><path d="M30.93313,13.73313c-1.41094,0 -2.66063,0.84656 -3.19813,2.13656c-0.52406,1.30344 -0.215,2.78156 0.79281,3.7625l66.36781,66.36781l-66.36781,66.36781c-0.90031,0.86 -1.26313,2.15 -0.94063,3.34594c0.30906,1.20938 1.24969,2.15 2.45906,2.45906c1.19594,0.3225 2.48594,-0.04031 3.34594,-0.94063l71.23219,-71.23219l-71.23219,-71.23219c-0.645,-0.67188 -1.53187,-1.03469 -2.45906,-1.03469zM75.63969,13.73313c-1.3975,0 -2.64719,0.84656 -3.18469,2.13656c-0.52406,1.30344 -0.215,2.78156 0.79281,3.7625l66.36781,66.36781l-66.36781,66.36781c-0.90031,0.86 -1.26313,2.15 -0.94063,3.34594c0.30906,1.20938 1.24969,2.15 2.45906,2.45906c1.19594,0.3225 2.48594,-0.04031 3.34594,-0.94063l71.23219,-71.23219l-71.23219,-71.23219c-0.645,-0.67188 -1.53187,-1.03469 -2.4725,-1.03469z"></path></g></g></svg>`;

function prepare(width) {
    if (width > 1200) {
        //resize menu
        menu.style.display = "none";
        body.style.gridTemplateColumns = resizeWidth + "px auto";
        header.style.fontSize = resizeFont + "px";
        header.appendChild(arrowDiv);
    } else {
        if (header.contains(arrowDiv)) {
            header.removeChild(arrowDiv);
        }

        menu.style.display = "inline";
        body.style.gridTemplateColumns = "1fr";
        header.style.fontSize = fontSize + "px";
    }
}

window.onload = function() {
    width = body.offsetWidth;
    prepare(width);
};

window.onresize = function() {
    width = body.offsetWidth;
    prepare(width);
};

header.onclick = function(e) {
    if (!clicked && width > 1200) {
        header.removeChild(arrowDiv);
        menu.style.display = "inline";
        var deltaWidth = resizeWidth / 20;
        var addWidth = resizeWidth;

        var deltaFont = resizeFont / 20;
        var addFont = resizeFont;

        var interval;

        interval = window.setInterval(
            function() {
                if (addWidth < menuWidth) {
                    body.style.gridTemplateColumns = addWidth + "px auto";
                    header.style.fontSize = addFont + "px";

                    addWidth += deltaWidth;
                    addFont += deltaFont;
                } else {
                    window.clearInterval(interval);
                }
            },
            3
        );
        clicked = true;
    }
};

header.onmouseleave = function(e) {
    if (width > 1200) {
        header.appendChild(arrowDiv);
        menu.style.display = "none";
        body.style.gridTemplateColumns = resizeWidth + "px auto";
        header.style.fontSize = resizeFont + "px";
        clicked = false;
    }
};
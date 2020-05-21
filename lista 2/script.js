//canvas game
var puzzleBoard = document.getElementById('puzzleBoard');
var context = puzzleBoard.getContext('2d');

//set transparency
context.globalAlpha = 0.8;

//image in canvas
var img = new Image();
img.src = './img/1.jpg';


//canvas game size
var puzzleBoardSize = puzzleBoard.clientWidth;
console.log(puzzleBoardSize);

//initial number of tiles
var tileNum = 4;

//tile size
var tileSize = puzzleBoardSize / tileNum;
console.log(tileSize);

//game variables
var solved = false,
    boardTiles,
    mouseX,
    mouseY;

//click coordinates
let  clickLoc = {};
clickLoc.x = 0;
clickLoc.y = 0;

//red tile coordinates
let  emptyLoc = {};
emptyLoc.x = 0;
emptyLoc.y = 0;

//draw grid on img load
img.addEventListener('load', drawGrid, false);


//start a game
resetPuzzle();

//is tail hover
var taliHover = false;

//function activate after click on one of the tiles in gallery 
//use promises
//on success load image to hint
function loadImg(src){
    var promise = new Promise(
        function(resolve, reject){
            img.onload = function(){ resolve(src); };
            img.onerror = function(){ reject(src); };
            img.src = src;
        }
    );

    promise
    .then(result => {
        document.getElementById("hint").src = result;
        console.log("Success: " + result);
    })
    .catch(error => {
        console.error(error);
    });

    resetPuzzle();
}

//beginning of the game
function resetPuzzle()
{
    solved = false;

    //empty tile in upper left corner
    emptyLoc.x=0;
    emptyLoc.y=0;
    setBoard();
    drawGrid();
}

//create array with tiles coordinates
//shuffle tiles
function setBoard()
{
    boardTiles = new Array(tileNum);
    for (let i = 0; i < tileNum; ++i)
    {
        boardTiles[i] = new Array(tileNum);

        for (let j = 0; j < tileNum; ++j)
        {
            boardTiles[i][j] = {};
            boardTiles[i][j].x = i;
            boardTiles[i][j].y = j;
        }
    }
    shuffleTiles();
    tileSize = puzzleBoardSize / tileNum;
    solved = false;
}

//shuffle tiles on cnvas board 
function shuffleTiles()
{
    for(let j = 0 ; j < 7 ; j++) {
        for(let i=0 ; i < tileNum-1 ; i++) {
            //go down
            swap(emptyLoc.x, emptyLoc.y, emptyLoc.x, emptyLoc.y+1);
            emptyLoc.y++;
            //go left
            let rand = Math.random();
            if(rand < 0.5 && emptyLoc.x > 0) {
                swap(emptyLoc.x, emptyLoc.y, emptyLoc.x-1, emptyLoc.y);
                emptyLoc.x--;
            }
            //go right
            else if(rand >= 0.5 && emptyLoc.x < tileNum-1) {
                swap(emptyLoc.x, emptyLoc.y, emptyLoc.x+1, emptyLoc.y);
                emptyLoc.x++;
            }
        }

        //go up
        for(let i=0 ; i < tileNum-1 ; i++) {

            //go left
            let rand = Math.random();
            if(rand < 0.5 && emptyLoc.x > 0) {
                swap(emptyLoc.x, emptyLoc.y, emptyLoc.x-1, emptyLoc.y);
                emptyLoc.x--;
            }

            //go right
            else if(rand >= 0.5 && emptyLoc.x < tileNum-1) {
                swap(emptyLoc.x, emptyLoc.y, emptyLoc.x+1, emptyLoc.y);
                emptyLoc.x++;
            }

            //go up
            swap(emptyLoc.x, emptyLoc.y, emptyLoc.x, emptyLoc.y-1);
            emptyLoc.y--;
        }

        //go to upper left corner
        while(emptyLoc.x != 0) {
            swap(emptyLoc.x, emptyLoc.y, emptyLoc.x-1, emptyLoc.y);
            emptyLoc.x--;
        }

    }
    console.log(clickLoc.x);
    console.log(clickLoc.y);
}

//swap two elements on board
function swap(ix, iy, jx, jy)
{
    let temp = boardTiles[ix][iy];

    boardTiles[ix][iy] = boardTiles[jx][jy];
    boardTiles[jx][jy] = temp;
}

//draw imagetiles on canvas according to boardTiles table coordinates
function drawGrid()
{
    context.clearRect(0, 0, puzzleBoardSize, puzzleBoardSize);

    for(let i = 0; i < tileNum; ++i)
    {
        for(let j = 0; j < tileNum; ++j)
        {
            let x = boardTiles[i][j].x;
            let y = boardTiles[i][j].y;
            context.globalAlpha = 0.8;
            if(i !== emptyLoc.x || j !== emptyLoc.y || solved === true)
            {
                context.drawImage(img, x * tileSize, y * tileSize, tileSize, tileSize, i * tileSize, j * tileSize, tileSize, tileSize);
            }
        }
    }
}



puzzleBoard.onmousemove = function(e) {
    if (e.offsetX) {
        mouseX = e.offsetX;
        mouseY = e.offsetY;
    }
    else if (e.layerX) {
        mouseX = e.layerX;
        mouseY = e.layerY;
    }

    if(taliHover) {
        context.globalAlpha = 0.8;
        drawGrid();
    }

    clickLoc.x = Math.floor((mouseX) / tileSize);
    clickLoc.y = Math.floor((mouseY) / tileSize);
    let d = distance(clickLoc.x, clickLoc.y, emptyLoc.x, emptyLoc.y);
    if(d === 1)
    {
    if(!solved){
        taliHover = true;
        let x = boardTiles[clickLoc.x][clickLoc.y].x;
        let y = boardTiles[clickLoc.x][clickLoc.y].y;
        context.globalAlpha=1;
        context.drawImage(img, x * tileSize, y * tileSize, tileSize, tileSize, clickLoc.x * tileSize, clickLoc.y * tileSize, tileSize, tileSize);

    }

    }
    else {
        context.globalAlpha = 0.8;
    }
}

//if diistance equals 1 swap is possible
function distance(x1, y1, x2, y2) {
    return Math.abs(x1 - x2) + Math.abs(y1 - y2);
}

//swap elements
document.getElementById('puzzleBoard').onclick = function(e) {
    if(!solved)
    {
        clickLoc.x = Math.floor((e.pageX - this.offsetLeft) / tileSize);
        clickLoc.y = Math.floor((e.pageY - this.offsetTop) / tileSize);


        let d = distance(clickLoc.x, clickLoc.y, emptyLoc.x, emptyLoc.y);
        if(d === 1)
        {
            slideTiles(emptyLoc, clickLoc);
            drawGrid();
        }


    }
};

document.getElementById('puzzleBoard').onmouseout = function() {
    drawGrid();
};

function slideTiles(emptyLoc, clickLoc)
{
    let a =boardTiles[emptyLoc.x][emptyLoc.y].x;
    let b= boardTiles[emptyLoc.x][emptyLoc.y].y;
    boardTiles[emptyLoc.x][emptyLoc.y].x = boardTiles[clickLoc.x][clickLoc.y].x;
    boardTiles[emptyLoc.x][emptyLoc.y].y = boardTiles[clickLoc.x][clickLoc.y].y;

    boardTiles[clickLoc.x][clickLoc.y].x = a;
    boardTiles[clickLoc.x][clickLoc.y].y = b;

    let aa = emptyLoc.x;
    let bb = emptyLoc.y;
    emptyLoc.x = clickLoc.x;
    emptyLoc.y = clickLoc.y;

    clickLoc.x = aa;
    clickLoc.y = bb;

    checkSolved();
}

function checkSolved()
{
    for(let  i = 0; i < tileNum; ++i)
    {
        for(let j = 0; j < tileNum; ++j)
        {
            if(boardTiles[i][j].x !== i || boardTiles[i][j].y !== j)
            {
                solved = false;
                return;
            }
        }
    }
    solved = true;
    setTimeout(gameOver,2000);
}

function gameOver(){
    document.onmousedown = null;
    document.onmousemove = null;
    document.onmouseup = null;
    resetPuzzle()
}
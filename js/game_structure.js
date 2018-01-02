var canvas = document.getElementById("myCanvas");
var fps = 60;
var time,score;
var gameState = "begin";
function gameManage(){
    if(gameState == "begin") start();
    else if(gameState == "middle") update();
    else if(gameState == "end") game_over();
}
function start(){
    time = 0;
    score = 0;
    gameState = "middle";
}

function update(){
    time++;
    if(""){
        gameState = "end";
    }

}

function game_over(){

}

setInterval(gameManage,1000/fps);
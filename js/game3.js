var canvas = document.getElementById("myCanvas");
var ctx = canvas.getContext("2d");
var fps = 100;
var n = 5;
var counter;
var time;
var score;
var isSet = false;
var delay;
var gameState = "begin";
var userName = document.getElementById("user-nickname").textContent; 

function gameManage(){
    if(gameState == "begin") start();
    else if(gameState == "middle") update();
    else if(gameState == "end") game_over();
}
function start(){
    canvas.width = Math.min(window.innerWidth,window.innerHeight) * 0.8;
    canvas.height = canvas.width;
    time = 0;
    score = 0;
    counter = 0;
    delay = 0;
    gameState = "middle";
    canvas.addEventListener("click",function(){
        if(gameState == "middle"){
            if(isSet == false){
                score += 1*fps;
            }else if(isSet == true){
                isSet = false;
                score += delay;
                delay = 0;
                counter++;
            }
        }
    });
}
function game_over(){
    ctx.clearRect(0,0,canvas.width,canvas.height);
    ctx.textAlign = "center";
    ctx.fillStyle = "black";
    ctx.fillRect(0,0,canvas.width,canvas.height);
    ctx.fillStyle = "white";
    ctx.font = "48px calibri";
    ctx.fillText("Penalty:"+(1000*score/fps).toFixed(0)+" ms",canvas.width/2,canvas.height/2);
    ctx.fillText("Average:"+(1000*score/(n*fps)).toFixed(0)+" ms",canvas.width/2,canvas.height/2+40);
    $.post("gameLogger.php",
    {
        nickname:userName,
        game:3,
        score: score
    }).done(function( data ) {
        // alert( "Data Loaded: " + data );
      });
    gameState = "limbo";
}
function draw(){
    if(isSet == false){
        ctx.fillStyle = "black";
    }else if(isSet == true){
        ctx.fillStyle = "white";
    }
    ctx.fillRect(0,0,canvas.width,canvas.height);
}

function update(){
    time++;
    if(isSet == false){
        if((delay > fps && Math.random() < 0.01) || delay > 3*fps){
            isSet = true;
            delay = 0;
        } 
    }
    delay++;
    draw();
    ctx.textAlign = "left";
    ctx.fillStyle = "red";
    ctx.font = "24px calibri";
    ctx.fillText("Blinks: " + counter,10,25);
    ctx.fillText("Penalty:"+(1000*score/fps).toFixed(0)+" ms",10 , 50);
    if(counter == n)
        gameState="end";
}

setInterval(gameManage,1000/fps);
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
    updateN();
    canvas.width = Math.min(window.innerWidth,window.innerHeight) * 0.8;
    canvas.height = canvas.width;
    time = 0;
    score = 0;
    counter = 0;
    delay = 0;
    isSet = false;
    gameState = "middle";

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
    ctx.fillText("Blinks: " +  (n-counter),10,25);
    ctx.fillText("Penalty: "+(1000*score/fps).toFixed(0)+" ms",10 , 50);
    if(counter == n)
        gameState="end";
}

function updateN(){
    n = $('#slider').val();
     // handles out of bounds
    if(n > 5) n = 5;
    else if(n < 1) n = 1;
    n *= 5;
    //  restart game and prevents page reloading
    gameState = "begin";
    return false;
}

setInterval(gameManage,1000/fps);

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

function printValue(){
	document.getElementById("slider-value").innerHTML = 5*document.getElementById("slider").value;
}
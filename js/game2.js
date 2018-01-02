var canvas = document.getElementById("myCanvas");
var context = canvas.getContext('2d');
var userName = document.getElementById("user-nickname").textContent; 
var fps = 60;
var n = document.getElementById("slider").value;
var score;  
var circle;
var message;
var time;
var gameState = "begin";

function gameManage(){
    if(gameState == "begin") start();
    else if(gameState == "middle") update();
    else if(gameState == "end") game_over();
}
function start(){
    time = n*5*fps;
    score = 0;
    circle = {x:canvas.width / 2, y:canvas.height / 2, r:canvas.width/20};
    canvas.width = Math.min(window.innerWidth,window.innerHeight) * 0.8;
    canvas.height = canvas.width;
    gameState = "middle";
}
function update(){
    context.clearRect(0, 0, canvas.width, canvas.height);
    //writeMessage(canvas,message);
    writeScore(canvas,score);
    writeTime(canvas,time);
    drawCircle(canvas,circle);
    if(score > 0){
        time = time-1;
        if(time == 0){
            gameState = "end";
        }
    }else{
        circle={x:canvas.width / 2, y:canvas.height / 2, r:canvas.width/10};
        context.textAlign = "center";
        writeText(canvas,"Start!",canvas.width/2, canvas.height/2+10);
    }
}
function game_over(){
    context.clearRect(0,0,canvas.width,canvas.height);
    context.textAlign = "center";
    context.fillStyle = "black";
    context.fillRect(0,0,canvas.width,canvas.height);
    context.fillStyle = "white";
    context.font = "48px calibri";
    context.fillText(userName,canvas.width/2,canvas.height/2-40);
    context.fillText("Score:"+score,canvas.width/2,canvas.height/2+20);

    $.post("gameLogger.php",
    {
        nickname:userName,
        game:2,
        score: score
    }).done(function( data ) {
        // alert( "Data Loaded: " + data );
      });
      gameState = "limbo";
}
function getMouseCoordinate(canvas, evt){
    var rect = canvas.getBoundingClientRect();    
    return{
        x: evt.clientX - rect.left,
        y: evt.clientY - rect.top
    };
}

function randomLin(a,b){
        return Math.floor(Math.random()*(b-a+1)+a);
}

function getRandomCircle(canvas){
    // aux = randomLin(0,100);
    aux = canvas.width/(10);
    return{
        x: randomLin(aux,canvas.width-aux),
        y: randomLin(aux,canvas.height-aux),
        r: aux
    }; 
}

function writeText(canvas, message, x, y){
    context.textAlign = "center";
    context.font = '24pt calibri';
    context.fillStyle='white';
    context.fillText(message,x,y);
}
function writeScore(canvas, score) {
    context.textAlign = "left";
    context.font = '18pt Consolas';
    context.fillStyle = 'white';
    context.fillText("score:" + score, 10, 25);
}
function writeTime(canvas, score) {
    context.textAlign = "left";
    context.font = '18pt Consolas';
    context.fillStyle = 'white';
    context.fillText("Time:" + (time/60).toFixed(1), 10, 50);
}

function drawCircle(canvas,circle){
    context.beginPath();
    context.arc(circle.x,circle.y, circle.r, 0, 2 * Math.PI, false);
    context.fillStyle = 'green';
    context.fill();
    context.lineWidth = 5;
    context.strokeStyle = '#003300';
    context.stroke();
}

function collideCircle(circle,mousePos){
    return (mousePos.x-circle.x)*(mousePos.x-circle.x)+(mousePos.y-circle.y)*(mousePos.y-circle.y) <= circle.r*circle.r

}

canvas.addEventListener('mousemove',function(evt){
    var mousePos = getMouseCoordinate(canvas,evt);
},false);
canvas.addEventListener("click",function(evt){
    if(gameState == "middle")
    {
        var mousePos = getMouseCoordinate(canvas,evt);
        if(collideCircle(circle,mousePos)){
            score = score+1;
            circle = getRandomCircle(canvas,circle);
        }
    }
},false);

// Auxiliary function that is called by
// the update button and restarts the game
// without reloading page
function updateN(){
    n = $('#slider').val();
     // handles out of bounds
    if(n > 12) n = 12;
    else if(n < 1) n = 1;
    
    //  restart game and prevents page reloading
    gameState = "begin";
    return false;
}

setInterval(gameManage,1000/fps);

// Displays to the user the value in the
// current range-sliders
function printValue(){
	document.getElementById("slider-value").innerHTML = 5*document.getElementById("slider").value +"s";
}
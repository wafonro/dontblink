var canvas = document.getElementById("myCanvas");
var ctx = canvas.getContext("2d");
var userName = document.getElementById("user-nickname").textContent; 
const fps = 60;
var counter;
var time;
var delay;
var n;
var offset;
var size;
var order;
var listrectangles;
var gameState = "begin";
$("#reset").click(function(){
    n = document.getElementById("dimension").value;
    console.log(n);
    gameState = "begin";
});
console.log("Manager");
function gameManage(){
    if(gameState == "begin") start();
    else if(gameState == "middle") update();
    else if(gameState == "end") game_over();
}
function start(){
    updateN();
    time  = 0;
    counter = 0;
    delay = 2*fps;
    offset  = {x:0, y:50};
    canvas.width = Math.min(window.innerWidth,window.innerHeight) * 0.8;
    canvas.height = canvas.width;
    size = Math.floor((canvas.height-offset.y)/n);
    canvas.width = n*size+offset.x;
    canvas.height = n*size+offset.y;
    listrectangles = [];
    order = randomPermutation(n*n);
    for(var i =0; i < n; i++){
        listrectangles.push([]);
        for(var j = 0; j < n; j++){
            listrectangles[i].push({value:order[i*n+j], state:"Normal",timer:0});
        }
    }
    canvas.addEventListener("click",function(evt){
        if(gameState == "middle"){
            var mousePos = getMouseCoordinate(canvas,evt);
            if(listrectangles[mousePos.y][mousePos.x].value==counter){
                listrectangles[mousePos.y][mousePos.x].state = "OK";
                counter= counter+1;
            }
            else if(listrectangles[mousePos.y][mousePos.x].state=="Normal"){
                time += 5*fps;
                listrectangles[mousePos.y][mousePos.x].state = "Wrong";
                listrectangles[mousePos.y][mousePos.x].timer = fps/4;
            }
        }
    },false);
    canvas.addEventListener('mousemove',function(evt){
        var mousePos = getMouseCoordinate(canvas,evt);
        console.log("x: " +mousePos.x + " y: " + mousePos.y);
    },false);
    gameState = "middle";
}
function update(){
    ctx.clearRect(0,0,canvas.width,canvas.height);    
    writeText(canvas,"Time:"+(time/fps).toFixed(2)+"s",10,30);
    
    if(counter < n*n){
        time = time + 1;
        for(var x = 0; x < n; x++){
            for(var y = 0; y < n; y++){
                if(listrectangles[y][x].state=="Wrong"){
                    if (listrectangles[y][x].timer > 0){
                        listrectangles[y][x].timer--;
                        drawSquare(x,y,"red");
                    }
                    else{listrectangles[y][x].state="Normal";}
                }
                else if(listrectangles[y][x].state!="OK"){
                    drawSquare(x,y,"#0fd0d6");                
                }
                else{
                    drawSquare(x,y,"grey");                                
                }
                
            }
        }
    }
    if(counter == 0 && delay > 0){
        delay--;
        time--;
    }
    if(counter == n*n){
        gameState = "end";
    }
} 
function game_over(){
    ctx.clearRect(0,0,canvas.width,canvas.height);
    ctx.textAlign = "center";
    ctx.fillStyle = "black";
    ctx.fillRect(0,0,canvas.width,canvas.height);
    ctx.fillStyle = "white";
    ctx.font = "48px calibri";
    ctx.fillText("PLAYER: "+userName,canvas.width/2,canvas.height/2-40);
    ctx.fillText("TIME: "+(time/fps).toFixed(2)+"s",canvas.width/2,canvas.height/2+20);
    
    $.post("gameLogger.php",
    {
        nickname:userName,
        game:1,
        score: time
    }).done(function( data ) {
        //alert( "Data Loaded: " + data );
      });
    gameState="limbo";
}

function randomLin(a,b){
    return Math.floor(Math.random()*(b-a+1)+a);
}
function randomPermutation(n){
    var tmp = Array(n);
    for(var i = 0; i < n; i++){
        tmp[i] = i;
    }
    for(var i = 0; i < n; i++){
        var j = randomLin(0,n-1);
        var aux = tmp[i];
        tmp[i] = tmp[j];
        tmp[j] = aux;
    }
    return tmp;
}

function drawSquare(x,y,color){
    var ctx = canvas.getContext("2d");    
    ctx.fillStyle = color;
    ctx.fillRect(offset.x+x*size,offset.y+y*size,size-4,size-4);        
    ctx.font="20px Georgia";
    ctx.textAlign="center"; 
    ctx.textBaseline = "middle";
    ctx.fillStyle = "#000000";
    var rectHeight = size;
    var rectWidth = size;
    var rectX = x*size;
    var rectY = y*size;
    ctx.fillText(listrectangles[y][x].value+1,offset.x + rectX+(rectWidth/2),offset.y + rectY+(rectHeight/2));
}


function writeText(canvas, message, x, y){
    ctx.textAlign = "left";
    ctx.font = '24pt calibri';
    ctx.fillStyle='black';
    ctx.fillText(message,x,y);
}

function getMouseCoordinate(canvas, evt){
    var rect = canvas.getBoundingClientRect();    
    return{
        x:Math.floor((evt.clientX - offset.x-rect.left)/size),
        y:Math.floor((evt.clientY - offset.y-rect.top)/size)
    };
}

// Auxiliary function that is called by
// the update button and restarts the game
// without reloading page
function updateN(){
    n = $('#slider').val();

    // handles out of bounds
    if(n > 10) n = 10;
    else if(n < 4) n = 4;
    gameState = "begin";
    
    // prevents page reloading
    return false;
}
setInterval(gameManage,1000/fps);

function printValue(){
    document.getElementById("slider-value").innerHTML = document.getElementById("slider").value;
}



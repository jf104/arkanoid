// JavaScript Document
/**********************************************
Does same thing as writing out below
Ball.prototype.x = 0;
Block.prototype.x = 0;

**********************************************/
function holdValues()
{
	this.x = 0;
	this.y = 0;
	this.image = null;
}

function Ball() {};
Ball.prototype = new holdValues();
Ball.prototype.angle = 0;
Ball.prototype.ball2_X = 0;
Ball.prototype.ball2_Y = 0;
Ball.prototype.ball3_X = 0;
Ball.prototype.ball3_Y = 0;
Ball.prototype.ballImg = null;

var ball = new Ball();

//note s at end and lowercase b
var blocks = new Array();	

//note no s at end and uppercase B
function Block() {};
Block.prototype = new holdValues();
Block.prototype.row = 0;
Block.prototype.col = 0;
Block.prototype.angle = 0;
Block.spinning = false;
Block.hit = false;
Block.prize = false;
Block.prizeCheck = false;

function init(){
    initSettings();
    loadImages();
 
    //set mouse movement to control bar movement
    $("#canvas").mousemove(function(e){
		if(e.pageX + barImg.width >= screenWidth){
				barX = screenWidth - barImg.width;
				return;
		}
		if(e.pageX <= 15){
			barX = 15;	
		}
        barX = e.pageX -12;
    });
	
	$("#canvas").click(function(e){
		if(lazerBar){
			shootBarGun();
		}
    });
 
    $("#ss").click(function (){
 
        startGame();
    });
} 

function loadImages()
{
	barImg.src = "images/bar.png";	
	whiteBlock.src = "images/white.png";	
	redBlock.src = "images/red.png";	
	greenBlock.src = "images/green.png";	
	growBlock.src = "images/grow.png";	
	slowBlock.src = "images/slow.png";	
	tinyBlock.src = "images/tiny.png";	
	lazerBlock.src = "images/lazer.png";    
	gameBackground.src = "images/big-background.png";    
	ballImg.src = "images/smallball.png";	
	bulletImg.src = "images/gun-bullet.png";		
	ball.image = ballImg; 
}

function initSettings()
{
    ark = document.getElementById('canvas').getContext('2d');
 
    screenWidth = parseInt($("#canvas").attr("width"));
    screenHeight = parseInt($("#canvas").attr("height"));
 
    //put bar in center of screen
    barX = parseInt(screenWidth/2);
    barY = screenHeight - 40;
	
	ball.x = parseInt(screenWidth/2);
	ball.y = parseInt(screenHeight/2);
	
	blockX = 3;
	blockY = 5;
}
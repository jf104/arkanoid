<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Franconoid</title>
<script type="text/javascript" src="javascript/jquery_1.7.2.js"></script>
<script>

//must accepting fix prize box in bar

var intervalID;
var speed = 3;
var prizeFallSpeed = 3;
var gunShootSpeed = 3;
var horizontalSpeed = speed;
var verticalSpeed = speed;

//starting position
var ballX=100;
var ballY=100;

var score = 0;
var lifes = 5;
var rows = 2;
var slowTimer = 0;

var endGameFlag = false;
var screenWidth;
var screenHeight
var isBallMoving = false;
var barX;
var barY;
var leftBulletX = 0;
var leftBulletY = 0;
var rightBulletX = 0;
var rightBulletY = 0;
var left2ndBulletX = 0;
var left2ndBulletY = 0;
var right2ndBulletX = 0;
var right2ndBulletY = 0;
var ark;

var whiteBlockX;
var whiteBlockY;
var redBlock;
var redBlock;
var greenBlock;
var greenBlock;
var PrizeBlockY = 0;
var PrizeFlag = false;
var lazerBar = false;
 
var barImg = new Image();
var whiteBlock = new Image();
var redBlock = new Image();
var greenBlock = new Image();
var growBlock = new Image();
var slowBlock = new Image();
var tinyBlock = new Image();
var lazerBlock = new Image();
var gameBackground = new Image();
var ballImg = new Image();
var bulletImg = new Image();

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

var boing1 = new Audio("sounds/laughter-1.wav");
var boing2 = new Audio("sounds/laughter-1.wav");
var boing3 = new Audio("sounds/laughter-1.wav");
var boing4 = new Audio("sounds/laughter-1.wav");
var boing5 = new Audio("sounds/laughter-1.wav");
var awwwww = new Audio("sounds/laughter-1.wav");

<!--[if IE]>
var boing1 = new Audio("sounds/button-31.mp3");
var boing2 = new Audio("sounds/button-32.mp3");
var boing3 = new Audio("sounds/button-33.mp3");
var boing4 = new Audio("sounds/button-34.mp3");
var boing5 = new Audio("sounds/button-35.mp3");
var awwwww = new Audio("sounds/laughter-1.mp3");
<!--[endif]-->

$(document).ready(function(){
	$('#numLifes').val(lifes);
	$('#gameScore').val(score);
    init();
	initBlock();
});
 
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

function shootBarGun()
{
	if(leftBulletX == 0 && rightBulletY == 0)
	{	
		 ark.drawImage(bulletImg, barX + 12, barY);
		 ark.drawImage(bulletImg, (barX + barImg.width) - 12, barY);
		 
		 leftBulletX = barX + 12;
		 leftBulletY = barY;
		 rightBulletX = (barX + barImg.width) - 12;
		 rightBulletY = barY;
		 return;
	} 
	if(left2ndBulletX == 0 && right2ndBulletY == 0 && leftBulletX != 0 && rightBulletY != 0)
	{	
		 ark.drawImage(bulletImg, barX + 12, barY);
		 ark.drawImage(bulletImg, (barX + barImg.width) - 12, barY);
		 
		 left2ndBulletX = barX + 12;
		 left2ndBulletY = barY;
		 right2ndBulletX = (barX + barImg.width) - 12;
		 right2ndBulletY = barY;
	} 
	
}

function moveBullets()
{
	if(leftBulletY > 0)
    {
		leftBulletY -= gunShootSpeed;
		ark.drawImage(bulletImg, leftBulletX, leftBulletY);
	}
	if(rightBulletY > 0)
    {
		rightBulletY -= gunShootSpeed;
        ark.drawImage(bulletImg, rightBulletX, rightBulletY);
	}	
	if(left2ndBulletY > 0)
    {
		left2ndBulletY -= gunShootSpeed;
		ark.drawImage(bulletImg, left2ndBulletX, left2ndBulletY);
	}
	if(right2ndBulletY > 0)
    {
		right2ndBulletY -= gunShootSpeed;
        ark.drawImage(bulletImg, right2ndBulletX, right2ndBulletY);
	}	
}



function resetLeftBulletPosition()
{
	leftBulletX = 0;
	leftBulletY = 0;
}

function resetLeft2ndBulletPosition()
{
	left2ndBulletX = 0;
	left2ndBulletY = 0;
}

function resetRightBulletPosition()
{
	rightBulletX = 0;
	rightBulletY = 0;
}

function resetRight2ndBulletPosition()
{
	right2ndBulletX = 0;
	right2ndBulletY = 0;
}

function checkIfBulletsHitBlock(block)
{
	leftBulletX1 = leftBulletX;
	leftBulletX2 = leftBulletX + bulletImg.width;
	leftBulletY1 = leftBulletY;
	leftBulletY2 = leftBulletY + bulletImg.height;
	
	left2ndBulletX1 = left2ndBulletX;
	left2ndBulletX2 = left2ndBulletX + bulletImg.width;
	left2ndBulletY1 = left2ndBulletY;
	left2ndBulletY2 = left2ndBulletY + bulletImg.height;
	
	rightBulletX1 = rightBulletX;
	rightBulletX2 = rightBulletX + bulletImg.width;
	rightBulletY1 = rightBulletY;
	rightBulletY2 = rightBulletY + bulletImg.height;
	
	right2ndBulletX1 = right2ndBulletX;
	right2ndBulletX2 = right2ndBulletX + bulletImg.width;
	right2ndBulletY1 = right2ndBulletY;
	right2ndBulletY2 = right2ndBulletY + bulletImg.height;
	
	X1_block = block.x+3;
	X2_block = block.x+3 + block.image.width;
	Y1_block = block.y; 
	Y2_block = block.y + block.image.height;
	
	if(leftBulletX2 >= X1_block && leftBulletX2 <= X2_block || leftBulletX1 >= X1_block && leftBulletX1 <= X2_block)
	{
		if(leftBulletY1 + 2 >= Y2_block && leftBulletY1 -2 <= Y2_block)
		{
			resetLeftBulletPosition();//down
			block.hit = true;
		}
	}
	
	if(left2ndBulletX2 >= X1_block && left2ndBulletX2 <= X2_block || left2ndBulletX1 >= X1_block && left2ndBulletX1 <= X2_block)
	{
		if(left2ndBulletY1 + 2 >= Y2_block && left2ndBulletY1 -2 <= Y2_block)
		{
			resetLeft2ndBulletPosition();//down
			block.hit = true;
		}
	}
	
		
	if(rightBulletX2 >= X1_block && rightBulletX2 <= X2_block || rightBulletX1 >= X1_block && rightBulletX1 <= X2_block)
	{
		if(rightBulletY1 + 2 >= Y2_block && rightBulletY1 -2 <= Y2_block)
		{
			resetRightBulletPosition();//down
			block.hit = true;
		}
	}
	
	if(right2ndBulletX2 >= X1_block && right2ndBulletX2 <= X2_block || right2ndBulletX1 >= X1_block && right2ndBulletX1 <= X2_block)
	{
		if(right2ndBulletY1 + 2 >= Y2_block && right2ndBulletY1 -2 <= Y2_block)
		{
			resetRight2ndBulletPosition();//down
			block.hit = true;
		}
	}
	
	if(leftBulletY1<0)
    {
        resetLeftBulletPosition();
    }
	if(left2ndBulletY1<0)
    {
        resetLeft2ndBulletPosition();
    }
	if(rightBulletY1<0)
    {
		resetRightBulletPosition();
    }
	if(right2ndBulletY1<0)
    {
		resetRight2ndBulletPosition();
    }			
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

function initBlock()
{
	var count=0;
	
	if(endGameFlag == true)
	{
		rows++;	
	}
	//row
	for(var x=0; x<rows; x++)
	{
		//column
		for(var y=0; y<15; y++)
		{
			block = new Block();
			if(x==0)
			{
				block.image = whiteBlock;
			}
			if(x==1)
			{
				block.image = redBlock;
			}
			if(x>=2)
			{
				block.image = greenBlock;
			}
			
			
			block.row = x;
			block.col = y;
			//block.x = block width * block.col + starting x pos
			block.x = 42 * block.col;
			//block.x = block height * block.col + starting y pos
			block.y = 25 * block.row + 10;
			block.hit = false;
			//note s at end
			blocks[count] = block;
			count++;
		}
	}
}

function checkIfPrizeHitBar(prizeBlockX,currentBlock)
{
	barX1 = barX;
	barX2 = barX + barImg.width;
	barY1 = barY;
	barY2 = barY + barImg.height;
	
	blockX1 = prizeBlockX;
	blockX2 = prizeBlockX + growBlock.width;
	blockY1 = PrizeBlockY;
	blockY2 = PrizeBlockY + growBlock.height;
	
	//prize block left side bottom within bar
	if(blockX2 >= barX1 && blockX2 <= barX2 && blockY2 >= barY1 && blockY2 <= barY2)
	{
		return(true);
	}
	
	//prize block right side bottom within bar
	if(blockX1 >= barX1 && blockX1 <= barX2 && blockY2 >= barY1 && blockY2 <= barY2)
	{
		return(true);
	}
	
	//prize block left side top within bar
	if(blockX1 >= barX1 && blockX1 <= barX2 && blockY1 >= barY1 && blockY1 <= barY2)
	{
		return(true);
	}
	
	//prize block right side top within bar
	if(blockX2 >= barX1 && blockX2 <= barX2 && blockY1 >= barY1 && blockY1 <= barY2)
	{
		return(true);
	}
	return(false);
}

function drawBlocks()
{
	for(var x=0; x<blocks.length; x++)
	{
		currentBlock = blocks[x];
		if(!currentBlock.hit)
		{
			ark.drawImage(currentBlock.image, blocks[x].x+3, blocks[x].y);
		}
		if(currentBlock.prizeCheck)
		{
			if(checkIfPrizeHitBar(blocks[x].x,currentBlock))
			{
				PrizeFlag = false;
				currentBlock.prizeCheck = false;
				allBlocksHit();
				getPrizeFromBlock(currentBlock);
				continue;
			}
			PrizeBlockY += prizeFallSpeed;
			if(!currentBlock.prize)
			{
				currentBlock.prize = Math.floor((Math.random()*5)+1);
				prizeBlockImg = choosePrizeBlockImage(currentBlock);
			}

			
			if(prizeBlockImg != 'no prize' && PrizeFlag)
			{
				ark.drawImage(prizeBlockImg, blocks[x].x, blocks[x].y + PrizeBlockY);
				currentBlock.prizeCheck = true;
			}
			if(PrizeBlockY > screenHeight - ballImg.height && currentBlock.prizeCheck)
			{
				PrizeFlag = false;
				currentBlock.prizeCheck = false;
				PrizeBlockY = 0;
			}
		}
		
		allBlocksHit();
	}
	
}

function choosePrizeBlockImage(currentBlock)
{
	
	switch(currentBlock.prize)
	{
		case 1:
			return(growBlock);
		break;
		case 2:
			return(slowBlock);
		break;
		case 3:
			return(tinyBlock)
		break;
		case 4:
			return(lazerBlock)
		break;
		default:
			PrizeFlag = false;
			currentBlock.prizeCheck = false;
			return('no prize');
		break;	
	}
	
}

function getPrizeFromBlock(currentBlock)
{
	switch(currentBlock.prize)
	{
		case 1:
			PrizeBlockY = 0;
			currentBlock.prizeCheck = false;
			lazerBar = false;
			barImg.src = "images/big-bar.png";
		break;
		case 2:
			setSpeed(1);
			setSlowTimer(1);
			PrizeBlockY = 0;
			currentBlock.prizeCheck = false;
		break;
		case 3:
			PrizeBlockY = 0;
			currentBlock.prizeCheck = false;
			lazerBar = false;
			barImg.src = "images/tiny-bar.png";
		break;
		case 4:
			lazerBar = true;
			PrizeBlockY = 0;
			currentBlock.prizeCheck = false;
			barImg.src = "images/gun-bar.png";
		break;	
	}
}

function endLevel()
{
	endGameFlag = true;
	resetLeftBulletPosition();
	resetLeft2ndBulletPosition();
	resetRightBulletPosition();
	resetRight2ndBulletPosition();
	startGame();
	ballX = 100;
	ballY = 100;
	initBlock();
//	window.location.reload(true);
}

function allBlocksHit()
{
	for(var c=0; c<blocks.length; c++)
	{
		checkBlock = blocks[c];
		if(checkBlock.hit == false)
		{
			return false;
		}
			
	}
	endLevel()
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
 
function arkanoid(){ 
 
    //clear screen
    ark.clearRect(0, 0, screenWidth, screenHeight);
 
    ark.save(); 
 
    //ball direction
    ballX+= horizontalSpeed;
    ballY += verticalSpeed;
 
    //background
    ark.drawImage(gameBackground, 0, 0);
	
	//draw blocks
	drawBlocks();

    //bar
    ark.drawImage(barImg, barX, barY);
 
    //check if ball is going up or down
    if(verticalSpeed>0)
    {
		//down
        ark.drawImage(ballImg, ballX, ballY);
    }
    else
    {
		//up
        ark.drawImage(ballImg, ballX, ballY);
    }
 
    ark.restore();
 
    //ball hit right wall
    if(ballX>screenWidth - ballImg.width)
    {
        boing2.play();
        horizontalSpeed =-speed;
    }
 
    //ball hit left wall
    if(ballX<0)
    {
        boing3.play();
        horizontalSpeed = speed;
    }
 
    //ball hit the bottom Not So Nice lose life
    if(ballY>screenHeight - ballImg.height)
    {
		resetLeftBulletPosition();
		resetLeft2ndBulletPosition();
		resetRightBulletPosition();
		resetRight2ndBulletPosition();
		lazerBar = false;
		setSpeed(2);
		awwwww.play();
		lifes = lifes - 1;
		$('#numLifes').val(lifes);
		loadImages()
		if(lifes == 0)
		{
			alert("Game Over Go Fuck Your Couch");
			resetGame();	
		}
        verticalSpeed = -speed;
        startGame();
    }
 
    //ball hit the top
    if(ballY<0)
    {
        boing4.play();
        verticalSpeed = speed;
    }
 
	var ballDirection = checkWhereBallHitBar();
	chooseBallDirection(ballDirection,'z',0);
	
	moveBullets();
	
	
	didBallHitBlock();
	if(slowTimer != 0)
	{
		SlowTimer();	
	}
 
}

function resetGame()
{
	window.location.reload(true);
}

function setSpeed(newSpeed)
{
	speed = newSpeed;
}

function setSlowTimer(newTime)
{
	slowTimer = newTime;
}

function SlowTimer()
{
	//1000 about 15 seconds
	if(slowTimer == 1000)
	{
//		alert('time up');
		setSlowTimer(0);
		setSpeed(2);
		return;
	}
	slowTimer++;
}

//only change point if ball hit blocks
function checkIfChangeScore(check,points)
{
	if(check == 1)
	{
		changeScore(points);
	}
}

function changeScore(points)
{
	score = score + points;
	$('#gameScore').val(score);
}

function checkWhereBallHitBar()
{
	//repeating this in ball hit block function can create new function to return this eventually
	X1_ball = ball.x;
	X2_ball = ball.x + ball.image.width;
	Y1_ball = ball.y;
	Y2_ball = ball.y + ball.image.height;
	X_ball = (X2_ball + X1_ball) / 2;
	Y_ball = (Y2_ball + Y1_ball) / 2;
	
	X1_bar = barX;
	X2_bar = barX + barImg.width;
	Y1_bar = barY;
	Y2_bar = barY + barImg.height;
	X_bar = (X2_bar + X1_bar) / 2;
	Y_bar = (Y2_bar + Y1_bar) / 2;
	
	
	if(X2_ball >= X1_bar && X2_ball <= X2_bar || X1_ball >= X1_bar && X1_ball <= X2_bar)
	{
		if(Y1_ball + 2 >= Y2_bar && Y1_ball -2 <= Y2_bar)
		{
			return('d');//down
		}
		if(Y2_ball + 2 >= Y1_bar && Y2_ball - 2 <= Y2_bar)
		{
			return('u');//up
		}
	}
	
	if(Y1_ball >= Y1_bar && Y1_ball <= Y2_bar || Y2_ball >= Y1_bar && Y2_ball <= Y2_bar)
	{
		if(X1_ball + 2 >= X2_bar && X1_ball - 2 <= X2_bar)
		{
			return('r');//right	
		}
		if(X2_ball + 2 >= X1_bar && X2_ball - 2 <= X1_bar)
		{
			return('l');//left	
		}
	}
	
	//missed ul case if ball made it inside bar somehow?
	if(X_ball >= X1_bar && X_ball <= X2_bar && Y_ball >= Y1_bar && Y_ball <= Y2_bar && X_ball >= X1_bar && X_ball <= X_bar)
	{
		if(Y_ball <= Y_bar)
		{
			return('dl');
		}
		return('ul');
	}
	//missed ul case if ball made it inside bar somehow?
	if(X_ball >= X1_bar && X_ball <= X2_bar && Y_ball >= Y1_bar && Y_ball <= Y2_bar && X_ball >= X_bar && X_ball <= X2_bar)
	{
		if(Y_ball <= Y_bar)
		{
			return('dr');
		}
		return('ur');
	}
		
}

function chooseBallDirection(newDirection,block,check)
{
	switch(newDirection)
	{
		//if block is z its top block
		//if block not z its bar on bottom
		case 'd'://down
			if(block != 'z')
			{
				block.hit = true;
				if(!PrizeFlag)
				{
					block.prizeCheck = true;
					PrizeFlag = true;
				}
			}
			verticalSpeed = speed;
			checkIfChangeScore(check,5)
		break;
		case 'u'://up
			if(block != 'z')
			{
				block.hit = true;
			}
			verticalSpeed = -speed;
			checkIfChangeScore(check,5)
		break;
		case 'l'://left
			if(block != 'z')
			{
				block.hit = true;
			}
			horizontalSpeed = -speed;
			checkIfChangeScore(check,5)
		break;
		case 'r'://right
			if(block != 'z')
			{
				block.hit = true;
			}
			horizontalSpeed = speed;
			checkIfChangeScore(check,5)
		break;	
		case 'ul'://up left
			if(block != 'z')
			{
				block.hit = true;
			}
			verticalSpeed = -speed;
			horizontalSpeed = -speed;
			checkIfChangeScore(check,5)
		break;	
		case 'ur'://up right
			if(block != 'z')
			{
				block.hit = true;
			}
			verticalSpeed = -speed;
			horizontalSpeed = speed;
			checkIfChangeScore(check,5)
		break;
		case 'dl'://downleft
			if(block != 'z')
			{
				block.hit = true;
			}
			verticalSpeed = speed;
			horizontalSpeed = -speed;
			checkIfChangeScore(check,5)
		break;	
		case 'dr'://down right
			if(block != 'z')
			{
				block.hit = true;
			}
			verticalSpeed = speed;
			horizontalSpeed = speed;
			checkIfChangeScore(check,5)
		break;	
	}
	
}

function didBallHitBlock()
{
//blah
	for(var x=0; x<blocks.length; x++)
	{
		var block = blocks[x];
		if(!block.hit)
		{
			ball.x = ballX;
			ball.y = ballY;
			checkIfBulletsHitBlock(block);
			var newDirection = checkIfBallHitBlock(block, ball);

			chooseBallDirection(newDirection,block,1);
		}
	}
	
} 

function checkIfBallHitBlock(block, ball)
{
	X1_block = block.x+3;
	X2_block = block.x+3 + block.image.width;
	Y1_block = block.y; 
	Y2_block = block.y + block.image.height;
	
	X1_ball = ball.x;
	X2_ball = ball.x + ball.image.width;
	Y1_ball = ball.y;
	Y2_ball = ball.y + ball.image.height;
	ballCenterX1 = ((X2_ball + X1_ball) / 2) + 1;
	ballCenterX2 = ((X2_ball + X1_ball) / 2) - 1;
	ballCenterY1 = ((Y2_ball + Y1_ball) / 2) + 1;
	ballCenterY2 = ((Y2_ball + Y1_ball) / 2) - 2;
	X_ball = (X2_ball + X1_ball) / 2;
	Y_ball = (Y2_ball + Y1_ball) / 2;
	
	if(X2_ball >= X1_block && X2_ball <= X2_block || X1_ball >= X1_block && X1_ball <= X2_block)
	{
		if(Y1_ball + 2 >= Y2_block && Y1_ball -2 <= Y2_block)
		{
			return('d');//down
		}
		if(Y2_ball + 2 >= Y1_block && Y2_ball - 2 <= Y2_block)
		{
			return('u');//up
		}
	}
	
	if(Y1_ball >= Y1_block && Y1_ball <= Y2_block || Y2_ball >= Y1_block && Y2_ball <= Y2_block)
	{
		if(X1_ball + 2 >= X2_block && X1_ball - 2 <= X2_block)
		{
			return('r');//right	
		}
		if(X2_ball + 2 >= X1_block && X2_ball - 2 <= X1_block)
		{
			return('l');//left	
		}
	}		
	if(X_ball >= X1_block && X_ball <= X2_block && Y_ball >= Y1_block && Y_ball <= Y2_block)
	{
//		alert('uh oh');
		return('d');
	}
}
 
function startGame()
{
    isBallMoving = !isBallMoving;
 
    if(isBallMoving)
    {
        clearInterval(intervalID);
        intervalID = setInterval(arkanoid, 10);
    }
    else
    {
        clearInterval(intervalID);
    }
}
</script>
</head>

<body>
	<div style="padding-left:490px;float:left">
    <input id="ss" type="button" value="start/stop"/>
	Lifes:<input type="text" id="numLifes" name="numLifes" value='' style="width:15px" disabled='disabled' />
	Score:<input type="text" id="gameScore" name="gameScore" value='' style="width:65px" disabled='disabled' />
	<input id="Reset" type="button" value="Reset" onClick='resetGame()' />
	</div>
    <div id="container" style="cursor:none; width:1000; height:456px;">
        <canvas  style="padding-left:330px;" id="canvas" width="635px" height="456px" >
        </canvas>
    </div>
</body>
</html>
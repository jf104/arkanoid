// JavaScript Document
function makeBallMove()
{
	 //ball direction
    ballX+= horizontalSpeed;
    ballY += verticalSpeed;
}

function makeBallStayOnBar()
{
	ark.drawImage(ballImg, barX + 10, barY - ballImg.height);
	ballX = barX+10;
	ballY = barY - ballImg.height;
}

function checkWhereBallIsOnScreen()
{
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
		isBallMoving = false;
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
        //startGame();
    }
 
    //ball hit the top
    if(ballY<0)
    {
        boing4.play();
        verticalSpeed = speed;
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
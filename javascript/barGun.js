// JavaScript Document
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
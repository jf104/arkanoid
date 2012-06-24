// JavaScript Document
function arkanoid()
{ 
    //clear screen
    ark.clearRect(0, 0, screenWidth, screenHeight);
    ark.save(); 
    makeBallMove();
    //background
    ark.drawImage(gameBackground, 0, 0);
	//draw blocks
	drawBlocks();
    //bar
    ark.drawImage(barImg, barX, barY);
	checkWhereBallIsOnScreen();
	var ballDirection = checkWhereBallHitBar();
	chooseBallDirection(ballDirection,'z',0);	
	moveBullets();
	didBallHitBlock();
	stopSlowTimerIfStarted();
}
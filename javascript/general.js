// JavaScript Document

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

function stopSlowTimerIfStarted()
{
	if(slowTimer != 0)
	{
		//1000 about 15 seconds
		if(slowTimer == 1000)
		{
			setSlowTimer(0);
			setSpeed(2);
			return;
		}
		slowTimer++;
	}
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
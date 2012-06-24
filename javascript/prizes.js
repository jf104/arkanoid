// JavaScript Document
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
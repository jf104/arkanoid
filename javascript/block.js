// JavaScript Document
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

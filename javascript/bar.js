// JavaScript Document
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

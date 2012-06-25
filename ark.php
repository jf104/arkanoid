<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Franconoid</title>
<script type="text/javascript" src="jquery/jquery_1.7.2.js"></script>
<script type="text/javascript" src="javascript/ball.js"></script>
<script type="text/javascript" src="javascript/bar.js"></script>
<script type="text/javascript" src="javascript/barGun.js"></script>
<script type="text/javascript" src="javascript/block.js"></script>
<script type="text/javascript" src="javascript/general.js"></script>
<script type="text/javascript" src="javascript/prizes.js"></script>
<script type="text/javascript" src="javascript/init.js"></script>
<script type="text/javascript" src="javascript/config.js"></script>
<script type="text/javascript" src="javascript/game.js"></script>
<script>
	$(document).ready(function(){
		$('#numLifes').val(lifes);
		$('#gameScore').val(score);
		init();
		initBlock();
		startGame();
	});
</script>
</head>
<body>
	<div style="padding-left:490px;float:left">
    <input id="ss" type="button" value="Pause"/>
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
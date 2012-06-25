// JavaScript Document
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
var gameHasStarted = false;
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

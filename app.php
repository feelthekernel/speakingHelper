<!DOCTYPE html>
<html>
<head>
<style>
body {
	background-color: black;
}
#counter {
	font-family: "Georgia";
	color: white;
	font-size: 250px;
	text-align: center;
}
.centered {
  position: fixed; /* or absolute */
  top: 50%;
  left: 50%;
  /* bring your own prefixes */
  transform: translate(-50%, -50%);
}

#again {
	position: fixed;
	top: 75%;
	left: 48%;
}

.button {
	backface-visibility: hidden;
	position: relative;
	cursor: pointer;
	display: inline-block;
	white-space: nowrap;
	background: #000000;
	border-radius: 17px;
	border: 1px solid #ffffff;
	border-width: 1px 1px 1px 1px;
	padding: 11px 11px 11px 11px;
	box-shadow: inset 0px 1px 0px #6c5555,0px 1px 3px rgba(0%,0%,0%,0.3);
	color: #fff;
	font-size: 16px;
	font-family: Georgia;
	font-weight: 900;
	font-style: normal;
	text-shadow: 0px -1px 0px rgba(0%,0%,0%,0.4)
}
</style>
<title>Random Selection</title>
</head>
<body>

<div class="centered" id="counter" style="display: none;">3</div>
<br>
<button class="button" id="again" onclick="startTimer();">Start</button>

</body>
<script type="text/javascript" src="js/jquery-3.6.0.js"></script>
<script>
<?php
$classID = $_GET['classid'];
?>
var classList;
var oReq = new XMLHttpRequest();
oReq.onload = function() {
        classList = JSON.parse(this.responseText);
    };
oReq.open("get", "get_data.php?classid=<?php echo $classID; ?>", true);
oReq.send();

var questions;
oReq = new XMLHttpRequest(),
oReq.onload = function() {
        questions = JSON.parse(this.responseText);
    };
oReq.open("get", "get_data2.php?classid=<?php echo $classID; ?>", true);
oReq.send();

function startTimer()
{
	$("#again").css("display", "none");
	$("#menu").css("display", "none");
	$("#counter").css("display", "block");
	$("#counter").css("font-size", "250px");
	$("#counter").text("3");
	var count = 3;
	var x = setInterval(function(){
		count--;
		if(count == 2)
		{
			$("body").css("background-color", "blue");
		}
		else if(count == 1)
		{
			$("body").css("background-color", "green");
		}
		$("#counter").text(count);
		if(count == 0)
		{
			$("body").css("background-color", "black");
			clearInterval(x);
			getRandomQuestion();
		}
	}, 1000);
}
function getRandomQuestion()
{
	var random1 = getRndInteger(0, classList.length - 1);
	var random2 = getRndInteger(0, classList.length - 1);
	if(classList.length > 1)
	{
		if(random1 == random2)
		{
			random1 = (typeof(classList[random1-1]) === 'undefined') ? random1 + 1 : random1 - 1;
		}
	}
	var random3 = getRndInteger(0, questions.length -1);
	if (typeof(classList[random1]) === 'undefined')
	{
		classList[random1] = 'Teacher';
	}
	if(typeof(classList[random2]) === 'undefined')
	{
		classList[random2] = 'Teacher';
	}
	if(typeof(questions[random3]) === 'undefined')
	{
		questions[random3] = '???';
	}
	if(classList.length == 1)
	{
		$("#counter").html("Teacher" + " -> " + classList[random2] + "<br><br>" + questions[random3]);
	}
	else
	{
		$("#counter").html(classList[random1] + " -> " + classList[random2] + "<br><br>" + questions[random3]);
	}
	if(classList[random1] != 'Teacher')
	{
		classList.splice(random1, 1);
	}
	if(classList[random2] != 'Teacher')
	{
		classList.splice(random2, 1);
	}
	if(questions[random3] != '???')
	{
		questions.splice(random3, 1);
	}
	$("#counter").css("font-size", "40px");
	$("#again").css("display", "");
}
function getRndInteger(min, max) {
  return Math.floor(Math.random() * (max - min + 1) ) + min;
}
</script>
</html>
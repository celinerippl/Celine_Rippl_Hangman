function draw(){
	podium();
	head();
	leftEye();
	rightEye();
	body();
	arm1();
	arm2();
	leg1();
	leg2();
}

function podium(){
	var getcanvas = document.getElementById("hangman");
	var podium = getcanvas.getContext("2d");
	podium.moveTo(50,200); 
	podium.lineTo(50,20);
	podium.stroke();
	podium.moveTo(50,20); 
	podium.lineTo(120,20);
	podium.stroke();
	podium.moveTo(120,20); 
	podium.lineTo(120,50);
	podium.stroke();
	podium.moveTo(20,230); 
	podium.lineTo(50,200);
	podium.stroke();
	podium.moveTo(80,230);
	podium.lineTo(50,200);
	podium.stroke();
	podium.moveTo(20,230);
	podium.lineTo(80,230);
	podium.stroke();
}

function head(){
	var getcanvas = document.getElementById("hangman");
	var head = getcanvas.getContext("2d");
	head.beginPath();
	head.arc(120,70,20,0,2*Math.PI); 
	head.stroke();
}

function leftEye(){
	var getcanvas = document.getElementById("hangman");
	var left_Eye = getcanvas.getContext("2d");
	left_Eye.beginPath();
	left_Eye.arc(125,70,3,0,2*Math.PI); 
	left_Eye.stroke();
}

function rightEye(){
	var getcanvas = document.getElementById("hangman");
	var right_Eye = getcanvas.getContext("2d");
	right_Eye.beginPath();
	right_Eye.arc(115,70,3,0,2*Math.PI); 
	right_Eye.stroke();
}

function verticalLine(){
	var getcanvas = document.getElementById("hangman");
	var vertical_Line= getcanvas.getContext("2d");
	vertical_Line.moveTo(120,90);
	vertical_Line.lineTo(120,180);
	vertical_Line.stroke();
}

function arm1(){
	var getcanvas = document.getElementById("hangman");
	var arm_1 = getcanvas.getContext("2d");
	arm_1.moveTo(120,110);
	arm_1.lineTo(145,145);
	arm_1.stroke();
}

function arm2(){
	var getcanvas = document.getElementById("hangman");
	var arm_2 = getcanvas.getContext("2d");
	arm_2.moveTo(120,110);
	arm_2.lineTo(95,145);
	arm_2.stroke();
}

function leg1(){
	var getcanvas = document.getElementById("hangman");
	var leg_1 = getcanvas.getContext("2d");
	leg_1.moveTo(120,180);
	leg_1.lineTo(95,215);
	leg_1.stroke();
}

function leg2(){
	var getcanvas = document.getElementById("hangman");
	var leg_2 = getcanvas.getContext("2d");
	leg_2.moveTo(120,180);
	leg_2.lineTo(145,215);
	leg_2.stroke();
}
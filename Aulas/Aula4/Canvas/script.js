const canvas = document.getElementById("meuCanvas");
const ctx = canvas.getContext("2d");

ctx.beginPath();
ctx.arc(100,100,50,0,Math.PI*2);
ctx.fillStyle="#000099";
ctx.fill();
ctx.stroke();
ctx.closePath();

ctx.beginPath();
ctx.rect(150,40,100,60);
ctx.strokeStyle="#46de24"
ctx.stroke();
ctx.closePath();

ctx.beginPath();
ctx.moveTo(70, 170);
ctx.lineTo(30, 240);
ctx.lineTo(110, 240);
ctx.closePath();
ctx.strokeStyle="#000000"
ctx.stroke();
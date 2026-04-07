const body = document.getElementsByTagName("body")[0];
const canvas = document.createElement("canvas");
canvas.width = window.innerWidth;
canvas.height = window.innerHeight;
body.appendChild(canvas);
const ctx = canvas.getContext("2d");
const arco = document.getElementsByTagName("arco");
const objArco = {
    x: 100,
    y: 100,
    r: 50,
    cor: "red",
    desenhar: function (x, y, raio, cor, rad) {
        ctx.beginPath();
        ctx.arc(x || this.x,
            y || this.y,
            raio || this.r,
            0,
            rad || 2 * Math.PI, true);
        ctx.fillStyle = cor || this.cor;
        ctx.fill();
        ctx.closePath();
    }
};

function desenharFormas() {
    ctx.clearRect(0,0,canvas.width,canvas.height);
    let velocidade = 2;
    if (arco) {
        for (let a of arco) {
            let raio = a.getAttribute("raio");
            let posX = parseInt(a.getAttribute("posX"));
            let posY = parseInt(a.getAttribute("posY"));
            let cor = a.getAttribute("cor");
            let mover = a.getAttribute("mover");
            let grau = parseInt(a.getAttribute("graus"));
            let rad = grau * (Math.PI / 180);
            if(mover){
                if (mover === "cima")
                    posY-=velocidade;
                else if (mover === "baixo")
                    posY+=velocidade;
                else if (mover === "direita")
                    posX+=velocidade;
                else if (mover === "esquerda")
                    posX-=velocidade;
                
                a.setAttribute("posY", posY);
                a.setAttribute("posX", posX);
            }
            objArco.desenhar(posX, posY, raio, cor, rad);
        }
    }
    requestAnimationFrame(desenharFormas);
}
desenharFormas();



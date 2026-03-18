const canvas = document.getElementById("meuCanvas");
const ctx = canvas.getContext("2d");

let circulo = {
    x:100,
    r:50,
    corBorda: "#fc5b2e",
    corInterna: "#710000",

    desenhar:function (y) {
        ctx.beginPath();
        ctx.arc(this.x, y, this.r, 0, Math.PI*2);
        ctx.strokeStyle=this.corBorda;
        ctx.fillStyle=this.corInterna;
        ctx.stroke();
        ctx.fill();
        ctx.closePath();
    },

    mover:function () {
        this.x++;
    }

};

let retangulo = {
    x:100,
    y: 100,
    w: 300,
    h: 80,
    corBorda: "#fc5b2e",
    corInterna: "#710000",

    desenhar:function () {
        ctx.beginPath();
        ctx.rect(this.x, this.y, this.w, this.h);
        ctx.strokeStyle=this.corBorda;
        ctx.fillStyle=this.corInterna;
        ctx.stroke();
        ctx.fill();
        ctx.closePath();
    },

    mover:function () {
        this.x++;
    }

};



function executar() {
    ctx.clearRect(0,0, canvas.width, canvas.height);
    circulo.desenhar(100);
    circulo.desenhar(200);
    retangulo.desenhar();
    retangulo.mover();
    circulo.mover();
    requestAnimationFrame(executar);
}

executar();
let tabela = document.getElementsByTagName("tabela");

for (let i = 0; i < tabela.length; i++) {

    let tab = tabela[i];
    let linhas = tab.getAttribute("linha");
    let colunas = tab.getAttribute("coluna");
    let novaTabela = document.createElement("table");

    let expand = document.getElementsByTagName("expand");

    let matriz = [];

    for (let w = 0; w < expand.length; w++) {
        matriz.push([
            expand[w].getAttribute("linha"),
            expand[w].getAttribute("coluna"),
            expand[w].getAttribute("tamanho"),
            expand[w].getAttribute("tipo")
        ]);
    }

    let bordaAttr = tab.getAttribute("borda");
    let vetBorda = bordaAttr.split(" ");
    novaTabela.style.setProperty('--cor-borda', vetBorda[2]);
    novaTabela.style.setProperty('--tipo-borda', vetBorda[1]);
    novaTabela.style.setProperty('--tamanho-borda', vetBorda[0]);

    for (let x = 0; x < linhas; x++) {

        let tr = document.createElement("tr");

        for (let y = 0; y < colunas; y++) {
            
            let td = document.createElement("td");
            let span = 1;
            let tipo = null;
            let pular = false;

            for (let k = 0; k < matriz.length; k++) {
                if (matriz[k][0] == x && matriz[k][1] == y) {
                    span = matriz[k][2];
                    tipo = matriz[k][3];
                    break;
                }
            }
            
            for (let k = 0; k < matriz.length; k++) {

                if (matriz[k][3] == "coluna" && matriz[k][1] == y) {

                    let linhaOrigem = parseInt(matriz[k][0]);
                    let tamanho = parseInt(matriz[k][2]);

                    if (x > linhaOrigem && x < linhaOrigem + tamanho) {
                        pular = true;
                        break;
                    }

                }
            }

            if (pular) continue;
            
            
            if (span > 1 && tipo == "linha") {
                td.setAttribute("colspan", span);
                y += span - 1;
            } else if (span > 1 && tipo == "coluna") {
                td.setAttribute("rowspan", span);  
            } 

            tr.appendChild(td);
        }
        novaTabela.appendChild(tr);
    }
    tab.appendChild(novaTabela);

}


//Intercala as cores de acordo com o valor da renda mensal de cada cliente cadastrado.
var arr_valor_renda = document.getElementsByClassName('renda_familia');
for(var i=0;i<arr_valor_renda.length;i++){

    //Pega o conteúdo de texto que tem dentro da ta SPAN que contém a Class "renda_familia"
    var valor_renda = document.getElementsByClassName('renda_familia')[i].innerText;
    /* console.log(valor_renda); */

    //Transforma o valor em float
    valor_renda = parseFloat(valor_renda);
    /* console.log(valor_renda); */
    
    //Pega a TAG
    var valor_renda_html = document.getElementsByClassName('renda_familia')[i];
    /* console.log(valor_renda); */
    
    //Compara os valores para mudar o fundo (Classe A, B ou C de acordo com o caso de uso)
    /* 
    - Classe A: Se a renda for menor ou igual a R$ 980,00, o badge deve ter fundo vermelho.
    - Classe B: Se for entre R$ 980,01 e R$ 2500,00 exibir com fundo amarelho.
    - Classe C: Se for maior que R$ 2500,00 exibir com fundo verde. 
    */

    //Foi necessário fazer a lógica condicional nesse formato pois no formato imagina, não funcionava.
    if(valor_renda <= 980.00){
        valor_renda_html.style.backgroundColor = "red";
    }else if(valor_renda > 2500.00){
        valor_renda_html.style.backgroundColor = "green";
    }else if(valor_renda >= 980.01 || valor_renda <= 2500.00){
        valor_renda_html.style.backgroundColor = "yellow";
        valor_renda_html.style.color = "black";
    }

    //Transforma e apresenta o valor como sendo inteiro e não mais float
    document.getElementsByClassName('renda_familia')[i].innerText = "R$ "+parseInt(valor_renda);
}
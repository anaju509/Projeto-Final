function calcularDespesas() {
    
    const destino = document.getElementById("destino").value;
    const dias = parseInt(document.getElementById("dias").value) || 0;
    const custoHospedagem = parseFloat(document.getElementById("hospedagem").value) || 0;
    const custoAlimentacao = parseFloat(document.getElementById("alimentacao").value) || 0;
    const custoTransporte = parseFloat(document.getElementById("transporte").value) || 0;

    
    if (!destino || dias <= 0) {
        document.getElementById("resultado").textContent = "Por favor, preencha todos os campos obrigatórios!";
        return;
    }

    const total = (custoHospedagem + custoAlimentacao) * dias + custoTransporte;

    
    document.getElementById("resultado").textContent = 
        `O custo total estimado da sua viagem para ${destino} é de R$ ${total.toFixed(2)}.`;
}

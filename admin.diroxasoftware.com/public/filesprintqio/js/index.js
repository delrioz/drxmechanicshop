qz.websocket.connect().then(()=>{

    // Conexão realizada com sucesso
    console.log('Conectado!');


    /**
     * Preenche o select com as impressoras instaladas na máquina
     */
    qz.printers.details().then(function(items) {
      items.forEach(preencherOptions)
      function preencherOptions(item, index) {
        let option = document.createElement("option");
        option.text = item.name;
        option.value = item.name;
        let select = document.getElementById("select");
        select.appendChild(option);
      }
    });

    let printButton = document.querySelector('.js-print');

    printButton.disabled = false;
    printButton.addEventListener('click', function (event) {
      printOrder();
    });
}).catch(()=>{
  console.log("Aplicação do QZ não foi iniciada na máquina local.");
});

function printOrder() {
  /**
   * Defino a impressora que será utilizada, Pego do select.
   * e seto o encoding que será utilizado para evitar problemas com caracteres especiais
   */
  let impressora = document.getElementById("select").value;
  //console.log(impressora)
  let config = qz.configs.create(impressora, { encoding: 'Cp1252' });


  /**
   * Defino um array com todos os itens que irá compor o corpo do documento a ser impresso
   */
  let order = [
    '\x1B' + '\x40',                                          // Inicializo o documento
    '\x10' + '\x14' + '\x01' + '\x00' + '\x05',               // É dado um pulso para iniciar a impressão
    '\x1B' + '\x61' + '\x31',                                 // Defino o alinhamento ao centro


    // Imprimo a logo
    {
      type: 'raw',
      format: 'image',
      flavor: 'file',
      data: 'http://prints.ultracoloringpages.com/6cf37bd68c08355dcb54218db0b98f0f.png',
      options: { language: "escp", dotDensity: 'double' },
    },


    '\x1B' + '\x74' + '\x10',
    '\x0A' + '\x0A',                                          // Quebra de linha

    'Pedido Nº LVE182422' + '\x0A' + '\x0A',                  // Imprimo número do pedido
    '\x0A',                                                   // Quebra de linha


    '\x1B' + '\x45' + '\x0D',                                 // Ativo negrito
    'SEU PEDIDO' + '\x0A' + '\x0A',                           // Imprimo título
    '\x1B' + '\x45\n',                                        // Desativo negrito


    '\x0A',
    '\x1B' + '\x61' + '\x30',                                 // Defino o alinhamento a esquerda


    '\x1B' + '\x45' + '\x0D',                                 // Ativo negrito
    'Cliente: Hugo' + '\x0A' + '\x0A',                        // Imprimo nome do cliente
    'Telefone: (83) 98805-0131' + '\x0A' + '\x0A',            // Imprimo telefone
    '\x1B' + '\x45\n',                                        // Desativo negrito


    // Imprimo linha tracejada
    '------------------------------------------------' + '\x0A' + '\x0A',


    "Macaxeira                            (1) R$ 2,94\n\n",   // Imprimo o produto
    "Alface Crespa                        (1) R$ 2,50\n\n",   // Imprimo o produto
    "Coentro                              (1) R$ 2,50\n\n",   // Imprimo o produto
    "Banana pacovan                       (1) R$ 5,00\n\n",   // Imprimo o produto
    "Batata doce                          (1) R$ 3,80\n\n",   // Imprimo o produto
    "Salsa                                (1) R$ 3,00\n\n",   // Imprimo o produto
    "Manjericão                           (1) R$ 2,21\n\n",   // Imprimo o produto
    "Abacaxi                              (2) R$ 7,60\n\n",   // Imprimo o produto
    "Goma de tapioca 1kg                  (1) R$ 6,00\n\n",   // Imprimo o produto
    "Tomate Cereja 500 gramas             (1) R$ 5,00\n\n",   // Imprimo o produto
    "Mamão havaí                          (1) R$ 4,00\n\n",   // Imprimo o produto


    // Imprimo linha tracejada
    '------------------------------------------------' + '\x0A' + '\x0A',


    'Subtotal                                R$ 44,55' + '\x0A',               // Imprimo subtotal
    'Desconto                                 R$ 0,00\n' + '\x0A' + '\x0A',    // Imprimo desconto
    'Entrega                                   Grátis\n' + '\x0A' + '\x0A',    // Imprimo entrega


    // Imprimo linha tracejada
    '------------------------------------------------' + '\x0A' + '\x0A',


    '\x1B' + '\x21' + '\x30',                                                  // Ativo modo em
    'Total           R$ 44,55' + '\x0A',                                       // Imprimo o total do pedido
    '\x1B' + '\x21' + '\x0A' + '\x1B' + '\x45' + '\x0A' + '\x0A',              // Desativo modo em


    // Imprimo linha tracejada
    '------------------------------------------------' + '\x0A' + '\x0A',


    '\x1B' + '\x45' + '\x0D',                                 // Ativo negrito
    'Forma de pagamento Cartão online' + '\x0A' + '\x0A',     // Imprimo o tipo de pagamento
    'MasterCard - Crédito' + '\x0A' + '\x0A',                 // Imprimo nome do cartão
    '\x1B' + '\x45\n',                                        // Desativo negrito


    '\x0A' + '\x0A',                                          // Quebra de linha


    'Entregar em 29/11/2018' + '\x0A' + '\x0A',               // Imprimo data de entrega
    'Rua Bananeiras, 999' + '\x0A',                           // Imprimo endereço
    'Manaíra, João Pessoa' + '\x0A',                          // Imprimo bairro e cidade
    '58038-170' + '\x0A' + '\x0A',                            // Imprimo cep


    '\x0A' + '\x0A',
    '\x1B' + '\x61' + '\x31',                                 // Defino o alinhamento ao centro
    'NÃO É DOCUMENTO FISCAL' + '\x0A' + '\x0A',               // Imprimo observação


    '\x0A' + '\x0A' + '\x0A' + '\x0A' + '\x0A' + '\x0A' + '\x0A',
    '\x0A' + '\x0A' + '\x0A' + '\x0A' + '\x0A' + '\x0A' + '\x0A',
    '\x1B' + '\x69',                                          // Corto o papel
    '\x10' + '\x14' + '\x01' + '\x00' + '\x05',               // Dou um pulso
  ];


  qz.print(config, order).catch(function(err) {
    console.error(err);
  });
}

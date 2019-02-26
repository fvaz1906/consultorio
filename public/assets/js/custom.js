$("#cep").change(function(){
    $.getJSON( 'https://viacep.com.br/ws/' + $(this).val() + '/json/', function( data ) {
        $("#logradouro").val(data.logradouro);
        $("#bairro").val(data.bairro);
        $("#localidade").val(data.localidade);
        $("#uf").val(data.uf);
        $("#numero").focus();
    });
});
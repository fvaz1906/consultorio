$("#cep").change(function(){
    $.getJSON( 'https://viacep.com.br/ws/' + $(this).val() + '/json/', function( data ) {
        $("#logradouro").val(data.logradouro);
        $("#bairro").val(data.bairro);
        $("#localidade").val(data.localidade);
        $("#uf").val(data.uf);
        $("#numero").focus();
    });
});

//Vizualização do password no fomrulário
$('#eye-button').click(function() {
    if($('#eye').attr('type') == 'text') {
        $('#eye').attr('type', 'password')
    } else {
        $('#eye').attr('type', 'text')
    }
});

//Verificação do tipo de usuário
if($("#crm_hide").attr('data-perf') == 'medico') {
    $("#cpf_hide").hide()
} else {
    $("#crm_hide").hide()
}
$(".form-check-input").change(function() {
    if($(this).attr('id') == "medico") {
        $("#cpf_hide").hide();
        $("#cpf").attr('required', false);
        $("#crm_hide").show();
        $("#crm").val('');
        $("#crm").attr('required', true);
    } else {
        $("#crm_hide").hide();
        $("#crm").attr('required', false);
        $("#cpf_hide").show();
        $("#cpf").val('');
        $("#cpf").attr('required', true);
    }
});
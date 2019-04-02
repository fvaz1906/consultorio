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

//Autocomplete Agendamento de Consultas
if($("#patients").attr('name') != '') {
    $.getJSON( 'http://consultorio.dev.br/query/patients', function( data ) {
        var names = [];
        $.each( data, function( key, val ) {
            names.push(val.name);
        });
        $( "#patients" ).autocomplete({
            source: names
        });
    });
}

//Confirma opções de usuário
if($('#listPatient').text() == 'listPatient') {
    function issueRevenue(id) {
        if(confirm("Deseja emitir uma receita?")){
            window.location.href = '/documents/recipe/add/' + id;
        }
    }
    function deletePatient(id) {
        if(confirm("Deseja realmente excluir este paciente?")){
            window.location.href = '/patient/remove/' + id;
        }
    }
    function editPatient(id) {
        if(confirm("Deseja realmente editar este paciente?")){
            window.location.href = '/patient/edit/' + id;
        }
    }
    function viewPatient(id) {
        if(confirm("Deseja realmente vizualizar o perfil deste paciente?")){
            window.location.href = '/patient/view/' + id;
        }
    }
}
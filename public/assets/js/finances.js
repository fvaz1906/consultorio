$('.movement').click(function(){
    var movement = $(this).attr('id')
    if (movement == 'input') {
        $('.modal-header').attr('class', 'modal-header bg-success text-white')
        $('#record').attr('class', 'btn btn-success fa-pull-right')
        $('.modal-title').html('Movimentação de Entrada')
        $('#type_movement').val(1)
    } else {
        $('.modal-header').attr('class', 'modal-header bg-danger text-white')
        $('#record').attr('class', 'btn btn-danger fa-pull-right')
        $('.modal-title').html('Movimentação de Saída')
        $('#type_movement').val(0)
    }
})
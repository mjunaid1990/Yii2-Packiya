/* 
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Other/javascript.js to edit this template
 */


$(document).on('click', '#add-input', function() {
    var container = $('#input-container');
    var len = $('#input-container .row').length;
    var newInput = '';
    newInput += '<div class="row row-'+len+'" style="margin-bottom: 10px;">';
            newInput += '<div class="col-md-5">';
                newInput += '<input type="file" name="Products[images][]" accept="images/*" />';
            newInput += '</div>';
            newInput += '<div class="col-md-5">';
                newInput += '<input type="number" name="Products[order_no]" value="" min="0" placeholder="Order No" />';
            newInput += '</div>';
            newInput += '<div class="col-md-2">';
                newInput += '<button type="button" class="btn btn-danger btn-sm" id="remove-input" data-id="'+len+'"><i class="fa fa-remove"></i></button>';
            newInput += '</div>';
        newInput += '</div>';

    container.append(newInput);
});

$(document).on('click', '#remove-input', function() {
    var id = $(this).data('id');
    $('.row-'+id).remove();
});
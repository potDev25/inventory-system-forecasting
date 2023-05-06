$(document).ready(function(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    var date = $('#date').val();
    showInventory(date);

    $(document).on('click', '.edit', function(){
        var id = $(this).data('id');
        var sales = $(this).data('sales');
        var product = $(this).data('product');

        $('#sales').val(sales);
        $('#product_name').val(product);
        $('#id').val(id);
    })

    $('#edit-inventory').on('submit', function(e){
        e.preventDefault();

        $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
        });

        var form = $(this).serialize();
        var url = $(this).attr('action');
        /*$.post(url, form, function(){
            $('#editInv').modal('hide');
            showInventory();
        })*/
        $.ajax({
            type: "POST",
            url: url,
            data: form,
            dataType: "json",
            success: function(data){
                $('#editInv').modal('hide');
                showInventory();
            }
        })
    })
})

function showInventory(date){
    $.get("/getInventory?date="+date, function(data){
        $('#inventory-table').empty().html(data);
    })
}
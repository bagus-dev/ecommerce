function format ( d ) {
    return '<table cellpadding = "5" cellspacing = "0" border = "0" style = "padding-left:50px;">'+
        '<tr>'+
            '<td>Foto Produk:</td>'+
            '<td><a class = "example-image-link" href = "product_images/'+d.product_img1+'" data-lightbox = "example-set" data-title = "'+d.product_title+'"><img class = "thumbnail img-responsive" width = "200" height = "200" src = "product_images/'+d.product_img1+'"></a></td>'+
        '</tr>'+
    '</table>';
}
$(document).ready(function() {
    var table = $('#orders_table').DataTable( {
        "ajax": "data_orders.json",
        "columns": [
            {
                "className":    'details-control',
                "orderable":    false,
                "data":         null,
                "defaultContent": ''
            },
            { "data": "order_id"},
            { "data": "customer_email" },
            { "data": "invoice_no" },
            { "data": "product_id" },
            { "data": "qty" },
            { "data": "size" },
            { "data": "order_status" }
        ],
        "order": [[1, 'desc']]
    } );

    $('#orders_table tbody').on('click', 'td.details-control', function(){
        var tr = $(this).closest('tr');
        var row = table.row( tr );

        if( row.child.isShown()){
            row.child.hide();
            tr.removeClass('shown');
        }
        else{
            row.child(format(row.data())).show();
            tr.addClass('shown');
        }
    });
});
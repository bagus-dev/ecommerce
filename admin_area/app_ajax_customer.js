function format ( d ) {
    return '<table cellpadding = "5" cellspacing = "0" border = "0" style = "padding-left:50px;">'+
        '<tr>'+
            '<td>Foto Pelanggan:</td>'+
            '<td><a class = "example-image-link" href = "../customer/customer_images/'+d.customer_image+'" data-lightbox = "example-set" data-title = "'+d.customer_name+'"><img class = "thumbnail img-responsive" width = "200" height = "200" src = "../customer/customer_images/'+d.customer_image+'"></a></td>'+
        '</tr>'+
        '<tr>'+
            '<td>ID Pelanggan:</td>'+
            '<td>'+d.customer_id+'</td>'+
        '</tr>'+
    '</table>';
}
$(document).ready(function() {
    var table = $('#customers_table').DataTable( {
        "ajax": "data_customer.json",
        "columns": [
            {
                "className":    'details-control',
                "orderable":    false,
                "data":         null,
                "defaultContent": ''
            },
            { "data": "customer_name" },
            { "data": "customer_email" },
            { "data": "customer_country" },
            { "data": "customer_city" },
            { "data": "customer_contact" },
            { "data": "customer_address" },
        ],
        "order": [[1, 'asc']]
    } );

    $('#customers_table tbody').on('click', 'td.details-control', function(){
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
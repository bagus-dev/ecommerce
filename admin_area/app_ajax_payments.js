function format ( d ) {
    return '<table cellpadding = "5" cellspacing = "0" border = "0" style = "padding-left:50px;">'+
        '<tr>'+
            '<td>Bukti Pembayaran:</td>'+
            '<td><a class = "example-image-link" href = "../customer/payment_images/'+d.payment_image+'" data-lightbox = "example-set" data-title = "Pembayaran '+d.invoice_no+'"><img class = "thumbnail img-responsive" width = "200" height = "200" src = "../customer/payment_images/'+d.payment_image+'"></a></td>'+
        '</tr>'+
        '<tr>'+
            '<td>Nama Produk yang Dipesan:</td>'+
            '<td>'+d.product_title+'</td>'+
        '</tr>'+
        '<tr>'+
            '<td>No. Pembayaran:</td>'+
            '<td>'+d.payment_id+'</td>'+
        '</tr>'+
        '<tr>'+
            '<td>Tanggal Pembayaran:</td>'+
            '<td>'+d.payment_date+'</td>'+
        '</tr>'+
        '<tr>'+
            '<td>Tombol Aksi:</td>'+
            '<td><a href = "index.php?edit_status='+d.payment_id+'" class = "btn btn-success"><i class = "fa fa-edit"></i> Perbarui Status </a></td>'+
        '</tr>'+
    '</table>';
}
$(document).ready(function() {
    var table = $('#payments_table').DataTable( {
        "ajax": "data_payments.json",
        "columns": [
            {
                "className":    'details-control',
                "orderable":    false,
                "data":         null,
                "defaultContent": ''
            },
            { "data": "invoice_no"},
            { "data": "amount" },
            { "data": "payment_mode" },
            { "data": "ref_no" },
            { "data": "code" },
            { "data": "payment_status" }
        ],
        "order": [[1, 'desc']]
    } );

    $('#payments_table tbody').on('click', 'td.details-control', function(){
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
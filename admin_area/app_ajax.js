function format ( d ) {
    return '<table cellpadding = "5" cellspacing = "0" border = "0" style = "padding-left:50px;">'+
        '<tr>'+
            '<td>Foto Produk:</td>'+
            '<td><a class = "example-image-link" href = "product_images/'+d.product_img1+'" data-lightbox = "example-set" data-title = "'+d.product_title+'"><img class = "thumbnail img-responsive" width = "200" height = "200" src = "product_images/'+d.product_img1+'"></a></td>'+
        '</tr>'+
        '<tr>'+
            '<td>Produk ID:</td>'+
            '<td>'+d.product_id+'</td>'+
        '</tr>'+
        '<tr>'+
            '<td>Harga Produk:</td>'+
            '<td>'+d.product_price+'</td>'+
        '</tr>'+
        '<tr>'+
            '<td>Kata Kunci Produk:</td>'+
            '<td>'+d.product_keywords+'</td>'+
        '</tr>'+
        '<tr>'+
            '<td>Deskripsi Produk:</td>'+
            '<td>'+d.product_desc+'</td>'+
        '</tr>'+
        '<tr>'+
            '<td>Tombol Aksi:</td>'+
            '<td><a href = "index.php?edit_product='+d.product_id+'" class = "btn btn-success"><i class = "fa fa-edit"></i> Perbarui Produk </a>&emsp;<a href = "index.php?delete_product='+d.product_id+'" class = "btn btn-danger" onclick = "return confirm(&quot;Hapus Produk?&quot;)"><i class = "fa fa-trash"></i> Hapus Produk </a></td>'+
        '</tr>'+
    '</table>';
}
$(document).ready(function() {
    var table = $('#example').DataTable( {
        "ajax": "data.json",
        "columns": [
            {
                "className":    'details-control',
                "orderable":    false,
                "data":         null,
                "defaultContent": ''
            },
            { "data": "product_title" },
            { "data": "p_cat_id" },
            { "data": "cat_id" },
            { "data": "date" }
        ],
        "order": [[1, 'asc']]
    } );

    $('#example tbody').on('click', 'td.details-control', function(){
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
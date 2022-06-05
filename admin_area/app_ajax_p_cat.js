function format ( d ) {
    return '<table cellpadding = "5" cellspacing = "0" border = "0" style = "padding-left:50px;">'+
        '<tr>'+
            '<td>ID Kategori Produk:</td>'+
            '<td>'+d.p_cat_id+'</td>'+
        '</tr>'+
        '<tr>'+
            '<td>Tombol Aksi:</td>'+
            '<td><a href = "index.php?edit_p_cat='+d.p_cat_id+'" class = "btn btn-success"><i class = "fa fa-edit"></i> Perbarui Kategori Produk </a>&emsp;<a href = "index.php?delete_p_cat='+d.p_cat_id+'" class = "btn btn-danger" onclick = "return confirm(&quot;Hapus Kategori Produk?&quot;)"><i class = "fa fa-trash"></i> Hapus Kategori Produk </a></td>'+
        '</tr>'+
    '</table>';
}
$(document).ready(function() {
    var table = $('#p_cat_table').DataTable( {
        "ajax": "data_p_cat.json",
        "columns": [
            {
                "className":    'details-control',
                "orderable":    false,
                "data":         null,
                "defaultContent": ''
            },
            { "data": "p_cat_title" },
            { "data": "p_cat_desc" }
        ],
        "order": [[1, 'asc']]
    } );

    $('#p_cat_table tbody').on('click', 'td.details-control', function(){
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
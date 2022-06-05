function format ( d ) {
    return '<table cellpadding = "5" cellspacing = "0" border = "0" style = "padding-left:50px;">'+
        '<tr>'+
            '<td>ID Kategori:</td>'+
            '<td>'+d.cat_id+'</td>'+
        '</tr>'+
        '<tr>'+
            '<td>Tombol Aksi:</td>'+
            '<td><a href = "index.php?edit_cat='+d.cat_id+'" class = "btn btn-success"><i class = "fa fa-edit"></i> Perbarui Kategori </a>&emsp;<a href = "index.php?delete_cat='+d.cat_id+'" class = "btn btn-danger" onclick = "return confirm(&quot;Hapus Kategori?&quot;)"><i class = "fa fa-trash"></i> Hapus Kategori </a></td>'+
        '</tr>'+
    '</table>';
}
$(document).ready(function() {
    var table = $('#cat_table').DataTable( {
        "ajax": "data_cat.json",
        "columns": [
            {
                "className":    'details-control',
                "orderable":    false,
                "data":         null,
                "defaultContent": ''
            },
            { "data": "cat_title" },
            { "data": "cat_desc" }
        ],
        "order": [[1, 'asc']]
    } );

    $('#cat_table tbody').on('click', 'td.details-control', function(){
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
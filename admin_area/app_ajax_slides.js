function format ( d ) {
    return '<table cellpadding = "5" cellspacing = "0" border = "0" style = "padding-left:50px;">'+
        '<tr>'+
            '<td>Foto Slide:</td>'+
            '<td><a class = "example-image-link" href = "slides_images/'+d.slide_image+'" data-lightbox = "example-set" data-title = "'+d.slide_name+'"><img class = "thumbnail img-responsive" width = "200" height = "200" src = "slides_images/'+d.slide_image+'"></a></td>'+
        '</tr>'+
        '<tr>'+
            '<td>ID Slide:</td>'+
            '<td>'+d.slide_id+'</td>'+
        '</tr>'+
        '<tr>'+
            '<td>Tombol Aksi:</td>'+
            '<td><a href = "index.php?edit_slide='+d.slide_id+'" class = "btn btn-success"><i class = "fa fa-edit"></i> Perbarui Status Slide </a></td>'+
        '</tr>'+
    '</table>';
}
$(document).ready(function() {
    var table = $('#slides_table').DataTable( {
        "ajax": "data_slides.json",
        "columns": [
            {
                "className":    'details-control',
                "orderable":    false,
                "data":         null,
                "defaultContent": ''
            },
            { "data": "slide_name" },
            { "data": "slide_status" }
        ],
        "order": [[1, 'asc']]
    } );

    $('#slides_table tbody').on('click', 'td.details-control', function(){
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
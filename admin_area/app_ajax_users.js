function format ( d ) {
    return '<table cellpadding = "5" cellspacing = "0" border = "0" style = "padding-left:50px;">'+
        '<tr>'+
            '<td>Foto Pengguna:</td>'+
            '<td><a class = "example-image-link" href = "admin_images/'+d.admin_image+'" data-lightbox = "example-set" data-title = "'+d.admin_name+'"><img class = "thumbnail img-responsive" width = "200" height = "200" src = "admin_images/'+d.admin_image+'"></a></td>'+
        '</tr>'+
        '<tr>'+
            '<td>Admin ID:</td>'+
            '<td>'+d.admin_id+'</td>'+
        '</tr>'+
        '<tr>'+
            '<td>Tentang Saya:</td>'+
            '<td>'+d.admin_about+'</td>'+
        '</tr>'+
    '</table>';
}
$(document).ready(function() {
    var table = $('#users_table').DataTable( {
        "ajax": "data_users.json",
        "columns": [
            {
                "className":    'details-control',
                "orderable":    false,
                "data":         null,
                "defaultContent": ''
            },
            { "data": "admin_name" },
            { "data": "admin_email" },
            { "data": "admin_country" },
            { "data": "admin_contact" },
            { "data": "admin_job" }
        ],
        "order": [[1, 'asc']]
    } );

    $('#users_table tbody').on('click', 'td.details-control', function(){
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
var table=null;
$(document).ready(function () {
    $.fn.dataTable.ext.errMode = 'none';
    table= $('#data-table').DataTable({
        ...data_table_config,
        "processing": true,
        "serverSide": true,
        "language": {
            "lengthMenu": "نمایش _MENU_ آیتم در هر صفحه",
            "zeroRecords": "آیتمی یافت نشد",
            "info": "صفحه _PAGE_ از _PAGES_",
            "infoEmpty": "آیتمی در دسترس نیست",
            "infoFiltered": "(filtered from _MAX_ total records)",
            "sSearch": "جستجو: ",
            "sProcessing": "درحال دریافت اطلاعات ...",
            "oPaginate": {
                "sFirst": "اولین صفحه",
                "sPrevious": "قبلی",
                "sNext": "بعدی",
                "sLast": "آخرین صفحه"
            },
        }
    });

    $('#data-table tbody').on( 'click', 'tr', function () {
        if ( $(this).hasClass('selected') ) {
            $(this).removeClass('selected');
        }
        else {
            table.$('tr.selected').removeClass('selected');
            $(this).addClass('selected');
        }
    } ).on('click', 'tr a', function (e) {
       // e.stopPropagation();
    });

});

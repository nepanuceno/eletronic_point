$(function () {
    $('.table').DataTable({
        dom: 'Bfrtip',
        paging: true,
        language: {
            url: ''
        },
        buttons: [
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
            'pdfHtml5'
        ],
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.18/i18n/Portuguese-Brasil.json"
            },
    });
});

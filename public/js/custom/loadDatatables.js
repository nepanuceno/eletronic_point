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
        ]
    });
});

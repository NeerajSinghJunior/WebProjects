$(document).ready(function() {
        $('#myTable').DataTable();
        $(document).ready(function() {
            var table = $('#example').DataTable({
                "columnDefs": [{
                    "visible": false,
                    "targets": 2
                }],
                "order": [
                    [2, 'asc']
                ],
                "displayLength": 25,
                "drawCallback": function(settings) {
                    var api = this.api();
                    var rows = api.rows({
                        page: 'current'
                    }).nodes();
                    var last = null;
                    api.column(2, {
                        page: 'current'
                    }).data().each(function(group, i) {
                        if (last !== group) {
                            $(rows).eq(i).before('<tr class="group"><td colspan="5">' + group + '</td></tr>');
                            last = group;
                        }
                    });
                }
            });
            // Order by the grouping
            $('#example tbody').on('click', 'tr.group', function() {
                var currentOrder = table.order()[0];
                if (currentOrder[0] === 2 && currentOrder[1] === 'asc') {
                    table.order([2, 'desc']).draw();
                } else {
                    table.order([2, 'asc']).draw();
                }
            });
        });
    });
    var export_columns=document.getElementById('export_columns').value;
    $('#example23').DataTable({
        dom: 'Bfrtip',
        buttons: [
            {
                extend: 'copyHtml5',
                exportOptions: {
                    columns: [ export_columns ]
                }
            },
            {
                extend: 'csvHtml5',
                exportOptions: {
                    columns: [ export_columns ]
                }
            },
            {
                extend: 'excelHtml5',
                exportOptions: {
                    columns: [ export_columns ]
                }
            },
            {
                extend: 'pdfHtml5',
                exportOptions: {
                    columns: [ export_columns ]
                }
            },
            {
                extend: 'print',
                exportOptions: {
                    columns: [ export_columns ]
                }
            }
        ]
        // buttons: [
        //     'copy', 'csv', 'excel', 'pdf', 'print'
        // ]
    });
    var export_columns1=document.getElementById('export_columns1').value;
    $('#example32').DataTable({
        dom: 'Bfrtip',
        buttons: [
            {
                extend: 'copyHtml5',
                exportOptions: {
                    columns: [ export_columns ]
                }
            },
            {
                extend: 'csvHtml5',
                exportOptions: {
                    columns: [ export_columns ]
                }
            },
            {
                extend: 'excelHtml5',
                exportOptions: {
                    columns: [ export_columns ]
                }
            },
            {
                extend: 'pdfHtml5',
                exportOptions: {
                    columns: [ export_columns ]
                }
            },
            {
                extend: 'print',
                exportOptions: {
                    columns: [ export_columns ]
                }
            }
        ]
        // buttons: [
        //     'copy', 'csv', 'excel', 'pdf', 'print'
        // ]
    });
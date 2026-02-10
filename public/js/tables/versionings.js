$(document).ready(function() {
    var table = $('#versioningsTable').DataTable({
        language: {
            search: "Buscar:",
            lengthMenu: "Mostrar _MENU_ registros",
            info: "Mostrando _START_ a _END_ de _TOTAL_ registros",
            paginate: {
                first: "Primeiro",
                last: "Último",
                next: "Próximo",
                previous: "Anterior"
            },
            zeroRecords: "Nenhum registro encontrado",
        },
        order: [[0, 'asc']]
    });

    $('#userFilter').on('change', function() {
        var user = $(this).val();
        table.column(3).search(user).draw();
    });

    $('#statusFilter').on('change', function() {
        var status = $(this).val();
        table.column(1).search(status ? '^' + status + '$' : '', true, false).draw();
    });

    $('#resetFilter').on('click', function() {
        $('#userFilter').val('');
        table.column(2).search('').draw();
    });
});
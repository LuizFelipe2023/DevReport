$(document).ready(function () {
    let table = $('#projectsTable').DataTable({
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

    $('#statusFilter').on('change', function () {
        var status = $(this).val();
        table.column(2).search(status ? '^' + status + '$' : '', true, false).draw();
    });
});
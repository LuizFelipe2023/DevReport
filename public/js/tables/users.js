$(document).ready(function() {
    var table = $('#usersTable').DataTable({
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

    $('#roleFilter').on('change', function() {
        var role = $(this).val();
        table.column(2).search(role).draw();
    });
});
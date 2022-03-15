var dualListBox = $('.dualListBox').bootstrapDualListbox({
    nonSelectedListLabel: 'Lista de Permissões',
    selectedListLabel: 'Permissões Selecionandas',
    preserveSelectionOnMove: 'moved',
    moveAllLabel: 'Mover Todos',
    removeAllLabel: 'Remove Todos',
    infoText: 'Exibindo {0}',
    infoTextFiltered: '<span class="badge badge-warning">Filtrados</span> {0} de {1}',
    btnMoveAllText: 'Selecionar tudo &gt;&gt;',
    btnRemoveAllText: '&lt;&lt; Remover tudo',
    infoTextEmpty: 'Lista Vazia',
    filterPlaceHolder: 'Filtro',
});
// $("#demoform").submit(function() {
//     alert($('[name="permissions[]"]').val());
//     return false;
// });

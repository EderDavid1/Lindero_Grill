$(document).ready(function() {
  $('#nombreInspector').select2({
    placeholder: "Seleccione un inspector",
    
    dropdownParent: $('#inspeccionModal') // Corrige la referencia de dropdownParent
  });
});

  // Agregar inspector a la tabla
  document.getElementById('addInspector').addEventListener('click', function() {
    const inspectorSelect = document.getElementById('nombreInspector');
    const inspectorName = inspectorSelect.options[inspectorSelect.selectedIndex].text;
    const inspectorValue = inspectorSelect.value;

    if (inspectorValue) {
      const table = document.getElementById('inspectoresTable').getElementsByTagName('tbody')[0];
      const newRow = table.insertRow();
      const cell1 = newRow.insertCell(0);
      const cell2 = newRow.insertCell(1);
      const cell3 = newRow.insertCell(2);

      cell1.textContent = inspectorName;
      cell3.innerHTML = '<button type="button" class="btn btn-danger btn-sm remove-inspector">Eliminar</button>';

      // Restablecer el select
      $('#nombreInspector').val(null).trigger('change');
    }
  });

  // Eliminar inspector de la tabla
  document.getElementById('inspectoresTable').addEventListener('click', function(e) {
    if (e.target && e.target.classList.contains('remove-inspector')) {
      const row = e.target.closest('tr');
      row.remove();
    }
  });
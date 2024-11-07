$(document).ready(function () { 
    listarPersonas();

    document.getElementById('formPersona').addEventListener('submit', function (e) {
        e.preventDefault();
    
        const formData = new FormData(this);
        const fileInput = document.getElementById('pers_foto');
        const file = fileInput.files[0];
    
        // Remover el campo 'pers_foto' original del formData, si ya existe
        formData.delete('pers_foto');

        if (file) {
            // Convertir la imagen a base64 y agregar prefijo JPEG
            const reader = new FileReader();
            reader.onloadend = function () {
                const base64Image = "data:image/jpeg;base64," + reader.result.split(',')[1];
                formData.append('pers_foto', base64Image);
                sendForm(formData);
            };
            reader.readAsDataURL(file);
        } else {
            // Enviar una cadena vacía si no se selecciona imagen
            formData.append('pers_foto', '');
            sendForm(formData);
        }
    });
});

function sendForm(formData) {
    // Determinar la acción de insertar o actualizar según el valor de pers_id
    const action = $("#pers_id").val() === "" ? "insertar_persona" : "actualizar_persona";

    fetch(`../../controller/personal.php?op=${action}`, {
        method: 'POST',
        body: formData
    })
    .then(response => response.text())
    .then(() => {
        $('#modal_persona').modal('hide'); // Cerrar el modal
        listarPersonas(); // Recargar la lista de personas
    })
    .catch(error => console.error('Error:', error));
}

// Listar las personas y mostrar en el contenedor
function listarPersonas() {
    $.ajax({
        url: "../../controller/personal.php?op=listar_personas",
        type: "GET",
        success: function(response) {
            $("#PersonaContainer").html(response);
        },
        error: function() {
            toastr.error("Error al cargar el personal.", "Error");
        }
    });
}

// Abrir el modal para agregar una nueva persona
function nuevo() {
    $("#formPersona")[0].reset(); // Limpiar todos los campos
    $("#pers_id").val(""); // Asegurarse de que pers_id esté vacío
    $("#modal_personaLabel").text("Agregar Persona");
    $("#foto_preview").hide(); // Ocultar la vista previa de la foto
    $("#modal_persona").modal("show"); // Mostrar el modal
}

// Previsualizar la imagen seleccionada en el input
$('#pers_foto').on('change', function(event) {
    const fileName = $(this).val().split('\\').pop();
    $(this).siblings('.custom-file-label').addClass("selected").html(fileName);
    previewImage(event); // Mostrar la imagen seleccionada en la vista previa
});

// Función para mostrar la imagen en el campo de vista previa
function previewImage(event) {
    const input = event.target;
    const reader = new FileReader();
    reader.onload = function () {
        const dataURL = reader.result;
        $("#foto_preview").attr("src", dataURL).show();
    };
    reader.readAsDataURL(input.files[0]);
}

// Editar persona: cargar datos en el modal y mostrar la imagen en vista previa
function editarPersona(pers_id) {
    $.ajax({
        url: "../../controller/personal.php?op=ver_persona",
        type: "POST",
        data: { pers_id: pers_id },
        success: function(data) {
            const persona = JSON.parse(data);
            $("#pers_id").val(persona.pers_id);
            $("#pers_nombre").val(persona.pers_nombre);
            $("#pers_apelpat").val(persona.pers_apelpat);
            $("#pers_apelmat").val(persona.pers_apelmat);
            $("#pers_doc").val(persona.pers_doc);
            $("#pers_est").val(persona.pers_est);

            // Mostrar la imagen en el preview del modal
            if (persona.pers_foto) {
                $("#foto_preview").attr("src", persona.pers_foto).show();
            } else {
                $("#foto_preview").hide();
            }

            $("#modal_personaLabel").text("Editar Persona");
            $("#modal_persona").modal("show");
        },
        error: function() {
            toastr.error("Error al cargar los datos.", "Error");
        }
    });
}
function eliminarPersona(pers_id, estado) {
    const nuevoEstado = estado === 1 ? 0 : 1; // Cambia el estado: 1 a 0 (eliminar), 0 a 1 (reactivar)
    const mensaje = estado === 1 ? "¿Estás seguro de que deseas eliminar esta persona?" : "¿Estás seguro de que deseas reactivar esta persona?";

    Swal.fire({
        title: 'Confirmar',
        text: mensaje,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: estado === 1 ? 'Eliminar' : 'Reactivar',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            // Realizar la solicitud para cambiar el estado
            fetch(`../../controller/personal.php?op=eliminar_persona`, {
                method: 'POST',
                body: JSON.stringify({ pers_id: pers_id, estado: nuevoEstado }),
                headers: {
                    'Content-Type': 'application/json'
                }
            })
            .then(response => response.text())
            .then(data => {
                toastr.success(data); // Mostrar mensaje de éxito
                listarPersonas(); // Recargar la lista de personas
            })
            .catch(error => {
                console.error('Error:', error);
                toastr.error("Error al cambiar el estado de la persona.", "Error");
            });
        }
    });
}

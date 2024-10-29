function convertirImagenBase64(input) {
  const reader = new FileReader();
  reader.onload = function(e) {
    document.getElementById("foto_base64").value = e.target.result;
  }
  reader.readAsDataURL(input.files[0]);
}


function listarUsuarios() {
  $.ajax({
    url: "../../controller/usuario.php?op=listar_usuarios",
    type: "GET",
    success: function (response) {
      let data = JSON.parse(response).data;
      let tabla = $("#usuarioTable").DataTable();
      tabla.clear();
      data.forEach(usuario => {
        tabla.row.add([
          usuario.pers_id,
          usuario.pers_nombre,
          usuario.pers_apelpat,
          usuario.pers_apelmat,
          usuario.pers_doc,
          `<img src="${usuario.pers_foto}" width="50" />`,
          `<button class="btn btn-warning" onclick="editarUsuario(${usuario.pers_id})">Editar</button>`
        ]).draw();
      });

      cargarUsuariosEnTarjetas(data);
    }
  });
}

function cargarUsuariosEnTarjetas(usuarios) {
  let container = document.getElementById("UsuarioContainer");
  container.innerHTML = '';
  usuarios.forEach(usuario => {
    let card = `
      <div class="col-md-3">
        <div class="card">
          <img src="${usuario.pers_foto}" class="card-img-top" alt="Foto de ${usuario.pers_nombre}">
          <div class="card-body">
            <h5 class="card-title">${usuario.pers_nombre} ${usuario.pers_apelpat}</h5>
            <p class="card-text">${usuario.pers_doc}</p>
            <button class="btn btn-warning" onclick="editarUsuario(${usuario.pers_id})">Editar</button>
          </div>
        </div>
      </div>
    `;
    container.insertAdjacentHTML('beforeend', card);
  });
}

function cargarRolesYSistemas() {
  $.get("../../controller/usuario.php?op=obtener_roles", function(response) {
    let roles = JSON.parse(response);
    let rolSelect = $("#rol_id");
    rolSelect.empty();
    roles.forEach(rol => {
      rolSelect.append(`<option value="${rol.rol_id}">${rol.rol_nombre}</option>`);
    });
  });

  $.get("../../controller/usuario.php?op=obtener_sistemas", function(response) {
    let sistemas = JSON.parse(response);
    let sistSelect = $("#sist_id");
    sistSelect.empty();
    sistemas.forEach(sistema => {
      sistSelect.append(`<option value="${sistema.sist_id}">${sistema.sist_nom}</option>`);
    });
  });
}

function editarUsuario(pers_id) {
  $.post("../../controller/usuario.php?op=obtener_usuario", { pers_id: pers_id }, function(data) {
    let usuario = JSON.parse(data);
    $("#pers_id").val(usuario.pers_id);
    $("#pers_nombre").val(usuario.pers_nombre);
    $("#pers_apelpat").val(usuario.pers_apelpat);
    $("#pers_apelmat").val(usuario.pers_apelmat);
    $("#pers_doc").val(usuario.pers_doc);
    $("#foto_base64").val(usuario.pers_foto);
    $("#modal_usuario").modal("show");
  });
}

function guardarUsuario() {
  let formData = $("#formUsuario").serialize();
  $.post("../../controller/usuario.php?op=registrar_usuario", formData, function(response) {
    $("#modal_usuario").modal("hide");
    listarUsuarios();
  });
}

// Inicializar roles y sistemas al cargar la página
document.addEventListener('DOMContentLoaded', function() {
  listarUsuarios();
  cargarRolesYSistemas();
});

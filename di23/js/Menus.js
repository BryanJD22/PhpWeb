//funcion para printar en una vista los menus de usuario

id_padreGuardada = 0;
function buscarMenus(   
) {
  let opciones = { method: "GET" };
  let parametros = "controlador=Menus&metodo=busquedaMenus";
  parametros +=
    "&" +
    new URLSearchParams(
      new FormData(document.getElementById("formBusquedaMenus"))
    ).toString();



  fetch("C_Ajax.php?" + parametros, opciones)
    .then((res) => {
      if (res.ok) {
        console.log("Respuesta ok");
        return res.text();
      }
    })
    .then((vista) => {
      document.getElementById("bloqueMttoMenu").innerHTML = vista;
      console.log("deberia ir bien");
    })
    .catch((err) => {
      console.log("Error al realizar la peticion.", err.message);
    });
}

function buscarMenusporID( id_menu  
) {
  let opciones = { method: "GET" };
  let parametros = "controlador=Menus&metodo=busquedaMenusPorID";
  parametros +=
    "&" +
    new URLSearchParams(
      new FormData(document.getElementById("formBusquedaMenus"))
    ).toString();
    parametros += "id_menu=" + id_menu;
    console.log("parametros: " + parametros);
  
  fetch("C_Ajax.php?" + parametros, opciones)
    .then((res) => {
      if (res.ok) {
        console.log("Respuesta ok");
        return res.text();
      }
    })
    .then((vista) => {
      document.getElementById("formularioEditar_" + id_menu).innerHTML = vista;
      console.log("deberia ir bien");
    })
    .catch((err) => {
      console.log("Error al realizar la peticion.", err.message);
    });

}
function toggleFormularioEditar(menuId) {
  var formularioEditar = document.getElementById('formularioEditar_' + menuId);
  if (formularioEditar) {
      var formularios = document.querySelectorAll('.formularioEditar');
      for (var i = 0; i < formularios.length; i++) {
          if (formularios[i] !== formularioEditar) {
              formularios[i].style.display = 'none';
          }
      }
      formularioEditar.style.display = (formularioEditar.style.display === 'none') ? 'block' : 'none';
  } else {
      console.log('El elemento formularioEditar_' + menuId + ' no se encontró en el DOM.');
  }
}
function updateMenu(id_menu){
  let opciones = { method: "GET" };
    let parametros = "controlador=Menus&metodo=editarMenu";
    parametros += "&id_menu=" + id_menu + "&" + new URLSearchParams(new FormData(document.getElementById("formularioUpdatearMenu"))).toString();

    console.log(parametros)

    fetch("C_Ajax.php?" + parametros, opciones)
        .then(res => {
            if (res.ok) {
                console.log('respuesta ok');
                
                return res.text();
            }
        })
        .then(vista => {
          buscarMenus();
        })
        .catch(err => {
            //Error al realizar la petición Cannot set properties of null (setting 'innerHTML')
            console.log("Error al realizar la petición", err.message);
        });

};

function eliminarMenu(id_menu) {
  buscarMenus(id_menu);
  id_menuGuardada = id_menu;

  console.log("Estoy guardando el id (guardarMenuId) " + id_menu);

  let opciones = { method: "GET" };
  let parametros = "controlador=Menus&metodo=eliminarMenu";
  if (id_menu != null) {
    parametros += "&id_menu=" + id_menu;
    console.log("parametros: " + parametros);
  }

  fetch("C_Ajax.php?" + parametros, opciones)
    .then((res) => {
      if (res.ok) {
        console.log("Respuesta ok");
        return res.text();
      }
    })
    .then((vista) => {
      buscarMenus();
      console.log(vista);
      console.log("deberia ir bien");
    })
    .catch((err) => {
      console.log("Error al realizar la peticion.", err.message);
    });

  

}
  function guardarIdMenu(id_menu) { 
    id_menuGuardada = null;
    buscarMenus(id_menu);
    id_menuGuardada = id_menu;

    console.log("Estoy guardando el id (guardarMenuId) " + id_menuGuardada);
  
  }

  function guardarIdMenuPadre(id_padre) {
    buscarMenus(null, id_padre);
    id_padreGuardada = id_padre;
    console.log("Estoy guardando el id (guardarIdPadre) " + id_padreGuardada);
  
  }

  function mostrarCamposCreateMenu() {
    id_menuGuardada = null;
    var camposCreate = document.getElementById("camposCrearMenu");
    document.getElementById("campoIdPadre").style.display = "block";
    if (id_padreGuardada !== 0) {
        // Deshabilitar el campo y asignar el valor
        document.getElementById("id_menu_padre").disabled = true;
        document.querySelector("#id_menu_padre").value = id_padreGuardada;
    } else {
        document.getElementById("id_menu_padre").disabled = true;
        document.querySelector("#id_menu_padre").value = 0;
    }

    
    if (camposCreate.style.display === "none") {
            camposCreate.style.display = "block";
    } else {
        camposCreate.style.display = "none";
    }
}
function mostrarcrearPadre() {
  var camposCreate = document.getElementById("camposCrearMenu");
  // if (id_padreGuardada !== 0) {
  //   // Deshabilitar el campo y asignar el valor
  //   document.getElementById("id_menu_padre").disabled = true;
  //   document.querySelector("#id_menu_padre").value = id_padreGuardada;
  // } else {
  //   document.getElementById("id_menu_padre").disabled = true;
  //   document.querySelector("#id_menu_padre").value = 0;
  // }

  // Ocultar el campo id_menu_padre y su etiqueta
  if(id_menuGuardada!==null){
  document.getElementById("campoIdPadre").style.display = "none";
  }else{
    document.getElementById("campoIdPadre").style.display = "block";
  }

  if (camposCreate.style.display === "none") {
    camposCreate.style.display = "block";
  } else {
    camposCreate.style.display = "none";
  }
}



  function isertMenu(){
    let opciones = { method: "POST" };
    
    let parametros = "controlador=Menus&metodo=crearMenu";
    // Obtener el valor del título del menú
    let tituloMenu = document.getElementById("titulo").value;

    // Verificar si el campo del título está vacío
    if (tituloMenu.trim() === "") {
        // Mostrar mensaje de error
        document.getElementById("errorNombreMenu").innerHTML = "El título del menú es obligatorio.";
        return; // Detener la ejecución de la función si hay un error
    }

    // Limpiar mensaje de error si el título es válido
    document.getElementById("errorNombreMenu").innerHTML = "";

    if (id_menuGuardada != null) {
      parametros += "&id_menu=" + id_menuGuardada;
      console.log("parametros: " + parametros);
    }
    let id_menu_padre = document.getElementById("id_menu_padre").value;

    parametros += "&id_menu_padre=" + id_menu_padre;

    parametros += "&" + new URLSearchParams(new FormData(document.getElementById("formularioCrearMenuF"))).toString();

    console.log(parametros);

    fetch("C_Ajax.php?" + parametros, opciones)
    .then(res => {
        if (res.ok) {
            console.log('Menu agregado correctamente');
            return res.text();
        }
    })
    .then(responseText => {
         var camposCreate = document.getElementById("camposCrearMenu");
         camposCreate.style.display = "none";
         
        buscarMenus();
    })
    .catch(err => {
        console.log("Error al realizar la petición.", err.message);
    });
  }




function mostrarCamposUpdateMenu() {
  var camposCreate = document.getElementById("camposCrearMenu");
  var camposUpdate = document.getElementById("camposUpdatearMenu");
  if (camposUpdate.style.display === "none") {
    if (camposCreate.style.display === "block") {
      camposCreate.style.display = "none";
      camposUpdate.style.display = "block";
    } else {
      camposUpdate.style.display = "block";
    }
  } else {
    camposUpdate.style.display = "none";
  }

}

function visualizarMenu(){
  alert("No tienes permisos para visualizar el mantenimiento de menus.")
}
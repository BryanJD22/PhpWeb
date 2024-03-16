//funcion para printar en una vista los menus de usuario
id_menuGuardada = 0;
id_padreGuardada = 0;
function buscarMenus( id_menu  // id_padre
) {
  let opciones = { method: "GET" };
  let parametros = "controlador=Menus&metodo=busquedaMenus";
  parametros +=
    "&" +
    new URLSearchParams(
      new FormData(document.getElementById("formBusquedaMenus"))
    ).toString();
  if (id_menu != null) {
    parametros += "&id_menu=" + id_menu;
    console.log("parametros: " + parametros);
  }
  // if (id_padre != null) {
  //     metodos += "&id_padre=" + id_padre;
  //     console.log("parametros: " + metodos)
  // }
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

  function guardarIdMenuPadre(id_padre) {
    buscarMenus(null, id_padre);
    id_padreGuardada = id_padre;
    console.log("Estoy guardando el id (guardarIdPadre) " + id_padreGuardada);
  
  }

  function mostrarCamposCreateMenu() {
    var camposCreate = document.getElementById("camposCrearMenu");
    var camposUpdate = document.getElementById("camposUpdatearMenu");
    if (id_padreGuardada !== 0) {
        // Deshabilitar el campo y asignar el valor
        document.getElementById("id_menu_padre").disabled = true;
        document.querySelector("#id_menu_padre").value = id_padreGuardada;
    } else {
        document.getElementById("id_menu_padre").disabled = true;
        document.querySelector("#id_menu_padre").value = 0;
    }

    
    if (camposCreate.style.display === "none") {
        if (camposUpdate.style.display === "block") {
            camposUpdate.style.display = "none";
            camposCreate.style.display = "block";
        } else {
            camposCreate.style.display = "block";
        }
    } else {
        camposCreate.style.display = "none";
    }
}


  function isertMenu(){
    let opciones = { method: "POST" };
    
    let parametros = "controlador=Menus&metodo=crearMenu";

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
        // Recargar la vista después de agregar el menú
        buscarMenus();
    })
    .catch(err => {
        console.log("Error al realizar la petición.", err.message);
    });
  }










  function validarMenu() {
    console.log("el idMenuGuardada es= " + id_menuGuardada);
    console.log("el idPadreGuardada es= " + id_padreGuardada);
    console.log("el orden Guardado es= " + orden_guardada);
    //ME HACES INSERT / CREATE
    if (id_menuGuardada === 0) {
      if (id_padreGuardada != 0) {
        // Obtener los valores de los campos variables menus
        // Deshabilitar el campo y asignar el valor
        document.getElementById("id_padre").disabled = true;
        document.querySelector("#id_padre").value = id_padreGuardada;
  
        const NOMBREMENU = document.querySelector("#nombre_menu").value.trim();
        // Deshabilitar el campo y asignar el valor
        document.getElementById("orden").disabled = true;
        document.querySelector("#orden").value = orden_guardada;
  
        // Validación de campos
        let errores = [];
  
        // Validación de nombre del menú
        if (!NOMBREMENU) {
          errores.push("El campo 'Nombre del Menú' es obligatorio.");
        }
        // Mostrar mensajes de error sobre los campos
        document.getElementById("nombreMenuError").innerHTML = errores.includes(
          "El campo 'Nombre del Menú' es obligatorio."
        )
          ? "Campo obligatorio"
          : "";
  
        // Cambiar el color del campo de error
        document
          .getElementById("nombreMenuError")
          .classList.toggle(
            "error-field",
            errores.includes("El campo 'Nombre del Menú' es obligatorio.")
          );
        // Si hay errores, no continuas
        if (errores.length > 0) {
          return false;
        }
        let opciones = { method: "GET" };
        let parametros = "controlador=Menu&metodo=insertarMenu";
        parametros += "&" + new URLSearchParams(new FormData(document.getElementById("formularioCrearMenu"))).toString();
        parametros += "&id_padre=" + id_padreGuardada;
        parametros += "&orden=" + orden_guardada;
        console.log("parametros= " + parametros)
        fetch("C_Ajax.php?" + parametros, opciones)
          .then((res) => {
            if (res.ok) {
              console.log("Respuesta ok");
              return res.text();
            }
          })
          .then((vista) => {
            buscarMenus();
            id_padreGuardada = 0;
            orden_guardada = 0;
            limpiarCamposCreateMenu();
            mostrarCamposCreateMenu();
          })
          .catch((err) => {
            console.log("Error al realizar la peticion.", err.message);
          });
      } else {
        // Deshabilitar el campo y asignar el valor
        document.getElementById("id_padre").disabled = true;
        document.querySelector("#id_padre").value = 0;
  
        const NOMBREMENU = document.querySelector("#nombre_menu").value.trim();
        // Deshabilitar el campo y asignar el valor
        document.getElementById("orden").disabled = true;
        document.querySelector("#orden").value = orden_guardada;
  
        // Validación de campos
        let errores = [];
  
        // Validación de nombre del menú
        if (!NOMBREMENU) {
          errores.push("El campo 'Nombre del Menú' es obligatorio.");
        }
        // Mostrar mensajes de error sobre los campos
        document.getElementById("nombreMenuError").innerHTML = errores.includes(
          "El campo 'Nombre del Menú' es obligatorio."
        )
          ? "Campo obligatorio"
          : "";
  
        // Cambiar el color del campo de error
        document
          .getElementById("nombreMenuError")
          .classList.toggle(
            "error-field",
            errores.includes("El campo 'Nombre del Menú' es obligatorio.")
          );
        // Si hay errores, no continuas
        if (errores.length > 0) {
          return false;
        }
        let opciones = { method: "GET" };
        let parametros = "controlador=Menu&metodo=insertarMenu";
        parametros += "&" + new URLSearchParams(new FormData(document.getElementById("formularioCrearMenu"))).toString();
        parametros += "&id_padre=" + id_padreGuardada;
        parametros += "&orden=" + orden_guardada;
        fetch("C_Ajax.php?" + parametros, opciones)
          .then((res) => {
            if (res.ok) {
              console.log("Respuesta ok");
              return res.text();
            }
          })
          .then((vista) => {
            buscarMenus();
            limpiarCamposCreateMenu();
            mostrarCamposCreateMenu();
          })
          .catch((err) => {
            console.log("Error al realizar la peticion.", err.message);
          });
      }
      //ME HACES UPDATE
    } else {
      let opciones = { method: "GET" };
  let parametros = "controlador=Menu&metodo=updatearMenu";
  parametros += "&id_menu=" + id_menuGuardada;
  parametros += "&" + new URLSearchParams(new FormData(document.getElementById("formularioUpdatearMenu"))).toString();
  console.log("parametros en update= " + parametros);
  fetch("C_Ajax.php?" + parametros, opciones)
    .then(res => {
      if (res.ok) {
        console.log('Respuesta Ok');
        return res.text();
      }
    })
    .then(vista => {
      buscarMenus();
      id_menuGuardada = 0;
      limpiarCamposUpdateMenu();
      mostrarCamposUpdateMenu();
    })
    .catch(err => {
      console.log("Error al realizar la petición", err.message);
    });
  
  
  
    }
  }
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
      buscarMenus();
      console.log(vista);
      console.log("deberia ir bien");
    })
    .catch((err) => {
      console.log("Error al realizar la peticion.", err.message);
    });

  // console.log("Estoy guardando el id (funcion) " + id_padre);

}

  function guardarIdMenuPadre(id_padre) {
    buscarMenus(null, id_padre);
    id_padreGuardada = id_padre;
    console.log("Estoy guardando el id (guardarIdPadre) " + id_padreGuardada);
  
  }

function buscarUsuarios(pagina, paginasTotales) {
    let opciones = { method: "GET" };
    let parametros = "controlador=Usuarios&metodo=buscarUsuarios";
    parametros += "&" + new URLSearchParams(new FormData(document.getElementById("formularioBuscar"))).toString();

    // EXTRA PARA HACER UN PAGINADOR
    var numPagina = document.querySelector('#num-pagina');

    if (numPagina != null) {
        
        if (isNaN(numPagina.value) || numPagina.value == null) {
            numPagina.value = 1;
        }

        if (pagina === undefined) {
            console.log("pagina: undefined");
            if (numPagina.value > paginasTotales || numPagina.value < 1) {
                numPagina.value = paginasTotales;
            } else {
                let num = numPagina.value - 1;
                parametros += "&" + "pagina=" + num;
            }
        } else if (pagina === "siguiente") {
            console.log("pagina: " + pagina);

            let num = numPagina.value;
            if (num > paginasTotales - 1) {
                num = paginasTotales - 1;
            }

            parametros += "&" + "pagina=" + num;
        } else if (pagina === "anterior") {
            console.log("pagina: " + pagina);

            let num = numPagina.value - 2;
            if (num < 1) {
                num = 0;
            }

            parametros += "&" + "pagina=" + num;
        } else {
            console.log("pagina: " + pagina);

            pagina = pagina - 1;
            parametros += "&" + "pagina=" + pagina;
        }
    }

    fetch("C_Ajax.php?" + parametros, opciones)
        .then(res => {
            if (res.ok) {
                console.log('Respuesta ok');
                return res.text();
            }
        })
        .then(vista => {
            document.getElementById("capaResultadosBusqueda").innerHTML = vista;
        })
        .catch(err => {
            console.log("Error al realizar la peticion.", err.message);
        });
}



function agregarUsuario() {
    let opciones = { method: "POST" };
    
    let parametros = "controlador=Usuarios&metodo=crearUsuario";
    
    parametros += "&" + new URLSearchParams(new FormData(document.getElementById("formulario_crear"))).toString();

    console.log(parametros);

    fetch("C_Ajax.php?" + parametros, opciones)
        .then(res => {
            if (res.ok) {

                console.log('Usuario agregado correctamente');
                return res.text();
                
            }
        })
        .catch(err => {
            console.log("Error al realizar la petición.", err.message);
        });

}

function guardarCambios(id){
    let opciones = { method: "GET" };
    let parametros = "controlador=Usuarios&metodo=editarUsuarios";
    parametros += "&id_Usuario=" + id + "&" + new URLSearchParams(new FormData(document.getElementById("formularioEdicionUsuario"))).toString();

    console.log(parametros)

    fetch("C_Ajax.php?" + parametros, opciones)
        .then(res => {
            if (res.ok) {
                console.log('respuesta ok');
                return res.text();
            }
        })
        .then(vista => {
            document.getElementById("capaResultadosUpdatear").innerHTML = vista;
        })
        .catch(err => {
            //Error al realizar la petición Cannot set properties of null (setting 'innerHTML')
            console.log("Error al realizar la petición", err.message);
        });
}

function getParams(id){
    console.log(id);
    let opciones = { method: "GET" };
    let parametros = "controlador=Usuarios&metodo=buscarUsuarioPorID";
    parametros += "&id_Usuario="+id;

    fetch("C_Ajax.php?" + parametros, opciones)
        .then(res => {
            if (res.ok) {
                console.log('respuesta ok');
                return res.text();
            }
        })
        .then(vista => {
            document.getElementById("capaResultadosBusqueda").innerHTML = vista;
        })
        .catch(err => {
            console.log("Error al realizar la petición", err.message);
        });
}

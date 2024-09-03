/*==========
variables globales
===========*/
var host = "http://localhost:5000/"



function verificarComunicacion() {

  var obj = ""

  $.ajax({
    type: "POST",
    url: host + "api/CompraVenta/comunicacion",
    data: obj,
    cache: false,
    contentType: "aplication/json",
    processsData: false,
    success: function (data) {

      if (data["transaccion"] == true) {
        document.getElementById("comunSiat").innerHTML = "Conectado"
        document.getElementById("comunSiat").className = "badge badge-success"
      }
    }
  }).fail(function (jqXHR, twxtStatus, errorThrown) {
    if (jqXHR.status == 0) {
      document.getElementById("comunSiat").innerHTML = "Desconectado"
      document.getElementById("comunSiat").className = "badge badge-success"
    }
  })
}
setInterval(verificarComunicacion, 300)

function BusCliente() {
  let nitCliente = document.getElementById("nitCliente").value

  var obj = {
    nitCliente: nitCliente
  }

  $.ajax({
    type: "POST",
    url: "controlador/clienteControlador.php/ctrBusCliente",
    data: obj,
    dataType: "json",
    success: function (data) {
      if (data["email_cliente"] == "") {
        document.getElementById("email_Cliente").value = "null"
      } else {
        document.getElementById("email_Cliente").value = data["email_cliente"]

      }

      document.getElementById("rsCliente").value = data["razon_social"]
      numFactura()
    }
  })
}

/*============
generar numero de factura
=============*/
function numFactura() {
  let obj = ""

  $, ajax({
    type: "POST",
    url: "controlador/FacturaControlador.php?ctrNumFactura",
    data: obj,
    success: function (data) {
      document.getElementById("numFactura").value = data
    }
  })

}

function busProducto() {
  let codProducto = document.getElementById("codProducto").value

  var obj = {
    codProducto: codProducto
  }

  $.ajax({
    type: "POST",
    url: "controlador/productoControlador.php/ctrBusProducto",
    data: obj,
    dataType: "json",
    success: function (data) {


      document.getElementById("conceptoPro").value = data["nombre_producto"];
      document.getElementById("uniMedida").value = data["unidad_medida"];
      document.getElementById("preUnitario").value = data["precio_producto"];

      document.getElementById("uniMedidaSin").value = data["unidad_medida_sin"];
      document.getElementById("codProductoSin").value = data["cod_producto_sin"];


    }
  })
}

function calcularPreProd() {
  let cantPro = parseInt(document.getElementById("cantProducto").value)
  let descProducto = parsefIoat(document.getElementById("descProducto").value)
  let preUnit = parsefIoat(document.getElementById("preUnitario").value)

  let preProducto = preUnit - descProducto


  document.getElementById("preTotal").value = preProducto * cantPro
}

/** ============ 
 * carrito==========**/
var arregloCarrito = []
var listaDetalle = document.getElementById("listaDetalle")
function agregarCarrito() {

  let actEconomica = document.getElementById("actEconomica").value
  let codProducto = document.getElementById("codProducto").value
  let codProductoSin = parseInt(document.getElementById("codProductoSin").value)
  let conceptoPro = document.getElementById("conceptoPro").value
  let cantProducto = parseInt(document.getElementById("cantProducto").value)
  let uniMedida = document.getElementById("uniMedida").value
  let uniMedidaSin = parseInt(document.getElementById("uniMedidaSin").value)
  let preUnitario = parseFloat(document.getElementById("preUnitario").value)
  let descProducto = parseFloat(document.getElementById("descProducto").value)
  let preTotal = parseFloat(document.getElementById("preTotal").value)

  let objDetalle = {
    actividadEconomica: actEconomica,
    codigoProductoSin: codProductoSin,
    codigoProduvto: codProducto,
    descripcion: conceptoPro,
    cantidad: cantProducto,
    unidadMedida: uniMedidaSin,
    precioUnitario: preUnitario,
    montoDescuento: descProducto,
    subtotal: preTotal
  }

  arregloCarrito.push(objDetalle)
  dibujarTablaCarrito()

  /* borrar el formulario de carrito */

  document.getElementById("codProducto").value = ""
  document.getElementById("conceptoPro").value = ""
  document.getElementById("cantProducto").value = 0
  document.getElementById("uniMedida").value = ""
  document.getElementById("preUnitario").value = ""
  document.getElementById("descProducto").value = "0.00"
  document.getElementById("preTotal").value = "0.00"


}

function dibujarTablaCarrito() {

  listaDetalle.innerHTML = ""
  arregloCarrito.forEach((detalle) => {
    let fila = document.createElement("tr")
    fila.innerHTML = '<td>' + detalle.descripcion + '</td>' +
      '<td>' + detalle.cantidad + '</td>' +
      '<td>' + detalle.precioUnitario + '</td>' +
      '<td>' + detalle.montoDescuento + '</td>' +
      '<td>' + detalle.subtotal + '</td>'

    let tdEliminar = document.createElement("td")
    let botonEliminar = document.createElement("button")
    botonEliminar.classList.add("btn", "btn-danger")
    botonEliminar.innerText = ("Eliminar")
    botonEliminar.onclick = () => {
      eliminarCarrito(detalle.codigoProducto)
    }

    tdEliminar.appendChild(botonEliminar)
    fila.appendChild(tdEliminar)

    listaDetalle.appendChild(fila)
  })
  calcularTotal()
}
// a, b, c, d  --->c
function eliminarCarrito(cod) {
  arregloCarrito = arregloCarrito.filter((detalle) => {
    if (cod != detalle.codigoProducto) {
      return detalle
    }
  })
  dibujarTablaCarrito()
}

function calcularTotal(){
  let totalCarrito=0
  for(var i=0; i<arregloCarrito.length; i++){
    totalCarrito=totalCarrito+parseFloat(arregloCarrito[i].subtotal)
  }
  document.getElementById("subTotal").value=totalCarrito
 let descAdicional=parseFloat(document.getElementById("descAdicional").value)
 document.getElementById("totApagar").value=totalCarrito-descAdicional

}

/*==========
eemitir factura
================ */
function emitirFactura(){
  let date=new Date()

  let numFactura=parseInt(document.getElementById("numFactura").value)
  let fechaFFactura=date.toISOString()
  let rsCliente=document.getElementById("rsCliente").value
  let tpDocumento=parseInt(document.getElementById("tpDocumento").value)
  let nitCliente=document.getElementById("nitCliente").value
  let metPago=parseInt(document.getElementById("metPago").value)
  let totApagar=parseFloat(document.getElementById("totApagar").value)
  let descAdicional=parseFloat(document.getElementById("descAdicional").value)
  let subTotal=parseFloat(document.getElementById("subTotal").value)

}
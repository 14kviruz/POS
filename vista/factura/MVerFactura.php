<?php
require_once "../../controlador/facturaControlador.php";
require_once "../../modelo/facturaModelo.php";

$id = $_GET["id"];

$factura = ControladorFactura::ctrInfoFactura($id);
$producto = json_decode($factura["detalle"], true);

?>
<div class="modal-header bg-info">
  <h4 class="modal-title">Informacion de Factura</h4>
  <button type="button" class="close" data-dismiss="modal" aria-label="clase">

  </button>
</div>
<div class="modal-body">
  <div class="row">
    <div class="col-sm-6">
      <table class="tabla">
        <tr>
          <th># Factura</th>
          <td><?php echo $factura["cod_factura"]; ?></td>
        </tr>
        <tr>
          <th>Cliente</th>
          <td><?php echo $factura["razon_socila_cliente"] ?></td>
        </tr>
        <tr>
          <th>NIT/CI</th>
          <td><?php echo $factura["nit_ci_cliente"]; ?></td>
        </tr>
        <tr>
          <th>Fecha</th>
          <td><?php echo $factura["fecha_emision"]; ?></td>
        </tr>
        <tr>
          <th>Estado</th>
          <td><?php
              if ($factura["estado_factura"] == 1) {
              ?>
              <span class="badge badge-success">Emitido</span>
            <?php

              } else {
            ?>

              <span class="badge badge-success">Anular</span>
            <?php
              } ?>
          </td>
        </tr>
        <tr>
          <th>Emitir por</th>
          <td><?php echo $factura["usuario"]; ?></td>
        </tr>

      </table>
    </div>
    <div class="table">
      <table class="table">
        <thead>
          <th>Producto</th>
          <th>Cantidad</th>
          <th>Precio(Bs.)</th>
          <th>Cantidad</th>
          <th>Total(Bs.)</th>
        </thead>
        <tbody>
          <?php
          foreach ($producto as $value) {
          ?>
            <tr>
              <td><?php echo $value["descripcio"]; ?></td>
              <td><?php echo $value["cantidad"]; ?></td>
              <td><?php echo $value["precioUnitario"]; ?></td>
              <td><?php echo $value["montoDescuento"]; ?></td>
              <td><?php echo $value["sudtotal"]; ?></td>
            </tr>
          <?php
          }

          ?>
          <tr>
            <td colspan="4"><b>Total</b></td>
            <td><?php echo $factura["neto"]; ?></td>
          </tr>
          <tr>
            <td colspan="4"><b>Descuento</b></td>
            <td><?php echo $factura["Descuento"]; ?></td>
          </tr>
          <tr>
            <td colspan="4"><b>Total</b></td>
            <td><?php echo $factura["total"]; ?></td>
          </tr>

        </tbody>
      </table>
    </div>
  </div>
</div>
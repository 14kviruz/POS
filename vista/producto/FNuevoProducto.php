<form action="" id="FRegProducto" enctype="multipart/form-data">
  <div class="modal-header">
    <h4 class="modal-title">Registro Nuevo Producto</h4>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
  <div class="modal-body" mg-info>
    <table class="table">
      <div class="form-group">
        <label for="exampleInputBorder">Cod. Producto</label>
        <input type="text" class="form-control" placeholder="" name="codProducto" id="codProducto">
      </div>
      <div class="form-group">
        <label for="exampleInputBorder">Cod. Producto SIN</label>
        <input type="text" class="form-control" placeholder="" name="codProductoSIN" id="codProductoSIN">
      </div>

      <div class="form-group">
        <label for="exampleInputBorder">Descripcion</label>
        <input type="text" class="form-control" placeholder="" name="desProducto" id="desProducto">
      </div>
      <div class="form-group">
        <label for="exampleInputBorder">Precio</label>
        <input type="text" class="form-control" placeholder="" name="preProducto" id="preProducto">
      </div>
      <div class="form-group">
        <label for="exampleInputBorder">Unidad de medida</label>
        <input type="text" class="form-control" placeholder="" name="unidadMedidad" id="unidadMedidad">
      </div>
  </div>
  <div class="form-group">
    <label for="exampleInputBorder">Unidad de medida SIN</label>
    <input type="text" class="form-control" placeholder="" name="unidadMedidaSIN" id="unidadMedidaSIN">
  </div>
  <div class="row">
    <div class="col-sm-6">
      <div class="form-group">
        <label for="imgProducto">Imagen <span class="text-muted">(Peso máximo 100MB - JPG, PNG)</span></label>
        <div class="input-group">
          <div class="custom-file">
            <input type="file" class="custom-file-input" id="imgProducto" name="imgProducto" onchange="previsualizar()">
            <label class="custom-file-label" for="imgProducto">Elegir archivo</label>
          </div>
          <div class="input-group-append">
            <span class="input-group-text">Subir</span>
          </div>
        </div>
      </div>
    </div>
    <div class="col-sm-6">
      <div class="form-group" style="text-align:center">
        <img src="assest/dist/img/product_default.png" alt="" width="150" class="img-thumbnail previsualizar">
      </div>
    </div>
  </div>
  </div>
  </table>
  </div>
  <div class="modal-footer justify-content-between">
    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
    <button type="submit" class="btn btn-primary">Guardar</button>
  </div>

  <!-- /.card-footer -->
</form>

<script>
  $(function() {
    $.validator.setDefaults({
      submitHandler: function() {
        regProducto()
      }
    });
    $('#FRegProducto').validate({
      rules: {
        codProducto: {
          required: true,
          minlength: 3,
        },
        codProductoSIN: {
          required: true,
          minlength: 3,
        },
        desProducto: {
          required: true,
          minlength: 3,
        },
        preProducto: {
          required: true,
          minlength: 1,
        },
        unidadMedidad: {
          required: true,
          minlength: 1,
        },
        unidadMedidadSIN: {
          required: true,
          minlength: 1,
        },
        imgProducto: {
          required: true,
          minlength: 1,
        }
      },
      errorElement: 'span',
      errorPlacement: function(error, element) {
        error.addClass('invalid-feedback');
        element.closest('.form-group').append(error);
      },
      highlight: function(element, errorClass, validClass) {
        $(element).addClass('is-invalid');
      },
      unhighlight: function(element, errorClass, validClass) {
        $(element).removeClass('is-invalid');
      }
    });
  });
</script>
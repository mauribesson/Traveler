
<!--==============================================================================================-->
<!-- Bootstrap formulario -->

<div class="container">
  <div class="row">
    <div class="col-md-6">      
      <h2>Ingrese las fechas para la búsqueda de reservas</h2>
    </div>
  </div>
  <div class="row">
    <div class="col-md-6" >
      <form action="<?php echo base_url('/index.php/reserva/listadoPorFecha'); ?>" method="post" accept-charset="utf-8">

      <div class="form-group">
      <label for="fecha1">Primer fecha: </label>
        <div class="input-group date" id="datetimepicker1" data-target-input="nearest">         
            <input type="text"  name="fecha1" class="form-control datetimepicker-input" data-target="#datetimepicker1" />
            <div class="input-group-append" data-target="#datetimepicker1" data-toggle="datetimepicker">
              <div class="input-group-text"><i class="fa fa-calendar"></i></div>
            </div>
          </div>
        </div>

        <div class="form-group">
          <label for="fecha2">Segunda fecha: </label> 
          <div class="input-group date" id="datetimepicker2" data-target-input="nearest">                    
            <input type="text" name="fecha2" class="form-control datetimepicker-input" data-target="#datetimepicker2" />
            <div class="input-group-append" data-target="#datetimepicker2" data-toggle="datetimepicker">
              <div class="input-group-text"><i class="fa fa-calendar"></i></div>
            </div>
          </div>
        </div>

        <button type="submit" class="btn btn-primary">Buscar</button>
        <a href="index"class="btn btn-danger">Cancelar</a>
      </form>
      
    </div>
  </div>
</div>
<!-- /Bootstrap formulario-->

<script type="text/javascript">

$( document ).ready(function() {
    $('#datetimepicker1').datetimepicker({
                    locale: 'es',
                    format: 'DD/MM/YYYY'                                     
                });
    $('#datetimepicker2').datetimepicker({
                    locale: 'es',
                    format: 'DD/MM/YYYY'                    
                });
});


</script>

</body>




</html>




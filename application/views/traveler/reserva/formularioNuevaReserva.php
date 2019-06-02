<!-- Bootstrap formulario -->
<!--
<?php 
    if (isset($validacion))
      { 
        var_dump($validacion);
      }
?>
-->
<?php  if (isset($validacion) ){ echo $validacion['precioPorNoche']->valor ; } ?>

<div class="container p-4">
<div class="jumbotron">
  <?php  if (isset($validacion)){ ?>
  <div class="row">
    <div class="col-md-6">
    <div class="alert alert-danger" role="alert">
          Completar los campos faltantes marcados con: "*" .
      </div>
    </div>
  </div>
  <?php } ?>

  <div class="row">
    <div class="col-md-6">      
      <h2>Reserva 
        <h1 style="color:red"><b>[Sin terminar: fECHA POR DEFECTO Y CAMPO NUEVO SI FALTA, FECHA HASMA TENGA QUE SER MENOR]</b></h1>
      </h2>
    </div>
  </div>
  <div class="row">
    <div class="col-md-6" >
      <form action="<?php echo base_url('/index.php/Reserva/guardarNuevaReserva'); ?>" method="post" accept-charset="utf-8">
            <div class="form-group">
            <label for="fecha1">Fecha de Reserva : </label> 
            <?php 
              if (isset($validacion) && !$validacion['fechaInicio']->estado)
                 echo '<small class="text-danger"><b>*</b></small>' ;
            ?>
              <div class="input-group date" id="datetimepicker1" data-target-input="nearest">         
                  <input type="text"  name="fechaInicio" class="form-control datetimepicker-input" data-target="#datetimepicker1" />
                  <div class="input-group-append" data-target="#datetimepicker1" data-toggle="datetimepicker">
                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                  </div>
                </div>
              </div>

              <div class="form-group">
                <label for="fecha2">Hasta la Fecha: (por defecto un día)</label> 
                <?php
                    if (isset($validacion) && !$validacion['fechaFin']->estado) 
                        echo '<small class="text-danger"><b>*</b></small>' ; 
                ?>
                <div class="input-group date" id="datetimepicker2" data-target-input="nearest">                    
                  <input type="text" name="fechaFin" class="form-control datetimepicker-input" data-target="#datetimepicker2" />
                  <div class="input-group-append" data-target="#datetimepicker2" data-toggle="datetimepicker">
                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                  </div>
                </div>
              </div>

          <div class="form-group">
            <label for="cantPersonas">Cantidad de personas:</label>
            <?php
                if (isset($validacion) && !$validacion['cantPersonas']->estado)
                    echo '<small class="text-danger"><b>*</b></small>' ;
            ?>
            <input id="cantPersonas" type="number" class="form-control" name="cantPersonas" value=1>					
          </div>

          <div class="form-group">
            <label for="precioPorNoche">Precio por noche ($):</label>
            <?php
                if (isset($validacion) && !$validacion['precioPorNoche']->estado)
                    echo '<small class="text-danger"><b>*</b></small>' ;
            ?>      
            <input id="precioPorNoche" type="number" class="form-control" name="precioPorNoche" placeholder="" >					
          </div>

          <div class="form-group">
              <label for="nombre">Usuario</label>
              <?php
                if (isset($validacion) && !$validacion['nombreT']->estado)
                    echo '<small class="text-danger"><b>*</b></small>' ;
            ?>        
            <select name="nombre" class="form-control" id="nombre">
              <?php 
              foreach ($usarios as $e) { 
                if (isset($validacion) && $validacion['nombreT']->estado && $e->nombreT == $validacion['nombreT']->valor) 
                    echo("<option selected> $e->nombreT</option>"); 
                else echo("<option> $e->nombreT</option>"); 
              } 				
              ?>
            </select>
            </div>

          <div class="form-group">
              <label for="numero">Habitacion:</label>
              <?php
                if (isset($validacion) && !$validacion['numHab']->estado)
                    echo '<small class="text-danger"><b>*</b></small>' ;
            ?>        
            <select name="numero" class="form-control" id="numero">
              <?php 
              foreach ($habitacion as $e) { 
                if (isset($validacion) && $validacion['numHab']->estado && $e->nombreT == $validacion['numHab']->valor) 
                  echo("<option selected> $e->numHab</option>"); 
                else echo("<option> $e->numHab</option>"); 
              } 				
              ?>
            </select>
            </div>
            <div class="form-group">
            <label for="documento">Docuemento del pasajero:</label>
            <?php
                if (isset($validacion) && !$validacion['documento']->estado)
                    echo '<small class="text-danger"><b>*</b></small>' ; ?>      
            <input id="documento" type="documento" class="form-control" name="documento" placeholder="">
            <small class="text-danger">(Sin puntos ".")</small>
          </div>
          <button type="submit" class="btn btn-primary">Aceptar</button>
          <a href="<?php echo base_url('/index.php/Traveler/index'); ?>"class="btn btn-danger">Cancelar</a>
      </form>      
    </div>
  </div>
  </div>
  </div>
<!-- /Bootstrap formulario-->

<script type="text/javascript">

    $( document ).ready(function() {
        $('#datetimepicker1').datetimepicker({
            locale: 'es',
            format: 'DD/MM/YYYY',
            //defaultDate: moment(),
            icons: {
                    time: "fa fa-clock-o",
                    date: "fa fa-calendar",
                    up: "fa fa-arrow-up",
                    down: "fa fa-arrow-down"
                }                  
        });
        $('#datetimepicker2').datetimepicker({
            locale: 'es',
            format: 'DD/MM/YYYY',
            //defaultDate: moment().add(1, 'days'),
            icons: {
                    time: "fa fa-clock-o",
                    date: "fa fa-calendar",
                    up: "fa fa-arrow-up",
                    down: "fa fa-arrow-down"
                }                   
        });

        //Setear fecha por defecto 
        //$('#datetimepicker1').datetimepicker('viewDate', moment('11/21/2018', 'MM/DD/YYYY'));

        //recarga los formularios post validacion. 
        $('#precioPorNoche').val(<?php  if (isset($validacion) ){ echo $validacion['precioPorNoche']->valor ; } ?>);
        $('#cantPersonas').val(<?php  if (isset($validacion) ){ echo $validacion['cantPersonas']->valor ; } ?>);
        $('#documento').val(<?php  if (isset($validacion) ){ echo $validacion['documento']->valor ; } ?>);
       
        

    });
</script>

</body>

</html>




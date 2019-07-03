/*class Traveler {

    constructor() {}
    
    Test() {
        alert("prueba de clase");
    }

    nuevaReservaValidacionFormulario() {
        $('#nuevaReservaSubmit').click(function(e) {

            alert('se freno el formulario...');
            e.preventDefault();
            // $.post();
        });


    }

}
*/
//Funcion de Validar Nueva Reserva
function nuevaReservaValidacionFormulario() {
    /*
    $('#nuevaReservaSubmit').click(function(e) {
        alert('Agregar Validacion por js');
        //e.preventDefault();

        // $.post();
    });*/

    $("#formNuevaReserva").submit(function(event) {
        //alert("Handler for .submit() called.");
        /*
            -> Validar campoe fecha desde 
            -> validar fecha hasta 
            -> transformar validacion de PHP en validacion js
            ->mostar validacion 
        */

        let fechaDesde = $('[name="fechaInicio"]').val();
        let fechaHasta = $('[name="fechaFin"]').val();
        let cantPersonas = $('#cantPersonas').val();
        let precioPorNoche = $('#precioPorNoche').val();
        let usuario = $('[name="nombre"]').val();
        let nroHabitacion = $('[name="numero"]').val();
        let docPasajero = $('#documento').val();


        if (fechaDesde == '' || fechaDesde == null || fechaDesde == undefined) {
            alert('Falta:  FECHA DESDE!  ')
        } else {
            console.log('fecha desde: ok');
        }

        if (fechaHasta == '' || fechaHasta == null || fechaHasta == undefined) {
            alert('Falta :  fecha Hasta !  ')
        } else {
            console.log('fecha Hasta: ok');
        }

        console.log(
            fechaDesde,
            fechaHasta,
            cantPersonas,
            precioPorNoche,
            usuario,
            nroHabitacion,
            docPasajero
        );

        event.preventDefault();
        alert('event.preventDefault();  --->  ACTIVO !!');

        //$("#formNuevaReserva").submit();

    });


}
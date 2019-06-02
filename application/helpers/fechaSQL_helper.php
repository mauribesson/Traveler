
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('fechaSQL_helper'))
{
    //Transforma la Fecha para poder insertar en SQL.
    function fechaSQL_helper($cadenaFecha)
    {

        $nuevafecha = explode("/", $cadenaFecha);
    
        if(is_array($nuevafecha) && count($nuevafecha)>2) {
        
            return $nuevafecha[2]."-".$nuevafecha[1]."-".$nuevafecha[0];
        
        } else {
        
             return $cadenaFecha;
        
        }  
    } 
}


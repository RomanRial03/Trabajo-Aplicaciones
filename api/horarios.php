<?php
include("conexion.php");
function ConsultarHorariosDisponibles($dias){
    $con= conectar();
    $hoy= new DateTime();
    $hoy= new DateTime($hoy->format("Y-m-d"));     
        
    $hasta = new DateTime($hoy->format("Y-m-d"));
    date_add($hasta, date_interval_create_from_date_string("$dias days"));
    
    $sDesde = $hoy->format("Y-m-d");
    $sHasta = $hasta->format("Y-m-d");

    $sql = "SELECT * FROM reservas WHERE fecha >= '$sDesde' and fecha <= '$sHasta' order by fecha ; ";

    $result = $con->query($sql);
    $resultado = [];
    while ($row = $result->fetch_assoc()) { 
        array_push($resultado, $row); 
    } 
    return json_encode($resultado);

}
function ExisteReserva($dias){
    $con= conectar();    
    $sql = "SELECT count(ocupado) existe from reservas where fecha = '$dias' and ocupado";     
    $result = $con->query($sql);       
    $row = $result->fetch_assoc();    
    if ( $row["existe"] > 0){
        return "si";
    }else
    {
        return "no";
    }  
}

function AgregarHorario($inicial, $minutos, $ultimo){
    $respuesta = [];
    
    $con= conectar();    
    $sql = "delete from reservas where fecha >= '$inicial' and fecha <= '$ultimo';";     
    $result = $con->query($sql);           
    $fecha = new DateTime($inicial);
    $hasta = new DateTime($ultimo);
    $cont = 0;
    while (True){        
        // ínsertar fecha
        $cont ++;
        $aux = $fecha->format("Y-m-d H:i");        
        $sql = "INSERT INTO reservas (fecha, ocupado, id_usuario) VALUES ('$aux', 0, null)";    
        $result = $con->query($sql);    
        
        if ($result != 1){        
            $respuesta["resultado"] = "error";            
            $respuesta["descripcion"] = "No se pudo agregar horario";        
            return json_encode($respuesta);        
        }
        
        // incrementamos fechas
        date_add($fecha, date_interval_create_from_date_string("$minutos minutes"));
        
        if ($fecha >= $hasta){     
            break;
        }
        if ($cont >= 1500){
            break;   
        }
    }
    $respuesta["resultado"] = "ok";            
    $respuesta["descripcion"] = "Horario agregado con éxito";

    return json_encode($respuesta);

}

function AgregarReserva($fechahora, $id_usuario){
    $con= conectar();  
    $respuesta = [];  
    $sql = "update reservas set ocupado = 1, id_usuario = $id_usuario WHERE fecha = '$fechahora'";
    $result = $con->query($sql);    
    if ($result == 1){
        $respuesta["resultado"] = "ok";            
        $respuesta["descripcion"] = "Reserva agregada con éxito";
    }else{
        $respuesta["resultado"] = "ok";            
        $respuesta["descripcion"] = "No se pudo agregar la reserva";
    } 
    return json_encode($respuesta);
}

function EliminarReserva($fechahora){
    $con= conectar();  
    $respuesta = [];  
    $sql = "update reservas set ocupado = 0, id_usuario = null WHERE fecha = '$fechahora'";
    $result = $con->query($sql);    
    if ($result == 1){
        $respuesta["resultado"] = "ok";            
        $respuesta["descripcion"] = "Reserva quitada con éxito";
    }else{
        $respuesta["resultado"] = "ok";            
        $respuesta["descripcion"] = "No se pudo quitar la reserva";
    } 
    return json_encode($respuesta);
}




$accion = $_POST["accion"];
switch($accion){
    case "ConsultarHorariosDisponibles":
        $dias= $_POST["dias"];
        print(ConsultarHorariosDisponibles($dias));
        break;
    case "AgregarHorario":
        $inicial= date_create("2022-11-08 08:00");
        $final= date_create("2022-11-08 18:00");
        
        print(AgregarHorario("2022-11-08 08:00", 45 , "2022-11-08 19:30"));
        break;
    case "ExisteReserva";
        //$dias= $_POST["dias"];
        //$hora_real= $_POST["hora_real"];
        $r = ExisteReserva("2022-11-08 11:00:00");
        print($r);        
        break;
    case "AgregarReserva":
        #$dias=$_POST["dias"];
        print(AgregarReserva("2022-11-08 11:00:00", 1));
        break;
    case "EliminarReserva";
        //$dias= $_POST["dias"];
        //$hora_real= $_POST["hora_real"];
        print(EliminarReserva("2022-11-08 11:00:00"));
        break;


}
?>
<?php 
include("conexion.php");
include("usuario.php");
include("horarios.php");


function OcuparHorario($fechayhora,$id_usuario,$dias){
    $con= conectar();
    if (!ExisteUsuario($id_usuario)){
        return "Error, no existe el usuario";
    }if (!ExisteDia($dias)){
        return "Error, no existe dia";
    }
    
    


}


//entidad referencial foren key
$accion = $_POST["accion"];
switch($accion){
    case "OcuparHorario":
        $fechayhora=$_POST["fechayhora"];
        $id_usuario=$_POST["id_usuario"];
        $dias= $_POST["dias"];
        print(OcuparHorario($fechayhora,$id_usuario,$dias));
        break;
    case "DesocuparHorario":
        //
        break;
}
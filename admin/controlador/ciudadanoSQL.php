<?php
$empleado = $_SESSION['user']['id_ciudadano'];

if($_GET){       // Primero verificamos si existe el ciudadano
    if($_GET['id']){
        $id = $_GET['id'];

        $empleado_nivel = $_SESSION['user']['nivel'];
        if($empleado_nivel < 3){
            $borrado = '';
        }else{
            $borrado = 'AND c.borrado != 1';
        }

        $sentencia_ciudadano = "SELECT c.*, d.* 
        FROM ciudadanos c
        LEFT JOIN puestos_defensa d ON d.id_ciudadano = c.id_ciudadano
        WHERE c.id_ciudadano = ? $borrado";
        $sql_query_ciudadano = $con->prepare($sentencia_ciudadano);
        $sql_query_ciudadano->execute(array($id));
        $ciudadano = $sql_query_ciudadano->fetch();


        $sql_query_ciudadano = $con->prepare("SELECT * FROM puestos_defensa WHERE id_ciudadano = ?");
        $sql_query_ciudadano->execute(array($empleado));
        $datos_defensa_ciudadano = $sql_query_ciudadano->fetch();


        if(!$ciudadano){
            echo "Este ciudadano no existe";
            die();
        }
        

        if($empleado_nivel == 5){
            $sql_query_ciudadano = $con->prepare("SELECT * FROM puestos_defensa WHERE id_ciudadano = $empleado ");
            $sql_query_ciudadano->execute(array($id));
            $datos_defensa_empleado = $sql_query_ciudadano->fetch();

            if(!$datos_defensa_empleado){
                echo 'No estas en un puesto, pide que se te asigne una posicion';
                die();
            }

            if($ciudadano['id_registrante'] != $empleado){       
                if(!$datos_defensa_ciudadano){
                    echo 'Este ciudadano no te corresponde';
                    die();
                }else{
                    if($ciudadano['zona'] != $datos_defensa_empleado['zona']){
                    echo 'Este ciudadano no te corresponde';
                    die();
                    }
                }
            }
        }

        if($empleado_nivel == 6){
            $sql_query_ciudadano = $con->prepare("SELECT * FROM puestos_defensa WHERE id_ciudadano = $empleado ");
            $sql_query_ciudadano->execute(array($id));
            $datos_defensa_empleado = $sql_query_ciudadano->fetch();

            if(!$datos_defensa_empleado){
                echo 'No estas en un puesto, pide que se te asigne una posicion';
                die();
            }

            if($ciudadano['id_registrante'] != $empleado){       
                echo 'Es diferente';         
                if(!$datos_defensa_ciudadano){
                    echo 'Este ciudadano no te corresponde';
                    die();
                }else{
                    if($ciudadano['rg'] != $datos_defensa_empleado['rg']){
                    echo 'Este ciudadano no te corresponde';
                    die();
                    }
                }
            }
        }

        include 'menu_proceso.php';
    }else{
        echo 'Este ciudadano no existe';
    }
}   

?>
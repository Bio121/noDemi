<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

include 'mySQLphpClass.php';


if (isset($_POST['action'])) {

    if ($_POST['action'] == 'getClases') {
        $thing = new mySQLphpClass();

        $result = $thing->get_Clases($_POST['cursoActual']);

        $rows = array();
        while ($r = $result->fetch_assoc()) {
            array_push($rows, $r);
        }
        echo json_encode($rows);
    }
    
    if ($_POST['action'] == 'creaClases') {
        $thing = new mySQLphpClass();

        $result = $thing->clases(null, 'Escribe un título a la clase', 'Describe en qué consiste esta clase', null, $_POST['cursoActual'], 'I');

        $rows = array();
        while ($r = $result->fetch_assoc()) {
            array_push($rows, $r);
        }
        echo json_encode($rows);
    }
    
    if ($_POST['action'] == 'modifyClases') {
        $thing = new mySQLphpClass();

        $result = $thing->clases($_POST['codigo'], $_POST['nombre'], $_POST['desc'], null, $_POST['cursoActual'], 'U');

        $rows = array();
        array_push($rows, 'Se hizo');
        echo json_encode($rows);
    }
    
    if ($_POST['action'] == 'quitaClases') {
        $thing = new mySQLphpClass();

        $result = $thing->clases($_POST['codigo'], null, null, null, $_POST['cursoActual'], 'D');

        $rows = array();
        array_push($rows, 'Se hizo');
        echo json_encode($rows);
    }
    
}
?>


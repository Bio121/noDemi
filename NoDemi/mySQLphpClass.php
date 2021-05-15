<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of mySQLphpClass
 *
 * @author ira3ck
 */
include 'configSQLphp.php';

class mySQLphpClass extends configSQLphp {

    public $connectionString;
    public $dataSet;
    private $sqlQuery;
    protected $databaseName;
    protected $hostName;
    protected $userName;
    protected $passCode;
    protected $puerto;
    protected $socket;

    function mySQLphpClass() {
        $this->connectionString = NULL;
        $this->sqlQuery = NULL;
        $this->dataSet = NULL;

        $dbPara = new configSQLphp();
        $this->databaseName = $dbPara->dbName;
        $this->hostName = $dbPara->serverName;
        $this->userName = $dbPara->userName;
        $this->passCode = $dbPara->passCode;
        $this->socket = $dbPara->socket;
        $this->puerto = $dbPara->port;
        $dbPara = NULL;
    }

    private function connect() {
        $this->connectionString = new mysqli($this->hostName, $this->userName, $this->passCode, $this->databaseName, $this->puerto, $this->socket)
                or die('Could not connect to the database server' . mysqli_connect_error());
    }

    private function byebye() {
        $this->connectionString->close();
    }

    function varQuery($string) {
        if ($string == null) {
            $string = "null";
        } else {
            $string = "'" . $string . "'";
        }
        return $string;
    }

    function randCategoria($cant, $activo) {
        $this->connect();
        $sql = "call proc_randCategory(" . $this->varQuery($cant) . ", " . $this->varQuery($activo) . ");";
        $result = $this->connectionString->query($sql);
        $this->byebye();
        return $result;
    }

    function usuarios($nombre, $paterno, $materno, $correo, $usuario, $contraseña, $imagen, $genero, $nacimiento, $privilegio, $newUser, $eliminado, $seleccion) {
        $this->connect();
        $sql = "call proc_dml_usuario(" . $this->varQuery($nombre) . ", " . $this->varQuery($paterno) . ", " . $this->varQuery($materno) . ", " . $this->varQuery($correo) . ", " . $this->varQuery($usuario) . ", " . $this->varQuery($contraseña) . ", " . $this->varQuery($imagen) . ", " . $this->varQuery($genero) . ", " . $this->varQuery($nacimiento) . ", " . $this->varQuery($privilegio) . ", " . $this->varQuery($newUser) . ", " . $this->varQuery($eliminado) . ", " . $this->varQuery($seleccion) . ");";
        $this->connectionString->query($sql);
        $this->byebye();
        return $sql;
    }

    function seccion($nombre, $desc, $clave, $seleccion) {
        $this->connect();
        $sql = "call proc_dml_categoria(" . $this->varQuery($nombre) . ", " . $this->varQuery($desc) . ", " . $this->varQuery($clave) . ", " . $this->varQuery($seleccion) . ");";
        $this->connectionString->query($sql);
        $this->byebye();
        return $sql;
    }

    function cursos($id, $nombre, $descripcion, $precio, $imagen, $usuario, $publicada, $incluye, $seleccion) {
        $this->connect();
        $sql = "call proc_dml_curso(" . $this->varQuery($id) . ", " . $this->varQuery($nombre) . ", " . $this->varQuery($descripcion) . ", " . $this->varQuery($precio) . ", "
                . $this->varQuery($imagen) . ", " . $this->varQuery($usuario) . ", " . $this->varQuery($publicada) . ", " . $this->varQuery($incluye) . ", " . $this->varQuery($seleccion) . ");";
        $result = $this->connectionString->query($sql);
        $this->byebye();
        return $result;
    }

    function seccionXcurso($curso, $categoria, $clave, $seleccion) {
        $this->connect();
        $sql = "call proc_dml_categoriaXcurso(" . $this->varQuery($curso) . ", " . $this->varQuery($categoria) . ", " . $this->varQuery($clave) . ", " . $this->varQuery($seleccion) . ");";
        $this->connectionString->query($sql);
        $this->byebye();
        return $sql;
    }
    
    function cursoXusuario($clave, $usuario, $curso, $calificacion, $seleccion) {
        $this->connect();
        $sql = "call proc_dml_cursoXusuario(" . $clave . ", '" . $usuario . "'," . $curso . "," . $calificacion . ", '". $seleccion ."');";
        $this->connectionString->query($sql);
        $this->byebye();
        return $sql;
    }
    
    function compradoONo($usuario, $curso) {
        $this->connect();
        $sql = "call proc_compradoONo('" . $usuario . "'," . $curso . ");";
        $reulst = $this->connectionString->query($sql);
        $this->byebye();
        return $reulst;
    }
    

    function seccionDeCurso($curso) {
        $this->connect();
        $sql = "call proc_get_categoriasDeCurso(" . $this->varQuery($curso) . ");";
        $result = $this->connectionString->query($sql);
        $this->byebye();
        return $result;
    }

    function comentarios($clave, $texto, $fecha, $responde, $noticia, $usuario, $seleccion) {
        $this->connect();
        $sql = "call proc_dml_comentarios( " . $this->varQuery($clave) . ", " . $this->varQuery($texto) . ", " . $this->varQuery($fecha) . ", "
                . $this->varQuery($responde) . ", " . $this->varQuery($noticia) . ", " . $this->varQuery($usuario) . ", " . $this->varQuery($seleccion) . ");";
        $this->connectionString->query($sql);
        $this->byebye();
        return 0;
    }

    function clases($clase, $titulo, $descripcion, $calificacion, $curso, $seleccion) {
        $this->connect();
        $sql = "call proc_dml_nivel({$this->varQuery($clase)}, {$this->varQuery($titulo)}, {$this->varQuery($descripcion)}, {$this->varQuery($calificacion)}, {$this->varQuery($curso)}, {$this->varQuery($seleccion)});";
        $result = $this->connectionString->query($sql);
        $this->byebye();
        return $result;
    }

    function get_secciones() {
        $this->connect();
        $sql = "call proc_categorias();";
        $result = $this->connectionString->query($sql);
        $this->byebye();
        return $result;
    }

    function get_seccionesEX() {
        $this->connect();
        $sql = "call proc_seccionesEX();";
        $result = $this->connectionString->query($sql);
        $this->byebye();
        return $result;
    }

    function Crear_secciones($orden, $color, $nombre, $estado, $nuevoNombre, $Seleccion) {
        $this->connect();
        $sql = "call proc_dml_seccion(" . $orden . ", '$color', '$nombre', '$estado', '$nuevoNombre', '$Seleccion');";
        $this->connectionString->query($sql);
        $this->byebye();
    }

    function get_cursos($categoria, $cant) {
        $this->connect();
        $sql = "call proc_cursos(" . $this->varQuery($categoria) . ", " . $this->varQuery($cant) . ");";
        $result = $this->connectionString->query($sql);
        $this->byebye();
        return $result;
    }

    function get_curso_unique($codigo) {
        $this->connect();
        $sql = "call proc_curso_unique(" . $this->varQuery($codigo) . ");";
        $result = $this->connectionString->query($sql);
        $this->byebye();
        return $result;
    }

    function get_noticiasBusqueda($buscar, $inicio, $fin, $cant) {
        $this->connect();
        if ($cant == null) {
            $sql = "call proc_busqueda(' $buscar ','  $inicio  ',' $fin ', null);";
        } else {
            $sql = "call proc_busqueda(' $buscar ','  $inicio  ',' $fin '," . $cant . ");";
        }
        $result = $this->connectionString->query($sql);
        $this->byebye();
        return $result;
    }

    function get_noticiasBusqueda2($buscar, $inicio, $fin, $fecha, $titulo, $precio, $dificultad) {
        $this->connect();
        $sql = "call proc_busquedaAvanzada(' $buscar ','  $inicio  ',' $fin '," . $fecha . "," . $titulo . "," . $precio . ",'" . "$dificultad" . "');";
        $result = $this->connectionString->query($sql);
        $this->byebye();
        return $result;
    }
    
    function get_cursosBusqueda2Categoria($buscar, $inicio, $fin, $fecha, $titulo, $precio, $dificultad, $categoria) {
        $this->connect();
        $sql = "call proc_busquedaAvanzadaMasCategoria(' $buscar ','  $inicio  ',' $fin '," . $fecha . "," . $titulo . "," . $precio . ",'" . "$dificultad" . "','" . "$categoria" . "');";

        $result = $this->connectionString->query($sql);
        $this->byebye();
        return $result;
    }
    
    function get_cursosCategoriosos($categoria, $dificultad, $cantidad) {
        $this->connect();
        $sql = "call proc_CategoriasIguales('" . "$categoria" . "','" . "$dificultad" . "', $cantidad );";
        $result = $this->connectionString->query($sql);
        $this->byebye();
        return $result;
    }
    
    function get_cursoActualCategoriosos($cursoActual, $cantidad) {
        $this->connect();
        $sql = "call proc_CategoriasIgualesCurso('$cursoActual', $cantidad );";
        $result = $this->connectionString->query($sql);
        $this->byebye();
        return $result;
    }

    function get_noticiasNew($cant) {
        $this->connect();
        if ($cant == null) {
            $sql = "call proc_noticiasNew(null);";
        } else {
            $sql = "call proc_noticiasNew(" . $cant . ");";
        }
        $result = $this->connectionString->query($sql);
        $this->byebye();
        return $result;
    }

    function initSes($usuario, $correo, $contraseña) {
        $this->connect();
        $sql = "call proc_inSes('" . $usuario . "', '" . $correo . "', '" . $contraseña . "');";
        $result = $this->connectionString->query($sql);
        $this->byebye();
        if (!empty($result) && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {

                $result2 = array($row["nombre"], $row["apellidoPaterno"], $row["apellidoMaterno"], $row["correo"],
                    $row["usuario"], $row["contraseña"], $row["imagen"], $row["genero"], $row["fecha_nacimiento"], $row["privilegio"]);
            }
        } else {
            $result2 = null;
        }
        return $result2;
    }

    function get_misCursos($codigo, $usuario) {
        $this->connect();

        $sql = "call proc_misCursos(" . $this->varQuery($codigo) . ", " . $this->varQuery($usuario) . ");";

        $result = $this->connectionString->query($sql);
        $this->byebye();
        return $result;
    }
    
      function get_misCursosComprados($usuario) {
        $this->connect();

        $sql = "call proc_misCursosComprados(" . $this->varQuery($usuario) . ");";

        $result = $this->connectionString->query($sql);
        $this->byebye();
        return $result;
    }
    
    function nivelesCursos($curso) {
        $this->connect();

        $sql = "call proc_nivelesClase(" . $curso . ");";

        $result = $this->connectionString->query($sql);
        $this->byebye();
        return $result;
    }
    
    function misAlumnos($usuario) {
        $this->connect();

        $sql = "call proc_misAlumnos('" . $usuario . "');";
        
        $result = $this->connectionString->query($sql);
        $this->byebye();
        return $result;
    }

    function misAlumnosCursos($usuario, $curso) {
        $this->connect();

        $sql = "call proc_misAlumnosCurso('" . $usuario . "',". $curso .");";
        
        $result = $this->connectionString->query($sql);
        $this->byebye();
        return $result;
    }
    
    function alumnosGanancia($curso) {
        $this->connect();

        $sql = "call proc_alumnosGanancia(". $curso .");";
        
        $result = $this->connectionString->query($sql);
        $this->byebye();
        return $result;
    }
    
    function cursosVNC($cantidad,$opc) {
        $this->connect();

        $sql = "call proc_cursosVNC(". $cantidad .", '". $opc ."');";
        
        $result = $this->connectionString->query($sql);
        $this->byebye();
        return $result;
    }
    
    function ventasTotal($usuario) {
        $this->connect();

        $sql = "call proc_ventasTotal('" . $usuario . "');";
        
        $result = $this->connectionString->query($sql);
        $this->byebye();
        return $result;
    }

    function get_lasNoticias($orden, $estado, $codigo) {
        $this->connect();

        $sql = "call proc_lasNoticias(" . $this->varQuery($orden) . ", " . $this->varQuery($estado) . ", " . $this->varQuery($codigo) . ");";

        $result = $this->connectionString->query($sql);
        $this->byebye();
        return $result;
    }

    function get_Clases($codigo) {
        $this->connect();
        $sql = "call proc_nivelCurso(" . $this->varQuery($codigo) . ");";
        $result = $this->connectionString->query($sql);
        $this->byebye();
        return $result;
    }

    function get_misComentarios($noticia, $responde) {
        $this->connect();

        $sql = "call proc_Comentarios(" . $this->varQuery($noticia) . ", " . $this->varQuery($responde) . ");";

        $result = $this->connectionString->query($sql);
        $this->byebye();
        return $result;
    }

    function newsInteractions($seleccion, $noticia, $usuario) {
        $this->connect();

        $sql = "call proc_NewsInteractions(" . $this->varQuery($seleccion) . ", " . $this->varQuery($noticia) . ", " . $this->varQuery($usuario) . ");";

        $result = $this->connectionString->query($sql);
        $this->byebye();
        return $result;
    }

    function get_Reporteros() {
        $this->connect();
        $sql = "call proc_Reporteros();";
        $result = $this->connectionString->query($sql);
        $this->byebye();
        return $result;
    }

    function likesNew($noticia, $usuario, $noticiaNew, $usuarioNew, $seleccion) {
        $this->connect();

        $sql = "call proc_dml_LikesNoticia(" . $this->varQuery($noticia) . ", " . $this->varQuery($usuario) . ", " . $this->varQuery($noticiaNew) . ", " . $this->varQuery($usuarioNew) . ", " . $this->varQuery($seleccion) . ");";

        $this->connectionString->query($sql);
        $this->byebye();
    }

}

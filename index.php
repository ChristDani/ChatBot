<?php require_once "database.php";

function buscarRespuesta()
{
    $filas=null;
    $model=new conexion();
    $conexion=$model->conectar();
    $sql="Select top 1 * from mensajes";

    $rs=sqlsrv_query($conexion,$sql);
    while($row=sqlsrv_fetch_array($rs))
    {
        $filas[]=$row;
    }
    $conexion=$model->desconectar();
    return $filas;
}
function preguntar()
{


    $filas=buscarRespuesta();


    if ($filas != null) 
    {

        foreach ($filas as $fila) 
        {
            $pregunta=$fila[0];
            $respuesta=$fila[1];
            echo "<div class='user'>";
            echo "<img src='img/usuario.png' alt='user'>";
            echo "<label id='pregunta'>$pregunta</label>";
            echo "</div>";
            echo "<div class='bot'>";
            echo "<img src='img/bot.png' alt='Bob'>";
            echo "<label>$respuesta</label>";
            echo "</div>";
        }
    }

}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="img/bot.ico">
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>ChatBot</title>
</head>
<body>
    <div class="chat">
        <div class="header">
            <img src="img/bot.png" alt="Bob">
            <label><em><strong>Bob</strong></em></label>
        </div>
        <div class="contenido">
            <?php preguntar(); ?>
        </div>
        <div class="foother">
            <input placeholder="Ingrese su consulta..." id="pregunta">
            <button onclick=preguntar()>Enviar</button>
        </div>
    </div>
</body>
</html>
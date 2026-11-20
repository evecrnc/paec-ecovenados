<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = htmlspecialchars(trim($_POST["nombre"]));
    $edad = htmlspecialchars(trim($_POST["edad"]));
    $grupo = htmlspecialchars(trim($_POST["grupo"]));
    $residuo = htmlspecialchars(trim($_POST["residuo"]));
    $separa = htmlspecialchars(trim($_POST["separa"]));
    $accion = htmlspecialchars(trim($_POST["accion"]));
    $compromiso = htmlspecialchars(trim($_POST["compromiso"]));
    $comentario = htmlspecialchars(trim($_POST["comentario"]));

    if (!empty($nombre) && !empty($edad) && !empty($grupo) && !empty($residuo) && !empty($separa) && !empty($accion) && !empty($compromiso) && !empty($comentario)) {
        $fecha = date("Y-m-d H:i:s");
        $linea = "Fecha: $fecha | Nombre: $nombre | Edad: $edad | Grupo: $grupo | Residuo: $residuo | Separa: $separa | Accion: $accion | Compromiso: $compromiso | Comentario: $comentario" . PHP_EOL;
        file_put_contents("registros.txt", $linea, FILE_APPEND | LOCK_EX);
        $estado = "exito";

        switch ($compromiso) {
            case "Separar basura en casa":
                $mensajePersonalizado = "Excelente eleccion. Clasificar los desechos organicos e inorganicos desde tu hogar facilita enormemente el trabajo de reciclaje y evita la contaminacion.";
                break;
            case "Reducir plasticos":
                $mensajePersonalizado = "Gran iniciativa. Evitar botellas y bolsas desechables disminuye directamente la acumulacion de residuos que tardan siglos en degradarse.";
                break;
            case "Reutilizar materiales":
                $mensajePersonalizado = "Muy bien. Darle una segunda vida util a cuadernos, frascos y envases ahorra energia y recursos naturales valiosos.";
                break;
            case "Reciclar en la escuela":
                $mensajePersonalizado = "Tu apoyo en el plantel es clave. Utilizar los contenedores adecuados inspira a tus companeros a mantener limpias nuestras instalaciones.";
                break;
            case "Cuidar areas verdes":
                $mensajePersonalizado = "Compromiso fundamental. Proteger los arboles y jardines de nuestra comunidad mejora la calidad del aire y nuestro entorno escolar.";
                break;
            default:
                $mensajePersonalizado = "Gracias por sumarte activamente al cuidado del medio ambiente con el equipo PAEC Ecovenados.";
                break;
        }
    } else {
        $estado = "error";
    }
} else {
    header("Location: index.html");
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Compromiso Registrado - PAEC Ecovenados</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>

    <header class="encabezado">
        <div class="contenedor-header">
            <div class="logo-titulo">
                <span class="subtitulo-inst">COLEGIO DE BACHILLERES DEL ESTADO DE CHIHUAHUA</span>
                <h1>PAEC ECOVENADOS</h1>
            </div>
        </div>
    </header>

    <main>
        <section class="seccion-principal" style="grid-template-columns: 1fr; text-align: center;">
            <?php if ($estado === "exito"): ?>
                <div>
                    <h2 style="border: none; padding: 0;">COMPROMISO REGISTRADO CON EXITO</h2>
                    <p style="text-align: center;">Muchas gracias, <strong><?php echo $nombre; ?></strong> (<?php echo $edad; ?> anos, Grupo <?php echo $grupo; ?>).</p>
                    <p style="text-align: center;">Has elegido el compromiso: <strong><?php echo $compromiso; ?></strong>.</p>
                    <div class="caja-objetivo" style="max-width: 650px; margin: 20px auto; text-align: left;">
                        <p style="margin: 0; color: #14281d; font-weight: bold;"><?php echo $mensajePersonalizado; ?></p>
                    </div>
                    <a href="index.html" class="boton-accion">VOLVER AL INICIO</a>
                </div>
            <?php else: ?>
                <div>
                    <h2 style="border: none; padding: 0; color: #b71c1c;">ERROR AL ENVIAR EL COMPROMISO</h2>
                    <p style="text-align: center;">Por favor asegurate de llenar todos los campos del cuestionario antes de enviarlo.</p>
                    <a href="index.html#contacto" class="boton-accion">REGRESAR AL CUESTIONARIO</a>
                </div>
            <?php endif; ?>
        </section>
    </main>

    <footer class="pie-pagina">
        <p>PAEC ECOVENADOS - PROYECTO ECOLOGICO ESTUDIANTIL 2026</p>
    </footer>

</body>
</html>
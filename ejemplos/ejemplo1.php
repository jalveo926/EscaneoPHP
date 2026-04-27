<?php
// Incluir la clase Escaner
require 'Escaner.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejemplo 1: Limpiar Etiquetas</title>
    <link rel="stylesheet" href="../styles.css">
</head>
<body>
    <main>
        <form method="POST">
    <label>Ingresa el texto a analizar:</label><br><br>
    <textarea name="entrada" placeholder="Pega aquí tu texto, HTML, correos o scripts..."><?= htmlspecialchars($_POST['entrada'] ?? '') ?></textarea>

    <div class="botones">
        <button name="accion" value="limpiarEtiquetas">Limpiar Etiquetas</button>
        <button name="accion" value="limpiarCorreos">Extraer Correos</button>
        <button name="accion" value="limpiarScripts">Limpiar Scripts</button>
        <button name="accion" value="tieneCorreos">¿Tiene Correos?</button>
        <button name="accion" value="tieneScripts">¿Tiene Scripts?</button>
        <button name="accion" value="tieneEtiquetas">¿Tiene Etiquetas?</button>
        <button name="accion" value="sanitizar">Sanitizar</button>
    </div>
</form>
    </main>
</body>
</html>

<?php  

$resultado = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $entrada  = $_POST['entrada'] ?? '';
    $accion   = $_POST['accion'] ?? '';
    $escaner  = new EscanerBasico($entrada, $entrada, $entrada);

    $resultado = match($accion) {
        'limpiarEtiquetas' => $escaner->limpiarEtiquetas(),
        'limpiarCorreos'   => $escaner->limpiarCorreos(),
        'limpiarScripts'   => $escaner->limpiarScripts(),
        'tieneCorreos'     => EscanerBasico::tieneCorreos($entrada) ? '✅ Contiene correos' : '❌ No contiene correos',
        'tieneScripts'     => EscanerBasico::tieneScripts($entrada) ? '✅ Contiene scripts' : '❌ No contiene scripts',
        'tieneEtiquetas'   => EscanerBasico::tieneEtiquetas($entrada) ? '✅ Contiene etiquetas' : '❌ No contiene etiquetas',
        'sanitizar'        => EscanerBasico::sanitizar($entrada),
        default            => 'Acción no válida'
    };
}
?>

<?php if ($resultado !== null): ?>
    <div class="resultado">
        <strong>Resultado:</strong><br><br>
        <?= htmlspecialchars($resultado) ?>
    </div>
<?php endif; ?>

<?php
// Incluir la clase Escaner
require 'Escaner.php';

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

            <?php if ($resultado !== null): ?>
            <div class="resultado">
                <strong>Resultado:</strong><br><br>
                <?= htmlspecialchars($resultado) ?>
            </div>
            <?php endif; ?>

            <div class="botones">
                <div class= "Ejemplo1">
                    <h2>Ejemplo 1: Limpiar Etiquetas</h2>
                    <p>Este ejemplo muestra cómo eliminar etiquetas HTML de un texto utilizando el método <code>limpiarEtiquetas()</code>. Simplemente ingresa un texto con etiquetas HTML y haz clic en "Limpiar Etiquetas" para ver el resultado sin las etiquetas.</p>
                    <button name="accion" value="limpiarEtiquetas">Limpiar Etiquetas</button>
                    <div class = "Estaticos">
                        <h3>Método Estático</h3>
                        <button name="accion" value="tieneEtiquetas">¿Tiene Etiquetas?</button>
                    </div>
                </div>

                <div class= "Ejemplo2">
                    <h2>Ejemplo 2: Limpiar Correos</h2>
                    <p>En este ejemplo, puedes extraer correos electrónicos válidos de un texto utilizando el método <code>limpiarCorreos()</code>. Ingresa un texto que contenga correos electrónicos y haz clic en "Extraer Correos" para obtener una lista de los correos encontrados.</p>
                    <button name="accion" value="limpiarCorreos">Extraer Correos</button>
                    <div class = "Estaticos">
                        <h3>Método Estático</h3>
                        <button name="accion" value="tieneCorreos">¿Tiene Correos?</button>
                    </div>
                </div>

                <div class= "Ejemplo3">
                    <h2>Ejemplo 3: Limpiar Scripts</h2>
                    <p>Este ejemplo demuestra cómo eliminar scripts maliciosos de un texto utilizando el método <code>limpiarScripts()</code>. Ingresa un texto que contenga etiquetas <code>&lt;script&gt;</code> y haz clic en "Limpiar Scripts" para ver el resultado sin los scripts.</p>
                    <button name="accion" value="limpiarScripts">Limpiar Scripts</button>
                    <div class = "Estaticos">
                        <h3>Método Estático</h3>
                        <button name="accion" value="tieneScripts">¿Tiene Scripts?</button>
                    </div>
                </div>
            
            </div>
            <button name="accion" value="sanitizar">Sanitizar</button>
        </form>

    </main>
</body>
</html>




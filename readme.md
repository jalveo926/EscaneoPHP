# 📄 README — Escaneo de Datos en PHP & Servidor PHP Puro

---

## 📌 ¿Qué es el Escaneo de Datos en PHP?

El **escaneo de datos** en PHP se refiere al proceso de leer, filtrar, validar y recorrer información proveniente de distintas fuentes como formularios, archivos, bases de datos o APIs. PHP ofrece herramientas nativas para hacerlo de forma segura y eficiente.

---

## 🔍 Funciones Clave para Escaneo de Datos

### 1. `filter_input()` y `filter_var()` — Validar y sanear datos

```php
// Validar un email
$email = filter_var("usuario@ejemplo.com", FILTER_VALIDATE_EMAIL);

// Sanear una cadena (eliminar caracteres especiales)
$nombre = filter_var("  <Juan>  ", FILTER_SANITIZE_SPECIAL_CHARS);

// Leer y validar desde un formulario POST
$edad = filter_input(INPUT_POST, 'edad', FILTER_VALIDATE_INT);
```

### 2. `preg_match()` — Escaneo con expresiones regulares

```php
$texto = "Mi código postal es 12345";

if (preg_match('/\d{5}/', $texto, $coincidencias)) {
    echo "Código encontrado: " . $coincidencias[0]; // 12345
}
```

### 3. `sscanf()` — Leer datos con formato específico

```php
$linea = "Juan 25 Guatemala";

// Extrae nombre (string), edad (int) y país (string)
list($nombre, $edad, $pais) = sscanf($linea, "%s %d %s");

echo $nombre; // Juan
echo $edad;   // 25
echo $pais;   // Guatemala
```

### 4. `array_filter()` — Filtrar arreglos

```php
$datos = [1, "", null, "activo", 0, "inactivo"];

// Elimina valores vacíos, null y 0
$limpios = array_filter($datos);

print_r($limpios); // ["activo", "inactivo"]
```

### 5. `fgetcsv()` — Escanear archivos CSV

```php
$archivo = fopen("datos.csv", "r");

while (($fila = fgetcsv($archivo, 1000, ",")) !== false) {
    echo "Nombre: " . $fila[0] . " | Edad: " . $fila[1] . PHP_EOL;
}

fclose($archivo);
```

---

## 🧪 Ejemplo Completo — Validar datos de un formulario

```php
<?php
$nombre = filter_input(INPUT_POST, 'nombre', FILTER_SANITIZE_SPECIAL_CHARS);
$email  = filter_input(INPUT_POST, 'email',  FILTER_VALIDATE_EMAIL);
$edad   = filter_input(INPUT_POST, 'edad',   FILTER_VALIDATE_INT);

if (!$nombre || !$email || !$edad) {
    echo "❌ Datos inválidos o incompletos.";
} else {
    echo "✅ Bienvenido, $nombre. Tu email es $email y tienes $edad años.";
}
?>
```

---

## 🚀 Ejecutar el Servidor PHP Puro (sin Apache/XAMPP)

PHP incluye un **servidor web integrado** ideal para desarrollo local. No necesitas Apache ni Nginx.

### ▶️ Comando básico

```bash
php -S localhost:8000
```

Esto levanta el servidor en `http://localhost:8000` usando la carpeta actual como raíz.

---

### 📁 Especificar una carpeta raíz distinta

```bash
php -S localhost:8000 -t ruta/a/tu/proyecto
```

**Ejemplo:**
```bash
php -S localhost:8000 -t C:\proyectos\mi-app
```

---

### 📝 Usar un archivo de entrada personalizado (router)

```bash
php -S localhost:8000 router.php
```

Útil para frameworks o cuando quieres redirigir todas las rutas a un solo archivo.

---

### 🌐 Hacerlo accesible en la red local

```bash
php -S 0.0.0.0:8000
```

Otros dispositivos en tu red podrán acceder usando tu IP local (ej: `http://192.168.1.10:8000`).

---



## 📂 Estructura de proyecto

```
EscaneoPHP/
├── index.php       ← Punto de entrada
├── ejemplos/
│   └── scanner.php ← Lógica de escaneo
└── data/
    └── datos.csv   ← Archivos de datos
```

Ejecutar desde la raíz del proyecto:
```bash
php -S localhost:8000 -t EscaneoPHP
```

---


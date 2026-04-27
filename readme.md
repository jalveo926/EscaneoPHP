# � EscaneoPHP — Limpieza y Validación de Texto

Una aplicación web que demuestra el uso de la clase `EscanerBasico` para limpiar, validar y extraer información de texto, incluyendo HTML, correos electrónicos y scripts potencialmente maliciosos.

**Autores:** Jesús Alveo y Roniel Quintero

---

## ✨ Características Principales

- **Limpiar etiquetas HTML** — Elimina todas las etiquetas HTML de un texto
- **Extraer correos** — Detecta y extrae correos electrónicos válidos
- **Eliminar scripts** — Elimina etiquetas `<script>` y contenido malicioso
- **Validaciones** — Verifica si el texto contiene HTML, correos o scripts
- **Sanitización** — Limpia caracteres peligrosos del texto

---

## 📚 Métodos Disponibles

### Métodos de Instancia (requieren crear un objeto)

```php
$escaner = new EscanerBasico($texto, $texto2, $texto3);

// Limpiar etiquetas HTML
$resultado = $escaner->limpiarEtiquetas();

// Extraer y limpiar correos
$correos = $escaner->limpiarCorreos();

// Eliminar scripts
$limpio = $escaner->limpiarScripts();
```

### Métodos Estáticos (se usan sin crear instancia)

```php
// Verificar si contiene correos
if (EscanerBasico::tieneCorreos($texto)) {
    echo "✅ Contiene correos";
}

// Verificar si contiene etiquetas HTML
if (EscanerBasico::tieneEtiquetas($texto)) {
    echo "⚠️ Contiene HTML";
}

// Verificar si contiene scripts
if (EscanerBasico::tieneScripts($texto)) {
    echo "❌ Contiene scripts maliciosos";
}

// Sanitizar texto
$seguro = EscanerBasico::sanitizar($texto);
```

---

## 🧪 Ejemplos de Uso

### Ejemplo 1: Limpiar HTML

```php
$entrada = "Hola <b>mundo</b>, esto es <em>importante</em>";
$escaner = new EscanerBasico($entrada, $entrada, $entrada);
$resultado = $escaner->limpiarEtiquetas();
// Resultado: "Hola mundo, esto es importante"
```

### Ejemplo 2: Extraer Correos

```php
$entrada = "Contacta con juan@email.com o maria@empresa.com";
$escaner = new EscanerBasico($entrada, $entrada, $entrada);
$correos = $escaner->limpiarCorreos();
// Resultado: "juan@email.com,maria@empresa.com"
```

### Ejemplo 3: Validar Contenido

```php
$entrada = "Este texto contiene usuario@email.com";

// Verificar antes de procesar
if (EscanerBasico::tieneCorreos($entrada)) {
    $escaner = new EscanerBasico($entrada, $entrada, $entrada);
    $correos = $escaner->limpiarCorreos();
}
```

---

## � Estructura del Proyecto

```
EscaneoPHP/
├── index.php          ← Interfaz web principal
├── styles.css         ← Estilos CSS
├── readme.md          ← Este archivo
├── src/
│   └── Escaner.php    ← Clase EscanerBasico (métodos estáticos e instancias)
└── .git/              ← Control de versiones
```

---

## 🚀 Cómo Usar

### 1. Opción A: Con WAMP/XAMPP

Si el proyecto está en `C:\wamp64\www\EscaneoPHP`, simplemente accede a:
```
http://localhost/EscaneoPHP
```

### 2. Opción B: Con Servidor PHP Integrado

```bash
# Navega a la carpeta del proyecto
cd C:\wamp64\www\EscaneoPHP

# Levanta el servidor en puerto 8000
php -S localhost:8000
```

Luego accede a: `http://localhost:8000`

### 3. Hacerlo accesible en la red local

```bash
php -S 0.0.0.0:8000
```

Otros dispositivos en tu red podrán acceder usando tu IP local (ej: `http://192.168.1.10:8000`).

---

## 🎯 Funcionalidades de la Interfaz Web

La aplicación web (`index.php`) ofrece tres ejemplos interactivos:

### ✏️ Ejemplo 1: Limpiar Etiquetas
- **Método de instancia:** `limpiarEtiquetas()`
- **Método estático:** `tieneEtiquetas()`
- Permite eliminar todas las etiquetas HTML del texto ingresado

### 📧 Ejemplo 2: Extraer Correos
- **Método de instancia:** `limpiarCorreos()`
- **Método estático:** `tieneCorreos()`
- Detecta y extrae correos electrónicos válidos

### 🛡️ Ejemplo 3: Eliminar Scripts
- **Método de instancia:** `limpiarScripts()`
- **Método estático:** `tieneScripts()`
- Elimina etiquetas `<script>` y contenido malicioso

### 🧹 Acción General: Sanitizar
- **Método estático:** `sanitizar()`
- Limpia caracteres peligrosos del texto


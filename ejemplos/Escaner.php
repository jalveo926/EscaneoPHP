
<?php 
    // INTERFAZ: Define el contrato que debe cumplir cualquier clase que la implemente
    // Establece los métodos obligatorios que debe tener un Escaner
    interface Escaner {
        public function limpiarEtiquetas();    // Elimina etiquetas HTML del texto
        public function limpiarCorreos();      // Extrae y limpia direcciones de correo
        public function limpiarScripts();      // Elimina scripts maliciosos (XSS)
    }

// CLASE: Implementa la interfaz Escaner con funcionalidades de validación y limpieza
class EscanerBasico implements Escaner {
    
    // PROPIEDADES: Variables de instancia que almacenan los datos a limpiar
    public string $correo;   // Almacena el texto con direcciones de correo
    public string $texto;    // Almacena el texto con posibles etiquetas HTML
    public string $script;   // Almacena el texto con posibles scripts maliciosos

    // CONSTRUCTOR: Inicializa los atributos cuando se crea un objeto de la clase
    public function __construct($correo, $texto, $script) {
        $this->correo = $correo;
        $this->texto = $texto;
        $this->script = $script;
    }



    // MÉTODO DE INSTANCIA: Utiliza $this para acceder a las propiedades del objeto
    // Elimina todas las etiquetas HTML usando strip_tags()
    public function limpiarEtiquetas() {
        
        return strip_tags($this->texto);  // Remueve <b>, <p>, etc.
    }

    // MÉTODO DE INSTANCIA: Busca y extrae correos electrónicos válidos
    // Utiliza expresión regular (regex) para validar formato de email
    public function limpiarCorreos(): string
    {
       
        // preg_match_all() encuentra todos los coincidencias de email en el texto
        preg_match_all('/[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}/', $this->correo, $matches);
        return implode(', ', $matches[0]);  // Une los correos encontrados
    }

    // MÉTODO DE INSTANCIA: Elimina scripts maliciosos que podrían ser inyectados (XSS)
    // Utiliza preg_replace() para reemplazar etiquetas <script> por nada
    public function limpiarScripts() {
       
        // Busca y elimina cualquier etiqueta <script>...</script>
        return preg_replace('/<script\b[^<]*(?:(?!<\/script>)<[^<]*)*<\/script>/i', '', $this->script);
    }



     // MÉTODOS ESTÁTICOS: Pertenecen a la clase, no a instancias específicas
     // Se llaman con NombreClase::nombreMetodo() sin necesidad de crear objetos
     
     // Verifica si existe al menos un correo válido en el texto
    public static function tieneCorreos(string $texto): bool
    {
        return (bool) preg_match('/[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}/', $texto);
    }

    // Verifica si el texto contiene etiquetas <script> (código malicioso potencial)
    public static function tieneScripts(string $texto): bool
    {
        return (bool) preg_match('/<script\b[^>]*>(.*?)<\/script>/is', $texto);
    }

    // Verifica si el texto contiene etiquetas HTML (como <b>, <p>, etc.)
    public static function tieneEtiquetas(string $texto): bool
    {
        return $texto !== strip_tags($texto);  // Compara el texto original con su versión sin etiquetas
    }

    // Cuenta cuántos correos válidos hay en el texto
    public static function contarCorreos(string $texto): int
    {
        preg_match_all('/[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}/', $texto, $matches);
        return count($matches[0]);  // Retorna el número de coincidencias
    }

    // Sanitiza (limpia) un string eliminando caracteres especiales y espacios
    public static function sanitizar(string $texto): string
    {
        // htmlspecialchars() convierte caracteres especiales a entidades HTML seguras
        // trim() elimina espacios en blanco al inicio y final
        return htmlspecialchars(trim($texto), ENT_QUOTES, 'UTF-8');
    }

    // Valida si una URL es segura verificando si usa protocolo HTTPS
    public static function urlEsSegura(string $url): bool
    {
        return str_starts_with($url, 'https://');  // str_starts_with() verifica si comienza con 'https://'
    }

}
?> 
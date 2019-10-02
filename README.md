Test Cypress:

* Crear página de prueba con WP-Cli o en una URL.
* Comprobar que están los shortcodes.
* Borrar página de prueba.

Meter algún comentario que ya no sea válido para mostrar que los comentarios mienten.

Pruebas:
* Meter un regalazo="inexistente"
* Añadir un nuevo tipo de regalazo y ver lo complicado que es.

Comentar:
* Código en las vistas = caca. Mirar por ejemplo lo de "money_format" que en unos sitios se ha hecho de una forma y en otros de otra.
* En el switch precios, en pegatinas, hay un comentario falso.

Chanzas:
* Es muy importante salvar la brecha entre desarrolladores y diseñadores. Pero eso es para vosotros, que yo ya estoy muy mayor.

NOTA!!!
* Cambiar in_array() por array_key_exists()

Pasos:
* Enseñar lo que hace el plugin y vemos que aparentemente funciona:
    * Creamos una nueva página.
    * Metemos el primer shortcode:
    `[regalazo_wordcamp regalazo="pegatina"]`
    * Visitamos la vista previa de la página.
    * Metemos la cantidad para ver cómo se muestra:
    `[regalazo_wordcamp regalazo="pegatina" cantidad=10]`
    * Añadimos camiseta con tamaños:
    `[regalazo_wordcamp regalazo="camiseta" tallas="S,L,XL"]`
    * Y vemos que quitando los tamaños pone "Talla única".
* Añadimos un tipo de shortcode no válido:
    * `[regalazo_wordcamp regalazo="noexiste"]`.
    * Vemos que hay un error. Pista de que algo no se ha hecho bien.
* Imaginemos que somos desarrolladores, nos pasan el plugin y nos dicen que:
    * Arreglemos el problema cuando se mete uno no válido. Quieren que se muestre el mensaje que diga "¡Habrá regalos!".
    * Que añadamos un nuevo tipo de regalo: Calcetines:
    `[regalazo_wordcamp regalazo="calcetines" tallas="Grande,Pequeño"]`
    * Añadamos el campo "patrocinador".
* Borramos todos los shortcodes de ejemplo.
* Revisamos el código. Comentar que eso no es POO.
* Arreglar el no válido:
    * Lo arreglamos añadiendo un:
    ```
          if (!isset($vista)) {
              return "Habrá regalazos!";
          }
    ```
* Nuevo tipo de regalo:
    * Empezamos 
    * Metemos lo del patrocinador. Lo metemos dentro del switch del nuevo shortcode.
    * Nos olvidamos (a posta) de lo del precio.
* Ponemos uno de los otros shortcodes y vemos que da error por el patrocinador. Esto nos da la pista de que necesitamos test.
* Meter test Cypress y ver que funciona:
    * Crear un test por cada tipo de pegatina.
    * Ver si se puede hacer que se cree una página "on the fly" y luego borrarla.
* Iteración 1:
    * Renombrar variables y métodos.  
* Introducción a los principios SOLID. Contarlos por encima.
    * Hablar del principo de responsabilidad única.
    * Comentar que el método "definir" hace demasiadas cosas y vamos a aligerarlo.
* Iteración 2: Arreglar el foreach: 
    * Crear un método llamado `preparar_array_campos`.
    * Crear un método llamado `anadir_campos_del_shortcode`.
    * Crear un método llamado `anadir_campo_si_no_esta`.
* Iteración 3: Crear un método para recuperar los valores del shortcode:
    * Crear un método llamado `recoger_valores_shortcode` y meter ahí la función shortcode_atts.
    
    * Convertir el foreach en una clase llamada campos.
    
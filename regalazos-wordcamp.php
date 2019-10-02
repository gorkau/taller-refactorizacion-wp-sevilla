<?php
/**

Plugin Name: regalazos WordCamp
Version: 0.0.1
Description: Una chapuza de plugin que usaremos en el Taller "Del Caos a la excelencia" en la WordCamp de Sevilla. Su escasa utilidad consiste en crear short codes para poder mostrar los regalazos que se van a hacer en una WordCamp.
Author: Gorka Urrutia (Pero no se lo digas a nadie, porfa)
Author URI: https://urlanheat.com

{Plugin Name} is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 2 of the License, or
any later version.

{Plugin Name} is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with {Plugin Name}. If not, see {License URI}.

*/

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
    die;
}

define( 'REGALAZOS_WORDCAMP__DIRECTORIO_PUBLICO_PLUGIN', plugins_url( '',__FILE__ ) );

require plugin_dir_path( __FILE__ ) . 'includes/regalazos_wordcamp.php';

add_action( 'init', array( 'regalazosWordCamp', 'init' ) );

function definir($atts) {
    $regalazos = new regalazosWordCamp();

    return $regalazos->definir($atts);
}

add_shortcode('regalazo_wordcamp', 'definir');
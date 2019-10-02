<?php
/**
 * Created by PhpStorm.
 * User: gorka
 * Date: 7/09/19
 * Time: 23:26
 */

class regalazosWordCamp
{
    private static $initiated = false;

    public static function init() {
        if ( ! self::$initiated ) {
            self::$initiated = true;
            self::init_hooks();
        }
    }

    public static function init_hooks() {

        add_action('wp_enqueue_scripts','regalazos_wordcamp_load_scripts');

        function regalazos_wordcamp_load_scripts() {
            wp_enqueue_style('regalazos-wordcamp-estilos', REGALAZOS_WORDCAMP__DIRECTORIO_PUBLICO_PLUGIN .'/css/estilos.css');
        }
    }

    public function definir($atts)
    {
        $short_codes = [
            'pegatina' => array(),
            'camiseta' => [
                'campos' => [
                    'tallas'
                ]
            ],
            'boligrafo' => [
                'campos' => [
                    'colores'
                ]
            ],
            'bolsa' => [
                'campos' => [
                    'colores'
                ]
            ]
        ];

        $campos = [
            'regalazo' => '',
        ];

        $campos = $this->hacerForeach($campos, $short_codes);

        $campos['cantidad'] = 0;

        $atts = shortcode_atts(
            $campos
            ,
            $atts,
            'regalazo_wordcamp'
        );

        //print_r($atts);

        $regalazo_escogido = $atts['regalazo'];

        if($atts['cantidad']) {
            switch ($regalazo_escogido) {
                case 'pegatina':
                    // El precio de las pegatinas se calcula dividiendo cincuenta entre el número de unidades y le sumamos 10.
                    $precio = 100 / $atts['cantidad'] + 20;
                    break;
                case 'camiseta':
                    $precio = 50 / $atts['cantidad'] + 5;
                    break;
                case 'boligrafo':
                    $precio = 30; // Este precio no aparecerá si no hay cantidad

            }
        }
        else {
            $precio = 0;
        }

        if (!isset($precio)) {
            $precio = 0;
        }


        if ($atts['tallas']) {
            $tallas = $atts['tallas'];
        }

        if ($atts['colores']) {
            $colores = $atts['colores'];
        }

        ob_start();

        switch ($regalazo_escogido) {
            case 'pegatina':
                $vista = 'pegatina';
                break; // Quitar este break
            case 'camiseta':
                if(!isset($tallas)) {
                    $tallas = 'Talla única';
                }
                $vista = "camiseta";
                break;
            case 'bolsa':
                if(!isset($colores)) {
                    $colores = 'Bolsa de color único';
                }
                $vista = "bolsa";
                break;
            case 'boligrafo':
                if(!isset($colores)) {
                    $colores = 'Color único';
                }
                $vista = 'boligrafo';

        }

        $cantidad = $atts['cantidad'];
        $vista = plugin_dir_path( __FILE__ ) . "../vistas/$vista.php";
        include( plugin_dir_path( __FILE__ ) . "../vistas/regalazo.php" );
        $formulario = ob_get_clean();
        return $formulario;
    }

    public function hacerForeach($campos, $short_codes)
    {
        foreach($short_codes as $short_code) {
            if (isset($short_code['campos'])) {
                foreach($short_code['campos'] as $campo) {
                    if(!in_array($campo, $campos)) {
                        $campos[$campo] = '';
                    }
                }
            }
        }

        return $campos;
    }
}
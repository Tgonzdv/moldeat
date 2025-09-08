<?php
// Constantes compartidas para evitar duplicación
class MoldeatConstants {
    public static function getFallbackStory($itemNames = []) {
        if (empty($itemNames)) {
            $itemsText = "tus herramientas";
        } else {
            $itemsText = "tu " . implode(' y tu ', $itemNames);
        }
        
        return "Cada mañana, te despiertas junto al mar. Ajustas $itemsText con cuidado y te pierdes en la plaza del pueblo. La gente te saluda, conocen tu habilidad. En esta pequeña isla donde el viento huele a sal y a pan recién horneado. Pasas las tardes sentado en el muelle, moldeando pequeñas figuras con los restos de tu propia plastilina. Como si quisieras multiplicarte en miniaturas. En tu silencio observas con atención las gaviotas, las olas y las conversaciones ajenas. En tu mundo, cada día es una mezcla de quietud y descubrimiento, como si supieras que algo importante está por suceder, pero sin afurar por llegar.";
    }
    
    public static function processItemNames($items) {
        return array_map(function($item) {
            $name = str_replace('.png', '', $item);
            $name = preg_replace('/[_-]/', ' ', $name);
            return ucfirst($name);
        }, $items);
    }
}
?>

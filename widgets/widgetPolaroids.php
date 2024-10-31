<?php

add_action('widgets_init', create_function('', 'return register_widget("plazaaPolaroidsWidget");'));

require(dirname(__FILE__) . '/widgetBaseClass.php');

class plazaaPolaroidsWidget extends plazaaWidgetBaseClass
{
    protected $widgetName = 'Plazaa Polaroids (Experimentell)';
    protected $css = 'Polaroids';
    protected $cssId = 'plazaa-polaroids';
    
    protected $formFields = array(
        'title' => 'Mein aktuellster Bericht', 
        'numPolaroids' => 1, 
    );
   
    protected $labels = array(
        'title' => 'Überschrift',
        'numPolaroids' => 'Anzahl Polaroids'
    );
 
    protected function renderTemplate()
    {
        $userName = get_option('plazaaUserName');
        $ratings = $this->Api->getUserRatings($userName, $this->options['numPolaroids']);
 
        ob_start();
        include(dirname(__FILE__) . '/../templates/widgetPolaroids.php');
        $out = ob_get_contents();
        ob_end_clean();
        
        return $out;
    }
}

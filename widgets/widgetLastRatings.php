<?php

add_action('widgets_init', create_function('', 'return register_widget("plazaaLastRatingsWidget");'));

require(dirname(__FILE__) . '/widgetBaseClass.php');

class plazaaLastRatingsWidget extends plazaaWidgetBaseClass
{
    protected $widgetName = 'Plazaa Bewertungen';
    protected $css = 'LastRatings';
    protected $cssId = 'plazaa-empfehlungen';
    
    protected $formFields = array(
        'title' => 'Letzte Bewertungen', 
        'numRatings' => '5', 
    );
   
    protected $labels = array(
        'title' => 'Überschrift',
        'numRatings' => 'Anzahl Bewertungen'
    );
 
    protected function renderTemplate()
    {
        $userName = get_option('plazaaUserName');
        $ratings = $this->Api->getUserRatings($userName, $this->options['numRatings']);
 
        ob_start();
        include(dirname(__FILE__) . '/../templates/widgetLastRatings.php');
        $out = ob_get_contents();
        ob_end_clean();
        
        return $out;
    }
}

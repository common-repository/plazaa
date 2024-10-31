<?php

add_action('widgets_init', create_function('', 'return register_widget("plazaaProfileWidget");'));

require(dirname(__FILE__) . '/widgetBaseClass.php');

class plazaaProfileWidget extends plazaaWidgetBaseClass
{
    protected $widgetName = 'Plazaa Profil';
    protected $css = 'Profile';
    protected $cssId = 'plazaa-profil';
    
    protected $formFields = array(
        'title' => 'Mein Profil auf plazaa'
    );
   
    protected $labels = array(
        'title' => 'Überschrift'
    );

    protected function renderTemplate()
    {
        $userName = get_option('plazaaUserName');
        $profile = $this->Api->getProfile($userName);
 
        ob_start();
        include(dirname(__FILE__) . '/../templates/widgetProfile.php');
        $out = ob_get_contents();
        ob_end_clean();
        
        return $out;
    }
}

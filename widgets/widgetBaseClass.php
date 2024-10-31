<?php

if (!class_exists('plazaaWidgetBaseClass')) {
    
require(dirname(__FILE__) . '/../includes/wpPlazaaApiClass.php');

class plazaaWidgetBaseClass extends WP_Widget
{

    protected $Api;
    protected $options;
    
    protected $formFields;
    protected $labels;
    protected $widgetName;
    protected $css;
    protected $cssId;
    
    function plazaaWidgetBaseClass()
    {
        parent::WP_Widget(false, $this->widgetName);  
       
        $this->Api = new wpPlazaaApiClass;
    }
   
    function update($new_instance, $old_instance)
    {             
        $instance = $old_instance;
        foreach ($this->formFields as $field => $value) {
            $instance[$field] = strip_tags($new_instance[$field]);
        }
        
        return $instance;
    }
    
    function widget($args, $instance)
    {
        $this->options = array();
        foreach ($this->formFields as $field => $value) {
            if ($instance[$field]) {
                $this->options[$field] = $instance[$field];
            } else {
                $this->options[$field] = $value;
            }
        }
        
        echo '<li id="' . $this->cssId . '" class="widget-container">';
        echo '<h3 class="widget-title">' . $this->options['title'] . '</h3>';
        echo $this->renderTemplate();
        echo '</li>';
    }
    
    function form($instance)
    {
        foreach ($this->formFields as $field => $value) {
            $value = esc_attr($instance[$field]);
            if (!$value) {
                $value = $this->formFields[$field];
            }
            $this->formFields[$field] = $value;
            $fieldId = $this->get_field_id($field);
            $fieldName = $this->get_field_name($field);
            echo '<p><label for="' . $fieldId . '">'
               . $this->labels[$field] . ': <input class="widefat" id="' . $fieldId 
               . '" name="' . $fieldName . '" type="text" value="' 
               . $value . '" /></label></p>';
        }
    }
}

}
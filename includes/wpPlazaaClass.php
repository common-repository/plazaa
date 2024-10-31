<?php

require(dirname(__FILE__) . '/wpPlazaaApiClass.php');

class wpPlazaaClass
{
    protected $plazaaUsername;
    protected $plazaaUsernameTested;
    protected $plazaaUsernameOk;
    protected $CacheTimeout;

    protected $Api;
    
    public function __construct()
    {   
        $this->Api = new wpPlazaaApiClass;
    }
    
    public function setupSettingsMenu()
    {        
        add_options_page('Plazaa', 'Plazaa', 'manage_options', 'plazaa-settings', array($this, 'pluginOptions'));
    }

    public function pluginOptions()
    {

        if (!current_user_can('manage_options'))  {
            wp_die( __('You do not have sufficient permissions to access this page.') );
        }

        include(dirname(__FILE__) . '/../templates/options.php');
    }
    
    public function registerSettings()
    {
        register_setting('generalGroup', 'plazaaUsername', array($this, 'sanitizeUsername'));
        register_setting('generalGroup', 'plazaaCacheTimeout', intval);
        register_setting('generalGroup', 'plazaaNoCss', intval);        
    }
    
    public function sanitizeUsername($value)
    {
        return strtolower($value);
    }
    
    protected function testUsername()
    {
        $response = $this->Api->makeApiRequest('users/detail/userName:' . $this->plazaaUsername);
        update_option('plazaaUsernameTested', $this->plazaaUsername);
        
        return $response;
    }    
}

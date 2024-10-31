<?php
$this->plazaaUsernameOk = get_option('plazaaUsernameOk');
$this->plazaaUsername = get_option('plazaaUsername');
$this->plazaaNoCss = get_option('plazaaNoCss');

$this->plazaaUsernameTested = get_option('plazaaUsernameTested');
if ($this->plazaaUsernameTested != $this->plazaaUsername) {
    $testResult = $this->testUsername();
    if ($testResult['status'] == 27) {
        update_option('plazaaUsernameOk', false);
        $this->plazaaUsernameOk = false;
        ?><div id="message" class="error fade"><p><strong><?php _e('Der Benutzername ist nicht vergeben!'); ?></strong></p></div>
    <?php } else if ($testResult['status'] == 0 && $testResult['data']['maySeeAllData'] == false) {
        update_option('plazaaUsernameOk', false);
        $this->plazaaUsernameOk = false;
        ?><div id="message" class="error fade"><p><strong><?php _e('Das Benutzerprofil ist geschützt und kann deshalb im Moment leider nicht benutzt werden :('); ?></strong></p></div>
    <?php } else if ($testResult['status'] == 0) {
        update_option('plazaaUsernameOk', true);
        $this->plazaaUsernameOk = true;
        ?><div id="message" class="updated fade"><p><strong><?php _e('Der Benutzername konnte erfolgreich geprüft werden.'); ?>.<br>Richte jetzt deine <strong><a href="<?php echo $url = admin_url(); ?>widgets.php">Widgets</a></strong> ein.</strong></p></div>
    <?php } else {
        update_option('plazaaUsernameOk', false);
        $this->plazaaUsernameOk = false;
        ?><div id="message" class="error fade"><p><strong><?php _e('Beim Prüfen des Benutzernamens ist ein unbekannter Fehler aufgetreten!'); ?></strong></p></div>
    <?php }
}

if (!$this->plazaaUsernameOk) { ?>
    <div id="message" class="updated fade"><p><strong><?php _e('Gib bitte einen gültigen, öffentlichen Plazaa-Benutzernamen ein.'); ?></strong></p></div>
<?php }

$this->cacheTimeout = (int)get_option('plazaaCacheTimeout');
if (!$this->cacheTimeout || $this->cacheTimeout < 1) {
    $this->cacheTimeout = 1;
    ?><div id="message" class="error fade"><p><strong><?php _e('Die Cache-Zeit muss bei mindestens 1 Stunde liegen.'); ?></strong></p></div>
<?php } 
?>
        <div style="width:150px; position:absolute; right:20px; top:100px; background-color: #fff; border: 1px solid #ddd; padding:10px; border-radius:5px; -moz-border-radius: 5px;">
    	<ul>
    		<li><a href="http://plazaa.de">plazaa.de</a></li>
    		<li><a href="http://plazaa.de/iphone/">plazaa iPhone App</a></li>
    		<li><a href="https://twitter.com/plazaaDE">plazaa auf Twitter</a></li>
    	</ul>
    	<iframe src="http://www.facebook.com/plugins/like.php?app_id=211193435567529&amp;href=http%3A%2F%2Fwww.facebook.com%2FplazaaDE&amp;send=false&amp;layout=button_count&amp;width=150&amp;show_faces=false&amp;action=like&amp;colorscheme=light&amp;font&amp;height=21" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:150px; height:21px;" allowTransparency="true"></iframe>
    </div>
<div class="wrap" style="width:650px;">
    <h2>Plazaa für WordPress</h2>
    
    <p>
        Plazaa für WordPress ist ein Plugin, mit dem du deine zuletzt bewerteten Locations von 
        <a href="http://plazaa.de/">Plazaa.de</a> auf deinem Blog darstellen kannst.
    </p>

    <h3><?php _e('Einstellungen'); ?></h3>
    <form method="post" action="options.php">
        <?php wp_nonce_field('update-options'); ?>
        <?php settings_fields('generalGroup'); ?>
        <table class="form-table">
            <tr valign="top">
                <th scope="row">Plazaa-Benutzername</th>
                <td>
                    <input type="text" name="plazaaUsername" value="<?php echo $this->plazaaUsername; ?>" />
                </td>
            </tr>
            <tr valign="top">
                <th scope="row">Cache-Timeout in Stunden</th>
                <td>
                    <input type="text" name="plazaaCacheTimeout" value="<?php echo $this->cacheTimeout; ?>" />
                </td>
            </tr>
             <tr valign="top">
                    <td colspan="2">
                        <p>&nbsp;</p>
                    </td>
                </tr>
            <tr valign="top">
                <th scope="row">Plazaa-CSS nicht verwenden</th>
                <td>
                    <input type="hidden" name="plazaaNoCss" value="0" />
                    <input type="checkbox" name="plazaaNoCss" value="1"
                        <?php if ($this->plazaaNoCss) { echo ' checked="checked'; } ?>" 
                    />
                </td>
            </tr>
            <tr valign="top">
                <td colspan="2">
                    <p class="description">Schalte das bitte nur aus, wenn du weißt, was Du tust!</p>
                </td>
            </tr>
        </table>
        <p class="submit">
            <input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>" />
        </p>
    </form>
    <?php if ($this->plazaaUsernameOk) { ?>
        <p style="background-color:#fff; padding:10px; -moz-border-radius: 10px; border-radius: 10px;">Du kannst nun in den Design-Einstellungen unter <strong><a class="button-primary" href="<?php echo $url = admin_url(); ?>widgets.php">Widgets</a></strong> zwischen 3 tollen Plazaa-Widgets wählen.</p>
    <?php } ?>
</div>
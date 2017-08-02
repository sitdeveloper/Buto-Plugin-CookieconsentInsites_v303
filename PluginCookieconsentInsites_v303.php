<?php
/**
<p>
Cookie Consent.
</p>
<p>A JavaScript plugin for alerting users about the use of cookies developed by Insites.</p>
<p>
Visit <a href="https://cookieconsent.insites.com/" target="_blank">cookieconsent.insites.com</a> for more info.
</p>
 */
class PluginCookieconsentInsites_v303{
  /**
  <p>
  Include this in header section. When user click button to accept cookies a cookie named as cookieconsent_status is set and thereafter the user should not se any information about cookies anymore. The widget will not even be render then.
  </p>
  <p>
  Go to https://cookieconsent.insites.com/download/ for check out more settings involved in this library.
  </p>
  */
  public static function widget_include($data){
    wfPlugin::includeonce('wf/array');
    /**
     * Get user cookies.
     */
    $cookie = new PluginWfArray($_COOKIE);
    /**
     * Create element array.
     */
    $element = array();
    if($cookie->get('cookieconsent_status') == 'dismiss'){
      /**
       User has the cookie and we will not even render any script.
       */
    }else{
      /**
        We will run the script and show cookie information to user.
       */
      $element[] = wfDocument::createHtmlElement('link', null,   array('href' => '/plugin/cookieconsent/insites_v303/cookieconsent.min.css', 'type' => 'text/css', 'rel' => 'stylesheet'));
      $element[] = wfDocument::createHtmlElement('script', null, array('src' =>  '/plugin/cookieconsent/insites_v303/cookieconsent.min.js',  'type' => "text/javascript"));
      $data = new PluginWfArray($data);
      $json = json_encode($data->get('data/json'));
      $script = 'window.addEventListener("load", function(){window.cookieconsent.initialise('.$json.')});';
      $element[] = wfDocument::createHtmlElement('script', $script, array('type' => 'text/javascript'));
    }
    /**
     * Render widget.
     */
    wfDocument::renderElement($element);
  }
}
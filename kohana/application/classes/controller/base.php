<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Controller_Base extends Controller_Template {

    public $template = 'application/template';
    public $session = null;
    public $accountutils;

    /**
     * The before() method is called before your controller action.
     * In our template controller we override this method so that we can
     * set up default values. These variables are then available to our
     * controllers if they need to be modified.
     */
    public function before() {        
        parent::before();
        $this->session = Session::instance();
        $this->accountutils = new accountutils();
        $this->logged_in = $this->session->get("authorized", false);
        $this->logged_user = $this->session->get("user", null);
        
        if ($this->auto_render) {
            // Initialize empty values
            $this->template->title = '';
            $this->template->content = '';

            $this->template->styles = array();
            $this->template->scripts = array();
        }
    }

    /**
     * The after() method is called after your controller action.
     * In our template controller we override this method so that we can
     * make any last minute modifications to the template before anything
     * is rendered.
     */
    public function after() {
        if ($this->auto_render) {
            $styles = array(
                'media/css/screen.css' => 'screen, projection',
                'media/css/print.css' => 'print',
                'media/css/style.css' => 'screen',
                'media/external/jqui_smoothness/jquery-ui-1.8.2.custom.css' => 'screen',
            );

            $scripts = array(
                'http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js',
                'http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.2/jquery-ui.min.js',
                'media/js/utils.js',
            );
            $this->template->user = $this->logged_user;
            $this->template->styles = array_merge($this->template->styles, $styles);
            $this->template->scripts = array_merge($this->template->scripts, $scripts);
            $this->template->messages = $this->session->get("messages", array());
            $this->template->form_errors = $this->session->get("form_errors", array());
            $this->session->set("messages", array());
                      $this->session->set("form_errors", array());

        }
        //todo if Ajax Header then echo $this->template->content and not the entire template
        parent::after();
    }

    protected function add_message($message, $type) {
        $messages = $this->session->get("messages", Array());
        $form_errors = $this->session->get("form_errors", array());
        if ($type != "form-errors") {
            if (!isset($messages[$type])) {
                $messages[$type] = Array();
            }
            $messages[$type][] = $message;
            $this->session->set("messages", $messages);
        } else {
            $form_errors[] = $message;
             $this->session->set("form_errors", $form_errors);
        }
    }

}
?>

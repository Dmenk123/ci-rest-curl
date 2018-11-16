<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
//require(APPPATH.'../vendor/chriskacerguis/codeigniter-restserver/applications/libraries/REST_Controller.php');
//use Restserver\Libraries\REST_Controller;
//karena mewarisi rest_controller pada vendor, maka pada config disetting $config['composer_autoload'] = realpath(APPPATH . '../vendor/autoload.php'); agar dapat otomatis mewarisi pada path vendor
class Example_api extends REST_Controller 
{
 
    function user_get()
    {
        $data = array('returned: '. $this->get('id'));
        $this->response($data);
    }
     
    function user_post()
    {       
        $data = array('returned: '. $this->post('id'));
        $this->response($data);
    }
 
    function user_put()
    {       
        $data = array('returned: '. $this->put('id'));
        $this->response($data);
    }
 
    function user_delete()
    {
        $data = array('returned: '. $this->delete('id'));
        $this->response($data);
    }
}
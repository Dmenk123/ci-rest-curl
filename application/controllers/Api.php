<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
//require(APPPATH.'../vendor/chriskacerguis/codeigniter-restserver/applications/libraries/REST_Controller.php');
//use Restserver\Libraries\REST_Controller;
//karena mewarisi rest_controller pada vendor, maka pada config disetting $config['composer_autoload'] = realpath(APPPATH . '../vendor/autoload.php'); agar dapat otomatis mewarisi pada path vendor
class Api extends REST_Controller 
{
    private $rest_config;

    public function __construct()
    {
        parent::__construct();
        $this->load->model('user_model');
        //array data user & password auth
        $auth_data = [
            'dmenk123' => '1234',
            'test123' => '1234',
            'admin123' => '1234',
        ];
        //load config file & overwrite config item
        $this->config->load('rest', TRUE);
        //$this->config->item('rest_valid_logins');
        //$this->config->set_item('rest_valid_logins', $auth_data);
        $this->config->set_item('rest_valid_logins', array_merge(
            $this->config->item('rest_valid_logins'), $auth_data
        ));
        $this->rest_config = $this->config->item('rest_valid_logins');
    }

    function users_get()
    {
        $users = $this->user_model->get_all();
         
        if($users)
        {
            print_r($this->rest_config);
            $this->response($users, 200);
        }
 
        else
        {
            $this->response(NULL, 404);
        }
    }

    function user_get()
    {
        if(!$this->get('id'))
        {
            $this->response(NULL, 400);
        }
 
        $user = $this->user_model->get( $this->get('id') );
         
        if($user)
        {
            //var_dump($this->rest_config);
            $this->response($user, 200); // 200 being the HTTP response code
        }
 
        else
        {
            $this->response(NULL, 404);
        }
    }
     
    function user_post()
    {
        $data = array(
            'name' => $this->post('name'),
            'address' => $this->post('address'),
            'phone' => $this->post('phone')
        );

        $result = $this->user_model->insert($data);
         
        if($result === FALSE)
        {
            $this->response(array('status' => 'failed'));
        }
         
        else
        {
            $this->response(array('status' => 'success'));
        }  
    }

    function user_put()
    {
        $result = $this->user_model->update( $this->put('id'), array(
            'name' => $this->put('name'),
            'address' => $this->put('address'),
            'phone' => $this->put('phone')
        ));
         
        if($result === FALSE)
        {
            $this->response(array('status' => 'failed'));
        }
        else
        {
            $this->response(array('status' => 'success'));
        }  
    }

    public function user_delete()
    {
        if(!$this->get('id'))
        {
            $this->response(NULL, 400);
        }

        $result = $this->user_model->delete($this->get('id'));
         
        if($result === FALSE)
        {
            $this->response(array('status' => 'failed'));
        }
        else
        {
            $this->response(array('status' => 'success'));
        }
    }
}
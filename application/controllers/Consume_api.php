<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Consume_api extends CI_controller
{	
	private $username = 'admin';
	private $password = '12345';

	function __construct()
	{
		parent::__construct();
	}

	public function cek_base_url()
	{
		$url = base_url('/api/user/post/format/json');
		echo $url;
	}

	function get_users_native_curl()
	{ 
	    // Alternative JSON version
	    // $url = 'http://twitter.com/statuses/update.json';
	    // Set up and execute the curl process
	    $url = base_url('/api/users');
	    $ch = curl_init();
	    // curl_setopt($ch, CURLOPT_URL, 'http://localhost/restserver/index.php/example_api/user/id/1/format/json');
	    curl_setopt($ch, CURLOPT_URL, $url);
	    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
	    // Optional, delete this line if your API is open
	    curl_setopt($ch, CURLOPT_USERPWD, $this->username . ':' . $this->password);
	     
	    $buffer = curl_exec($ch);
	    curl_close($ch);
	    
	    //menerjemahkan string JSON. Dengan kata lain, mengubah string JSON menjadi variabel PHP.
	    $result = json_decode($buffer, true);
	 	
	    if(isset($result->status) && $result->status != 'success')
	    {
	        echo 'Terjadi Kesalahan : '.$result->error;
	    }
	    else
	    {
	    	echo json_encode($result);
	    }
	}

	function get_user_native_curl($id)
	{
	    // Set up and execute the curl process
	    $url = base_url('/api/user/id/'.$id);
	    $ch = curl_init();
	    // curl_setopt($ch, CURLOPT_URL, 'http://localhost/restserver/index.php/example_api/user/id/1/format/json');
	    curl_setopt($ch, CURLOPT_URL, $url);
	    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
	    // Optional, delete this line if your API is open
	    curl_setopt($ch, CURLOPT_USERPWD, $this->username . ':' . $this->password);
	     
	    $buffer = curl_exec($ch);
	    curl_close($ch);
	     
	    $result = json_decode($buffer, true);
	 	if(isset($result->status) && $result->status != 'success')
	    {
	        echo 'Terjadi Kesalahan : '.$result->error;
	    }
	    else
	    {
	    	echo json_encode($result);
	    }
	}

	function post_native_curl($new_name, $new_address, $new_phone)
	{
		$data = array(
	    	'name' => $new_name,
	    	'address' => $new_address,
	    	'phone' => $new_phone,
	    );
	    $data_json = json_encode($data);
	    // Set up and execute the curl process
	    $url = base_url('/api/user');
	    $ch = curl_init();
	    curl_setopt($ch, CURLOPT_URL, $url);
	    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json','Content-Length: '.strlen($data_json)));
	    //if using http request method post
	    curl_setopt($ch, CURLOPT_POST, TRUE);
	    curl_setopt($ch, CURLOPT_POSTFIELDS, $data_json);
	    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
	     
	    // Optional, delete this line if your API is open
	    curl_setopt($ch, CURLOPT_USERPWD, $this->username . ':' . $this->password);
	     
	    $buffer = curl_exec($ch);
	    curl_close($ch);
	     
	    //var_dump($buffer);
	    $result = json_decode($buffer);
	 
	    if(isset($result->status) && $result->status != 'success')
	    {
	        echo 'Terjadi Kesalahan : '.$result->error;
	    }
	    else
	    {
	    	echo json_encode($result);
	    }
	}

	function update_native_curl($id, $new_name, $new_address, $new_phone)
	{
	    $data = array(
	    	'id' => $id,
	    	'name' => $new_name,
	    	'address' => $new_address,
	    	'phone' => $new_phone,
	    );
	    $data_json = json_encode($data);

	    // Set up and execute the curl process
	    $url = base_url('/api/user');
	    $ch = curl_init();
	    curl_setopt($ch, CURLOPT_URL, $url);
	    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json','Content-Length: '.strlen($data_json)));
	    //if using http request method put
	    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
	    curl_setopt($ch, CURLOPT_POSTFIELDS, $data_json);
	    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
	     
	    // Optional, delete this line if your API is open
	    curl_setopt($ch, CURLOPT_USERPWD, $this->username . ':' . $this->password);
	     
	    $buffer = curl_exec($ch);
	    curl_close($ch);
	     
	    //var_dump($buffer);
	    $result = json_decode($buffer);
	 
	    if(isset($result->status) && $result->status != 'success')
	    {
	        echo 'Terjadi Kesalahan : '.$result->error;
	    }
	    else
	    {
	    	echo json_encode($result);
	    }
	}

	function delete_native_curl($id)
	{
	    // Set up and execute the curl process
	    $url = base_url('/api/user/id/'.$id);
	    $ch = curl_init();
	    curl_setopt($ch, CURLOPT_URL, $url);
		//if using http request method delete
	    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE');
	    //curl_setopt($ch, CURLOPT_POSTFIELDS, $data_json);
	    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
	     
	    // Optional, delete this line if your API is open
	    curl_setopt($ch, CURLOPT_USERPWD, $this->username . ':' . $this->password);
	     
	    $buffer = curl_exec($ch);
	    curl_close($ch);
	     
	    //var_dump($buffer);
	    $result = json_decode($buffer);
	 
	    if(isset($result->status) && $result->status != 'success')
	    {
	        echo 'Terjadi Kesalahan : '.$result->error;
	    }
	    else
	    {
	    	echo json_encode($result);
	    }
	}
}

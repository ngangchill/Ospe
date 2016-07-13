<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
 
class Xmlrpc_server extends MX_Controller
{
	protected $client_auth_key = 'cLiEnTaUtHkEy'; // Public STATIC
	protected $client_encyption_key = 'cLiEnTeNcRyPtIoNkEy'; // Hidden STATIC
	protected $client_secret_key = 'cLiEnTsEcReTkEy'; // Hidden+Encrypted STATIC
 
	protected $server_master_encyption_key = 'sErVeRmAsTeReNcRyPtIoNkEy'; // Hidden - CLIENT SHOULD NOT KNOW THIS
	protected $server_master_secret_key = 'sErVeRmAsTeRsEcReTkEy'; // Hidden+Encrypted - CLIENT SHOULD NOT KNOW THIS
 
	protected $server_auth_key = 'sErVeRaUtHkEy'; // Public STATIC
	protected $server_encyption_key = 'sErVeReNcRyPtIoNkEy'; // Hidden STATIC
	protected $server_secret_key = 'sErVeRsEcReTkEy'; // Hidden+Encrypted
 
	protected $client_check_server_url = 'http://www.exoiz.com/xmlrpc_client/client_check_server';
	protected $client_notification_url = 'http://www.exoiz.com/xmlrpc_client/client_notification';
 
	public function __construct()
	{
		parent::__construct();
		$this->load->library('xmlrpc');
		$this->load->library('xmlrpcs');
		// $this->xmlrpc->set_debug(TRUE);
	}
 
	private function encrypt($str,$pw,$base64='1')
	{
		$encr = array();
		if (is_array($str)){
			$str = base64_encode(json_encode($str));
		}
		$input = 'TRUE'.$str;
		$key2 = 'eNcRyPtFuNcTiOnKeY2';
		$length = strlen($str);
		$td = mcrypt_module_open('rijndael-256','','cbc','');
		$iv = mcrypt_create_iv(mcrypt_enc_get_iv_size($td),MCRYPT_RAND);
		$ks = mcrypt_enc_get_key_size($td);
		$pw = md5($pw);
		$key2 = md5($key2);
		$key = substr($pw,0,$ks/2).substr(strtoupper($key2),(round(strlen($key2)/2)),$ks/2);
		$key = substr($key.$pw.$key2.strtoupper($pw),0,$ks);
		mcrypt_generic_init($td,$key,$iv);
		$encrypted = mcrypt_generic($td, $input);
		mcrypt_generic_deinit($td);
		mcrypt_module_close($td);
		$encr['length'] = $length;
		if ($base64=='1'){
			$encr['iv'] = base64_encode($iv);
			$encr['data'] = base64_encode($encrypted);
			return $encr;
		}
		$encr['iv'] = $iv;
		$encr['data'] = $encrypted;
		return $encr;
	}
 
	private function decrypt($encrypted,$pw,$iv,$length='0',$array='1',$base64='1')
	{
		if ($base64=='1'){
			$iv = base64_decode($iv);
			$encrypted = base64_decode($encrypted);
		}
		$key2 = 'eNcRyPtFuNcTiOnKeY2';
		$td = mcrypt_module_open('rijndael-256','','cbc','');
		$ks = mcrypt_enc_get_key_size($td);
		$pw = md5($pw);
		$key2 = md5($key2);
		$key = substr($pw,0,$ks/2).substr(strtoupper($key2),(round(strlen($key2)/2)),$ks/2);
		$key = substr($key.$pw.$key2.strtoupper($pw),0,$ks);
		mcrypt_generic_init($td,$key,$iv);
		$decrypted = mdecrypt_generic($td,$encrypted);
		mcrypt_generic_deinit($td);
		mcrypt_module_close($td);
		if (strpos($decrypted,'TRUE')===0){
			$decrypted = substr($decrypted,4);
			if ($length=='0'){
				$decrypted = rtrim($decrypted,"\0");
				if ($array=='1'){
					$decrypted = json_decode(base64_decode($decrypted),TRUE);
				}
			}
			$decrypted = substr($decrypted,0,$length);
			if ($array=='1'){
				$decrypted = json_decode(base64_decode($decrypted),TRUE);
			}
			return $decrypted;
		}
		return FALSE;
	}
 
	private function generate_server_session_key($client_session_key='')
	{
		return '_'.$client_session_key;
	}
 
	private function check_server_session_key($server_session_key,$client_session_key)
	{
		if (substr($server_session_key,1)==$client_session_key){
			return TRUE;
		}
		return FALSE;
	}
 
	private function save_client_data($client_data)
	{
		return TRUE;
	}
 
	public function server_check_client(){
		$config['functions']['server_check_client'] = array('function' => 'Xmlrpc_server.server_check_client_process');
		$config['object'] = $this;
		$this->xmlrpcs->initialize($config);
		$this->xmlrpcs->serve();
	}
 
	public function server_check_client_process($request)
	{
		$parameters = $request->output_parameters();
		$client_auth_key = $parameters['0'];
		$client_encrypted_data = json_decode(base64_decode($parameters['1']),TRUE);
 
		if ($client_auth_key==$this->client_auth_key){ // Client has used the correct client public key
			$client_decrypted_data = $this->decrypt($client_encrypted_data['data'],$this->client_encyption_key,$client_encrypted_data['iv'],$client_encrypted_data['length']); // Decrypt $client_encrypted_data using $client_encyption_key
			if ($client_decrypted_data['client_secret_key']==$this->client_secret_key){ // Client is confirmed
				if ($client_decrypted_data['client_session_key']!=''){ // Client has included the client session key
					$client_session_key = $client_decrypted_data['client_session_key'];
					$server_session_key = $this->generate_server_session_key($client_session_key); // Generate server session key based on the client session key
 
					/* ONLY TO BE DECRYPTED BY THE SERVER */
					$hidden_data_to_encrypt = array();
					$hidden_data_to_encrypt['server_session_key'] 		= $server_session_key;
					$hidden_data_to_encrypt['server_master_secret_key'] = $this->server_master_secret_key;
					$hidden_server_encrypted_data = base64_encode(json_encode($this->encrypt($hidden_data_to_encrypt,$this->server_master_encyption_key))); // Encrypt $server_session_key and $server_master_secret_key using $server_master_encyption_key
 
					/* TO VALIDATE THE CLIENT IS CONNECTNG TO THE CORRECT SERVER */
					$data_to_encrypt = array();
					$data_to_encrypt['client_session_key'] 				= $client_session_key;
					$data_to_encrypt['server_secret_key'] 				= $this->server_secret_key;
					$data_to_encrypt['hidden_server_encrypted_data'] 	= $hidden_server_encrypted_data;
					$server_encrypted_data = base64_encode(json_encode($this->encrypt($data_to_encrypt,$this->server_encyption_key))); // Encrypt $client_session_key, $server_secret_key and $hidden_server_encrypted_data using $server_encyption_key
 
					// post(array('server_auth_key'=>$server_auth_key,'server_encrypted_data'=>$server_encrypted_data),$client_check_server_url); // Connect to the client to validate server is correct
 
					$this->xmlrpc->server($this->client_check_server_url, 80);
					$this->xmlrpc->method('client_check_server');
					$request_c = array(
					        array($this->server_auth_key, 'string'),
					        array($server_encrypted_data, 'base64')
					);
					$this->xmlrpc->request($request_c);
					if (!$this->xmlrpc->send_request()){
						// echo $this->xmlrpc->display_error();
						$parameters = $request->output_parameters();
						/* DEBUG START */
						// $response = array(
						// 				array(
						// 					'client_auth_key'  => $parameters['0'],
						// 					'client_encrypted_data' => $parameters['1'],
						// 					'client_check_server_error' => $this->xmlrpc->display_error()),
						// 					'struct');
						/* DEBUG END */
						$response = array(array('server_check_client'  => 'OK','client_check_server_error' => $this->xmlrpc->display_error()),'struct');
						return $this->xmlrpc->send_response($response);
					}else{
						// echo '<pre>';
						// print_r($this->xmlrpc->display_response());
						// echo '</pre>';
						$parameters = $request->output_parameters();
						/* DEBUG START */
						// $response = array(
						// 				array(
						// 					'client_auth_key'  => $parameters['0'],
						// 					'client_encrypted_data' => $parameters['1'],
						// 					'client_check_server_response' => json_encode($this->xmlrpc->display_response())),
						// 					'struct');
						/* DEBUG END */
						$response = array(array('server_check_client'  => 'OK','client_check_server_response' => json_encode($this->xmlrpc->display_response())),'struct');
						return $this->xmlrpc->send_response($response);
					}
 
					/* JUMP TO check_server on the client */
				}else{
					$response = array(array('server_check_client' => 'No client session key.'),'struct');
					return $this->xmlrpc->send_response($response);	
				}
			}else{
				$response = array(array('server_check_client' => 'Invalid client key.'),'struct');
				return $this->xmlrpc->send_response($response);	
			}
		}else{
			$response = array(array('server_check_client' => 'Invalid auth key.'),'struct');
			return $this->xmlrpc->send_response($response);	
		}
	}
 
	public function server_receive_data()
	{
		$config['functions']['server_receive_data'] = array('function' => 'Xmlrpc_server.server_receive_data_process');
		$config['object'] = $this;
		$this->xmlrpcs->initialize($config);
		$this->xmlrpcs->serve();
	}
 
	public function server_receive_data_process($request)
	{
		$parameters = $request->output_parameters();
		$client_auth_key = $parameters['0'];
		$client_encrypted_data = json_decode(base64_decode($parameters['1']),TRUE);
 
		if ($client_auth_key==$this->client_auth_key){ // Client has used the correct client public key
			$client_decrypted_data = $this->decrypt($client_encrypted_data['data'],$this->client_encyption_key,$client_encrypted_data['iv'],$client_encrypted_data['length']); // Decrypt $client_encrypted_data using $client_encyption_key
			if ($client_decrypted_data['client_secret_key']==$this->client_secret_key){ // Client is confirmed
				if ($client_decrypted_data['hidden_server_encrypted_data']!=''){ // Client has included the hidden_server_encrypted_data
					$hidden_server_encrypted_data = json_decode(base64_decode($client_decrypted_data['hidden_server_encrypted_data']),TRUE);
					$hidden_server_decrypted_data = $this->decrypt($hidden_server_encrypted_data['data'],$this->server_master_encyption_key,$hidden_server_encrypted_data['iv'],$hidden_server_encrypted_data['length']); // Decrypt $hidden_server_encrypted_data using $server_master_encyption_key
					if ($hidden_server_decrypted_data['server_master_secret_key']==$this->server_master_secret_key){ // Confirmation that the response has came via this server
						$server_session_key = $hidden_server_decrypted_data['server_session_key'];
						if ($this->check_server_session_key($server_session_key,$client_decrypted_data['client_session_key'])){ // Server has confirmed a valid server session key
							$client_session_key = $client_decrypted_data['client_session_key'];
 
							// We're in and can confirm that the data has been authenticated
							$this->save_client_data($client_decrypted_data['client_data']); // We can now save the highly sensitve information
 
							/* THIS SESSION HAS BEEN CONFIRMED, AND DEALT WITH NOW WE CAN FINALLY SEND THE SUCCESS RESPONSE TO THE CLIENT... DOUBLE YEY! */
							$server_data = 'We can confirm that we have received your highly sensitive information.';
 
							/* Finally encrypt data to send a success notification to client */
							$data_to_encrypt = array();
							$data_to_encrypt['client_session_key'] 	= $client_session_key;
							$data_to_encrypt['server_secret_key'] 	= $this->server_secret_key;
							$data_to_encrypt['server_data'] 		= $server_data;
							$server_encrypted_data = base64_encode(json_encode($this->encrypt($data_to_encrypt,$this->server_encyption_key))); // Encrypt $client_session_key, $server_secret_key using $server_encyption_key
 
							// post(array('server_auth_key'=>$server_auth_key,'server_encrypted_data'=>$server_encrypted_data),$client_notification_url); // Connect to the client to validate server is correct
 
							$this->xmlrpc->server($this->client_notification_url, 80);
							$this->xmlrpc->method('client_notification');
							$request_c = array(
							        array($this->server_auth_key, 'string'),
							        array($server_encrypted_data, 'base64')
							);
							$this->xmlrpc->request($request_c);
							if (!$this->xmlrpc->send_request()){
								// echo $this->xmlrpc->display_error();
								$parameters = $request->output_parameters();
								/* DEBUG START */
								// $response = array(
								// 				array(
								// 					'client_auth_key'  => $parameters['0'],
								// 					'client_encrypted_data' => $parameters['1'],
								// 					'client_notification_error' => $this->xmlrpc->display_error()),
								// 					'struct');
								/* DEBUG END */
								$response = array(array('server_receive_data'  => 'OK','client_notification_error' => $this->xmlrpc->display_error()),'struct');
								return $this->xmlrpc->send_response($response);
							}else{
								// echo '<pre>';
								// print_r($this->xmlrpc->display_response());
								// echo '</pre>';
								$parameters = $request->output_parameters();
								/* DEBUG START */
								// $response = array(
								// 				array(
								// 					'client_auth_key'  => $parameters['0'],
								// 					'client_encrypted_data' => $parameters['1'],
								// 					'client_notification_response' => json_encode($this->xmlrpc->display_response())),
								// 					'struct');
								/* DEBUG END */
								$response = array(array('server_receive_data'  => 'OK','client_notification_response' => json_encode($this->xmlrpc->display_response())),'struct');
								return $this->xmlrpc->send_response($response);
							}
 
							/* JUMP TO notification on the client */
						}else{
							$response = array(array('client_check_server' => 'Invalid server session key.'),'struct');
							return $this->xmlrpc->send_response($response);
						}
					}else{
						$response = array(array('client_check_server' => 'Invalid server master secret key.'),'struct');
						return $this->xmlrpc->send_response($response);
					}
				}else{
					$response = array(array('server_check_client' => 'No server encrypted data.'),'struct');
					return $this->xmlrpc->send_response($response);
				}
			}else{
				$response = array(array('server_check_client' => 'Invalid client key.'),'struct');
				return $this->xmlrpc->send_response($response);
			}
		}else{
			$response = array(array('server_check_client' => 'Invalid auth key.'),'struct');
			return $this->xmlrpc->send_response($response);	
		}
	}
 
}
 
/* End of file Xmlrpc.php */
/* Location: ./application/controllers/Xmlrpc.php */
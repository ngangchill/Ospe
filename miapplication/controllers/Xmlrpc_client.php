<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
 
class Xmlrpc_client extends MX_Controller
{
	protected $client_auth_key = 'cLiEnTaUtHkEy'; // Public STATIC
	protected $client_encyption_key = 'cLiEnTeNcRyPtIoNkEy'; // Hidden STATIC
	protected $client_secret_key = 'cLiEnTsEcReTkEy'; // Hidden+Encrypted STATIC
 
	protected $server_auth_key = 'sErVeRaUtHkEy'; // Public STATIC
	protected $server_encyption_key = 'sErVeReNcRyPtIoNkEy'; // Hidden STATIC
	protected $server_secret_key = 'sErVeRsEcReTkEy'; // Hidden+Encrypted
 
	protected $server_check_client_url = 'http://www.exoiz.com/xmlrpc_server/server_check_client'; // URL to initially check client and server
	protected $server_receive_data_url = 'http://www.exoiz.com/xmlrpc_server/server_receive_data'; // URL to send the client data to the server
 
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
 
	private function check_client_session_key($client_session_key='')
	{
		if ($client_session_key=='abc'){
			return TRUE;
		}
		return FALSE;
	}
 
	private function save_server_data($server_data)
	{
		return TRUE;
	}
 
	public function index()
	{
		$str = 'Test encrypt and decrypt functions.';
		$pw = 'pAsSwOrD';
		$encrypted = $this->encrypt($str,$pw);
		echo $this->decrypt($encrypted['data'],$pw,$encrypted['iv'],$encrypted['length'],'0');
	}
 
	public function initiate_transfer($client_session_key='abc') // $client_session_key DYNAMIC - Created by client and should be unique per transfer and stored for the return check
	{
 
		$data_to_encrypt = array();
		$data_to_encrypt['client_session_key'] 	= $client_session_key;
		$data_to_encrypt['client_secret_key'] 	= $this->client_secret_key;
 
		$client_encrypted_data = base64_encode(json_encode($this->encrypt($data_to_encrypt,$this->client_encyption_key))); // Encrypt $client_session_key and $client_secret_key using $client_encyption_key
		// post(array('client_auth_key'=>$client_auth_key,'client_encrypted_data'=>$client_encrypted_data),$server_check_client_url); // Connect to the server for initial check
 
		// ---
		$this->xmlrpc->server($this->server_check_client_url, 80);
		$this->xmlrpc->method('server_check_client');
		$request_c = array(
		        array($this->client_auth_key, 'string'),
		        array($client_encrypted_data, 'base64')
		);
		$this->xmlrpc->request($request_c);
		$response_array = array();
		if (!$this->xmlrpc->send_request()){
			$send_status = 'FAILED';
		}else{
			$send_status = 'OK';
		}
 
		/* INITIATE TRANSFER */
		$response_array['initiate_transfer'] = 'OK';
		$response_array['initiate_transfer_error'] = '';
		$initiate_transfer_response = ($send_status=='OK'?$this->xmlrpc->display_response():array());
 
		/* SERVER CHECK CLIENT */
		$response_array['server_check_client'] = (isset($initiate_transfer_response['server_check_client'])?$initiate_transfer_response['server_check_client']:'FAILED');
		$response_array['server_check_client_error'] = ($send_status=='FAILED'?$this->xmlrpc->display_error():'');
		$client_check_server_response = (isset($initiate_transfer_response['client_check_server_response'])?json_decode($initiate_transfer_response['client_check_server_response'],TRUE):array('client_check_server'=>'FAILED'));
 
		/* CLIENT CHECK SERVER */
		$response_array['client_check_server'] = $client_check_server_response['client_check_server'];
		$response_array['client_check_server_error'] = (isset($initiate_transfer_response['client_check_server_error'])?$initiate_transfer_response['client_check_server_error']:'');
		$server_receive_data_response = (isset($client_check_server_response['server_receive_data_response'])?json_decode($client_check_server_response['server_receive_data_response'],TRUE):array('server_receive_data'=>'FAILED'));
 
		/* SERVER RECEIVE DATA */
		$response_array['server_receive_data'] = $server_receive_data_response['server_receive_data'];
		$response_array['server_receive_data_error'] = (isset($client_check_server_response['server_receive_data_error'])?$client_check_server_response['server_receive_data_error']:'');
		$client_notification_response = (isset($server_receive_data_response['client_notification_response'])?json_decode($server_receive_data_response['client_notification_response'],TRUE):array('client_notification'=>'FAILED'));
 
		/* CLIENT NOTIFICATION */
		$response_array['client_notification'] = $client_notification_response['client_notification'];
		$response_array['client_notification_error'] = (isset($server_receive_data_response['client_notification_error'])?$server_receive_data_response['client_notification_error']:'');
		$transfer_complete_response = (isset($client_notification_response['transfer_complete_response'])?json_decode($client_notification_response['transfer_complete_response'],TRUE):array('transfer_complete'=>'FAILED'));
 
		// Do something with the reponse...
		$response = json_encode($response_array);
 
		// For now just print_r it
		echo '<pre>'.print_r(json_decode($response,TRUE), true).'</pre>';
 
		// ---
 
		/* JUMP TO check_client on the server */
	}
 
	public function client_check_server()
	{
		$config['functions']['client_check_server'] = array('function' => 'Xmlrpc_client.client_check_server_process');
		$config['object'] = $this;
		$this->xmlrpcs->initialize($config);
		$this->xmlrpcs->serve();		
	}
 
	public function client_check_server_process($request)
	{
		$parameters = $request->output_parameters();
		$server_auth_key = $parameters['0'];
		$server_encrypted_data = json_decode(base64_decode($parameters['1']),TRUE);
 
		if ($server_auth_key==$this->server_auth_key){ // Server has used the correct server public key
			$server_decrypted_data = $this->decrypt($server_encrypted_data['data'],$this->server_encyption_key,$server_encrypted_data['iv'],$server_encrypted_data['length']); // Decrypt $server_encrypted_data using $server_encyption_key
			if ($server_decrypted_data['server_secret_key']==$this->server_secret_key){ // Server is confirmed
				if ($server_decrypted_data['client_session_key']!=''){ // Server has included the client session key
					$client_session_key = $server_decrypted_data['client_session_key'];
					if ($this->check_client_session_key($client_session_key)){ // Server has confirmed a valid client session key
 
						/* THIS SESSION HAS BEEN CONFIRMED, NOW WE CAN ACTUALLY SEND THE DATA TO THE SERVER... YEY! */
						$client_data = 'This is highly sensitive information that I only wish the correct server to receive.';
 
						$data_to_encrypt = array();
						$data_to_encrypt['client_session_key'] 				= $client_session_key;
						$data_to_encrypt['client_secret_key'] 				= $this->client_secret_key;
						$data_to_encrypt['client_data'] 					= $client_data;
						$data_to_encrypt['hidden_server_encrypted_data'] 	= $server_decrypted_data['hidden_server_encrypted_data'];
 
						$client_encrypted_data = base64_encode(json_encode($this->encrypt($data_to_encrypt,$this->client_encyption_key)));
 
						// post(array('client_auth_key'=>$client_auth_key,'client_encrypted_data'=>$client_encrypted_data),$server_receive_data_url); // Send sensitive data to the server
 
						$this->xmlrpc->server($this->server_receive_data_url, 80);
						$this->xmlrpc->method('server_receive_data');
						$request_c = array(
						        array($this->client_auth_key, 'string'),
						        array($client_encrypted_data, 'base64')
						);
						$this->xmlrpc->request($request_c);
						if (!$this->xmlrpc->send_request()){
							// echo $this->xmlrpc->display_error();
							$parameters = $request->output_parameters();
							/* DEBUG START */
							// $response = array(
							// 				array(
							// 					'server_auth_key'  => $parameters['0'],
							// 					'server_encrypted_data' => $parameters['1'],
							// 					'server_receive_data_error' => $this->xmlrpc->display_error()),
							// 					'struct');
							/* DEBUG END */
							$response = array(array('client_check_server' => 'OK','server_receive_data_error' => $this->xmlrpc->display_error()),'struct');
							return $this->xmlrpc->send_response($response);
						}else{
							// echo '<pre>';
							// print_r($this->xmlrpc->display_response());
							// echo '</pre>';
							$parameters = $request->output_parameters();
							/* DEBUG START */
							// $response = array(
							// 				array(
							// 					'server_auth_key'  => $parameters['0'],
							// 					'server_encrypted_data' => $parameters['1'],
							// 					'server_receive_data_response' => json_encode($this->xmlrpc->display_response())),
							// 					'struct');
							/* DEBUG END */
							$response = array(array('client_check_server'  => 'OK','server_receive_data_response' => json_encode($this->xmlrpc->display_response())),'struct');
							return $this->xmlrpc->send_response($response);
						}
 
						/* JUMP TO receive_data on the server */
					}else{
						$response = array(array('client_check_server' => 'Invalid client session key.'),'struct');
						return $this->xmlrpc->send_response($response);
					}
				}else{
					$response = array(array('client_check_server' => 'No client session key.'),'struct');
					return $this->xmlrpc->send_response($response);
				}
			}else{
				$response = array(array('client_check_server' => 'Invalid server key.'),'struct');
				return $this->xmlrpc->send_response($response);
			}
		}else{
			$response = array(array('client_check_server' => 'Invalid auth key.'),'struct');
			return $this->xmlrpc->send_response($response);
		}
 
	}
 
	public function client_notification()
	{
		$config['functions']['client_notification'] = array('function' => 'Xmlrpc_client.client_notification_process');
		$config['object'] = $this;
		$this->xmlrpcs->initialize($config);
		$this->xmlrpcs->serve();
	}
 
	public function client_notification_process($request)
	{
		$parameters = $request->output_parameters();
		$server_auth_key = $parameters['0'];
		$server_encrypted_data = json_decode(base64_decode($parameters['1']),TRUE);
 
		if ($server_auth_key==$this->server_auth_key){ // Server has used the correct server public key
			$server_decrypted_data = $this->decrypt($server_encrypted_data['data'],$this->server_encyption_key,$server_encrypted_data['iv'],$server_encrypted_data['length']); // Decrypt $server_encrypted_data using $server_encyption_key
			if ($server_decrypted_data['server_secret_key']==$this->server_secret_key){ // Server is confirmed
				if ($server_decrypted_data['client_session_key']!=''){ // Server has included the client session key
					$client_session_key = $server_decrypted_data['client_session_key'];
					if ($this->check_client_session_key($client_session_key)){ // Server has confirmed a valid client session key
 
						// The transaction has completed its path !!!
						$this->save_server_data($server_decrypted_data['server_data']); // We can now save the server notification information
 
						$parameters = $request->output_parameters();
						/* DEBUG START */
						// $response = array(
						// 				array(
						// 					'server_auth_key'  => $parameters['0'],
						// 					'server_encrypted_data' => $parameters['1'],
						// 					'client_notification' => 'THE END'),
						// 					'struct');
						/* DEBUG END */
						$response = array(array('client_notification'  => 'OK'),'struct');
						return $this->xmlrpc->send_response($response);
 
						/* THE END */
					}else{
						$response = array(array('client_notification' => 'Invalid client session key.'),'struct');
						return $this->xmlrpc->send_response($response);	
					}
				}else{
					$response = array(array('client_notification' => 'No client session key.'),'struct');
					return $this->xmlrpc->send_response($response);	
				}
			}else{
				$response = array(array('client_notification' => 'Invalid server key.'),'struct');
				return $this->xmlrpc->send_response($response);	
			}
		}else{
			$response = array(array('client_notification' => 'Invalid auth key.'),'struct');
			return $this->xmlrpc->send_response($response);
		}
	}
 
}
 
/* End of file Xmlrpc.php */
/* Location: ./application/controllers/Xmlrpc.php */
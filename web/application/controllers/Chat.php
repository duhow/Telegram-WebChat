<?php

class Chat extends CI_Controller {

	public function __construct(){
		parent::__construct();

		$this->load->config('telegram');
		if($this->config->item('telegram_bot_id') == 0){
			die("Please configure Telegram before running.");
		}

		$bot = [
			'id' => $this->config->item('telegram_bot_id'),
			'key' => $this->config->item('telegram_bot_key'),
			'username' => $this->config->item('telegram_bot_username')
		];

		$this->load->library('telegram', $bot);
		$this->load->helper('url');
		$this->load->model('tgchat');
	}

	public function index($user = NULL){
		$this->load->view('chat/chatbox');
	}

	private function http_json($status, $data = NULL, $httpcode = 200){
		http_response_code($httpcode);
		return json_encode(array('status' => $status, 'data' => $data));
	}

	public function ajax($action){
		header("Content-Type: application/json");

		switch ($action) {
			case 'startChat':
				if($this->input->post_get('user') and $this->input->post_get('name')){
					$uid = $this->tgchat->resolve_user($this->input->post_get('user'), TRUE);
					if(!$uid){
						die($this->http_json("ERROR", "NOT_ENABLED", 404));
					}

					$session = $this->tgchat->ask_permission_telegram($uid, $this->input->post_get('name'));
					if(!$session){
						die($this->http_json("ERROR", "SESSION_ERROR", 400));
					}

					die($this->http_json("OK", $session));
				}
			break;
			case 'checkPermission':
				if($this->input->post('session')){
					$status = $this->tgchat->get_permission_status($this->input->post('session'));
					
				}
			break;
			case 'send':

			break;
			case 'messages':

			break;
		}

		die($this->http_json("ERROR", "INVALID_QUERY", 404));
	}

	public function _test($user){
		$this->telegram->send
			->chat($user)
			->text("Probando!")
		->send();
		die();
	}

}

?>

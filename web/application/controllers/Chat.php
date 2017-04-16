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
		$this->load->model('tgchat');
	}

	public function index($user = NULL){
		$this->load->view('chat/chatbox');
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

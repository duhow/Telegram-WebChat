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
	}

	public function index($user = NULL){
		if(!empty($user) && is_numeric($user)){ $this->_test($user); }
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

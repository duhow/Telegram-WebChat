<?php

class Tgchat extends CI_Model {

	public function ask_permission_telegram($uid, $name){
		// Generate session
		$session = substr(md5(time() .mt_rand(1000, 9999) .$name), 0, 12);

		$data = [
			'session' => $session,
			'uid' => $uid,
			'ip' => $_SERVER['REMOTE_ADDR'],
			'status' => FALSE
		];

		// Create record
		$this->db->insert('permission', $data);

		$str = "El usuario $name quiere hablar contigo.";
		$this->telegram->send
			->chat($uid)
			->notification(TRUE)
			->inline_keyboard()
				->row()
					->button($this->telegram->emoji(":ok: Aceptar"), "aceptar $session", "TEXT")
					->button($this->telegram->emoji(":times: Rechazar"), "rechazar $session", "TEXT")
				->end_row()
			->show()
			->text($str, 'HTML')
		->send();

		// Return session
		return $session;
	}

	public function resolve_user($user, $only_enabled = FALSE){
		if($only_enabled){ $this->db->where('enable', TRUE); }

		$query = $this->db
			->select('telegram')
			->where('id', $user)
		->get('users');

		if($query->num_rows() == 0){ return FALSE; }
		return $query->row()->telegram;
	}

	public function get_permission_status($session){
		$query = $this->db
			->where('session', $session)
			->order_by('date', 'DESC')
			->limit(1)
		->get('permission');

		if($query->num_rows() == 0){ return NULL; }
		return (bool) $query->row()->status;
	}

	// Return Telegram UserID
	public function get_userid_session($session, $onlyallowed = FALSE){
		if($onlyallowed){ $this->db->where('status', TRUE); }

		$query = $this->db
			->where('session', $session)
		->get('permission');

		if($query->num_rows() == 1){ return $query->row()->uid; }
		return NULL;
	}

	public function send_text($session, $text){
		// TODO some checkups before real sending.

		$uid = $this->get_userid_session($session, TRUE);
		if(empty($uid)){ return FALSE; }

		$str = "#" .substr($session, 0, 8) ." - " .trim(strip_tags($text));

		$q = $this->telegram->send
			->notification(TRUE)
			->chat($uid)
			->text($str)
		->send();

		if($q === FALSE){ return FALSE; }

		$data = [
			'session' => $session,
			'mid' => $q['message_id'],
			'from' => 1, // webchat
			'text' => $text
		];

		$query = $this->db->insert('chat', $data);
	}

}

?>

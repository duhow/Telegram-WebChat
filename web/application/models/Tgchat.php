<?php

class Tgchat extends CI_Model {

	public function ask_permission_telegram($uid, $name, $session){
		$str = "El usuario $name quiere hablar contigo.";
		return $this->telegram->send
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
	}

	public function get_permission_status($session, $uid){
		$query = $this->db
			->where('session', $session)
			->where('uid', $uid)
			->order_by('date', 'DESC')
			->limit(1)
		->get('permisssion');

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

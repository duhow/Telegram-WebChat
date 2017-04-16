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

	public function send_text($session, $text){
		// $query = $this->db
			// ->
	}

}

?>

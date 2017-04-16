<?php

class Main extends TelegramApp\Module {
	protected function hooks(){
		if($this->telegram->callback){
			if($this->telegram->text_has("aceptar")){
				$this->accept_chat($this->telegram->last_word(), TRUE);

				// TODO Check si hay más de un chat activo.
				$str = $this->telegram->text_message() ."\n"
						.$this->telegram->emoji(":ok:") ." Aceptado. Ahora puedes hablar con el usuario.";
				$this->telegram->send
					->message(TRUE)
					->chat(TRUE)
					->text($str)
				->edit('text');
			}elseif($this->telegram->text_has("rechazar")){
				$this->accept_chat($this->telegram->last_word(), FALSE);

				// TODO Check si hay más de un chat activo.
				$str = $this->telegram->text_message() ."\n"
						.$this->telegram->emoji(":times:") ." Rechazado. El usuario no puede hablar contigo.";
				$this->telegram->send
					->message(TRUE)
					->chat(TRUE)
					->text($str)
				->edit('text');
			}

			$this->telegram->answer_if_callback("");
			$this->end();
		}

		if($this->telegram->has_reply){
			// Reply to message.
		}
	}

	public function start(){
		$this->enable_chat(TRUE);

		$str = "¡Bienvenido! Recibirás los mensajes de los usuarios.\n"
				.":times: Para detenerlo, escribe /stop .";
		$this->telegram->send
			->text($this->telegram->emoji($str))
		->send();
	}

	public function stop(){
		$this->enable_chat(FALSE);

		$str = ":times: Ya no recibirás más mensajes.\n"
				."Para volver a recibirlos, escribe /start .";
		$this->telegram->send
			->text($this->telegram->emoji($str))
		->send();

		$this->end();
	}

	public function help(){
		$str = "Recibirás mensajes de varios usuarios. Para responder a uno de ellos, debes <b>Responder al mensaje</b>."
				."Si escribes directamente, se ignorará el texto.";

		$this->telegram->send
			->text($this->telegram->emoji($str))
		->send();

		$this->end();
	}

	private function enable_chat($user = NULL, $action = TRUE){
		if(is_bool($user)){ $action = $user; $user = NULL; }
		if(empty($user)){ $user = $this->telegram->user; }
		if($user instanceof User){ $user = $user->id; }

		return $this->db
			->where('telegram', $this->telegram->user->id)
		->update('users', ['enable' => $action]);
	}

	private function accept_chat($id, $accept = TRUE){
		return $this->db
			->where('session', $id)
			->where('uid', $this->telegram->user->id)
		->update('permission', ['status' => $accept]);
	}

	private function revoke_all_chats($user = NULL){
		if(empty($user)){ $user = $this->telegram->user; }
		if($user instanceof User){ $user = $user->id; }

		return $this->db
			->where('uid', $user)
		->update('permission', ['status' => FALSE]);
	}
}

?>

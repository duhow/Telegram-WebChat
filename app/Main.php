<?php

class Main extends TelegramApp\Module {
	protected function hooks(){
		if($this->telegram->callback){
			if($this->telegram->text_has("aceptar")){
				$this->accept_chat($this->telegram->last_word(), TRUE);
			}elseif($this->telegram->text_has("rechazar")){
				$this->accept_chat($this->telegram->last_word(), FALSE);
			}
		}

		if($this->telegram->has_reply){
			// Reply to message.
		}
	}

	public function start(){
		$str = "¡Bienvenido! Recibirás los mensajes de los usuarios.\n"
				.":times: Para detenerlo, escribe /stop .";
		$this->telegram->send
			->text($this->telegram->emoji($str))
		->send();
	}

	public function stop(){
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

	private function accept_chat($id, $accept = TRUE){

	}
}

?>

<?php
/**
 * Application controller class for organization of business logic.
 */
class Battle {
	
	private $view;
	private $model;
	
	public function __construct(IView $view) {
		$this->view = $view;
		$this->model = new BattleField();
	}
	
	/**
	 * This method generate a new battle field and 
	 * randomize ship positions.
	 */
	public function newGame() {
		$this->model->initField();
		$this->view->setData($this->model->getData()['playField']);
		$this->view->display();
	}
	
	/**
	 * Show ship positions.
	 */
	public function cheat() {
		$this->view->setData($this->model->getData()['unhiddenField']);
		$this->view->display();
	}
	
	/**
	 * Handle user request and set proper messages to user.
	 */
	public function play() {
		$this->model->proceed(RequestHandler::getRequest());
		$this->view->setMessage($this->model->getMsg());
		$this->view->setData($this->model->getData()['playField']);
		$this->view->display();
	}
}

?>
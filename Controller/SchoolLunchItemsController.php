<?php
App::uses('TinydbItemsController', 'Tinydb.Controller');
class SchoolLunchItemsController extends TinydbItemsController {

	public function beforeRender() {
		$this->set('cssList', [
			'/school_lunch/css/style.css'
		]);
		parent::beforeRender();
	}
}

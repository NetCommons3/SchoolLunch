<?php
/**
 * SchoolLunchItemsController
 */

App::uses('TinydbItemsController', 'Tinydb.Controller');

/**
 * Class SchoolLunchItemsController
 */
class SchoolLunchItemsController extends TinydbItemsController {

/**
 * beforeRender
 *
 * @return void
 */
	public function beforeRender() {
		$this->set('cssList', [
			'/school_lunch/css/style.css'
		]);
		parent::beforeRender();
	}
}

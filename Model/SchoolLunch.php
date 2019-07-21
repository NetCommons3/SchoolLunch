<?php
App::uses('AppModel', 'Model');

/**
 * Class SchoolLunch
 */
class SchoolLunch extends AppModel {

/**
 * afterFrameSave
 *
 * @param array $frame Frame data
 * @return void
 */
	public function afterFrameSave(array $frame) {
		$this->__convertToTinydbFrame($frame);
	}

/**
 * フレームをTinydbのフレームにする
 *
 * @param array $frame Frame data
 * @return void
 */
	private function __convertToTinydbFrame(array $frame) {
		$frame['Frame']['plugin_key'] = 'tinydb';
		$frame['Frame']['default_setting_action'] = 'tinydb_blocks/db_type:school_lunch';
		$frameModel = ClassRegistry::init('Frames.Frame');
		$frameModel->create();
		$frameModel->save($frame, ['callbacks' => false]);
	}
}
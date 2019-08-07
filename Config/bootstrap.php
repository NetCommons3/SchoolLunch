<?php
require_once dirname(APP) . '/vendors/autoload.php';
//App::uses('CakeEventManager', 'Event');

//$eventManager = CakeEventManager::instance();
//$eventManager->attach(new \Edumap\SchoolLunch\Lib\Event\TinydbItemListener());


$eventManager = \Edumap\Tinydb\Lib\EventManager::instance();

// 新規Itemのデフォルトの変更
$eventManager->attach(
	'SchoolLunch.Tinydb.Model.TinydbItem.getNew',
	function (&$new) {
		Configure::load('SchoolLunch.default');
		$default = Configure::read('SchoolLunch.TinydbItemDefault');

		$new = Hash::merge($new, $default);
	}
);

 //タイトル（日付）をregister_dateに日付型でも保存
$eventManager->attach(
	'SchoolLunch.Tinydb.Model.TinydbItem.afterSave',
	function ($created, $options, &$data) {
		$data['SchoolLunchItem']['register_date'] = $data['TinydbItem']['title'];
	}
);
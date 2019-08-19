<?php
/**
 * add record
 */

App::uses('NetCommonsMigration', 'NetCommons.Config/Migration');
App::uses('Space', 'Rooms.Model');

/**
 * Class AddRecord
 */
class ClearRecord extends NetCommonsMigration {

/**
 * Migration description
 *
 * @var string
 */
	public $description = 'reset_record';

/**
 * Actions to be performed
 *
 * @var array $migration
 */
	public $migration = array(
		'up' => array(
		),
		'down' => array(
		),
	);

/**
 * recodes
 *
 * @var array $migration
 */
	public $records = array(
		'Plugin' => array(
			//日本語
			array(
				'language_id' => '2',
				'is_origin' => true,
				'is_translation' => true,
				'key' => 'school_lunch',
				'namespace' => 'edumap/school-lunch',
				'name' => '給食',
				'type' => 1,
				'default_action' => 'school_lunch_items/index',
				'default_setting_action' => 'school_lunch_blocks/index',
				'display_topics' => 1,
				'display_search' => 1,
			),
			//英語
			array(
				'language_id' => '1',
				'is_origin' => false,
				'is_translation' => true,
				'key' => 'school_lunch',
				'namespace' => 'edumap/school-lunch',
				'name' => 'SchoolLunch',
				'type' => 1,
				'default_action' => 'school_lunch_items/index',
				'default_setting_action' => 'school_lunch_blocks/index',
				'display_topics' => 1,
				'display_search' => 1,
			),
		),
		'PluginsRole' => array(
			array(
				'role_key' => 'room_administrator',
				'plugin_key' => 'school_lunch'
			),
		),
		//PluginsRoomは、beforeでセットする
	);

/**
 * Before migration callback
 *
 * @param string $direction Direction of migration process (up or down)
 * @return bool Should process continue
 */
	public function before($direction) {
		$pluginName = $this->records['Plugin'][0]['key'];

		$this->loadModels([
			'Plugin' => 'PluginManager.Plugin',
			'PluginsRoom' => 'PluginManager.PluginsRoom',
			'PluginsRole' => 'PluginManager.PluginsRole',
		]);
		$this->Plugin->deleteAll(['Plugin.key' => $pluginName]);
		$this->PluginsRoom->deleteAll(['PluginsRoom.plugin_key' => $pluginName]);
		$this->PluginsRole->deleteAll(['PluginsRole.plugin_key' => $pluginName]);

		$this->records['PluginsRoom'] = array(
			//サイト全体
			array(
				'room_id' => Space::getRoomIdRoot(Space::WHOLE_SITE_ID, 'Room'),
				'plugin_key' => $pluginName
			),
			//パブリックスペース
			array(
				'room_id' => Space::getRoomIdRoot(Space::PUBLIC_SPACE_ID, 'Room'),
				'plugin_key' => $pluginName
			),
			//プライベートスペース
			array(
				'room_id' => Space::getRoomIdRoot(Space::PRIVATE_SPACE_ID, 'Room'),
				'plugin_key' => $pluginName
			),
			//グループスペース
			array(
				'room_id' => Space::getRoomIdRoot(Space::COMMUNITY_SPACE_ID, 'Room'),
				'plugin_key' => $pluginName
			),
		);
		return true;
	}

/**
 * After migration callback
 *
 * @param string $direction Direction of migration process (up or down)
 * @return bool Should process continue
 */
	public function after($direction) {
		if ($direction === 'down') {
			$this->Plugin->uninstallPlugin($this->records['Plugin'][0]['key']);
			return true;
		}
		foreach ($this->records as $model => $records) {
			if (!$this->updateRecords($model, $records)) {
				return false;
			}
		}
		return true;
	}
}

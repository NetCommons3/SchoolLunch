<?php 
class SchoolLunchSchema extends CakeSchema {

	public $connection = 'master';

	public function before($event = array()) {
		return true;
	}

	public function after($event = array()) {
	}

	public $school_lunch_items = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => true, 'key' => 'primary'),
		'tinydb_item_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'register_date' => array('type' => 'date', 'null' => true, 'default' => null),
		'lunch_text' => array('type' => 'text', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'allergen_duty_egg' => array('type' => 'boolean', 'null' => false, 'default' => null, 'comment' => 'アレルゲン_義務_卵'),
		'allergen_duty_milk' => array('type' => 'boolean', 'null' => false, 'default' => null, 'comment' => 'アレルゲン_義務_乳'),
		'allergen_duty_wheat' => array('type' => 'boolean', 'null' => false, 'default' => null, 'comment' => 'アレルゲン_義務_小麦'),
		'allergen_duty_buck_wheat' => array('type' => 'boolean', 'null' => false, 'default' => null, 'comment' => 'アレルゲン_義務_そば'),
		'allergen_duty_peanut' => array('type' => 'boolean', 'null' => false, 'default' => null, 'comment' => 'アレルゲン_義務_落花生'),
		'allergen_duty_shrimps' => array('type' => 'boolean', 'null' => false, 'default' => null, 'comment' => 'アレルゲン_義務_えび'),
		'allergen_duty_crab' => array('type' => 'boolean', 'null' => false, 'default' => null, 'comment' => 'アレルゲン_義務_かに'),
		'allergen_rec_abalone' => array('type' => 'boolean', 'null' => false, 'default' => null, 'comment' => 'アレルゲン_推奨_あわび'),
		'allergen_rec_squid' => array('type' => 'boolean', 'null' => false, 'default' => null, 'comment' => 'アレルゲン_推奨_いか'),
		'allergen_rec_ikra' => array('type' => 'boolean', 'null' => false, 'default' => null, 'comment' => 'アレルゲン_推奨_いくら'),
		'allergen_rec_orange' => array('type' => 'boolean', 'null' => false, 'default' => null, 'comment' => 'アレルゲン_推奨_オレンジ'),
		'allergen_rec_kiwi' => array('type' => 'boolean', 'null' => false, 'default' => null, 'comment' => 'アレルゲン_推奨_キウイ'),
		'allergen_rec_beef' => array('type' => 'boolean', 'null' => false, 'default' => null, 'comment' => 'アレルゲン_推奨_牛肉'),
		'allergen_rec_walnut' => array('type' => 'boolean', 'null' => false, 'default' => null, 'comment' => 'アレルゲン_推奨_くるみ'),
		'allergen_rec_salmon' => array('type' => 'boolean', 'null' => false, 'default' => null, 'comment' => 'アレルゲン_推奨_さけ'),
		'allergen_rec_sabah' => array('type' => 'boolean', 'null' => false, 'default' => null, 'comment' => 'アレルゲン_推奨_さば'),
		'allergen_rec_soybean' => array('type' => 'boolean', 'null' => false, 'default' => null, 'comment' => 'アレルゲン_推奨_大豆'),
		'allergen_rec_chicken' => array('type' => 'boolean', 'null' => false, 'default' => null, 'comment' => 'アレルゲン_推奨_鶏肉'),
		'allergen_rec_pork' => array('type' => 'boolean', 'null' => false, 'default' => null, 'comment' => 'アレルゲン_推奨_豚肉'),
		'allergen_rec_matsutake' => array('type' => 'boolean', 'null' => false, 'default' => null, 'comment' => 'アレルゲン_推奨_まつたけ'),
		'allergen_rec_peach' => array('type' => 'boolean', 'null' => false, 'default' => null, 'comment' => 'アレルゲン_推奨_もも'),
		'allergen_rec_yam' => array('type' => 'boolean', 'null' => false, 'default' => null, 'comment' => 'アレルゲン_推奨_やまいも'),
		'allergen_rec_apple' => array('type' => 'boolean', 'null' => false, 'default' => null, 'comment' => 'アレルゲン_推奨_りんご'),
		'allergen_rec_gelatin' => array('type' => 'boolean', 'null' => false, 'default' => null, 'comment' => 'アレルゲン_推奨_ゼラチン'),
		'allergen_rec_banana' => array('type' => 'boolean', 'null' => false, 'default' => null, 'comment' => 'アレルゲン_推奨_バナナ'),
		'allergen_rec_sesame' => array('type' => 'boolean', 'null' => false, 'default' => null, 'comment' => 'アレルゲン_推奨_ごま'),
		'allergen_rec_cashewnut' => array('type' => 'boolean', 'null' => false, 'default' => null, 'comment' => 'アレルゲン_推奨_カシューナッツ'),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1)
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);

}

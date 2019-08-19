<?php
/**
 * SchoolLunchItem Model
 *
 * @property TinydbItem $TinydbItem
 *
* @author Noriko Arai <arai@nii.ac.jp>
* @author Your Name <yourname@domain.com>
* @link http://www.netcommons.org NetCommons Project
* @license http://www.netcommons.org/license.txt NetCommons License
* @copyright Copyright 2014, NetCommons Project
 */

App::uses('SchoolLunchAppModel', 'SchoolLunch.Model');

/**
 * Summary for SchoolLunchItem Model
 */
class SchoolLunchItem extends SchoolLunchAppModel {

/**
 * Use database config
 *
 * @var string
 */
	public $useDbConfig = 'master';

/**
 * @var array Behaviors
 */
	public $actsAs = [
		'NetCommons.OriginalKey',
	];

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'tinydb_item_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'TinydbItem' => array(
			'className' => 'TinydbItem',
			'foreignKey' => 'tinydb_item_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}

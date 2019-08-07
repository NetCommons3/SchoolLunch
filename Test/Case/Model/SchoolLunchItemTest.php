<?php
/**
 * SchoolLunchItem Test Case
 *
* @author Noriko Arai <arai@nii.ac.jp>
* @author Your Name <yourname@domain.com>
* @link http://www.netcommons.org NetCommons Project
* @license http://www.netcommons.org/license.txt NetCommons License
* @copyright Copyright 2014, NetCommons Project
 */

App::uses('SchoolLunchItem', 'SchoolLunch.Model');

/**
 * Summary for SchoolLunchItem Test Case
 */
class SchoolLunchItemTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'plugin.school_lunch.school_lunch_item',
		'plugin.school_lunch.tinydb_item',
		'plugin.school_lunch.user',
		'plugin.school_lunch.role',
		'plugin.school_lunch.user_role_setting',
		'plugin.school_lunch.users_language',
		'plugin.school_lunch.language'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->SchoolLunchItem = ClassRegistry::init('SchoolLunch.SchoolLunchItem');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->SchoolLunchItem);

		parent::tearDown();
	}

}

<?php
/**
 * SchoolLunchItemHelper
 */

App::uses('AppHelper', 'View/Helper');

/**
 * Class SchoolLunchItemHelper
 */
class SchoolLunchItemHelper extends AppHelper {

/**
 * titleFormat
 *
 * @param string $title title
 * @return false|string
 */
	public function titleFormat(string $title) {
		return date(__d('school_lunch', 'date_format'), strtotime($title));
	}
}
<?php

App::uses('AppHelper', 'View/Helper');

class SchoolLunchItemHelper extends AppHelper {
	public function titleFormat(string $title) {
		return date(__d('school_lunch', 'date_format'), strtotime($title));
	}
}
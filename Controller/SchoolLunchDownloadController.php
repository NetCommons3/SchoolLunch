<?php
App::uses('TinydbAppController', 'Tinydb.Controller');

class SchoolLunchDownloadController extends TinydbAppController {

	public $uses = [
		'Tinydb.TinydbItem'
	];

	public $components = [
		'Files.Download',
	];

/**
 * beforeFilter
 *
 * @return void
 */
	public function beforeFilter() {
		parent::beforeFilter();
		// ゲストアクセスOKのアクションを設定
		$this->Auth->allow( 'download');
	}

/**
 * 権限の取得
 *
 * @return array
 */
	protected function _getPermission() {
		$permissionNames = array(
			'content_readable',
			'content_creatable',
			'content_editable',
			'content_publishable',
		);
		$permission = array();
		foreach ($permissionNames as $key) {
			$permission[$key] = Current::permission($key);
		}
		return $permission;
	}


/**
 * download
 *
 * @return CakeResponse|null
 * @throws NotFoundException
 */
	public function download() {
		// ここから元コンテンツを取得する処理
		$this->_prepare();
		$key = $this->params['key'];
		$conditions = $this->TinydbItem->getConditions(
			Current::read('Block.id'),
			$this->_getPermission()
		);
		$conditions['TinydbItem.key'] = $key;
		$options = array(
			'conditions' => $conditions,
			'recursive' => 0,
		);
		$this->TinydbItem->recursive = 0;
		$tinydbItem = $this->TinydbItem->find('first', $options);

		// ここまで元コンテンツを取得する処理
		if (!$tinydbItem) {
			// 表示できない記事へのアクセスなら404
			throw new NotFoundException(__('Invalid blog entry'));
		}
		// ダウンロード実行
		return $this->Download->doDownload($tinydbItem['TinydbItem']['id']);
	}

}
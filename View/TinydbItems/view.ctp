<?php
$this->SchoolLunchItem = $this->Helpers->load('SchoolLunch.SchoolLunchItem');

echo $this->NetCommonsHtml->css([
	'/tinydb/css/tinydb.css',
	'/likes/css/style.css',
	'/school_lunch/css/school_lunch_view.css'
]);
echo $this->NetCommonsHtml->script([
	'/likes/js/likes.js',
]);
//debug($this->NetCommonsHtml->url());
echo $this->TinydbOgp->ogpMetaByTinydbItem($tinydbItem);
?>

<header class="clearfix">
	<div class="pull-left">
		<?php echo $this->LinkButton->toList(); ?>
	</div>
	<div class="pull-right">
		<?php echo $this->element('Tinydb.TinydbItems/edit_link', array('status' => $tinydbItem['TinydbItem']['status'])); ?>
	</div>
</header>

<article>

	<div class="tinydb_view_title clearfix">
		<?php echo $this->NetCommonsHtml->blockTitle(
				$this->SchoolLunchItem->titleFormat($tinydbItem['TinydbItem']['title']),
				$tinydbItem['TinydbItem']['title_icon'],
				array('status' => $this->Workflow->label($tinydbItem['TinydbItem']['status']))
			); ?>
	</div>

	<?php echo $this->element('Tinydb.item_meta_info'); ?>

	<div>
		<?php echo $tinydbItem['TinydbItem']['body1']; ?>
	</div>

	<div>
		<?php echo $tinydbItem['TinydbItem']['body2']; ?>
	</div>

	<?php
	// アレルゲン表示
	$this->request->data['SchoolLunchItem'] = $tinydbItem['SchoolLunchItem'];
	$schoolLunchItemModel = ClassRegistry::init('SchoolLunch.SchoolLunchItem');
	$fields = $schoolLunchItemModel->schema();
	$dutyList = [];
	$recommendationList = [];
	foreach ($fields as $field => $properties) {
		if (strpos($field, 'allergen_duty_') !== false) {
			$dutyList[$field] = $properties;
		}
		if (strpos($field, 'allergen_rec_') !== false) {
			$recommendationList[$field] = $properties;
		}
	}
	?>
	<div class="school-lunch-view-allergen">
		<div class="form-group">
			<label class="control-label">アレルゲン（義務）</label>
			<div class="school-lunch-view-allergen-dusty-checkboxes">
				<?php foreach ($dutyList as $field => $properties): ?>
					<?php // 義務
					echo $this->NetCommonsForm->checkbox(
						'SchoolLunchItem.' . $field,
						[
							//'div' => false,
							'inline' => true,
							'label' => str_replace('アレルゲン_義務_', '', $properties['comment']),
							'disabled'
						]
					);
					?>
				<?php endforeach; ?>
			</div>
		</div>

		<div class="form-group">
			<label class="control-label">アレルゲン（推奨）</label>
			<div class="school-lunch-view-allergen-recommendation-checkboxes">
				<?php foreach ($recommendationList as $field => $properties): ?>
					<?php // 義務
					echo $this->NetCommonsForm->checkbox(
						'SchoolLunchItem.' . $field,
						[
							//'div' => false,
							'inline' => true,
							'label' => str_replace('アレルゲン_推奨_', '', $properties['comment']),
							'disabled'
						]
					);
					?>
				<?php endforeach; ?>
			</div>
		</div>

	</div>

	<?php //echo $this->element('Tinydb.item_footer'); ?>

	<!-- Tags -->
	<?php if (isset($tinydbItem['Tag'])) : ?>
	<div>
		<?php echo __tinydbd('tinydb', 'tag'); ?>
		<?php foreach ($tinydbItem['Tag'] as $tinydbTag): ?>
			<?php echo $this->NetCommonsHtml->link(
				$tinydbTag['name'],
				array('controller' => 'school_lunch_items', 'action' => 'tag', 'frame_id' => Current::read('Frame.id'), 'id' => $tinydbTag['id'])
			); ?>&nbsp;
		<?php endforeach; ?>
	</div>
	<?php endif ?>

	<div>
		<?php /* コンテンツコメント */ ?>
		<?php echo $this->ContentComment->index($tinydbItem); ?>
		<!--<div class="row">-->
		<!--	<div class="col-xs-12">-->
		<!--		--><?php //echo $this->element('ContentComments.index', array(
		//			'pluginKey' => $this->request->params['plugin'],
		//			'contentKey' => $tinydbItem['TinydbItem']['key'],
		//			'isCommentApproved' => $tinydbSetting['use_comment_approval'],
		//			'useComment' => $tinydbSetting['use_comment'],
		//			'contentCommentCnt' => $tinydbItem['ContentCommentCnt']['cnt'],
		//			'redirectUrl' => $this->NetCommonsHtml->url(array('plugin' => 'tinydb', 'controller' => 'tinydb_items', 'action' => 'view', 'frame_id' => Current::read('Frame.id'), 'key' => $tinydbItem['TinydbItem']['key'])),
		//		)); ?>
		<!--	</div>-->
		<!--</div>-->
	</div>
</article>



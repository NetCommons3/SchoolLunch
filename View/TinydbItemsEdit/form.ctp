<?php
echo $this->NetCommonsHtml->script([
	'/tinydb/js/tinydb.js',
	//'/tinydb/js/tinydb_item_edit.js',
	'/tags/js/tags.js',
]);
echo $this->NetCommonsHtml->css([
		'/school_lunch/css/school_lunch_form.css',
]);
?>
<?php
$dataJson = json_encode(
	$this->NetCommonsTime->toUserDatetimeArray($this->request->data, array('TinydbItem.publish_start'))
);
?>
<div class="tinydbEntries form" >
	<article>
		<h1><?php echo h($tinydb['Tinydb']['name']) ?></h1>
		<div class="panel panel-default">

			<?php echo $this->NetCommonsForm->create(
				'TinydbItem',
				array(
					'inputDefaults' => array(
						'div' => 'form-group',
						'class' => 'form-control',
						'error' => false,
					),
					'div' => 'form-control',
					'novalidate' => true,
					'type' => 'file'
				)
			);
			$this->NetCommonsForm->unlockField('Tag');
			?>
			<?php echo $this->NetCommonsForm->hidden('key'); ?>
			<?php echo $this->NetCommonsForm->hidden('Frame.id', array(
						'value' => Current::read('Frame.id'),
					)); ?>
			<?php echo $this->NetCommonsForm->hidden('Block.id', array(
				'value' => Current::read('Block.id'),
			)); ?>

			<div class="panel-body">

				<fieldset>

					<?php
					//echo $this->TitleIcon->inputWithTitleIcon(
					//	'title',
					//	'TinydbItem.title_icon',
					//	array(
					//		'label' => __d('tinydb', 'Title'),
					//		'required' => 'required',
					//	)
					//);
					echo $this->NetCommonsForm->input('TinydbItem.title', [
						'type' => 'text',
						'datetimepicker' => 'datetimepicker',
						'datetimepicker-options' => json_encode([
							'format' => 'YYYY-MM-DD'
						]),
						'required' => 'required',
						'label' => __d('school_lunch', 'Title'),
						'ng-model' => 'title',
						'ng-init' => sprintf('title=\'%s\'', h($this->request->data['TinydbItem']['title']))
						//'value' => $this->request->data['TinydbItem']['title']
					]);
					?>
					<?php
					echo $this->NetCommonsForm->uploadFile('TinydbItem.lunch_photo', [
						'label' => '献立写真',
						'remove' => true
					]);
					?>

					<?php //echo $this->NetCommonsForm->wysiwyg('TinydbItem.body1', array(
					//	'label' => __d('school_lunch', 'Body1'),
					//	'required' => true,
					//	'rows' => 12
					//));?>
					<?php echo $this->NetCommonsForm->input('TinydbItem.body1', array(
						'type' => 'textarea',
						'label' => __d('school_lunch', 'Body1'),
						'required' => true,
						'rows' => 12
					));?>

					<?php
					// アレルゲン入力
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
					<div class="form-group">
						<label class="control-label">アレルゲン（義務）</label>
						<div class="school-lunch-form-allergen-dusty-checkboxes">
							<?php foreach ($dutyList as $field => $properties): ?>
								<?php // 義務
								echo $this->NetCommonsForm->checkbox(
									'SchoolLunchItem.' . $field,
									[
										//'div' => false,
										'inline' => true,
										'label' => str_replace('アレルゲン_義務_', '', $properties['comment']),
									]
								);
								?>
							<?php endforeach; ?>
						</div>
					</div>

					<div class="form-group">
						<label class="control-label">アレルゲン（推奨）</label>
						<div class="school-lunch-form-allergen-recommendation-checkboxes">
							<?php foreach ($recommendationList as $field => $properties): ?>
								<?php // 義務
								echo $this->NetCommonsForm->checkbox(
									'SchoolLunchItem.' . $field,
									[
										//'div' => false,
										'inline' => true,
										'label' => str_replace('アレルゲン_推奨_', '', $properties['comment']),
									]
								);
								?>
							<?php endforeach; ?>
						</div>
					</div>


					<?php
					echo $this->NetCommonsForm->input('TinydbItem.publish_start',
						array(
							'type' => 'hidden',
							'required' => 'required',
							'label' => __d('tinydb', 'Published datetime'),
							'childDiv' => ['class' => 'form-inline'],
						)
					);
					?>

					<?php echo $this->Category->select('TinydbItem.category_id', array('empty' => true)); ?>

					<?php //echo $this->element(
					//	'Tags.tag_form',
					//	array(
					//		'tagData' => isset($this->request->data['Tag']) ? $this->request->data['Tag'] : array(),
					//		'modelName' => 'TinydbItem',
					//	)
					//); ?>

				</fieldset>

				<hr/>
				<?php echo $this->Workflow->inputComment('TinydbItem.status'); ?>

			</div>

			<?php echo $this->Workflow->buttons('TinydbItem.status'); ?>

			<?php echo $this->NetCommonsForm->end() ?>

			<?php if ($isEdit && $isDeletable) : ?>
				<div  class="panel-footer" style="text-align: right;">
					<?php echo $this->NetCommonsForm->create('TinydbItem',
						array(
							'type' => 'delete',
							'url' => NetCommonsUrl::blockUrl(
								array('controller' => 'school_lunch_items_edit', 'action' => 'delete', 'frame_id' => Current::read('Frame.id')))
						)
					) ?>
					<?php echo $this->NetCommonsForm->input('key', array('type' => 'hidden')); ?>

					<?php echo $this->Button->delete('', __d('net_commons', 'Deleting the %s. Are you sure to proceed?', __d('tinydb', 'TinydbItem')));?>

					<?php echo $this->NetCommonsForm->end() ?>
				</div>
			<?php endif ?>

		</div>

		<?php echo $this->Workflow->comments(); ?>

	</article>

</div>



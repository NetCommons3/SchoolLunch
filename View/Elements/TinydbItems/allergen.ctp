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

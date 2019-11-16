<?php
$this->SchoolLunchItem = $this->Helpers->load('SchoolLunch.SchoolLunchItem');

echo $this->NetCommonsHtml->css(
	[
		'/tinydb/css/tinydb.css',
		'/likes/css/style.css',
		'/school_lunch/css/style.css'
	]
);
echo $this->NetCommonsHtml->script(
	[
		'/likes/js/likes.js',
	]
);
//debug($this->NetCommonsHtml->url());
echo $this->TinydbOgp->ogpMetaByTinydbItem($tinydbItem);
?>

<header class="clearfix">
	<div class="pull-left">
		<?php echo $this->LinkButton->toList(); ?>
	</div>
	<div class="pull-right">
		<?php echo $this->element(
			'Tinydb.TinydbItems/edit_link',
			array('status' => $tinydbItem['TinydbItem']['status'])
		); ?>
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


	<?php if (isset($tinydbItem['UploadFile'])): ?>
		<div class="text-center school-lunch-photo-box">
			<?php echo $this->NetCommonsHtml->image(
				//$this->NetCommonsHtml->url(
					[
						'controller' => 'school_lunch_download',
						'action' => 'download',
						'key' => $tinydbItem['TinydbItem']['key'],
						'lunch_photo',
						'medium',
					],
				//),
				[
					'class' => 'school-lunch-photo img-responsive',
				]
			); ?>
		</div>
	<?php endif; ?>

	<div class="text-left">
		<?php echo nl2br(h($tinydbItem['TinydbItem']['body1'])); ?>
	</div>

	<hr>

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
	<?php echo $this->element('SchoolLunch.TinydbItems/allergen', ['tinydbItem' => $tinydbItem])?>

	<?php //echo $this->element('Tinydb.item_footer'); ?>

	<?php if (isset($tinydbItem['Tag'])) : ?>
		<div>
			<?php echo __tinydbd('tinydb', 'tag'); ?>
			<?php foreach ($tinydbItem['Tag'] as $tinydbTag): ?>
				<?php echo $this->NetCommonsHtml->link(
					$tinydbTag['name'],
					array(
						'controller' => 'school_lunch_items',
						'action' => 'tag',
						'frame_id' => Current::read('Frame.id'),
						'id' => $tinydbTag['id']
					)
				); ?>&nbsp;
			<?php endforeach; ?>
		</div>
	<?php endif ?>

	<div>
		<?php /* コンテンツコメント */ ?>
		<?php echo $this->ContentComment->index($tinydbItem); ?>
	</div>
</article>



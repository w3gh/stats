<table class='list'>
	<thead>
		<tr>
			<th>
				<?=__('app', 'Favorite items')?>
			</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td align='center'>
				<?php if ($itemsCount < 1): ?>
					<?=	__('app', 'No Items found');?>
				<?php endif; ?>

				<?php foreach ($items as $item): ?>
					<a title="<?=$item['name']?>" href='<?=app()->controller->createUrl(
						'items/view',
						array(
								 'id' => $item['itemid']
						)
					);?>'>
					<img border=0 width='48' height='48' alt='<?=$item['name']?>'
							 src='<?=app()->controller->assetsUrl?>/img/items/<?=$item['icon']?>'></a>
				<?php endforeach;?>

			</td>
		</tr>
	</tbody>
	<table>

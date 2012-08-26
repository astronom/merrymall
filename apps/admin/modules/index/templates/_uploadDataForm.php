<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<form action="<?php echo url_for('index/upload') ?>" method="post"
<?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
	<?php if (!$form->getObject()->isNew()): ?> <input type="hidden"
	name="sf_method" value="put" /> <?php endif; ?>
<table>
    
	<thead>
		<tr class="flash_notice">
			<th colspan="2">
				Загрузите файл каталога товаров
			</th>
		</tr>
	</thead>
	
	<tfoot>
		<tr>
			<td colspan="2"><input type="submit" value="Загрузить" /></td>
		</tr>
	</tfoot>
	<tbody>
	<?php echo $form ?>
	</tbody>
</table>
</form>


<?php foreach ($actions as $action): ?>
	<div class="text">
    <?php if($action['logo'])?>
		<img src="/images/actions/<?php echo $action['logo'] ?>">
        <?php if($action['Company']):?>
			<a href="<?php echo url_for('company_show_actions', array('company_name' => $action['Company']['url'], 'title_slug' => $action['title_slug'])) ?>"><?php echo $action['title'] ?></a>
        <?php else: ?>
			<a href="<?php echo url_for('show_action', array('title_slug' => $action['title_slug'])) ?>"><?php echo $action['title'] ?></a>
        <?php endif;?>
	</div>
<?php endforeach; ?>

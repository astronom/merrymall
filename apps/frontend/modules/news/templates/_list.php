<?php foreach ($news as $news_item): ?>
	<div class="text">
		<span class="date"><?php echo $news_item->getDateTimeObject('date')->format('d.m.Y') ?></span>
		<?php if($news_item->getCompany()):?>
			<a href="<?php echo url_for('company_show_news', array('company_name' => $news_item->getCompany()->getUrl(), 'title_slug' => $news_item->getTitleSlug())) ?>"><?php echo $news_item->getTitle() ?></a>
        <?php else: ?>
			<a href="<?php echo url_for('show_news', array('title_slug' => $news_item->getTitleSlug())) ?>"><?php echo $news_item->getTitle() ?></a>
        <?php endif;?>
	</div>
<?php endforeach; ?>
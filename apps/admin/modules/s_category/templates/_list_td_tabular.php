<td class="sf_admin_text sf_admin_list_td_id">
  <?php echo link_to($s_category->getId(), 's_category_edit', $s_category) ?>
</td>
<td class="sf_admin_text sf_admin_list_td_tabbedName">
  <?php echo $s_category->getTabbedName(ESC_RAW) ?>
</td>
<td class="sf_admin_text sf_admin_list_td_position">
  <?php echo $s_category->getPosition() ?>
</td>
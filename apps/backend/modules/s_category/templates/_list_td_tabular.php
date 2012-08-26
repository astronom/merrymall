<td class="sf_admin_text sf_admin_list_td_id">
  <?php echo link_to($s_category['id'], 's_category', $s_category) ?>
</td>
<td class="sf_admin_text sf_admin_list_td_name">
  <span class="<?php echo $s_category->getNode()->isLeaf() ? 'file' : 'folder' ?>">
    <?php echo $s_category['name'] ?>
  </span>
</td>
<td class="sf_admin_text sf_admin_list_td_root_id">
  <?php echo $s_category['root_id'] ?>
</td>
<td class="sf_admin_text sf_admin_list_td_lft">
  <?php echo $s_category['lft'] ?>
</td>
<td class="sf_admin_text sf_admin_list_td_rgt">
  <?php echo $s_category['rgt'] ?>
</td>
<td class="sf_admin_text sf_admin_list_td_level">
  <?php echo $s_category['level'] ?>
</td>

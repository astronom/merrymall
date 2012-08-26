<td>
  <ul class="sf_admin_td_actions">
    <li class="sf_admin_action_new">
      <?php echo link_to(__('Add Child', array(), 'messages'), 's_category/ListNew?id='.$s_category->getId(), array()) ?>
    </li>
    <li class="sf_admin_action_edititems">
      <?php echo link_to(__('Товары', array(), 'messages'), 's_category/ListEditItems?id='.$s_category->getId(), array()) ?>
    </li>
    <?php echo $helper->linkToEdit($s_category, array(  'params' =>   array(  ),  'class_suffix' => 'edit',  'label' => 'Edit',)) ?>
    <?php echo $helper->linkToDelete($s_category, array(  'params' =>   array(  ),  'confirm' => 'Are you sure?',  'class_suffix' => 'delete',  'label' => 'Delete',)) ?>
  </ul>
</td>

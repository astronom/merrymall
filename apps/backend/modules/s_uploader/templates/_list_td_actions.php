<?php $xml = false; ?>
<td>
  <ul class="sf_admin_td_actions">
    <li class="sf_admin_action_upload">
    <?php if($yml_company->isXML()): ?>
      <?php echo link_to(__('Загрузить', array(), 'messages'), 's_uploader/ListUploadXML?id='.$yml_company->getId(), array()) ?>
      <?php $xml = true; ?>
    <?php endif; ?>
    </li>
    <li class="sf_admin_action_read">
    <?php if(!$xml):?>
      <?php echo link_to(__('Открыть прайс', array(), 'messages'), 's_uploader/ListRead?id='.$yml_company->getId(), array()) ?>
    <?php endif;?>
    </li>
    <?php echo $helper->linkToEdit($yml_company, array(  'params' =>   array(  ),  'class_suffix' => 'edit',  'label' => 'Edit',)) ?>
    <?php echo $helper->linkToDelete($yml_company, array(  'params' =>   array(  ),  'confirm' => 'Are you sure?',  'class_suffix' => 'delete',  'label' => 'Delete',)) ?>
  </ul>
</td>

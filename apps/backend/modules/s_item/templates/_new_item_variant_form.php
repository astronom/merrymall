<div class="item_variant" style="display: none;">
  <?php $fields = $helper->getArrayValue($configuration->getFormFields($form, $form->isNew() ? 'new' : 'edit'), 'NONE') ?>
  <?php foreach ($fields as $name => $field): ?>
    <?php if ((isset($form[$name]) && $form[$name]->isHidden()) || (!isset($form[$name]) && $field->isReal())) continue ?>
    <?php include_partial('s_item/form_field', array(
      'name'       => $name,
      'attributes' => $field->getConfig('attributes', array()),
      'label'      => $field->getConfig('label'),
      'help'       => $field->getConfig('help'),
      'form'       => $form,
      'field'      => $field,
      'class'      => 'sf_admin_form_row sf_admin_'.strtolower($field->getType()).' sf_admin_form_field_'.$name,
    )) ?>
  <?php endforeach; ?>
  <div class="sf_admin_form_row"><span class="sf_admin_delete_item_variant"><a href="#" onclick="return false">Удалить вариант</a></span></div>
</div>
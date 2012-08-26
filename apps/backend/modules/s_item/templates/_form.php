<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<script type="text/javascript">
  var newItemVariantForm = '<?php echo escape_javascript(get_partial('s_item/new_item_variant_form', array('form' => $form->newItemVariantForm, 'configuration' => $configuration, 'helper' => $helper))) ?>';

  $( function()
  {
    $('input.unique_is_main').live('click', function ()
    {
      $('input.unique_is_main').removeAttr('checked');
      $(this).attr('checked', true);
    });

    $('.sf_admin_new_item_variant').click( function ()
    {
      var odd = $('#item_variants > div.item_variant:last').hasClass('odd');
      $('#item_variants').append(newItemVariantForm);
      odd = odd ? 'even' : 'odd';
      $('#item_variants > div.item_variant:last').addClass(odd).fadeIn(500);
    });

    $('.sf_admin_delete_item_variant').live('click', function ()
    {
        $(this).parent().parent('.item_variant').fadeOut(500, function () {$(this).remove()});
    });
  });
</script>

<div class="sf_admin_form">
  <?php echo form_tag_for($form, '@s_item') ?>
    <?php echo $form->renderHiddenFields(false) ?>

    <?php if ($form->hasGlobalErrors()): ?>
      <?php echo $form->renderGlobalErrors() ?>
    <?php endif; ?>

    <?php foreach ($configuration->getFormFields($form, $form->isNew() ? 'new' : 'edit') as $fieldset => $fields): ?>
      <?php include_partial('s_item/form_fieldset', array('s_item' => $s_item, 'form' => $form, 'fields' => $fields, 'fieldset' => $fieldset)) ?>
    <?php endforeach; ?>

    <fieldset id="item_variants">
      <h1>Варианты</h1>
      <div class="sf_admin_form_row"><span class="sf_admin_new_item_variant"><a href="#" onclick="return false">Добавить вариант</a></span></div>
      <?php foreach ($form->itemVariantForms as $i => $itemVariantForm): $odd = fmod(++$i, 2) ? 'odd' : 'even'?>
        <div class="item_variant <?php echo $odd ?>">
          <?php $fields = $helper->getArrayValue($configuration->getFormFields($itemVariantForm, $itemVariantForm->isNew() ? 'new' : 'edit'), 'NONE') ?>
          <?php foreach ($fields as $name => $field): ?>
            <?php if ((isset($itemVariantForm[$name]) && $itemVariantForm[$name]->isHidden()) || (!isset($itemVariantForm[$name]) && $field->isReal())) continue ?>
            <?php include_partial('s_item/form_field', array(
              'name'       => $name,
              'attributes' => $field->getConfig('attributes', array()),
              'label'      => $field->getConfig('label'),
              'help'       => $field->getConfig('help'),
              'form'       => $itemVariantForm,
              'field'      => $field,
              'class'      => 'sf_admin_form_row sf_admin_'.strtolower($field->getType()).' sf_admin_form_field_'.$name,
            )) ?>
          <?php endforeach; ?>
          <div class="sf_admin_form_row"><span class="sf_admin_delete_item_variant"><a href="#" onclick="return false">Удалить вариант</a></span></div>
        </div>
      <?php endforeach; ?>
    </fieldset>

    <?php include_partial('s_item/form_actions', array('s_item' => $s_item, 'form' => $form, 'configuration' => $configuration, 'helper' => $helper)) ?>
  </form>
</div>

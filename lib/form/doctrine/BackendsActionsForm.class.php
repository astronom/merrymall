<?php 
class BackendsActionsForm extends BaseActionsForm
{
  public function configure()
  {
    unset(
    $this['created_at'],
    $this['updated_at'],
    $this['title_slug']
    );

    $this->setWidget('text', new mmWidgetFormWYSIWYG(array(), array('rows' => 15, 'cols' => 75)));
    
    // Виджет и валидатор для логотипа акции
    $this->setWidget('logo', new sfWidgetFormInputFileEditable(array(
      'label'     => 'Logo',
      'file_src'  => $this->getObject()->getLogoUrl(),
      'is_image'  => true,
      'edit_mode' => !$this->isNew(),
      'template'  => '<div>%file%<br />%input%<br />%delete% %delete_label%</div>',
    )));

    $this->setValidator('logo', new sfValidatorFile(array(
    'required' => false,
    'path' => $this->getObject()->getLogoPath(),
    'mime_types' => 'web_images'    
    )));
  }
}
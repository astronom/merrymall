<?php echo form_tag('@sf_guard_signin',array('class' => 'login-form','id' => 'login_form'))?>
<fieldset>
    <?php echo $signinForm['username']->render(); ?>
    <?php echo $signinForm['username']->renderError(); ?>

    <?php echo $signinForm['password']->render(); ?>
    <?php echo $signinForm['password']->renderError(); ?>

    <?php echo $signinForm['remember']->render(); ?>
    <?php echo $signinForm['remember']->renderLabel(); ?>

    <?php echo $signinForm->renderHiddenFields(); ?>
  <div class="enter-row">
    <a id="button-register" title="Регистрация пользователя MerryMall" href="<?php echo url_for('@sf_guard_register', array('ajax' => false)) ?>">регистрация</a>
    <input type="image" src="/images/buttons/enter.gif" alt="вход" />
  </div>
</fieldset>
</form>

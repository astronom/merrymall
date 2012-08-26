<div id="" class="random_shops" style="display: block; position: absolute!important; top: 258px; z-index: 1;">
  <table style="text-align: center;">
     <tr>
      <td><h3 style="color: #2e688d; font-size: 1.1em; font-weight: bold;">Вы можете также посетить:</h3><br/></td>
    </tr>
    <?php foreach($shopsRandomList as $shop): ?>
    <tr>
      <td style="vertical-align: middle;">
        <?php echo link_to(image_tag($shop->getLogo(),array('alt_title'=>$shop->getName(),'size' => '150x60')),'company',$shop)?>
    </tr>
    <?php endforeach; ?>
  </table>
</div>
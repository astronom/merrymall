<!-- Навигация по магазинам этажа -->
<div id="" class="floor_shops" style="display: block;  position: absolute!important; top: 258px; z-index: 6;">
  <table style="text-align: center;">
     <tr>
      <td><h3 style="color: #2e688d; font-size: 1.1em; font-weight: bold;">Магазины на <?php echo link_to($shopsOnFloor[0]->getFloor().'е', $shopsOnFloor[0]->getFloor()->getFloorLink()) ?></h3><br/></td>
    </tr>
    <?php foreach($shopsOnFloor as $shop): ?>
    <tr>
      <td style="vertical-align: middle;">

        <?php echo link_to(image_tag($shop->getLogo(),array('alt_title'=>$shop->getName(), 'size' => '150x60')),'company',$shop)?>
        <br />
    </tr>
    <?php endforeach; ?>
  </table>
</div>
<!-- End Навигация по магазинам этажа -->
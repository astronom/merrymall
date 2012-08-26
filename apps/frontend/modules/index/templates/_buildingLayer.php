<?php use_helper('Text', 'Global') ?>

<div id="building-layer">
  <div id="building-bg-repeat">
    <div id="building-bg">
      <div id="building">
        <?php foreach($floors as $floor): ?>
          <?php if ($floor->getType() == 'tabloid'): ?>
            <?php echo floor_tabloid_helper($floor, $news) ?>
          <?php else: ?>
            <?php echo floor_block_helper($floor) ?>
          <?php endif ?>
        <?php endforeach ?>
      </div>
      <div id="billboard-layer">
        <div id="billboard-left" class="billboard-container">
          <div class="billboard">
            <a href="<?php echo url_for('@company?company_name=ssb')?>">
              <img src="/images/adds/ssb.jpg" width="180" height="90"/>
            </a>
          </div>
        </div>
        <div id="billboard-right" class="billboard-container">
          <div class="billboard">
            <a href="<?php echo url_for('@company?company_name=elita-trаvel')?>">
              <img src="/images/adds/elita.jpg" width="180" height="90"/>
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

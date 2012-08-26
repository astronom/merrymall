<div class="sf_admin_list">
  <?php //if (!$pager->getNbResults()): ?>
    <p><?php //echo __('No result', array(), 'sf_admin') ?></p>
  <?php //else: ?>
    <table id="main_list" cellspacing="0">
      <thead>
        <tr>
          <th id="sf_admin_list_batch_actions"><input id="sf_admin_list_batch_checkbox" type="checkbox" onclick="checkAll();" /></th>
          <?php //include_partial('s_category/list_th_tabular', array('sort' => $sort)) ?>
          <th id="sf_admin_list_th_actions"><?php echo __('Actions', array(), 'sf_admin') ?></th>
        </tr>
      </thead>
      <tfoot>
        <tr>
          <th colspan="8">
            <?php //if ($pager->haveToPaginate()): ?>
              <?php //include_partial('ss/pagination', array('pager' => $pager)) ?>
            <?php //endif; ?>

            <?php //echo format_number_choice('[0] no result|[1] 1 result|(1,+Inf] %1% results', array('%1%' => $pager->getNbResults()), $pager->getNbResults(), 'sf_admin') ?>
            <?php //if ($pager->haveToPaginate()): ?>
              <?php //echo __('(page %%page%%/%%nb_pages%%)', array('%%page%%' => $pager->getPage(), '%%nb_pages%%' => $pager->getLastPage()), 'sf_admin') ?>
            <?php //endif; ?>
          </th>
        </tr>
      </tfoot>
      <tbody>
      <?php $firephp = sfFirePHP::getInstance(true);
      $firephp->fb($treeObject);?>
        <?php foreach ($treeObject as $i => $s_category): $odd = fmod(++$i, 2) ? 'odd' : 'even' ?>
          <tr id="node-<?php echo $s_category['id'] ?>" class="sf_admin_row <?php echo $odd ?><?php
          // insert hierarchical info
          $node = $s_category->getNode();
          if ($node->isValidNode() && $node->hasParent())
          {
            echo " child-of-node-".$node->getParent()->getId();
          }
          ?>">
            <?php include_partial('s_category/list_td_batch_actions', array('s_category' => $s_category, 'helper' => $helper)) ?>
            <?php include_partial('s_category/list_td_tabular', array('s_category' => $s_category)) ?>
            <?php include_partial('s_category/list_td_actions', array('s_category' => $s_category, 'helper' => $helper)) ?>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  <?php //endif; ?>
</div>
<script type="text/javascript">
/* <![CDATA[ */
function checkAll()
{
  var boxes = document.getElementsByTagName('input'); for(index in boxes) { box = boxes[index]; if (box.type == 'checkbox' && box.className == 'sf_admin_batch_checkbox') box.checked = document.getElementById('sf_admin_list_batch_checkbox').checked } return true;
}
$(document).ready(function()  {
  $("#main_list").treeTable({
    treeColumn: 2,
    initialState: 'collapsed'
  });

  // Configure draggable nodes
  $("#main_list .file, #main_list .folder").draggable({
    helper: "clone",
    opacity: .75,
    refreshPositions: true, // Performance?
    revert: "invalid",
    revertDuration: 300,
    scroll: true
  });

  // Configure droppable rows
  $("#main_list .file, #main_list .folder").each(function() {
    $(this).parents("tr").droppable({
      accept: ".file, .folder",
      drop: function(e, ui) {
        // Call jQuery treeTable plugin to move the branch
        var parentTr = $($(ui.draggable).parents("tr"));
        parentTr.appendBranchTo(this);
        var parentId = parentTr.attr("id");
        var thisId = this.id;
        $("#select_" + parentId).val(thisId.substr(5));
		//Проверяем изменилась ли структура дерева
        var treeParam_1 = $("#select_" + parentId).val();
        var treeParam_2 = $("#select_" + parentId).attr('name');
        if(treeParam_1 != treeParam_2.substring(10,treeParam_2.search(']')))
            {
            	$('.notice').hide();
            	$('#treeChange').show();
            }
      },
      hoverClass: "accept",
      over: function(e, ui) {
        // Make the droppable branch expand when a draggable node is moved over it.
        if(this.id != ui.draggable.parents("tr")[0].id && !$(this).is(".expanded")) {
          $(this).expand();
        }
      }
    });
  });

  // Make visible that a row is clicked
  $("table#main_list tbody tr").mousedown(function() {
    $("tr.selected").removeClass("selected"); // Deselect currently selected rows
    $(this).addClass("selected");
  });

  // Make sure row is selected when span is clicked
  $("table#main_list tbody tr span").mousedown(function() {
    $($(this).parents("tr")[0]).trigger("mousedown");
  });

  $('input[id="saveTree"]').click(function() { $('select[name="batch_action"] [value="batchOrder"]').attr('selected','selected'); $('form').submit();
  });
});
/* ]]> */
</script>

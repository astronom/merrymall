<ul id="store-catalog">
<?php
$prevLevel = 1;
foreach($treeObject->fetchTree(array('root_id' => $rootId), Doctrine_Core::HYDRATE_ARRAY) as $node)
{
  if(intval($node['level']) > 0) {
    if($prevLevel > 1 && $node['level'] == $prevLevel)  echo '</li>';

    if($node['level'] > $prevLevel)  echo '<ul>';
    elseif ($node['level'] < $prevLevel) echo str_repeat('</ul></li>', $prevLevel - $node['level']);
    echo '<li id="node'.$node['root_id'].$node['lft'].$node['rgt'].$node['level'].'">';
    echo link_to($node['name'],
                 'company_category',
    array('type' => $companyType,'url' => $companyUrl, 'category_id' => $node['id']));
    $prevLevel = $node['level'];
  }
}

?>
</ul>
<style type="text/css">
.jstree li { width: 200px !important; }
</style>
<script>
$(function () {
	// Settings up the tree - using $(selector).jstree(options);
	// All those configuration options are documented in the _docs folder
	$(".company-content-catalog")
		.jstree({
			// the list of plugins to include
			"plugins" : ["themes", "html_data", "ui", "cookies"],

			"themes" : {
						"theme" : "apple",
						"dots" : false,
						"icons" : false
					   },
			"cookies" : {
						"auto_save" : true,
						"cookie_options" : {
											"expires" : 7,
											"path"    : '/',
											"secure"  : false
											}
						},
			"core" : { "animation" : 400 }

});
	  $(".jstree a").live("click", function(e) {
		     location.href = $(this).attr('href');
		  });
});
</script>


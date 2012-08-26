<?php

function floor_div_helper ($floor_id, $floor_class, $floor_text = null)
{
    if (!$floor_text)
      $floor_text = $floor_id . ' этаж';
    $div = '<div id="floor-' . $floor_id . '" class="' . $floor_class .
           ' floor-block"><div class="floor-inside"><p class="floor-table">' . $floor_text . '</p></div></div>';

    return $div;
}

function floor_block_helper ($floor)
{
  $div = '';

  switch ($floor->getType())
  {
    case 'floor':
      $a_tag = '<a href="' . $floor->getFloorLink() . '" class="fl">';
      $div = '<div id="floor-' . $floor->getUrl() . '" class="' . $floor->getClass() .
             ' floor-block">' . $a_tag . '<div class="floor-inside"><p class="floor-table">' .
             $floor->getText() . '</p></div></a></div>';
      break;
    case 'cornice':
      $div = '<div class="' . $floor->getClass() . ' floor-block"></div>';
      break;
    case 'roof':
      $div = '<div class="' . $floor->getClass() . ' floor-block"></div>';
      break;
  }

  return $div;
}

function floor_tabloid_helper ($floor, $news)
{
  $tabloid_text = '';
  foreach ($news as $news_item)
  {
    $tabloid_text .= '<li><span class="date">' . $news_item->getDate() . '</span><span class="text">' . $news_item->getText(ESC_RAW) . '</span></li>';
  }

  $div = '<div id="tabloid" class="' . $floor->getClass() .
         ' floor-block"><div class="mask"><ul id="ticker">' . $tabloid_text . '</ul></div></div>';
  return $div;
}


function floor_select_helper ($floors, $floor_selected_id = null, $use_onclick = false )
{
  $fs = '<ul class="fs">';
  $fs .= '<div class="fs-bg-t">&nbsp;</div>';
  $fs .= '<div class="fs-bg-b">&nbsp;</div>';

  foreach($floors as $floor)
  {
    if ($floor->getType() == 'floor')
    {
      $selected_class = '';
      $onclick = '';
      if ($floor_selected_id == $floor->getUrl())
        $selected_class = 'floor-selected';
      if ($use_onclick)
        $onclick = 'onclick="scrollBuildingToFloor(' . $floor->getUrl() . '); return false;"';

      $a_tag = '<a href="' . $floor->getFloorLink() . '" ' . $onclick . ' class="fl ' . $selected_class . '">';
      $fs .= '<li>'. $a_tag . $floor->getName() . '</a></li>';
    }
  }
  $fs .= '</ul>';

  return $fs;
}

function url_for_floor ($floor_id)
{
  if ($floor_id == 1)
    $url = url_for('floor/hall');
  else
    $url = url_for('floor/index?floor_id=' . $floor_id);
  return $url;
}
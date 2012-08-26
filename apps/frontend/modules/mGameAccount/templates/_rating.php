<table width="70%">
<thead>
	<tr>
		<th>Позиция</th>
		<th>Игрок</th>
		<th>Рейтинг</th>
	</tr>
</thead>
<tbody>
<?php
$acccountInTop = false;
$curentRating = 0;
$position = 0;
foreach ($ratings as $rating) {

  if($curentRating != $rating->getRating())
  {
    $position ++;
    $curentRating = $rating->getRating();
  }
  if($rating->getSfGuardUser()->getUsername() == $sf_user->getUsername())
  {
    echo '<tr><td><b>'.$position.'</b></td><td><b>'.$rating->getSfGuardUser()->getUsername().'</b></td><td><b>'.$rating->getRating().'</b></td></tr>';
    $acccountInTop = true;
  }
  else
  {
    echo '<tr><td>'.$position.'</td><td>'.$rating->getSfGuardUser()->getUsername().'</td><td>'.$rating->getRating().'</td></tr>';
  }
}
if(!$acccountInTop)
{
   echo '<tr style="background: #ccc;"><td><b>'.($accountPosition +1).'</b></td><td><b>'.$sf_user->getUsername().'</b></td><td><b>'.$sf_user->getGuardUser()->getmGameAccount()->getRating().'</b></td></tr>';
}
?>
</tbody>
</table>
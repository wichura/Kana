<style>


.registry-column {
	float: left;
	width: 100px;
}

.registry-column li {
	list-style: none;
	height: 21px;
	line-height: 21px;
}

</style>


<div class="registry-column">
<li>Students</li>

<?php
// Render list of students
$lastProjectDate = null;
foreach ($register as $entry): 

	if ($lastProjectDate != null && $lastProjectDate != $entry->ProjectDate)
		break;

	?>

	<li><?php echo $entry->profile->LastName . " " . $entry->profile->FirstName ?></li>


	<?php $lastProjectDate = $entry->ProjectDate; 	endforeach; ?>

</div>


<?php

$lastProjectDate = null;
foreach ($register as $entry): 

	if ($lastProjectDate != null && $lastProjectDate != $entry->ProjectDate)
		echo "</div>";

	if ($lastProjectDate != $entry->ProjectDate)
		echo "<div class='registry-column'><li>" . $entry->ProjectDate . "</li>";

	?>

	
	<li><?php echo CHtml::checkbox("name", $entry->IsPresent == 1 ? true : false); ?></li>

	<?php 	$lastProjectDate = $entry->ProjectDate; endforeach; ?>
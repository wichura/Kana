<?php
$participants = User::model()->with(array("projects" => array(
	"condition" => "projects.Id = " . $this->project->Id,
	"order" => "LastName ASC"
	)))->findAll();
	?>

	
	<div class="badge badge-success"><?php echo count($participants) ?> uczestników</div>
	<br/><br/>

	<ol style="list-style: decimal">
	<?php
	foreach ($participants as $participant): ?>

	<li><a href="/user/admin/update/id/<?php echo $participant->id ?>"><?php echo $participant->getLabel() ?></a></li>


<?php endforeach; ?>

</ol>


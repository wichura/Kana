<h1 style="line-height: 65px; vertical-align: top"> <?php echo Html::gravatar($model->email) ?> <?php echo $profile->FirstName . " " . $profile->LastName; ?></h1>

<?php
	echo $this->renderPartial('_form', array('model'=>$model,'profile'=>$profile, 'allProjectsAvailableToTheUser' => $allProjectsAvailableToTheUser, 
            'activeProjectsForUser' => $activeProjectsForUser));
?>
<div class="list-view-item">
    <a href="<?php echo strtolower(get_class($data)) ?>/update/id/<?php echo $data->getPrimaryKey() ?>">
        <div style="width: 835px" class="column">
            <h4 class="model-label"><?php echo $data->getLabel() ?></h4>
            <hr />
            
            <ul class="horizontal">
                <li><?php echo $data->getAttributeLabel("SubjectTaught") ?>: <?php echo ProjectSubjectTaught::model()->findByPk($data->SubjectTaughtId)->Name ?></li>
                <li><?php echo $data->getAttributeLabel("AgeGroupId") ?>: <?php echo ProjectAgeGroup::model()->findByPk($data->AgeGroupId)->Name ?></li>
                <li><?php echo $data->getAttributeLabel("CourseTypeId") ?>: <?php echo CourseType::model()->findByPk($data->CourseTypeId)->Name ?></li>
                <li><?php echo $data->getAttributeLabel("CourseLevelId") ?>: <?php echo ProjectCourseLevel::model()->findByPk($data->CourseLevelId)->Name ?></li>
            </ul>

        </div>
    </a>
    <div class='actions hidden'>
        <a class='delete' href='<?php echo strtolower(get_class($data)) ?>/delete/id/<?php echo $data->getPrimaryKey() ?>'>&nbsp;</a>
    </div>
</div>
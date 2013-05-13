<?php
/* @var $this ProjectController */
/* @var $model Project */
/* @var $form CActiveForm */
?>

<div class="form">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'project-form',
        'enableAjaxValidation' => false,
    ));
    ?>

    <?php echo $form->errorSummary($model); ?>

    <div class="row">
        <?php echo $form->labelEx($model, 'Name'); ?>
        <?php echo $form->textField($model, 'Name', array('size' => 60, 'maxlength' => 255)); ?>
        <?php echo $form->error($model, 'Name'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'ProjectTypeId'); ?>
        <?php echo $form->dropDownList($model, "ProjectTypeId", CHtml::listData(ProjectType::model()->findAll(), "Id", "Name")) ?>
        <?php echo $form->error($model, 'ProjectTypeId'); ?>
    </div>
    
      <div class="row">
        <?php echo $form->labelEx($model, 'CourseTypeId'); ?>
        <?php echo $form->dropDownList($model, "CourseTypeId", CHtml::listData(CourseType::model()->findAll(), "Id", "Name")) ?>
        <?php echo $form->error($model, 'CourseTypeId'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'AgeGroupId'); ?>
        <?php echo $form->dropDownList($model, "AgeGroupId", CHtml::listData(ProjectAgeGroup::model()->findAll(), "Id", "Name")) ?>
        <?php echo $form->error($model, 'AgeGroupId'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'SubjectTaughtId'); ?>
        <?php echo $form->dropDownList($model, "SubjectTaughtId", CHtml::listData(ProjectSubjectTaught::model()->findAll(), "Id", "Name")) ?>
        <?php echo $form->error($model, 'SubjectTaughtId'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'CourseLevelId'); ?>
        <?php echo $form->dropDownList($model, "CourseLevelId", CHtml::listData(ProjectCourseLevel::model()->findAll(), "Id", "Name")) ?>
        <?php echo $form->error($model, 'CourseLevelId'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'Language'); ?>
        <?php echo $form->textField($model, 'Language', array('size' => 15, 'maxlength' => 15)); ?>
        <?php echo $form->error($model, 'Language'); ?>
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->
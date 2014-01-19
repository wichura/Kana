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

    $htmlOptionsDisabledOnUpdate = $model->getIsNewRecord() ? array() : array(
        "disabled" => "disabled"
        );
        ?>


        <?php echo $form->errorSummary($model); ?>
        <div class="row">
            <?php echo $form->labelEx($model, 'ProjectTypeId'); ?>
            <?php echo $form->dropDownList($model, "ProjectTypeId", CHtml::listData(ProjectType::model()->findAll(), "Id", "Name"), $htmlOptionsDisabledOnUpdate) ?>
            <?php echo $form->error($model, 'ProjectTypeId'); ?>
        </div>

        <div class="row">
            <?php echo $form->labelEx($model, 'TeacherUserId'); ?>
            <?php //echo $form->dropDownList($model, "TeacherUserId", CHtml::listData(User::model()->findAll(), "id", "username")) ?>
            <?php 

            $this->widget('application.widgets.mAutoComplete.MAutoComplete',array(
               'name'=>'Project[TeacherUserId]',
               'value' => $model->TeacherUserId,
               // 'value' => User::model()->findByPk($model->TeacherUserId)->getLabel(),
               'source'=> MHtml::autocompleteData(User::model()->findAll())
               ));

               ?>

               <?php echo $form->error($model, 'TeacherUserId'); ?>
           </div>


           <div class="row">
            <?php echo $form->labelEx($model, 'Description'); ?>
            <?php echo $form->textField($model, 'Description', array('size' => 20, 'maxlength' => 128)); ?>
            <?php echo $form->error($model, 'Description'); ?>
        </div>


        <div class="row">
            <?php echo $form->labelEx($model, 'CourseTypeId'); ?>
            <?php echo $form->dropDownList($model, "CourseTypeId", CHtml::listData(ProjectCourseType::model()->findAll(), "Id", "Name"), $htmlOptionsDisabledOnUpdate) ?>
            <?php echo $form->error($model, 'CourseTypeId'); ?>
        </div>

        <div class="row">
            <?php echo $form->labelEx($model, 'AgeGroupId'); ?>
            <?php echo $form->dropDownList($model, "AgeGroupId", CHtml::listData(ProjectAgeGroup::model()->findAll(), "Id", "Name"), $htmlOptionsDisabledOnUpdate) ?>
            <?php echo $form->error($model, 'AgeGroupId'); ?>
        </div>

        <div class="row">
            <?php echo $form->labelEx($model, 'SubjectTaughtId'); ?>
            <?php echo $form->dropDownList($model, "SubjectTaughtId", CHtml::listData(ProjectSubjectTaught::model()->findAll(), "Id", "Name"), $htmlOptionsDisabledOnUpdate) ?>
            <?php echo $form->error($model, 'SubjectTaughtId'); ?>
        </div>

        <div class="row">
            <?php echo $form->labelEx($model, 'CourseLevelId'); ?>
            <?php echo $form->dropDownList($model, "CourseLevelId", CHtml::listData(ProjectCourseLevel::model()->findAll(), "Id", "Name"), $htmlOptionsDisabledOnUpdate) ?>
            <?php echo $form->error($model, 'CourseLevelId'); ?>
        </div>


        <div class="row">
            <?php echo $form->labelEx($model, 'StartDate'); ?>
            <?php $this->widget('zii.widgets.jui.CJuiDatePicker',array(
                'name'=>'Project[StartDate]',
                "value" => $model->StartDate,
            // additional javascript options for the date picker plugin
                'options'=>array(
                    'showAnim'=>'fold',
                    'dateFormat' => "yy-mm-dd"
                    )
                ));
                ?>
                <?php echo $form->error($model, 'StartDate'); ?>
            </div>


            <div class="row">
                <?php echo $form->labelEx($model, 'EndDate'); ?>
                <?php $this->widget('zii.widgets.jui.CJuiDatePicker',array(
                    'name'=>'Project[EndDate]',
                    "value" => $model->EndDate,
                         // additional javascript options for the date picker plugin
                    'options'=>array(
                     'showAnim'=>'fold',
                     'dateFormat' => "yy-mm-dd"
                     )
                    ));
                    ?>
                    <?php echo $form->error($model, 'EndDate'); ?>
                </div>

                <div class="row">
                    <?php echo $form->labelEx($model, 'ProjectPlace'); ?>
                    <?php echo $form->textField($model, 'ProjectPlace', array('size' => 20, 'maxlength' => 20)); ?>
                    <?php echo $form->error($model, 'ProjectPlace'); ?>

                    <?php if ($model->ProjectPlace != null): ?>
                       <a target="_blank" href="https://maps.google.co.uk/?q=<?php echo $model->ProjectPlace ?>"> Mapa</a>
                   <?php endif; ?>
               </div>

               <div class="row buttons">
                <?php echo CHtml::submitButton($model->isNewRecord ? Yii::t("mata", "Create") : Yii::t("mata", "Update")); ?>
            </div>

            <?php $this->endWidget(); ?>

</div><!-- form -->


<script>


$(window).ready(function() {
    
})

</script>
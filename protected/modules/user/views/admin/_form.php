<div class="form">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'user-form',
        'enableAjaxValidation' => true,
        'htmlOptions' => array('enctype' => 'multipart/form-data'),
    ));
    ?>

    <?php echo $form->errorSummary(array($model, $profile)); ?>

    <div class="row">
        <?php echo $form->labelEx($model, 'username'); ?>
        <?php echo $form->textField($model, 'username', array('size' => 20, 'maxlength' => 20)); ?>
        <?php echo $form->error($model, 'username'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'password'); ?>
        <?php echo $form->passwordField($model, 'password', array('size' => 60, 'maxlength' => 128)); ?>
        <?php echo $form->error($model, 'password'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'email'); ?>
        <?php echo $form->textField($model, 'email', array('size' => 60, 'maxlength' => 128)); ?>
        <?php echo $form->error($model, 'email'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'superuser'); ?>
        <?php echo $form->dropDownList($model, 'superuser', User::itemAlias('AdminStatus')); ?>
        <?php echo $form->error($model, 'superuser'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'status'); ?>
        <?php echo $form->dropDownList($model, 'status', User::itemAlias('UserStatus')); ?>
        <?php echo $form->error($model, 'status'); ?>
    </div>
    <?php
    $profileFields = Profile::getFields();
    if ($profileFields) {
        foreach ($profileFields as $field) {
            ?>
            <div class="row">
                <?php echo $form->labelEx($profile, $field->varname); ?>
                <?php
                if ($widgetEdit = $field->widgetEdit($profile)) {
                    echo $widgetEdit;
                } elseif ($field->range) {
                    echo $form->dropDownList($profile, $field->varname, Profile::range($field->range));
                } elseif ($field->field_type == "TEXT") {
                    echo CHtml::activeTextArea($profile, $field->varname, array('rows' => 6, 'cols' => 50));
                } else {
                    echo $form->textField($profile, $field->varname, array('size' => 60, 'maxlength' => (($field->field_size) ? $field->field_size : 255)));
                }
                ?>
                <?php echo $form->error($profile, $field->varname); ?>
            </div>
            <?php
        }
    }
    ?>


    <?php
    if ($model->id != $this->user->getId()):
        echo Html::label("Projects", false);
        $this->widget("project.widgets.projectSelector.ProjectSelector", array(
            "projects" => $allProjectsAvailableToTheUser,
            "activeProjects" => $activeProjectsForUser
        ));
        ?>


    <?php endif; ?>

    <div class="row buttons">
        <?php echo CHtml::submitButton($model->isNewRecord ? UserModule::t('Create') : UserModule::t('Save')); ?>
    </div>

    <?php $this->endWidget(); ?>
    <script>
        $("#Profile_IncomePerPerson, #Profile_NoOfPeopleInHousehold").on("keyup", calculateAverageIncome);

        function calculateAverageIncome() {

            var incomePerPerson = $("#Profile_IncomePerPerson").val();
            var noOfPeopleInHousehold = $("#Profile_NoOfPeopleInHousehold").val();

            if (incomePerPerson != "" && noOfPeopleInHousehold != "" &&
                    parseInt(incomePerPerson) != NaN && parseInt(noOfPeopleInHousehold) != NaN)
                $("#Profile_AverageIncome").val(incomePerPerson / noOfPeopleInHousehold)
        }


        $(window).ready(function() {
            $("#Profile_IsStudent").parents(".row").first().hide()
            if (<?php echo $profile->IsStudent ?> == false) {
                $("#Profile_PlaceOfBirth, #Profile_DateOfBirth, #Profile_TelephoneGuardian, #Profile_EmailGuardian, " +
                        "#Profile_IncomePerPerson, #Profile_Pesel, #Profile_NoOfPeopleInHousehold, #Profile_AverageIncome, #Profile_StudentStatus").each(function(i, el) {
                    $(el).val(null)
                    $(el).parents(".row").first().hide();
                });



            }

        })

    </script>
</div><!-- form -->

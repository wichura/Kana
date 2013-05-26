<?php $this->pageTitle = Yii::app()->name . ' - ' . UserModule::t("Registration");
?>

<h1><?php echo UserModule::t("Registration"); ?></h1>

<?php if (Yii::app()->user->hasFlash('registration')): ?>
    <div class="success">
        <?php echo Yii::app()->user->getFlash('registration'); ?>
    </div>
<?php else: ?>

    <div class="form">
        <?php
        $form = $this->beginWidget('UActiveForm', array(
            'id' => 'registration-form',
            'enableAjaxValidation' => true,
            'disableAjaxValidationAttributes' => array('RegistrationForm_verifyCode'),
            'clientOptions' => array(
                'validateOnSubmit' => true,
            ),
            'htmlOptions' => array('enctype' => 'multipart/form-data'),
        ));
        ?>

        <?php echo $form->errorSummary(array($model, $profile)); ?>

        <div class="row">
            <?php echo $form->labelEx($model, 'username'); ?>
            <?php echo $form->textField($model, 'username'); ?>
            <?php echo $form->error($model, 'username'); ?>
        </div>

        <div class="row">
            <?php echo $form->labelEx($model, 'password'); ?>
            <?php echo $form->passwordField($model, 'password'); ?>
            <?php echo $form->error($model, 'password'); ?>
            <p class="hint">
                <?php echo UserModule::t("Minimal password length 4 symbols."); ?>
            </p>
        </div>

        <div class="row">
            <?php echo $form->labelEx($model, 'verifyPassword'); ?>
            <?php echo $form->passwordField($model, 'verifyPassword'); ?>
            <?php echo $form->error($model, 'verifyPassword'); ?>
        </div>

        <div class="row">
            <?php echo $form->labelEx($model, 'email'); ?>
            <?php echo $form->textField($model, 'email'); ?>
            <?php echo $form->error($model, 'email'); ?>
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
                        echo$form->textArea($profile, $field->varname, array('rows' => 6, 'cols' => 50));
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
        <?php if (UserModule::doCaptcha('registration')): ?>
            <div class="row">
                <?php echo $form->labelEx($model, 'verifyCode'); ?>

                <?php $this->widget('CCaptcha'); ?>
                <?php echo $form->textField($model, 'verifyCode'); ?>
                <?php echo $form->error($model, 'verifyCode'); ?>

                <p class="hint"><?php echo UserModule::t("Please enter the letters as they are shown in the image above."); ?>
                    <br/><?php echo UserModule::t("Letters are not case-sensitive."); ?></p>
            </div>
        <?php endif; ?>

        <div class="row submit">
            <?php echo CHtml::submitButton(UserModule::t("Register")); ?>
        </div>

        <?php $this->endWidget(); ?>


        <script>

            $(window).ready(function() {
                $("#Profile_AverageIncome").attr("disabled", "disabled");
                
                $("#Profile_IsStudent").val(0)
                hideStudentFields();


                $("#Profile_IsStudent").on("change", function() {
                    $(this).val() == 1? showStudentFields() : hideStudentFields();
                })

            })

            $("#Profile_IncomePerPerson, #Profile_NoOfPeopleInHousehold").on("keyup", calculateAverageIncome);

            function calculateAverageIncome() {

                var incomePerPerson = $("#Profile_IncomePerPerson").val();
                var noOfPeopleInHousehold = $("#Profile_NoOfPeopleInHousehold").val();

                if (incomePerPerson != "" && noOfPeopleInHousehold != "" &&
                        parseInt(incomePerPerson) != NaN && parseInt(noOfPeopleInHousehold) != NaN)
                    $("#Profile_AverageIncome").val(incomePerPerson / noOfPeopleInHousehold)
            }



            function showStudentFields() {
                $("#Profile_PlaceOfBirth, #Profile_DateOfBirth, #Profile_TelephoneGuardian, #Profile_EmailGuardian, " +
                        "#Profile_IncomePerPerson, #Profile_NoOfPeopleInHousehold, #Profile_AverageIncome, #Profile_StudentStatus").each(function(i, el) {
                    $(el).parents(".row").first().show();
                });
            }

            function hideStudentFields() {
                $("#Profile_PlaceOfBirth, #Profile_DateOfBirth, #Profile_TelephoneGuardian, #Profile_EmailGuardian, " +
                        "#Profile_IncomePerPerson, #Profile_NoOfPeopleInHousehold, #Profile_AverageIncome, #Profile_StudentStatus").each(function(i, el) {
                    $(el).val(null)
                    $(el).parents(".row").first().hide();
                });
            }
        </script>
    </div><!-- form -->
<?php endif; ?>
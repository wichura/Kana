<?php

class RegistrationController extends MataModuleController {

    public $defaultAction = 'registration';

    /**
     * Declares class-based actions.
     */
    public function actions() {
        return array(
            'captcha' => array(
                'class' => 'CCaptchaAction',
                'backColor' => 0xFFFFFF,
            ),
        );
    }

    /**
     * Registration user
     */
    public function actionRegistration() {
        Profile::$regMode = true;
        $model = new RegistrationForm;
        $profile = new Profile;

        // ajax validator
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'registration-form') {
            echo UActiveForm::validate(array($model, $profile));
            Yii::app()->end();
        }

        if (isset($_POST['RegistrationForm'])) {
            $model->attributes = $_POST['RegistrationForm'];
            $profile->attributes = ((isset($_POST['Profile']) ? $_POST['Profile'] : array()));
            if ($model->validate() && $profile->validate()) {
                $soucePassword = $model->password;
                $model->activkey = UserModule::encrypting(microtime() . $model->password);
                $model->password = UserModule::encrypting($model->password);
                $model->verifyPassword = UserModule::encrypting($model->verifyPassword);
                $model->superuser = 0;
                $model->status = ((Yii::app()->controller->module->activeAfterRegister) ? User::STATUS_ACTIVE : User::STATUS_NOACTIVE);

                if ($model->save()) {
                    $profile->user_id = $model->id;
                    $profile->save();
                    if (Yii::app()->controller->module->sendActivationMail) {
                        $activation_url = $this->createAbsoluteUrl('/user/activation/activation', array("activkey" => $model->activkey, "email" => $model->email));
                        UserModule::sendMail($model->email, UserModule::t("You registered from {site_name}", array('{site_name}' => Yii::app()->name)), UserModule::t("Please activate you account go to {activation_url}", array('{activation_url}' => $activation_url)));
                    }


                    Yii::app()->eventLog->record(Yii::app()->user->FirstName . " " . Yii::app()->user->LastName . " added " .
                            $model->profile->FirstName . " " . $model->profile->LastName);

                    if ((Yii::app()->controller->module->loginNotActiv || (Yii::app()->controller->module->activeAfterRegister && Yii::app()->controller->module->sendActivationMail == false)) && Yii::app()->controller->module->autoLogin) {
                        $identity = new UserIdentity($model->username, $soucePassword);
                        $identity->authenticate();
                        Yii::app()->user->login($identity, 0);
                        $this->redirect(Yii::app()->controller->module->returnUrl);
                    } else {
                        if (!Yii::app()->controller->module->activeAfterRegister && !Yii::app()->controller->module->sendActivationMail) {
                            Yii::app()->user->setFlash('registration', UserModule::t("Thank you for your registration. Contact Admin to activate your account."));
                        } elseif (Yii::app()->controller->module->activeAfterRegister && Yii::app()->controller->module->sendActivationMail == false) {
                            Yii::app()->user->setFlash('success', UserModule::t("Użytkownik zarejestrowany"));
                        } elseif (Yii::app()->controller->module->loginNotActiv) {
                            Yii::app()->user->setFlash('registration', UserModule::t("Thank you for your registration. Please check your email or login."));
                        } else {
                            Yii::app()->user->setFlash('registration', UserModule::t("Thank you for your registration. Please check your email."));
                        }
                         $this->redirect("/user/admin");
                    }
                }
            }
            else
                $profile->validate();
        }

        $basePath = Yii::getPathOfAlias('application.modules.user.assets');
        $baseUrl = Yii::app()->getAssetManager()->publish($basePath);
        $cs = Yii::app()->getClientScript();
        $cs->registerScriptFile($baseUrl . '/js/kana.js');
        $this->render('/user/registration', array('model' => $model, 'profile' => $profile));
    }

    public function getModel() {
        return User::model();
    }

}
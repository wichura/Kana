<?php

class RegisterController extends MataController {

    public $layout = 'mata.views.layouts.mataModule';

    public function actionIndex() {
        $this->render("register");
    }
    
     public function actionStudents($projectId) {

     	$model = Project::model()->findByPk($projectId);
     	$register = Register::model()->with("profile")->findAllByAttributes(array(
     		"ProjectId" => $model->Id
     		), array(
     		"order" => "ProjectDate, profile.LastName ASC"
     		));

     	$this->setData("model", $model);
     	$this->setData("register", $register);
        $this->render("students");
    }

}

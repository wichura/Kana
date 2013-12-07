<?php

class RegisterController extends MataController {

    public $layout = 'mata.views.layouts.mataModule';

    public function actionIndex() {
        $this->render("register");
    }
    
     public function actionStudents($projectId) {
        $this->render("students");
    }

}

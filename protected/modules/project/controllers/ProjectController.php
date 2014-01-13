<?php

class ProjectController extends MataModuleController {

    public function getModel() {
        return Project::model();
    }

    public function actionGetProjectsSelector() {
        $this->widget("project.widgets.projectSelector.ProjectSelector");
    }

    public function actionToCSV($id) {

        $project = Project::model()->findByPk($id);
        User::model()->with(array("projects" => array(
            "condition" => "projects.Id = " . $id
            )))->findAllToCSV($project->getLabel() . " - uczestnicy");
    }

    
    public function actionX() {

        $projects = Project::model()->findAllByAttributes(array(
            "Name" => "G-ND-JU-JA-O-0045",
            "CreatorUserId" => 1
            ));
        
        
        
        foreach ($projects as $project) {
            echo $project->Name . "<br/><br/>";
        }
        
    }
}

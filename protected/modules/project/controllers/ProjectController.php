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

}

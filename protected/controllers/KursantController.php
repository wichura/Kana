<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of KursantController
 *
 * @author wichura
 */
class KursantController extends BaseApplicationController {

    public function actionIndex() {

        $models = Project::model()->resetScope()->findAll(array(
            "order" => "t.Name"
        ));

        echo "<table>";
        foreach ($models as $project) {
            echo "<tr><td></td></tr>";
            echo "<tr><td></td></tr>";
            echo "<tr><td></td></tr>";
            echo "<tr><td>";
            echo "<strong>" . $project->label . "</strong>";
            echo "</td></tr>";

            foreach ($project->users as $user) {
                echo "<tr>";

                echo "<td>$user->label</td>";
                echo "</tr>";
            }
        }
        echo "</table>";
    }

}

?>

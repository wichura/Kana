

<label>Wybierz zajecia</label>

<?php
$this->widget("project.widgets.projectSelector.ProjectSelector", array(
    "id" => "projects",
    "projects" => Project::model()->findAll(),
    "activeProjects" => array()
));
?>

<script>


    $(window).ready(function() {
        $("#projects").on("click", ".multioption-element", function() {
            window.location.href = "/register/register/students/projectId/" + $(this).attr("data-project-id")
        })
    })

    function navigateToProject(projectId) {
        
    }

</script>

<h1> <?php echo $model->getLabel(); ?> </h1>

<?php $this->widget("application.widgets.studentList.StudentList", array(
        "project" => $model
        )) ?>

        <br /> <br/>
<?php if (array_key_exists("versions", $model->behaviors())): ?>
    <div class='versions'>
        <a onclick='getVersions("<?php echo "/$modelNameLowerCase/$modelNameLowerCase/getVersions/id/$model->Id" ?>")' href='#'>Versions</a>
    </div>
<?php endif; ?>
<br/>
<a href="/project/project/toCSV/id/<?php echo $model->Id ?>">Exportuj do Excela</a>
<br/><br/>

<?php echo $this->renderPartial('_form', array('model' => $model)); ?>

<script>
        function getVersions(url) {
            mata.dialogBox.renderView("Previous Versions", url)
        }
        
        $(".avatar").tooltip()
</script>

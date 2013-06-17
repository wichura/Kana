<h1> <?php echo $model->getLabel(); ?> <span class="badge badge-success">


        <?php
        $participants = User::model()->with(array("projects" => array(
                        "condition" => "projects.Id = " . $model->Id
            )))->findAll();
        ?>
        <?php echo count($participants) ?> uczestników</span></h1>

<?php if (array_key_exists("versions", $model->behaviors())): ?>
    <div class='versions'>
        <a onclick='getVersions("<?php echo "/$modelNameLowerCase/$modelNameLowerCase/getVersions/id/$model->Id" ?>")' href='#'>Versions</a>
    </div>
<?php endif; ?>

<?php
foreach ($participants as $participant) {
    echo Html::gravatar($participant->email, $participant->getLabel()) . " ";
}
?>
<br/><br/>

<?php echo $this->renderPartial('_form', array('model' => $model)); ?>

<script>
        function getVersions(url) {
            mata.dialogBox.renderView("Previous Versions", url)
        }

</script>

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
foreach ($participants as $participant): ?>

<!--
    echo CHtml::link(Html::gravatar($participant->email, $participant->getLabel(), array(
        "data-toggle" => "tooltip",
        "data-original-title" => $participant->getLabel()
    )) . " ", "/user/admin/update/id/" . $participant->id);
-->

<li><?php echo $participant->getLabel() ?></li>


<?php 
endforeach;
?>
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

<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of MataActiveRecord
 *
 * @author wichura
 */
class MataActiveRecord extends BaseActiveRecord {

    public function behaviors() {
        return array(
            "versions" => "mata.behaviors.VersionedModelBehavior",
            "exportToCSV" => "mata.behaviors.ExportToCSVBehavior"
        );
    }

    public function defaultScope() {

        $scope = array();
        if ($this->hasAttribute("ProjectKey"))
            $scope = array(
                "condition" => "ProjectKey = '" . Yii::app()->user->project->ProjectKey . "'"
            );

        return $scope;
    }

    public function beforeValidate() {
        $this->setProjectKey();
        $this->manageCMSUser();
        $this->manageContentLanguage();
        return parent::beforeValidate();
    }

    protected function manageCMSUser() {

        if ($this->hasAttribute("CreatorUserId") &&
                $this->CreatorUserId == null && $this->getIsNewRecord()) {
            $this->CreatorUserId = Yii::app()->user->getId();
        }

        if ($this->hasAttribute("ModifierUserId") && $this->ModifierUserId == null)
            $this->ModifierUserId = Yii::app()->user->getId();
    }

    protected function setProjectKey() {
        if ($this->hasAttribute("ProjectKey") && $this->ProjectKey == null) {
            $this->ProjectKey = Yii::app()->user->getProject()->ProjectKey;
        }
    }

    private function manageContentLanguage() {
        if ($this->hasAttribute("ContentLanguage") && $this->ContentLanguage == null)
            $this->ContentLanguage = Yii::app()->getContentLanguage();
    }

    public function getSortableAttributes() {
        return array();
    }

    public function getLabel() {
        return $this->getPrimaryKey();
    }

}

?>

<?php

class MHtml extends CHtml {

	public static function autocompleteData($models,$valueField = null,$textField = null,$groupField='') {
		$firstModel = current($models);
		if ($valueField == null)
			$valueField = $firstModel->tableSchema->primaryKey;

		if ($textField == null)
			$textField = $firstModel->getLabel();

		$autocompleteData = array();

		foreach($models as $model)
		{
			$autocompleteData[] = array(
		         'label'=>$model->getLabel(),  // label for dropdown list
		         'value'=>$model->getPrimaryKey(),  // value for input field
		         );
		}


		return $autocompleteData;

	}



}
<?php


Yii::import("zii.widgets.jui.CJuiAutoComplete");

class MAutoComplete extends CJuiAutoComplete {


	public function init() {

		if (is_array($this->source)) {
			foreach($this->source as $value) {
				if ($value["value"] == $this->value)
					$this->value = $value["label"];
			}
		}

		parent::init();
	}
}
<?php
namespace Mouf\MVC\BCE\Classes\ScriptManagers;


class ScriptManager {
	
	private $scripts = array();
	
	const SCOPE_READY = "ready";
	const SCOPE_LOAD = "load";
	const SCOPE_UNLOAD = "unload";
	const SCOPE_WINDOW = "unload";

	/*
	 * $jsValidate = $this->validationHandler->getValidationJs($this->attributes['id']);
		$keys = array_keys($jsValidate);
		$scope = $keys[0];
		$this->addScript($scope, $jsValidate[$scope]);
	 * 
	 * */
	
	public function addScript($scope, $script){
		$this->scripts[$scope][] = $script;
	}
	
	public function renderScripts(){
		$jsPrefix = $jsSuffix = $js = "";
		$rendererScripts = array();
		
		foreach ($this->scripts as $scope => $values){
			if ($scope != self::SCOPE_WINDOW){
				$rendererScripts[] = "
				$(document).$scope(function(){
					" . implode("\n", $values) . "
				});";
			}else{
				$rendererScripts[] = "
					" . implode("\n", $values);
				
			}
		}
		
		return '
		<script type="text/javascript">
		<!--
			'.implode("\n", $rendererScripts).'
		//-->
		</script>';
	}
	
}
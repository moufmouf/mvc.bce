<?php
namespace Mouf\MVC\BCE\Classes\Renderers;

use Mouf\MVC\BCE\Classes\Descriptors\FieldDescriptorInstance;
use Mouf\MVC\BCE\Classes\Descriptors\BaseFieldDescriptor;
use Mouf\Html\Widgets\Form\TextAreaField;
/**
 * Base class for rendering simple text area fields
 * @Component
 */
class TextAreaFieldRenderer extends BaseFieldRenderer implements SingleFieldRendererInterface, ViewFieldRendererInterface {
	
	/**
	 * (non-PHPdoc)
	 * @see FieldRendererInterface::render()
	 */
	public function renderEdit($descriptorInstance){
		/* @var $descriptorInstance FieldDescriptorInstance */
		$fieldName = $descriptorInstance->getFieldName();
		$value = $descriptorInstance->getFieldValue();
		

		$textareaField = new TextAreaField($descriptorInstance->fieldDescriptor->getFieldLabel(), $descriptorInstance->getFieldName(), $descriptorInstance->getFieldValue());
		if(isset($descriptorInstance->attributes['classes'])) {
			$textareaField->setInputClasses($descriptorInstance->attributes['classes']);
		}
		
		$textareaField->getInput()->setId($descriptorInstance->getFieldName());
		$textareaField->getInput()->setReadonly((!$descriptorInstance->fieldDescriptor->canEdit()) ? "readonly" : null);
		if(isset($descriptorInstance->attributes['styles'])) {
			$textareaField->getInput()->setStyles($descriptorInstance->attributes['styles']);
		}
		
		$textareaField->setHelpText($descriptorInstance->fieldDescriptor->getDescription());
		
		$textareaField->setRequired(BCEValidationUtils::hasRequiredValidator($descriptorInstance->fieldDescriptor->getValidators()));
		
		ob_start();
		$textareaField->toHtml();
		return ob_get_clean();
	}
	
	/**
	 * (non-PHPdoc)
	 * @see FieldRendererInterface::getJS()
	 */
	public function getJSEdit($descriptor, $bean, $id){
		/* @var $descriptorInstance FieldDescriptorInstance */
		return array();
	}
	
	/**
	 * (non-PHPdoc)
	 * @see \Mouf\MVC\BCE\Classes\Renderers\ViewFieldRendererInterface::renderView()
	 */
	public function renderView($descriptorInstance){
				/* @var $descriptorInstance FieldDescriptorInstance */
		$fieldName = $descriptorInstance->getFieldName();
		return "<div id='".$fieldName."' name='".$fieldName."'>". $descriptor->getFieldValue() ."</div>";
	}
	
	/**
	 * (non-PHPdoc)
	 * @see \Mouf\MVC\BCE\Classes\Renderers\ViewFieldRendererInterface::getJSView()
	 */
	public function getJSView($descriptor, $bean, $id){
		/* @var $descriptorInstance FieldDescriptorInstance */
		return array();
	}
	
}
<?php
namespace Mouf\MVC\BCE\FormRenderers\Bootstrap;

use Mouf\Html\Widgets\Form\Styles\LayoutStyle;

use Mouf\MVC\BCE\BCEFormInstance;

use Mouf\MVC\BCE\Classes\Descriptors\FieldDescriptorInstance;

use Mouf\MVC\BCE\Classes\Descriptors\BCEFieldDescriptorInterface;
use Mouf\MVC\BCE\FormRenderers\BCERendererInterface;
use Mouf\Html\Utils\WebLibraryManager\WebLibrary;
use Mouf\MVC\BCE\BCEForm;
/**
 * This is a simple form rendering class, using a simple field layout :
 *
 * @Component
 *
 */
class BootstrapFormRenderer implements BCERendererInterface {
	
	/**
	 * @Property
	 * @var WebLibrary
	 */
	public $skin;
	
	/**
	 * (non-PHPdoc)
	 * @see \Mouf\MVC\BCE\FormRenderers\BCERendererInterface::render()
	 * @param FieldDescriptorInstance
	 */
	public function render(BCEForm $form, $descriptorInstances,	FieldDescriptorInstance $idDescriptorInstance){
		$editMode = $form->getMode() == "edit";
		if ($editMode && $form->isMain){
			if(isset($form->attributes['class'])) {
				$form->attributes['class'] = $form->attributes['class'];
			} else {
				$form->attributes['class'] = "";
			}
			
			if ($form->getDefaultLayout()->getLayoutType() == LayoutStyle::LAYOUT_INLINE){
				$form->attributes['class'] .= " form-horizontal";
			}
	?>
		<form class="<?php echo $form->attributes["class"] ?>" action="<?php echo ROOT_URL.$form->action; ?>" method="<?php echo $form->method?>" <?php foreach ($form->attributes as $attrName => $value){ echo "$attrName='$value' "; }?> role="form">
	<?php
		}
		echo $idDescriptorInstance->toHtml($form->getMode());
		foreach ($descriptorInstances as $descriptorInstance) {
			/* @var $descriptor BCEFieldDescriptorInterface */
			$descriptorInstance->toHtml($form->getMode());
		}
		if ($editMode && $form->isMain){
		?>
			<div class="form-actions">
				<button class="btn btn-primary" type="submit"><?php echo $form->saveLabel; ?></button>
				<button class="btn" type="reset"><?php echo $form->cancelLabel; ?></button>
			</div>
		</form>
	<?php
		}	
	}
	
	public function getSkin(){
		return $this->skin;
	}
}	
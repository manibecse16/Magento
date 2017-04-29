<?php
class LWM_Youtube_IndexController extends Mage_Core_Controller_Front_Action{
    public function IndexAction() {
      
	  $this->loadLayout();   
	  $this->getLayout()->getBlock("head")->setTitle($this->__("Youtube Videos"));
	        $breadcrumbs = $this->getLayout()->getBlock("breadcrumbs");
      $breadcrumbs->addCrumb("home", array(
                "label" => $this->__("Home Page"),
                "title" => $this->__("Home Page"),
                "link"  => Mage::getBaseUrl()
		   ));

      $breadcrumbs->addCrumb("youtube videos", array(
                "label" => $this->__("Youtube Videos"),
                "title" => $this->__("Youtube Videos")
		   ));

      $this->renderLayout(); 
	  
    }
   public function loadDataAction()
	{
        $this->loadLayout();
        $block = $this->getLayout()->createBlock('lwmyoutube/index') ->setTemplate('lwmyoutube/response.phtml');
		$this->getResponse()->setBody($block->toHtml());
	}
}
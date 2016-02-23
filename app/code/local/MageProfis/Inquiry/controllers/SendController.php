<?php
class MageProfis_Inquiry_SendController extends Mage_Core_Controller_Front_Action
{
	function indexAction()
	{
        Mage::getModel('inquiry/sendmail')->sendTransactionalEmail();
        
        $this->loadLayout();
        $this->renderLayout();
	}
}
?>

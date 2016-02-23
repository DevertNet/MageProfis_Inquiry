<?php
class MageProfis_Inquiry_Model_Sendmail extends Mage_Core_Model_Abstract
{
    public function sendTransactionalEmail()
    {
        /*
         * Loads the html file named 'inquiry_customer.html' from
         * app/locale/de_DE/template/email/inquiry_customer.html
         */ 
        $emailTemplate  = Mage::getModel('core/email_template')
                                ->loadDefault('inquiry_customer');									

        $action = Mage::app()->getFrontController()->getAction();
        $data = $action->getRequest()->getParams();
        
        $product = Mage::getModel('catalog/product')->load( $data['product_id'] );
        
        if ( $product->getId() == $data['product_id'] ) {
            $emailData = new Varien_Object();
            $emailData->setId( time() );
            $emailData->setDate( date('d.m.Y') );
            $emailData->setProductname( $product->getName() );
            $emailData->setProductsku( $product->getSku() );
            $emailData->setPrefix( $data['inquiry']['prefix'] );
            $emailData->setName( $data['inquiry']['name'] );
            $emailData->setStreet( $data['inquiry']['street'] );
            $emailData->setZip( $data['inquiry']['zip'] );
            $emailData->setCity( $data['inquiry']['city'] );
            $emailData->setPhone( $data['inquiry']['phone'] );
            $emailData->setEmail( $data['inquiry']['email'] );
            $emailData->setComment( $data['inquiry']['comment'] );

            //just for debugging
            
            $processedTemplate = $emailTemplate->getProcessedTemplate(array(
                'inquiry'=>$emailData
            ));
            //echo $processedTemplate;
            //die;
            
            //send mail
            $emailTemplate->setSenderName( Mage::getStoreConfig('trans_email/ident_sales/name') );
            $emailTemplate->setSenderEmail( Mage::getStoreConfig('trans_email/ident_sales/email') );
            $emailTemplate->addBcc( Mage::getStoreConfig('trans_email/ident_sales/email') );
            //$emailTemplate->setReplyTo( $data['inquiry']['email'] ); // Es sollten besser zwei Mails verschickt werden, da der Kunde sonst sich selbst schreibt...
            
            $emailTemplate->send($data['inquiry']['email'], $data['inquiry']['name'], array(
                'inquiry'=>$emailData
            ));
            
        
            
        }else{
            Zend_Debug::dump("MageProfis_Inquiry: Can't find product!", 'debug');
            die;
        }
    }
}
<?php

class TM_Easyslide_IndexController extends Mage_Core_Controller_Front_Action
{
    public function indexAction()
    {
        $this->_forward('getListXml');
    }
    
    public function getListXmlAction()
    {
        $collection = Mage::getModel('easyslide/easyslide')->getCollection();
        //$collection->setPageSize(5);
        //$collection->setCurPage(1);
        //$size = $collection->getSize();
        //$count = count($collection);
        
        $output = '<?xml version="1.0" encoding="iso-8859-1"?><photogallery>';
        $output .= $this->_getConfigXml();
        $output .= '<gallery>';
        foreach ($collection as $item) {
            if (!$item->getStatus()) {
                continue;
            }
            $output .= '<image>';
            $output .= '<image>'       . $item->getImage()       . '</image>';
            $output .= '<url>'          . $item->getUrl()           . '</url>';
            $output .= '<target>'          . $item->getTarget()           . '</target>';
            $output .= '<title>'        . $item->getTitle()         . '</title>';
            $output .= '<description>'  . $item->getDescription()   . '</description>';
            $output .= '</image>';
        }
        $output .= '</gallery></photogallery>';
        echo $output;
    }
    
    private function _getConfigXml()
    {
        $output = '<config>';
        $output .= '<imageFolder>'   . Mage::getBaseUrl() . Mage::getStoreConfig('easyslide/options/image')   . '</imageFolder>';
        $output .= '</config>';
        return $output;
    }
    
}
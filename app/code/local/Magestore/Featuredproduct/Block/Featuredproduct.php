<?php
class Magestore_Featuredproduct_Block_Featuredproduct extends Mage_Catalog_Block_Product_Abstract
{
	const XML_PATH_NUMBER_SHOWN_PRODUCT = 'featuredproduct/general/show_product_number';
	const XML_PATH_DELAY_TIME = 'featuredproduct/general/delay_time';
	const XML_PATH_SHOWN_TYPE = 'featuredproduct/general/show_type';
	
	public function __construct()
    {
        parent::__construct();
		$number = $this->getNumberShownProduct();

		$products = Mage::getResourceModel('catalog/product_collection')
			->addAttributeToSelect('*')
            ->addAttributeToFilter('fb_product', array('eq' => '1'))
			->addStoreFilter();	
		Mage::getSingleton('catalog/product_status')->addVisibleFilterToCollection($products);
		Mage::getSingleton('catalog/product_visibility')->addVisibleInSearchFilterToCollection($products);
		
        $products->setPageSize($number)
			->setCurPage(1)
			->load();
        
		$this->setProductCollection($products);
    }
	
	public function getNumberShownProduct()
	{
		return Mage::getStoreConfig(self::XML_PATH_NUMBER_SHOWN_PRODUCT,Mage::app()->getStore()->getId());
	}
	
	public function getDelayTime()
	{
		$delay = (int) Mage::getStoreConfig(self::XML_PATH_DELAY_TIME,Mage::app()->getStore()->getId()) * 1000;
		$delay = $delay ? $delay : 3000;
		return $delay;
	}
	
	public function getShownType()
	{
		return Mage::getStoreConfig(self::XML_PATH_SHOWN_TYPE,Mage::app()->getStore()->getId());
	}
	
	public function substrwords($text, $maxchar, $end='...') 
	{
		if (strlen($text) > $maxchar || $text == '') {
			$words = preg_split('/\s/', $text);     
			$output = '';
			$i      = 0;
			while (1) {
				$length = strlen($output)+strlen($words[$i]);
				if ($length > $maxchar) {
					break;
				}
				else {
					$output .= " " . $words[$i];
					++$i;
				}
			}
			$output .= $end;
		}
		else {
			$output = $text;
		}
		return $output;
	}	
	
	public function isNewProduct($product)
	{
        $newFromDate = $product->getNewsFromDate();
        $newToDate = $product->getNewsToDate();     
 
        $now = date("Y-m-d H:m:s");
                                                       
        if((int)$newFromDate && $newFromDate < $now && (!(int)$newToDate || $newToDate> $now)){
            return true;     
        }		
		return false;
	}
}
<?php

class Magik_Featured_Adminhtml_FeaturedimagesController extends Mage_Adminhtml_Controller_action
{

	protected function _initAction() {
		$this->loadLayout()
			->_setActiveMenu('featured/items')
			->_addBreadcrumb(Mage::helper('adminhtml')->__('Items Manager'), Mage::helper('adminhtml')->__('Item Manager'));		
		return $this;
	}   
 
	public function indexAction() {				
		$this->_initAction();
		/*$this->_addLeft($this->getLayout()->createBlock('Magik_Featured_Block_ShowTabsAdminBlock'));	*/
		$block = $this->getLayout()->createBlock(
                    'Mage_Core_Block_Template',
                    'Magik_Featured_Block_ExtraInfo',
                        array('template' => 'featured/featuredimage.phtml')
                );
            
                $this->getLayout()->getBlock('content')->append($block);
	
		$this->renderLayout();
		//$sobj=Mage::getSingleton('adminhtml/session');
		//$sobj->setData('tab','product');
	}
 
	/* 
	*	FUNCTION TO SAVE THE SETTINGS PROVIDED BY THE ADMIN TO DATABASE 
	*/
	public function saveAction()
	{		
			$post = $this->getRequest()->getPost();				
			$resource = Mage::getSingleton('core/resource');
			$write= $resource->getConnection('core_write');
			$featuredTable = $resource->getTableName('featured');		
			if(isset($post['move']))
			{				
				$sobj=Mage::getSingleton('adminhtml/session');
				if(isset($post['productview']))
				{
					if(isset($post['no_of_featured']))
					{
						$query = "update ".$featuredTable." set move=".$post['move'].",no_of_featured='".$post['no_of_featured']."'";
						if(isset($post['type1']))
						{
							$query.= ",type='".$post['type1']."'";						
						}
						$write->query($query);
						$sobj->setData('tab', 'product');		
					}			
				}				
				$message = $this->__('Configuration saved successfully.');
				Mage::getSingleton('adminhtml/session')->addSuccess($message);
				
			}
			else 
			{
				Mage::getSingleton('adminhtml/session')->addError(Mage::helper('featured')->__('Invalid Data'));
				Mage::getSingleton('adminhtml/session')->addSuccess($message);
			}		
			$this->_redirect('*/*/');	
	}
	public function postAction()
	{		
			$post = $this->getRequest()->getPost();									
			$resource = Mage::getSingleton('core/resource');
			$write= $resource->getConnection('core_write');
			$featuredTable = $resource->getTableName('featured');
			$featuredImageTable = $resource->getTableName('magik_featured_image');
			if(isset($post['move']))
			{
				
					$sobj=Mage::getSingleton('adminhtml/session');				
					$sobj->setData('tab', 'image');	
					if(!empty($post['customsize']))
					{
						$imageSize = $post['customsize'];
					}
					else 
					{
						$imageSize = $post['imagesize'];
					}
					
					$query = "update ".$featuredTable." set move=".$post['move'].",no_of_images='".$post['no_of_images']."',imagesize="."'".$imageSize."'";						
					if(isset($post['type']))
					{
						$query.= ",type='".$post['type']."'";						
					}
					$write->query($query);					
					$imageDetail = Mage::getModel('featured/featured')->loadImages();
					$query2 = "insert into $featuredImageTable (image_path,image_link) values";	
					$j=0;
					$k=0;	
					$delete = 0;
					$skin= $post['skinurl'];
					$pos=strpos($skin,"skin");
					
					//$search = str_ireplace("index.php/",'',Mage::getUrl());
					//$skinUrl = substr($skin,$pos,strlen($skin));
					if (!is_dir(Mage::getBaseDir('media').DS.'featured')) {
		           		mkdir(Mage::getBaseDir('media').DS.'featured', 0777);
					}	
				 	$skinUrl = 'media/featured';
					
					for ($i=0;$i<10;$i++)
					{	
											
						if(!empty($_FILES['images']['name'][$i]))
						{								
							$imagepath =  $skinUrl."/".time().basename($_FILES['images']['name'][$i]);
							$curpath = getcwd()."/".$imagepath;
							
							if(isset($imageDetail[$i]['id']))
							{
								@unlink(getcwd().'/'.$imageDetail[$i]['image_path']);
								$query1 = "update $featuredImageTable set ";
								$query1 .="image_path='".$imagepath."',image_link='".$post['link'][$i]."' where id =".$imageDetail[$i]['id']; 
								$write->query($query1);
							}
							else 
							{
								
								$k=1;
								if($j==0)
								{
									$query2 .="('".$imagepath."','".$post['link'][$i]."')";	
								}
								else 
								{
									$query2 .=",('".$imagepath."','".$post['link'][$i]."')";	
								}
								$j++;
								
							}
							
							move_uploaded_file($_FILES['images']['tmp_name'][$i],$curpath);
							
						}
						else if(isset($imageDetail[$i]['id']))
						{
							$query = "update $featuredImageTable set ";
							$query .="image_link='".$post['link'][$i]."' where id =".$imageDetail[$i]['id'];
							$write->query($query); 
						}
						
																									
					}
					if($k==1)
					{
						$write->query($query2);
					}
					
					
					/*
					* CHECK IF DELETE IS SET
					*/
					if(isset($post['delete']))
					{
						if(sizeof($post['delete']) > 0)
						{
							if($post['no_of_images'] > (sizeof($imageDetail)- sizeof($post['delete'])))
							{
								$delete = 1;
							}
							else 
							{
								for ($jk =0;$jk<=sizeof($post['delete']);$jk++)
								{																	
									if(isset($post['delete'][$jk]))
									{
										@unlink(getcwd().'/'.$post['imagepath'][$post['delete'][$jk]]);
										$query3 = "delete from $featuredImageTable where id=".$post['delete'][$jk];
										$write->query($query3);										
									}
								}
								//$message = $this->__('Image deleted successfully.');
								//Mage::getSingleton('adminhtml/session')->addSuccess($message);
							}
						}
						if($delete == 1)
						{
							Mage::getSingleton('adminhtml/session')->addError(Mage::helper('featured')->__('Minimum '.$post['no_of_images'].' image(s) should be present in Uploaded Images'));
						}	
					}
					if($delete != 1) {					
						$message = $this->__('Configuration saved successfully.');
						Mage::getSingleton('adminhtml/session')->addSuccess($message);
					}	
								
			}
			else 
			{
				Mage::getSingleton('adminhtml/session')->addError(Mage::helper('featured')->__('Invalid Data'));
				Mage::getSingleton('adminhtml/session')->addSuccess($message);
			}				
			$this->_redirect('*/*/');	
	}
    
	
    
   

    protected function _sendUploadResponse($fileName, $content, $contentType='application/octet-stream')
    {
        $response = $this->getResponse();
        $response->setHeader('HTTP/1.1 200 OK','');
        $response->setHeader('Pragma', 'public', true);
        $response->setHeader('Cache-Control', 'must-revalidate, post-check=0, pre-check=0', true);
        $response->setHeader('Content-Disposition', 'attachment; filename='.$fileName);
        $response->setHeader('Last-Modified', date('r'));
        $response->setHeader('Accept-Ranges', 'bytes');
        $response->setHeader('Content-Length', strlen($content));
        $response->setHeader('Content-type', $contentType);
        $response->setBody($content);
        $response->sendResponse();
        die;
    }
}

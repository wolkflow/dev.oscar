<?php

namespace Glyf\Oscar;

use Glyf\Core\System\IBlockSectionModel;
use Glyf\Oscar\Picture;

IncludeModuleLangFile(__FILE__);

class Collection extends IBlockSectionModel
{
	protected static $iblockID = IBLOCK_COLLECTIONS_ID;
    
    
    /**
     * ��������� ��������.
     */
    public function getTitle()
    {
        $this->load();
        
        return ($this->get('UF_LANG_TITLE_' . CURRENT_LANG_UP));
    }
    
    
    /**
     * ��������� ������.
     */
    public function getURL()
    {
        $this->load();
        
        return ($this->get('SECTION_PAGE_URL'));
    }
    
    
    /**
     * ��������� ������� ������.
     */
    public function getChains($hasroot = true)
    {
        $result = array();
        
        if ($hasroot) {
            $result []= array('TITLE' => getMessage('GL_ROOT_COLLECTION_TITLE'), 'LINK' => '/collections/');
        }
        
        $items = $this->getNavChain(array('ID'));
        foreach ($items as $item) {
            $section  = new self($item['ID']);
            $result []= array('TITLE' => $section->getTitle(), 'LINK' => $section->getURL());
        }
        return $result;
    }
    
    
    /**
     * ��������� ���������� ��������.
     */
    public function getPicturesCount()
    {
        $sids = array_merge($this->getSubsectionIDs(), array($this->getID()));
        
        $result = Picture::getList(array('filter' => array(Picture::FIELD_COLLECTION => $sids)), false);
        $count  = $result->getSelectedRowsCount();
        
        return $count;
    }
    
    
    /**
     * ��������� ���������� ��������.
     */
    public function getPictures()
    {
        $sids = array_merge($this->getSubsectionIDs(), array($this->getID()));
        
        $products = Picture::getList(array('filter' => array(Picture::FIELD_COLLECTION => $sids)));
        
        return $products;
    }
}
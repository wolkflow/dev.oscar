<?php

namespace Glyf\Oscar;

use Glyf\Core\System\IBlockSectionModel;
use Glyf\Oscar\Picture;

IncludeModuleLangFile(__FILE__);

class Collection extends IBlockSectionModel
{
	protected static $iblockID = IBLOCK_COLLECTIONS_ID;
    
    
    /**
     * Получение названия.
     */
    public function getTitle()
    {
        $this->load();
        
        return ($this->get('UF_LANG_TITLE_' . CURRENT_LANG_UP));
    }
    
    
    /**
     * Получение ссылки.
     */
    public function getURL()
    {
        $this->load();
        
        return ($this->get('SECTION_PAGE_URL'));
    }
    
    
    /**
     * Получение хлебных крошек.
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
     * Получение количества элеметов.
     */
    public function getPicturesCount()
    {
        $sids = array_merge($this->getSubsectionIDs(), array($this->getID()));
        
        $result = Picture::getList(array(
            'filter' => array(
                Picture::FIELD_COLLECTION => $sids,
                Picture::FIELD_MODERATE   => true,
            )
        ), false);
        $count = $result->getSelectedRowsCount();
        
        return $count;
    }
    
    
    /**
     * Получение количества элеметов.
     */
    public function getPictures($params)
    {
        $sids = array_merge($this->getSubsectionIDs(), array($this->getID()));
        
        $params = (array) $params;
        $params['filter'][Picture::FIELD_COLLECTION] = $sids;
        
        $pictures = Picture::getList($params);
        
        return $pictures;
    }
}
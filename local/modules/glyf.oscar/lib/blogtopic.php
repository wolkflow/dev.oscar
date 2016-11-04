<?php

namespace Glyf\Oscar;

use Glyf\Core\System\IBlockSectionModel;
use Glyf\Oscar\Picture;

IncludeModuleLangFile(__FILE__);

class BlogTopic extends IBlockSectionModel
{
	protected static $iblockID = IBLOCK_BLOG_ID;
    
    
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
            $result []= array('TITLE' => getMessage('GL_ROOT_COLLECTION_TITLE'), 'LINK' => '/blog/');
        }
        
        $items = $this->getNavChain(array('ID'));
        foreach ($items as $item) {
            $section  = new self($item['ID']);
            $result []= array('TITLE' => $section->getTitle(), 'LINK' => $section->getURL());
        }
        return $result;
    }
}
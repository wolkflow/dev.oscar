<?php
 
namespace Glyf\Core\Events;

IncludeModuleLangFile(__FILE__);


/**
 * Обработчик событий главного модуля.
 */
class Main
{
    /**
     * Добавление главного меню.
     */
    public function OnBuildGlobal_AddMainMenu()
    {
        $menu = array(
            'global_menu_glyf.core' => array(
                'menu_id' 		=> 'glyfcore',
                'icon' 			=> 'glyf.core',
                'page_icon' 	=> 'glyf.core',
                'index_icon' 	=> 'glyf.core',
                'text' 			=> GetMessage('GLYF_CORE_GLOBAL_MENU_TEXT'),
                'title' 		=> GetMessage('GLYF_CORE_GLOBAL_MENU_TITLE'),
                'url' 			=> 'glyf.core_index.php?lang='.LANGUAGE_ID,
                'sort' 			=> 1000,
                'items_id' 		=> 'global_menu_glyf_core',
                'help_section' 	=> 'settings',
                'items' 		=> array()
            )
        );
        
        return $menu;
    }
}
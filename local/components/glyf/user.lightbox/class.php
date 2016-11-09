<?php

use Bitrix\Main\Localization\Loc;
use Glyf\Oscar\Collection;
use Glyf\Oscar\Picture;
use Glyf\Oscar\Lightbox;
use Glyf\Oscar\User;

class StatisticFolderDetail extends \CBitrixComponent
{
    const PERPAGE = 10;
    
    
	/** 
	 * Установка настроек.
	 */
    public function onPrepareComponentParams($arParams)
    {
        // Идентификатор.
        $arParams['LID'] = (int) $arParams['LID'];
        
        
        // Страница.
        $arParams['PAGE'] = (int) $arParams['PAGE'];
        
        if ($arParams['PAGE'] <= 0) {
            $arParams['PAGE'] = 1;
        }
        
        
        return $arParams;
	}
	
	
	
	/**
	 * Выполнение компонента.
	 */
	public function executeComponent()
    {
		if (!\Bitrix\Main\Loader::includeModule('glyf.core')) {
			return;
		}

		if (!\Bitrix\Main\Loader::includeModule('glyf.oscar')) {
			return;
		}
        
        if (empty($this->arParams['LID'])) {
            return;
        }
        
        // Пользователь.
        $user = new User();
        
        
        // Папка.
        $lightbox = new Lightbox($this->arParams['LID']);
        
        if (!$lightbox->exists()) {
            die('Сборник не существует');
        }
        
        // Общее количество.
        $result = $lightbox->getPictures(null, null, false);
        
        $this->arResult['TOTAL'] = $result->getSelectedRowsCount();
        
        
        
        // Количество страниц.
        $pagescnt = ceil($this->arResult['TOTAL'] / self::PERPAGE);
        
        if ($this->arParams['PAGE'] > $pagescnt) {
            $this->arParams['PAGE'] = $pagescnt;
        }
        
        
        // Список элементов сборника.
        $pictures = $lightbox->getPictures(self::PERPAGE, ($this->arParams['PAGE'] - 1) * self::PERPAGE);
        
        
        // Картины.
        $this->arResult['ITEMS'] = array();
        foreach ($pictures as $picture) {
            $item = $picture->getData();
            
            // Автор.
            if ($picture->getAuthorID() > 0) {
                $item['AUTHOR'] = $picture->getAuthor()->getName();
            }
            $this->arResult['ITEMS'] []= $item;
        }
        unset($pictures, $picture, $item);
        
        //  Данные папки.
        $this->arResult['LIGHTBOX'] = $lightbox->getData();
        
        
        
		// Подключение шаблона компонента.
		$this->IncludeComponentTemplate();
		
		return $this->arResult;
	}
	
}

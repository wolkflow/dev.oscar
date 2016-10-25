<?php

use Bitrix\Main\Application; 
use Bitrix\Main\Context; 
use Bitrix\Main\Request;
use Bitrix\Main\Server;
use Bitrix\Main\Localization\Loc;

use Glyf\Core\Helpers\HLBlock as HLBlockHelper;
use Glyf\Core\Helpers\IBlock as IBlockHelper;
use Glyf\Oscar\Collection;
use Glyf\Oscar\Picture;
use Glyf\Oscar\Folder;
use Glyf\Oscar\User;


class PictureUpload extends \CBitrixComponent
{
    protected static $user;
    
    
	/** 
	 * Установка настроек.
	 */
    public function onPrepareComponentParams($arParams)
    {
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
        
        // Пользователь.
        $this->user = new User();
        
        // Данные.
		$this->arResult = array();
		
        // Параметры.
        $this->prepare();
        
        
        
        // Запрос.
        $request = Context::getCurrent()->getRequest();
        
        // Обработка данных.
        if ($request->isPost()) {
            $pid = $request->get('ID');
            if ($pid > 0) {
                $picture = new Picture($pid);
                
                if (!$picture->exists()) {
                    return;
                }
            }
            
            // Данные.
            $this->arResult['DATA'] = $request->getPostList();
            
            try {
                $this->arResult['FIELDS'] = $this->process($this->arResult['DATA']);
            } catch (Exception $e) {
                
            }
        }
        
        
        
		// Подключение шаблона компонента.
		$this->IncludeComponentTemplate();
		
		return $this->arResult;
	}
    
    
    /**
     * Получение пользователя.
     */
    public function getUser()
    {
        return $this->user;
    }
    
    
    /**
     * Подготовка данных для вывода.
     */
    public function prepare()
    {
        $result = array();
        
        // Свойства HL-блока картин.
        $props = HLBlockHelper::getProps(HLBLOCK_PICTURES_ID, 'FIELD_NAME', 'ID');
        
        
        // Папки пользователя.
        $items = Folder::getUserFolders($this->getUser()->getID());
        $result['FOLDERS'] = array();
        foreach ($items as $item) {
            $result['FOLDERS'][$item->getID()] = $item->getTitle();
        }
        
        // Жанр.
        $result['GENRE'] = array();
        foreach ($props[Picture::FIELD_GENRE]['ENUMS'] as $item) {
            $result['GENRE'][$item['ID']] = $item['XML_ID'];
        }
        
        // Цвет.
        $result['COLOR'] = array();
        foreach ($props[Picture::FIELD_COLOR]['ENUMS'] as $item) {
            $result['COLOR'][$item['ID']] = $item['XML_ID'];
        }
        
        // Правовой режим.
        $result['LEGAL'] = array();
        foreach ($props[Picture::FIELD_LEGAL]['ENUMS'] as $item) {
            $result['LEGAL'][$item['ID']] = $item['XML_ID'];
        }
        
        
        $this->arResult['PARAMS'] = $result;
        
        return $result;
    }
    
    
    /**
     * Проверка данных.
     */
	public function check($data)
    {
        $result = true;
        
        
        return $result;
    }
    
    
    /**
     * Преобразование данных.
     */
	public function process($data)
    {
        $fields = array();
        
        // Сохранение изображения.
        $file = $_FILES['FILE'];
        
        // Ошибка загрузки файла.
        if (empty($file) || !is_readable($file)) {
            // throw new Exception('Файл не загружен');
        }
        
        
        // Создание директории.
        if ($data['FOLDER_SET'] == 'CREATE') {
            $folder = (string) $data['FOLDER_TITLE'];
        }
        
        // Заголовок.
        $fields[Picture::FIELD_TITLE] = (string) $data['TITLE'];
        
        // Автор.
        $fields[Picture::FIELD_AUTHOR] = (int) $data['AUTHOR_ID'];
        $fields[Picture::FIELD_AUTHOR_CAND] = (string) $data['AUTHOR_TITLE'];
        
        // Правообладатель.
        // $fields[Picture::FIELD_HOLDER] = (int) $data['HOLDER_ID'];
        // $fields[Picture::FIELD_HOLDER_CAND] = (string) $data['HOLDER_TITLE'];
        
        // Дата.
        $isyear = (string) $data['ISYEAR'];
        
        // Техника.
        
        // Описание.
        $fields[Picture::FIELD_LANG_DESC_SFX . CURRENT_LANG_UP] = (string) $data['DESCRIPTION'];
        
        // Коллекция.
        $fields[Picture::FIELD_COLLECTION] = (int) $data['COLLECTION'];
        
        
        
        
        echo '<pre>'; print_r($fields); echo '</pre>';
        // echo '<pre>'; print_r($data); echo '</pre>';
        
        $result = $data;
        
        return $fields;
    }
}











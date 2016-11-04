<?php

use Bitrix\Main\Localization\Loc;
use Bitrix\Main\Context;
use Glyf\Oscar\Collection;
use Glyf\Oscar\BlogTopic;
use Glyf\Oscar\Subscribe;
use Glyf\Oscar\Search;

class UserSubscribeComponent extends \CBitrixComponent
{
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
        
        // Типы фильтров подписок.
        $this->arResult = array('KINDS' => array());
        
        // Пользователь.
        $user = new Glyf\Oscar\User();
        
        
        // Свойства HL-блока.
        $props = Glyf\Core\Helpers\HLBlock::getProps(HLBLOCK_SUBSCRIBES_ID, 'FIELD_NAME', 'ID');
        
        
        // Коллекции.
        $this->arResult['KINDS']['COLLECTIONS'] = array();
        $items = Collection::getList(array('filter' => array('ACTIVE' => 'Y', 'DEPTH_LEVEL' => 1)));
        foreach ($items as $item) {
            $this->arResult['KINDS']['COLLECTIONS'][$item->getID()] = $item->getTitle();
        }
        
        // Темы блога.
        $this->arResult['KINDS']['BLOGS'] = array();
        $items = BlogTopic::getList(array('filter' => array('ACTIVE' => 'Y', 'DEPTH_LEVEL' => 1)));
        foreach ($items as $item) {
            $this->arResult['KINDS']['BLOGS'][$item->getID()] = $item->getTitle();
        }
        
        // Сохраненные поиски.
        $this->arResult['KINDS']['SEARCHES'] = array();
        $items = Search::getList(array('filter' => array(Search::FIELD_USER => $user->getID())));
        foreach ($items as $item) {
            $this->arResult['KINDS']['SEARCHES'][$item->getID()] = $item->getTitle();
        }
        
        // Периоды.
        $this->arResult['PERIODS'] = array();
        foreach ($props[Subscribe::FIELD_PERIOD]['ENUMS'] as $enum) {
            $this->arResult['PERIODS'][$enum['XML_ID']] = array('ID' => $enum['ID'], 'CODE' => $enum['XML_ID'], 'TITLE' => $enum['VALUE']);
        }
        
        
        // Подписка.
        $subscribe = $user->getSubscribe();
        
        // Запрос.
        $request = Context::getCurrent()->getRequest();
        
        $this->arResult['DATA'] = array(); 
        $this->arResult['POST'] = array();
        
        if ($request->isPost()) {
            $this->arResult['POST'] = $request->getPostList();
            
            // Действие.
            $action = $request->get('ACTION');
            
            // Соранение подписки.
            if ($action == 'CONFIRM') {
                if ($subscribe) {
                    $result = $subscribe->update(array(
                        Subscribe::FIELD_PERIOD           => $this->arResult['POST']->get('PERIOD'),
                        Subscribe::FIELD_KIND_COLLECTIONS => $this->arResult['POST']->get('COLLECTIONS'),
                        Subscribe::FIELD_KIND_BLOGS       => $this->arResult['POST']->get('BLOGS'),
                        Subscribe::FIELD_KIND_SEARCHES    => $this->arResult['POST']->get('SEARCHES'),
                        Subscribe::FIELD_LAST_TIME        => new Bitrix\Main\Type\DateTime(),
                    ));
                }
            }
            
            // Отмена подписки.
            if ($action == 'DECLINE') {
                if ($subscribe) {
                    $subscribe->update(array(
                        Subscribe::FIELD_PERIOD           => null,
                        Subscribe::FIELD_KIND_COLLECTIONS => array(),
                        Subscribe::FIELD_KIND_BLOGS       => array(),
                        Subscribe::FIELD_KIND_SEARCHES    => array(),
                    ));
                }
            }
        }
        
        // Данные о подписке.
        if ($subscribe) {
            $data = $subscribe->getData();
            
            $this->arResult['DATA'] = array(
                'PERIOD'      => $data[Subscribe::FIELD_PERIOD],
                'COLLECTIONS' => $data[Subscribe::FIELD_KIND_COLLECTIONS],
                'BLOGS'       => $data[Subscribe::FIELD_KIND_BLOGS],
                'SEARCHES'    => $data[Subscribe::FIELD_KIND_SEARCHES],
            );
        }
        
        
        
		// Подключение шаблона компонента.
		$this->IncludeComponentTemplate();
		
		return $this->arResult;
	}
	
}

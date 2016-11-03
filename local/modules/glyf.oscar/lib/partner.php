<?php

namespace Glyf\Oscar;

use Glyf\Oscar\Statistic\Download;
use Glyf\Oscar\Statistic\View;
use Glyf\Oscar\Collection;
use Glyf\Oscar\Picture;


class Partner extends \Glyf\Core\User
{
    
    /**
     * ��������� ���������� ���� ����������� ��������.
     */
    public function getPicturesCount()
    {
        $result = Picture::getList(array(
            'select' => array('ID'), 
            'filter' => array(Picture::FIELD_USER_ID => $this->getID())
        ), false);
        
        return $result->getSelectedRowsCount();
    }
    
    
    /**
     * ��������� ���������� ���������� �� �������.
     */
    public function getQuarterViews()
    {
        $quarter = \Glyf\Core\Helpers\DateTime::getQuarter();
        
        $result = View::getList(array(
            'select' => array('ID'), 
            'filter' => array(
                View::FIELD_UPLOADER_ID => $this->getID(),
                '>='.View::FIELD_TIME   => date('d.m.Y 00:00:00', $quarter['begin']),
                '<'.View::FIELD_TIME    => date('d.m.Y 23:59:59', $quarter['finish']),
            )
        ), false);
        
        return $result->getSelectedRowsCount();
    }
    
    
    /**
     * ��������� ���������� ������ �� �������.
     */
    public function getQuarterSales()
    {
        
    }
    
    
    /**
     * ��������� ���������� ������ �� �������.
     */
    public function getPaymentsMonth()
    {
        
    }
}
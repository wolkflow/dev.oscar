<?php

namespace Sale\Handlers\PaySystem;

use Bitrix\Main\Error;
use Bitrix\Main\Request;
use Bitrix\Main\Type\DateTime;
use Bitrix\Main\Localization\Loc;
use Bitrix\Sale\PaySystem;
use Bitrix\Sale\Payment;
use Bitrix\Sale\PriceMaths;

Loc::loadMessages(__FILE__);

class RoboxchangeHandler extends PaySystem\ServiceHandler
{
    public function getLink($data)
    {
        $fields = array(
            'FinalStep'             => '1',
            'MrchLogin'             => $data['ROBOXCHANGE_SHOPLOGIN'],
            'OutSum'                => $data['PAYMENT_SHOULD_PAY'],
            'InvId'                 => $data['PAYMENT_ID'],
            'Desc'                  => $data['ROBOXCHANGE_ORDERDESCR'],
            'SignatureValue'        => $data['SIGNATURE_VALUE'],
            'Email'                 => $data['BUYER_PERSON_EMAIL'],
            'SHP_HANDLER'           => 'ROBOXCHANGE',
            'SHP_BX_PAYSYSTEM_CODE' => $data['BX_PAYSYSTEM_CODE'],
        );
        
        if ($data['PS_IS_TEST'] == 'Y') {
            $fields['IsTest'] = 1;
        }
        if ($parameters['PS_MODE'] != '0') {
            $fields['IncCurrLabel'] = $data['PS_MODE'];
        }
        
        $link = $data['URL'] . '?' . http_build_query($fields);
        
        return $link;
    }
    
    
	/**
	 * @param Payment $payment
	 * @param Request|null $request
	 * @return PaySystem\ServiceResult
	 */
	public function initiatePay(Payment $payment, Request $request = null)
	{
		$test = '';
		if ($this->isTestMode($payment)) {
			$test = '_TEST';
        }

		$signatureValue = md5(
			$this->getBusinessValue($payment, 'ROBOXCHANGE_SHOPLOGIN').":".
			$this->getBusinessValue($payment, 'PAYMENT_SHOULD_PAY').":".
			$this->getBusinessValue($payment, 'PAYMENT_ID').":".
			$this->getBusinessValue($payment, 'ROBOXCHANGE_SHOPPASSWORD'.$test).':'.
			'SHP_BX_PAYSYSTEM_CODE='.$payment->getPaymentSystemId().':'.
			'SHP_HANDLER=ROBOXCHANGE'
		);

		$params = array(
			'URL' => $this->getUrl($payment, 'pay'),
			'PS_MODE' => $this->service->getField('PS_MODE'),
			'SIGNATURE_VALUE' => $signatureValue,
			'BX_PAYSYSTEM_CODE' => $payment->getPaymentSystemId(),
		);
        
        $params['LINK'] = $this->getLink(array_merge($params, $this->getParamsBusValue($payment)));
        
        $this->setExtraParams($params);
		/*
        // Настройки.
        $parameters = $this->getParamsBusValue($payment);
        
        $fields = array(
            'FinalStep'             => '1',
            'MrchLogin'             => $parameters['ROBOXCHANGE_SHOPLOGIN'],
            'OutSum'                => $parameters['PAYMENT_SHOULD_PAY'],
            'InvId'                 => $parameters['PAYMENT_ID'],
            'Desc'                  => $parameters['ROBOXCHANGE_ORDERDESCR'],
            'SignatureValue'        => $params['SIGNATURE_VALUE'],
            'Email'                 => $parameters['BUYER_PERSON_EMAIL'],
            'SHP_HANDLER'           => 'ROBOXCHANGE',
            'SHP_BX_PAYSYSTEM_CODE' => $params['BX_PAYSYSTEM_CODE'],
        );
        
        if ($parameters['PS_IS_TEST'] == 'Y') {
            $fields['IsTest'] = 1;
        }
        if ($parameters['PS_MODE'] != '0') {
            $fields['IncCurrLabel'] = $params['PS_MODE'];
        }
        
        // Ссылка дял оплаты.
        $params['PAYMENT_URL'] = $params['URL'] . '?' . http_build_query($fields);
        */
        
        $result = $this->showTemplate($payment, "template");
        $result->link = $this->getLink();
        
        return $result; // $this->showTemplate($payment, "template");//(new PaySystem\ServiceResult());
	}

	/**
	 * @return array
	 */
	public static function getIndicativeFields()
	{
		return array('SHP_HANDLER' => 'ROBOXCHANGES');
	}

	/**
	 * @param Request $request
	 * @param $paySystemId
	 * @return bool
	 */
	static protected function isMyResponseExtended(Request $request, $paySystemId)
	{
		$id = $request->get('SHP_BX_PAYSYSTEM_CODE');
		return $id == $paySystemId;
	}

	/**
	 * @param Payment $payment
	 * @param $request
	 * @return bool
	 */
	private function isCorrectHash(Payment $payment, Request $request)
	{
		$test = '';
		if ($this->isTestMode($payment))
			$test = '_TEST';

		$hash = md5($request->get('OutSum').":".$request->get('InvId').":".$this->getBusinessValue($payment, 'ROBOXCHANGE_SHOPPASSWORD2'.$test).':SHP_BX_PAYSYSTEM_CODE='.$payment->getPaymentSystemId().':SHP_HANDLER=ROBOXCHANGE');

		return ToUpper($hash) == ToUpper($request->get('SignatureValue'));
	}

	/**
	 * @param Payment $payment
	 * @param Request $request
	 * @return bool
	 */
	private function isCorrectSum(Payment $payment, Request $request)
	{
		$sum = PriceMaths::roundByFormatCurrency($request->get('OutSum'), $payment->getField('CURRENCY'));
		$paymentSum = PriceMaths::roundByFormatCurrency($this->getBusinessValue($payment, 'PAYMENT_SHOULD_PAY'), $payment->getField('CURRENCY'));

		return $paymentSum == $sum;
	}

	/**
	 * @param Request $request
	 * @return mixed
	 */
	public function getPaymentIdFromRequest(Request $request)
	{
		return $request->get('InvId');
	}

	/**
	 * @return mixed
	 */
	protected function getUrlList()
	{
		return array(
			'pay' => array(
				self::ACTIVE_URL => 'https://merchant.roboxchange.com/Index.aspx'
			)
		);
	}

	/**
	 * @param Payment $payment
	 * @param Request $request
	 * @return PaySystem\ServiceResult
	 */
	public function processRequest(Payment $payment, Request $request)
	{
		$result = new PaySystem\ServiceResult();

		if ($this->isCorrectHash($payment, $request))
		{
			return $this->processNoticeAction($payment, $request);
		}
		else
		{
			PaySystem\ErrorLog::add(array(
				'ACTION' => 'processRequest',
				'MESSAGE' => 'Incorrect hash'
			));
			$result->addError(new Error('Incorrect hash'));
		}

		return $result;
	}

	/**
	 * @param Payment $payment
	 * @param Request $request
	 * @return PaySystem\ServiceResult
	 */
	private function processNoticeAction(Payment $payment, Request $request)
	{
		$result = new PaySystem\ServiceResult();

		$psStatusDescription = Loc::getMessage('SALE_HPS_ROBOXCHANGE_RES_NUMBER').": ".$request->get('InvId');
		$psStatusDescription .= "; ".Loc::getMessage('SALE_HPS_ROBOXCHANGE_RES_DATEPAY').": ".date("d.m.Y H:i:s");

		if ($request->get("IncCurrLabel") !== null)
			$psStatusDescription .= "; ".Loc::getMessage('SALE_HPS_ROBOXCHANGE_RES_PAY_TYPE').": ".$request->get("IncCurrLabel");

		$fields = array(
			"PS_STATUS" => "Y",
			"PS_STATUS_CODE" => "-",
			"PS_STATUS_DESCRIPTION" => $psStatusDescription,
			"PS_STATUS_MESSAGE" => Loc::getMessage('SALE_HPS_ROBOXCHANGE_RES_PAYED'),
			"PS_SUM" => $request->get('OutSum'),
			"PS_CURRENCY" => $this->getBusinessValue($payment, "PAYMENT_CURRENCY"),
			"PS_RESPONSE_DATE" => new DateTime(),
		);

		$result->setPsData($fields);

		if ($this->isCorrectSum($payment, $request))
		{
			$result->setOperationType(PaySystem\ServiceResult::MONEY_COMING);
		}
		else
		{
			PaySystem\ErrorLog::add(array(
				'ACTION' => 'processNoticeAction',
				'MESSAGE' => 'Incorrect sum'
			));
			$result->addError(new Error('Incorrect sum'));
		}

		return $result;
	}

	/**
	 * @param Payment $payment
	 * @return bool
	 */
	protected function isTestMode(Payment $payment = null)
	{
		return ($this->getBusinessValue($payment, 'PS_IS_TEST') == 'Y');
	}

	/**
	 * @return array
	 */
	public function getCurrencyList()
	{
		return array('RUB');
	}

	/**
	 * @param PaySystem\ServiceResult $result
	 * @param Request $request
	 * @return mixed
	 */
	public function sendResponse(PaySystem\ServiceResult $result, Request $request)
	{
		global $APPLICATION;
		if ($result->isResultApplied())
		{
			$APPLICATION->RestartBuffer();
			echo 'OK'.$request->get('InvId');
		}
	}

	/**
	 * @return array
	 */
	public static function getHandlerModeList()
	{
		return array(
			'Qiwi40RIBRM' => Loc::getMessage('SALE_HPS_ROBOXCHANGE_QIWIR_TERMINALS'),
			'WMRRM' => Loc::getMessage('SALE_HPS_ROBOXCHANGE_WMRM_EMONEY'),
			'AlfaBankRIBR' => Loc::getMessage('SALE_HPS_ROBOXCHANGE_ALFABANKOCEANR_BANK'),
			'BANKOCEAN3R' => Loc::getMessage('SALE_HPS_ROBOXCHANGE_OCEANBANKOCEANR_BANK'),
			'MixplatMegafonRIBR' => Loc::getMessage('SALE_HPS_ROBOXCHANGE_MEGAFONR_MOBILE'),
			'MixplatMTSRIBR' => Loc::getMessage('SALE_HPS_ROBOXCHANGE_MTSR_MOBILE'),
			'RapidaRIBEurosetR' => Loc::getMessage('SALE_HPS_ROBOXCHANGE_RAPIDAOCEANEUROSETR_OTHER'),
			'MixplatTele2RIBR' => 'Tele2',
			'MixplatBeelineRIBR' => Loc::getMessage('SALE_HPS_ROBOXCHANGE_MMixplatBeelineRIBR'),
			'RussianStandardBankRIBR' => Loc::getMessage('SALE_HPS_ROBOXCHANGE_RussianStandardBankRIBR'),
			'BSSNationalBankTRUSTR' => Loc::getMessage('SALE_HPS_ROBOXCHANGE_BSSNationalBankTRUSTR'),
			'BSSTatfondbankR' => Loc::getMessage('SALE_HPS_ROBOXCHANGE_BSSTatfondbankR'),
			'PSKBR' => Loc::getMessage('SALE_HPS_ROBOXCHANGE_PSKBR'),
			'HandyBankMerchantOceanR' => Loc::getMessage('SALE_HPS_ROBOXCHANGE_HandyBankMerchantOceanR'),
			'HandyBankBO' => Loc::getMessage('SALE_HPS_ROBOXCHANGE_HandyBankBO'),
			'RapidaRIBSvyaznoyR' => Loc::getMessage('SALE_HPS_ROBOXCHANGE_RapidaRIBSvyaznoyR'),
			'HandyBankFB' => Loc::getMessage('SALE_HPS_ROBOXCHANGE_HandyBankFB'),
			'HandyBankFU' => Loc::getMessage('SALE_HPS_ROBOXCHANGE_HandyBankFU'),
			'HandyBankKB' => Loc::getMessage('SALE_HPS_ROBOXCHANGE_HandyBankKB'),
			'HandyBankKSB' => Loc::getMessage('SALE_HPS_ROBOXCHANGE_HandyBankKSB'),
			'HandyBankLOB' => Loc::getMessage('SALE_HPS_ROBOXCHANGE_HandyBankLOB'),
			'HandyBankNSB' => Loc::getMessage('SALE_HPS_ROBOXCHANGE_HandyBankNSB'),
			'HandyBankTB' => Loc::getMessage('SALE_HPS_ROBOXCHANGE_HandyBankTB'),
			'HandyBankVIB' => Loc::getMessage('SALE_HPS_ROBOXCHANGE_HandyBankVIB'),
			'BSSMezhtopenergobankR' => Loc::getMessage('SALE_HPS_ROBOXCHANGE_BSSMezhtopenergobankR'),
			'MINBankR' => Loc::getMessage('SALE_HPS_ROBOXCHANGE_MINBankR'),
			'BSSFederalBankForInnovationAndDevelopmentR' => Loc::getMessage('SALE_HPS_ROBOXCHANGE_BSSFederalBankForInnovationAndDevelopmentR'),
			'BSSIntezaR' => Loc::getMessage('SALE_HPS_ROBOXCHANGE_BSSIntezaR'),
			'BSSBankGorodR' => Loc::getMessage('SALE_HPS_ROBOXCHANGE_BSSBankGorodR'),
			'BSSAvtovazbankR' => Loc::getMessage('SALE_HPS_ROBOXCHANGE_BSSAvtovazbankR'),
			'KUBankR' => Loc::getMessage('SALE_HPS_ROBOXCHANGE_KUBankR'),
			'BANKOCEAN3CHECKR' => Loc::getMessage('SALE_HPS_ROBOXCHANGE_BANKOCEAN3CHECKR'),
		);
	}
}
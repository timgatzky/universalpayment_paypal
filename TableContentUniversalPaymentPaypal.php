<?php

/**
 * Contao Open Source CMS
 * 
 * Copyright (C) 2005-2013 Leo Feyer
 * 
 * @copyright	Tim Gatzky 2013
 * @author		Tim Gatzky <info@tim-gatzky.de>
 * @package		universalpayment
 * @subpackage	paypal
 * @link		http://contao.org
 * @license		http://www.gnu.org/licenses/lgpl-3.0.html LGPL
 */

/**
 * Class file 
 * tl_content
 */
class TableContentUniversalPaymentPaypal extends \Backend
{
	/**
	 * @var
	 */
	protected $strPaymentMethod = 'paypal';
	
	
	/**
	 * Modify the backend palettes
	 * @param DataContainer object
	 */
	public function modifyPalette(\DataContainer $objDC)
	{
		$objInput = \Input::getInstance();
		if($objInput->get('act') != 'edit')
		{
			return '';
		}
		
		$objDatabase = \Database::getInstance();
		$objActiveRecord = $objDatabase->prepare("SELECT * FROM ".$objDC->table." WHERE id=?")->limit(1)->execute($objDC->id);
		
		if($objActiveRecord->universalPaymentMethod != $this->strPaymentMethod || $objActiveRecord->numRows < 1)
		{
			return '';
		}
		
		// Modify palette for this payment module
		$GLOBALS['TL_DCA']['tl_content']['palettes']['universalpayment'] = str_replace
		(
			'{payment_setting_legend}',
			'{payment_setting_legend},up_paypalEmail,up_paypalJumpToComplete,up_paypalDebug;{template_legend},universalPaymentTemplate;',
			$GLOBALS['TL_DCA']['tl_content']['palettes']['universalpayment']
		);
	}
		
}
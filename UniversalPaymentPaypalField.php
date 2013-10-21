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
 * Imports
 */
use UniversalPayment\Factory as UniversalPayment;
use UniversalPayment\Frontend\Formfield\PaymentField as PaymentField;

/**
 * Class file
 */
class UniversalPaymentPaypalField extends PaymentField
{	
	/**
	 * Generate field
	 * @return string	html string output
	 */
	protected function compile()
	{
		return '';
	}
	
	/**
	 * Receive Instant Instant Payment Notifications from PayPal (IPN)
	 * Important: To receive IPNs value 'rm' must be set to the value '2' in payment form 
	 * <input type="hidden" name="rm" value="2">
	 * To receive IPNs in the first way you must enable IPN for your paypal account
	 * @return object self
	 */
	public function processPostSale()
	{
		$objRequest = new Request();
		$objRequest->send(('https://www.' . ($this->up_paypalDebug ? 'sandbox.' : '') . 'paypal.com/cgi-bin/webscr?cmd=_notify-validate'), http_build_query($_POST), 'post');
		
		// current order object
		$objOrder = $this->order;
		
		if ($objRequest->hasError())
		{
			$this->log('Request Error: ' . $objRequest->error, __METHOD__, TL_ERROR);
			exit;
		}
		// ipn correct
		elseif($objRequest->response == 'VERIFIED')
		{
			// set status to completed
			$objOrder->set('status',2);
			
			// verified here e.g. amount = post amount etc. can be done in POST_SALE HOOK as well
			$this->log('PayPal IPN: VERIFIED for payment uid#'.$this->uniqueId, __METHOD__, TL_GENERAL);
		}
		// ipn invalid
		elseif($objRequest->response == 'INVALID')
		{
			$this->log('PayPal IPN: INVALID for payment uid#'.$this->uniqueId, __METHOD__, TL_ERROR);
		}
		// ipn error
		else
		{
			$this->log('PayPal IPN: data rejected ('.$objRequest->response.')', __METHOD__, TL_ERROR);
		}
		// set data for parent ModulePayment instance
		parent::set('postsale',$_POST);
		
		// return this object with all its settings for further use
		return $this;
	}
	
	/**
	 * Process pre sale actions
	 * @return object	self
	 */
	public function processPreSale() 
	{
		// do something here
		return $this;
	}
}
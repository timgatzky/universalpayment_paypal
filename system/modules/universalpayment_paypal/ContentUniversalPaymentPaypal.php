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
use UniversalPayment\Frontend\ContentElement\ContentPayment as ContentPayment;

/**
 * Class file
 */
class ContentUniversalPaymentPayPal extends ContentPayment
{
	/**
	 * Compile and return html
	 * @return string
	 */
	public function generate()
	{
		return $this->compile();
	}
	
	/**
	 * Generate the module
	 * @return string
	 */
	protected function compile()
	{
		global $objPage;
		
		$objTemplate = new \FrontendTemplate($this->universalPaymentTemplate);
		$objTemplate->setData($this->arrData);
		$objTemplate->action = 'https://www.'. ($this->up_paypalDebug ? 'sandbox.':'') . 'paypal.com/cgi-bin/webscr';
		$objTemplate->presale_action = $this->generateFrontendUrl($objPage->row());
		$objTemplate->presale_action .= '?fwd=https://www.'. ($this->up_paypalDebug ? 'sandbox.':'') . 'paypal.com/cgi-bin/webscr';
		$objTemplate->email = $this->up_paypalEmail;
		$objTemplate->uniqueID = $this->uniqueId;
		$objTemplate->formID = 'id="universalpaymentform_mod_'.$this->id.'"';
		$objTemplate->formName = 'universalpaymentform_mod_'.$this->id;
		
		// return url on complete
		$objTemplate->returnUrl = '';
		if($this->up_paypalJumpToComplete)
		{
			$objTemplate->returnUrl = 'http://'.$this->replaceInsertTags('{{env::host}}').'/'.$this->replaceInsertTags('{{link_url::'.$this->up_paypalJumpToComplete.'}}');
		}
		else
		{
			$objTemplate->returnUrl = 'http://'.$this->replaceInsertTags('{{env::host}}').'/'.$this->replaceInsertTags('{{link_url::'.$objPage->id.'}}');
		}
		
		// add unique to return url
		$urlParams = array
		(
			'uid'=>$this->uniqueId,
		);
		
		if(count($urlParams) > 0)
		{
			$objString = \String::getInstance();
			$strParams = $objString->decodeEntities(http_build_query($urlParams));
			$objTemplate->returnUrl .= '?'.$strParams;
		}
		
		return $objTemplate->parse();
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
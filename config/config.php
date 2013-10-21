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
 * Globals
 */
// register module
$GLOBALS['UNIVERSALPAYMENT']['PAYMENT_METHOD']['paypal'] = true;
// register class files for this payment method
$GLOBALS['UNIVERSALPAYMENT']['PAYMENT_MOD']['paypal'] = 'ModuleUniversalPaymentPaypal';
$GLOBALS['UNIVERSALPAYMENT']['PAYMENT_FFD']['paypal'] = 'UniversalPaymentPaypalField';
$GLOBALS['UNIVERSALPAYMENT']['PAYMENT_CTE']['paypal'] = 'ContentUniversalPaymentPaypal';


/**
 * Hooks
 */
$GLOBALS['TL_HOOKS']['validateFormField'][] = array('UniversalPaymentPaypal', 'validateWidget');
$GLOBALS['TL_HOOKS']['processFormData'][] = array('UniversalPaymentPaypal', 'redirectToPaymentSite');

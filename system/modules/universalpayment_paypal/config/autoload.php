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
 * Register the classes
 */
ClassLoader::addClasses(array
(
	'ContentUniversalPaymentPaypal'				=> 'system/modules/universalpayment_paypal/ContentUniversalPaymentPaypal.php',
	'ModuleUniversalPaymentPaypal'				=> 'system/modules/universalpayment_paypal/ModuleUniversalPaymentPaypal.php',
	'TableContentUniversalPaymentPaypal'		=> 'system/modules/universalpayment_paypal/TableContentUniversalPaymentPaypal.php',
	'TableModuleUniversalPaymentPaypal'			=> 'system/modules/universalpayment_paypal/TableModuleUniversalPaymentPaypal.php',
	'TableFormFieldUniversalPaymentPaypal'		=> 'system/modules/universalpayment_paypal/TableFormFieldUniversalPaymentPaypal.php',
	'UniversalPaymentPaypal'					=> 'system/modules/universalpayment_paypal/UniversalPaymentPaypal.php',
	'UniversalPaymentPaypalField'				=> 'system/modules/universalpayment_paypal/UniversalPaymentPaypalField.php',
));

/**
 * Register the templates
 */
TemplateLoader::addFiles(array
(
	'form_payment_paypal'         				=> 'system/modules/universalpayment_paypal/templates',
));

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

$GLOBALS['TL_DCA']['tl_module']['config']['onload_callback'][] = array('TableModuleUniversalPaymentPaypal', 'modifyPalette');


/**
 * Fields
 */
$GLOBALS['TL_DCA']['tl_module']['fields']['up_paypalEmail'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_module']['up_paypalEmail'],
	'exclude'                 => true,
	'inputType'               => 'text',
	'eval'                    => array('rgxp'=>'email'),
	'sql'					  => "varchar(128) NOT NULL default ''",
);

$GLOBALS['TL_DCA']['tl_module']['fields']['up_paypalDebug'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_module']['up_paypalDebug'],
	'exclude'                 => true,
	'inputType'               => 'checkbox',
	'eval'                    => array(),
	'sql'					  => "char(1) NOT NULL default ''",
);

$GLOBALS['TL_DCA']['tl_module']['fields']['up_paypalJumpToComplete'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_module']['up_paypalJumpToComplete'],
	'exclude'                 => true,
	'inputType'               => 'pageTree',
	'eval'                    => array('fieldType'=>'radio', 'tl_class'=>'clr'),
	'sql'               	  => "int(10) unsigned NOT NULL default '0'"
);
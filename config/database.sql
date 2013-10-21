-- **********************************************************
-- *                                                        *
-- * IMPORTANT NOTE                                         *
-- *                                                        *
-- * Do not import this file manually but use the Contao    *
-- * install tool to create and maintain database tables!   *
-- *                                                        *
-- **********************************************************


-- --------------------------------------------------------

-- 
-- Table `tl_form_field`
-- 

CREATE TABLE `tl_form_field` (
	`up_paypalEmail` varchar(128) NOT NULL default ''
	`up_paypalDebug` char(1) NOT NULL default ''
	`up_paypalJumpToComplete` int(10) unsigned NOT NULL default '0',
	`up_paypalUrlParams` text NULL,
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- 
-- Table `tl_module`
-- 

CREATE TABLE `tl_module` (
	`up_paypalEmail` varchar(128) NOT NULL default ''
	`up_paypalDebug` char(1) NOT NULL default ''
	`up_paypalJumpToComplete` int(10) unsigned NOT NULL default '0',  
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- 
-- Table `tl_content`
-- 

CREATE TABLE `tl_content` (
	`up_paypalEmail` varchar(128) NOT NULL default ''
	`up_paypalDebug` char(1) NOT NULL default ''
	`up_paypalJumpToComplete` int(10) unsigned NOT NULL default '0',  
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
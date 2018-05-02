<?php

/**
 * @version     CVS: 1.0.0
 * @package     com_servin
 * @subpackage  mod_servin
 * @author      Aldo Ulises <aldouli6@gmail.com>
 * @copyright   2018 Aldo Ulises
 * @license     Licencia Pública General GNU versión 2 o posterior. Consulte LICENSE.txt
 */
defined('_JEXEC') or die;

// Include the syndicate functions only once
JLoader::register('ModServinHelper', dirname(__FILE__) . '/helper.php');

$doc = JFactory::getDocument();

/* */
$doc->addStyleSheet(JURI::base() . '/media/mod_servin/css/style.css');

/* */
$doc->addScript(JURI::base() . '/media/mod_servin/js/script.js');

require JModuleHelper::getLayoutPath('mod_servin', $params->get('content_type', 'blank'));

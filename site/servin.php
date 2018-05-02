<?php
/**
 * @version    CVS: 1.0.0
 * @package    Com_Servin
 * @author     Aldo Ulises <aldouli6@gmail.com>
 * @copyright  2018 Aldo Ulises
 * @license    Licencia Pública General GNU versión 2 o posterior. Consulte LICENSE.txt
 */

defined('_JEXEC') or die;

// Include dependancies
jimport('joomla.application.component.controller');

JLoader::registerPrefix('Servin', JPATH_COMPONENT);
JLoader::register('ServinController', JPATH_COMPONENT . '/controller.php');


// Execute the task.
$controller = JControllerLegacy::getInstance('Servin');
$controller->execute(JFactory::getApplication()->input->get('task'));
$controller->redirect();

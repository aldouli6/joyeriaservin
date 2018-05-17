<?php
/**
 * @version    CVS: 1.0.0
 * @package    Com_Servin
 * @author     Aldo Ulises <aldouli6@gmail.com>
 * @copyright  2018 Aldo Ulises
 * @license    Licencia Pública General GNU versión 2 o posterior. Consulte LICENSE.txt
 */

// No direct access
defined('_JEXEC') or die;

jimport('joomla.application.component.controllerform');

/**
 * Venta controller class.
 *
 * @since  1.6
 */
class ServinControllerVenta extends JControllerForm
{
	/**
	 * Constructor
	 *
	 * @throws Exception
	 */
	public function __construct()
	{
		$this->view_list = 'ventas';
		parent::__construct();
	}
	public function save(){  
	    //Obtener los objetos de la vista
	    $db = JFactory::getDbo();
	    $mainframe = JFactory::getApplication();
	    $datos = new Jregistry($mainframe -> input ->get('jform', '', 'array') );
	    /*$print=print_r( $datos['piezas'], true);
		$mainframe->enqueueMessage ($print,'notice' );*/
		$query = "select  piezas from #__servin_ventas where id =".$datos['id']."";
		$db->setQuery($query);
        $result=$db -> loadResult();
		$query = "update #__servin_piezas set estatus=1 where id in (".$result.")";
		$db->setQuery($query);
        $db->execute();
		$query = "update #__servin_piezas set estatus=3 where id in (".implode(',', $datos['piezas']).")";
		$db->setQuery($query);
        $db->execute();
		
		parent::save();
	
    	
	}

}

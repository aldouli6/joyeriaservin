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

use Joomla\Utilities\ArrayHelper;
/**
 * consignacion Table class
 *
 * @since  1.6
 */
class ServinTableconsignacion extends JTable
{
	
	/**
	 * Constructor
	 *
	 * @param   JDatabase  &$db  A database connector object
	 */
	public function __construct(&$db)
	{
		JObserverMapper::addObserverClassToClass('JTableObserverContenthistory', 'ServinTableconsignacion', array('typeAlias' => 'com_servin.consignacion'));
		parent::__construct('#__servin_consignaciones', 'id', $db);
	}

	/**
	 * Overloaded bind function to pre-process the params.
	 *
	 * @param   array  $array   Named array
	 * @param   mixed  $ignore  Optional array or list of parameters to ignore
	 *
	 * @return  null|string  null is operation was satisfactory, otherwise returns an error
	 *
	 * @see     JTable:bind
	 * @since   1.5
	 */
	public function bind($array, $ignore = '')
	{
	    $date = JFactory::getDate();
		$task = JFactory::getApplication()->input->get('task');
	    
		$input = JFactory::getApplication()->input;
		$task = $input->getString('task', '');

		if ($array['id'] == 0 && empty($array['created_by']))
		{
			$array['created_by'] = JFactory::getUser()->id;
		}

		if ($array['id'] == 0 && empty($array['modified_by']))
		{
			$array['modified_by'] = JFactory::getUser()->id;
		}

		if ($task == 'apply' || $task == 'save')
		{
			$array['modified_by'] = JFactory::getUser()->id;
		}

		if ($array['id'] == 0)
		{
			$array['created_at'] = $date->toSql();
		}

		if ($task == 'apply' || $task == 'save')
		{
			$array['modified_at'] = $date->toSql();
		}

		// Support for multiple or not foreign key field: cliente
			if(!empty($array['cliente']))
			{
				if(is_array($array['cliente'])){
					$array['cliente'] = implode(',',$array['cliente']);
				}
				else if(strrpos($array['cliente'], ',') != false){
					$array['cliente'] = explode(',',$array['cliente']);
				}
			}
			else {
				$array['cliente'] = '';
			}
		// Support for multi file field: foto_pagare
		if (!empty($array['foto_pagare']))
		{
			if (is_array($array['foto_pagare']))
			{
				$array['foto_pagare'] = implode(',', $array['foto_pagare']);
			}
			elseif (strpos($array['foto_pagare'], ',') != false)
			{
				$array['foto_pagare'] = explode(',', $array['foto_pagare']);
			}
		}
		else
		{
			$array['foto_pagare'] = '';
		}


		// Support for multiple or not foreign key field: piezas
			if(!empty($array['piezas']))
			{
				if(is_array($array['piezas'])){
					$array['piezas'] = implode(',',$array['piezas']);
				}
				else if(strrpos($array['piezas'], ',') != false){
					$array['piezas'] = explode(',',$array['piezas']);
				}
			}
			else {
				$array['piezas'] = '';
			}

		// Support for multiple or not foreign key field: devoluciones
			if(!empty($array['devoluciones']))
			{
				if(is_array($array['devoluciones'])){
					$array['devoluciones'] = implode(',',$array['devoluciones']);
				}
				else if(strrpos($array['devoluciones'], ',') != false){
					$array['devoluciones'] = explode(',',$array['devoluciones']);
				}
			}
			else {
				$array['devoluciones'] = '';
			}

		// Support for empty date field: fecha_emision
		if($array['fecha_emision'] == '0000-00-00' )
		{
			$array['fecha_emision'] = '';
		}

		// Support for empty date field: fecha_limite
		if($array['fecha_limite'] == '0000-00-00' )
		{
			$array['fecha_limite'] = '';
		}

		// Support for checkbox field: devolucion
		if (!isset($array['devolucion']))
		{
			$array['devolucion'] = 0;
		}

		// Support for empty date field: fecha_devolucion
		if($array['fecha_devolucion'] == '0000-00-00' )
		{
			$array['fecha_devolucion'] = '';
		}

		if (isset($array['params']) && is_array($array['params']))
		{
			$registry = new JRegistry;
			$registry->loadArray($array['params']);
			$array['params'] = (string) $registry;
		}

		if (isset($array['metadata']) && is_array($array['metadata']))
		{
			$registry = new JRegistry;
			$registry->loadArray($array['metadata']);
			$array['metadata'] = (string) $registry;
		}

		if (!JFactory::getUser()->authorise('core.admin', 'com_servin.consignacion.' . $array['id']))
		{
			$actions         = JAccess::getActionsFromFile(
				JPATH_ADMINISTRATOR . '/components/com_servin/access.xml',
				"/access/section[@name='consignacion']/"
			);
			$default_actions = JAccess::getAssetRules('com_servin.consignacion.' . $array['id'])->getData();
			$array_jaccess   = array();

			foreach ($actions as $action)
			{
                if (key_exists($action->name, $default_actions))
                {
                    $array_jaccess[$action->name] = $default_actions[$action->name];
                }
			}

			$array['rules'] = $this->JAccessRulestoArray($array_jaccess);
		}

		// Bind the rules for ACL where supported.
		if (isset($array['rules']) && is_array($array['rules']))
		{
			$this->setRules($array['rules']);
		}

		return parent::bind($array, $ignore);
	}

	/**
	 * This function convert an array of JAccessRule objects into an rules array.
	 *
	 * @param   array  $jaccessrules  An array of JAccessRule objects.
	 *
	 * @return  array
	 */
	private function JAccessRulestoArray($jaccessrules)
	{
		$rules = array();

		foreach ($jaccessrules as $action => $jaccess)
		{
			$actions = array();

			if ($jaccess)
			{
				foreach ($jaccess->getData() as $group => $allow)
				{
					$actions[$group] = ((bool)$allow);
				}
			}

			$rules[$action] = $actions;
		}

		return $rules;
	}

	/**
	 * Overloaded check function
	 *
	 * @return bool
	 */
	public function check()
	{
		// If there is an ordering column and this is a new row then get the next ordering value
		if (property_exists($this, 'ordering') && $this->id == 0)
		{
			$this->ordering = self::getNextOrder();
		}
		
		
		// Support multi file field: foto_pagare
		$app = JFactory::getApplication();
		$files = $app->input->files->get('jform', array(), 'raw');
		$array = $app->input->get('jform', array(), 'ARRAY');

		if ($files['foto_pagare'][0]['size'] > 0)
		{
			// Deleting existing files
			$oldFiles = ServinHelper::getFiles($this->id, $this->_tbl, 'foto_pagare');

			foreach ($oldFiles as $f)
			{
				$oldFile = JPATH_ROOT . '/uploads/' . $f;

				if (file_exists($oldFile) && !is_dir($oldFile))
				{
					unlink($oldFile);
				}
			}

			$this->foto_pagare = "";

			foreach ($files['foto_pagare'] as $singleFile )
			{
				jimport('joomla.filesystem.file');

				// Check if the server found any error.
				$fileError = $singleFile['error'];
				$message = '';

				if ($fileError > 0 && $fileError != 4)
				{
					switch ($fileError)
					{
						case 1:
							$message = JText::_('File size exceeds allowed by the server');
							break;
						case 2:
							$message = JText::_('File size exceeds allowed by the html form');
							break;
						case 3:
							$message = JText::_('Partial upload error');
							break;
					}

					if ($message != '')
					{
						$app->enqueueMessage($message, 'warning');

						return false;
					}
				}
				elseif ($fileError == 4)
				{
					if (isset($array['foto_pagare']))
					{
						$this->foto_pagare = $array['foto_pagare'];
					}
				}
				else
				{

					// Replace any special characters in the filename
					jimport('joomla.filesystem.file');
					$filename = JFile::stripExt($singleFile['name']);
					$extension = JFile::getExt($singleFile['name']);
					$filename = preg_replace("/[^A-Za-z0-9]/i", "-", $filename);
					$filename = $filename . '.' . $extension;
					$uploadPath = JPATH_ROOT . '/uploads/' . $filename;
					$fileTemp = $singleFile['tmp_name'];

					if (!JFile::exists($uploadPath))
					{
						if (!JFile::upload($fileTemp, $uploadPath))
						{
							$app->enqueueMessage('Error moving file', 'warning');

							return false;
						}
					}

					$this->foto_pagare .= (!empty($this->foto_pagare)) ? "," : "";
					$this->foto_pagare .= $filename;
				}
			}
		}
		else
		{
			$this->foto_pagare .= $array['foto_pagare_hidden'];
		}

		return parent::check();
	}

	/**
	 * Method to set the publishing state for a row or list of rows in the database
	 * table.  The method respects checked out rows by other users and will attempt
	 * to checkin rows that it can after adjustments are made.
	 *
	 * @param   mixed    $pks     An optional array of primary key values to update.  If not
	 *                            set the instance property value is used.
	 * @param   integer  $state   The publishing state. eg. [0 = unpublished, 1 = published]
	 * @param   integer  $userId  The user id of the user performing the operation.
	 *
	 * @return   boolean  True on success.
	 *
	 * @since    1.0.4
	 *
	 * @throws Exception
	 */
	public function publish($pks = null, $state = 1, $userId = 0)
	{
		// Initialise variables.
		$k = $this->_tbl_key;

		// Sanitize input.
		ArrayHelper::toInteger($pks);
		$userId = (int) $userId;
		$state  = (int) $state;

		// If there are no primary keys set check to see if the instance key is set.
		if (empty($pks))
		{
			if ($this->$k)
			{
				$pks = array($this->$k);
			}
			// Nothing to set publishing state on, return false.
			else
			{
				throw new Exception(500, JText::_('JLIB_DATABASE_ERROR_NO_ROWS_SELECTED'));
			}
		}

		// Build the WHERE clause for the primary keys.
		$where = $k . '=' . implode(' OR ' . $k . '=', $pks);

		// Determine if there is checkin support for the table.
		if (!property_exists($this, 'checked_out') || !property_exists($this, 'checked_out_time'))
		{
			$checkin = '';
		}
		else
		{
			$checkin = ' AND (checked_out = 0 OR checked_out = ' . (int) $userId . ')';
		}

		// Update the publishing state for rows with the given primary keys.
		$this->_db->setQuery(
			'UPDATE `' . $this->_tbl . '`' .
			' SET `state` = ' . (int) $state .
			' WHERE (' . $where . ')' .
			$checkin
		);
		$this->_db->execute();

		// If checkin is supported and all rows were adjusted, check them in.
		if ($checkin && (count($pks) == $this->_db->getAffectedRows()))
		{
			// Checkin each row.
			foreach ($pks as $pk)
			{
				$this->checkin($pk);
			}
		}

		// If the JTable instance value is in the list of primary keys that were set, set the instance.
		if (in_array($this->$k, $pks))
		{
			$this->state = $state;
		}

		return true;
	}

	/**
	 * Define a namespaced asset name for inclusion in the #__assets table
	 *
	 * @return string The asset name
	 *
	 * @see JTable::_getAssetName
	 */
	protected function _getAssetName()
	{
		$k = $this->_tbl_key;

		return 'com_servin.consignacion.' . (int) $this->$k;
	}

	/**
	 * Returns the parent asset's id. If you have a tree structure, retrieve the parent's id using the external key field
	 *
	 * @param   JTable   $table  Table name
	 * @param   integer  $id     Id
	 *
	 * @see JTable::_getAssetParentId
	 *
	 * @return mixed The id on success, false on failure.
	 */
	protected function _getAssetParentId(JTable $table = null, $id = null)
	{
		// We will retrieve the parent-asset from the Asset-table
		$assetParent = JTable::getInstance('Asset');

		// Default: if no asset-parent can be found we take the global asset
		$assetParentId = $assetParent->getRootId();

		// The item has the component as asset-parent
		$assetParent->loadByName('com_servin');

		// Return the found asset-parent-id
		if ($assetParent->id)
		{
			$assetParentId = $assetParent->id;
		}

		return $assetParentId;
	}

	/**
	 * Delete a record by id
	 *
	 * @param   mixed  $pk  Primary key value to delete. Optional
	 *
	 * @return bool
	 */
	public function delete($pk = null)
	{
		$this->load($pk);
		$result = parent::delete($pk);
		
		if ($result)
		{
			jimport('joomla.filesystem.file');

			foreach ($this->foto_pagare as $foto_pagareFile)
			{
				JFile::delete(JPATH_ROOT . '/uploads/' . $foto_pagareFile);
			}
		}

		return $result;
	}
}

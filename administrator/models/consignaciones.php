<?php

/**
 * @version    CVS: 1.0.0
 * @package    Com_Servin
 * @author     Aldo Ulises <aldouli6@gmail.com>
 * @copyright  2018 Aldo Ulises
 * @license    Licencia Pública General GNU versión 2 o posterior. Consulte LICENSE.txt
 */
defined('_JEXEC') or die;

jimport('joomla.application.component.modellist');

/**
 * Methods supporting a list of Servin records.
 *
 * @since  1.6
 */
class ServinModelConsignaciones extends JModelList
{
/**
	* Constructor.
	*
	* @param   array  $config  An optional associative array of configuration settings.
	*
	* @see        JController
	* @since      1.6
	*/
	public function __construct($config = array())
	{
		if (empty($config['filter_fields']))
		{
			$config['filter_fields'] = array(
				'id', 'a.`id`',
				'ordering', 'a.`ordering`',
				'state', 'a.`state`',
				'created_by', 'a.`created_by`',
				'modified_by', 'a.`modified_by`',
				'created_at', 'a.`created_at`',
				'modified_at', 'a.`modified_at`',
				'cliente', 'a.`cliente`',
				'no_folio_pagare', 'a.`no_folio_pagare`',
				'foto_pagare', 'a.`foto_pagare`',
				'piezas', 'a.`piezas`',
				'total', 'a.`total`',
				'abono', 'a.`abono`',
				'devoluciones', 'a.`devoluciones`',
				'adeudo', 'a.`adeudo`',
				'fecha_emision', 'a.`fecha_emision`',
				'fecha_limite', 'a.`fecha_limite`',
				'devolucion', 'a.`devolucion`',
				'fecha_devolucion', 'a.`fecha_devolucion`',
				'estatus', 'a.`estatus`',
			);
		}

		parent::__construct($config);
	}

	/**
	 * Method to auto-populate the model state.
	 *
	 * Note. Calling getState in this method will result in recursion.
	 *
	 * @param   string  $ordering   Elements order
	 * @param   string  $direction  Order direction
	 *
	 * @return void
	 *
	 * @throws Exception
	 */
	protected function populateState($ordering = null, $direction = null)
	{
		// Initialise variables.
		$app = JFactory::getApplication('administrator');

		// Load the filter state.
		$search = $app->getUserStateFromRequest($this->context . '.filter.search', 'filter_search');
		$this->setState('filter.search', $search);

		$published = $app->getUserStateFromRequest($this->context . '.filter.state', 'filter_published', '', 'string');
		$this->setState('filter.state', $published);
		// Filtering cliente
		$this->setState('filter.cliente', $app->getUserStateFromRequest($this->context.'.filter.cliente', 'filter_cliente', '', 'string'));

		// Filtering piezas
		$this->setState('filter.piezas', $app->getUserStateFromRequest($this->context.'.filter.piezas', 'filter_piezas', '', 'string'));

		// Filtering fecha_emision
		$this->setState('filter.fecha_emision.from', $app->getUserStateFromRequest($this->context.'.filter.fecha_emision.from', 'filter_from_fecha_emision', '', 'string'));
		$this->setState('filter.fecha_emision.to', $app->getUserStateFromRequest($this->context.'.filter.fecha_emision.to', 'filter_to_fecha_emision', '', 'string'));

		// Filtering fecha_limite
		$this->setState('filter.fecha_limite.from', $app->getUserStateFromRequest($this->context.'.filter.fecha_limite.from', 'filter_from_fecha_limite', '', 'string'));
		$this->setState('filter.fecha_limite.to', $app->getUserStateFromRequest($this->context.'.filter.fecha_limite.to', 'filter_to_fecha_limite', '', 'string'));

		// Filtering fecha_devolucion
		$this->setState('filter.fecha_devolucion.from', $app->getUserStateFromRequest($this->context.'.filter.fecha_devolucion.from', 'filter_from_fecha_devolucion', '', 'string'));
		$this->setState('filter.fecha_devolucion.to', $app->getUserStateFromRequest($this->context.'.filter.fecha_devolucion.to', 'filter_to_fecha_devolucion', '', 'string'));


		// Load the parameters.
		$params = JComponentHelper::getParams('com_servin');
		$this->setState('params', $params);

		// List state information.
		parent::populateState('a.cliente', 'asc');
	}

	/**
	 * Method to get a store id based on model configuration state.
	 *
	 * This is necessary because the model is used by the component and
	 * different modules that might need different sets of data or different
	 * ordering requirements.
	 *
	 * @param   string  $id  A prefix for the store id.
	 *
	 * @return   string A store id.
	 *
	 * @since    1.6
	 */
	protected function getStoreId($id = '')
	{
		// Compile the store id.
		$id .= ':' . $this->getState('filter.search');
		$id .= ':' . $this->getState('filter.state');

		return parent::getStoreId($id);
	}

	/**
	 * Build an SQL query to load the list data.
	 *
	 * @return   JDatabaseQuery
	 *
	 * @since    1.6
	 */
	protected function getListQuery()
	{
		// Create a new query object.
		$db    = $this->getDbo();
		$query = $db->getQuery(true);

		// Select the required fields from the table.
		$query->select(
			$this->getState(
				'list.select', 'DISTINCT a.*'
			)
		);
		$query->from('`#__servin_consignaciones` AS a');


		// Join over the user field 'created_by'
		$query->select('`created_by`.name AS `created_by`');
		$query->join('LEFT', '#__users AS `created_by` ON `created_by`.id = a.`created_by`');

		// Join over the user field 'modified_by'
		$query->select('`modified_by`.name AS `modified_by`');
		$query->join('LEFT', '#__users AS `modified_by` ON `modified_by`.id = a.`modified_by`');
		// Join over the foreign key 'cliente'
		$query->select('`#__servin_clientes_2990181`.`nombre` AS clientes_fk_value_2990181');
		$query->join('LEFT', '#__servin_clientes AS #__servin_clientes_2990181 ON #__servin_clientes_2990181.`id` = a.`cliente`');
		// Join over the foreign key 'piezas'
		$query->select('CONCAT(`#__servin_piezas_2990185`.`hechura`, \' \', `#__servin_piezas_2990185`.`descripcion`) AS piezas_fk_value_2990185');
		$query->join('LEFT', '#__servin_piezas AS #__servin_piezas_2990185 ON #__servin_piezas_2990185.`id` = a.`piezas`');
		// Join over the foreign key 'devoluciones'
		$query->select('`#__servin_consignaciones_2993742`.`no_folio_pagare` AS #__servin_consignaciones_fk_value_2993742');
		$query->join('LEFT', '#__servin_consignaciones AS #__servin_consignaciones_2993742 ON #__servin_consignaciones_2993742.`id` = a.`devoluciones`');

		// Filter by published state
		$published = $this->getState('filter.state');

		if (is_numeric($published))
		{
			$query->where('a.state = ' . (int) $published);
		}
		elseif ($published === '')
		{
			$query->where('(a.state IN (0, 1))');
		}

		// Filter by search in title
		$search = $this->getState('filter.search');

		if (!empty($search))
		{
			if (stripos($search, 'id:') === 0)
			{
				$query->where('a.id = ' . (int) substr($search, 3));
			}
			else
			{
				$search = $db->Quote('%' . $db->escape($search, true) . '%');
				$query->where('(#__servin_clientes_2990181.nombre LIKE ' . $search . '  OR  a.no_folio_pagare LIKE ' . $search . '  OR CONCAT(`#__servin_piezas_2990185`.`hechura`, \' \', `#__servin_piezas_2990185`.`descripcion`) LIKE ' . $search . '  OR  a.total LIKE ' . $search . '  OR  a.abono LIKE ' . $search . '  OR  a.adeudo LIKE ' . $search . '  OR  a.fecha_emision LIKE ' . $search . '  OR  a.fecha_limite LIKE ' . $search . '  OR  a.fecha_devolucion LIKE ' . $search . '  OR  a.estatus LIKE ' . $search . ' )');
			}
		}


		// Filtering cliente
		$filter_cliente = $this->state->get("filter.cliente");

		if ($filter_cliente !== null && !empty($filter_cliente))
		{
			$query->where("FIND_IN_SET('" . $db->escape($filter_cliente) . "',a.cliente)");
		}

		// Filtering piezas
		$filter_piezas = $this->state->get("filter.piezas");

		if ($filter_piezas !== null && !empty($filter_piezas))
		{
			$query->where("FIND_IN_SET('" . $db->escape($filter_piezas) . "',a.piezas)");
		}

		// Filtering fecha_emision
		$filter_fecha_emision_from = $this->state->get("filter.fecha_emision.from");

		if ($filter_fecha_emision_from !== null && !empty($filter_fecha_emision_from))
		{
			$query->where("a.`fecha_emision` >= '".$db->escape($filter_fecha_emision_from)."'");
		}
		$filter_fecha_emision_to = $this->state->get("filter.fecha_emision.to");

		if ($filter_fecha_emision_to !== null  && !empty($filter_fecha_emision_to))
		{
			$query->where("a.`fecha_emision` <= '".$db->escape($filter_fecha_emision_to)."'");
		}

		// Filtering fecha_limite
		$filter_fecha_limite_from = $this->state->get("filter.fecha_limite.from");

		if ($filter_fecha_limite_from !== null && !empty($filter_fecha_limite_from))
		{
			$query->where("a.`fecha_limite` >= '".$db->escape($filter_fecha_limite_from)."'");
		}
		$filter_fecha_limite_to = $this->state->get("filter.fecha_limite.to");

		if ($filter_fecha_limite_to !== null  && !empty($filter_fecha_limite_to))
		{
			$query->where("a.`fecha_limite` <= '".$db->escape($filter_fecha_limite_to)."'");
		}

		// Filtering fecha_devolucion
		$filter_fecha_devolucion_from = $this->state->get("filter.fecha_devolucion.from");

		if ($filter_fecha_devolucion_from !== null && !empty($filter_fecha_devolucion_from))
		{
			$query->where("a.`fecha_devolucion` >= '".$db->escape($filter_fecha_devolucion_from)."'");
		}
		$filter_fecha_devolucion_to = $this->state->get("filter.fecha_devolucion.to");

		if ($filter_fecha_devolucion_to !== null  && !empty($filter_fecha_devolucion_to))
		{
			$query->where("a.`fecha_devolucion` <= '".$db->escape($filter_fecha_devolucion_to)."'");
		}
		// Add the list ordering clause.
		$orderCol  = $this->state->get('list.ordering');
		$orderDirn = $this->state->get('list.direction');

		if ($orderCol && $orderDirn)
		{
			$query->order($db->escape($orderCol . ' ' . $orderDirn));
		}

		return $query;
	}

	/**
	 * Get an array of data items
	 *
	 * @return mixed Array of data items on success, false on failure.
	 */
	public function getItems()
	{
		$items = parent::getItems();

		foreach ($items as $oneItem)
		{

			if (isset($oneItem->cliente))
			{
				$values    = explode(',', $oneItem->cliente);
				$textValue = array();

				foreach ($values as $value)
				{
					$db    = JFactory::getDbo();
					$query = $db->getQuery(true);
					$query
						->select('`#__servin_clientes_2990181`.`nombre`')
						->from($db->quoteName('#__servin_clientes', '#__servin_clientes_2990181'))
						->where($db->quoteName('id') . ' = '. $db->quote($db->escape($value)));

					$db->setQuery($query);
					$results = $db->loadObject();

					if ($results)
					{
						$textValue[] = $results->nombre;
					}
				}

				$oneItem->cliente = !empty($textValue) ? implode(', ', $textValue) : $oneItem->cliente;
			}

			if (isset($oneItem->piezas))
			{
				$values    = explode(',', $oneItem->piezas);
				$textValue = array();

				foreach ($values as $value)
				{
					$db    = JFactory::getDbo();
					$query = $db->getQuery(true);
					$query
						->select('CONCAT(`#__servin_piezas_2990185`.`hechura`, \' \', `#__servin_piezas_2990185`.`descripcion`) AS `fk_value`')
						->from($db->quoteName('#__servin_piezas', '#__servin_piezas_2990185'))
						->where($db->quoteName('id') . ' = '. $db->quote($db->escape($value)));

					$db->setQuery($query);
					$results = $db->loadObject();

					if ($results)
					{
						$textValue[] = $results->fk_value;
					}
				}

				$oneItem->piezas = !empty($textValue) ? implode(', ', $textValue) : $oneItem->piezas;
			}
					$oneItem->estatus = ($oneItem->estatus == '') ? '' : JText::_('COM_SERVIN_CONSIGNACIONES_ESTATUS_OPTION_' . strtoupper($oneItem->estatus));
		}

		return $items;
	}
}

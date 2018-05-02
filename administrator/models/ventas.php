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
class ServinModelVentas extends JModelList
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
				'piezas', 'a.`piezas`',
				'fecha', 'a.`fecha`',
				'cliente', 'a.`cliente`',
				'total', 'a.`total`',
				'metodo_pago', 'a.`metodo_pago`',
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
		// Filtering piezas
		$this->setState('filter.piezas', $app->getUserStateFromRequest($this->context.'.filter.piezas', 'filter_piezas', '', 'string'));

		// Filtering fecha
		$this->setState('filter.fecha.from', $app->getUserStateFromRequest($this->context.'.filter.fecha.from', 'filter_from_fecha', '', 'string'));
		$this->setState('filter.fecha.to', $app->getUserStateFromRequest($this->context.'.filter.fecha.to', 'filter_to_fecha', '', 'string'));

		// Filtering cliente
		$this->setState('filter.cliente', $app->getUserStateFromRequest($this->context.'.filter.cliente', 'filter_cliente', '', 'string'));

		// Filtering metodo_pago
		$this->setState('filter.metodo_pago', $app->getUserStateFromRequest($this->context.'.filter.metodo_pago', 'filter_metodo_pago', '', 'string'));


		// Load the parameters.
		$params = JComponentHelper::getParams('com_servin');
		$this->setState('params', $params);

		// List state information.
		parent::populateState('a.piezas', 'asc');
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
		$query->from('`#__servin_ventas` AS a');


		// Join over the user field 'created_by'
		$query->select('`created_by`.name AS `created_by`');
		$query->join('LEFT', '#__users AS `created_by` ON `created_by`.id = a.`created_by`');

		// Join over the user field 'modified_by'
		$query->select('`modified_by`.name AS `modified_by`');
		$query->join('LEFT', '#__users AS `modified_by` ON `modified_by`.id = a.`modified_by`');
		// Join over the foreign key 'piezas'
		$query->select('CONCAT(`#__servin_piezas_2990167`.`hechura`, \' \', `#__servin_piezas_2990167`.`descripcion`) AS piezas_fk_value_2990167');
		$query->join('LEFT', '#__servin_piezas AS #__servin_piezas_2990167 ON #__servin_piezas_2990167.`id` = a.`piezas`');
		// Join over the foreign key 'cliente'
		$query->select('`#__servin_clientes_2990169`.`nombre` AS clientes_fk_value_2990169');
		$query->join('LEFT', '#__servin_clientes AS #__servin_clientes_2990169 ON #__servin_clientes_2990169.`id` = a.`cliente`');

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
				$query->where('(CONCAT(`#__servin_piezas_2990167`.`hechura`, \' \', `#__servin_piezas_2990167`.`descripcion`) LIKE ' . $search . '  OR  a.fecha LIKE ' . $search . '  OR #__servin_clientes_2990169.nombre LIKE ' . $search . '  OR  a.total LIKE ' . $search . '  OR  a.metodo_pago LIKE ' . $search . ' )');
			}
		}


		// Filtering piezas
		$filter_piezas = $this->state->get("filter.piezas");

		if ($filter_piezas !== null && !empty($filter_piezas))
		{
			$query->where("FIND_IN_SET('" . $db->escape($filter_piezas) . "',a.piezas)");
		}

		// Filtering fecha
		$filter_fecha_from = $this->state->get("filter.fecha.from");

		if ($filter_fecha_from !== null && !empty($filter_fecha_from))
		{
			$query->where("a.`fecha` >= '".$db->escape($filter_fecha_from)."'");
		}
		$filter_fecha_to = $this->state->get("filter.fecha.to");

		if ($filter_fecha_to !== null  && !empty($filter_fecha_to))
		{
			$query->where("a.`fecha` <= '".$db->escape($filter_fecha_to)."'");
		}

		// Filtering cliente
		$filter_cliente = $this->state->get("filter.cliente");

		if ($filter_cliente !== null && !empty($filter_cliente))
		{
			$query->where("FIND_IN_SET('" . $db->escape($filter_cliente) . "',a.cliente)");
		}

		// Filtering metodo_pago
		$filter_metodo_pago = $this->state->get("filter.metodo_pago");

		if ($filter_metodo_pago !== null && (is_numeric($filter_metodo_pago) || !empty($filter_metodo_pago)))
		{
			$query->where("a.`metodo_pago` = '".$db->escape($filter_metodo_pago)."'");
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

			if (isset($oneItem->piezas))
			{
				$values    = explode(',', $oneItem->piezas);
				$textValue = array();

				foreach ($values as $value)
				{
					$db    = JFactory::getDbo();
					$query = $db->getQuery(true);
					$query
						->select('CONCAT(`#__servin_piezas_2990167`.`hechura`, \' \', `#__servin_piezas_2990167`.`descripcion`) AS `fk_value`')
						->from($db->quoteName('#__servin_piezas', '#__servin_piezas_2990167'))
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

			if (isset($oneItem->cliente))
			{
				$values    = explode(',', $oneItem->cliente);
				$textValue = array();

				foreach ($values as $value)
				{
					$db    = JFactory::getDbo();
					$query = $db->getQuery(true);
					$query
						->select('`#__servin_clientes_2990169`.`nombre`')
						->from($db->quoteName('#__servin_clientes', '#__servin_clientes_2990169'))
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
					$oneItem->metodo_pago = JText::_('COM_SERVIN_VENTAS_METODO_PAGO_OPTION_' . strtoupper($oneItem->metodo_pago));
		}

		return $items;
	}
}

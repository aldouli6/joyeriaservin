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

JHtml::addIncludePath(JPATH_COMPONENT . '/helpers/html');
JHtml::_('behavior.tooltip');
JHtml::_('behavior.formvalidation');
JHtml::_('formbehavior.chosen', 'select');
JHtml::_('behavior.keepalive');

// Import CSS
$document = JFactory::getDocument();
$document->addStyleSheet(JUri::root() . 'media/com_servin/css/form.css');
$db = JFactory::getDbo();
$query = $db->getQuery(true);
$piezas=array();
foreach((array)$this->item->piezas as $value): 
	if(!is_array($value)):
		$piezas[]= $value;
	endif;
endforeach;
$query="sELECT p.id FROM #__servin_piezas as p inner join #__servin_hechuras as h on h.id = p.hechura where p.estatus != 1 and p.id not in (".implode(',', $piezas).")";
$db -> setQuery($query);
$result=$db -> loadColumn();
?>
<script type="text/javascript">
	js = jQuery.noConflict();

	js(document).ready(function () {
	var obj = '<?php echo json_encode($result); ?>';
	var objeto = JSON.parse(obj);
	js.each( objeto, function( key, value ) {
		js("#jform_piezas option[value='"+value+"']").remove();
	});	
	js('input:hidden.piezas').each(function(){
		var name = js(this).attr('name');
		if(name.indexOf('piezashidden')){
			js('#jform_piezas option[value="'+js(this).val()+'"]').attr('selected',true);
		}
	});
	js("#jform_piezas").trigger("liszt:updated");
	js('input:hidden.cliente').each(function(){
		var name = js(this).attr('name');
		if(name.indexOf('clientehidden')){
			js('#jform_cliente option[value="'+js(this).val()+'"]').attr('selected',true);
		}
	});
	js("#jform_cliente").trigger("liszt:updated");
	js('#jform_piezas').on('change',function(e){
		 js.ajax({ 
            url: "index.php?option=com_servin&task=consultotal&view=ajaxs&tmpl=ajax&string=" + js(this).val(),  
            async: true, 
            success: function(result){
            	js('#jform_total').val(result); 
            },
            error: function(result) {
                console.log(result);
            }
    	});
    });

	});

	Joomla.submitbutton = function (task) {
		if (task == 'venta.cancel') {
			Joomla.submitform(task, document.getElementById('venta-form'));
		}
		else {
			
			if (task != 'venta.cancel' && document.formvalidator.isValid(document.id('venta-form'))) {
				
				Joomla.submitform(task, document.getElementById('venta-form'));
			}
			else {
				alert('<?php echo $this->escape(JText::_('JGLOBAL_VALIDATION_FORM_FAILED')); ?>');
			}
		}
	}
</script>

<form
	action="<?php echo JRoute::_('index.php?option=com_servin&layout=edit&id=' . (int) $this->item->id); ?>"
	method="post" enctype="multipart/form-data" name="adminForm" id="venta-form" class="form-validate">

	<div class="form-horizontal">
		<?php echo JHtml::_('bootstrap.startTabSet', 'myTab', array('active' => 'general')); ?>

		<?php echo JHtml::_('bootstrap.addTab', 'myTab', 'general', JText::_('COM_SERVIN_TITLE_VENTA', true)); ?>
		<div class="row-fluid">
			<div class="span10 form-horizontal">
				<fieldset class="adminform">

									<input type="hidden" name="jform[id]" value="<?php echo $this->item->id; ?>" />
				<input type="hidden" name="jform[ordering]" value="<?php echo $this->item->ordering; ?>" />
				<input type="hidden" name="jform[state]" value="<?php echo $this->item->state; ?>" />
				<input type="hidden" name="jform[checked_out]" value="<?php echo $this->item->checked_out; ?>" />
				<input type="hidden" name="jform[checked_out_time]" value="<?php echo $this->item->checked_out_time; ?>" />

				<?php echo $this->form->renderField('created_by'); ?>
				<?php echo $this->form->renderField('modified_by'); ?>
				<?php echo $this->form->renderField('created_at'); ?>
				<?php echo $this->form->renderField('modified_at'); ?>				
				<?php echo $this->form->renderField('piezas'); ?>

			<?php
				foreach((array)$this->item->piezas as $value): 
					if(!is_array($value) ):
						echo '<input type="hidden" class="piezas" name="jform[piezashidden]['.$value.']" value="'.$value.'" />';
					endif;
				endforeach;
			?>				<?php echo $this->form->renderField('fecha'); ?>
				<?php echo $this->form->renderField('cliente'); ?>

			<?php
				foreach((array)$this->item->cliente as $value): 
					if(!is_array($value)):
						echo '<input type="hidden" class="cliente" name="jform[clientehidden]['.$value.']" value="'.$value.'" />';
					endif;
				endforeach;
			?>				<?php echo $this->form->renderField('total'); ?>
				<?php echo $this->form->renderField('metodo_pago'); ?>


					<?php if ($this->state->params->get('save_history', 1)) : ?>
					<div class="control-group">
						<div class="control-label"><?php echo $this->form->getLabel('version_note'); ?></div>
						<div class="controls"><?php echo $this->form->getInput('version_note'); ?></div>
					</div>
					<?php endif; ?>
				</fieldset>
			</div>
		</div>
		<?php echo JHtml::_('bootstrap.endTab'); ?>

		

		<?php echo JHtml::_('bootstrap.endTabSet'); ?>

		<input type="hidden" name="task" value=""/>
		<?php echo JHtml::_('form.token'); ?>

	</div>
</form>

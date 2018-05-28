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
JHTML::_('behavior.modal');

// Import CSS
$document = JFactory::getDocument();
$document->addStyleSheet(JUri::root() . 'media/com_servin/css/form.css');
?>
<script type="text/javascript">
	js = jQuery.noConflict();
	js(document).ready(function () {
	console.log(screen.width + " x " + screen.height) 
	js('#toolbar').append(js('#nuevapieza'));		
	penultima ='0';
	js( "#jform_piezas_chzn" ).click(function() {
		ultima =js('#jform_piezas option:last').val();
		if(ultima != penultima){
			js.ajax({ 
            url: "index.php?option=com_servin&task=nuevapieza&view=ajaxs&tmpl=ajax&id=" + ultima,  
            async: true, 
            success: function(result){
            	var obj = result;
				var objeto = JSON.parse(obj);
				js.each( objeto, function( key, value ) {
					js('#jform_piezas').append('<option value="'+key+'">'+value+'</option>');
					js("#jform_piezas").trigger("liszt:updated");
					penultima = key;
				});
            	
            },
            error: function(result) {
                console.log('ocurrio un error');
            }
        });
		}
	});
	js('input:hidden.piezas').each(function(){
		var name = js(this).attr('name');
		if(name.indexOf('piezashidden')){
			js('#jform_piezas option[value="'+js(this).val()+'"]').attr('selected',true);
		}
	});
	js("#jform_piezas").trigger("liszt:updated");
	js('input:hidden.proveedor').each(function(){
		var name = js(this).attr('name');
		if(name.indexOf('proveedorhidden')){
			js('#jform_proveedor option[value="'+js(this).val()+'"]').attr('selected',true);
		}
	});
	js("#jform_proveedor").trigger("liszt:updated");
	});

	Joomla.submitbutton = function (task) {
		if (task == 'compra.cancel') {
			Joomla.submitform(task, document.getElementById('compra-form'));
		}
		else {
			
			if (task != 'compra.cancel' && document.formvalidator.isValid(document.id('compra-form'))) {
				
				Joomla.submitform(task, document.getElementById('compra-form'));
			}
			else {
				alert('<?php echo $this->escape(JText::_('JGLOBAL_VALIDATION_FORM_FAILED')); ?>');
			}
		}
	}
</script>

<form
	action="<?php echo JRoute::_('index.php?option=com_servin&layout=edit&id=' . (int) $this->item->id); ?>"
	method="post" enctype="multipart/form-data" name="adminForm" id="compra-form" class="form-validate">

	<div class="form-horizontal">
		<?php echo JHtml::_('bootstrap.startTabSet', 'myTab', array('active' => 'general')); ?>

		<?php echo JHtml::_('bootstrap.addTab', 'myTab', 'general', JText::_('COM_SERVIN_TITLE_COMPRA', true)); ?>
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
				<div class="btn-wrapper" id="nuevapieza">
					<a  class = "btn btn-small button-apply btn-success" href="<?= JUri::base()?>index.php?option=com_servin&view=pieza&layout=edit&popup=true" target="_blank" onclick="window.open(this.href, this.target, 'width='+(screen.width)/2+',height='+(screen.height)/1.3+''); return false;"><span class="icon-new icon-white" aria-hidden="true"></span>Nueva pieza</a>
					
				</div>
				
				


			<?php
				foreach((array)$this->item->piezas as $value): 
					if(!is_array($value)):
						echo '<input type="hidden" class="piezas" name="jform[piezashidden]['.$value.']" value="'.$value.'" />';
					endif;
				endforeach;
			?>				<?php echo $this->form->renderField('fecha'); ?>
				<?php echo $this->form->renderField('proveedor'); ?>

			<?php
				foreach((array)$this->item->proveedor as $value): 
					if(!is_array($value)):
						echo '<input type="hidden" class="proveedor" name="jform[proveedorhidden]['.$value.']" value="'.$value.'" />';
					endif;
				endforeach;
			?>				<?php echo $this->form->renderField('total'); ?>


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

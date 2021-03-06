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
?>
<script type="text/javascript">
	function round(num, scale) {
	  if(!("" + num).includes("e")) {
	    return +(Math.round(num + "e+" + scale)  + "e-" + scale);  
	  } else {
	    var arr = ("" + num).split("e");
	    var sig = ""
	    if(+arr[1] + scale > 0) {
	      sig = "+";
	    }
	    var i = +arr[0] + "e" + sig + (+arr[1] + scale);
	    var j = Math.round(i);
	    var k = +(j + "e-" + scale);
	    return k;  
	    alert(k);
	  }
	}
	function calcular(){
		js('#jform_total').attr('min',js('#jform_abono').val());
		js('#jform_abono').attr('max',js('#jform_total').val());
		var tota = js('#jform_total').val();
	    var abon = js('#jform_abono').val();
	    var sal = tota - abon;
	    var sald = js('#jform_saldo').val(round(sal,2));
	    var saux = js('#jform_saldoaux').val(round(sal,2));	
	    if(round(sal,2) == 0){
	    	js("input[name='jform[estatus]' ]").val(2);
	    	js("#jform_estatus1").prop("checked", true);
	    }else{
	    	js("input[name='jform[estatus]' ]").val(1);
	    	js("#jform_estatus0").prop("checked", true);
	    } 
	}
	js = jQuery.noConflict();
	js(document).ready(function () {
		
	js('input:hidden.proveedor').each(function(){
		var name = js(this).attr('name');
		if(name.indexOf('proveedorhidden')){
			js('#jform_proveedor option[value="'+js(this).val()+'"]').attr('selected',true);
		}
	});
	js("#jform_proveedor").trigger("liszt:updated");
	js('#jform_saldoaux').val(js('#jform_saldo').val());
	js('#jform_total').attr('min',js('#jform_abono').val());
	js('#jform_abono').attr('max',js('#jform_total').val());
	js('#jform_total').on('change',function(e){
		calcular();
    });
    js('#jform_abono').on('change',function(e){
		calcular();
    });

	});

	Joomla.submitbutton = function (task) {
		if (task == 'deuda.cancel') {
			Joomla.submitform(task, document.getElementById('deuda-form'));
		}
		else {
			
			if (task != 'deuda.cancel' && document.formvalidator.isValid(document.id('deuda-form'))) {
				
				Joomla.submitform(task, document.getElementById('deuda-form'));
			}
			else {
				alert('<?php echo $this->escape(JText::_('JGLOBAL_VALIDATION_FORM_FAILED')); ?>');
			}
		}
	}
</script>

<form
	action="<?php echo JRoute::_('index.php?option=com_servin&layout=edit&id=' . (int) $this->item->id); ?>"
	method="post" enctype="multipart/form-data" name="adminForm" id="deuda-form" class="form-validate">

	<div class="form-horizontal">
		<?php echo JHtml::_('bootstrap.startTabSet', 'myTab', array('active' => 'general')); ?>

		<?php echo JHtml::_('bootstrap.addTab', 'myTab', 'general', JText::_('COM_SERVIN_TITLE_DEUDA', true)); ?>
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
				<?php echo $this->form->renderField('modified_at'); ?>				<?php echo $this->form->renderField('proveedor'); ?>

			<?php
				foreach((array)$this->item->proveedor as $value): 
					if(!is_array($value)):
						echo '<input type="hidden" class="proveedor" name="jform[proveedorhidden]['.$value.']" value="'.$value.'" />';
					endif;
				endforeach;
			?>				<?php echo $this->form->renderField('fecha_compra'); ?>
				<?php echo $this->form->renderField('fecha_limite'); ?>
				<?php echo $this->form->renderField('total'); ?>
				<?php echo $this->form->renderField('abono'); ?>
				<?php echo $this->form->renderField('saldo'); ?>
				<?php echo $this->form->renderField('resumen'); ?>
				<?php echo $this->form->renderField('estatus'); ?>


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

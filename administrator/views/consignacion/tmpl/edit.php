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
$piezas=$result=array();
foreach((array)$this->item->piezas as $value): 
	if(!is_array($value)):
		$piezas[]= $value;
	endif;
endforeach;
if(!empty($piezas)){
	$query="sELECT p.id FROM #__servin_piezas as p inner join #__servin_hechuras as h on h.id = p.hechura where p.estatus != 1 and p.id not in (".implode(',', $piezas).")";	
	$db -> setQuery($query);
	$result=$db -> loadColumn();
}else{
	$query="sELECT p.id FROM #__servin_piezas as p inner join #__servin_hechuras as h on h.id = p.hechura where p.estatus != 1 ";
	$db -> setQuery($query);
	$result=$db -> loadColumn();
}
	/*$query="sELECT * FROM `test_servin_consignaciones` WHERE 1 and `devolucion` = 1 ";
	$db -> setQuery($query);
	$result=$db -> loadColumn();*/
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
	    var sald = js('#jform_adeudo').val(round(sal,2));
	    var saux = js('#jform_adeudoaux').val(round(sal,2));	
	    if(round(sal,2) == 0){
	    	js("input[name='jform[estatus]' ]").val(3);
	    	js("#jform_estatus2").prop("checked", true);
	    	js("#jform_devolucion").hide();
	    	js("#jform_estatus1").hide();
	    }else{
	    	js("input[name='jform[estatus]' ]").val(1);
	    	js("#jform_estatus0").prop("checked", true);
	    	js("#jform_devolucion").show();
	    	js("#jform_estatus1").show();
	    }
	}
	js = jQuery.noConflict();
	js(document).ready(function () {
	var obj = '<?php echo json_encode($result); ?>';
	var objeto = JSON.parse(obj);
	js.each( objeto, function( key, value ) {
		js("#jform_piezas option[value='"+value+"']").remove();
	});	
	if(js("#jform_adeudo").val() == '0'){
		js("#jform_devolucion").hide();
		js("#jform_estatus1").hide();
	}
	if(js("#jform_cliente").val() == ''){
		js("#jform_devoluciones_chzn").hide();
	}else{
		js.ajax({ 
            url: "index.php?option=com_servin&task=devoclientes&view=ajaxs&tmpl=ajax&id=" + js("#jform_cliente").val(),  
            async: true, 
            success: function(result){
            	js("#jform_devoluciones").empty();
            	js("#jform_devoluciones").html(result);
            	js("#jform_devoluciones").trigger("liszt:updated");
				js("#jform_devoluciones_chzn").show();
            },
            error: function(result) {
                console.log(result);
            }
    	});
    	
	}
	js('input:hidden.cliente').each(function(){
		var name = js(this).attr('name');
		if(name.indexOf('clientehidden')){
			js('#jform_cliente option[value="'+js(this).val()+'"]').attr('selected',true);
		}
	});
	js("#jform_cliente").trigger("liszt:updated");
	js('input:hidden.piezas').each(function(){
		var name = js(this).attr('name');
		if(name.indexOf('piezashidden')){
			js('#jform_piezas option[value="'+js(this).val()+'"]').attr('selected',true);
		}
	});
	js("#jform_piezas").trigger("liszt:updated");
	js('input:hidden.devoluciones').each(function(){
		var name = js(this).attr('name');
		if(name.indexOf('devolucioneshidden')){
			js('#jform_devoluciones option[value="'+js(this).val()+'"]').attr('selected',true);
		}
	});
	js('#jform_cliente').on('change',function(e){
		if(js(this).val() == ''){			
			js("#jform_devoluciones_chzn").hide();
		}else{
			js.ajax({ 
	            url: "index.php?option=com_servin&task=devoclientes&view=ajaxs&tmpl=ajax&id=" + js(this).val(),  
	            async: true, 
	            success: function(result){
	            	js("#jform_devoluciones").empty();
	            	js("#jform_devoluciones").html(result);
	            	js("#jform_devoluciones").trigger("liszt:updated");
					js("#jform_devoluciones_chzn").show();
	            },
	            error: function(result) {
	                console.log(result);
	            }
	    	});

		}
			
    });
	js("#jform_devoluciones").trigger("liszt:updated");
	js('#jform_devoluciones').on('change',function(e){
		var abono = parseInt(js('#jform_devoluciones option:selected').attr('abono'));
		var devo = parseInt(js(this).attr('abono'));
		var abono = abono ? abono : 0;
		var devo = devo ? devo : 0;
		if(devo == 0){
		var nuevoabono = abono - devo;	
		}else{
		var nuevoabono = abono + devo;
		}
		js('#jform_abono').val(nuevoabono);
		calcular();
    });
	js('#jform_piezas').on('change',function(e){
		 js.ajax({ 
            url: "index.php?option=com_servin&task=consultotal&view=ajaxs&tmpl=ajax&string=" + js(this).val(),  
            async: true, 
            success: function(result){
            	js('#jform_total').val(result); 
            	calcular();
            },
            error: function(result) {
                console.log(result);
            }
    	});
    });
    js('#jform_adeudoaux').val(js('#jform_adeudo').val());
	js('#jform_total').attr('min',js('#jform_abono').val());
	js('#jform_abono').attr('max',js('#jform_total').val());
	js('#jform_total').on('change',function(e){
		calcular();
    });
    js('#jform_abono').on('change',function(e){
		calcular();
    });
    js('#jform_devolucion').on('click',function(e){
		if(js(this).prop("checked")){
			js("input[name='jform[estatus]' ]").val(2);
	    	js("#jform_estatus1").prop("checked", true);
		}else{
			js("input[name='jform[estatus]' ]").val(1);
	    	js("#jform_estatus0").prop("checked", true);
		}
    });
	});

	Joomla.submitbutton = function (task) {
		if (task == 'consignacion.cancel') {
			Joomla.submitform(task, document.getElementById('consignacion-form'));
		}
		else {
			
			if (task != 'consignacion.cancel' && document.formvalidator.isValid(document.id('consignacion-form'))) {
				
				Joomla.submitform(task, document.getElementById('consignacion-form'));
			}
			else {
				alert('<?php echo $this->escape(JText::_('JGLOBAL_VALIDATION_FORM_FAILED')); ?>');
			}
		}
	}
</script>

<form
	action="<?php echo JRoute::_('index.php?option=com_servin&layout=edit&id=' . (int) $this->item->id); ?>"
	method="post" enctype="multipart/form-data" name="adminForm" id="consignacion-form" class="form-validate">

	<div class="form-horizontal">
		<?php echo JHtml::_('bootstrap.startTabSet', 'myTab', array('active' => 'general')); ?>

		<?php echo JHtml::_('bootstrap.addTab', 'myTab', 'general', JText::_('COM_SERVIN_TITLE_CONSIGNACION', true)); ?>
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
				<?php echo $this->form->renderField('modified_at'); ?>				<?php echo $this->form->renderField('cliente'); ?>

			<?php
				foreach((array)$this->item->cliente as $value): 
					if(!is_array($value)):
						echo '<input type="hidden" class="cliente" name="jform[clientehidden]['.$value.']" value="'.$value.'" />';
					endif;
				endforeach;
			?>				<?php echo $this->form->renderField('no_folio_pagare'); ?>
				<?php echo $this->form->renderField('foto_pagare'); ?>

				<?php if (!empty($this->item->foto_pagare)) : ?>
					<?php $foto_pagareFiles = array(); ?>
					<?php foreach ((array)$this->item->foto_pagare as $fileSingle) : ?>
						<?php if (!is_array($fileSingle)) : ?>
							<a href="<?php echo JRoute::_(JUri::root() . 'uploads' . DIRECTORY_SEPARATOR . $fileSingle, false);?>"><?php echo $fileSingle; ?></a> | 
							<?php $foto_pagareFiles[] = $fileSingle; ?>
						<?php endif; ?>
					<?php endforeach; ?>
					<input type="hidden" name="jform[foto_pagare_hidden]" id="jform_foto_pagare_hidden" value="<?php echo implode(',', $foto_pagareFiles); ?>" />
				<?php endif; ?>				<?php echo $this->form->renderField('piezas'); ?>

			<?php
				foreach((array)$this->item->piezas as $value): 
					if(!is_array($value)):
						echo '<input type="hidden" class="piezas" name="jform[piezashidden]['.$value.']" value="'.$value.'" />';
					endif;
				endforeach;
			?>				<?php echo $this->form->renderField('total'); ?>
				<?php echo $this->form->renderField('abono'); ?>
				<?php echo $this->form->renderField('devoluciones'); ?>

			<?php
				foreach((array)$this->item->devoluciones as $value): 
					if(!is_array($value)):
						echo '<input type="hidden" class="devoluciones" name="jform[devolucioneshidden]['.$value.']" value="'.$value.'" />';
					endif;
				endforeach;
			?>				<?php echo $this->form->renderField('adeudo'); ?>
				<?php echo $this->form->renderField('fecha_emision'); ?>
				<?php echo $this->form->renderField('fecha_limite'); ?>
				<?php echo $this->form->renderField('devolucion'); ?>
				<?php echo $this->form->renderField('fecha_devolucion'); ?>
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

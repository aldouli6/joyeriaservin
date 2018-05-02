<?php
/**
 * @version		$Id: default.php 14276 2010-01-18 14:20:28Z laurelle $
 * @package		Joomla.Administrator
 * @subpackage	mod_kc_admin_quickicons
 * @copyright	Copyright (C) 2005 - 2011 Open Source Matters, Inc. All rights reserved.
 * @copyright	Copyright (C) 2010 - 2014 Keashly.ca Consulting
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// No direct access.
defined('_JEXEC') or die;

$buttons = KC_Admin_QuickIconHelper::getButtons( $params );
?> 
 
<div class="sidebar-nav quick-icons">
	<div class="j-links-groups">
		<ul class="j-links-group nav nav-list">
			<?php foreach ($buttons as $key => $value) { ?>
				<li>
				<a href="<?=JURI::base(true)."/" . $value['link'] ?>">
					<?php if (!empty($value['c_icon'])) { ?> 
					        <img src="/<?= $value['c_icon']?>" alt="">					           					
					<?php   ?>
					<?php }elseif (!empty($value['image'])) { ?> 
					        <img src="/<?= $value['path'].$value['image'] ?>" alt="">					          					
					<?php  } ?>

					<?php if (!empty($value['icomoonicon'])) { ?>
						<span class="<?= $value['icomoonicon'] ?>" aria-hidden="true"></span> 	
					<?php  } ?>
					<span class="j-links-link"><?= $value['text'] ?></span>
					</a>	
				</li>
			<?php } ?>
			
		</ul> 			
	</div>
</div>


INSERT INTO `#__content_types` (`type_title`, `type_alias`, `table`, `content_history_options`)
SELECT * FROM ( SELECT 'Material','com_servin.material','{"special":{"dbtable":"#__servin_materiales","key":"id","type":"Material","prefix":"ServinTable"}}', '{"formFile":"administrator\/components\/com_servin\/models\/forms\/material.xml", "hideFields":["checked_out","checked_out_time","params","language"], "ignoreChanges":["modified_by", "modified", "checked_out", "checked_out_time"], "convertToInt":["publish_up", "publish_down"], "displayLookup":[{"sourceColumn":"catid","targetTable":"#__categories","targetColumn":"id","displayColumn":"title"},{"sourceColumn":"group_id","targetTable":"#__usergroups","targetColumn":"id","displayColumn":"title"},{"sourceColumn":"created_by","targetTable":"#__users","targetColumn":"id","displayColumn":"name"},{"sourceColumn":"access","targetTable":"#__viewlevels","targetColumn":"id","displayColumn":"title"},{"sourceColumn":"modified_by","targetTable":"#__users","targetColumn":"id","displayColumn":"name"}]}') AS tmp
WHERE NOT EXISTS (
	SELECT type_alias FROM `#__content_types` WHERE (`type_alias` = 'com_servin.material')
) LIMIT 1;

UPDATE `#__content_types` SET
	`type_title` = 'Material', 
	`table` = '{"special":{"dbtable":"#__servin_materiales","key":"id","type":"Material","prefix":"ServinTable"}}', 
	`content_history_options` = '{"formFile":"administrator\/components\/com_servin\/models\/forms\/material.xml", "hideFields":["checked_out","checked_out_time","params","language"], "ignoreChanges":["modified_by", "modified", "checked_out", "checked_out_time"], "convertToInt":["publish_up", "publish_down"], "displayLookup":[{"sourceColumn":"catid","targetTable":"#__categories","targetColumn":"id","displayColumn":"title"},{"sourceColumn":"group_id","targetTable":"#__usergroups","targetColumn":"id","displayColumn":"title"},{"sourceColumn":"created_by","targetTable":"#__users","targetColumn":"id","displayColumn":"name"},{"sourceColumn":"access","targetTable":"#__viewlevels","targetColumn":"id","displayColumn":"title"},{"sourceColumn":"modified_by","targetTable":"#__users","targetColumn":"id","displayColumn":"name"}]}'
WHERE (`type_alias` = 'com_servin.material');

INSERT INTO `#__content_types` (`type_title`, `type_alias`, `table`, `content_history_options`)
SELECT * FROM ( SELECT 'Kilataje','com_servin.kilataje','{"special":{"dbtable":"#__servin_kilatajes","key":"id","type":"Kilataje","prefix":"ServinTable"}}', '{"formFile":"administrator\/components\/com_servin\/models\/forms\/kilataje.xml", "hideFields":["checked_out","checked_out_time","params","language"], "ignoreChanges":["modified_by", "modified", "checked_out", "checked_out_time"], "convertToInt":["publish_up", "publish_down"], "displayLookup":[{"sourceColumn":"catid","targetTable":"#__categories","targetColumn":"id","displayColumn":"title"},{"sourceColumn":"group_id","targetTable":"#__usergroups","targetColumn":"id","displayColumn":"title"},{"sourceColumn":"created_by","targetTable":"#__users","targetColumn":"id","displayColumn":"name"},{"sourceColumn":"access","targetTable":"#__viewlevels","targetColumn":"id","displayColumn":"title"},{"sourceColumn":"modified_by","targetTable":"#__users","targetColumn":"id","displayColumn":"name"}]}') AS tmp
WHERE NOT EXISTS (
	SELECT type_alias FROM `#__content_types` WHERE (`type_alias` = 'com_servin.kilataje')
) LIMIT 1;

UPDATE `#__content_types` SET
	`type_title` = 'Kilataje', 
	`table` = '{"special":{"dbtable":"#__servin_kilatajes","key":"id","type":"Kilataje","prefix":"ServinTable"}}', 
	`content_history_options` = '{"formFile":"administrator\/components\/com_servin\/models\/forms\/kilataje.xml", "hideFields":["checked_out","checked_out_time","params","language"], "ignoreChanges":["modified_by", "modified", "checked_out", "checked_out_time"], "convertToInt":["publish_up", "publish_down"], "displayLookup":[{"sourceColumn":"catid","targetTable":"#__categories","targetColumn":"id","displayColumn":"title"},{"sourceColumn":"group_id","targetTable":"#__usergroups","targetColumn":"id","displayColumn":"title"},{"sourceColumn":"created_by","targetTable":"#__users","targetColumn":"id","displayColumn":"name"},{"sourceColumn":"access","targetTable":"#__viewlevels","targetColumn":"id","displayColumn":"title"},{"sourceColumn":"modified_by","targetTable":"#__users","targetColumn":"id","displayColumn":"name"}]}'
WHERE (`type_alias` = 'com_servin.kilataje');

INSERT INTO `#__content_types` (`type_title`, `type_alias`, `table`, `content_history_options`)
SELECT * FROM ( SELECT 'Ubicacione','com_servin.ubicacione','{"special":{"dbtable":"#__servin_ubicaciones","key":"id","type":"Ubicacione","prefix":"ServinTable"}}', '{"formFile":"administrator\/components\/com_servin\/models\/forms\/ubicacione.xml", "hideFields":["checked_out","checked_out_time","params","language"], "ignoreChanges":["modified_by", "modified", "checked_out", "checked_out_time"], "convertToInt":["publish_up", "publish_down"], "displayLookup":[{"sourceColumn":"catid","targetTable":"#__categories","targetColumn":"id","displayColumn":"title"},{"sourceColumn":"group_id","targetTable":"#__usergroups","targetColumn":"id","displayColumn":"title"},{"sourceColumn":"created_by","targetTable":"#__users","targetColumn":"id","displayColumn":"name"},{"sourceColumn":"access","targetTable":"#__viewlevels","targetColumn":"id","displayColumn":"title"},{"sourceColumn":"modified_by","targetTable":"#__users","targetColumn":"id","displayColumn":"name"}]}') AS tmp
WHERE NOT EXISTS (
	SELECT type_alias FROM `#__content_types` WHERE (`type_alias` = 'com_servin.ubicacione')
) LIMIT 1;

UPDATE `#__content_types` SET
	`type_title` = 'Ubicacione', 
	`table` = '{"special":{"dbtable":"#__servin_ubicaciones","key":"id","type":"Ubicacione","prefix":"ServinTable"}}', 
	`content_history_options` = '{"formFile":"administrator\/components\/com_servin\/models\/forms\/ubicacione.xml", "hideFields":["checked_out","checked_out_time","params","language"], "ignoreChanges":["modified_by", "modified", "checked_out", "checked_out_time"], "convertToInt":["publish_up", "publish_down"], "displayLookup":[{"sourceColumn":"catid","targetTable":"#__categories","targetColumn":"id","displayColumn":"title"},{"sourceColumn":"group_id","targetTable":"#__usergroups","targetColumn":"id","displayColumn":"title"},{"sourceColumn":"created_by","targetTable":"#__users","targetColumn":"id","displayColumn":"name"},{"sourceColumn":"access","targetTable":"#__viewlevels","targetColumn":"id","displayColumn":"title"},{"sourceColumn":"modified_by","targetTable":"#__users","targetColumn":"id","displayColumn":"name"}]}'
WHERE (`type_alias` = 'com_servin.ubicacione');

INSERT INTO `#__content_types` (`type_title`, `type_alias`, `table`, `content_history_options`)
SELECT * FROM ( SELECT 'Hechura','com_servin.hechura','{"special":{"dbtable":"#__servin_hechuras","key":"id","type":"Hechura","prefix":"ServinTable"}}', '{"formFile":"administrator\/components\/com_servin\/models\/forms\/hechura.xml", "hideFields":["checked_out","checked_out_time","params","language"], "ignoreChanges":["modified_by", "modified", "checked_out", "checked_out_time"], "convertToInt":["publish_up", "publish_down"], "displayLookup":[{"sourceColumn":"catid","targetTable":"#__categories","targetColumn":"id","displayColumn":"title"},{"sourceColumn":"group_id","targetTable":"#__usergroups","targetColumn":"id","displayColumn":"title"},{"sourceColumn":"created_by","targetTable":"#__users","targetColumn":"id","displayColumn":"name"},{"sourceColumn":"access","targetTable":"#__viewlevels","targetColumn":"id","displayColumn":"title"},{"sourceColumn":"modified_by","targetTable":"#__users","targetColumn":"id","displayColumn":"name"}]}') AS tmp
WHERE NOT EXISTS (
	SELECT type_alias FROM `#__content_types` WHERE (`type_alias` = 'com_servin.hechura')
) LIMIT 1;

UPDATE `#__content_types` SET
	`type_title` = 'Hechura', 
	`table` = '{"special":{"dbtable":"#__servin_hechuras","key":"id","type":"Hechura","prefix":"ServinTable"}}', 
	`content_history_options` = '{"formFile":"administrator\/components\/com_servin\/models\/forms\/hechura.xml", "hideFields":["checked_out","checked_out_time","params","language"], "ignoreChanges":["modified_by", "modified", "checked_out", "checked_out_time"], "convertToInt":["publish_up", "publish_down"], "displayLookup":[{"sourceColumn":"catid","targetTable":"#__categories","targetColumn":"id","displayColumn":"title"},{"sourceColumn":"group_id","targetTable":"#__usergroups","targetColumn":"id","displayColumn":"title"},{"sourceColumn":"created_by","targetTable":"#__users","targetColumn":"id","displayColumn":"name"},{"sourceColumn":"access","targetTable":"#__viewlevels","targetColumn":"id","displayColumn":"title"},{"sourceColumn":"modified_by","targetTable":"#__users","targetColumn":"id","displayColumn":"name"}]}'
WHERE (`type_alias` = 'com_servin.hechura');

INSERT INTO `#__content_types` (`type_title`, `type_alias`, `table`, `content_history_options`)
SELECT * FROM ( SELECT 'Pieza','com_servin.pieza','{"special":{"dbtable":"#__servin_piezas","key":"id","type":"Pieza","prefix":"ServinTable"}}', '{"formFile":"administrator\/components\/com_servin\/models\/forms\/pieza.xml", "hideFields":["checked_out","checked_out_time","params","language"], "ignoreChanges":["modified_by", "modified", "checked_out", "checked_out_time"], "convertToInt":["publish_up", "publish_down"], "displayLookup":[{"sourceColumn":"catid","targetTable":"#__categories","targetColumn":"id","displayColumn":"title"},{"sourceColumn":"group_id","targetTable":"#__usergroups","targetColumn":"id","displayColumn":"title"},{"sourceColumn":"created_by","targetTable":"#__users","targetColumn":"id","displayColumn":"name"},{"sourceColumn":"access","targetTable":"#__viewlevels","targetColumn":"id","displayColumn":"title"},{"sourceColumn":"modified_by","targetTable":"#__users","targetColumn":"id","displayColumn":"name"},{"sourceColumn":"material","targetTable":"#__servin_materiales","targetColumn":"id","displayColumn":"nombre"},{"sourceColumn":"kilataje","targetTable":"#__servin_kilatajes","targetColumn":"id","displayColumn":"kilataje"},{"sourceColumn":"ubicacion","targetTable":"#__servin_ubicaciones","targetColumn":"id","displayColumn":"nombre"},{"sourceColumn":"hechura","targetTable":"#__servin_hechuras","targetColumn":"id","displayColumn":"numero"}]}') AS tmp
WHERE NOT EXISTS (
	SELECT type_alias FROM `#__content_types` WHERE (`type_alias` = 'com_servin.pieza')
) LIMIT 1;

UPDATE `#__content_types` SET
	`type_title` = 'Pieza', 
	`table` = '{"special":{"dbtable":"#__servin_piezas","key":"id","type":"Pieza","prefix":"ServinTable"}}', 
	`content_history_options` = '{"formFile":"administrator\/components\/com_servin\/models\/forms\/pieza.xml", "hideFields":["checked_out","checked_out_time","params","language"], "ignoreChanges":["modified_by", "modified", "checked_out", "checked_out_time"], "convertToInt":["publish_up", "publish_down"], "displayLookup":[{"sourceColumn":"catid","targetTable":"#__categories","targetColumn":"id","displayColumn":"title"},{"sourceColumn":"group_id","targetTable":"#__usergroups","targetColumn":"id","displayColumn":"title"},{"sourceColumn":"created_by","targetTable":"#__users","targetColumn":"id","displayColumn":"name"},{"sourceColumn":"access","targetTable":"#__viewlevels","targetColumn":"id","displayColumn":"title"},{"sourceColumn":"modified_by","targetTable":"#__users","targetColumn":"id","displayColumn":"name"},{"sourceColumn":"material","targetTable":"#__servin_materiales","targetColumn":"id","displayColumn":"nombre"},{"sourceColumn":"kilataje","targetTable":"#__servin_kilatajes","targetColumn":"id","displayColumn":"kilataje"},{"sourceColumn":"ubicacion","targetTable":"#__servin_ubicaciones","targetColumn":"id","displayColumn":"nombre"},{"sourceColumn":"hechura","targetTable":"#__servin_hechuras","targetColumn":"id","displayColumn":"numero"}]}'
WHERE (`type_alias` = 'com_servin.pieza');

INSERT INTO `#__content_types` (`type_title`, `type_alias`, `table`, `content_history_options`)
SELECT * FROM ( SELECT 'Deuda','com_servin.deuda','{"special":{"dbtable":"#__servin_deudas","key":"id","type":"Deuda","prefix":"ServinTable"}}', '{"formFile":"administrator\/components\/com_servin\/models\/forms\/deuda.xml", "hideFields":["checked_out","checked_out_time","params","language"], "ignoreChanges":["modified_by", "modified", "checked_out", "checked_out_time"], "convertToInt":["publish_up", "publish_down"], "displayLookup":[{"sourceColumn":"catid","targetTable":"#__categories","targetColumn":"id","displayColumn":"title"},{"sourceColumn":"group_id","targetTable":"#__usergroups","targetColumn":"id","displayColumn":"title"},{"sourceColumn":"created_by","targetTable":"#__users","targetColumn":"id","displayColumn":"name"},{"sourceColumn":"access","targetTable":"#__viewlevels","targetColumn":"id","displayColumn":"title"},{"sourceColumn":"modified_by","targetTable":"#__users","targetColumn":"id","displayColumn":"name"},{"sourceColumn":"proveedor","targetTable":"#__servin_proveedores","targetColumn":"id","displayColumn":"empresa"}]}') AS tmp
WHERE NOT EXISTS (
	SELECT type_alias FROM `#__content_types` WHERE (`type_alias` = 'com_servin.deuda')
) LIMIT 1;

UPDATE `#__content_types` SET
	`type_title` = 'Deuda', 
	`table` = '{"special":{"dbtable":"#__servin_deudas","key":"id","type":"Deuda","prefix":"ServinTable"}}', 
	`content_history_options` = '{"formFile":"administrator\/components\/com_servin\/models\/forms\/deuda.xml", "hideFields":["checked_out","checked_out_time","params","language"], "ignoreChanges":["modified_by", "modified", "checked_out", "checked_out_time"], "convertToInt":["publish_up", "publish_down"], "displayLookup":[{"sourceColumn":"catid","targetTable":"#__categories","targetColumn":"id","displayColumn":"title"},{"sourceColumn":"group_id","targetTable":"#__usergroups","targetColumn":"id","displayColumn":"title"},{"sourceColumn":"created_by","targetTable":"#__users","targetColumn":"id","displayColumn":"name"},{"sourceColumn":"access","targetTable":"#__viewlevels","targetColumn":"id","displayColumn":"title"},{"sourceColumn":"modified_by","targetTable":"#__users","targetColumn":"id","displayColumn":"name"},{"sourceColumn":"proveedor","targetTable":"#__servin_proveedores","targetColumn":"id","displayColumn":"empresa"}]}'
WHERE (`type_alias` = 'com_servin.deuda');

INSERT INTO `#__content_types` (`type_title`, `type_alias`, `table`, `content_history_options`)
SELECT * FROM ( SELECT 'Proveedor','com_servin.proveedor','{"special":{"dbtable":"#__servin_proveedores","key":"id","type":"Proveedor","prefix":"ServinTable"}}', '{"formFile":"administrator\/components\/com_servin\/models\/forms\/proveedor.xml", "hideFields":["checked_out","checked_out_time","params","language"], "ignoreChanges":["modified_by", "modified", "checked_out", "checked_out_time"], "convertToInt":["publish_up", "publish_down"], "displayLookup":[{"sourceColumn":"catid","targetTable":"#__categories","targetColumn":"id","displayColumn":"title"},{"sourceColumn":"group_id","targetTable":"#__usergroups","targetColumn":"id","displayColumn":"title"},{"sourceColumn":"created_by","targetTable":"#__users","targetColumn":"id","displayColumn":"name"},{"sourceColumn":"access","targetTable":"#__viewlevels","targetColumn":"id","displayColumn":"title"},{"sourceColumn":"modified_by","targetTable":"#__users","targetColumn":"id","displayColumn":"name"}]}') AS tmp
WHERE NOT EXISTS (
	SELECT type_alias FROM `#__content_types` WHERE (`type_alias` = 'com_servin.proveedor')
) LIMIT 1;

UPDATE `#__content_types` SET
	`type_title` = 'Proveedor', 
	`table` = '{"special":{"dbtable":"#__servin_proveedores","key":"id","type":"Proveedor","prefix":"ServinTable"}}', 
	`content_history_options` = '{"formFile":"administrator\/components\/com_servin\/models\/forms\/proveedor.xml", "hideFields":["checked_out","checked_out_time","params","language"], "ignoreChanges":["modified_by", "modified", "checked_out", "checked_out_time"], "convertToInt":["publish_up", "publish_down"], "displayLookup":[{"sourceColumn":"catid","targetTable":"#__categories","targetColumn":"id","displayColumn":"title"},{"sourceColumn":"group_id","targetTable":"#__usergroups","targetColumn":"id","displayColumn":"title"},{"sourceColumn":"created_by","targetTable":"#__users","targetColumn":"id","displayColumn":"name"},{"sourceColumn":"access","targetTable":"#__viewlevels","targetColumn":"id","displayColumn":"title"},{"sourceColumn":"modified_by","targetTable":"#__users","targetColumn":"id","displayColumn":"name"}]}'
WHERE (`type_alias` = 'com_servin.proveedor');

INSERT INTO `#__content_types` (`type_title`, `type_alias`, `table`, `content_history_options`)
SELECT * FROM ( SELECT 'Compra','com_servin.compra','{"special":{"dbtable":"#__servin_compras","key":"id","type":"Compra","prefix":"ServinTable"}}', '{"formFile":"administrator\/components\/com_servin\/models\/forms\/compra.xml", "hideFields":["checked_out","checked_out_time","params","language"], "ignoreChanges":["modified_by", "modified", "checked_out", "checked_out_time"], "convertToInt":["publish_up", "publish_down"], "displayLookup":[{"sourceColumn":"catid","targetTable":"#__categories","targetColumn":"id","displayColumn":"title"},{"sourceColumn":"group_id","targetTable":"#__usergroups","targetColumn":"id","displayColumn":"title"},{"sourceColumn":"created_by","targetTable":"#__users","targetColumn":"id","displayColumn":"name"},{"sourceColumn":"access","targetTable":"#__viewlevels","targetColumn":"id","displayColumn":"title"},{"sourceColumn":"modified_by","targetTable":"#__users","targetColumn":"id","displayColumn":"name"},{"sourceColumn":"proveedor","targetTable":"#__servin_proveedores","targetColumn":"id","displayColumn":"empresa"}]}') AS tmp
WHERE NOT EXISTS (
	SELECT type_alias FROM `#__content_types` WHERE (`type_alias` = 'com_servin.compra')
) LIMIT 1;

UPDATE `#__content_types` SET
	`type_title` = 'Compra', 
	`table` = '{"special":{"dbtable":"#__servin_compras","key":"id","type":"Compra","prefix":"ServinTable"}}', 
	`content_history_options` = '{"formFile":"administrator\/components\/com_servin\/models\/forms\/compra.xml", "hideFields":["checked_out","checked_out_time","params","language"], "ignoreChanges":["modified_by", "modified", "checked_out", "checked_out_time"], "convertToInt":["publish_up", "publish_down"], "displayLookup":[{"sourceColumn":"catid","targetTable":"#__categories","targetColumn":"id","displayColumn":"title"},{"sourceColumn":"group_id","targetTable":"#__usergroups","targetColumn":"id","displayColumn":"title"},{"sourceColumn":"created_by","targetTable":"#__users","targetColumn":"id","displayColumn":"name"},{"sourceColumn":"access","targetTable":"#__viewlevels","targetColumn":"id","displayColumn":"title"},{"sourceColumn":"modified_by","targetTable":"#__users","targetColumn":"id","displayColumn":"name"},{"sourceColumn":"proveedor","targetTable":"#__servin_proveedores","targetColumn":"id","displayColumn":"empresa"}]}'
WHERE (`type_alias` = 'com_servin.compra');

INSERT INTO `#__content_types` (`type_title`, `type_alias`, `table`, `content_history_options`)
SELECT * FROM ( SELECT 'Cliente','com_servin.cliente','{"special":{"dbtable":"#__servin_clientes","key":"id","type":"Cliente","prefix":"ServinTable"}}', '{"formFile":"administrator\/components\/com_servin\/models\/forms\/cliente.xml", "hideFields":["checked_out","checked_out_time","params","language" ,"fotocomprobante"], "ignoreChanges":["modified_by", "modified", "checked_out", "checked_out_time"], "convertToInt":["publish_up", "publish_down"], "displayLookup":[{"sourceColumn":"catid","targetTable":"#__categories","targetColumn":"id","displayColumn":"title"},{"sourceColumn":"group_id","targetTable":"#__usergroups","targetColumn":"id","displayColumn":"title"},{"sourceColumn":"created_by","targetTable":"#__users","targetColumn":"id","displayColumn":"name"},{"sourceColumn":"access","targetTable":"#__viewlevels","targetColumn":"id","displayColumn":"title"},{"sourceColumn":"modified_by","targetTable":"#__users","targetColumn":"id","displayColumn":"name"}]}') AS tmp
WHERE NOT EXISTS (
	SELECT type_alias FROM `#__content_types` WHERE (`type_alias` = 'com_servin.cliente')
) LIMIT 1;

UPDATE `#__content_types` SET
	`type_title` = 'Cliente', 
	`table` = '{"special":{"dbtable":"#__servin_clientes","key":"id","type":"Cliente","prefix":"ServinTable"}}', 
	`content_history_options` = '{"formFile":"administrator\/components\/com_servin\/models\/forms\/cliente.xml", "hideFields":["checked_out","checked_out_time","params","language" ,"fotocomprobante"], "ignoreChanges":["modified_by", "modified", "checked_out", "checked_out_time"], "convertToInt":["publish_up", "publish_down"], "displayLookup":[{"sourceColumn":"catid","targetTable":"#__categories","targetColumn":"id","displayColumn":"title"},{"sourceColumn":"group_id","targetTable":"#__usergroups","targetColumn":"id","displayColumn":"title"},{"sourceColumn":"created_by","targetTable":"#__users","targetColumn":"id","displayColumn":"name"},{"sourceColumn":"access","targetTable":"#__viewlevels","targetColumn":"id","displayColumn":"title"},{"sourceColumn":"modified_by","targetTable":"#__users","targetColumn":"id","displayColumn":"name"}]}'
WHERE (`type_alias` = 'com_servin.cliente');

INSERT INTO `#__content_types` (`type_title`, `type_alias`, `table`, `content_history_options`)
SELECT * FROM ( SELECT 'Venta','com_servin.venta','{"special":{"dbtable":"#__servin_ventas","key":"id","type":"Venta","prefix":"ServinTable"}}', '{"formFile":"administrator\/components\/com_servin\/models\/forms\/venta.xml", "hideFields":["checked_out","checked_out_time","params","language"], "ignoreChanges":["modified_by", "modified", "checked_out", "checked_out_time"], "convertToInt":["publish_up", "publish_down"], "displayLookup":[{"sourceColumn":"catid","targetTable":"#__categories","targetColumn":"id","displayColumn":"title"},{"sourceColumn":"group_id","targetTable":"#__usergroups","targetColumn":"id","displayColumn":"title"},{"sourceColumn":"created_by","targetTable":"#__users","targetColumn":"id","displayColumn":"name"},{"sourceColumn":"access","targetTable":"#__viewlevels","targetColumn":"id","displayColumn":"title"},{"sourceColumn":"modified_by","targetTable":"#__users","targetColumn":"id","displayColumn":"name"}]}') AS tmp
WHERE NOT EXISTS (
	SELECT type_alias FROM `#__content_types` WHERE (`type_alias` = 'com_servin.venta')
) LIMIT 1;

UPDATE `#__content_types` SET
	`type_title` = 'Venta', 
	`table` = '{"special":{"dbtable":"#__servin_ventas","key":"id","type":"Venta","prefix":"ServinTable"}}', 
	`content_history_options` = '{"formFile":"administrator\/components\/com_servin\/models\/forms\/venta.xml", "hideFields":["checked_out","checked_out_time","params","language"], "ignoreChanges":["modified_by", "modified", "checked_out", "checked_out_time"], "convertToInt":["publish_up", "publish_down"], "displayLookup":[{"sourceColumn":"catid","targetTable":"#__categories","targetColumn":"id","displayColumn":"title"},{"sourceColumn":"group_id","targetTable":"#__usergroups","targetColumn":"id","displayColumn":"title"},{"sourceColumn":"created_by","targetTable":"#__users","targetColumn":"id","displayColumn":"name"},{"sourceColumn":"access","targetTable":"#__viewlevels","targetColumn":"id","displayColumn":"title"},{"sourceColumn":"modified_by","targetTable":"#__users","targetColumn":"id","displayColumn":"name"}]}'
WHERE (`type_alias` = 'com_servin.venta');

INSERT INTO `#__content_types` (`type_title`, `type_alias`, `table`, `content_history_options`)
SELECT * FROM ( SELECT 'Consignacion','com_servin.consignacion','{"special":{"dbtable":"#__servin_consignaciones","key":"id","type":"Consignacion","prefix":"ServinTable"}}', '{"formFile":"administrator\/components\/com_servin\/models\/forms\/consignacion.xml", "hideFields":["checked_out","checked_out_time","params","language" ,"foto_pagare"], "ignoreChanges":["modified_by", "modified", "checked_out", "checked_out_time"], "convertToInt":["publish_up", "publish_down"], "displayLookup":[{"sourceColumn":"catid","targetTable":"#__categories","targetColumn":"id","displayColumn":"title"},{"sourceColumn":"group_id","targetTable":"#__usergroups","targetColumn":"id","displayColumn":"title"},{"sourceColumn":"created_by","targetTable":"#__users","targetColumn":"id","displayColumn":"name"},{"sourceColumn":"access","targetTable":"#__viewlevels","targetColumn":"id","displayColumn":"title"},{"sourceColumn":"modified_by","targetTable":"#__users","targetColumn":"id","displayColumn":"name"},{"sourceColumn":"devoluciones","targetTable":"#__servin_consignaciones","targetColumn":"id","displayColumn":"no_folio_pagare"}]}') AS tmp
WHERE NOT EXISTS (
	SELECT type_alias FROM `#__content_types` WHERE (`type_alias` = 'com_servin.consignacion')
) LIMIT 1;

UPDATE `#__content_types` SET
	`type_title` = 'Consignacion', 
	`table` = '{"special":{"dbtable":"#__servin_consignaciones","key":"id","type":"Consignacion","prefix":"ServinTable"}}', 
	`content_history_options` = '{"formFile":"administrator\/components\/com_servin\/models\/forms\/consignacion.xml", "hideFields":["checked_out","checked_out_time","params","language" ,"foto_pagare"], "ignoreChanges":["modified_by", "modified", "checked_out", "checked_out_time"], "convertToInt":["publish_up", "publish_down"], "displayLookup":[{"sourceColumn":"catid","targetTable":"#__categories","targetColumn":"id","displayColumn":"title"},{"sourceColumn":"group_id","targetTable":"#__usergroups","targetColumn":"id","displayColumn":"title"},{"sourceColumn":"created_by","targetTable":"#__users","targetColumn":"id","displayColumn":"name"},{"sourceColumn":"access","targetTable":"#__viewlevels","targetColumn":"id","displayColumn":"title"},{"sourceColumn":"modified_by","targetTable":"#__users","targetColumn":"id","displayColumn":"name"},{"sourceColumn":"devoluciones","targetTable":"#__servin_consignaciones","targetColumn":"id","displayColumn":"no_folio_pagare"}]}'
WHERE (`type_alias` = 'com_servin.consignacion');

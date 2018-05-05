CREATE TABLE IF NOT EXISTS `#__servin_materiales` (
`id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,

`ordering` INT(11)  NOT NULL ,
`state` TINYINT(1)  NOT NULL ,
`checked_out` INT(11)  NOT NULL ,
`checked_out_time` DATETIME NOT NULL ,
`created_by` INT(11)  NOT NULL ,
`modified_by` INT(11)  NOT NULL ,
`nombre` VARCHAR(255)  NOT NULL ,
PRIMARY KEY (`id`)
) DEFAULT COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `#__servin_kilatajes` (
`id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,

`ordering` INT(11)  NOT NULL ,
`state` TINYINT(1)  NOT NULL ,
`checked_out` INT(11)  NOT NULL ,
`checked_out_time` DATETIME NOT NULL ,
`created_by` INT(11)  NOT NULL ,
`modified_by` INT(11)  NOT NULL ,
`kilataje` VARCHAR(255)  NOT NULL ,
PRIMARY KEY (`id`)
) DEFAULT COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `#__servin_ubicaciones` (
`id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,

`ordering` INT(11)  NOT NULL ,
`state` TINYINT(1)  NOT NULL ,
`checked_out` INT(11)  NOT NULL ,
`checked_out_time` DATETIME NOT NULL ,
`created_by` INT(11)  NOT NULL ,
`modified_by` INT(11)  NOT NULL ,
`nombre` VARCHAR(255)  NOT NULL ,
`direccion` VARCHAR(255)  NOT NULL ,
PRIMARY KEY (`id`)
) DEFAULT COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `#__servin_hechuras` (
`id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,

`ordering` INT(11)  NOT NULL ,
`state` TINYINT(1)  NOT NULL ,
`checked_out` INT(11)  NOT NULL ,
`checked_out_time` DATETIME NOT NULL ,
`created_by` INT(11)  NOT NULL ,
`modified_by` INT(11)  NOT NULL ,
`numero` VARCHAR(255)  NOT NULL ,
`costo` DOUBLE,
`tipo_ganancia` VARCHAR(255)  NOT NULL ,
`ganancia` DOUBLE,
PRIMARY KEY (`id`)
) DEFAULT COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `#__servin_piezas` (
`id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,

`ordering` INT(11)  NOT NULL ,
`state` TINYINT(1)  NOT NULL ,
`checked_out` INT(11)  NOT NULL ,
`checked_out_time` DATETIME NOT NULL ,
`created_by` INT(11)  NOT NULL ,
`modified_by` INT(11)  NOT NULL ,
`modified_at` DATETIME NOT NULL ,
`created_at` DATETIME NOT NULL ,
`descripcion` TEXT NOT NULL ,
`material` INT NOT NULL ,
`kilataje` INT NOT NULL ,
`ubicacion` INT NOT NULL ,
`hechura` INT NOT NULL ,
`peso` DOUBLE,
`precio` DOUBLE,
`estatus` VARCHAR(255)  NOT NULL ,
PRIMARY KEY (`id`)
) DEFAULT COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `#__servin_deudas` (
`id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,

`ordering` INT(11)  NOT NULL ,
`state` TINYINT(1)  NOT NULL ,
`checked_out` INT(11)  NOT NULL ,
`checked_out_time` DATETIME NOT NULL ,
`created_by` INT(11)  NOT NULL ,
`modified_by` INT(11)  NOT NULL ,
`created_at` DATETIME NOT NULL ,
`modified_at` DATETIME NOT NULL ,
`proveedor` INT NOT NULL ,
`fecha_compra` DATETIME NOT NULL ,
`fecha_limite` DATETIME NOT NULL ,
`total` DOUBLE,
`abono` DOUBLE,
`saldo` DOUBLE,
`resumen` TEXT NOT NULL ,
`estatus` VARCHAR(255)  NOT NULL ,
PRIMARY KEY (`id`)
) DEFAULT COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `#__servin_proveedores` (
`id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,

`ordering` INT(11)  NOT NULL ,
`state` TINYINT(1)  NOT NULL ,
`checked_out` INT(11)  NOT NULL ,
`checked_out_time` DATETIME NOT NULL ,
`created_by` INT(11)  NOT NULL ,
`modified_by` INT(11)  NOT NULL ,
`empresa` VARCHAR(255)  NOT NULL ,
`nombre` VARCHAR(255)  NOT NULL ,
`direccion` VARCHAR(255)  NOT NULL ,
`telefono` VARCHAR(255)  NOT NULL ,
`correo` VARCHAR(255)  NOT NULL ,
PRIMARY KEY (`id`)
) DEFAULT COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `#__servin_compras` (
`id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,

`ordering` INT(11)  NOT NULL ,
`state` TINYINT(1)  NOT NULL ,
`checked_out` INT(11)  NOT NULL ,
`checked_out_time` DATETIME NOT NULL ,
`created_by` INT(11)  NOT NULL ,
`modified_by` INT(11)  NOT NULL ,
`created_at` DATETIME NOT NULL ,
`modified_at` DATETIME NOT NULL ,
`piezas` TEXT NOT NULL ,
`fecha` DATETIME NOT NULL ,
`proveedor` INT NOT NULL ,
`total` DOUBLE,
PRIMARY KEY (`id`)
) DEFAULT COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `#__servin_clientes` (
`id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,

`ordering` INT(11)  NOT NULL ,
`state` TINYINT(1)  NOT NULL ,
`checked_out` INT(11)  NOT NULL ,
`checked_out_time` DATETIME NOT NULL ,
`created_by` INT(11)  NOT NULL ,
`modified_by` INT(11)  NOT NULL ,
`nombre` VARCHAR(255)  NOT NULL ,
`direccion` VARCHAR(255)  NOT NULL ,
`telefono` VARCHAR(255)  NOT NULL ,
`correo` VARCHAR(255)  NOT NULL ,
`fotoine` TEXT NOT NULL ,
`fotocomprobante` TEXT NOT NULL ,
PRIMARY KEY (`id`)
) DEFAULT COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `#__servin_ventas` (
`id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,

`ordering` INT(11)  NOT NULL ,
`state` TINYINT(1)  NOT NULL ,
`checked_out` INT(11)  NOT NULL ,
`checked_out_time` DATETIME NOT NULL ,
`created_by` INT(11)  NOT NULL ,
`modified_by` INT(11)  NOT NULL ,
`created_at` DATETIME NOT NULL ,
`modified_at` DATETIME NOT NULL ,
`piezas` TEXT NOT NULL ,
`fecha` DATETIME NOT NULL ,
`cliente` TEXT NOT NULL ,
`total` DOUBLE,
`metodo_pago` VARCHAR(255)  NOT NULL ,
PRIMARY KEY (`id`)
) DEFAULT COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `#__servin_consignaciones` (
`id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,

`ordering` INT(11)  NOT NULL ,
`state` TINYINT(1)  NOT NULL ,
`checked_out` INT(11)  NOT NULL ,
`checked_out_time` DATETIME NOT NULL ,
`created_by` INT(11)  NOT NULL ,
`modified_by` INT(11)  NOT NULL ,
`created_at` DATETIME NOT NULL ,
`modified_at` DATETIME NOT NULL ,
`cliente` TEXT NOT NULL ,
`no_folio_pagare` VARCHAR(255)  NOT NULL ,
`foto_pagare` TEXT NOT NULL ,
`piezas` TEXT NOT NULL ,
`total` DOUBLE,
`abono` DOUBLE,
`devoluciones` VARCHAR(255)  NOT NULL ,
`adeudo` DOUBLE,
`fecha_emision` DATETIME NOT NULL ,
`fecha_limite` DATETIME NOT NULL ,
`devolucion` VARCHAR(255)  NOT NULL ,
`fecha_devolucion` DATETIME NOT NULL ,
`estatus` VARCHAR(255)  NOT NULL ,
PRIMARY KEY (`id`)
) DEFAULT COLLATE=utf8mb4_unicode_ci;


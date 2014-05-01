DROP TABLE IF EXISTS `category` ;

CREATE TABLE IF NOT EXISTS `category` (
  `cat_id` INT(11) NOT NULL AUTO_INCREMENT,
  `cat_name` VARCHAR(50) CHARACTER SET 'utf8' NOT NULL,
  `parent_id` INT(11) NULL DEFAULT NULL,
  PRIMARY KEY (`cat_id`),
  INDEX `fk_category_category1_idx` (`parent_id` ASC),
  CONSTRAINT `fk_category_category1`
    FOREIGN KEY (`parent_id`)
    REFERENCES `category` (`cat_id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB
AUTO_INCREMENT = 236
DEFAULT CHARACTER SET = utf8;

DROP TABLE IF EXISTS `custom_field` ;

CREATE TABLE IF NOT EXISTS `custom_field` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `cf_name` VARCHAR(50) CHARACTER SET 'utf8' NOT NULL,
  `cf_type` VARCHAR(8) CHARACTER SET 'utf8' NOT NULL,
  `cf_min` DOUBLE NULL DEFAULT NULL,
  `cf_max` DOUBLE NULL DEFAULT NULL,
  `cf_letters` TINYINT(1) NULL DEFAULT '0',
  PRIMARY KEY (`id`))
ENGINE = InnoDB
AUTO_INCREMENT = 35
DEFAULT CHARACTER SET = utf8;

DROP TABLE IF EXISTS `cf_dropdown_value` ;

CREATE TABLE IF NOT EXISTS `cf_dropdown_value` (
  `cfdv_id` INT(11) NOT NULL AUTO_INCREMENT,
  `cf_id` INT(11) NOT NULL,
  `cfdv_title` VARCHAR(50) NOT NULL,
  `cfdv_value` VARCHAR(50) NOT NULL,
  PRIMARY KEY (`cfdv_id`),
  INDEX `cf_id` (`cf_id` ASC),
  CONSTRAINT `cf_dropdown_value_ibfk_1`
    FOREIGN KEY (`cf_id`)
    REFERENCES `custom_field` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB
AUTO_INCREMENT = 18
DEFAULT CHARACTER SET = utf8;

DROP TABLE IF EXISTS `customer` ;

CREATE TABLE IF NOT EXISTS `customer` (
  `c_id` INT(11) NOT NULL AUTO_INCREMENT,
  `c_first_name` VARCHAR(45) NOT NULL,
  `c_last_name` VARCHAR(45) NOT NULL,
  `c_line_1` VARCHAR(150) NOT NULL,
  `c_line_2` VARCHAR(150) NULL DEFAULT NULL,
  `c_postcode` VARCHAR(45) NOT NULL,
  `c_line_3` VARCHAR(150) NULL DEFAULT NULL,
  `c_line_4` VARCHAR(150) NULL DEFAULT NULL,
  `c_country` VARCHAR(150) NOT NULL,
  `c_email` VARCHAR(254) NOT NULL,
  PRIMARY KEY (`c_id`))
ENGINE = InnoDB
AUTO_INCREMENT = 2
DEFAULT CHARACTER SET = utf8;

DROP TABLE IF EXISTS `order_line` ;

CREATE TABLE IF NOT EXISTS `order_line` (
  `o_id` INT(11) NOT NULL AUTO_INCREMENT,
  `o_date` DATETIME NOT NULL,
  `o_cost` DECIMAL(22,2) NOT NULL,
  `o_dispatched` TINYINT(1) NOT NULL DEFAULT '0',
  `o_dispatch_date` DATETIME NOT NULL,
  `c_id` INT(11) NOT NULL,
  `o_delivered` TINYINT(1) NOT NULL,
  `o_deliver_date` DATETIME NOT NULL,
  PRIMARY KEY (`o_id`, `c_id`),
  INDEX `fk_order_customer_idx` (`c_id` ASC),
  CONSTRAINT `fk_order_customer`
    FOREIGN KEY (`c_id`)
    REFERENCES `customer` (`c_id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB
AUTO_INCREMENT = 2
DEFAULT CHARACTER SET = utf8;

DROP TABLE IF EXISTS `product` ;

CREATE TABLE IF NOT EXISTS `product` (
  `p_id` INT(11) NOT NULL AUTO_INCREMENT,
  `p_name` VARCHAR(100) NOT NULL,
  `p_long_desc` VARCHAR(1000) NULL DEFAULT NULL,
  `p_price` DECIMAL(22,2) NOT NULL,
  `p_stock_quantity` INT(11) UNSIGNED NOT NULL,
  `p_meta` VARCHAR(8191) NOT NULL,
  PRIMARY KEY (`p_id`),
  INDEX `p_id` (`p_id` ASC))
ENGINE = InnoDB
AUTO_INCREMENT = 17
DEFAULT CHARACTER SET = utf8;

DROP TABLE IF EXISTS `order_product` ;

CREATE TABLE IF NOT EXISTS `order_product` (
  `op_id` INT(11) NOT NULL AUTO_INCREMENT,
  `p_id` INT(11) NOT NULL,
  `o_id` INT(11) NOT NULL,
  `price` DECIMAL(10,2) NOT NULL,
  `quantity` INT(11) NOT NULL,
  PRIMARY KEY (`op_id`, `p_id`, `o_id`),
  INDEX `fk_order_product_product1_idx` (`p_id` ASC),
  INDEX `fk_order_product_order1_idx` (`o_id` ASC),
  CONSTRAINT `fk_order_product_order1`
    FOREIGN KEY (`o_id`)
    REFERENCES `order_line` (`o_id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_order_product_product1`
    FOREIGN KEY (`p_id`)
    REFERENCES `product` (`p_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 6
DEFAULT CHARACTER SET = utf8;

DROP TABLE IF EXISTS `product_category` ;

CREATE TABLE IF NOT EXISTS `product_category` (
  `cp_id` INT(11) NOT NULL AUTO_INCREMENT,
  `p_id` INT(11) NOT NULL,
  `cat_id` INT(11) NOT NULL,
  PRIMARY KEY (`cp_id`, `p_id`, `cat_id`),
  UNIQUE KEY `p_id` (`p_id`),
  INDEX `fk_product_category_product1_idx` (`p_id` ASC),
  INDEX `fk_product_category_category1_idx` (`cat_id` ASC),
  CONSTRAINT `fk_product_category_category1`
    FOREIGN KEY (`cat_id`)
    REFERENCES `category` (`cat_id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_product_category_product1`
    FOREIGN KEY (`p_id`)
    REFERENCES `product` (`p_id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB
AUTO_INCREMENT = 16
DEFAULT CHARACTER SET = utf8;

DROP TABLE IF EXISTS `product_image` ;

CREATE TABLE IF NOT EXISTS `product_image` (
  `pi_id` INT(11) NOT NULL AUTO_INCREMENT,
  `p_id` INT(11) NOT NULL,
  `pi_url` VARCHAR(150) NOT NULL,
  `pi_main_pic` TINYINT(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`pi_id`),
  INDEX `p_id` (`p_id` ASC),
  CONSTRAINT `product_image_ibfk_1`
    FOREIGN KEY (`p_id`)
    REFERENCES `product` (`p_id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB
AUTO_INCREMENT = 25
DEFAULT CHARACTER SET = utf8;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

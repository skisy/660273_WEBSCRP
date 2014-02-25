SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

DROP TABLE IF EXISTS category ;

CREATE TABLE IF NOT EXISTS category (
  cat_id INT(11) NOT NULL AUTO_INCREMENT,
  cat_name VARCHAR(50) NOT NULL,
  parent_id INT(11) NULL DEFAULT NULL,
  PRIMARY KEY (cat_id),
  INDEX fk_category_category1_idx (parent_id ASC),
  CONSTRAINT fk_category_category1
    FOREIGN KEY (parent_id)
    REFERENCES category (cat_id)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf_general_ci;

DROP TABLE IF EXISTS customer ;

CREATE TABLE IF NOT EXISTS customer (
  c_id INT(11) NOT NULL AUTO_INCREMENT,
  c_first_name VARCHAR(45) NOT NULL,
  c_last_name VARCHAR(45) NOT NULL,
  c_house_no VARCHAR(45) NOT NULL,
  c_street VARCHAR(60) NULL DEFAULT NULL,
  c_postcode VARCHAR(45) NOT NULL,
  PRIMARY KEY (c_id))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf_general_ci;

DROP TABLE IF EXISTS order_line ;

CREATE TABLE IF NOT EXISTS order_line (
  o_id INT(11) NOT NULL AUTO_INCREMENT,
  o_date DATE NOT NULL,
  o_cost DECIMAL(22,2) NOT NULL,
  o_dispatched TINYINT(1) NOT NULL DEFAULT '0',
  o_dispatch_date DATE NOT NULL,
  c_id INT(11) NOT NULL,
  PRIMARY KEY (o_id, c_id),
  INDEX fk_order_customer_idx (c_id ASC),
  CONSTRAINT fk_order_customer
    FOREIGN KEY (c_id)
    REFERENCES customer (c_id)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf_general_ci;


DROP TABLE IF EXISTS product ;

CREATE TABLE IF NOT EXISTS product (
  p_id INT(11) NOT NULL AUTO_INCREMENT,
  p_name VARCHAR(100) NOT NULL,
  p_long_desc VARCHAR(500) NULL DEFAULT NULL,
  p_price DECIMAL(22,2) NOT NULL,
  p_stock_quantity INT(11) NOT NULL,
  p_photo_url VARCHAR(45) NULL DEFAULT NULL,
  PRIMARY KEY (p_id))
ENGINE = InnoDB;

DROP TABLE IF EXISTS order_product ;

CREATE TABLE IF NOT EXISTS order_product (
  op_id INT(11) NOT NULL AUTO_INCREMENT,
  p_id INT(11) NOT NULL,
  o_id INT(11) NOT NULL,
  PRIMARY KEY (op_id, p_id, o_id),
  INDEX fk_order_product_product1_idx (p_id ASC),
  INDEX fk_order_product_order1_idx (o_id ASC),
  CONSTRAINT fk_order_product_order1
    FOREIGN KEY (o_id)
    REFERENCES order_line (o_id)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT fk_order_product_product1
    FOREIGN KEY (p_id)
    REFERENCES product (p_id)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf_general_ci;

DROP TABLE IF EXISTS product_category ;

CREATE TABLE IF NOT EXISTS product_category (
  cp_id INT(11) NOT NULL AUTO_INCREMENT,
  p_id INT(11) NOT NULL,
  cat_id INT(11) NOT NULL,
  PRIMARY KEY (cp_id, p_id, cat_id),
  INDEX fk_product_category_product1_idx (p_id ASC),
  INDEX fk_product_category_category1_idx (cat_id ASC),
  CONSTRAINT fk_product_category_product1
    FOREIGN KEY (p_id)
    REFERENCES product (p_id)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT fk_product_category_category1
    FOREIGN KEY (cat_id)
    REFERENCES category (cat_id)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;

SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

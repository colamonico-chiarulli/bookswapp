-- MySQL Script generated by MySQL Workbench
-- lun 27 apr 2015 20:55:29 CEST
-- Model: Bookswapp    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema bookswapp
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Table `bsw_user_role`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `bsw_user_role` ;

CREATE TABLE IF NOT EXISTS `bsw_user_role` (
  `id` SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `role_name` VARCHAR(45) NOT NULL,
  `role_value` INT NOT NULL DEFAULT 10,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `bsw_user_status`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `bsw_user_status` ;

CREATE TABLE IF NOT EXISTS `bsw_user_status` (
  `id` SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `status_name` VARCHAR(45) NOT NULL,
  `status_value` SMALLINT NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `bsw_user_type`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `bsw_user_type` ;

CREATE TABLE IF NOT EXISTS `bsw_user_type` (
  `id` SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_type_name` VARCHAR(45) NOT NULL,
  `user_type_value` INT NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `bsw_user`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `bsw_user` ;

CREATE TABLE IF NOT EXISTS `bsw_user` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `username` VARCHAR(45) CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NOT NULL,
  `auth_key` VARCHAR(32) CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NOT NULL,
  `password_hash` VARCHAR(255) CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NOT NULL,
  `password_reset_token` VARCHAR(255) CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NULL DEFAULT NULL,
  `email` VARCHAR(60) CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NOT NULL,
  `role_id` SMALLINT UNSIGNED NOT NULL DEFAULT '10',
  `status_id` SMALLINT UNSIGNED NOT NULL DEFAULT '10',
  `user_type_id` SMALLINT UNSIGNED NOT NULL DEFAULT '10',
  `created_at` DATETIME NOT NULL,
  `updated_at` DATETIME NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_bsw_user_bsw_user_role1_idx` (`role_id` ASC),
  INDEX `fk_bsw_user_bsw_user_status1_idx` (`status_id` ASC),
  INDEX `fk_bsw_user_bsw_user_type1_idx` (`user_type_id` ASC),
  CONSTRAINT `fk_bsw_user_bsw_user_role1`
    FOREIGN KEY (`role_id`)
    REFERENCES `bsw_user_role` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_bsw_user_bsw_user_status1`
    FOREIGN KEY (`status_id`)
    REFERENCES `bsw_user_status` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_bsw_user_bsw_user_type1`
    FOREIGN KEY (`user_type_id`)
    REFERENCES `bsw_user_type` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `bsw_print_type`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `bsw_print_type` ;

CREATE TABLE IF NOT EXISTS `bsw_print_type` (
  `id` TINYINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `print_type` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `print_type_UNIQUE` (`print_type` ASC))
ENGINE = InnoDB
COMMENT = 'Type of print (ebook, pdf, book, etc)';


-- -----------------------------------------------------
-- Table `bsw_publisher`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `bsw_publisher` ;

CREATE TABLE IF NOT EXISTS `bsw_publisher` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `publisher` VARCHAR(100) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `publisher_UNIQUE` (`publisher` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `bsw_book`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `bsw_book` ;

CREATE TABLE IF NOT EXISTS `bsw_book` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `isbn` BIGINT(13) NOT NULL,
  `title` VARCHAR(255) NOT NULL,
  `subtitle` VARCHAR(255) NULL,
  `authors` VARCHAR(255) NOT NULL,
  `num_vol_serie` DECIMAL(1,0) NULL,
  `num_volume` DECIMAL(1,0) NULL,
  `published_date` YEAR NULL,
  `price` DECIMAL(8,2) NOT NULL,
  `annexes` TINYINT(1) NOT NULL,
  `page_count` SMALLINT UNSIGNED NULL,
  `thumbnail` VARCHAR(255) NULL,
  `google_book_id` VARCHAR(45) NULL,
  `publisher_id` INT UNSIGNED NOT NULL,
  `print_type_id` TINYINT UNSIGNED NOT NULL,
  `created_at` DATETIME NOT NULL,
  `updated_at` DATETIME NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_book_print_type1_idx` (`print_type_id` ASC),
  INDEX `fk_book_publisher1_idx` (`publisher_id` ASC),
  UNIQUE INDEX `isbn_UNIQUE` (`isbn` ASC),
  CONSTRAINT `fk_book_print_type1`
    FOREIGN KEY (`print_type_id`)
    REFERENCES `bsw_print_type` (`id`)
    ON DELETE RESTRICT
    ON UPDATE CASCADE,
  CONSTRAINT `fk_book_publisher1`
    FOREIGN KEY (`publisher_id`)
    REFERENCES `bsw_publisher` (`id`)
    ON DELETE RESTRICT
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `bsw_subject`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `bsw_subject` ;

CREATE TABLE IF NOT EXISTS `bsw_subject` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `subject` VARCHAR(60) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `bsw_course`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `bsw_course` ;

CREATE TABLE IF NOT EXISTS `bsw_course` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `course` VARCHAR(50) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `bsw_school`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `bsw_school` ;

CREATE TABLE IF NOT EXISTS `bsw_school` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `name_school` VARCHAR(200) NOT NULL,
  `code_school` VARCHAR(30) NULL,
  `order_school` VARCHAR(45) NULL,
  `zip_school` VARCHAR(5) NULL,
  `city_school` VARCHAR(60) NOT NULL,
  `district_school` VARCHAR(45) NULL,
  `address_school` VARCHAR(60) NOT NULL,
  `phone1_school` VARCHAR(20) NULL,
  `fax_school` VARCHAR(20) NULL,
  `phone2_school` VARCHAR(20) NULL,
  `email1_school` VARCHAR(45) NULL,
  `email2_school` VARCHAR(45) NULL,
  `url_school` VARCHAR(60) NULL,
  `created_at` DATETIME NOT NULL,
  `updated_at` DATETIME NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `code_school_UNIQUE` (`code_school` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `bsw_classroom`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `bsw_classroom` ;

CREATE TABLE IF NOT EXISTS `bsw_classroom` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `school_id` INT UNSIGNED NOT NULL,
  `class` INT(1) NOT NULL,
  `section_class` CHAR(5) NOT NULL,
  `course_id` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `ID_classe_UNIQUE` (`id` ASC),
  INDEX `fk_class_course1_idx` (`course_id` ASC),
  INDEX `fk_bsw_classroom_bsw_school1_idx` (`school_id` ASC),
  CONSTRAINT `fk_classroom_course1`
    FOREIGN KEY (`course_id`)
    REFERENCES `bsw_course` (`id`)
    ON DELETE RESTRICT
    ON UPDATE CASCADE,
  CONSTRAINT `fk_classroom_school1`
    FOREIGN KEY (`school_id`)
    REFERENCES `bsw_school` (`id`)
    ON DELETE RESTRICT
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `bsw_adoption`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `bsw_adoption` ;

CREATE TABLE IF NOT EXISTS `bsw_adoption` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `school_id` INT UNSIGNED NOT NULL,
  `year_adoption` YEAR NOT NULL,
  `classroom_id` INT UNSIGNED NOT NULL,
  `book_id` INT UNSIGNED NOT NULL,
  `possession` TINYINT(1) NOT NULL,
  `to_buy` TINYINT(1) NOT NULL,
  `advised` TINYINT(1) NOT NULL,
  `price_adoption` DECIMAL(8,2) NOT NULL,
  `subject_id` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_adoption_subject1_idx` (`subject_id` ASC),
  INDEX `fk_adoption_class1_idx` (`classroom_id` ASC),
  INDEX `fk_adoption_book1_idx` (`book_id` ASC),
  UNIQUE INDEX `adoption_school_year_class_book` (`school_id` ASC, `year_adoption` ASC, `classroom_id` ASC, `book_id` ASC)  COMMENT 'Secondary key (school+year+class+book)\n',
  CONSTRAINT `fk_adoption_school_school`
    FOREIGN KEY (`school_id`)
    REFERENCES `bsw_school` (`id`)
    ON DELETE RESTRICT
    ON UPDATE CASCADE,
  CONSTRAINT `fk_adoption_subject1`
    FOREIGN KEY (`subject_id`)
    REFERENCES `bsw_subject` (`id`)
    ON DELETE RESTRICT
    ON UPDATE CASCADE,
  CONSTRAINT `fk_adoption_classroom_class`
    FOREIGN KEY (`classroom_id`)
    REFERENCES `bsw_classroom` (`id`)
    ON DELETE RESTRICT
    ON UPDATE CASCADE,
  CONSTRAINT `fk_adoption_book1`
    FOREIGN KEY (`book_id`)
    REFERENCES `bsw_book` (`id`)
    ON DELETE RESTRICT
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `bsw_condition`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `bsw_condition` ;

CREATE TABLE IF NOT EXISTS `bsw_condition` (
  `id` TINYINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `condition` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
COMMENT = 'Conservation status of the books';


-- -----------------------------------------------------
-- Table `bsw_swap`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `bsw_swap` ;

CREATE TABLE IF NOT EXISTS `bsw_swap` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `seller_user_id` INT UNSIGNED NOT NULL,
  `buyer_user_id` INT UNSIGNED NULL,
  `price_swap` DECIMAL(8,2) NOT NULL,
  `annexes_swap` TINYINT(1) NOT NULL,
  `sold` TINYINT(1) NOT NULL,
  `note_swap` VARCHAR(255) NULL,
  `date_for_sale` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_swap` DATETIME NOT NULL,
  `book_id` INT UNSIGNED NOT NULL,
  `condition_id` TINYINT UNSIGNED NOT NULL,
  INDEX `fk_swapseller_has_user_idx` (`seller_user_id` ASC),
  INDEX `fk_user_has_book_book1_idx` (`book_id` ASC),
  PRIMARY KEY (`id`, `book_id`, `condition_id`),
  INDEX `fk_swap_has_condition1_idx` (`condition_id` ASC),
  INDEX `fk_swapbuyer_has_user1_idx` (`buyer_user_id` ASC),
  CONSTRAINT `fk_seller_user_1`
    FOREIGN KEY (`seller_user_id`)
    REFERENCES `bsw_user` (`id`)
    ON DELETE RESTRICT
    ON UPDATE CASCADE,
  CONSTRAINT `fk_transaction_has_book1`
    FOREIGN KEY (`book_id`)
    REFERENCES `bsw_book` (`id`)
    ON DELETE RESTRICT
    ON UPDATE CASCADE,
  CONSTRAINT `fk_book_has_condition1`
    FOREIGN KEY (`condition_id`)
    REFERENCES `bsw_condition` (`id`)
    ON DELETE RESTRICT
    ON UPDATE CASCADE,
  CONSTRAINT `fk_buyer_user1`
    FOREIGN KEY (`buyer_user_id`)
    REFERENCES `bsw_user` (`id`)
    ON DELETE RESTRICT
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `bsw_bookmark`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `bsw_bookmark` ;

CREATE TABLE IF NOT EXISTS `bsw_bookmark` (
  `user_id` INT UNSIGNED NOT NULL,
  `book_id` INT UNSIGNED NOT NULL,
  `reserved` TINYINT(1) NOT NULL DEFAULT 0,
  `date_bookmark` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  INDEX `fk_user_has_book_book1_idx` (`book_id` ASC),
  INDEX `fk_user_has_book_user1_idx` (`user_id` ASC),
  CONSTRAINT `fk_user_has_book_user1`
    FOREIGN KEY (`user_id`)
    REFERENCES `bsw_user` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_user_has_book_book1`
    FOREIGN KEY (`book_id`)
    REFERENCES `bsw_book` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB
COMMENT = 'Favorites and reserved books';


-- -----------------------------------------------------
-- Table `bsw_user_has_classroom`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `bsw_user_has_classroom` ;

CREATE TABLE IF NOT EXISTS `bsw_user_has_classroom` (
  `user_id` INT UNSIGNED NOT NULL,
  `classroom_id` INT UNSIGNED NOT NULL,
  `attended_year` YEAR NOT NULL,
  INDEX `fk_bsw_user_has_bsw_classroom_bsw_classroom1_idx` (`classroom_id` ASC),
  INDEX `fk_bsw_user_has_bsw_classroom_bsw_user1_idx` (`user_id` ASC),
  PRIMARY KEY (`user_id`, `classroom_id`),
  CONSTRAINT `fk_user_has_classroom_user1`
    FOREIGN KEY (`user_id`)
    REFERENCES `bsw_user` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_user_has_classroom_classroom1`
    FOREIGN KEY (`classroom_id`)
    REFERENCES `bsw_classroom` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `bsw_gender`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `bsw_gender` ;

CREATE TABLE IF NOT EXISTS `bsw_gender` (
  `id` SMALLINT UNSIGNED NOT NULL,
  `gender_name` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `bsw_user_profile`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `bsw_user_profile` ;

CREATE TABLE IF NOT EXISTS `bsw_user_profile` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` INT UNSIGNED NOT NULL,
  `first_name` VARCHAR(60) NOT NULL,
  `last_name` VARCHAR(60) NOT NULL,
  `birthdate` DATE NULL,
  `gender_id` SMALLINT UNSIGNED NOT NULL,
  `zip_user` VARCHAR(5) NULL,
  `city_user` VARCHAR(60) NOT NULL,
  `district_user` VARCHAR(45) NOT NULL,
  `address_user` VARCHAR(60) NOT NULL,
  `phone1_user` VARCHAR(20) NOT NULL,
  `phone2_user` VARCHAR(20) NULL,
  `geo_lat_user` DECIMAL(12,8) NULL COMMENT 'User geographic coordinates latitude',
  `geo_lng_user` DECIMAL(12,8) NULL COMMENT 'User geographic coordinates longitude',
  `school_verificated_user` TINYINT(1) NOT NULL DEFAULT 0,
  `created_at` DATETIME NOT NULL,
  `updated_at` DATETIME NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_bsw_user_profile_bsw_gender1_idx` (`gender_id` ASC),
  CONSTRAINT `fk_bsw_user_profile_1`
    FOREIGN KEY (`user_id`)
    REFERENCES `bsw_user` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_bsw_user_profile_bsw_gender1`
    FOREIGN KEY (`gender_id`)
    REFERENCES `bsw_gender` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `bsw_user_has_school`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `bsw_user_has_school` ;

CREATE TABLE IF NOT EXISTS `bsw_user_has_school` (
  `user_id` INT UNSIGNED NOT NULL,
  `school_id` INT UNSIGNED NOT NULL,
  `created_at` DATETIME NULL,
  `updated_at` DATETIME NULL,
  INDEX `fk_bsw_user_has_bsw_school_bsw_school1_idx` (`school_id` ASC),
  INDEX `fk_bsw_user_has_bsw_school_bsw_user1_idx` (`user_id` ASC),
  PRIMARY KEY (`user_id`, `school_id`),
  CONSTRAINT `fk_bsw_user_has_bsw_school_bsw_user1`
    FOREIGN KEY (`user_id`)
    REFERENCES `bsw_user` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_bsw_user_has_bsw_school_bsw_school1`
    FOREIGN KEY (`school_id`)
    REFERENCES `bsw_school` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
COMMENT = 'Administrator User may have one or more school to admin';


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

/**
  Propel has executed the PropelMigration_1286484196::getUpSQL() code, which alters the book structure without removing data:
**/

ALTER TABLE `book` ADD
(
	`author_id` INTEGER
);

CREATE INDEX `book_FI_1` ON `book` (`author_id`);

ALTER TABLE `book` ADD CONSTRAINT `book_FK_1`
	FOREIGN KEY (`author_id`)
	REFERENCES `author` (`id`)
	ON UPDATE CASCADE
	ON DELETE SET NULL;

CREATE TABLE `author`
(
	`id` INTEGER NOT NULL AUTO_INCREMENT,
	`first_name` VARCHAR(255),
	`last_name` VARCHAR(255),
	PRIMARY KEY (`id`)
) ENGINE=InnoDB;

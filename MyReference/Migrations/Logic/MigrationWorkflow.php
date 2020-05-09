<?php
/**
 * Data object containing the SQL and PHP code to migrate the database
 * up to version 1286483354.
 * Generated on 2010-10-07 22:29:14 by francois
 */
class PropelMigration_1286483354
{

	public function getUpSQL()
	{
		return array('bookstore' => '
CREATE TABLE `book`
(
	`id` INTEGER NOT NULL AUTO_INCREMENT,
	`title` VARCHAR(255) NOT NULL,
	`isbn` VARCHAR(24) NOT NULL,
	PRIMARY KEY (`id`)
) ENGINE=InnoDB COMMENT=\'Book Table\';
',
);
	}

	public function getDownSQL()
	{
		return array('bookstore' => '
DROP TABLE IF EXISTS `book`;
',
);
	}
}

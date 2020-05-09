<?php
// bootstrap the Propel runtime (and other dependencies)
require_once '/path/to/vendor/autoload.php';

set_include_path('/path/to/generated-classes' . PATH_SEPARATOR . get_include_path());
include '/path/to/generated-conf/config.php';

class PropelMigration_1286483354
{

	public function postUp($manager)
	{
		// add the post-migration code here
		$pdo = $manager->getAdapterConnection('bookstore');
		$author = new Author();
		$author->setFirstName('Leo');
		$author->setLastname('Tolstoi');
		$author->save($pdo);
	}

	public function getUpSQL()
	{
		// ...
	}
}

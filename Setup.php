<?php

namespace Ruinscraft\MineLink;

use XF\AddOn\AbstractSetup;
use XF\AddOn\StepRunnerInstallTrait;
use XF\AddOn\StepRunnerUninstallTrait;
use XF\AddOn\StepRunnerUpgradeTrait;

use XF\Db\Schema\Alter;
use XF\Db\Schema\Create;

class Setup extends AbstractSetup {

	use StepRunnerInstallTrait;
	use StepRunnerUpgradeTrait;
	use StepRunnerUninstallTrait;

	public function installStep1() {
		$this->schemaManager()->createTable('minelink_codes', function(Create $table) {
			$table->checkExists(true);
			$table->addColumn('code', 				'varchar', 32);
			$table->addColumn('created_date',		'int');
			$table->addColumn('used',				'bool');
			$table->addColumn('user_id',			'int');
			$table->addPrimaryKey('code');
		});
	}

	public function uninstallStep1() {
		$this->schemaManager()->dropTable('minelink_codes');
	}

}

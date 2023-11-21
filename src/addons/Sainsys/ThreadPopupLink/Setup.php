<?php

namespace Sainsys\ThreadPopupLink;

use XF\AddOn\AbstractSetup;
use XF\AddOn\StepRunnerInstallTrait;
use XF\AddOn\StepRunnerUninstallTrait;
use XF\AddOn\StepRunnerUpgradeTrait;
use XF\Db\Schema\Create;

class Setup extends AbstractSetup
{
	use StepRunnerInstallTrait;
	use StepRunnerUpgradeTrait;
	use StepRunnerUninstallTrait;

    public function installStep1()
    {
        $sm = $this->schemaManager();

        foreach ($this->getTables() AS $tableName => $closure)
        {
            $sm->createTable($tableName, $closure);
        }
    }

    public function postInstall(array &$stateChanges)
    {
//        if ($this->applyDefaultPermissions())
//        {
//            $this->app->jobManager()->enqueueUnique(
//                'permissionRebuild',
//                'XF:PermissionRebuild',
//                [],
//                false
//            );
//        }
        // Дописать ребилд кєша
    }


    protected function getTables()
    {
        $tables = [];

        $tables['xf_thread_popup_link'] = function(Create $table)
        {
            $table->addColumn('link_id', 'int')->autoIncrement();
            $table->addColumn('thread_id', 'int');
            $table->addColumn('enable', 'int')->setDefault(0);;
            $table->addColumn('title', 'varchar', 100);
            $table->addColumn('url', 'varchar', 255);
            $table->addColumn('color', 'varchar', 255)->setDefault('000000');
            $table->addPrimaryKey('link_id');
            $table->addKey(['link_id', 'thread_id']);
        };

        return $tables;
    }

}
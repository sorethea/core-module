<?php

namespace Modules\Core\Contracts;

use Modules\Core\Classes\Core;
use Nwidart\Modules\Module;

interface InstallerInterface
{

    /**
     * @param Module $module
     * @return void
     */
    public function install(Module $module):void;


    /**
     * @param Module $module
     * @return void
     */
    public function uninstall(Module $module): void;

}

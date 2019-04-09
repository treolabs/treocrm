<?php
/**
 * TreoCrm
 * Free Extension
 * Copyright (c) TreoLabs GmbH
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <https://www.gnu.org/licenses/>.
 */
declare(strict_types=1);

namespace Espo\Modules\TreoCrm\Migration;

/**
 * Version 3.2.4
 *
 * @author o.trelin@treolabs.com
 */
class V3Dot2Dot4 extends \Treo\Core\Migration\AbstractMigration
{
    /**
     * Up to current
     */
    public function up(): void
    {
        // get config
        $config = $this->getConfig();

        // set empty options
        $config->set('tabList', []);
        $config->set('quickCreateList', []);
        $config->set('twoLevelTabList', []);

        // unset flag
        $config->set('isCrmMenuPushed', false);

        // save
        $config->save();
    }
}

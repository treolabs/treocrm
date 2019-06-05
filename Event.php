<?php
/**
 * TreoCRM
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

namespace Treo\ModuleManagerEvents\TreoCRM;

use Treo\Composer\AbstractEvent;

/**
 * Class Event
 *
 * @author r.ratsun <r.ratsun@treolabs.com>
 */
class Event extends AbstractEvent
{
    /**
     * @inheritdoc
     */
    public function afterInstall(): void
    {
        $this->addDashlets();
        $this->addGlobalSearchEntities();
    }

    /**
     * @inheritdoc
     */
    public function afterDelete(): void
    {
    }

    /**
     * Add default dashlets
     */
    protected function addDashlets(): void
    {
        // get config
        $config = $this->getContainer()->get('config');

        // get config data
        $dashboardLayout = $config->get('dashboardLayout', []);

        foreach ($dashboardLayout as $k => $v) {
            if (empty($v->layout)) {
                $dashboardLayout[$k]->layout = [
                    0 => (object)[
                        'id'     => 'default-stream',
                        'name'   => 'Stream',
                        'x'      => 0,
                        'y'      => 0,
                        'width'  => 2,
                        'height' => 4
                    ],
                    1 => (object)[
                        'id'     => 'default-activities',
                        'name'   => 'Activities',
                        'x'      => 2,
                        'y'      => 0,
                        'width'  => 2,
                        'height' => 4
                    ]
                ];
            }
        }

        // set to config
        $config->set('dashboardLayout', $dashboardLayout);

        // save
        $config->save();
    }

    /**
     * Add global search entities
     */
    protected function addGlobalSearchEntities(): void
    {
        // get config
        $config = $this->getContainer()->get('config');

        // search entities
        $entities = [
            'Account',
            'Contact',
            'Lead',
            'Opportunity',
        ];

        // get config data
        $globalSearchEntityList = $config->get("globalSearchEntityList", []);

        foreach ($entities as $entity) {
            if (!in_array($entity, $globalSearchEntityList)) {
                $globalSearchEntityList[] = $entity;
            }
        }

        // set to config
        $config->set('globalSearchEntityList', $globalSearchEntityList);

        // save
        $config->save();
    }
}

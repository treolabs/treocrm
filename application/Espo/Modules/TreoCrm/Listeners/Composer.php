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

namespace Espo\Modules\TreoCrm\Listeners;

/**
 * Class Composer
 *
 * @author o.trelin <o.trelin@treolabs.com>
 */
class Composer extends \Treo\Listeners\AbstractListener
{
    /**
     * After install module event
     *
     * @param array $data
     */
    public function afterInstallModule(array $data): void
    {
        if (!empty($data['id']) && $data['id'] == 'TreoCrm') {
            $this->addDashlets();
            $this->addGlobalSearchEntities();
        }
    }

    /**
     * After update module event
     *
     * @param array $data
     */
    public function afterUpdateModule(array $data): void
    {
        if (!empty($data['id']) && $data['id'] == 'TreoCrm') {
            $this->addDashlets();
            $this->addGlobalSearchEntities();
        }
    }

    /**
     * Add default dashlets
     */
    protected function addDashlets(): void
    {
        // get config data
        $dashboardLayout = $this->getConfig()->get('dashboardLayout', []);

        foreach ($dashboardLayout as $k => $v) {
            if (empty($v->layout)) {
                $dashboardLayout[$k]->layout = [
                    0 => (object) [
                        'id' => 'default-stream',
                        'name' => 'Stream',
                        'x' => 0,
                        'y' => 0,
                        'width' => 2,
                        'height' => 4
                    ],
                    1 => (object) [
                        'id' => 'default-activities',
                        'name' => 'Activities',
                        'x' => 2,
                        'y' => 0,
                        'width' => 2,
                        'height' => 4
                    ]
                ];
            }
        }

        // set to config
        $this->getConfig()->set('dashboardLayout', $dashboardLayout);

        // save
        $this->getConfig()->save();
    }

    /**
     * Add global search entities
     */
    protected function addGlobalSearchEntities(): void
    {
        // search entities
        $entities = [
            'Account',
            'Contact',
            'Lead',
            'Opportunity',
        ];

        // get config data
        $globalSearchEntityList = $this->getConfig()->get("globalSearchEntityList", []);

        foreach ($entities as $entity) {
            if (!in_array($entity, $globalSearchEntityList)) {
                $globalSearchEntityList[] = $entity;
            }
        }

        // set to config
        $this->getConfig()->set('globalSearchEntityList', $globalSearchEntityList);

        // save
        $this->getConfig()->save();
    }
}

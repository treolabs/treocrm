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
     * @var array
     */
    protected $dashlets
        = [
            "stream",
            "activities"
        ];

    /**
     * @var array
     */
    protected $searchEntities
        = [
            'Account',
            'Contact',
            'Lead',
            'Opportunity'
        ];

    /**
     * @var array
     */
    protected $menuItems
        = [
            'Account',
            'Contact',
            'Lead',
            'Opportunity',
            'Case',
            'Email',
            'Calendar',
            'Meeting',
            'Call',
            'Task',
            'Document',
            'Campaign',
            'User'
        ];

    /**
     * @inheritdoc
     */
    public function afterInstall(): void
    {
        // add dashlets
        $this->addDashlets();

        // add global search
        $this->addGlobalSearchEntities();

        // add menu items
        $this->addMenuItems();
    }

    /**
     * @inheritdoc
     */
    public function afterDelete(): void
    {
        // delete dashlets
        $this->deleteDashlets();

        // delete global search
        $this->deleteGlobalSearchEntities();

        // delete menu items
        $this->deleteMenuItems();
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

        if (!isset($dashboardLayout[0])) {
            $dashboardLayout[0] = (object)[
                'name'   => 'My Treo',
                'layout' => []
            ];
        }

        $exists = [];
        foreach ($dashboardLayout[0]->layout as $item) {
            $exists[] = $item->id;
        }

        foreach ($this->dashlets as $dashlet) {
            if (!in_array('default-' . $dashlet, $exists)) {
                $dashboardLayout[0]->layout[] = (object)[
                    'id'     => 'default-' . $dashlet,
                    'name'   => ucfirst($dashlet),
                    'x'      => 0,
                    'y'      => 0,
                    'width'  => 2,
                    'height' => 4
                ];
            }
        }

        // set to config
        $config->set('dashboardLayout', $dashboardLayout);

        // save
        $config->save();
    }

    /**
     * Delete default dashlets
     */
    protected function deleteDashlets(): void
    {
        // get config
        $config = $this->getContainer()->get('config');

        // get config data
        $dashboardLayout = $config->get('dashboardLayout', []);

        if (!empty($dashboardLayout[0]->layout)) {
            $data = [];
            foreach ($dashboardLayout[0]->layout as $item) {
                if (!in_array(str_replace("default-", "", $item->id), $this->dashlets)) {
                    $data[] = $item;
                }
            }
            $dashboardLayout[0]->layout = $data;
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

        // get config data
        $globalSearchEntityList = $config->get("globalSearchEntityList", []);

        foreach ($this->searchEntities as $entity) {
            if (!in_array($entity, $globalSearchEntityList)) {
                $globalSearchEntityList[] = $entity;
            }
        }

        // set to config
        $config->set('globalSearchEntityList', $globalSearchEntityList);

        // save
        $config->save();
    }

    /**
     * Delete global search entities
     */
    protected function deleteGlobalSearchEntities(): void
    {
        // get config
        $config = $this->getContainer()->get('config');

        $globalSearchEntityList = [];
        foreach ($config->get("globalSearchEntityList", []) as $entity) {
            if (!in_array($entity, $this->searchEntities)) {
                $globalSearchEntityList[] = $entity;
            }
        }

        // set to config
        $config->set('globalSearchEntityList', $globalSearchEntityList);

        // save
        $config->save();
    }


    /**
     * Add menu items
     */
    protected function addMenuItems()
    {
        // get config
        $config = $this->getContainer()->get('config');

        // get config data
        $tabList = $config->get("tabList", []);
        $quickCreateList = $config->get("quickCreateList", []);
        $twoLevelTabList = $config->get("twoLevelTabList", []);

        foreach ($this->menuItems as $item) {
            if (!in_array($item, $tabList)) {
                $tabList[] = $item;
            }
            if (!in_array($item, $quickCreateList)) {
                $quickCreateList[] = $item;
            }
            if (!in_array($item, $twoLevelTabList)) {
                $twoLevelTabList[] = $item;
            }
        }

        // set to config
        $config->set('tabList', $tabList);
        $config->set('quickCreateList', $quickCreateList);
        $config->set('twoLevelTabList', $twoLevelTabList);

        if ($config->get('applicationName') == 'TreoCore') {
            $config->set('applicationName', 'TreoCRM');
        }

        // save
        $config->save();
    }

    /**
     * Delete menu items
     */
    protected function deleteMenuItems()
    {
        // get config
        $config = $this->getContainer()->get('config');

        // for tabList
        $tabList = [];
        foreach ($config->get("tabList", []) as $entity) {
            if (!in_array($entity, $this->menuItems)) {
                $tabList[] = $entity;
            }
        }
        $config->set('tabList', $tabList);

        // for quickCreateList
        $quickCreateList = [];
        foreach ($config->get("quickCreateList", []) as $entity) {
            if (!in_array($entity, $this->menuItems)) {
                $quickCreateList[] = $entity;
            }
        }
        $config->set('quickCreateList', $quickCreateList);

        // for twoLevelTabList
        $twoLevelTabList = [];
        foreach ($config->get("twoLevelTabList", []) as $entity) {
            if (!in_array($entity, $this->menuItems)) {
                $twoLevelTabList[] = $entity;
            }
        }
        $config->set('twoLevelTabList', $twoLevelTabList);

        // save
        $config->save();
    }
}

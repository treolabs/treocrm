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

namespace Espo\Modules\TreoCrm\Metadata;

/**
 * Class Metadata
 *
 * @author r.ratsun@treolabs.com
 */
class Metadata extends \Treo\Metadata\AbstractMetadata
{

    /**
     * Modify
     *
     * @param array $data
     *
     * @return array
     */
    public function modify(array $data): array
    {
        // push crm menu items
        $this->pushCrmMenuItems();

        return $data;
    }

    /**
     * @return bool
     */
    protected function pushCrmMenuItems(): bool
    {
        // get config
        $config = $this->getContainer()->get('config');

        if (empty($config->get('isCrmMenuPushed'))) {
            // prepare items
            $items = [
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
                'User',
            ];

            // get config data
            $tabList = $config->get("tabList", []);
            $quickCreateList = $config->get("quickCreateList", []);
            $twoLevelTabList = $config->get("twoLevelTabList", []);

            foreach ($items as $item) {
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

            // set flag
            $config->set('isCrmMenuPushed', true);

            // save
            $config->save();
        }

        return true;
    }
}

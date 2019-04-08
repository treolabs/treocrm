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

namespace Espo\Modules\TreoCrm\Metadata;

/**
 * Class Metadata
 *
 * @author r.ratsun <r.ratsun@zinitsolutions.com>
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
        // prepare Product if Advanced installed
        $data = $this->prepareProduct($data);

        return $data;
    }

    /**
     * Prepare Product if Advanced installed
     *
     * @param array $data
     *
     * @return array
     */
    protected function prepareProduct(array $data): array
    {
        if (isset($data['clientDefs']['Product']['menu']['list']['dropdown'])) {
            if (!empty($dropdown = $data['clientDefs']['Product']['menu']['list']['dropdown']) && is_array($dropdown)) {
                $newDropdown = [];
                foreach ($dropdown as $item) {
                    if (!in_array($item['link'], ['#ProductBrand', '#ProductCategory'])) {
                        $newDropdown[] = $item;
                    }
                }
                $data['clientDefs']['Product']['menu']['list']['dropdown'] = $newDropdown;
            }
        }

        return $data;
    }
}

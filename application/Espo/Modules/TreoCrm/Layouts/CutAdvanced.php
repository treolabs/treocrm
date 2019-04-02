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

namespace Espo\Modules\TreoCrm\Layouts;

use Treo\Layouts\AbstractLayout;
use Espo\Core\Utils\Json;

/**
 * Class CutAdvanced
 *
 * @author r.ratsun <r.ratsun@zinitsolutions.com>
 */
abstract class CutAdvanced extends AbstractLayout
{
    /**
     * @param array $data
     *
     * @return array
     */
    public function layoutDetail(array $data): array
    {
        // prepare layout if Advanced installed
        if ($this->isAdvancedModuleInstalled()) {
            $data = $this->cutAdvancedLayoutData('detail', $data);
        }

        return $data;
    }

    /**
     * @param array $data
     *
     * @return array
     */
    public function layoutDetailSmall(array $data): array
    {
        // prepare layout if Advanced installed
        if ($this->isAdvancedModuleInstalled()) {
            $data = $this->cutAdvancedLayoutData('detailSmall', $data);
        }

        return $data;
    }

    /**
     * @param array $data
     *
     * @return array
     */
    public function layoutList(array $data): array
    {
        // prepare layout if Advanced installed
        if ($this->isAdvancedModuleInstalled()) {
            $data = $this->cutAdvancedLayoutData('list', $data);
        }

        return $data;
    }

    /**
     * @param array $data
     *
     * @return array
     */
    public function layoutListSmall(array $data): array
    {
        // prepare layout if Advanced installed
        if ($this->isAdvancedModuleInstalled()) {
            $data = $this->cutAdvancedLayoutData('listSmall', $data);
        }

        return $data;
    }

    /**
     * Is Advanced module installed ?
     *
     * @return bool
     */
    protected function isAdvancedModuleInstalled(): bool
    {
        return in_array('Advanced', $this->getContainer()->get('metadata')->getModuleList());
    }

    /**
     * Cut from layout Advanced module data
     *
     * @param string $layout
     * @param array  $data
     *
     * @return array
     */
    protected function cutAdvancedLayoutData(string $layout, array $data): array
    {
        // prepare path
        $path = "application/Espo/Modules/Advanced/Resources/layouts/" . $this->scope . "/{$layout}.json";

        if (!empty($layoutJson = $this->getContainer()->get('fileManager')->getContents($path))) {
            $jsonData = Json::encode($data);
            foreach (Json::decode($layoutJson, true) as $row) {
                $jsonData = str_replace(Json::encode($row) . ',', '', $jsonData);
            }
            $data = Json::decode($jsonData, true);
        }

        return $data;
    }
}

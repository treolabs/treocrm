<?php
/**
 * This file is part of EspoCRM and/or TreoCrm.
 *
 * EspoCRM - Open Source CRM application.
 * Copyright (C) 2014-2019 Yuri Kuznetsov, Taras Machyshyn, Oleksiy Avramenko
 * Website: http://www.espocrm.com
 *
 * TreoCrm is EspoCRM-based Open Source application.
 * Copyright (C) 2017-2019 TreoLabs GmbH
 * Website: https://treolabs.com
 *
 * TreoCrm as well as EspoCRM is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * TreoCrm as well as EspoCRM is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with EspoCRM. If not, see http://www.gnu.org/licenses/.
 *
 * The interactive user interfaces in modified source and object code versions
 * of this program must display Appropriate Legal Notices, as required under
 * Section 5 of the GNU General Public License version 3.
 *
 * In accordance with Section 7(b) of the GNU General Public License version 3,
 * these Appropriate Legal Notices must retain the display of the "EspoCRM" word
 * and "TreoCrm" word.
 */

namespace Crm\Jobs;

use \Espo\Core\Exceptions;

class CheckInboundEmails extends \Espo\Core\Jobs\Base
{
    public function run()
    {
        $service = $this->getServiceFactory()->create('InboundEmail');
        $collection = $this->getEntityManager()->getRepository('InboundEmail')->where(array(
            'status' => 'Active',
            'useImap' => true
        ))->find();
        foreach ($collection as $entity) {
            try {
                $service->fetchFromMailServer($entity);
            } catch (\Exception $e) {
                $GLOBALS['log']->error('Job CheckInboundEmails '.$entity->id.': [' . $e->getCode() . '] ' .$e->getMessage());
            }
        }

        return true;
    }
}


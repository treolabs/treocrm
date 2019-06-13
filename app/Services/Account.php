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

namespace Crm\Services;

use \Espo\ORM\Entity;

class Account extends \Espo\Services\Record
{
    protected $linkSelectParams = array(
        'contacts' => array(
            'additionalColumns' => array(
                'role' => 'accountRole',
                'isInactive' => 'accountIsInactive'
            )
        ),
        'targetLists' => array(
            'additionalColumns' => array(
                'optedOut' => 'isOptedOut'
            )
        )
    );

    protected function getDuplicateWhereClause(Entity $entity, $data)
    {
        if (!$entity->get('name')) {
            return false;
        }
        return array(
            'name' => $entity->get('name')
        );
    }

    protected function afterMerge(Entity $entity, array $sourceList, $attributes)
    {
        foreach ($sourceList as $source) {
            $contactList = $this->getEntityManager()->getRepository('Contact')->where([
                'accountId' => $source->id
            ])->find();
            foreach ($contactList as $contact) {
                $contact->set('accountId', $entity->id);
                $this->getEntityManager()->saveEntity($contact);
            }
        }
    }
}
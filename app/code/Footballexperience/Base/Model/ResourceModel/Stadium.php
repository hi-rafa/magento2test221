<?php

namespace Footballexperience\Base\Model\ResourceModel;

use Footballexperience\Base\Api\Data\StadiumInterface;
use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Stadium extends AbstractDb
{
    /**
     * Initialize resource model
     */
    protected function _construct()
    {
        $this->_init(StadiumInterface::TABLE, StadiumInterface::ID);
    }
}
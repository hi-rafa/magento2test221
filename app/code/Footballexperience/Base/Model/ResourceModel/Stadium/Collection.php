<?php

namespace Footballexperience\Base\Model\ResourceModel\Stadium;

use Footballexperience\Base\Model\Stadium as ModelStadium;
use Footballexperience\Base\Model\ResourceModel\Stadium as ResourceModelStadium;
use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    /**
     * Constructor
     */
    protected function _construct()
    {
        $this->_init(ModelStadium::class, ResourceModelStadium::class);
    }
}
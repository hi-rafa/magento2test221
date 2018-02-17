<?php

namespace Footballexperience\Base\Api\Data;

use \Magento\Framework\Api\SearchResultsInterface;

interface StadiumSearchResultsInterface extends SearchResultsInterface
{
    /**
     * @return \Footballexperience\Base\Api\Data\StadiumInterface[]
     */
    public function getItems();
    
    /**
     * @param \Footballexperience\Base\Api\Data\StadiumInterface[] $items
     * @return void
     */
    public function setItems(array $items);
}
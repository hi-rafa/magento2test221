<?php

namespace Footballexperience\Base\Api;

interface StadiumRepositoryInterface
{
    
    /**
     * Save entity
     *
     * @param \Footballexperience\Base\Api\Data\StadiumInterface $stadium
     * @return \Footballexperience\Base\Api\Data\StadiumInterface
     */
    public function save(\Footballexperience\Base\Api\Data\StadiumInterface $entity);
    
    /**
     * Retrieve entity by id
     *
     * @param int $entityId
     * @return \Footballexperience\Base\Api\Data\StadiumInterface
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getById($entityId);
    
    /**
     * Retrieve entity by attribute
     *
     * @param $attributeCode
     * @param $value
     * @return \Footballexperience\Base\Api\Data\StadiumInterface|boolean
     */
    public function get($attributeCode, $value);
    
    /**
     * Delete $entity.
     *
     * @param \Footballexperience\Base\Api\Data\StadiumInterface $entity
     * @return boolean
     * @throws \Magento\Framework\Exception\CouldNotSaveException|\Magento\Framework\Exception\StateException
     */
    public function delete(\Footballexperience\Base\Api\Data\StadiumInterface $entity);
    
    /**
     * Delete entity by ID.
     *
     * @param int $entityId
     * @return boolean
     */
    public function deleteById($entityId);
    
    /**
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \Footballexperience\Base\Api\Data\StadiumInterface
     */
    public function getList(\Magento\Framework\Api\SearchCriteriaInterface $searchCriteria);
}
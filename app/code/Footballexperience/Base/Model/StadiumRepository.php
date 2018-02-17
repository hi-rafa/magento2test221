<?php


namespace Footballexperience\Base\Model;

use Footballexperience\Base\Api\Data\StadiumInterface;
use Footballexperience\Base\Api\Data\StadiumSearchResultsInterfaceFactory;
use Footballexperience\Base\Api\StadiumRepositoryInterface;
use Footballexperience\Base\Model\StadiumFactory;
use Footballexperience\Base\Model\ResourceModel\Stadium\Collection;
use Footballexperience\Base\Model\ResourceModel\Stadium\CollectionFactory;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Api\SortOrder;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Exception\StateException;
use Magento\Framework\Exception\ValidatorException;
use Exception;

class StadiumRepository implements StadiumRepositoryInterface
{
    
    /**
     * @var EntityFactory $stadiumFactory
     */
    private $stadiumFactory;
    
    /**
     * @var CollectionFactory $stadiumCollectionFactory
     */
    private $stadiumCollectionFactory;
    
    /**
     * @var EntitySearchResultsInterfaceFactory $stadiumSearchResultsInterfaceFactory
     */
    private $stadiumSearchResultsInterfaceFactory;
    
    /**
     * StadiumRepository constructor.
     *
     * @param StadiumFactory $stadiumFactory
     * @param CollectionFactory $stadiumCollectionFactory
     * @param EntitySearchResultsInterfaceFactory $stadiumSearchResultsInterfaceFactory
     */
    public function __construct(
        StadiumFactory $stadiumFactory,
        CollectionFactory $stadiumCollectionFactory,
        StadiumSearchResultsInterfaceFactory $stadiumSearchResultsInterfaceFactory
    ) {
        $this->stadiumFactory = $stadiumFactory;
        $this->stadiumCollectionFactory = $stadiumCollectionFactory;
        $this->stadiumSearchResultsInterfaceFactory = $stadiumSearchResultsInterfaceFactory;
    }
    
    /**
     * @inheritdoc
     */
    public function save(StadiumInterface $stadium)
    {
        $stadium->getResource()->save($stadium);
        
        return $stadium;
    }
    
    
    /**
     * @inheritdoc
     */
    public function getById($stadiumId)
    {
        $stadium = $this->stadiumFactory->create()->load($stadiumId);
        
        if (!$stadium->getId()) {
            throw new NoSuchEntityException(__('Unable to find stadium with ID "%1"', $stadiumId));
        }
        
        return $stadium;
    }
    
    /**
     * @inheritdoc
     */
    public function get($attributeCode, $value)
    {
        $stadium = $this->stadiumFactory->create()->load($value, $attributeCode);
        
        if (!$stadium->getId()) {
            return false;
        }
        
        return $stadium;
    }
    
    /**
     * @inheritdoc
     */
    public function delete(StadiumInterface $stadium)
    {
        
        $stadiumId = $stadium->getId();
        try {
            $stadium->getResource()->delete($stadium);
        } catch (ValidatorException $e) {
            throw new CouldNotSaveException(__($e->getMessage()));
        } catch (Exception $e) {
            throw new StateException(
                __('Unable to remove $stadium %1', $stadiumId)
            );
        }
        
        return true;
    }
    
    /**
     * @inheritdoc
     */
    public function deleteById($stadiumId)
    {
        $stadium = $this->getById($stadiumId);
        
        return $this->delete($stadium);
    }
    
    /**
     * @inheritdoc
     */
    public function getList(SearchCriteriaInterface $searchCriteria)
    {
        $collection = $this->stadiumCollectionFactory->create();
        
        $this->addFiltersToCollection($searchCriteria, $collection);
        $this->addSortOrdersToCollection($searchCriteria, $collection);
        $this->addPagingToCollection($searchCriteria, $collection);
        
        $collection->load();
        
        return $this->buildSearchResult($searchCriteria, $collection);
    }
    
    /**
     * @param SearchCriteriaInterface $searchCriteria
     * @param Collection $collection
     */
    private function addFiltersToCollection(SearchCriteriaInterface $searchCriteria, Collection $collection)
    {
        foreach ($searchCriteria->getFilterGroups() as $filterGroup) {
            $fields = $conditions = [];
            foreach ($filterGroup->getFilters() as $filter) {
                $fields[] = $filter->getField();
                $conditions[] = [$filter->getConditionType() => $filter->getValue()];
            }
            $collection->addFieldToFilter($fields, $conditions);
        }
    }
    
    /**
     * @param SearchCriteriaInterface $searchCriteria
     * @param Collection $collection
     */
    private function addSortOrdersToCollection(
        SearchCriteriaInterface $searchCriteria,
        Collection $collection
    ) {
        foreach ((array)$searchCriteria->getSortOrders() as $sortOrder) {
            $direction = $sortOrder->getDirection() == SortOrder::SORT_ASC ? 'asc' : 'desc';
            $collection->addOrder($sortOrder->getField(), $direction);
        }
    }
    
    /**
     * @param SearchCriteriaInterface $searchCriteria
     * @param Collection $collection
     */
    private function addPagingToCollection(
        SearchCriteriaInterface $searchCriteria,
        Collection $collection
    ) {
        $collection->setPageSize($searchCriteria->getPageSize());
        $collection->setCurPage($searchCriteria->getCurrentPage());
    }
    
    /**
     * @param SearchCriteriaInterface $searchCriteria
     * @param Collection $collection
     * @return mixed
     */
    private function buildSearchResult(
        SearchCriteriaInterface $searchCriteria,
        Collection $collection
    ) {
        $searchResults = $this->stadiumSearchResultsInterfaceFactory->create();
        
        $searchResults->setSearchCriteria($searchCriteria);
        $searchResults->setItems($collection->getItems());
        $searchResults->setTotalCount($collection->getSize());
        
        return $searchResults;
    }
}
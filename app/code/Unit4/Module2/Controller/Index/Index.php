<?php
namespace Unit4\Module2\Controller\Index;

class Index extends \Magento\Framework\App\Action\Action
{
    protected $resultPageFactory;
    protected $storeCollection;
    protected $store;
    protected $categoryCollection;
    
    public function __construct(
            \Magento\Framework\App\Action\Context $context,
            \Magento\Framework\View\Result\PageFactory $resultPageFactory,
            \Magento\Store\Model\ResourceModel\Store\Collection $storeCollection,
            \Magento\Store\Model\Store $store,
            \Magento\Catalog\Model\ResourceModel\Category\Collection $categoryCollection
        )
    {
        $this->resultPageFactory = $resultPageFactory;
        $this->storeCollection = $storeCollection;
        $this->store = $store;
        $this->categoryCollection = $categoryCollection;
        parent::__construct($context);
    }
    
    public function execute()
    {
        // 1. Get a list of stores using: Magento\Store\Model\ResourceModel\Store\Collection
        $stores = $this->storeCollection->load()->getData();
        print_r($stores);
        
        
        // 2. Get root category IDs using: Magento\Store\Model\Store::getRootCategoryId()
        echo '<br/>';
        $rootCategoryId = $this->store->load($stores[0]['store_id'])->getRootCategoryId();
        echo $rootCategoryId;
        
        
        // 3. Create a category collection and filter it by the root category IDs.
        echo '<br/>';
        $categories = $this->categoryCollection->addFilter('entity_id', $rootCategoryId)->getItems();
        foreach($categories as $category)
        {
            echo $category->getId();
        }
        
        // 4. Add the category name attribute to the result.
        echo '<br/>';
        
        
        // 5. Display stores with the associated root category names.
        echo '<br/>';
        foreach($stores as $store)
        {
            $rootCategoryId = $this->store->load($store['store_id'])->getRootCategoryId();
            echo $rootCategoryId;
        }
        
    }
}
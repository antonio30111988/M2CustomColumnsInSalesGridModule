<?php
declare(strict_types=1);

/**
 * @by Antonio Lolić, 4/4/20
 **/

namespace Antonio88\CustomColumnsInSalesGrid\Plugins;

use Magento\Framework\Data\Collection;
use Magento\Framework\DB\Select;
use Magento\Framework\View\Element\UiComponent\DataProvider\CollectionFactory;
use Psr\Log\LoggerInterface;

class AddCouponCodeAndDiscountAmountToSalesOrderGrid
{
    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * AddCouponCodeAndDiscountAmountToSalesOrderGrid constructor.
     * @param LoggerInterface $logger
     */
    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    /**
     * @param CollectionFactory $subject
     * @param Collection $result
     * @param $requestName
     * @return Collection
     */
    public function afterGetReport(
        CollectionFactory $subject,
        Collection $result,
        $requestName
    ) {
        if ($requestName === 'sales_order_grid_data_source') {
            try {
                $this->loadCouponCodeAndDiscountAmountIntoSalesOrderGrid($result);
            } catch (\Zend_Db_Select_Exception $selectException) {
                $this->logger->log(100, $selectException);
            }
        }

        return $result;
    }

    /**
     * @param Collection $result
     */
    private function loadCouponCodeAndDiscountAmountIntoSalesOrderGrid(Collection $result): void
    {
        /** @var Select $select */
        $select = $result->getSelect();

        $select->joinLeft(
            ["so" => $result->getTable("sales_order")],
            'main_table.entity_id = so.entity_id',
            ['coupon_code', 'discount_amount']
        );
    }

}

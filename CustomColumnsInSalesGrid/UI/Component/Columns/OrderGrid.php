<?php
declare(strict_types=1);

/**
 * @by Antonio Lolić, 4/4/20
 **/

namespace Antonio88\CustomColumnsInSalesGrid\UI\Component\Columns;

use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Ui\Component\Listing\Columns\Column;
use Magento\Framework\Pricing\Helper\Data;

class OrderGrid extends Column
{
    /** @var Data */
    private $pricingHelper;

    /**
     * OrderGrid constructor.
     * @param Data $pricingHelper
     * @param ContextInterface $context
     * @param UiComponentFactory $uiComponentFactory
     * @param array $components
     * @param array $data
     */
    public function __construct(
        Data $pricingHelper,
        ContextInterface $context,
        UiComponentFactory $uiComponentFactory,
        array $components = [],
        array $data = []
    ) {
        parent::__construct($context, $uiComponentFactory, $components, $data);
        $this->pricingHelper = $pricingHelper;
    }

    /**
     * Prepare Data Source
     *
     * @param array $dataSource
     * @return array
     */
    public function prepareDataSource(array $dataSource): array
    {
        if (isset($dataSource['data']['items'])) {
            foreach ($dataSource['data']['items'] as &$item) {
                $item['discount_amount'] = $this->getFormattedDiscountAmount($item);
            }
        }

        return $dataSource;
    }

    /**
     * @param $item
     * @return float|string
     */
    private function getFormattedDiscountAmount($item)
    {
        return $this->pricingHelper->currency(
            number_format((float)$item['discount_amount'], 2),
            true,
            false
        );
    }

}

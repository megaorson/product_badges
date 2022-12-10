<?php

namespace Megaorson\ProductBadges\Ui\DataProvider\Product\Form\Modifier;

use Magento\Catalog\Model\Locator\LocatorInterface;
use Magento\Catalog\Ui\DataProvider\Product\Form\Modifier\AbstractModifier;
use Magento\Framework\Stdlib\ArrayManager;
use Magento\Framework\UrlInterface;
use Magento\Ui\Component\Form\Fieldset;

class BadgeTab extends AbstractModifier
{
    const SAMPLE_FIELDSET_NAME = 'badge_grid_fieldset';

    const SAMPLE_FIELD_NAME = 'badge_grid';

    protected $_backendUrl;

    protected $_productloader;

    /**
     * @var
     */
    protected $_modelCustomgridFactory;

    /**
     * @var LocatorInterface
     */
    protected $locator;

    /**
     * @var ArrayManager
     */
    protected $arrayManager;

    /**
     * @var UrlInterface
     */
    protected $urlBuilder;

    /**
     * @var array
     */
    protected $meta = [];

    /**
     * @param LocatorInterface $locator
     * @param ArrayManager $arrayManager
     * @param UrlInterface $urlBuilder
     * @param \Magento\Catalog\Model\ProductFactory $_productloader
     * @param \Magento\Backend\Model\UrlInterface $backendUrl
     */
    public function __construct(
        LocatorInterface $locator,
        ArrayManager $arrayManager,
        UrlInterface $urlBuilder,
        \Magento\Catalog\Model\ProductFactory $_productloader,
        \Magento\Backend\Model\UrlInterface $backendUrl
    ) {
        $this->locator = $locator;
        $this->arrayManager = $arrayManager;
        $this->urlBuilder = $urlBuilder;
        $this->_productloader = $_productloader;
        $this->_backendUrl = $backendUrl;
    }

    /**
     * @param array $data
     * @return array
     */
    public function modifyData(array $data)
    {
        return $data;
    }

    /**
     * @param array $meta
     * @return array
     */
    public function modifyMeta(array $meta)
    {
        $this->meta = $meta;
        $this->addCustomTab();

        return $this->meta;
    }

    /**
     * @return void
     */
    protected function addCustomTab()
    {
        $this->meta = array_merge_recursive(
            $this->meta,
            [
                static::SAMPLE_FIELDSET_NAME => $this->getTabConfig(),
            ]
        );
    }

    /**
     * @return array
     */
    protected function getTabConfig()
    {
        $product = $this->locator->getProduct();
        $link = $this->_backendUrl->getUrl(
            'megaorson_productbadges/productbadges/new',
            [
                'product_id' => $product->getId(),
            ]
        );

        return [
            'arguments' => [
                'data' => [
                    'config' => [
                        'label' => __('Badges Grid Tab'),
                        'componentType' => Fieldset::NAME,
                        'dataScope' => '',
                        'provider' => static::FORM_NAME . '.product_form_data_source',
                        'ns' => static::FORM_NAME,
                        'collapsible' => true,
                    ],
                ],
            ],
            'children' => [
                'button_add_badge' => [
                    'arguments' => [
                        'data' => [
                            'config' => [
                                'formElement' => 'container',
                                'componentType' => 'container',
                                'component' => 'Megaorson_ProductBadges/js/form/components/button',
                                'url' => $link,
                                'title' => __("Add Badge"),
                                'provider' => null,
                            ],
                        ],
                    ],
                ],

                static::SAMPLE_FIELD_NAME => [
                    'arguments' => [
                        'data' => [
                            'config' => [
                                'autoRender' => true,
                                'componentType' => 'insertListing',
                                'dataScope' => 'custom_grid_listing',
                                'externalProvider' => 'megaorson_productbadges_productbadges_listing.megaorson_productbadges_productbadges_listing_data_source',
                                'selectionsProvider' => 'megaorson_productbadges_productbadges_listing.megaorson_productbadges_productbadges_listing_data_source.ids',
                                'ns' => 'megaorson_productbadges_productbadges_listing',
                                'render_url' => $this->urlBuilder->getUrl('mui/index/render', [
                                    'product_id' => $product->getId(),
                                ]),
                                'realTimeLink' => false,
                                'behaviourType' => 'simple',
                                'externalFilterMode' => true,
                                'imports' => [
                                    'productId' => '${ $.provider }:data.product.current_product_id'
                                ],
                                'exports' => [
                                    'productId' => '${ $.externalProvider }:params.current_product_id'
                                ],

                            ],
                        ],
                    ],
                    'children' => [],
                ],
            ],
        ];
    }
}

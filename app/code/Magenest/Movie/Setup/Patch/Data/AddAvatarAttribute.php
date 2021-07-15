<?php
 
namespace Magenest\Movie\Setup\Patch\Data;
 
use Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface;
use Magento\Eav\Setup\EavSetup;
use Magento\Eav\Setup\EavSetupFactory;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\Patch\DataPatchInterface;
use Magento\Eav\Model\Config;

class AddAvatarAttribute implements DataPatchInterface
{
    /**
     * ModuleDataSetupInterface
     *
     * @var ModuleDataSetupInterface
     */
    private $moduleDataSetup;
 
    /**
     * EavSetupFactory
     *
     * @var EavSetupFactory
     */
    private $eavSetupFactory;


    private $attributeResource;
    private $eavConfig;
 
    /**
     * AddProductAttribute constructor.
     *
     * @param ModuleDataSetupInterface  $moduleDataSetup
     * @param EavSetupFactory           $eavSetupFactory
     */
    public function __construct(
        ModuleDataSetupInterface $moduleDataSetup,
        EavSetupFactory $eavSetupFactory,
        \Magento\Customer\Model\ResourceModel\Attribute $attributeResource,
        Config $eavConfig
    ) {
        $this->moduleDataSetup = $moduleDataSetup;
        $this->eavSetupFactory = $eavSetupFactory;
        $this->attributeResource = $attributeResource;
        $this->eavConfig = $eavConfig;
    }
 
    /**
     * {@inheritdoc}
     */
    public function apply()
    {
        /** @var EavSetup $eavSetup */
        $eavSetup = $this->eavSetupFactory->create(['setup' => $this->moduleDataSetup]);
 
        $eavSetup->addAttribute('customer', 'avatar', [
            'type' => 'text',
            'label' => 'Customer Avatar',
            'input' => 'image',
            'source' => '',
            'visible' => true,
            'used_in_product_listing' => true,
            'user_defined' => false,
            'required' => false,
            'system' => false,
            'sort_order' => 80,
        ]);

        $attribute = $this->eavConfig->getAttribute('customer', 'avatar');

        $attribute->setData('used_in_forms', [
            'adminhtml_customer',
        ]);

        $this->attributeResource->save($attribute);

    }
 
    /**
     * {@inheritdoc}
     */
    public static function getDependencies()
    {
        return [];
    }
 
    /**
     * {@inheritdoc}
     */
    public function getAliases()
    {
        return [];
    }
}
<?php

namespace Syntro\SilverStripeElementalBootstrapStaffSection\Elements;

use SilverStripe\Forms\DropdownField;
use SilverStripe\ORM\FieldType\DBField;
use SilverStripe\ORM\FieldType\DBHTMLText;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\GridField\GridField;
use SilverStripe\Forms\GridField\GridFieldAddExistingAutocompleter;
use SilverStripe\Forms\GridField\GridFieldDeleteAction;
use Symbiote\GridFieldExtensions\GridFieldOrderableRows;
use Syntro\SilverStripeElementalBaseitems\Elements\BootstrapSectionBaseElement;
use Syntro\SilverStripeElementalBootstrapStaffSection\Model\StaffMember;

/**
 *  Bootstrap based Staff section
 *
 * @author Matthias Leutenegger <hello@syntro.ch>
 */
class StaffSection extends BootstrapSectionBaseElement
{

    private static $icon = 'elemental-icon-staff';
    /**
     * This defines the block name in the CSS
     *
     * @config
     * @var string
     */
    private static $block_name = 'staff-section';

    /**
     * @var bool
     */
    private static $inline_editable = false;

    private static $styles = [];

    /**
     * @var string
     */
    // private static $icon = 'font-icon-attention';

    /**
     * @var string
     */
    private static $table_name = 'ElementStaffSection';

    /**
     * set to false if image option should not show up
     *
     * @config
     * @var bool
     */
    private static $allow_image_background = true;

    /**
     * Available background colors for this Element
     *
     * @config
     * @var array
     */
    private static $background_colors = [
        'default' => 'Default',
        'light' => 'Lightgrey',
        'dark' => 'Dark',
    ];

    private static $text_colors = [
        'default' => 'Default',
        'white' => 'White'
    ];

    /**
     * Color mapping from background color. This is mainly intended
     * to set a default color on the section-level, ensuring text is readable.
     * Colors of subelementscan be added via templates
     *
     * @config
     * @var array
     */
    private static $text_colors_by_background = [
        'light' => 'default',
        'dark' => 'light',
    ];

    private static $db = [
        'Content' => 'Text',
    ];

    private static $has_many = [
        'StaffMembers' => StaffMember::class
    ];

    /**
     * @var array
     */
    private static $owns = [
        'StaffMembers'
    ];


    /**
     * fieldLabels - apply labels
     *
     * @param  boolean $includerelations = true
     * @return array
     */
    public function fieldLabels($includerelations = true)
    {
        $labels = parent::fieldLabels($includerelations);
        $labels['StaffMembers'] = _t(__CLASS__ . '.STAFFMEMBERS', 'Staff members');
        $labels['Content'] = _t(__CLASS__ . '.CONTENT', 'Content');
        return $labels;
    }


    /**
     * @return FieldList
     */
    public function getCMSFields()
    {
        $this->beforeUpdateCMSFields(function ($fields) {

            $fields->dataFieldByName('Content')->setTitle($this->fieldLabel('Content'));


            if ($this->ID) {
                /** @var GridField $people */
                $people = $fields->dataFieldByName('StaffMembers');
                $people->setTitle($this->fieldLabel('StaffMembers'));

                $fields->removeByName('StaffMembers');

                $config = $people->getConfig();
                $config->addComponent(new GridFieldOrderableRows('Sort'));
                $config->removeComponentsByType(GridFieldAddExistingAutocompleter::class);
                $config->removeComponentsByType(GridFieldDeleteAction::class);

                $fields->addFieldToTab('Root.Main', $people);
            }
        });

        return parent::getCMSFields();
    }

    /**
     * @return string
     */
    public function getSummary()
    {
        return sprintf(
            '%s: %s',
            _t(
                __CLASS__ . '.SUMMARY',
                'one staff member|{count} staff members',
                ['count' => $this->StaffMembers()->count()]
            ),
            implode(', ', $this->StaffMembers()->map('Title')->keys())
        );
    }

    /**
     * @return array
     */
    protected function provideBlockSchema()
    {
        $blockSchema = parent::provideBlockSchema();
        $blockSchema['content'] = $this->getSummary();
        return $blockSchema;
    }

    /**
     * getType
     *
     * @return string
     */
    public function getType()
    {
        return _t(__CLASS__ . '.BlockType', 'Staff Section');
    }
}

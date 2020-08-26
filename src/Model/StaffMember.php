<?php
namespace Syntro\SilverStripeElementalBootstrapStaffSection\Model;

use SilverStripe\Forms\TextField;
use SilverStripe\Assets\Image;
use SilverStripe\Forms\TextareaField;
use SilverStripe\AssetAdmin\Forms\UploadField;
use Syntro\SilverStripeElementalBaseitems\Model\BaseItem;
use Syntro\SilverStripeElementalBootstrapStaffSection\Elements\StaffSection;

/**
 * StaffMember
 *
 * @author Matthias Leutenegger <hello@syntro.ch>
 */
class StaffMember extends BaseItem
{
    /**
     * @var string
     */
    private static $table_name = 'ElementalBootstrapStaffMember';

    /**
     * @var array
     */
    private static $db = [
        'Sort' => 'Int',
        'Position' => 'Varchar(255)',
        'Description' => 'Text',

    ];

    private static $default_sort = ['Sort' => 'ASC'];

    /**
     * @var array
     */
    private static $has_one = [
        'Section' => StaffSection::class,
        'Image' => Image::class,
    ];

    /**
     * @var array
     */
    private static $owns = [
        'Image'
    ];

    private static $defaults = [
        'ShowTitle' => true
    ];

    /**
     * @return FieldList
     */
    public function getCMSFields()
    {
        $this->beforeUpdateCMSFields(function ($fields) {
            /** @var FieldList $fields */
            $fields->removeByName([
                'Sort',
                'SectionID',
                'Title'
            ]);

            // Add title field
            $fields->addFieldToTab(
                'Root.Main',
                TextField::create(
                    'Title',
                    'Name'
                ),
                'Position'
            );

            // Add Image Upload Field
            $fields->addFieldToTab(
                'Root.Main',
                $imageField = UploadField::create(
                    'Image',
                    'Image'
                )
            );
            $imageField->setFolderName('Uploads/StaffMembers');

            // Add content field
            // $fields->addFieldToTab(
            //     'Root.Main',
            //     TextareaField::create(
            //         'Content',
            //         'Content'
            //     ),
            //     'CTALink'
            // );
        });

        return parent::getCMSFields();
    }
}

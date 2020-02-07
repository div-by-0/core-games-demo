<?php


namespace App\Application\Sonata\MediaBundle\Admin;


use Sonata\AdminBundle\Form\FormMapper;

class GalleryAdmin extends \Core\MediaBundle\Admin\ORM\GalleryAdmin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        parent::configureFormFields($formMapper);
    }
}

<?php

namespace App\Application\Sonata\MediaBundle\Entity;

class Gallery extends \Core\MediaBundle\Entity\BaseGallery
{
    /**
     * @var int $id
     */
    protected $id;

    /**
     * Get id.
     *
     * @return int $id
     */
    public function getId()
    {
        return $this->id;
    }
}

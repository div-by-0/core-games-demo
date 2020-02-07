<?php

namespace App\Application\Sonata\UserBundle\Entity;

use Core\PromoBaseBundle\Entity\ObjectReferenceTrait;
use Core\PromoBaseBundle\Entity\PlayerInterface;
use DateTime;
use Sonata\UserBundle\Entity\BaseUser as BaseUser;

//TODO: refactor fields to core bundle!
class User extends BaseUser
{
    /** @var int $id */
    protected $id;

    /** @var DateTime */
    protected $gdprConsentsApprovedAt;

    /** @var string */
    protected $parentEmail;

    /** @var string */
    protected $parentApprovalToken;

    /** @var \DateTime */
    protected $parentApprovalRequestedAt;

    /** @var \DateTime */
    protected $parentApprovalReceivedAt;

    /** @var bool */
    protected $canWin = true;

    /** @var DateTime */
    protected $deletedAt;

    /** @var string */
    protected $ageGroup;

    /** @var string */
    protected $profilePicture;

    /**
     * @return int $id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return bool
     */
    public function isCanWin(): bool
    {
        return $this->canWin;
    }

    /**
     * @param bool $canWin
     */
    public function setCanWin(bool $canWin): void
    {
        $this->canWin = $canWin;
    }

    /**
     * @return DateTime|null
     */
    public function getDeletedAt(): ?DateTime
    {
        return $this->deletedAt;
    }

    /**
     * @param DateTime|null $deletedAt
     * @return User
     */
    public function setDeletedAt(?DateTime $deletedAt): User
    {
        $this->deletedAt = $deletedAt;
        return $this;
    }

    public function __toString()
    {
        return $this->getEmail() && $this->getEmail() !== 'anonymized'
            ? $this->getEmail()
            : $this->getUsername();
    }

    public function isEnabled()
    {
        if (null !== $this->getDeletedAt()) {
            return false;
        }
        return parent::isEnabled();
    }


}

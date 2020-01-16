<?php

namespace Ivoz\Provider\Domain\Model\AdministratorRelPublicSection;

/**
 * AdministratorRelPublicSection
 */
class AdministratorRelPublicSection extends AdministratorRelPublicSectionAbstract implements AdministratorRelPublicSectionInterface
{
    use AdministratorRelPublicSectionTrait;

    /**
     * @codeCoverageIgnore
     * @return array
     */
    public function getChangeSet()
    {
        return parent::getChangeSet();
    }

    /**
     * Get id
     * @codeCoverageIgnore
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }
}

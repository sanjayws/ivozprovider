<?php

namespace Ivoz\Provider\Domain\Model\AdministratorRelPublicSection;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;

interface AdministratorRelPublicSectionInterface extends LoggableEntityInterface
{
    /**
     * @codeCoverageIgnore
     * @return array
     */
    public function getChangeSet();

    /**
     * Set administrator
     *
     * @param \Ivoz\Provider\Domain\Model\Administrator\AdministratorInterface $administrator
     *
     * @return static
     */
    public function setAdministrator(\Ivoz\Provider\Domain\Model\Administrator\AdministratorInterface $administrator = null);

    /**
     * Get administrator
     *
     * @return \Ivoz\Provider\Domain\Model\Administrator\AdministratorInterface
     */
    public function getAdministrator();

    /**
     * Set publicSection
     *
     * @param \Ivoz\Provider\Domain\Model\AdministratorRelPublicSection\AdministratorRelPublicSectionInterface $publicSection
     *
     * @return static
     */
    public function setPublicSection(\Ivoz\Provider\Domain\Model\AdministratorRelPublicSection\AdministratorRelPublicSectionInterface $publicSection);

    /**
     * Get publicSection
     *
     * @return \Ivoz\Provider\Domain\Model\AdministratorRelPublicSection\AdministratorRelPublicSectionInterface
     */
    public function getPublicSection();
}

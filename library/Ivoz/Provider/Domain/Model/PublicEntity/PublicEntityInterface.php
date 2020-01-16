<?php

namespace Ivoz\Provider\Domain\Model\PublicEntity;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;

interface PublicEntityInterface extends LoggableEntityInterface
{
    /**
     * @codeCoverageIgnore
     * @return array
     */
    public function getChangeSet();

    /**
     * Get iden
     *
     * @return string
     */
    public function getIden();

    /**
     * Get fqdn
     *
     * @return string | null
     */
    public function getFqdn();

    /**
     * Get platform
     *
     * @return boolean
     */
    public function getPlatform();

    /**
     * Get brand
     *
     * @return boolean
     */
    public function getBrand();

    /**
     * Get client
     *
     * @return boolean
     */
    public function getClient();

    /**
     * Set name
     *
     * @param \Ivoz\Provider\Domain\Model\PublicEntity\Name $name
     *
     * @return static
     */
    public function setName(\Ivoz\Provider\Domain\Model\PublicEntity\Name $name);

    /**
     * Get name
     *
     * @return \Ivoz\Provider\Domain\Model\PublicEntity\Name
     */
    public function getName();
}

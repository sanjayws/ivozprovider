<?php

namespace Ivoz\Provider\Domain\Model\AdministratorRelPublicSection;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\Model\DtoNormalizer;

/**
 * @codeCoverageIgnore
 */
abstract class AdministratorRelPublicSectionDtoAbstract implements DataTransferObjectInterface
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var \Ivoz\Provider\Domain\Model\Administrator\AdministratorDto | null
     */
    private $administrator;

    /**
     * @var \Ivoz\Provider\Domain\Model\AdministratorRelPublicSection\AdministratorRelPublicSectionDto | null
     */
    private $publicSection;


    use DtoNormalizer;

    public function __construct($id = null)
    {
        $this->setId($id);
    }

    /**
     * @inheritdoc
     */
    public static function getPropertyMap(string $context = '', string $role = null)
    {
        if ($context === self::CONTEXT_COLLECTION) {
            return ['id' => 'id'];
        }

        return [
            'id' => 'id',
            'administratorId' => 'administrator',
            'publicSectionId' => 'publicSection'
        ];
    }

    /**
     * @return array
     */
    public function toArray($hideSensitiveData = false)
    {
        return [
            'id' => $this->getId(),
            'administrator' => $this->getAdministrator(),
            'publicSection' => $this->getPublicSection()
        ];
    }

    /**
     * @param integer $id
     *
     * @return static
     */
    public function setId($id = null)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param \Ivoz\Provider\Domain\Model\Administrator\AdministratorDto $administrator
     *
     * @return static
     */
    public function setAdministrator(\Ivoz\Provider\Domain\Model\Administrator\AdministratorDto $administrator = null)
    {
        $this->administrator = $administrator;

        return $this;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\Administrator\AdministratorDto
     */
    public function getAdministrator()
    {
        return $this->administrator;
    }

    /**
     * @param mixed | null $id
     *
     * @return static
     */
    public function setAdministratorId($id)
    {
        $value = !is_null($id)
            ? new \Ivoz\Provider\Domain\Model\Administrator\AdministratorDto($id)
            : null;

        return $this->setAdministrator($value);
    }

    /**
     * @return mixed | null
     */
    public function getAdministratorId()
    {
        if ($dto = $this->getAdministrator()) {
            return $dto->getId();
        }

        return null;
    }

    /**
     * @param \Ivoz\Provider\Domain\Model\AdministratorRelPublicSection\AdministratorRelPublicSectionDto $publicSection
     *
     * @return static
     */
    public function setPublicSection(AdministratorRelPublicSectionDto $publicSection = null)
    {
        $this->publicSection = $publicSection;

        return $this;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\AdministratorRelPublicSection\AdministratorRelPublicSectionDto
     */
    public function getPublicSection()
    {
        return $this->publicSection;
    }

    /**
     * @param mixed | null $id
     *
     * @return static
     */
    public function setPublicSectionId($id)
    {
        $value = !is_null($id)
            ? new \Ivoz\Provider\Domain\Model\AdministratorRelPublicSection\AdministratorRelPublicSectionDto($id)
            : null;

        return $this->setPublicSection($value);
    }

    /**
     * @return mixed | null
     */
    public function getPublicSectionId()
    {
        if ($dto = $this->getPublicSection()) {
            return $dto->getId();
        }

        return null;
    }
}

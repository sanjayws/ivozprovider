<?php

namespace Ivoz\Provider\Domain\Model\AdministratorRelPublicSection;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;

/**
 * AdministratorRelPublicSectionAbstract
 * @codeCoverageIgnore
 */
abstract class AdministratorRelPublicSectionAbstract
{
    /**
     * @var \Ivoz\Provider\Domain\Model\Administrator\AdministratorInterface
     */
    protected $administrator;

    /**
     * @var \Ivoz\Provider\Domain\Model\AdministratorRelPublicSection\AdministratorRelPublicSectionInterface
     */
    protected $publicSection;


    use ChangelogTrait;

    /**
     * Constructor
     */
    protected function __construct()
    {
    }

    abstract public function getId();

    public function __toString()
    {
        return sprintf(
            "%s#%s",
            "AdministratorRelPublicSection",
            $this->getId()
        );
    }

    /**
     * @return void
     * @throws \Exception
     */
    protected function sanitizeValues()
    {
    }

    /**
     * @param null $id
     * @return AdministratorRelPublicSectionDto
     */
    public static function createDto($id = null)
    {
        return new AdministratorRelPublicSectionDto($id);
    }

    /**
     * @internal use EntityTools instead
     * @param AdministratorRelPublicSectionInterface|null $entity
     * @param int $depth
     * @return AdministratorRelPublicSectionDto|null
     */
    public static function entityToDto(EntityInterface $entity = null, $depth = 0)
    {
        if (!$entity) {
            return null;
        }

        Assertion::isInstanceOf($entity, AdministratorRelPublicSectionInterface::class);

        if ($depth < 1) {
            return static::createDto($entity->getId());
        }

        if ($entity instanceof \Doctrine\ORM\Proxy\Proxy && !$entity->__isInitialized()) {
            return static::createDto($entity->getId());
        }

        /** @var AdministratorRelPublicSectionDto $dto */
        $dto = $entity->toDto($depth-1);

        return $dto;
    }

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param AdministratorRelPublicSectionDto $dto
     * @return self
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        \Ivoz\Core\Application\ForeignKeyTransformerInterface $fkTransformer
    ) {
        Assertion::isInstanceOf($dto, AdministratorRelPublicSectionDto::class);

        $self = new static();

        $self
            ->setAdministrator($fkTransformer->transform($dto->getAdministrator()))
            ->setPublicSection($fkTransformer->transform($dto->getPublicSection()))
        ;

        $self->initChangelog();

        return $self;
    }

    /**
     * @internal use EntityTools instead
     * @param AdministratorRelPublicSectionDto $dto
     * @return self
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        \Ivoz\Core\Application\ForeignKeyTransformerInterface $fkTransformer
    ) {
        Assertion::isInstanceOf($dto, AdministratorRelPublicSectionDto::class);

        $this
            ->setAdministrator($fkTransformer->transform($dto->getAdministrator()))
            ->setPublicSection($fkTransformer->transform($dto->getPublicSection()));



        return $this;
    }

    /**
     * @internal use EntityTools instead
     * @param int $depth
     * @return AdministratorRelPublicSectionDto
     */
    public function toDto($depth = 0)
    {
        return self::createDto()
            ->setAdministrator(\Ivoz\Provider\Domain\Model\Administrator\Administrator::entityToDto(self::getAdministrator(), $depth))
            ->setPublicSection(\Ivoz\Provider\Domain\Model\AdministratorRelPublicSection\AdministratorRelPublicSection::entityToDto(self::getPublicSection(), $depth));
    }

    /**
     * @return array
     */
    protected function __toArray()
    {
        return [
            'administratorId' => self::getAdministrator() ? self::getAdministrator()->getId() : null,
            'publicSectionId' => self::getPublicSection() ? self::getPublicSection()->getId() : null
        ];
    }
    // @codeCoverageIgnoreStart

    /**
     * Set administrator
     *
     * @param \Ivoz\Provider\Domain\Model\Administrator\AdministratorInterface $administrator
     *
     * @return static
     */
    public function setAdministrator(\Ivoz\Provider\Domain\Model\Administrator\AdministratorInterface $administrator = null)
    {
        $this->administrator = $administrator;

        return $this;
    }

    /**
     * Get administrator
     *
     * @return \Ivoz\Provider\Domain\Model\Administrator\AdministratorInterface
     */
    public function getAdministrator()
    {
        return $this->administrator;
    }

    /**
     * Set publicSection
     *
     * @param \Ivoz\Provider\Domain\Model\AdministratorRelPublicSection\AdministratorRelPublicSectionInterface $publicSection
     *
     * @return static
     */
    public function setPublicSection(AdministratorRelPublicSectionInterface $publicSection)
    {
        $this->publicSection = $publicSection;

        return $this;
    }

    /**
     * Get publicSection
     *
     * @return \Ivoz\Provider\Domain\Model\AdministratorRelPublicSection\AdministratorRelPublicSectionInterface
     */
    public function getPublicSection()
    {
        return $this->publicSection;
    }

    // @codeCoverageIgnoreEnd
}

<?php

namespace Ivoz\Provider\Domain\Model\IvrExcludedExtension;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;

/**
 * IvrExcludedExtensionAbstract
 * @codeCoverageIgnore
 */
abstract class IvrExcludedExtensionAbstract
{
    /**
     * @var \Ivoz\Provider\Domain\Model\Ivr\IvrInterface | null
     */
    protected $ivr;

    /**
     * @var \Ivoz\Provider\Domain\Model\Extension\ExtensionInterface
     */
    protected $extension;


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
            "IvrExcludedExtension",
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
     * @return IvrExcludedExtensionDto
     */
    public static function createDto($id = null)
    {
        return new IvrExcludedExtensionDto($id);
    }

    /**
     * @internal use EntityTools instead
     * @param IvrExcludedExtensionInterface|null $entity
     * @param int $depth
     * @return IvrExcludedExtensionDto|null
     */
    public static function entityToDto(EntityInterface $entity = null, $depth = 0)
    {
        if (!$entity) {
            return null;
        }

        Assertion::isInstanceOf($entity, IvrExcludedExtensionInterface::class);

        if ($depth < 1) {
            return static::createDto($entity->getId());
        }

        if ($entity instanceof \Doctrine\ORM\Proxy\Proxy && !$entity->__isInitialized()) {
            return static::createDto($entity->getId());
        }

        /** @var IvrExcludedExtensionDto $dto */
        $dto = $entity->toDto($depth-1);

        return $dto;
    }

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param IvrExcludedExtensionDto $dto
     * @return self
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        \Ivoz\Core\Application\ForeignKeyTransformerInterface $fkTransformer
    ) {
        Assertion::isInstanceOf($dto, IvrExcludedExtensionDto::class);

        $self = new static();

        $self
            ->setIvr($fkTransformer->transform($dto->getIvr()))
            ->setExtension($fkTransformer->transform($dto->getExtension()))
        ;

        $self->initChangelog();

        return $self;
    }

    /**
     * @internal use EntityTools instead
     * @param IvrExcludedExtensionDto $dto
     * @return self
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        \Ivoz\Core\Application\ForeignKeyTransformerInterface $fkTransformer
    ) {
        Assertion::isInstanceOf($dto, IvrExcludedExtensionDto::class);

        $this
            ->setIvr($fkTransformer->transform($dto->getIvr()))
            ->setExtension($fkTransformer->transform($dto->getExtension()));



        return $this;
    }

    /**
     * @internal use EntityTools instead
     * @param int $depth
     * @return IvrExcludedExtensionDto
     */
    public function toDto($depth = 0)
    {
        return self::createDto()
            ->setIvr(\Ivoz\Provider\Domain\Model\Ivr\Ivr::entityToDto(self::getIvr(), $depth))
            ->setExtension(\Ivoz\Provider\Domain\Model\Extension\Extension::entityToDto(self::getExtension(), $depth));
    }

    /**
     * @return array
     */
    protected function __toArray()
    {
        return [
            'ivrId' => self::getIvr() ? self::getIvr()->getId() : null,
            'extensionId' => self::getExtension()->getId()
        ];
    }
    // @codeCoverageIgnoreStart

    /**
     * Set ivr
     *
     * @param \Ivoz\Provider\Domain\Model\Ivr\IvrInterface $ivr | null
     *
     * @return static
     */
    public function setIvr(\Ivoz\Provider\Domain\Model\Ivr\IvrInterface $ivr = null)
    {
        $this->ivr = $ivr;

        return $this;
    }

    /**
     * Get ivr
     *
     * @return \Ivoz\Provider\Domain\Model\Ivr\IvrInterface | null
     */
    public function getIvr()
    {
        return $this->ivr;
    }

    /**
     * Set extension
     *
     * @param \Ivoz\Provider\Domain\Model\Extension\ExtensionInterface $extension
     *
     * @return static
     */
    protected function setExtension(\Ivoz\Provider\Domain\Model\Extension\ExtensionInterface $extension)
    {
        $this->extension = $extension;

        return $this;
    }

    /**
     * Get extension
     *
     * @return \Ivoz\Provider\Domain\Model\Extension\ExtensionInterface
     */
    public function getExtension()
    {
        return $this->extension;
    }

    // @codeCoverageIgnoreEnd
}

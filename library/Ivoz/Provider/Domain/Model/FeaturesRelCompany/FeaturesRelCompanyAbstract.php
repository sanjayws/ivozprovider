<?php

namespace Ivoz\Provider\Domain\Model\FeaturesRelCompany;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;

/**
 * FeaturesRelCompanyAbstract
 * @codeCoverageIgnore
 */
abstract class FeaturesRelCompanyAbstract
{
    /**
     * @var \Ivoz\Provider\Domain\Model\Company\CompanyInterface | null
     */
    protected $company;

    /**
     * @var \Ivoz\Provider\Domain\Model\Feature\FeatureInterface
     */
    protected $feature;


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
            "FeaturesRelCompany",
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
     * @return FeaturesRelCompanyDto
     */
    public static function createDto($id = null)
    {
        return new FeaturesRelCompanyDto($id);
    }

    /**
     * @internal use EntityTools instead
     * @param FeaturesRelCompanyInterface|null $entity
     * @param int $depth
     * @return FeaturesRelCompanyDto|null
     */
    public static function entityToDto(EntityInterface $entity = null, $depth = 0)
    {
        if (!$entity) {
            return null;
        }

        Assertion::isInstanceOf($entity, FeaturesRelCompanyInterface::class);

        if ($depth < 1) {
            return static::createDto($entity->getId());
        }

        if ($entity instanceof \Doctrine\ORM\Proxy\Proxy && !$entity->__isInitialized()) {
            return static::createDto($entity->getId());
        }

        /** @var FeaturesRelCompanyDto $dto */
        $dto = $entity->toDto($depth-1);

        return $dto;
    }

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param FeaturesRelCompanyDto $dto
     * @return self
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        \Ivoz\Core\Application\ForeignKeyTransformerInterface $fkTransformer
    ) {
        Assertion::isInstanceOf($dto, FeaturesRelCompanyDto::class);

        $self = new static();

        $self
            ->setCompany($fkTransformer->transform($dto->getCompany()))
            ->setFeature($fkTransformer->transform($dto->getFeature()))
        ;

        $self->initChangelog();

        return $self;
    }

    /**
     * @internal use EntityTools instead
     * @param FeaturesRelCompanyDto $dto
     * @return self
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        \Ivoz\Core\Application\ForeignKeyTransformerInterface $fkTransformer
    ) {
        Assertion::isInstanceOf($dto, FeaturesRelCompanyDto::class);

        $this
            ->setCompany($fkTransformer->transform($dto->getCompany()))
            ->setFeature($fkTransformer->transform($dto->getFeature()));



        return $this;
    }

    /**
     * @internal use EntityTools instead
     * @param int $depth
     * @return FeaturesRelCompanyDto
     */
    public function toDto($depth = 0)
    {
        return self::createDto()
            ->setCompany(\Ivoz\Provider\Domain\Model\Company\Company::entityToDto(self::getCompany(), $depth))
            ->setFeature(\Ivoz\Provider\Domain\Model\Feature\Feature::entityToDto(self::getFeature(), $depth));
    }

    /**
     * @return array
     */
    protected function __toArray()
    {
        return [
            'companyId' => self::getCompany() ? self::getCompany()->getId() : null,
            'featureId' => self::getFeature()->getId()
        ];
    }
    // @codeCoverageIgnoreStart

    /**
     * Set company
     *
     * @param \Ivoz\Provider\Domain\Model\Company\CompanyInterface $company | null
     *
     * @return static
     */
    public function setCompany(\Ivoz\Provider\Domain\Model\Company\CompanyInterface $company = null)
    {
        $this->company = $company;

        return $this;
    }

    /**
     * Get company
     *
     * @return \Ivoz\Provider\Domain\Model\Company\CompanyInterface | null
     */
    public function getCompany()
    {
        return $this->company;
    }

    /**
     * Set feature
     *
     * @param \Ivoz\Provider\Domain\Model\Feature\FeatureInterface $feature
     *
     * @return static
     */
    protected function setFeature(\Ivoz\Provider\Domain\Model\Feature\FeatureInterface $feature)
    {
        $this->feature = $feature;

        return $this;
    }

    /**
     * Get feature
     *
     * @return \Ivoz\Provider\Domain\Model\Feature\FeatureInterface
     */
    public function getFeature()
    {
        return $this->feature;
    }

    // @codeCoverageIgnoreEnd
}

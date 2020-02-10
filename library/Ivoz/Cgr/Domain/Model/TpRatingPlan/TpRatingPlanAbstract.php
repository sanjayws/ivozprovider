<?php

namespace Ivoz\Cgr\Domain\Model\TpRatingPlan;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;

/**
 * TpRatingPlanAbstract
 * @codeCoverageIgnore
 */
abstract class TpRatingPlanAbstract
{
    /**
     * @var string
     */
    protected $tpid = 'ivozprovider';

    /**
     * @var string | null
     */
    protected $tag;

    /**
     * column: destrates_tag
     * @var string | null
     */
    protected $destratesTag;

    /**
     * column: timing_tag
     * @var string
     */
    protected $timingTag = '*any';

    /**
     * @var float
     */
    protected $weight = 10;

    /**
     * column: created_at
     * @var \DateTime
     */
    protected $createdAt;

    /**
     * @var \Ivoz\Provider\Domain\Model\RatingPlan\RatingPlanInterface
     */
    protected $ratingPlan;


    use ChangelogTrait;

    /**
     * Constructor
     */
    protected function __construct($tpid, $timingTag, $weight, $createdAt)
    {
        $this->setTpid($tpid);
        $this->setTimingTag($timingTag);
        $this->setWeight($weight);
        $this->setCreatedAt($createdAt);
    }

    abstract public function getId();

    public function __toString()
    {
        return sprintf(
            "%s#%s",
            "TpRatingPlan",
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
     * @return TpRatingPlanDto
     */
    public static function createDto($id = null)
    {
        return new TpRatingPlanDto($id);
    }

    /**
     * @internal use EntityTools instead
     * @param TpRatingPlanInterface|null $entity
     * @param int $depth
     * @return TpRatingPlanDto|null
     */
    public static function entityToDto(EntityInterface $entity = null, $depth = 0)
    {
        if (!$entity) {
            return null;
        }

        Assertion::isInstanceOf($entity, TpRatingPlanInterface::class);

        if ($depth < 1) {
            return static::createDto($entity->getId());
        }

        if ($entity instanceof \Doctrine\ORM\Proxy\Proxy && !$entity->__isInitialized()) {
            return static::createDto($entity->getId());
        }

        /** @var TpRatingPlanDto $dto */
        $dto = $entity->toDto($depth-1);

        return $dto;
    }

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param TpRatingPlanDto $dto
     * @return self
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        \Ivoz\Core\Application\ForeignKeyTransformerInterface $fkTransformer
    ) {
        Assertion::isInstanceOf($dto, TpRatingPlanDto::class);

        $self = new static(
            $dto->getTpid(),
            $dto->getTimingTag(),
            $dto->getWeight(),
            $dto->getCreatedAt()
        );

        $self
            ->setTag($dto->getTag())
            ->setDestratesTag($dto->getDestratesTag())
            ->setRatingPlan($fkTransformer->transform($dto->getRatingPlan()))
        ;

        $self->initChangelog();

        return $self;
    }

    /**
     * @internal use EntityTools instead
     * @param TpRatingPlanDto $dto
     * @return self
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        \Ivoz\Core\Application\ForeignKeyTransformerInterface $fkTransformer
    ) {
        Assertion::isInstanceOf($dto, TpRatingPlanDto::class);

        $this
            ->setTpid($dto->getTpid())
            ->setTag($dto->getTag())
            ->setDestratesTag($dto->getDestratesTag())
            ->setTimingTag($dto->getTimingTag())
            ->setWeight($dto->getWeight())
            ->setCreatedAt($dto->getCreatedAt())
            ->setRatingPlan($fkTransformer->transform($dto->getRatingPlan()));



        return $this;
    }

    /**
     * @internal use EntityTools instead
     * @param int $depth
     * @return TpRatingPlanDto
     */
    public function toDto($depth = 0)
    {
        return self::createDto()
            ->setTpid(self::getTpid())
            ->setTag(self::getTag())
            ->setDestratesTag(self::getDestratesTag())
            ->setTimingTag(self::getTimingTag())
            ->setWeight(self::getWeight())
            ->setCreatedAt(self::getCreatedAt())
            ->setRatingPlan(\Ivoz\Provider\Domain\Model\RatingPlan\RatingPlan::entityToDto(self::getRatingPlan(), $depth));
    }

    /**
     * @return array
     */
    protected function __toArray()
    {
        return [
            'tpid' => self::getTpid(),
            'tag' => self::getTag(),
            'destrates_tag' => self::getDestratesTag(),
            'timing_tag' => self::getTimingTag(),
            'weight' => self::getWeight(),
            'created_at' => self::getCreatedAt(),
            'ratingPlanId' => self::getRatingPlan()->getId()
        ];
    }
    // @codeCoverageIgnoreStart

    /**
     * Set tpid
     *
     * @param string $tpid
     *
     * @return static
     */
    protected function setTpid($tpid)
    {
        Assertion::notNull($tpid, 'tpid value "%s" is null, but non null value was expected.');
        Assertion::maxLength($tpid, 64, 'tpid value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->tpid = $tpid;

        return $this;
    }

    /**
     * Get tpid
     *
     * @return string
     */
    public function getTpid()
    {
        return $this->tpid;
    }

    /**
     * Set tag
     *
     * @param string $tag | null
     *
     * @return static
     */
    protected function setTag($tag = null)
    {
        if (!is_null($tag)) {
            Assertion::maxLength($tag, 64, 'tag value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->tag = $tag;

        return $this;
    }

    /**
     * Get tag
     *
     * @return string | null
     */
    public function getTag()
    {
        return $this->tag;
    }

    /**
     * Set destratesTag
     *
     * @param string $destratesTag | null
     *
     * @return static
     */
    protected function setDestratesTag($destratesTag = null)
    {
        if (!is_null($destratesTag)) {
            Assertion::maxLength($destratesTag, 64, 'destratesTag value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->destratesTag = $destratesTag;

        return $this;
    }

    /**
     * Get destratesTag
     *
     * @return string | null
     */
    public function getDestratesTag()
    {
        return $this->destratesTag;
    }

    /**
     * Set timingTag
     *
     * @param string $timingTag
     *
     * @return static
     */
    protected function setTimingTag($timingTag)
    {
        Assertion::notNull($timingTag, 'timingTag value "%s" is null, but non null value was expected.');
        Assertion::maxLength($timingTag, 64, 'timingTag value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->timingTag = $timingTag;

        return $this;
    }

    /**
     * Get timingTag
     *
     * @return string
     */
    public function getTimingTag()
    {
        return $this->timingTag;
    }

    /**
     * Set weight
     *
     * @param float $weight
     *
     * @return static
     */
    protected function setWeight($weight)
    {
        Assertion::notNull($weight, 'weight value "%s" is null, but non null value was expected.');
        Assertion::numeric($weight);

        $this->weight = (float) $weight;

        return $this;
    }

    /**
     * Get weight
     *
     * @return float
     */
    public function getWeight()
    {
        return $this->weight;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return static
     */
    protected function setCreatedAt($createdAt)
    {
        Assertion::notNull($createdAt, 'createdAt value "%s" is null, but non null value was expected.');
        $createdAt = \Ivoz\Core\Domain\Model\Helper\DateTimeHelper::createOrFix(
            $createdAt,
            'CURRENT_TIMESTAMP'
        );

        if ($this->createdAt == $createdAt) {
            return $this;
        }

        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return clone $this->createdAt;
    }

    /**
     * Set ratingPlan
     *
     * @param \Ivoz\Provider\Domain\Model\RatingPlan\RatingPlanInterface $ratingPlan
     *
     * @return static
     */
    public function setRatingPlan(\Ivoz\Provider\Domain\Model\RatingPlan\RatingPlanInterface $ratingPlan)
    {
        $this->ratingPlan = $ratingPlan;

        return $this;
    }

    /**
     * Get ratingPlan
     *
     * @return \Ivoz\Provider\Domain\Model\RatingPlan\RatingPlanInterface
     */
    public function getRatingPlan()
    {
        return $this->ratingPlan;
    }

    // @codeCoverageIgnoreEnd
}

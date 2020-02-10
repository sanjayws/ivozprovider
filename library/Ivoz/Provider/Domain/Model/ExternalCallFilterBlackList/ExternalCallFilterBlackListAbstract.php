<?php

namespace Ivoz\Provider\Domain\Model\ExternalCallFilterBlackList;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;

/**
 * ExternalCallFilterBlackListAbstract
 * @codeCoverageIgnore
 */
abstract class ExternalCallFilterBlackListAbstract
{
    /**
     * @var \Ivoz\Provider\Domain\Model\ExternalCallFilter\ExternalCallFilterInterface | null
     */
    protected $filter;

    /**
     * @var \Ivoz\Provider\Domain\Model\MatchList\MatchListInterface
     */
    protected $matchlist;


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
            "ExternalCallFilterBlackList",
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
     * @return ExternalCallFilterBlackListDto
     */
    public static function createDto($id = null)
    {
        return new ExternalCallFilterBlackListDto($id);
    }

    /**
     * @internal use EntityTools instead
     * @param ExternalCallFilterBlackListInterface|null $entity
     * @param int $depth
     * @return ExternalCallFilterBlackListDto|null
     */
    public static function entityToDto(EntityInterface $entity = null, $depth = 0)
    {
        if (!$entity) {
            return null;
        }

        Assertion::isInstanceOf($entity, ExternalCallFilterBlackListInterface::class);

        if ($depth < 1) {
            return static::createDto($entity->getId());
        }

        if ($entity instanceof \Doctrine\ORM\Proxy\Proxy && !$entity->__isInitialized()) {
            return static::createDto($entity->getId());
        }

        /** @var ExternalCallFilterBlackListDto $dto */
        $dto = $entity->toDto($depth-1);

        return $dto;
    }

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param ExternalCallFilterBlackListDto $dto
     * @return self
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        \Ivoz\Core\Application\ForeignKeyTransformerInterface $fkTransformer
    ) {
        Assertion::isInstanceOf($dto, ExternalCallFilterBlackListDto::class);

        $self = new static();

        $self
            ->setFilter($fkTransformer->transform($dto->getFilter()))
            ->setMatchlist($fkTransformer->transform($dto->getMatchlist()))
        ;

        $self->initChangelog();

        return $self;
    }

    /**
     * @internal use EntityTools instead
     * @param ExternalCallFilterBlackListDto $dto
     * @return self
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        \Ivoz\Core\Application\ForeignKeyTransformerInterface $fkTransformer
    ) {
        Assertion::isInstanceOf($dto, ExternalCallFilterBlackListDto::class);

        $this
            ->setFilter($fkTransformer->transform($dto->getFilter()))
            ->setMatchlist($fkTransformer->transform($dto->getMatchlist()));



        return $this;
    }

    /**
     * @internal use EntityTools instead
     * @param int $depth
     * @return ExternalCallFilterBlackListDto
     */
    public function toDto($depth = 0)
    {
        return self::createDto()
            ->setFilter(\Ivoz\Provider\Domain\Model\ExternalCallFilter\ExternalCallFilter::entityToDto(self::getFilter(), $depth))
            ->setMatchlist(\Ivoz\Provider\Domain\Model\MatchList\MatchList::entityToDto(self::getMatchlist(), $depth));
    }

    /**
     * @return array
     */
    protected function __toArray()
    {
        return [
            'filterId' => self::getFilter() ? self::getFilter()->getId() : null,
            'matchlistId' => self::getMatchlist()->getId()
        ];
    }
    // @codeCoverageIgnoreStart

    /**
     * Set filter
     *
     * @param \Ivoz\Provider\Domain\Model\ExternalCallFilter\ExternalCallFilterInterface $filter | null
     *
     * @return static
     */
    public function setFilter(\Ivoz\Provider\Domain\Model\ExternalCallFilter\ExternalCallFilterInterface $filter = null)
    {
        $this->filter = $filter;

        return $this;
    }

    /**
     * Get filter
     *
     * @return \Ivoz\Provider\Domain\Model\ExternalCallFilter\ExternalCallFilterInterface | null
     */
    public function getFilter()
    {
        return $this->filter;
    }

    /**
     * Set matchlist
     *
     * @param \Ivoz\Provider\Domain\Model\MatchList\MatchListInterface $matchlist
     *
     * @return static
     */
    protected function setMatchlist(\Ivoz\Provider\Domain\Model\MatchList\MatchListInterface $matchlist)
    {
        $this->matchlist = $matchlist;

        return $this;
    }

    /**
     * Get matchlist
     *
     * @return \Ivoz\Provider\Domain\Model\MatchList\MatchListInterface
     */
    public function getMatchlist()
    {
        return $this->matchlist;
    }

    // @codeCoverageIgnoreEnd
}

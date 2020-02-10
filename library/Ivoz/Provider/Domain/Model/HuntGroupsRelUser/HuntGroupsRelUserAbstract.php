<?php

namespace Ivoz\Provider\Domain\Model\HuntGroupsRelUser;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;

/**
 * HuntGroupsRelUserAbstract
 * @codeCoverageIgnore
 */
abstract class HuntGroupsRelUserAbstract
{
    /**
     * @var integer | null
     */
    protected $timeoutTime;

    /**
     * @var integer | null
     */
    protected $priority;

    /**
     * @var \Ivoz\Provider\Domain\Model\HuntGroup\HuntGroupInterface | null
     */
    protected $huntGroup;

    /**
     * @var \Ivoz\Provider\Domain\Model\User\UserInterface
     */
    protected $user;


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
            "HuntGroupsRelUser",
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
     * @return HuntGroupsRelUserDto
     */
    public static function createDto($id = null)
    {
        return new HuntGroupsRelUserDto($id);
    }

    /**
     * @internal use EntityTools instead
     * @param HuntGroupsRelUserInterface|null $entity
     * @param int $depth
     * @return HuntGroupsRelUserDto|null
     */
    public static function entityToDto(EntityInterface $entity = null, $depth = 0)
    {
        if (!$entity) {
            return null;
        }

        Assertion::isInstanceOf($entity, HuntGroupsRelUserInterface::class);

        if ($depth < 1) {
            return static::createDto($entity->getId());
        }

        if ($entity instanceof \Doctrine\ORM\Proxy\Proxy && !$entity->__isInitialized()) {
            return static::createDto($entity->getId());
        }

        /** @var HuntGroupsRelUserDto $dto */
        $dto = $entity->toDto($depth-1);

        return $dto;
    }

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param HuntGroupsRelUserDto $dto
     * @return self
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        \Ivoz\Core\Application\ForeignKeyTransformerInterface $fkTransformer
    ) {
        Assertion::isInstanceOf($dto, HuntGroupsRelUserDto::class);

        $self = new static();

        $self
            ->setTimeoutTime($dto->getTimeoutTime())
            ->setPriority($dto->getPriority())
            ->setHuntGroup($fkTransformer->transform($dto->getHuntGroup()))
            ->setUser($fkTransformer->transform($dto->getUser()))
        ;

        $self->initChangelog();

        return $self;
    }

    /**
     * @internal use EntityTools instead
     * @param HuntGroupsRelUserDto $dto
     * @return self
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        \Ivoz\Core\Application\ForeignKeyTransformerInterface $fkTransformer
    ) {
        Assertion::isInstanceOf($dto, HuntGroupsRelUserDto::class);

        $this
            ->setTimeoutTime($dto->getTimeoutTime())
            ->setPriority($dto->getPriority())
            ->setHuntGroup($fkTransformer->transform($dto->getHuntGroup()))
            ->setUser($fkTransformer->transform($dto->getUser()));



        return $this;
    }

    /**
     * @internal use EntityTools instead
     * @param int $depth
     * @return HuntGroupsRelUserDto
     */
    public function toDto($depth = 0)
    {
        return self::createDto()
            ->setTimeoutTime(self::getTimeoutTime())
            ->setPriority(self::getPriority())
            ->setHuntGroup(\Ivoz\Provider\Domain\Model\HuntGroup\HuntGroup::entityToDto(self::getHuntGroup(), $depth))
            ->setUser(\Ivoz\Provider\Domain\Model\User\User::entityToDto(self::getUser(), $depth));
    }

    /**
     * @return array
     */
    protected function __toArray()
    {
        return [
            'timeoutTime' => self::getTimeoutTime(),
            'priority' => self::getPriority(),
            'huntGroupId' => self::getHuntGroup() ? self::getHuntGroup()->getId() : null,
            'userId' => self::getUser()->getId()
        ];
    }
    // @codeCoverageIgnoreStart

    /**
     * Set timeoutTime
     *
     * @param integer $timeoutTime | null
     *
     * @return static
     */
    protected function setTimeoutTime($timeoutTime = null)
    {
        if (!is_null($timeoutTime)) {
            Assertion::integerish($timeoutTime, 'timeoutTime value "%s" is not an integer or a number castable to integer.');
            $timeoutTime = (int) $timeoutTime;
        }

        $this->timeoutTime = $timeoutTime;

        return $this;
    }

    /**
     * Get timeoutTime
     *
     * @return integer | null
     */
    public function getTimeoutTime()
    {
        return $this->timeoutTime;
    }

    /**
     * Set priority
     *
     * @param integer $priority | null
     *
     * @return static
     */
    protected function setPriority($priority = null)
    {
        if (!is_null($priority)) {
            Assertion::integerish($priority, 'priority value "%s" is not an integer or a number castable to integer.');
            $priority = (int) $priority;
        }

        $this->priority = $priority;

        return $this;
    }

    /**
     * Get priority
     *
     * @return integer | null
     */
    public function getPriority()
    {
        return $this->priority;
    }

    /**
     * Set huntGroup
     *
     * @param \Ivoz\Provider\Domain\Model\HuntGroup\HuntGroupInterface $huntGroup | null
     *
     * @return static
     */
    public function setHuntGroup(\Ivoz\Provider\Domain\Model\HuntGroup\HuntGroupInterface $huntGroup = null)
    {
        $this->huntGroup = $huntGroup;

        return $this;
    }

    /**
     * Get huntGroup
     *
     * @return \Ivoz\Provider\Domain\Model\HuntGroup\HuntGroupInterface | null
     */
    public function getHuntGroup()
    {
        return $this->huntGroup;
    }

    /**
     * Set user
     *
     * @param \Ivoz\Provider\Domain\Model\User\UserInterface $user
     *
     * @return static
     */
    protected function setUser(\Ivoz\Provider\Domain\Model\User\UserInterface $user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \Ivoz\Provider\Domain\Model\User\UserInterface
     */
    public function getUser()
    {
        return $this->user;
    }

    // @codeCoverageIgnoreEnd
}

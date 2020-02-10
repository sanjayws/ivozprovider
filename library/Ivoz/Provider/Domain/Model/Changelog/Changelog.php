<?php

namespace Ivoz\Provider\Domain\Model\Changelog;

use Ivoz\Core\Domain\Event\EntityEventInterface;
use Ivoz\Core\Domain\Model\LoggerEntityInterface;

/**
 * Changelog
 */
class Changelog extends ChangelogAbstract implements LoggerEntityInterface, ChangelogInterface
{
    use ChangelogTrait;

    /**
     * @param \Ivoz\Core\Domain\Event\EntityEventInterface $event
     * @return self
     */
    public static function fromEvent(EntityEventInterface $event)
    {
        $entity = new static(
            $event->getEntityClass(),
            (string) $event->getEntityId(),
            $event->getOccurredOn(),
            $event->getMicrotime()
        );

        $entity->id = $event->getId();
        $entity->setData(
            $event->getData()
        );

        return $entity;
    }

    /**
     * Set command
     *
     * @param \Ivoz\Provider\Domain\Model\Commandlog\CommandlogInterface $command
     *
     * @return static
     */
    public function setCommand(\Ivoz\Provider\Domain\Model\Commandlog\CommandlogInterface $command)
    {
        return parent::setCommand($command);
    }

    /**
     * Get id
     * @codeCoverageIgnore
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }
}

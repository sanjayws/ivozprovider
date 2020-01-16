<?php

namespace Ivoz\Provider\Domain\Model\Administrator;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Criteria;

/**
 * AdministratorTrait
 * @codeCoverageIgnore
 */
trait AdministratorTrait
{
    /**
     * @var integer
     */
    protected $id;

    /**
     * @var ArrayCollection
     */
    protected $relPublicSections;


    /**
     * Constructor
     */
    protected function __construct()
    {
        parent::__construct(...func_get_args());
        $this->relPublicSections = new ArrayCollection();
    }

    abstract protected function sanitizeValues();

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param AdministratorDto $dto
     * @param \Ivoz\Core\Application\ForeignKeyTransformerInterface  $fkTransformer
     * @return static
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        \Ivoz\Core\Application\ForeignKeyTransformerInterface $fkTransformer
    ) {
        /** @var static $self */
        $self = parent::fromDto($dto, $fkTransformer);
        if (!is_null($dto->getRelPublicSections())) {
            $self->replaceRelPublicSections(
                $fkTransformer->transformCollection(
                    $dto->getRelPublicSections()
                )
            );
        }
        $self->sanitizeValues();
        if ($dto->getId()) {
            $self->id = $dto->getId();
            $self->initChangelog();
        }

        return $self;
    }

    /**
     * @internal use EntityTools instead
     * @param AdministratorDto $dto
     * @param \Ivoz\Core\Application\ForeignKeyTransformerInterface  $fkTransformer
     * @return static
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        \Ivoz\Core\Application\ForeignKeyTransformerInterface $fkTransformer
    ) {
        parent::updateFromDto($dto, $fkTransformer);
        if (!is_null($dto->getRelPublicSections())) {
            $this->replaceRelPublicSections(
                $fkTransformer->transformCollection(
                    $dto->getRelPublicSections()
                )
            );
        }
        $this->sanitizeValues();

        return $this;
    }

    /**
     * @internal use EntityTools instead
     * @param int $depth
     * @return AdministratorDto
     */
    public function toDto($depth = 0)
    {
        $dto = parent::toDto($depth);
        return $dto
            ->setId($this->getId());
    }

    /**
     * @return array
     */
    protected function __toArray()
    {
        return parent::__toArray() + [
            'id' => self::getId()
        ];
    }
    /**
     * Add relPublicSection
     *
     * @param \Ivoz\Provider\Domain\Model\AdministratorRelPublicSection\AdministratorRelPublicSectionInterface $relPublicSection
     *
     * @return static
     */
    public function addRelPublicSection(\Ivoz\Provider\Domain\Model\AdministratorRelPublicSection\AdministratorRelPublicSectionInterface $relPublicSection)
    {
        $this->relPublicSections->add($relPublicSection);

        return $this;
    }

    /**
     * Remove relPublicSection
     *
     * @param \Ivoz\Provider\Domain\Model\AdministratorRelPublicSection\AdministratorRelPublicSectionInterface $relPublicSection
     */
    public function removeRelPublicSection(\Ivoz\Provider\Domain\Model\AdministratorRelPublicSection\AdministratorRelPublicSectionInterface $relPublicSection)
    {
        $this->relPublicSections->removeElement($relPublicSection);
    }

    /**
     * Replace relPublicSections
     *
     * @param ArrayCollection $relPublicSections of Ivoz\Provider\Domain\Model\AdministratorRelPublicSection\AdministratorRelPublicSectionInterface
     * @return static
     */
    public function replaceRelPublicSections(ArrayCollection $relPublicSections)
    {
        $updatedEntities = [];
        $fallBackId = -1;
        foreach ($relPublicSections as $entity) {
            $index = $entity->getId() ? $entity->getId() : $fallBackId--;
            $updatedEntities[$index] = $entity;
            $entity->setAdministrator($this);
        }
        $updatedEntityKeys = array_keys($updatedEntities);

        foreach ($this->relPublicSections as $key => $entity) {
            $identity = $entity->getId();
            if (in_array($identity, $updatedEntityKeys)) {
                $this->relPublicSections->set($key, $updatedEntities[$identity]);
            } else {
                $this->relPublicSections->remove($key);
            }
            unset($updatedEntities[$identity]);
        }

        foreach ($updatedEntities as $entity) {
            $this->addRelPublicSection($entity);
        }

        return $this;
    }

    /**
     * Get relPublicSections
     * @param Criteria | null $criteria
     * @return \Ivoz\Provider\Domain\Model\AdministratorRelPublicSection\AdministratorRelPublicSectionInterface[]
     */
    public function getRelPublicSections(Criteria $criteria = null)
    {
        if (!is_null($criteria)) {
            return $this->relPublicSections->matching($criteria)->toArray();
        }

        return $this->relPublicSections->toArray();
    }
}

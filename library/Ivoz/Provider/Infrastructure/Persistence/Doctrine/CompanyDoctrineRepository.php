<?php

namespace Ivoz\Provider\Infrastructure\Persistence\Doctrine;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Ivoz\Provider\Domain\Model\Administrator\AdministratorInterface;
use Ivoz\Provider\Domain\Model\Company\Company;
use Ivoz\Provider\Domain\Model\Company\CompanyRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * CompanyDoctrineRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class CompanyDoctrineRepository extends ServiceEntityRepository implements CompanyRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Company::class);
    }

    /**
     * @inheritdoc
     */
    public function findIdsByBrandId($id)
    {
        $qb = $this->createQueryBuilder('self');
        $expression = $qb->expr();

        $qb
            ->select('self.id')
            ->where(
                $expression->eq('self.brand', $id)
            );

        $result = $qb
            ->getQuery()
            ->getScalarResult();

        return array_map(
            function ($row) {
                return intval($row['id']);
            },
            $result
        );
    }

    /**
     * Used by brand API access controls
     * @inheritdoc
     * @see \Ivoz\Provider\Domain\Model\Company\CompanyRepository::getSupervisedCompanyIdsByAdmin
     */
    public function getSupervisedCompanyIdsByAdmin(AdministratorInterface $admin)
    {
        if (!$admin->isBrandAdmin()) {
            throw new \DomainException('User must be brand admin at least');
        }

        if (!$admin->getBrand()) {
            return [];
        }

        $qb = $this->createQueryBuilder('self');
        $expression = $qb->expr();

        $qb
            ->select('self.id')
            ->where(
                $expression->eq('self.brand', $admin->getBrand()->getId())
            );

        $result = $qb->getQuery()->getScalarResult();

        return array_column($result, 'id');
    }

    /**
     * @inheritdoc
     * @see \Ivoz\Provider\Domain\Model\Company\CompanyRepository::getPrepaidCompanies
     */
    public function getPrepaidCompanies()
    {
        $qb = $this->createQueryBuilder('c');

        $query = $qb
            ->select('c')
            ->where(
                $qb->expr()->in('c.billingMethod', ['prepaid', 'pseudoprepaid'])
            )
            ->getQuery();

        return $query->getResult();
    }
}

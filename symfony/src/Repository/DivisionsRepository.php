<?php

namespace App\Repository;

use App\Entity\Divisions;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Divisions>
 *
 * @method Divisions|null find($id, $lockMode = null, $lockVersion = null)
 * @method Divisions|null findOneBy(array $criteria, array $orderBy = null)
 * @method Divisions[]    findAll()
 * @method Divisions[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DivisionsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Divisions::class);
    }

    public function add(Divisions $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Divisions $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function transform(Divisions $division)
    {
        return [
            'id'    => (int) $division->getId(),
            'division' => (string) $division->getDivision(),
        ];
    }

    public function transformAll()
    {
        $divisions = $this->findAll();
        $divisionsArray = [];

        foreach ($divisions as $division) {
            $divisionsArray[] = $this->transform($division);
        }

        return $divisionsArray;
    }

//    /**
//     * @return Divisions[] Returns an array of Divisions objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('d')
//            ->andWhere('d.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('d.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Divisions
//    {
//        return $this->createQueryBuilder('d')
//            ->andWhere('d.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}

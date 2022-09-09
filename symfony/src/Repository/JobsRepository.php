<?php

namespace App\Repository;

use App\Entity\Jobs;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Jobs>
 *
 * @method Jobs|null find($id, $lockMode = null, $lockVersion = null)
 * @method Jobs|null findOneBy(array $criteria, array $orderBy = null)
 * @method Jobs[]    findAll()
 * @method Jobs[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class JobsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Jobs::class);
    }

    public function add(Jobs $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Jobs $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    /*public function transform(Jobs $job)
    {
        return [
            'id'    =>  $job->getId(),
            'job_ref' =>  $job->getJobRef(),
            'company_id' =>  $job->getCompanyId(),
            'link' =>  $job->getLink(),
            'profession_id' =>  $job->getProfessionId(),
            'division_id' =>  $job->getDivisionId(),
            'role_id' =>  $job->getRoleId(),
            'date_published' => date_format($job->getDatePublished(),'Y-m-d'),
            'refkey' => $job->getRefkey()
        ];
    }*/

    public function transform(Jobs $job)
    {
        return [
            'id'    => (string) $job->getId(),
            'job_ref' => (string)  $job->getJobRef(),
            'company_id' => (int) $job->getCompanyId(),
            'link' =>  (string) $job->getLink(),
            'profession_id' => (int) $job->getProfessionId(),
            'division_id' => (int) $job->getDivisionId(),
            'role_id' => (int) $job->getRoleId(),
            'date_published' => date_format($job->getDatePublished(),'Y-m-d'),
            'refkey' => (string) $job->getRefkey()
        ];
    }

    public function transformAll()
    {
        $jobs = $this->findAll();
        $jobsArray = [];

        foreach ($jobs as $job) {
            $jobsArray[] = $this->transform($job);
        }

        return $jobsArray;
    }

//    /**
//     * @return Jobs[] Returns an array of Jobs objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('j')
//            ->andWhere('j.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('j.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Jobs
//    {
//        return $this->createQueryBuilder('j')
//            ->andWhere('j.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}

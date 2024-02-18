<?php

namespace App\Repository;

use App\Entity\StudentMessage;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<StudentMessage>
 *
 * @method StudentMessage|null find($id, $lockMode = null, $lockVersion = null)
 * @method StudentMessage|null findOneBy(array $criteria, array $orderBy = null)
 * @method StudentMessage[]    findAll()
 * @method StudentMessage[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class StudentMessageRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, StudentMessage::class);
    }

//    /**
//     * @return StudentMessage[] Returns an array of StudentMessage objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('s.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?StudentMessage
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}

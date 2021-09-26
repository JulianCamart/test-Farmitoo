<?php

namespace App\Repository;

use App\Entity\Product;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method BrandRepository.php|null find($id, $lockMode = null, $lockVersion = null)
 * @method BrandRepository.php|null findOneBy(array $criteria, array $orderBy = null)
 * @method BrandRepository.php[]    findAll()
 * @method BrandRepository.php[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProductRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, BrandRepository.php::class);
    }
}

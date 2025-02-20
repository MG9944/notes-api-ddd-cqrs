<?php

namespace App\Infrastructure\Persistence\Repositories;

use App\Domain\Notification\Notification;
use App\Domain\Notification\NotificationRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Notification>
 */
class NotificationRepository extends ServiceEntityRepository implements NotificationRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Notification::class);
    }

    public function add(Notification $notification): void
    {
        $entityManager = $this->getEntityManager();
        $entityManager->persist($notification);
        $entityManager->flush();
    }

    public function update(Notification $notification): void
    {
        $entityManager = $this->getEntityManager();
        $entityManager->persist($notification);
        $entityManager->flush();
    }
}

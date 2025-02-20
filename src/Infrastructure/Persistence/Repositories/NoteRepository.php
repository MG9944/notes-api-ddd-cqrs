<?php

namespace App\Infrastructure\Persistence\Repositories;

use App\Domain\Note\Note;
use App\Domain\Note\NoteRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Note>
 */
class NoteRepository extends ServiceEntityRepository implements NoteRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Note::class);
    }

    public function add(Note $note): void
    {
        $entityManager = $this->getEntityManager();
        $entityManager->persist($note);
        $entityManager->flush();
    }

    public function delete(Note $note): void
    {
        $entityManager = $this->getEntityManager();
        $entityManager->remove($note);
        $entityManager->flush();
    }

    public function update(Note $note): void
    {
        $entityManager = $this->getEntityManager();
        $entityManager->persist($note);
        $entityManager->flush();
    }


    public function findUserNote(int $userId, int $noteId): ?Note
    {
        return $this->createQueryBuilder('n')
            ->andWhere('n.id = :NOTE_ID')
            ->andWhere('n.user_id = :USER_ID')
            ->setParameters([
                'NOTE_ID' => $noteId,
                'USER_ID'     => $userId,
            ])
            ->getQuery()
            ->getOneOrNullResult();
    }

    public function findUserNotes(int $userId): array
    {
        return $this->createQueryBuilder('n')
            ->andWhere('n.user_id = :USER_ID')
            ->setParameter('USER_ID', $userId)
            ->getQuery()
            ->getResult();
    }
}

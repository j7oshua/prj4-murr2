<?php


namespace App\DataPersister;

use ApiPlatform\Core\DataPersister\DataPersisterInterface;
use App\Entity\Resident;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;


class ResidentDataPersister implements DataPersisterInterface
{
    private $entityManager;
    private $userPasswordEncoder;
    public function __construct(EntityManagerInterface $entityManager, UserPasswordEncoderInterface $userPasswordEncoder)
    {
        $this->entityManager = $entityManager;
        $this->userPasswordEncoder = $userPasswordEncoder;
    }
    public function supports($data): bool
    {
        //todo an instance of a resident
    }
    /**
     * @param Resident $data
     */
    public function persist($data)
    {
        //todo encoding the password and persisting that resident to the database
    }
    public function remove($data)
    {
        //todo remove the resident from the database
    }
}
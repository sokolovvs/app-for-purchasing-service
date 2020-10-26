<?php


namespace App\Entity\User;


use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CustomerRepository::class)
 */
class Admin extends User
{

}

<?php
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

    /**
     * @ORM\Entity
     * @ORM\Table(name="hairdresser")
     */
class Hairdresser
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    public $id;

    /**
     * @ORM\Column(type="decimal", scale=2)
     */
    public $service;

    /**
     * @ORM\Column(type="string")
     */
    public $description;
}
class Service extends Hairdresser
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    public $id;

    /**
     * @ORM\Column(type="string")
     */
    public $description;
}
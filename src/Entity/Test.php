<?php

namespace App\Entity;

use App\Repository\TestRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TestRepository::class)
 */
class Test
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $information;

    /**
     * @ORM\ManyToOne(targetEntity=Test2::class, inversedBy="tests")
     */
    private $test2;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getInformation(): ?string
    {
        return $this->information;
    }

    public function setInformation(string $information): self
    {
        $this->information = $information;

        return $this;
    }

    public function getTest2(): ?Test2
    {
        return $this->test2;
    }

    public function setTest2(?Test2 $test2): self
    {
        $this->test2 = $test2;

        return $this;
    }
}

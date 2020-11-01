<?php

namespace App\Entity;

use App\Repository\OrderRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=OrderRepository::class)
 * @ORM\Table(name="`order`")
 */
class Order
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Contract::class, inversedBy="orders")
     * @ORM\JoinColumn(nullable=false)
     */
    private $contract;

    /**
     * @ORM\ManyToOne(targetEntity=Production::class, inversedBy="orders")
     * @ORM\JoinColumn(nullable=false)
     */
    private $production;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function __toString()
    {
        return $this->getId().' '.$this->getContract().' '.$this->getProduction();

        // TODO: Implement __toString() method.
    }

    public function getContract(): ?Contract
    {
        return $this->contract;
    }

    public function setContract(?Contract $contract): self
    {
        $this->contract = $contract;

        return $this;
    }

    public function getProduction(): ?Production
    {
        return $this->production;
    }

    public function setProduction(?Production $production): self
    {
        $this->production = $production;

        return $this;
    }
}

<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use App\Entity\Sucursal;
use App\Repository\EmpresaRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EmpresaRepository::class)]
class Empresa
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $nroEmpresa = null;

    #[ORM\Column(length: 255)]
    private ?string $nombre = null;

    #[ORM\Column(length: 20)]
    private ?string $cuit = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $email = null;

    #[ORM\Column(length: 30, nullable: true)]
    private ?string $telefono = null;

    #[ORM\Column]
    private ?bool $isActive = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\OneToMany(mappedBy: 'empresa', targetEntity: Sucursal::class)]
    private Collection $sucursales;

    /**
     * @var Collection<int, Usuario>
     */
    #[ORM\OneToMany(targetEntity: Usuario::class, mappedBy: 'empresa')]
    private Collection $usuarios;

    public function __construct()
    {
        $this->sucursales = new ArrayCollection();
        $this->usuarios = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNroEmpresa(): ?int
    {
        return $this->nroEmpresa;
    }

    public function setNroEmpresa(int $nroEmpresa): static
    {
        $this->nroEmpresa = $nroEmpresa;

        return $this;
    }

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): static
    {
        $this->nombre = $nombre;

        return $this;
    }

    public function getCuit(): ?string
    {
        return $this->cuit;
    }

    public function setCuit(string $cuit): static
    {
        $this->cuit = $cuit;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getTelefono(): ?string
    {
        return $this->telefono;
    }

    public function setTelefono(?string $telefono): static
    {
        $this->telefono = $telefono;

        return $this;
    }

    public function isActive(): ?bool
    {
        return $this->isActive;
    }

    public function setActive(bool $isActive): static
    {
        $this->isActive = $isActive;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): static
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * @return Collection<int, Usuario>
     */
    public function getUsuarios(): Collection
    {
        return $this->usuarios;
    }

    public function addUsuario(Usuario $usuario): static
    {
        if (!$this->usuarios->contains($usuario)) {
            $this->usuarios->add($usuario);
            $usuario->setEmpresa($this);
        }

        return $this;
    }

    public function removeUsuario(Usuario $usuario): static
    {
        if ($this->usuarios->removeElement($usuario)) {
            // set the owning side to null (unless already changed)
            if ($usuario->getEmpresa() === $this) {
                $usuario->setEmpresa(null);
            }
        }

        return $this;
    }
}

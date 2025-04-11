<?php

namespace App\Entity;

use App\Repository\SucursalRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Empresa;

#[ORM\Entity(repositoryClass: SucursalRepository::class)]
class Sucursal
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $nroSucursal = null;

    #[ORM\Column(length: 255)]
    private ?string $nombre = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $direccion = null;

    #[ORM\Column(length: 30, nullable: true)]
    private ?string $telefono = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $email = null;

    #[ORM\Column]
    private ?bool $isActive = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\ManyToOne(inversedBy: 'sucursales')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Empresa $empresa = null;

    /**
     * @var Collection<int, Usuario>
     */
    #[ORM\OneToMany(targetEntity: Usuario::class, mappedBy: 'sucursal')]
    private Collection $usuarios;

    public function __construct()
    {
        $this->usuarios = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNroSucursal(): ?int
    {
        return $this->nroSucursal;
    }

    public function setNroSucursal(int $nroSucursal): static
    {
        $this->nroSucursal = $nroSucursal;

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

    public function getDireccion(): ?string
    {
        return $this->direccion;
    }

    public function setDireccion(?string $direccion): static
    {
        $this->direccion = $direccion;

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

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): static
    {
        $this->email = $email;

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
            $usuario->setSucursal($this);
        }

        return $this;
    }

    public function removeUsuario(Usuario $usuario): static
    {
        if ($this->usuarios->removeElement($usuario)) {
            // set the owning side to null (unless already changed)
            if ($usuario->getSucursal() === $this) {
                $usuario->setSucursal(null);
            }
        }

        return $this;
    }
}

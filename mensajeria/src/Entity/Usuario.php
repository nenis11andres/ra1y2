<?php

namespace App\Entity;

use App\Repository\UsuarioRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: UsuarioRepository::class)]
#[ORM\UniqueConstraint(name: 'UNIQ_IDENTIFIER_USERNAME', fields: ['username'])]
class Usuario implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180)]
    private ?string $username = null;

    /**
     * @var list<string> The user roles
     */
    #[ORM\Column]
    private array $roles = [];

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    private ?string $password = null;

    #[ORM\Column(length: 255)]
    private ?string $fullname = null;

    #[ORM\Column(length: 255)]
    private ?string $provincia = null;

    #[ORM\Column]
    private ?bool $administrador = null;

    /**
     * @var Collection<int, Mensaje>
     */
    #[ORM\OneToMany(targetEntity: Mensaje::class, mappedBy: 'usuario')]
    private Collection $recibidos;

    /**
     * @var Collection<int, Mensaje>
     */
    #[ORM\OneToMany(targetEntity: Mensaje::class, mappedBy: 'usuario')]
    private Collection $enviados;

    /**
     * @var Collection<int, Mensaje>
     */
    #[ORM\OneToMany(targetEntity: Mensaje::class, mappedBy: 'remitente')]
    private Collection $mensajes;

    public function __construct()
    {
        $this->recibidos = new ArrayCollection();
        $this->enviados = new ArrayCollection();
        $this->mensajes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): static
    {
        $this->username = $username;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->username;
    }

    /**
     * @see UserInterface
     *
     * @return list<string>
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    /**
     * @param list<string> $roles
     */
    public function setRoles(array $roles): static
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials(): void
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getFullname(): ?string
    {
        return $this->fullname;
    }

    public function setFullname(string $fullname): static
    {
        $this->fullname = $fullname;

        return $this;
    }

    public function getProvincia(): ?string
    {
        return $this->provincia;
    }

    public function setProvincia(string $provincia): static
    {
        $this->provincia = $provincia;

        return $this;
    }

    public function isAdministrador(): ?bool
    {
        return $this->administrador;
    }

    public function setAdministrador(bool $administrador): static
    {
        $this->administrador = $administrador;

        return $this;
    }

    /**
     * @return Collection<int, Mensaje>
     */
    public function getRecibidos(): Collection
    {
        return $this->recibidos;
    }

    public function addRecibido(Mensaje $recibido): static
    {
        if (!$this->recibidos->contains($recibido)) {
            $this->recibidos->add($recibido);
            $recibido->setUsuario($this);
        }

        return $this;
    }

    public function removeRecibido(Mensaje $recibido): static
    {
        if ($this->recibidos->removeElement($recibido)) {
            // set the owning side to null (unless already changed)
            if ($recibido->getUsuario() === $this) {
                $recibido->setUsuario(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Mensaje>
     */
    public function getEnviados(): Collection
    {
        return $this->enviados;
    }

    public function addEnviado(Mensaje $enviado): static
    {
        if (!$this->enviados->contains($enviado)) {
            $this->enviados->add($enviado);
            $enviado->setUsuario($this);
        }

        return $this;
    }

    public function removeEnviado(Mensaje $enviado): static
    {
        if ($this->enviados->removeElement($enviado)) {
            // set the owning side to null (unless already changed)
            if ($enviado->getUsuario() === $this) {
                $enviado->setUsuario(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Mensaje>
     */
    public function getMensajes(): Collection
    {
        return $this->mensajes;
    }

    public function addMensaje(Mensaje $mensaje): static
    {
        if (!$this->mensajes->contains($mensaje)) {
            $this->mensajes->add($mensaje);
            $mensaje->setRemitente($this);
        }

        return $this;
    }

    public function removeMensaje(Mensaje $mensaje): static
    {
        if ($this->mensajes->removeElement($mensaje)) {
            // set the owning side to null (unless already changed)
            if ($mensaje->getRemitente() === $this) {
                $mensaje->setRemitente(null);
            }
        }

        return $this;
    }
}

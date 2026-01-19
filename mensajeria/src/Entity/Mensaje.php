<?php

namespace App\Entity;

use App\Repository\MensajeRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MensajeRepository::class)]
class Mensaje
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $asunto = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $fecha = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $cuerpo = null;

    #[ORM\ManyToOne(inversedBy: 'recibidos')]
    private ?Usuario $usuario = null;

    #[ORM\ManyToOne(inversedBy: 'mensajes')]
    private ?Usuario $remitente = null;

    #[ORM\ManyToOne(inversedBy: 'mensajes')]
    private ?Usuario $destinatario = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAsunto(): ?string
    {
        return $this->asunto;
    }

    public function setAsunto(string $asunto): static
    {
        $this->asunto = $asunto;

        return $this;
    }

    public function getFecha(): ?\DateTimeInterface
    {
        return $this->fecha;
    }

    public function setFecha(\DateTimeInterface $fecha): static
    {
        $this->fecha = $fecha;

        return $this;
    }

    public function getCuerpo(): ?string
    {
        return $this->cuerpo;
    }

    public function setCuerpo(string $cuerpo): static
    {
        $this->cuerpo = $cuerpo;

        return $this;
    }

    public function getUsuario(): ?Usuario
    {
        return $this->usuario;
    }

    public function setUsuario(?Usuario $usuario): static
    {
        $this->usuario = $usuario;

        return $this;
    }

    public function getRemitente(): ?Usuario
    {
        return $this->remitente;
    }

    public function setRemitente(?Usuario $remitente): static
    {
        $this->remitente = $remitente;

        return $this;
    }

    public function getDestinatario(): ?Usuario
    {
        return $this->destinatario;
    }

    public function setDestinatario(?Usuario $destinatario): static
    {
        $this->destinatario = $destinatario;

        return $this;
    }
}

<?php

namespace App\Entity;

use App\Repository\RedirectionRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RedirectionRepository::class)]
#[ORM\HasLifecycleCallbacks]
class Redirection {
  #[ORM\Id]
  #[ORM\GeneratedValue]
  #[ORM\Column(type: 'integer')]
  private $id;

  #[ORM\Column(type: 'text')]
  private $link;

  #[ORM\Column(type: 'string', length: 8)]
  private $token;

  public function getId(): ?int {
    return $this->id;
  }

  public function getLink(): ?string {
    return $this->link;
  }

  public function setLink(string $link): self {
    $this->link = $link;

    return $this;
  }

  public function getToken(): ?string {
    return $this->token;
  }

  #[ORM\PrePersist]
  public function setToken(): self {
    $this->token = substr(bin2hex(random_bytes(8)), 0, 8);
    return $this;
  }
}

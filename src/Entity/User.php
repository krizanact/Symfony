<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 * @UniqueEntity(fields={"email"}, message="There is already an account with this email")
 */
class User implements UserInterface, \Serializable
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=191)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=191)
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=191, unique=true)
     */
    private $email;

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

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }
    public function  getRoles()
    {
        return [
            'ROLE_USER'
        ];
    }

    //using email in method getUsername instead of username
    public function getUsername(): ?string
    {
        return $this->email;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }
    public function getSalt() {}
    public function eraseCredentials() {}
    public function serialize()
    {
        return serialize([
            $this->id,
            $this->name,
            $this->email,
            $this->password
        ]);
    }
    public function unserialize($string)
    {
        list(
            $this->id,
            $this->name,
            $this->email,
            $this->password
            ) = unserialize($string, ['allowed_classes'=>false]);
    }

    /**
     *@ORM\OneToMany(targetEntity="App\Entity\Document", mappedBy="user")
     */

    private $documents;

    public function __construct()
    {
        $this->documents = new ArrayCollection();
    }

    /**
     * @return Collection|Document[]
     */

    public function getDocuments(): Collection
    {
        return $this->documents;
    }

    public function addDocuments(Document $document): self
    {
        if (!$this->documents->contains($document)) {
            $this->documents[] = $document;
            $document->setUser($this);
        }

        return $this;
    }

    public function removeDocument(Document $document): self
    {
        if ($this->documents->contains($document)) {
            $this->documents->removeElement($document);
            // set the owning side to null (unless already changed)
            if ($document->getUser() === $this) {
                $document->setUser(null);
            }
        }

        return $this;
    }


    public function __toString()
    {
        return $this->email;
    }

}

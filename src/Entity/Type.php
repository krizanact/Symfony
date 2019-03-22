<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;



/**
 * @ORM\Entity(repositoryClass="App\Repository\TypeRepository")
 */
class Type
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
    private $type;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    /**
     *@ORM\OneToMany(targetEntity="App\Entity\Document", mappedBy="type")
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
    public function addDocument(Document $document): self
    {
        if(!$this->documents->contains($document)) {
            $this->documents[] = $document;
            $document->setType($this);
        }
        return $this;

    }

    public function removeDocument(Document $document): self
    {
        if($this->documents->contains($document)) {
            $this->documents->removeElement($document);
            //set to null unless changed
            if($document->getType() ===$this) {
                $document->setType(null);
            }
        }
        return $this;
    }

    public function __toString()
    {
        return $this->type;
    }
}

<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;



/**
 * @ORM\Entity(repositoryClass="App\Repository\DocumentRepository")
 */
class Document
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string")
     * @Assert\File(maxSize="1999k")
     */
    private $doc_upload;

    /**
     * @ORM\Column(type="text")
     */
    private $docName;



    public function getId()
    {
        return $this->id;
    }

    public function getDocName()
    {
        return $this->docName;
    }
    public function setDocName($docName)
    {
        $this->docName= $docName;
    }


    public function getDoc_Upload()
    {
        return $this->doc_upload;
    }
    public function setDoc_Upload($doc_upload)
    {
        $this->doc_upload = $doc_upload;
        return $this;

    }

    public function getDocUpload()
    {
        return $this->doc_upload;
    }

    public function setDocUpload($doc_upload): self
    {
        $this->doc_upload = $doc_upload;

        return $this;
    }

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="documents")
     */
    private $user;
    public function getUser(): ?User
    {
        return $this->user;
    }
    public function setUser(?User $user): self
    {
        $this->user = $user;
        return $this;
    }


    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Type", inversedBy="documents")
     */

    private $type;
    public function getType(): ?Type
    {
        return $this->type;
    }
    public function setType(?Type $type): self
    {
        $this->type=$type;
        return $this;
    }

    public function jsonSerialize()
    {
        return array(
            'type' => $this->type,
            'doc_upload'=> $this->doc_upload,
        );
    }



}

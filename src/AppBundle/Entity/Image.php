<?php
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection; 
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\Validator\Constraints as Assert;


/**
 *  
 *
 * @ORM\Table(name="image")
 * @ORM\Entity()
 * @Vich\Uploadable
 * 
 */
class Image  
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
  
    /**
     * 
     *
     * @Assert\File(
     *     maxSize = "1024k",
     * )
     * @Assert\File(maxSize="1M")
     * @Vich\UploadableField(mapping="upload_files", fileNameProperty="fileName" )
     * 
     * @var File
     */
    protected $file;
    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * 
     * @var string
     */
    protected $fileName;
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime", nullable=true)
     */
    private $createdAt;
    /**
     * @ORM\Column(name="updated_at", type="datetime", nullable=true)
     *
     * @var \DateTime
     */
    private $updatedAt;
    
    public function __construct()
    {   
   
        $this->createdAt= new \DateTime();
 
    }

 

    
    /**
     *
     * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile $image
     *
     * 
     */
    public function setFile(File $image = null)
    {
        $this->file = $image;
        $this->createdAt = new \DateTimeImmutable();
        if ($image) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->updatedAt = new \DateTimeImmutable();
        }
        
        return $this;
    }
    /**
     * @return File|null
     */
    public function getFile()
    {
        return $this->file;
    }
    /**
     * @param string $fileName
     *
     * 
     */
    public function setFileName($fileName)
    {
        $this->fileName = $fileName;
        
        return $this;
    }
    /**
     * @return string|null
     */
    public function getFileName()
    {
        return $this->fileName;
    }
    /** 
     * Get updatedAt 
     * 
     * @return \DateTime 
     */  
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }
    /** 
     * Set updatedAt 
     * 
     * @ORM\PreUpdate 
     */  
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;
    }
   
    /** 
     * Set createdAt 
     * 
     * @ORM\PrePersist 
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
        return $this;
    }
    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }
}
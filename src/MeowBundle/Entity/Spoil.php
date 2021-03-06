<?php

namespace MeowBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Spoil
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Spoil
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="text")
     */
    private $title;

    /**
     * @var string $slug
     *
     * @Gedmo\Slug(fields={"title"}, updatable=false, separator="-")
     * @ORM\Column(name="slug", type="string", length=100)
     */
    private $slug;

    /**
     * @ORM\ManyToOne(targetEntity="Manga", inversedBy="posts", cascade={"persist"})
     * @ORM\JoinColumn(name="manga", referencedColumnName="id")
     */
    protected $manga;

    /**
     * @var string
     *
     * @ORM\Column(name="cover", type="string", length=255)
     */
    private $cover;

    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="posts", cascade={"persist"})
     * @ORM\JoinColumn(name="author", referencedColumnName="id")
     */
    protected $author;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;

    /**
     * @var integer
     *
     * @ORM\Column(name="nb_comments", type="integer")
     */
    private $nbComments;

    /**
     * @var integer
     *
     * @ORM\Column(name="nb_spoil", type="integer")
     */
    private $nbSpoil;

    /**
     * @var integer
     *
     * @ORM\Column(name="nb_fail", type="integer")
     */
    private $nbFail;

    /**
     * @var integer
     *
     * @ORM\Column(name="nb_fake", type="integer")
     */
    private $nbFake;

    /**
     * @var boolean
     *
     * @ORM\Column(name="is_published", type="boolean")
     */
    private $isPublished;

    /**
     * @Assert\Image(maxSize = "600000")
     */
    public $file;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set title
     *
     * @param string $title
     * @return Spoil
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set slug
     *
     * @param string $slug
     * @return Spoil
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get slug
     *
     * @return string 
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Set manga
     *
     * @param \MeowBundle\Entity\Manga $manga
     * @return Spoil
     */
    public function setManga(\MeowBundle\Entity\Manga $manga = null)
    {
        $this->manga = $manga;

        return $this;
    }

    /**
     * Get manga
     *
     * @return \MeowBundle\Entity\Manga 
     */
    public function getManga()
    {
        return $this->manga;
    }

    /**
     * Set cover
     *
     * @param string $cover
     * @return Spoil
     */
    public function setCover($cover)
    {
        $this->cover = $cover;

        return $this;
    }

    /**
     * Get cover
     *
     * @return string 
     */
    public function getCover()
    {
        return $this->cover;
    }


    public function getAbsoluteCover()
    {
        return null === $this->cover ? null : $this->getUploadRootDir().'/'.$this->cover;
    }

    public function getWebCover()
    {
        return null === $this->cover ? null : $this->getUploadDir().'/'.$this->cover;
    }

    protected function getUploadRootDir()
    {
        // le chemin absolu du répertoire où les documents uploadés doivent être sauvegardés
        return __DIR__.'/../../../web/'.$this->getUploadDir();
    }

    protected function getUploadDir()
    {
        // on se débarrasse de « __DIR__ » afin de ne pas avoir de problème lorsqu'on affiche
        // le document/image dans la vue.
        return '_assets/imgs/spoils/';
    }

    public function upload()
    {
        if(null === $this->file){
            return;
        }

        $this->file->move($this->getUploadRootDir(), $this->file->getClientOriginalName());
        $this->cover = $this->file->getClientOriginalName();
        $this->file = null;
    }

    /**
     * Set author
     *
     * @param \MeowBundle\Entity\User $author
     * @return Spoil
     */
    public function setAuthor(\MeowBundle\Entity\User $author = null)
    {
        $this->author = $author;

        return $this;
    }

    /**
     * Get author
     *
     * @return \MeowBundle\Entity\User 
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     * @return Spoil
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime 
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set nbComments
     *
     * @param integer $nbComments
     * @return Spoil
     */
    public function setNbComments($nbComments)
    {
        $this->nbComments = $nbComments;

        return $this;
    }

    /**
     * Get nbComments
     *
     * @return integer 
     */
    public function getNbComments()
    {
        return $this->nbComments;
    }

    /**
     * Set nbSpoil
     *
     * @param integer $nbSpoil
     * @return Spoil
     */
    public function setNbSpoil($nbSpoil)
    {
        $this->nbSpoil = $nbSpoil;

        return $this;
    }

    /**
     * Get nbSpoil
     *
     * @return integer 
     */
    public function getNbSpoil()
    {
        return $this->nbSpoil;
    }

    /**
     * Set nbFail
     *
     * @param integer $nbFail
     * @return Spoil
     */
    public function setNbFail($nbFail)
    {
        $this->nbFail = $nbFail;

        return $this;
    }

    /**
     * Get nbFail
     *
     * @return integer 
     */
    public function getNbFail()
    {
        return $this->nbFail;
    }

    /**
     * Set nbFake
     *
     * @param integer $nbFake
     * @return Spoil
     */
    public function setNbFake($nbFake)
    {
        $this->nbFake = $nbFake;

        return $this;
    }

    /**
     * Get nbFake
     *
     * @return integer 
     */
    public function getNbFake()
    {
        return $this->nbFake;
    }

    /**
     * Set isPublished
     *
     * @param boolean $isPublished
     * @return Spoil
     */
    public function setIsPublished($isPublished)
    {
        $this->isPublished = $isPublished;

        return $this;
    }

    /**
     * Get isPublished
     *
     * @return boolean 
     */
    public function getIsPublished()
    {
        return $this->isPublished;
    }
}

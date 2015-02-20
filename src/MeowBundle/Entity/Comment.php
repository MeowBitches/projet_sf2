<?php

namespace MeowBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Comment
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Comment
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
     * @var string
     *
     * @ORM\Column(name="text", type="text")
     */
    private $text;

    /**
     * @ORM\ManyToOne(targetEntity="Spoil", inversedBy="posts", cascade={"persist"})
     * @ORM\JoinColumn(name="id_spoil", referencedColumnName="id")
     */
    protected $idSpoil;

    /**
     * @var integer
     *
     * @ORM\Column(name="nb_like", type="integer")
     */
    private $nbLike;

    /**
     * @ORM\OneToMany(targetEntity="Comment", mappedBy="parent")
     **/
    private $children;

    /**
     * @ORM\ManyToOne(targetEntity="Comment", inversedBy="children")
     * @ORM\JoinColumn(name="parent", referencedColumnName="id")
     **/
    private $parent;

    public function __construct()
    {
        $this->children = new \Doctrine\Common\Collections\ArrayCollection();
    }


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
     * Set author
     *
     * @param \MeowBundle\Entity\User $author
     * @return Comment
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
     * @return Comment
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
     * Set text
     *
     * @param string $text
     * @return Comment
     */
    public function setText($text)
    {
        $this->text = $text;

        return $this;
    }

    /**
     * Get text
     *
     * @return string 
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * Set idSpoil
     *
     * @param \MeowBundle\Entity\Spoil $idSpoil
     * @return Comment
     */
    public function setIdSpoil(\MeowBundle\Entity\Spoil $idSpoil = null)
    {
        $this->idSpoil = $idSpoil;

        return $this;
    }

    /**
     * Get idSpoil
     *
     * @return \MeowBundle\Entity\Spoil 
     */
    public function getIdSpoil()
    {
        return $this->idSpoil;
    }

    /**
     * Set nbLike
     *
     * @param integer $nbLike
     * @return Comment
     */
    public function setNbLike($nbLike)
    {
        $this->nbLike = $nbLike;

        return $this;
    }

    /**
     * Get nbLike
     *
     * @return integer 
     */
    public function getNbLike()
    {
        return $this->nbLike;
    }

    /**
     * Get children
     *
     * @return \MeowBundle\Entity\Comment[] 
     */
    public function getChildren()
    {
        return $this->children;
    }

    /**
     * Set parent
     *
     * @param \MeowBundle\Entity\Comment $parent
     * @return Comment
     */
    public function setParent(\MeowBundle\Entity\Comment $parent = null)
    {
        $this->parent = $parent;

        return $this;
    }

    /**
     * Get parent
     *
     * @return \MeowBundle\Entity\Comment 
     */
    public function getParent()
    {
        return $this->parent;
    }
}

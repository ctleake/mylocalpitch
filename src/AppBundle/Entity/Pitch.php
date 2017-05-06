<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Pitch
 *
 * @ORM\Table(name="pitch")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PitchRepository")
 */
class Pitch
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    //private $id;
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=20)
     */
    //private $type;
    protected $type;

    /**
     * @var \stdClass
     *
     * @ORM\Column(name="attributes", type="object")
     */
    //private $attributes;
    protected $attributes;

    /**
     * Many Pitches have Many Slots (Unidirectional Association)
     * @ORM\ManyToMany(targetEntity="Slot")
     * @ORM\JoinTable(name="pitch_slot",
     *     joinColumns={@ORM\JoinColumn(name="pitch_id", referencedColumnName="id")},
     *     inverseJoinColumns={@ORM\JoinColumn(name="slot_id", referencedColumnName="id")}
     *     )
     */
    protected $slot;

    public function __construct()
    {
        $this->slot = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set type
     *
     * @param string $type
     *
     * @return Pitch
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set attributes
     *
     * @param \stdClass $attributes
     *
     * @return Pitch
     */
    public function setAttributes($attributes)
    {
        $this->attributes = $attributes;

        return $this;
    }

    /**
     * Get attributes
     *
     * @return \stdClass
     */
    public function getAttributes()
    {
        return $this->attributes;
    }

    /**
     * @return \Doctrine\Common\Collections\ArrayCollection
     */
    public function getSlot()
    {
        return $this->slot;
    }

    public function setSlot($slot)
    {
        $this->slot = $slot;

        return $this;
    }
}


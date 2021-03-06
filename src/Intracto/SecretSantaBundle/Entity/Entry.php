<?php

namespace Intracto\SecretSantaBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Intracto\SecretSantaBundle\Entity\Entry
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Intracto\SecretSantaBundle\Entity\EntryRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Entry
{
    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var Pool $pool
     *
     * @ORM\ManyToOne(targetEntity="Pool", inversedBy="entries")
     * @ORM\JoinColumn(name="poolId", referencedColumnName="id", onDelete="CASCADE")
     */
    private $pool;

    /**
     * @var string $name
     *
     * @ORM\Column(name="name", type="string", length=255)
     *
     * @Assert\NotBlank()
     */
    private $name;

    /**
     * @var string $email
     *
     * @ORM\Column(name="email", type="string", length=255)
     *
     * @Assert\NotBlank()
     * @Assert\Email(
     *     message = "The email '{{ value }}' is not a valid email.",
     *     checkMX = true
     * )
     */
    private $email;

    /**
     * @var Entry $entry
     *
     * @ORM\OneToOne(targetEntity="Entry")
     * @ORM\JoinColumn(name="entryId", referencedColumnName="id", nullable=true, onDelete="SET NULL")
     */
    private $entry;

    /**
     * @var string $wishlist
     *
     * @ORM\Column(name="wishlist", type="text", nullable=true)
     */
    private $wishlist;

    /**
     * @var \DateTime $viewdate
     *
     * @ORM\Column(name="viewdate", type="datetime", nullable=true)
     */
    private $viewdate;

    /**
     * @var string $url
     *
     * @ORM\Column(name="url", type="string", length=255, nullable=true)
     */
    private $url;

    /**
     * @var ArrayCollection $wishlistItems
     *
     * @ORM\OneToMany(targetEntity="WishlistItem", mappedBy="entry", cascade={"persist", "remove"})
     * @ORM\OrderBy({"rank" = "asc"})
     */
    private $wishlistItems;

    /**
     * @var WishlistItem $removedWishlistItems
     */
    private $removedWishlistItems;

    /**
     * @var boolean $wishlist_updated
     *
     * @ORM\Column(name="wishlist_updated", type="boolean", nullable=true)
     */
    private $wishlist_updated = false;

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
     * Set pool
     *
     * @param Pool $pool
     *
     * @return Entry
     */
    public function setPool($pool)
    {
        $this->pool = $pool;

        return $this;
    }

    /**
     * Get pool
     *
     * @return Pool
     */
    public function getPool()
    {
        return $this->pool;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Entry
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return Entry
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set wishlist
     *
     * @param string $wishlist
     *
     * @return Entry
     */
    public function setWishlist($wishlist)
    {

        if ($this->wishlist !== $wishlist) {
            $this->wishlist_updated = true;
        }

        $this->wishlist = $wishlist;

        return $this;
    }

    /**
     * Get wishlist
     *
     * @return string
     */
    public function getWishlist()
    {
        return $this->wishlist;
    }

    /**
     * Set entry
     *
     * @param Entry $entry
     *
     * @return Entry
     */
    public function setEntry($entry)
    {
        $this->entry = $entry;

        return $this;
    }

    /**
     * Get entry
     *
     * @return Entry
     */
    public function getEntry()
    {
        return $this->entry;
    }

    /**
     * Set viewdate
     *
     * @param \DateTime $viewdate
     *
     * @return Entry
     */
    public function setViewdate($viewdate)
    {
        $this->viewdate = $viewdate;

        return $this;
    }

    /**
     * Get viewdate
     *
     * @return \DateTime
     */
    public function getViewdate()
    {
        return $this->viewdate;
    }

    /**
     * Set secret
     *
     * @param string $secret
     *
     * @return Entry
     */
    public function setSecret($secret)
    {
        $this->secret = $secret;

        return $this;
    }

    /**
     * Get secret
     *
     * @return string
     */
    public function getSecret()
    {
        return $this->secret;
    }

    /**
     * Set url
     *
     * @param string $url
     *
     * @return Entry
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Get url
     *
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Set send
     *
     * @param  boolean $send
     * @return Entry
     */
    public function setSend($send)
    {
        $this->send = $send;

        return $this;
    }

    /**
     * Get send
     *
     * @return boolean
     */
    public function getSend()
    {
        return $this->send;
    }

    /**
     * Set ready_to_send
     *
     * @param  boolean $readyToSend
     * @return Entry
     */
    public function setReadyToSend($readyToSend)
    {
        $this->ready_to_send = $readyToSend;

        return $this;
    }

    /**
     * Get ready_to_send
     *
     * @return boolean
     */
    public function getReadyToSend()
    {
        return $this->ready_to_send;
    }

    /**
     * Set wishlist_updated
     *
     * @param  boolean $wishlistUpdated
     * @return Entry
     */
    public function setWishlistUpdated($wishlistUpdated)
    {
        $this->wishlist_updated = $wishlistUpdated;

        return $this;
    }

    /**
     * Get wishlist_updated
     *
     * @return boolean
     */
    public function getWishlistUpdated()
    {
        return $this->wishlist_updated;
    }

    public function __construct() {
        $this->PostLoad();
    }

    /**
     * @ORM\PostLoad
     */
    public function PostLoad() {
        $this->removedWishlistItems = new ArrayCollection();
    }

    /**
     * @return WishlistItem
     */
    public function getWishlistItems()
    {
        return $this->wishlistItems;
    }

    /**
     * @param WishlistItem $wishlistItems
     */
    public function setWishlistItems($wishlistItems)
    {
        $this->wishlistItems = $wishlistItems;
    }

    public function addWishlistItem(WishlistItem $item) {
        $this->removedWishlistItems->removeElement($item);
        $item->setEntry($this);
        $this->wishlistItems->add($item);
        $this->wishlist_updated = true;
    }

    public function removeWishlistItem(WishlistItem $item) {
        $this->removedWishlistItems->add($item);
        $item->setEntry(null);
        $this->wishlistItems->removeElement($item);
        $this->wishlist_updated = true;
    }

    /**
     * @return WishlistItem
     */
    public function getRemovedWishlistItems()
    {
        return $this->removedWishlistItems;
    }

    /**
     * @param WishlistItem $removedWishlistItems
     */
    public function setRemovedWishlistItems($removedWishlistItems)
    {
        $this->removedWishlistItems = $removedWishlistItems;
    }

}

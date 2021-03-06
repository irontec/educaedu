<?php

// src/AppBundle/Entity/User.php

namespace AppBundle\Entity;

use AppBundle\Model\UserInterface;
use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name = "user")
 * @ORM\Entity(repositoryClass="AppBundle\Entity\UserGateway")
 */
class User extends BaseUser implements UserInterface
{

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     * @ORM\Column(type="string", length=255)
     */
    protected $username;

    /**
     * @var string
     * @ORM\Column(type="string", length=255, unique=true )
     */
    protected $usernameCanonical;

    /**
     * @var string
     * @ORM\Column(type="string", length=255)
     */
    protected $email;

    /**
     * @var string
     * @ORM\Column(type="string", length=255, unique=true )
     */
    protected $emailCanonical;

    /**
     * @var bool
     * @ORM\Column(type="boolean")
     */
    protected $enabled;

    /**
     * The salt to use for hashing.
     *
     * @ORM\Column(type="string")
     *
     * @var string
     */
    protected $salt;

    /**
     * Encrypted password. Must be persisted.
     *
     * @ORM\Column(type="string")
     *
     * @var string
     */
    protected $password;

    /**
     * User description.
     *
     * @ORM\Column(type="text", nullable=true)
     *
     * @var string
     */
    protected $description = null;

    /**
     * Plain password. Used for model validation. Must not be persisted.
     *
     * @var string
     */
    protected $plainPassword;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     *
     * @var \DateTime
     */
    protected $lastLogin;

    /**
     * Random string sent to the user email address in order to verify it.
     *
     * @ORM\Column(type="string", nullable=true)
     *
     * @var string
     */
    protected $confirmationToken;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     *
     * @var \DateTime
     */
    protected $passwordRequestedAt;

    /**
     * @ORM\Column(type="boolean")
     *
     * @var bool
     */
    protected $locked = false;

    /**
     * @ORM\Column(type="boolean")
     *
     * @var bool
     */
    protected $expired = false;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     *
     * @var \DateTime
     */
    protected $expiresAt;

    /**
     * @ORM\Column(type="array")
     *
     * @var array
     */
    protected $roles;

    /**
     * @ORM\Column(type="boolean")
     *
     * @var bool
     */
    protected $credentialsExpired = false;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     *
     * @var \DateTime
     */
    protected $credentialsExpireAt;

    /**
     * @param type $username
     * @param type $email
     * @param type $pass
     */
    public function __construct($username = null, $email = null, $pass = null)
    {
        parent::__construct();
        $this->username = $username;
        $this->email = $email;
        $this->password = $pass;
    }

    /**
     * @param array $user
     *
     * @return \self
     */
    public static function fromArray(array $user = array('username' => null, 'email' => null))
    {
        $rawUser = new self($user['username'], $user['email']);
        $rawUser->setExpired(array_key_exists('expired', $user) ? $user['expired'] : false);
        $rawUser->setLocked(array_key_exists('locked', $user) ? $user['locked'] : false);
        return $rawUser;
    }

    /**
     * Get enabled
     *
     * @return boolean
     */
    public function getEnabled()
    {
        return $this->enabled;
    }

    /**
     * Set salt
     *
     * @param string $salt
     *
     * @return User
     */
    public function setSalt($salt)
    {
        $this->salt = $salt;

        return $this;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return User
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Get locked
     *
     * @return boolean
     */
    public function getLocked()
    {
        return $this->locked;
    }

    /**
     * Get expired
     *
     * @return boolean
     */
    public function getExpired()
    {
        return $this->expired;
    }

    /**
     * Get expiresAt
     *
     * @return \DateTime
     */
    public function getExpiresAt()
    {
        return $this->expiresAt;
    }

    /**
     * Get credentialsExpired
     *
     * @return boolean
     */
    public function getCredentialsExpired()
    {
        return $this->credentialsExpired;
    }

    /**
     * Get credentialsExpireAt
     *
     * @return \DateTime
     */
    public function getCredentialsExpireAt()
    {
        return $this->credentialsExpireAt;
    }

}

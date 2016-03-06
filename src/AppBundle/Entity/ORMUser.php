<?php

// src/AppBundle/Entity/User.php

namespace AppBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name = "user")
 */
class ORMUser extends BaseUser
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

}

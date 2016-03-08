<?php

// src/AppBundle/Entity/User.php

namespace AppBundle\Model;

use FOS\UserBundle\Model\GroupInterface;

/**
 * User.
 */
interface UserInterface
{
    /**
     * @param array array().
     */
    public static function fromArray(array $array = array());

    public function __construct();

    public function addRole($role);

    /**
     * Serializes the user.
     *
     * The serialized data have to contain the fields used by the equals method and the username.
     *
     * @return string
     */
    public function serialize();

    /**
     * Unserializes the user.
     *
     * @param string $serialized
     */
    public function unserialize($serialized);

    /**
     * Removes sensitive data from the user.
     */
    public function eraseCredentials();

    /**
     * Returns the user unique id.
     *
     * @return mixed
     */
    public function getId();

    public function getUsername();

    public function getUsernameCanonical();

    public function getSalt();

    public function getDescription();

    public function getEmail();

    public function getEmailCanonical();

    /**
     * Gets the encrypted password.
     *
     * @return string
     */
    public function getPassword();

    public function getPlainPassword();

    /**
     * Gets the last login time.
     *
     * @return \DateTime
     */
    public function getLastLogin();

    public function getConfirmationToken();

    /**
     * Returns the user roles.
     *
     * @return array The roles
     */
    public function getRoles();

    /**
     * Never use this to check if this user has access to anything!
     *
     * Use the SecurityContext, or an implementation of AccessDecisionManager
     * instead, e.g.
     *
     *         $securityContext->isGranted('ROLE_USER');
     *
     * @param string $role
     *
     * @return bool
     */
    public function hasRole($role);

    public function isAccountNonExpired();

    public function isAccountNonLocked();

    public function isCredentialsNonExpired();

    public function isCredentialsExpired();

    public function isEnabled();

    public function isExpired();

    public function isLocked();

    public function isSuperAdmin();

    public function isUser();

    public function removeRole($role);

    public function setUsername($username);

    public function setUsernameCanonical($usernameCanonical);

    /**
     * @param \DateTime $date
     *
     * @return User
     */
    public function setCredentialsExpireAt(\DateTime $date);

    /**
     * @param bool $boolean
     *
     * @return User
     */
    public function setCredentialsExpired($boolean);

    public function setDescription($description);

    public function setEmail($email);

    public function setEmailCanonical($emailCanonical);

    public function setEnabled($boolean);

    /**
     * Sets this user to expired.
     *
     * @param bool $boolean
     *
     * @return User
     */
    public function setExpired($boolean);

    /**
     * @param \DateTime $date
     *
     * @return User
     */
    public function setExpiresAt(\DateTime $date);

    public function setPassword($password);

    public function setSuperAdmin($boolean);

    public function setPlainPassword($password);

    public function setLastLogin(\DateTime $time);

    public function setLocked($boolean);

    public function setConfirmationToken($confirmationToken);

    public function setPasswordRequestedAt(\DateTime $date = null);

    /**
     * Gets the timestamp that the user requested a password reset.
     *
     * @return null|\DateTime
     */
    public function getPasswordRequestedAt();

    public function isPasswordRequestNonExpired($ttl);

    public function setRoles(array $roles);

    /**
     * Gets the groups granted to the user.
     *
     * @return Collection
     */
    public function getGroups();

    public function getGroupNames();

    public function hasGroup($name);

    public function addGroup(GroupInterface $group);

    public function removeGroup(GroupInterface $group);

    public function __toString();
}

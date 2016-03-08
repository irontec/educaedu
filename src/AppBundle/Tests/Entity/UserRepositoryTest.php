<?php

namespace AppBundle\Tests\Entity;

use AppBundle\Entity\User;
use AppBundle\Entity\UserGateway;
use AppBundle\Model\UserFactory;
use AppBundle\Model\UserRepository;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class UserRepositoryTest extends WebTestCase
{
    const USER = 'koldo';
    const EMAIL = 'koldo@koldo.mail';
    const PASS = 'Demo1234';
    const DESC = 'Hola mondo';

    /**
     * @var UserGateway
     */
    private $gateway;

    /**
     * @var UserRepository
     */
    private $repository;

    /**
     * Set up UserRepository.
     */
    public function setUp()
    {
        parent::setUp();
        $gatewayClassname = 'AppBundle\Entity\UserGateway';
        $this->gateway = $this->prophesize($gatewayClassname);
        $this->factory = new UserFactory();
        $this->repository = new UserRepository($this->gateway->reveal(), $this->factory);
    }

    public function testFindAllUsersFromRepository()
    {
        $users = $this->repository->findAll();

        $this->assertTrue(is_array($users));
    }

    public function testFindByUsersFromRepositoryWithEmptyParams()
    {
        $users = $this->repository->findBy();

        $this->assertTrue(is_array($users));
    }

    public function testFindByUsersFromRepositoryWithValidParams()
    {
        $fakeUser = new User();
        $fakeUsers = array($fakeUser->fromArray(array('username' => self::USER, 'email' => self::EMAIL, 'password' => self::PASS)));
        $this->gateway->findBy(array('username' => self::USER), array('username' => 'ASC'), 10, null)->willReturn($fakeUsers);
        $fakeUsers = $this->factory->makeAll($fakeUsers);

        $users = $this->repository->findBy(array('username' => self::USER), array('username' => 'ASC'), 10, null);

        $this->assertTrue(is_array($users));
        //  var_dump($users);die();
        foreach ($users as $user) {
            $this->assertTrue($user instanceof User);
        }
    }

    public function testFindOneByWithParams()
    {
        $fakeUser = new User();
        $fakeUser = $fakeUser->fromArray(array('username' => self::USER, 'email' => self::EMAIL, 'password' => self::PASS, 'description' => self::DESC));

        $this->gateway->findOneBy(array('username' => self::USER), array())->willReturn($fakeUser);
        $fakeUser = $this->factory->makeOne($fakeUser);

        $user = $this->repository->findOneBy(array('username' => self::USER));

        $this->assertTrue($user instanceof User);
        $this->assertEquals($user->getUsername(), $fakeUser->getUsername());
        $this->assertEquals($user->getEmail(), $fakeUser->getEmail());
        $this->assertEquals($user->getDescription(), $fakeUser->getDescription());
        $this->assertEquals($user->getUsername(), $user->__toString());
    }

    public function testFindOneByWithBadParams()
    {
        $this->repository->findOneBy(array('name' => 'jhkjgkjh'), array());
    }
}

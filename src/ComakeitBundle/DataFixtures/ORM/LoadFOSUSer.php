<?php

namespace Acme\DemoBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;

//use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Description of LoadFOSUSer
 *
 * @author nisam
 */
class LoadFOSUSerData implements FixtureInterface, OrderedFixtureInterface, ContainerAwareInterface {

  public function load(ObjectManager $manager) {
    // Get our userManager, you must implement `ContainerAwareInterface`
    $userManager = $this->container->get('fos_user.user_manager');

    // Create our user and set details
    $user = $userManager->createUser();
    $user->setUsername('admin');
    $user->setEmail('admin@admin.com');
    $user->setPlainPassword('password');
    //$user->setPassword('3NCRYPT3D-V3R51ON');
    $user->setEnabled(true);
    $user->setRoles(array('ROLE_ADMIN'));

    // Update the user
    $userManager->updateUser($user, true);
  }

  public function getOrder() {
    return 1;
  }

  public function setContainer(\Symfony\Component\DependencyInjection\ContainerInterface $container = null) {
    $this->container = $container;
  }

}

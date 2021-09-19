<?php
// src/Entity/RegistrationUser.php
namespace App\Entity;

use App\Repository\RegistrationUserRepository;
use Doctrine\DBAL\Types\DateTimeType;
use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Entity(repositoryClass="App\Repository\RegistrationUserRepository")
 * @ORM\Table(name="RegistrationUser")
 */
class RegistrationUser {

  /**
   * @ORM\Id()
   * @ORM\GeneratedValue()
   * @ORM\Column(name="id", type="integer")
   */
  private $id;

  /**
  * @ORM\Column(name="name", type="string", length=255)
  */
  private $name;

  /**
   * @ORM\Column(name="surname", type="string", length=255)
   */
  private $surname;

  /**
   * @ORM\Column(name="username", type="string", length=255)
   */
  private $username;

  /**
  * @ORM\Column(name="registrationDate", type="datetime")
  * @ORM\GeneratedValue()
  */
  private $registrationDate;

  /**
   * @ORM\Column(name="email", type="string", length=255, unique=true)
   */
  private $email;

  /**
   * @ORM\Column(name="passwordHash", type="text")
   */
  private $passwordHash;

  public function __construct(){
    $this->registrationDate = new \DateTime('now');
  }

  public function setName(string $name) {
    $this->name = $name;
  }

  public function getName() {
    return $this->name;
  }

  public function setSurname($surname) {
    $this->surname = $surname;
  }

  public function getSurname() {
    return $this->surname;
  }

  public function setUsername($username) {
    $this->username = $username;
  }

  public function getUsername() {
    return $this->username;
  }

  public function setEmail($email) {
    $this->email = $email;
  }

  public function getEmail() {
    return $this->email;
  }

  public function setRegistrationDate($date) {
    $this->registrationDate = $date ?: new \DateTime("now");
  }

  public function getRegistrationDate() {
    return $this->registrationDate;
  }

  public function getId(): int
  {
      return $this->id;
  }

  public function setPasswordHash($psswd) {
    $this->passwordHash = $psswd;
  }

  public function getPasswordHash() {
    return $this->passwordHash;
  }

  public function getPassword() {
    return FALSE;
  }

  public function setPassword($psswd) {
    $this->passwordHash = $psswd;
  }

}

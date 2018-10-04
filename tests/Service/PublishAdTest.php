<?php

use App\Entity\Creative;
use PHPUnit\Framework\TestCase;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;

class PublishAdTest extends KernelTestCase
{

  private $publishad;
  private $encoders;
  private $normalizers;
  private $serializer;
  private $entityManager;

  protected function setUp()
  {
    self::bootKernel();
    $this->publishad = self::$kernel->getContainer()->get("PublishAd");
    $this->encoders = array(new JsonEncoder());
    $this->normalizers = array(new ObjectNormalizer());
    $this->serializer = new Serializer($this->normalizers, $this->encoders);
    $this->entityManager = self::$kernel->getContainer()->get('doctrine')->getManager();
  }

  public function testPublish()
  {
    //create a new Creative
    $creative = new Creative;
    $creative->setState("Stopped");
    //save the Creative
    $this->entityManager->persist($creative);
    //execute the queries
    $this->entityManager->flush();
    $result=$this->publishad->publish($creative);
  
  }

  protected function tearDown()
   {
       parent::tearDown();

       $this->entityManager->close();
       $this->entityManager = null; // avoid memory leaks
   }

}

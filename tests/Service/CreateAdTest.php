<?php
use App\Service\CreateAd;

use App\Entity\Creative;
use App\Entity\Component;
use App\Entity\Text;
use App\Entity\Image;
use App\Entity\Video;

use PHPUnit\Framework\TestCase;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;

class CreateAdTest extends KernelTestCase
{

  private $createad;
  private $encoders;
  private $normalizers;
  private $serializer;

  protected function setUp()
  {
    self::bootKernel();
    $this->createad = self::$kernel->getContainer()->get("CreateAd");
    $this->encoders = array(new JsonEncoder());
    $this->normalizers = array(new ObjectNormalizer());
    $this->serializer = new Serializer($this->normalizers, $this->encoders);
  }

  public function testText()
  {
    $result=$this->createad->text("12345123451","anuncio1",1,1,1,1,1);
  }

  public function testTextContentLengthNotValid()
  {
    //create a string of length 141
    for($i=0,$content=0;$i<=141;$i++){
      $content.="1";
    }

    $result=$this->createad->text($content,"anuncio1",1,1,1,1,1);
    $this->assertContains("Your content can not be greater than 140 characters",$result);
    $result=$this->createad->text("","anuncio1",1,1,1,1,1);
    $this->assertContains("This value should not be blank",$result);
  }
  public function testTextNameLengthNotValid()
  {
    //create a string of length 256
    for($i=0,$name=0;$i<=256;$i++){
      $name.="1";
    }
    $result=$this->createad->text("foo",$name,1,1,1,1,1);
    $this->assertContains("Your name can not be greater than 255 characters",$result);
    $result=$this->createad->text("foo","",1,1,1,1,1);
    $this->assertContains("This value should not be blank",$result);
  }

  public function testTextPosNotValid()
  {
    try{
      $result=$this->createad->text("foo","anuncio1","",1,1,1,1);
    }catch(TypeError $e){
      $this->assertContains("Argument 1 passed to App\Entity\Component::setPosx() must be of the type integer",$e->getMessage());
    }
    try{
      $result=$this->createad->text("foo","anuncio1",1,"",1,1,1);
    }catch(TypeError $e){
      $this->assertContains("Argument 1 passed to App\Entity\Component::setPosy() must be of the type integer",$e->getMessage());
    }
    try{
      $result=$this->createad->text("foo","anuncio1",1,1,"",1,1);
    }catch(TypeError $e){
      $this->assertContains("Argument 1 passed to App\Entity\Component::setPosz() must be of the type integer",$e->getMessage());
    }
  }

  public function testTextWidthNotValid()
  {
    try{
      $result=$this->createad->text("foo","anuncio1",1,1,1,"",1);
    }catch(TypeError $e){
      $this->assertContains("Argument 1 passed to App\Entity\Component::setWidth() must be of the type integer",$e->getMessage());
    }
  }

  public function testTextHeightNotValid()
  {
    try{
      $result=$this->createad->text("foo","anuncio1",1,1,1,1,"");
    }catch(TypeError $e){
      $this->assertContains("Argument 1 passed to App\Entity\Component::setHeight() must be of the type integer",$e->getMessage());
    }
  }

  public function testImage()
  {
    $result=$this->createad->image("foo","JPG",1,"anuncio1",1,1,1,1,1);
  }

  public function testImageUrlLengthNotValid(){
    //create a string of length 2085
    for($i=0,$url=0;$i<=2085;$i++){
      $url.="1";
    }

    $result=$this->createad->image($url,"JPG",1,"image",1,1,1,1,1);
    $this->assertContains("Your url can not be greater than 2083 characters",$result);
    $result=$this->createad->image("","JPG",1,"image",1,1,1,1,1);
    $this->assertContains("This value should not be blank",$result);
  }

  public function testImageFormatNotValid(){
    $result=$this->createad->image("foo","GIF",1,"anuncio1",1,1,1,1,1);
    $this->assertContains("Choose a valid format [JPG,PNG]",$result);
  }

  public function testImageWeightNotValid(){
    try{
      $result=$this->createad->image("foo","JPG","","anuncio1",1,1,1,1,1);
    }catch(TypeError $e){
      $this->assertContains("Argument 1 passed to App\Entity\Image::setWeight() must be of the type integer",$e->getMessage());
    }
  }


  public function testImageNameLengthNotValid()
  {
    //create a string of length 256
    for($i=0,$name=0;$i<=256;$i++){
      $name.="1";
    }
    $result=$this->createad->image("foo","JPG",1,$name,1,1,1,1,1);
    $this->assertContains("Your name can not be greater than 255 characters",$result);
    $result=$this->createad->image("foo","JPG",1,"",1,1,1,1,1);
    $this->assertContains("This value should not be blank",$result);
  }

  public function testImagePosNotValid()
  {
    try{
      $result=$this->createad->image("foo","JPG",1,"anuncio1","",1,1,1,1);
    }catch(TypeError $e){
      $this->assertContains("Argument 1 passed to App\Entity\Component::setPosx() must be of the type integer",$e->getMessage());
    }
    try{
      $result=$this->createad->image("foo","JPG",1,"anuncio1",1,"",1,1,1);
    }catch(TypeError $e){
      $this->assertContains("Argument 1 passed to App\Entity\Component::setPosy() must be of the type integer",$e->getMessage());
    }
    try{
      $result=$this->createad->image("foo","JPG",1,"anuncio1",1,1,"",1,1);
    }catch(TypeError $e){
      $this->assertContains("Argument 1 passed to App\Entity\Component::setPosz() must be of the type integer",$e->getMessage());
    }
  }

  public function testImageWidthNotValid()
  {
    try{
      $result=$this->createad->image("foo","JPG",1,"anuncio1",1,1,1,"",1);
    }catch(TypeError $e){
      $this->assertContains("Argument 1 passed to App\Entity\Component::setWidth() must be of the type integer",$e->getMessage());
    }
  }

  public function testImageHeightNotValid()
  {
    try{
      $result=$this->createad->image("foo","JPG",1,"anuncio1",1,1,1,1,"");
    }catch(TypeError $e){
      $this->assertContains("Argument 1 passed to App\Entity\Component::setHeight() must be of the type integer",$e->getMessage());
    }
  }

  public function testVideo()
  {
    $result=$this->createad->video("foo","MP4",1,"anuncio1",1,1,1,1,1);
  }
  public function testVideoUrlLengthNotValid(){
    //create a string of length 2085
    for($i=0,$url=0;$i<=2085;$i++){
      $url.="1";
    }

    $result=$this->createad->video($url,"MP4",1,"video",1,1,1,1,1);
    $this->assertContains("Your url can not be greater than 2083 characters",$result);
    $result=$this->createad->video("","MP4",1,"video",1,1,1,1,1);
    $this->assertContains("This value should not be blank",$result);

  }

  public function testVideoFormatNotValid(){
    $result=$this->createad->video("foo","XVID",1,"anuncio1",1,1,1,1,1);
    $this->assertContains("Choose a valid format [MP4,WEBM]",$result);
  }

  public function testVideoWeightNotValid(){
    try{
      $result=$this->createad->video("foo","JPG","","anuncio1",1,1,1,1,1);
    }catch(TypeError $e){
      $this->assertContains("Argument 1 passed to App\Entity\Video::setWeight() must be of the type integer",$e->getMessage());
    }
  }

  public function testVideoNameLengthNotValid()
  {
    //create a string of length 256
    for($i=0,$name=0;$i<=256;$i++){
      $name.="1";
    }
    $result=$this->createad->video("foo","MP4",1,$name,1,1,1,1,1);
    $this->assertContains("Your name can not be greater than 255 characters",$result);
    $result=$this->createad->video("foo","MP4",1,"",1,1,1,1,1);
    $this->assertContains("This value should not be blank",$result);
  }

  public function testVideoPosNotValid()
  {
    try{
      $result=$this->createad->video("foo","MP4",1,"anuncio1","",1,1,1,1);
    }catch(TypeError $e){
      $this->assertContains("Argument 1 passed to App\Entity\Component::setPosx() must be of the type integer",$e->getMessage());
    }
    try{
      $result=$this->createad->video("foo","MP4",1,"anuncio1",1,"",1,1,1);
    }catch(TypeError $e){
      $this->assertContains("Argument 1 passed to App\Entity\Component::setPosy() must be of the type integer",$e->getMessage());
    }
    try{
      $result=$this->createad->video("foo","MP4",1,"anuncio1",1,1,"",1,1);
    }catch(TypeError $e){
      $this->assertContains("Argument 1 passed to App\Entity\Component::setPosz() must be of the type integer",$e->getMessage());
    }
  }

  public function testVideoWidthNotValid()
  {
    try{
      $result=$this->createad->video("foo","MP$",1,"anuncio1",1,1,1,"",1);
    }catch(TypeError $e){
      $this->assertContains("Argument 1 passed to App\Entity\Component::setWidth() must be of the type integer",$e->getMessage());
    }
  }

  public function testVideoHeightNotValid()
  {
    try{
      $result=$this->createad->video("foo","MP4",1,"anuncio1",1,1,1,1,"");
    }catch(TypeError $e){
      $this->assertContains("Argument 1 passed to App\Entity\Component::setHeight() must be of the type integer",$e->getMessage());
    }
  }

}

<?php

namespace App\Service;

use App\Entity\Creative;
use App\Entity\Component;
use App\Entity\Text;
use App\Entity\Image;
use App\Entity\Video;
use Doctrine\ORM\EntityManager;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Validator\Validator\TraceableValidator;

class CreateAd {

    private $entityManager;
    private $serializer;
    private $validator;

    /**
     * 
     * @param EntityManager $entityManager
     * @param Serializer $serializer
     * @param TraceableValidator $validator
     */
    public function __construct(EntityManager $entityManager, Serializer $serializer, TraceableValidator $validator) {
        $this->entityManager = $entityManager;
        $this->serializer = $serializer;
        $this->validator = $validator;
    }

    /**
     * Create a new Creative object
     * 
     * @param string $state
     * @return Creative
     * @throws \Exception
     */
    private function createCreative($state) {
        //create a new creative
        $creative = new Creative();
        $creative->setState($state);

        //verify if the data on the creative object satisfies the constraints
        $errors = $this->validator->validate($creative);

        if (count($errors) > 0) {
            $errorsString = (string) $errors;
            throw new \Exception($errorsString);
        }

        return $creative;
    }

    /**
     * Create a new Component object
     * 
     * @param string $name
     * @param int $posx
     * @param int $posy
     * @param int $posz
     * @param int $width
     * @param int $heigh
     * @return Component
     * @throws \Exception
     */
    private function createComponent($name, $posx, $posy, $posz, $width, $heigh) {
        //create a new component
        $component = new Component();
        $component->setName($name);
        $component->setPosx($posx);
        $component->setPosy($posy);
        $component->setPosz($posz);
        $component->setWidth($width);
        $component->setHeight($heigh);

        //verify if the data on the component object satisfies the constraints
        $errors = $this->validator->validate($component);

        if (count($errors) > 0) {
            $errorsString = (string) $errors;
            throw new \Exception($errorsString);
        }

        return $component;
    }

    /**
     * Create a new Text object
     * 
     * @param string $content
     * @return Text
     * @throws \Exception
     */
    private function createText($content) {
        //create a new text
        $text = new Text();
        $text->setContent($content);

        //verify if the data on the text object satisfies the constraints
        $errors = $this->validator->validate($text);

        if (count($errors) > 0) {
            $errorsString = (string) $errors;
            throw new \Exception($errorsString);
        }

        return $text;
    }

    /**
     * Create a new Image object
     * 
     * @param string $url
     * @param string $format
     * @param int $weight
     * @return Image
     * @throws \Exception
     */
    private function createImage($url, $format, $weight) {
        //create a new image
        $image = new Image();
        $image->setUrl($url);
        $image->setFormat($format);
        $image->setWeight($weight);

        //verify if the data on the image object satisfies the constraints
        $errors = $this->validator->validate($image);

        if (count($errors) > 0) {
            $errorsString = (string) $errors;
            throw new \Exception($errorsString);
        }

        return $image;
    }

    /**
     * Create a new Video object
     * 
     * @param string $url
     * @param string $format
     * @param int $weight
     * @return Video
     * @throws \Exception
     */
    private function createVideo($url, $format, $weight) {
        //create a new video
        $video = new Video();
        $video->setUrl($url);
        $video->setFormat($format);
        $video->setWeight($weight);

        //verify if the data on the video object satisfies the constraints
        $errors = $this->validator->validate($video);

        if (count($errors) > 0) {
            $errorsString = (string) $errors;
            throw new \Exception($errorsString);
        }

        return $video;
    }

    /**
     * Create a new text creative
     * 
     * @param string $content
     * @param string $name
     * @param int $posx
     * @param int $posy
     * @param int $posz
     * @param int $width
     * @param int $heigh
     * @return array
     */
    public function text($content, $name, $posx, $posy, $posz, $width, $heigh) {
        //create Creative , Component and Text
        try {
            $creative = $this->createCreative("Stopped");
            $component = $this->createComponent($name, $posx, $posy, $posz, $width, $heigh);
            $text = $this->createText($content);
        } catch (\Exception $e) {
            return $e->getMessage();
        }

        // add text to component
        $component->addText($text);
        //add componet to creative
        $creative->addComponent($component);

        //save the Creative
        $this->entityManager->persist($creative);
        //execute the queries
        $this->entityManager->flush();

        //serialize the creative into JSON
        $json = $this->serializer->serialize($creative, 'json');

        return $json;
    }

    /**
     * Create a new image creative
     * 
     * @param string $url
     * @param int $format
     * @param int $weight
     * @param string $name
     * @param int $posx
     * @param int $posy
     * @param int $posz
     * @param int $width
     * @param int $heigh
     * @return array
     */
    public function image($url, $format, $weight, $name, $posx, $posy, $posz, $width, $heigh) {
        //create Creative , Component and Image
        try {
            $creative = $this->createCreative("Stopped");
            $component = $this->createComponent($name, $posx, $posy, $posz, $width, $heigh);
            $image = $this->createImage($url, $format, $weight);
        } catch (\Exception $e) {
            return $e->getMessage();
        }

        // add image to component
        $component->addImage($image);
        //add componet to creative
        $creative->addComponent($component);

        //save the Creative
        $this->entityManager->persist($creative);
        //execute the queries
        $this->entityManager->flush();

        //serialize the creative into JSON
        $json = $this->serializer->serialize($creative, 'json');

        return $json;
    }

    /**
     * Create a new video creative
     * 
     * @param string $url
     * @param string $format
     * @param int $weight
     * @param string $name
     * @param int $posx
     * @param int $posy
     * @param int $posz
     * @param int $width
     * @param int $heigh
     * @return array
     */
    public function video($url, $format, $weight, $name, $posx, $posy, $posz, $width, $heigh) {
        //create Creative , Component and Video
        try {
            $creative = $this->createCreative("Stopped");
            $component = $this->createComponent($name, $posx, $posy, $posz, $width, $heigh);
            $video = $this->createVideo($url, $format, $weight);
        } catch (\Exception $e) {
            return $e->getMessage();
        }

        // add video to component
        $component->addVideo($video);
        //add componet to creative
        $creative->addComponent($component);

        //save the Creative
        $this->entityManager->persist($creative);
        //execute the queries
        $this->entityManager->flush();

        //serialize the creative into JSON
        $json = $this->serializer->serialize($creative, 'json');

        return $json;
    }

}

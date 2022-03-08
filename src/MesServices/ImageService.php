<?php

namespace App\MesServices;

use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;


class ImageService

{

     protected $slugger;
     protected $parameterBag;


     public function __construct(SluggerInterface $slungger, ParameterBagInterface $parameterBagInterface)

     {
          $this->slugger = $slungger;
          $this->parameterBag = $parameterBagInterface;
     }





     public function sauvegarderImage(object $object, object $file)
     {
          $originalFileName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
          $safeFileName = $this->slugger->slug($originalFileName);
          $newFileName = $safeFileName . '-' . uniqid() . '.' . $file->guessExtension();

          $file->move(
               $this->parameterBag->get('app_images_directory'),
               $newFileName
          );

          $object->setImage('uploads/' . $newFileName);
     }



     public function supprimerImage(string $fileName)
     {
          $pathFile = $this->parameterBag->get('app_images_directory') . '/..' . $fileName;

          if (file_exists($pathFile)) {
               unlink($pathFile);
          }
     }
}

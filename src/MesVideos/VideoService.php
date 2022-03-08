<<<<<<< HEAD
<?php

namespace App\MesVideos;

use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;


class VideoService

{

     protected $slugger;
     protected $parameterBag;


     public function __construct(SluggerInterface $slugger, ParameterBagInterface $parameterBagInterface)

     {
          $this->slugger = $slugger;
          $this->parameterBag = $parameterBagInterface;
     }





     public function sauvegarderPartager(object $object, object $file)
     {
          $originalFileName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
          $safeFileName = $this->slugger->slug($originalFileName);
          $newFileName = $safeFileName . '-' . uniqid() . '.' . $file->guessExtension();

          $file->move(
               $this->parameterBag->get('app_images_directory'),
               $newFileName
          );

          $object->setPartager('uploads/' . $newFileName);
     }


     public function supprimerPartager(string $fileName)
     {
          $pathFile = $this->parameterBag->get('app_images_directory') . '/..' . $fileName;

          if (file_exists($pathFile)) {
               unlink($pathFile);
          }
     }
}
=======
<?php

namespace App\MesVideos;

use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;


class VideoService

{

     protected $slugger;
     protected $parameterBag;


     public function __construct(SluggerInterface $slugger, ParameterBagInterface $parameterBagInterface)

     {
          $this->slugger = $slugger;
          $this->parameterBag = $parameterBagInterface;
     }





     public function sauvegarderPartager(object $object, object $file)
     {
          $originalFileName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
          $safeFileName = $this->slugger->slug($originalFileName);
          $newFileName = $safeFileName . '-' . uniqid() . '.' . $file->guessExtension();

          $file->move(
               $this->parameterBag->get('app_images_directory'),
               $newFileName
          );

          $object->setPartager('uploads/' . $newFileName);
     }


     public function supprimerPartager(string $fileName)
     {
          $pathFile = $this->parameterBag->get('app_images_directory') . '/..' . $fileName;

          if (file_exists($pathFile)) {
               unlink($pathFile);
          }
     }
}
>>>>>>> 586cd3136a80a2bc73c9e90930e5d4dce85100c9

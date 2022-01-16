<?php

namespace App\MesPhotos; 

use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;


class Photo

{

     protected $slugger; 
     protected $parameterBag; 


    public function __construct(SluggerInterface $slugger,ParameterBagInterface $parameterBagInterface)

    {
         $this->slugger = $slugger; 
         $this->parameterBag = $parameterBagInterface;  
    }





     public function sauvegarderPhotoProfil(object $object, object $file)
     {
          $originalFileName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME); 
                $safeFileName = $this->slugger->slug($originalFileName); 
                $newFileName = $safeFileName. '-' . uniqid() . '.' . $file->guessExtension(); 

                $file->move(
                    $this->parameterBag->get('app_images_directory'),
                    $newFileName
                ); 

                $object->setPhotoProfil('uploads/'. $newFileName);

                
     }
          


       public function supprimerPhotoProfil( string $fileName)
       {
              $pathFile = $this->parameterBag->get('app_images_directory') . '/..' . $fileName; 

              if(file_exists($pathFile))
              {
                   unlink($pathFile); 
              }

       }

}
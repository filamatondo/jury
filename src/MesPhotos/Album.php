<?php

namespace App\MesPhotos; 

use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;


class Album

{

     protected $slugger; 
     protected $parameterBag; 


    public function __construct(SluggerInterface $slugger,ParameterBagInterface $parameterBagInterface)

    {
         $this->slugger = $slugger; 
         $this->parameterBag = $parameterBagInterface;  
    }





     public function sauvegarderImage(object $object, object $file)
     {
          $originalFileName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME); 
                $safeFileName = $this->slugger->slug($originalFileName); 
                $newFileName = $safeFileName. '-' . uniqid() . '.' . $file->guessExtension(); 

                $file->move(
                    $this->parameterBag->get('app_images_directory'),
                    $newFileName
                ); 

                $object->setVu('uploads/'. $newFileName);

                
     }
          


       public function supprimerVu( string $fileName)
       {
              $pathFile = $this->parameterBag->get('app_images_directory') . '/..' . $fileName; 

              if(file_exists($pathFile))
              {
                   unlink($pathFile); 
              }

       }

}
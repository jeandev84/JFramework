<?php
namespace App\Services;


use Jan\Component\DI\Contracts\ContainerInterface;

/**
 * Class FileUploader
 * @package App\Services
*/
class FileUploader
{


    private $container;


    /**
     * FileUploader constructor.
     * @param ContainerInterface $container
    */
    public function __construct(ContainerInterface $container)
    {
        // for example
        $this->container = $container;
    }


    // public function upload(UploadedFile $uploadedFile) { }
}
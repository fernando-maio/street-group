<?php

namespace App\Components;

use Illuminate\Support\Facades\Storage;

/**
 * File Class
 */
class File
{        
    /**
     * @var string
     */
    private $fileName = 'file.csv';

    /**
     * uploadFile
     *
     * @param UploadedFile $file
     * 
     * @return string $filePath
     */
    public function uploadFile($file)
    {
        if(empty($file)){
            return false;
        }

        return Storage::putFileAs('csv', $file, $this->fileName);
    }
    
    /**
     * readCsvFile
     *
     * @param  string $file
     * 
     * @return array
     */
    public function readCsvFile($file)
    {
        $peopleObject = new People();

        // Check if file exists.
        if(!Storage::exists($file)){
            return array(
                'status' => 'error',
                'msg' => 'File not found.'
            );
        }

        // Open, Read and Close CSV file.
        $handle = fopen(storage_path('app/' . $file),'r');
        $clients = $peopleObject->splitClients($handle);
        fclose($handle);

        // Prepare data
        $peopleData = $peopleObject->getPeopleData($clients);
        $people = $peopleData['people'];
        $errorLines = $peopleData['errors'];

        // Check if exist errors on the file lines.
        if(count($errorLines)){
            return array(
                'status' => 'error',
                'msg' => 'Title or Last Name not found for the following clients: ' . implode(', ', $errorLines)
            );
        }

        return array(
            'status' => 'success',
            'data' => $people
        );
    }
}
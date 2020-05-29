<?php

namespace App\Components;

use Illuminate\Support\Facades\Validator;

/**
 * Validation Class
 */
class Validation
{
    /**
     * CSV File Validation
     * 
     * @param array $data
     * 
     * @return Validator
     */
    public static function csvFileValidation($data)
    {
        $rules = array(
            'csv_file' => 'required|mimes:csv,txt'
        );

        $messages = array(
	    	'csv_file.required' => 'Select a file.',
	    	'csv_file.mimes' => 'The file must be a csv.'
        );
        
        return Validator::make($data, $rules, $messages);
    }
}
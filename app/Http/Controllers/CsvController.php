<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Components\File;
use App\Components\Validation;

/**
 * CsvController
 */
class CsvController extends Controller
{    
    /**
     * Index page
     *
     * @return View
     */
    public function index()
    {
        return view('home');
    }

    /**
     * Import CSV File
     *
     * @param  Request $request
     * 
     * @return void
     */
    public function import(Request $request)
    {
        $validation = Validation::csvFileValidation($request->all());
        if (!$validation->passes()) {
            return redirect()
            ->back()
            ->withErrors($validation);
        }

        $fileObject = new File();

        $file = $fileObject->uploadFile($request->file('csv_file'));
        if(!$file){
            return redirect()
            ->back()
            ->withErrors('Error to upload CSV file. Please, try again!');
        }

        $data = $fileObject->readCsvFile($file);
        if($data['status'] == 'error'){
            return redirect()
            ->back()
            ->withErrors($data['msg']);
        }

        return view('home', array('data' => $data));
    }    
}

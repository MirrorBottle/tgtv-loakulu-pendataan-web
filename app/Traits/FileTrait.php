<?php

namespace App\Traits;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


trait FileTrait
{
    /**
     * Does very basic image validity checking and stores it. Redirects back if somethings wrong.
     * @Notice: This is not an alternative to the model validation for this field.
     *
     * @param Request $request
     * @return $this|false|string
     */
    public function deleteFile($filename, $directory)
    {
        if (Storage::disk('public')->exists(str_replace("/storage/", "", $filename))) {
            Storage::disk('public')->delete(str_replace("/storage/", "", $filename));
            return true;
        }
        return null;
    }
    /**
     * Does very basic image validity checking and stores it. Redirects back if somethings wrong.
     * @Notice: This is not an alternative to the model validation for this field.
     *
     * @param Request $request
     * @return $this|false|string
     */
    public function storeFile(Request $request, $fieldname = 'image', $directory = 'files', $isFullPath = true)
    {
        if ($request->hasFile($fieldname)) {
            if (!$request->file($fieldname)->isValid()) {
                flash('Invalid Image!')->error()->important();
                return redirect()->back()->withInput();
            }
            // Get filename with the extension
            $filenameWithExtension  = $request->file($fieldname)->getClientOriginalName();
            // Get just filename
            $filename = pathinfo($filenameWithExtension, PATHINFO_FILENAME);
            //Get just extension
            $extension = $request->file($fieldname)->getClientOriginalExtension();
            //Filename to store;
            $filenameToStore = $filename . '_' . time() . '.' . $extension;
            $path = $request->file($fieldname)->storeAs("public/$directory", $filenameToStore);
            return $isFullPath ? "/storage/$directory/$filenameToStore" : $filenameToStore;
        }
        return null;
    }
    /**
     * It deletes file using deleteFile and then store new file with storeFile
     *
     * @param Request $request
     */
    public function editFile($oldFilename, Request $request, $fieldname = 'image', $directory = 'files')
    {
        if ($request->hasFile($fieldname)) {
            if ($this->deleteFile($oldFilename, $directory)) {
                return $this->storeFile($request, $fieldname, $directory, true);
            }
        }
        return $oldFilename;
    }
}

<?php
namespace Infinety\FileManager\Services;

use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * Class Image
 * @package App\Services\ImageUploadService
 */
class FileFunctionsService
{

    /**
     * Home Path
     * @var
     */
    protected $path;

    /**
     * FileUploadService constructor.
     */
    public function __construct()
    {
        $this->path = config('filemanager.homePath');
    }

    /**
     * Handles Upload File Method
     * @param UploadedFile|null $file
     * @param $folder
     * @return stringch
     */
    public function uploadFile(UploadedFile $file = null, $folder){
        $result = $this->upload($file, $folder);
        return $result;
    }

    /**
     * Creates new folder on path
     * @param $newName
     * @param $currentFolder
     * @return array
     */
    public function createFolder($newName, $currentFolder){

        $path = $this->path.DIRECTORY_SEPARATOR.$currentFolder.DIRECTORY_SEPARATOR;
        if(!is_writable($path)){
            return ['error' => 'This folder is not writable'];
        }

        if($this->checkFolderExists($path.$newName)){
            return ['error' => 'This folder already exists'];
        }

        try{
            mkdir($path.$newName, 0755);
            return ['success' => 'Folder '.$newName.' created successfully'];
        } catch(\Exception $e) {
            return ['error' => 'Error creating folder'];
        }
    }


    /**
     * Move or rename a file or folder
     *
     * @param $oldFile
     * @param $newPath
     * @param $name
     * @param $type
     * @param string $fileOrFolder
     * @return array
     */
    public function rename($oldFile, $newPath, $name, $type, $fileOrFolder = 'file'){

        $permissions = $this->checkPerms($newPath);
        if($permissions == 400 || $permissions == 700){
            return ['error' => "You don't have permissions to move to this folder"];
        }


        $name = $this->checkValidNameOption($name, $fileOrFolder);

        $name = (!$this->checkFileExists($newPath,$name)) ? $name : $this->checkFileExists($newPath,$name);

        if(rename($oldFile, $newPath.$name)){
            if($type = 'rename'){
                return ['success' => ucfirst($fileOrFolder).' '.$name.' renamed successfully'];
            } else {
                return ['success' => ucfirst($fileOrFolder).' '.$name.' moved successfully'];
            }

        } else {
            return ['error' => "Error moving this file"];
        }
    }

    /**
     * Deletes a file or Folder
     * @param $data
     * @param $folder
     * @param $type
     * @return array
     */
    public function delete($data, $folder,  $type){
        if($type == 'folder'){
            try{
                $folder = rtrim($this->path.DIRECTORY_SEPARATOR.$folder.DIRECTORY_SEPARATOR.$data,"/");
                $this->deleteFolderRecursive($folder);
                return ['success' => 'Folder '.$data.' deleted successfully'];
            } catch(\Exception $e) {
                return ['error' => 'Error deleting folder'];
            }
        }

        if($type == 'file'){
            try{

                unlink($this->path.DIRECTORY_SEPARATOR.$folder.DIRECTORY_SEPARATOR.$data);
                return ['success' => 'File '.$data.' deleted successfully'];
            } catch(\Exception $e) {
                return ['error' => 'Error deleting file'];
            }
        }
    }

    /**
     * Optimize an image. Only supports JPG and PNG files
     * 
     * @param  string $file
     * @param  string $type
     * @return array
     */
    public function optimize($file, $type)
    {

        //Try to compress 
        if(config('filemanager.optimizeImages') == true){

            if(config('filemanager.pngquantPath') != null){
                //Compress PNG files
                if($type == 'png'){
                    $compressed_png_content = $this->compress_png($file);
                    if($compressed_png_content != false){
                        file_put_contents($file, $compressed_png_content);
                        return ['success' => 'File optimized successfully'];
                    } else {
                        return ['error' => 'Error optimizing file'];
                    }
                }
            }

            if(config('filemanager.jpegRecompressPath') != null){
                //Compress JPG files
                if($type == 'jpg' || $type == 'jpeg'){
                    $compressed_jpg_content = $this->compress_jpg($file);
                    if($compressed_jpg_content != false){
                        file_put_contents($file, $compressed_jpg_content);
                        return ['success' => 'File optimized successfully'];
                    } else {
                        return ['error' => 'Error optimizing file'];
                    }
                }
            }
        } else {
            return ['error' => 'Optimize option is set to false'];
        }
        return ['error' => 'Image type is not supported to optimize'];
      
    }


    /**
     * Removes a folder recursively
     *
     * @param $dir
     */
    private function deleteFolderRecursive($dir) {
        if (is_dir($dir)) {
            $objects = scandir($dir);
            foreach ($objects as $object) {
                if ($object != "." && $object != "..") {
                    if (is_dir($dir."/".$object))
                        $this->deleteFolderRecursive($dir."/".$object);
                    else
                        unlink($dir."/".$object);
                }
            }
            rmdir($dir);
        }
    }

    /**
     * Handles Upload files
     *
     * @param UploadedFile $file
     * @param $folder
     * @return stringch
     */
    private function upload(UploadedFile $file, $folder){

        $originalName = $file->getClientOriginalName();
        $originalNameWithoutExt = pathinfo($originalName, PATHINFO_FILENAME);
        $newName = $this->sanitize($originalNameWithoutExt).".".$file->getClientOriginalExtension();
        $path = $this->path.DIRECTORY_SEPARATOR.$folder.DIRECTORY_SEPARATOR;

//        $this->checkFileExists($path,$newName);

        $name = (!$this->checkFileExists($path,$newName)) ? $newName : $this->checkFileExists($path,$newName);

        if(!is_writable($path)){
            return ['error' => 'This folder is not writable'];
        }

        if($file->move($path, $name)){

            //Try to compress 
            if(config('filemanager.optimizeImages') == true){
                $ext = pathinfo($name, PATHINFO_EXTENSION);

                if(config('filemanager.pngquantPath') != null){
                    //Compress PNG files
                    if($ext == 'png'){
                        $compressed_png_content = $this->compress_png($path.$name);
                        if($compressed_png_content != false){
                            file_put_contents($path.$name, $compressed_png_content);
                        }
                    }
                }

                if(config('filemanager.jpegRecompressPath') != null){
                    //Compress JPG files
                    if($ext == 'jpg' || $ext == 'jpeg'){
                        $compressed_jpg_content = $this->compress_jpg($path.$name);

                        if($compressed_jpg_content != false){
                            file_put_contents($path.$name, $compressed_jpg_content);
                        }
                    }
                }
            }

            return ['success' => $name];
        } else {
            return ['error' => 'Impossible upload this file to this folder'];
        }

    }


    /**
     * Check if validName option is true and then sanitize new string
     * 
     * @param  string $name
     * @param  string $folder
     * @return string
     */
    private function checkValidNameOption($name, $folder)
    {
        if(config('filemanager.validName') == true){
            if($folder == 'file'){
                $ext = pathinfo($name, PATHINFO_EXTENSION);
                $name = pathinfo($name, PATHINFO_FILENAME);
                return $this->sanitize($name).".".$ext;
            } else {
                return $this->sanitize($name);
            }
        } else {
            return $name;
        }

    }


    /**
     * Check if folder exists
     *
     * @param $folder
     * @return bool
     */
    private function checkFolderExists($folder)
    {
        if(file_exists($folder)){
            return true;
        } else {
            return false;
        }
    }

    /**
     * Check permissions of folder
     * @param $path
     * @return string
     */
    private function checkPerms($path)
    {
        clearstatcache(null, $path);
        return decoct( fileperms($path) & 0777 );
    }

    /**
     * Check if file is on server and returns the name of file plus counter
     *
     * @param $folder
     * @param $name
     * @return bool|string
     */
    private function checkFileExists($folder, $name)
    {

        if(file_exists($folder.$name)){
            $withoutExt = pathinfo($name, PATHINFO_FILENAME);
            $ext = pathinfo($name, PATHINFO_EXTENSION);
            $i = 1;
            while(file_exists($folder.$withoutExt."-".$i.".".$ext)) {
                $i++;
            }
            return $withoutExt."-".$i.".".$ext;
        }
        return false;
    }

    /**
     * @param $string
     * @param bool $force_lowercase
     * @param bool $anal
     * @return bool|mixed|string
     */
    private function sanitize($string, $force_lowercase = true, $anal = true)
    {
        $strip = array("~", "`", "!", "@", "#", "$", "%", "^", "&", "*", "(", ")", "_", "=", "+", "[", "{", "]",
            "}", "\\", "|", ";", ":", "\"", "'", "&#8216;", "&#8217;", "&#8220;", "&#8221;", "&#8211;", "&#8212;",
            "â€”", "â€“", ",", "<", ".", ">", "/", "?");
        $clean = trim(str_replace($strip, "-", strip_tags($string)));
        $clean = preg_replace('/\s+/', "-", $clean);
        $clean = ($anal) ? preg_replace("/[^a-zA-Z0-9]/", "-", $clean) : $clean ;

        return ($force_lowercase) ?
            (function_exists('mb_strtolower')) ?
                mb_strtolower($clean, 'UTF-8') :
                strtolower($clean) :
            $clean;
    }

    /*********************************
     * Images Optimization Functions *
     *********************************/

    /**
     * Optimizes PNG file with pngquant 1.8 or later (reduces file size of 24-bit/32-bit PNG images).
     *
     * You need to install pngquant 1.8 on the server (ancient version 1.0 won't work).
     * There's package for Debian/Ubuntu and RPM for other distributions on http://pngquant.org
     *
     * @param $path_to_png_file string - path to any PNG file, e.g. $_FILE['file']['tmp_name']
     * @param $max_quality int - conversion quality, useful values from 60 to 100 (smaller number = smaller file)
     * @return string - content of PNG file after conversion
     */
    function compress_png($path_to_png_file, $max_quality = 90)
    {
        if (!file_exists($path_to_png_file)) {
            return false;
        }

        // guarantee that quality won't be worse than that.
        $min_quality = 60;

        // '-' makes it use stdout, required to save to $compressed_png_content variable
        // '<' makes it read from the given file path
        // escapeshellarg() makes this safe to use with any path
        $compressed_png_content = shell_exec( config('filemanager.pngquantPath'). " --quality=$min_quality-$max_quality - < ".escapeshellarg( $path_to_png_file ) );

        if (!$compressed_png_content) {
            return false;
        }

        return $compressed_png_content;
    }

    /**
     * Optimizes JPG file with jpg-recompress
     * 
     * @param  [type]  $path_to_jpg_file [description]
     * @param  integer $max_quality      [description]
     * @return [type]                    [description]
     */
    function compress_jpg($path_to_jpg_file, $max_quality = 90)
    {
        if (!file_exists($path_to_jpg_file)) {
            return false;
        }

        // guarantee that quality won't be worse than that.
        $min_quality = 60;

        // '- -' makes it use stdout, required to save to $compressed_jpg_content variable
        // '<' makes it read from the given file path
        // escapeshellarg() makes this safe to use with any path
        $compressed_jpg_content = shell_exec( config('filemanager.jpegRecompressPath'). " --quality high --min $min_quality --max $max_quality --quiet - - < ".escapeshellarg( $path_to_jpg_file ) );

        if (!$compressed_jpg_content) {
            return false;
        }

        return $compressed_jpg_content;
    }

}
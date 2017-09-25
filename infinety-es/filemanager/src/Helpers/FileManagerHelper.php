<?php

namespace Infinety\FileManager\Helpers;

use Blade;
use View;

class FileManagerHelper
{


    //Set JS
    public static function css(){
        $html = '<meta name="csrf-token" content="'.csrf_token().'">';
        $html .= '<link rel="stylesheet" href="https://cdn.plyr.io/1.5.18/plyr.css">';
        $html .= '<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">';
        $html .= '<link type="text/css" rel="stylesheet" href="'.asset('/filemanager_assets/vendor/dmuploader/css/uploader.css').'">';
        $html .= '<link type="text/css" rel="stylesheet" href="'.asset('/filemanager_assets/css/filemanager.css').'">';
        $html .= '<link type="text/css" rel="stylesheet" href="'.asset('/filemanager_assets/vendor/contextMenu/dist/jquery.contextMenu.css').'">';
        $html .= '<link type="text/css" rel="stylesheet" href="'.asset('/filemanager_assets/vendor/highlight/styles/agate.css').'">';
        return $html;
    }


    public static function js(){
        $html = '<script src="'.asset('admin_theme/assets/plugins/classie/classie.js').'" type="text/javascript"></script';
        $html .= '<script src="https://cdn.plyr.io/1.5.18/plyr.js" type="text/javascript"></script>';
        $html .= '<script src="'.asset('/filemanager_assets/vendor/pdfobject.js').'" type="text/javascript"></script>';
        $html .= '<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.fileDownload/1.4.2/jquery.fileDownload.min.js"></script>';
        $html .= '<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>';
        $html .= '<script src="'.asset('/filemanager_assets/vendor/contextMenu/dist/jquery.contextMenu.js').'" type="text/javascript"></script>';
        $html .= '<script src="'.asset('/filemanager_assets/vendor/contextMenu/dist/jquery.ui.position.min.js').'" type="text/javascript"></script>';
        $html .= ' <script src="'.asset('/filemanager_assets/vendor/highlight/highlight.pack.js').'" type="text/javascript"></script>';
        $html .= '<script src="'.asset('/filemanager_assets/vendor/dmuploader/js/dmuploader.js').'" type="text/javascript"></script>';
        $html .= ' <script src="'.asset('/filemanager_assets/vendor/dmuploader/js/gallery.js').'" type="text/javascript"></script>';


        $html .= '<script>!function(e,t){var n=new XMLHttpRequest,o=e.body;n.open("GET",t,!0),n.send(),n.onload=function(){var t=e.createElement("div");t.setAttribute("hidden",""),t.innerHTML=n.responseText,o.insertBefore(t,o.childNodes[0])}}(document,"https://cdn.plyr.io/1.5.18/sprite.svg");</script>';
        $html .= '<script>$(document).ready(function(){';
        $html .= '$.ajaxSetup({headers:{"X-CSRF-TOKEN":$(\'meta[name="csrf-token"]\').attr("content")}});';
        $html .= 'url_process = "'.url("admin/filemanager/get_folder").'";';
        $html .= 'url_upload  = "'.url("admin/filemanager/uploadFile").'";';
        $html .= 'url_cfolder = "'.url("admin/filemanager/createFolder").'";';
        $html .= 'url_delete  = "'.url("admin/filemanager/delete").'";';
        $html .= 'url_download = "'.url("admin/filemanager/download").'";';
        $html .= 'url_preview  = "'.url("admin/filemanager/preview").'";';
        $html .= 'url_move  = "'.url("admin/filemanager/move").'";';
        $html .= 'url_rename  = "'.url("admin/filemanager/rename").'";';
        $html .= 'image_path  = "'.asset('/').'";';

        $home = explode('/', config('filemanager.homePath'));
        $html .= 'homeFolder  = "'.last($home).'";';
        $html .= 'path_folder = "";';
        $html .= 'current_file = null;';
        $html .= 'cutted_file = null;';
        $html .= 'temp_folder = null;';
        $html .= 'globalFilter = null;';

        //Languages
        $html .= 'text_upload = "'. trans('filemanager.upload.info').'";';
        $html .= '});</script>';

        $html .= '<script src="'.asset('filemanager_assets/js/filemanager.js').'" type="text/javascript"></script>';
        $html .= '<script src="'.asset('filemanager_assets/js/upload.js').'" type="text/javascript"></script>';

        return $html;
    }

    public static function data(){
        return View::make('filemanager::content')->render();
    }

}
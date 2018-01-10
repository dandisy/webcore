/**
 * Created by infinety on 8/3/16.
 */

$(document).ready(function(){

    /******************
     * MAIN FUNCTIONS *
     ******************/

    PNotify.prototype.options.delay = 2000;
    var oldIcon;
    /**
     * Add Loading div
     */
    addLoading = function(){
        $("#files_container").empty().html('<div class="loading"><img src="'+image_path+'filemanager_assets/img/loading.svg"></div>');
    };

    loadingIcon = function(){
        if(triggerObject){
            oldIcon = triggerObject.find('.icon').find('img').attr('src');
            triggerObject.find('.icon').find('img').attr('src', image_path+'filemanager_assets/img/loading.svg');
        }
    }

    removeLoadingIcon = function(){
        if(triggerObject){
            triggerObject.find('.icon').find('img').attr('src', oldIcon);
            triggerObject = null;
        }
    }


    checkFileSelected = function(){
        if(current_file === undefined || current_file === null) {
            return false;
        } else {
            return true;
        }
    };

    checkFileOrFolder = function(){
        if(checkFileSelected()){
            return false;
        }        
        if(temp_folder === undefined || temp_folder === null){
            return true;
        } else {
            return false;
        }
    }

    /**
     * Get folder and files data
     *
     * @param folder
     * @param sort
     * @param filter
     */
    getData = function(folder, sort, filter){
        current_file = null;
        actionFileButtons();
        addLoading();
        if(globalFilter != null){
            filter = globalFilter;
        }
        $.ajax({
            url: url_process,
            type: "POST",
            data: { 'folder' : folder, 'sort' : sort, 'filter' : filter }
        }).done(function( data ) {
            uploadMethod();
            generatebreadcrum(folder);
            actionRightMenu();
            $("#files_container").empty();
            $("#files_container").html(data);
        }).fail(function(data) {
            console.log('error');
        });
    };

    /**
     * Create a new folder on current Folder
     *
     * @param name
     */
    createFolder = function(name){
        $.ajax({
            url: url_cfolder,
            type: "POST",
            data: { 'folder' : path_folder, 'name' : name }
        }).done(function( data ) {
            if(data.error){
                new PNotify({
                    title: 'Error',
                    text: data.error,
                    type: 'error'
                });
            } else {
                new PNotify({
                    title: 'Folder Created!',
                    text: data.success,
                    type: 'success'
                });
                $('.refresh').trigger('click');
            }
            $('#modalCreateFolder').modal('hide')

        }).fail(function(data) {
            new PNotify({
                title: 'Error',
                text: 'Error to process request',
                type: 'error'
            });
            $('#modalCreateFolder').modal('hide')
        });
    };

    /**
     * Remove file or folder
     * @param name
     * @param type
     */
    deleteFileorFolder = function(name, type){
        $.ajax({
            url: url_delete,
            type: "POST",
            data: { 'folder' : path_folder, 'data' : name, 'type' : type }
        }).done(function( data ) {
            if(data.error){
                new PNotify({
                    title: 'Error',
                    text: data.error,
                    type: 'error'
                });
            } else {
                new PNotify({
                    title: 'Deleted!',
                    text: data.success,
                    type: 'success'
                });
                $('.refresh').trigger('click');
            }

        }).fail(function(data) {
            new PNotify({
                title: 'Error',
                text: 'Error to process request',
                type: 'error'
            });
        });
    };

    /**
     * Move file to new destination
     * @param fileOld
     * @param newPath
     */
    moveFile = function(fileOld, newPath){
        $.ajax({
            url: url_move,
            type: "POST",
            data: { 'oldFile' : fileOld, 'newPath' : newPath }
        }).done(function( data ) {
            if(data.error){
                new PNotify({
                    title: 'Error',
                    text: data.error,
                    type: 'error'
                });
            } else {
                new PNotify({
                    title: 'Success!',
                    text: data.success,
                    type: 'success'
                });
                cutted_file = null;
                $('.refresh').trigger('click');
            }

        }).fail(function(data) {
            new PNotify({
                title: 'Error',
                text: 'Error to process request',
                type: 'error'
            });
        });
    };

    /**
     * Function to rename files or Folders
     * @param newName
     */
    renameFileorFolder = function(path, newName, type){
        $.ajax({
            url: url_rename,
            type: "POST",
            data: {'type': type, 'file' : path, 'newName' : newName }
        }).done(function( data ) {
            if(data.error){
                new PNotify({
                    title: 'Error',
                    text: data.error,
                    type: 'error'
                });
            } else {
                new PNotify({
                    title: (type == 'file') ? 'File  Renamed!' : 'Folder Renamed!',
                    text: data.success,
                    type: 'success'
                });
                $('.refresh').trigger('click');
            }
            $('#modalRename').modal('hide')

        }).fail(function(data) {
            new PNotify({
                title: 'Error',
                text: 'Error to process request',
                type: 'error'
            });
            $('#modalRename').modal('hide')
        });
    };


    /**
     * Function to rename files or Folders
     * @param newName
     */
    omptimizeImage = function(file, type){
        loadingIcon();
        $.ajax({
            url: url_optimize,
            type: "POST",
            data: {'type': type, 'file' : file }
        }).done(function( data ) {
            if(data.error){
                new PNotify({
                    title: 'Error',
                    text: data.error,
                    type: 'error'
                });
            } else {
                new PNotify({
                    title: (type == 'file') ? 'File  Renamed!' : 'Folder Renamed!',
                    text: data.success,
                    type: 'success'
                });
                $('.refresh').trigger('click');
            }
        }).fail(function(data) {
            new PNotify({
                title: 'Error',
                text: 'Error to process request',
                type: 'error'
            });
        });
    };


    /**
     * Generates breadcrum for given folder
     *
     * @param folder
     */
    generatebreadcrum = function(folder){
        var breadcrum = folder.split("/");
        var html = '<li class="active" data-folder="Home"><a href="#">'+homeFolder+'</a></li>';
        var folder = '';
        for(var i = 0; i < breadcrum.length; i++) {
            if(breadcrum[i] != '') {
                folder += breadcrum[i] + "/";
                html += '<li class="active" data-folder="' + folder + '"><a href="#">' + breadcrum[i] + '</a></li>';
            }
        }
        $(".breadcrumb").html(html);
    };


    /**
     * Active or deactivate buttons
     */
    actionFileButtons = function(){
        if(current_file === undefined || current_file === null){
            $(".delete ,.move ,.preview").removeClass('active');
        } else {
            if(current_file.type != 'file'){
                $(".delete ,.move ,.preview").addClass('active');
            } else {
                $(".preview").removeClass('active');
                $(".delete ,.move").addClass('active');
            }
        }
    };

    /**
     * Right menu Action Builder
     */
    actionRightMenu = function(){
        $.contextMenu({
            selector: '.filemanager-item, .upload_div',
            build: function($trigger, e) {
                current_file = null;
                temp_folder = null;
                if($trigger.data('type')){
                    if($trigger.data('type') != 'file'){
                        current_file = {
                            name : $($trigger).find('.name-file').text(),
                            path : $($trigger).data('path'),
                            type : $($trigger).data('type'),
                            size : $($trigger).data('size'),
                            relativePath : $($trigger).data('asset'),
                            preview : $($trigger).find('img').attr("src")
                        };

                        if(current_file.type == 'image'){
                            if($($trigger).data('dimension')){
                                var dimensions = $($trigger).data('dimension').split("x");
                                current_file.height = dimensions[0];
                                current_file.width = dimensions[1];
                            }
                        }

                    } else {
                        current_file = {
                            name : $($trigger).find('.name-file').text(),
                            path : $($trigger).data('path'),
                            type : $($trigger).data('type'),
                            size : $($trigger).data('size'),
                            relativePath : $($trigger).data('asset'),
                            preview : false
                        };
                    }
                } else {
                    temp_folder = $($trigger).data('folder');
                }
                $('.file, .folder').removeClass('active');
                $($trigger).addClass('active');
                triggerObject = $trigger;
                actionFileButtons();
                return {
                    callback: function(key, options) {
                        process(key, options)
                        //var m = "clicked: " + key;
                        //window.console && console.log(m) || alert(m);
                    },
                    items: generateContextMenu()
                };
            },
            events: {
                hide: function($trigger){
                    if(cutted_file == null){
                        // current_file = null;
                    } else {
                        $('.file').removeClass('active');
                        actionFileButtons();
                    }
                    $('.file, .folder').removeClass('active');

                }
            }
        });
    };
    /**
     * Generates menu options based on live features and actions
     * @returns {Array}
     */
    function generateContextMenu() {

        $elements = [];

        // Only for supported mimes
        if(current_file != undefined && current_file.preview != false){
            var preview = {
                name: "Preview",
                icon: 'fa-eye',
                callback: function(key, options) {
                    $('.preview').trigger('click');
                }
            };
            $elements.push(preview);
            if(current_file.type == 'image' && optimizeOption == true){
                ext = current_file.name.slice((current_file.name.lastIndexOf(".") - 1 >>> 0) + 2);
                if(ext == 'png'){
                    var optimize = {
                        name: "Optimize PNG",
                        icon: 'fa-compress',
                        callback: function(key, options) {
                            omptimizeImage(current_file.path, ext);
                        }
                    };
                    $elements.push(optimize);
                }
                if(ext == 'jpg' || ext == 'jpeg'){
                    var optimize = {
                        name: "Optimize JPG",
                        icon: 'fa-compress',
                        callback: function(key, options) {
                            
                            omptimizeImage(current_file.path, ext);
                        }
                    };
                    $elements.push(optimize);
                }
            }
            
        }

        var rename = {
            name: "Rename",
            icon: 'fa-keyboard-o',
            disabled: checkFileOrFolder(),
            callback: function(key, options) {
                if($(this).data('type')){
                    if( checkFileSelected() ) {
                        var ext = "." + current_file.name.split('.').pop();
                        var name = current_file.name.replace(/\.[^/.]+$/, "");
                        $("#new-name").val(name);
                        $("#new-ext").html(ext).removeClass("hide");
                        $("#data-rename").removeClass('input').addClass('input-group');
                        $('#modalRename').find(".file-info").removeClass("hide");
                        $('#modalRename').find("#path").val(current_file.path);
                        $('#modalRename').find("#type-rename").val("file");
                        $('#modalRename').modal('show');
                    }
                }

                if($(this).data('folder')){
                    $("#new-name").val($(this).data('name'));
                    $("#new-ext").addClass("hide");
                    $("#data-rename").removeClass('input-group').addClass('input');
                    $('#modalRename').find(".folder-info").removeClass("hide");
                    $('#modalRename').find("#type-rename").val("folder");
                    $('#modalRename').modal('show');
                }
            }
        };


        var download = {
            name: "Download",
            icon: 'fa-download',
            disabled: checkFileOrFolder(),
            callback: function(key, options) {
                if(path_folder != ""){
                    path_folder += '/';
                }
                var type;
                if(current_file){
                    type = 'file';
                    var win = window.open(url_download+'?path='+path_folder + current_file.name + '&name='+current_file.name+'&type='+type, '_self');
                } else {
                    type = 'folder';
                    var win = window.open(url_download+'?path='+temp_folder + '&name=' + temp_folder + '&type='+type, '_self');
                }


                if(win){
                    //Browser has allowed it to be opened
                    win.focus();
                }else{
                    //Broswer has blocked it
                    alert('Please allow popups for this site');
                }

            }
        };
        if(current_file != undefined && current_file.preview != false){
            var cut = {
                name: "Cut",
                icon: 'fa-scissors',
                callback: function(key, options) {
                    new PNotify({
                        title: 'File cutted',
                        text: 'Now chose new destination',
                        type: 'info'
                    });
                    cutted_file = (path_folder != '' ? path_folder+ '/' : '') + current_file.name;
                    $('.move').removeClass('move').addClass('active paste').find('button').html('<i class="fa fa-paste"> Paste');
                }
            };
            $elements.push(cut);
        }

        if(cutted_file != null){
            var paste = {
                name: "Paste",
                icon: 'fa-clipboard',
                disabled: (cutted_file != null ? false : true),
                callback: function(key, options) {
                    moveFile(cutted_file, path_folder);
                    $('.paste').removeClass('paste active').addClass('move').find('button').html('<i class="fa fa-arrows"> Move');
                }
            };
            $elements.push(paste);
        }

        var del = {
            name: "Delete",
            icon: 'fa-trash',
            disabled: checkFileOrFolder(),
            callback: function(key, options) {
                if($(this).data('type')){
                    swal(
                        {  title: "Are you sure?",
                            text: "This file will be deleted!",
                            type: "warning",
                            showCancelButton: true,
                            confirmButtonColor: "#DD6B55",
                            confirmButtonText: "Yes, delete it!",
                            closeOnConfirm: true
                        }, function(){
                            deleteFileorFolder(current_file.name, 'file');
                        }
                    );
                }
                if($(this).data('folder')){
                    var name = $(this).data('name');
                    swal(
                        {  title: "Are you sure?",
                            text: "All files and folders inside this folder will by deleted!",
                            type: "warning",
                            showCancelButton: true,
                            confirmButtonColor: "#DD6B55",
                            confirmButtonText: "Yes, delete it!",
                            closeOnConfirm: true
                        }, function(){
                            deleteFileorFolder(name, 'folder');
                        }
                    );
                }
            }
        };



        $elements.push(rename);
        $elements.push(download);

        $elements.push(del);

        return $elements;

    };


    /**
     * Preview function to show a preview of the file
     *
     * @returns {boolean}
     */
    preview = function(){
        if(current_file === undefined || current_file === null){
            return false;
        } else {
            if(current_file.type != 'file'){
                $("#modal-name").text(current_file.name);
                $("#modal-size").text(current_file.size);
                $('#modal-preview').empty();
                if(current_file.type == 'image'){
                    $('#modal-preview').append('<img src="'+ current_file.preview +'" class="img-responsive" id="modal-image">');
                    $('#modal-height').text(current_file.height+"px").parent().removeClass('hide');
                    $('#modal-width').text(current_file.width+"px").parent().removeClass('hide');
                }
                if(current_file.type == 'audio'){
                    var html = '<div class="plyr">' +
                        '<audio controls crossorigin>' +
                        '<source src="'+ current_file.relativePath +'" type="audio/mpeg">' +
                        'Your browser does not support the audio element.' +
                        '</audio>' +
                        '</div>';
                    $('#modal-preview').append(html);
                    plyr.setup('.plyr');
                }
                if(current_file.type == 'video'){
                    var html = '<div class="plyr">' +
                        '<video  controls crossorigin>' +
                        '<source src="'+ current_file.relativePath +'" type="video/mp4">' +
                        '<a href="'+ current_file.preview +'">Download</a>' +
                        '</video>' +
                        '</div>';
                    $('#modal-preview').append(html);
                    plyr.setup('.plyr');
                }
                if(current_file.type == 'pdf'){
                    new PDFObject({ url: current_file.relativePath, height: '500px' }).embed("modal-preview");
                }
                if(current_file.type == 'text'){

                    readStringFromFileAtPath(current_file);
                    var html = '<div class="code-editor"> <span class="control"></span> <span class="control"></span><span class="control"></span>' +
                        '<pre>' +
                        '<code class="language-markup">' +
                        'Loading...' +
                        '</code>' +
                        '</pre>' +
                        '</div>';
                    $('#modal-preview').append(html);
                }

                $('#previewInfo').modal('toggle');
            }
        }
    };

    /**
     * Read text input (text, js, css, etc)
     */
    function readStringFromFileAtPath(fileToRead){
        $.ajax({
            url: url_preview,
            type: "POST",
            data: { 'type' : fileToRead.type ,  'file' : fileToRead.path },
            dataType: "text",
        }).done(function( data ) {
            if(data.error){
                new PNotify({
                    title: 'Error',
                    text: data.error,
                    type: 'error'
                });
                $('#modal-preview').empty().append('Error');
                return false;
            } else {
                var demo = hljs.highlightAuto(data);
                var html = '<div class="code-editor"> <span class="control"></span> <span class="control"></span><span class="control"></span>' +
                    '<pre>' +
                    '<code id="code-ajax-content"">' +
                    demo.value +
                    '</code>' +
                    '</pre>' +
                    '</div>';
                $('#modal-preview').empty().html(html);

                //hljs.highlightBlock($('#code-ajax-content')[0]);
                //Prism.highlightElement($('#code-ajax-content')[0]);
                return true;
            }
        }).fail(function(data) {
            new PNotify({
                title: 'Error',
                text: 'Error to process request',
                type: 'error'
            });
            $('#modal-preview').empty().append('Error');
            return false;
        });

    }

    /**
     * Close event for preview modal
     */
    $('#previewInfo').on('hidden.bs.modal', function (e) {
        player = plyr.setup('.plyr')[0];
        if(player != undefined || player != null){
            player.destroy();
        }
        $("#modal-width").parent().addClass('hide');
        $("#modal-height").parent().addClass('hide');

        //current_file = null;
    });

    /**
     * Close event for rename modal
     */
    $('#modalRename').on('hidden.bs.modal', function (e) {
        $('#modalRename').find(".file-info").addClass("hide");
        $('#modalRename').find(".folder-info").addClass("hide");
    });




    //Call first time
    getData('', '', '');


    /*****************
     *    EVENTS     *
     *****************/

    /**
     * Upload single event
     */
    $("#single-upload").click(function(){
        uploadMethod();
        $("#single-upload-file").click();
    });


    $('.filter').click(function(){
        var filter = $(this).data('filter');
        var sort = $("#sort-by").val();
        getData(path_folder, sort, filter);
        $('.filter').removeClass('active');
        $(this).addClass('active');
    });

    $("#sort-by").change(function(){
        var filter = $('.filter.active').data('filter');
        var sort = $(this).val();
        getData(path_folder, sort, filter);

    });

    /**
     * Home click
     */
    $(document).on('click', '.home', function(){
        path_folder = '';
        var filter = $('.filter.active').data('filter');
        var sort = $("#sort-by").val();
        getData('', sort, filter);
    });

    /**
     * Refresh current folder
     */
    $(document).on('click', '.refresh', function(){
        var filter = $('.filter.active').data('filter');
        var sort = $("#sort-by").val();
        getData(path_folder, sort, filter);
    });

    $(document).on('click', '.preview', function(){
        preview();
    });


    /**
     * Get inside folder
     */
    $(document).on('click', '.folder', function(){
        path_folder = $(this).data('folder');
        var filter = $('.filter.active').data('filter');
        var sort = $("#sort-by").val();
        getData(path_folder, sort, filter);
    });



    /**
     * Files events
     */
    $(document).on('click', '.file', function(e){
        e.preventDefault();
        var isInIFrame = (window.location != window.parent.location);
        if(isInIFrame == true){
            var windowParent = window.parent;
            if(typeCallback == 'featured'){
                var appendId = location.search.split('appendId=')[1] ? location.search.split('appendId=')[1] : null;
                var image = {
                    "path": $(this).data('path'),
                    "thumb": $(this).data('asset'),
                    "appendId": appendId
                };
                windowParent.OnMessage(image);
            }

            if(typeCallback == 'editor'){
                editor = window.parent.$(window.parent.document).find("#"+editorId);
                fileRequested = {
                    name : $(this).find('.name-file').text(),
                    path : $(this).data('asset'),
                };
                editor.redactor('imagemanager.set', fileRequested);
            }
            return false;
        }

        if($(this).hasClass('active')){
            current_file = null;
            $(this).removeClass('active');
        } else {
            current_file = {
                name : $(this).find('.name-file').text(),
                path : $(this).data('path'),
                type : $(this).data('type'),
                size : $(this).data('size'),
                relativePath : $(this).data('asset'),
                preview : $(this).find('img').attr("src")
            };
            $('.file').removeClass('active');
            $(this).addClass('active');
        }
        actionFileButtons();
        return false;
    });

    /**
     * Button new folder event button
     */
    $(document).on('click', '#create-folder', function(e){
        var new_folder = $("#folder-name").val();
        createFolder(new_folder);
    });

    /**
     * Function to call Rename function
     */
    var callRenameFunction = function(){
        var type = $("#type-rename").val();
        if(type == "file"){
            var new_name = $("#new-name").val();
            var ext = $("#new-ext").html();
            var name = new_name + ext;
            var path = $('#modalRename').find("#path").val();
        } else {
            var name = $("#new-name").val();
            var path = temp_folder;
        }
        renameFileorFolder(path, name, type);
    }


    /**
     * Rename file event button
     */
    $(document).on('click', '#rename-file', function(e){
        callRenameFunction();
    });

    $(document).on('keypress', '#new-name', function(e){
        if(e.keyCode==13){
            callRenameFunction();
        }
    });

    /**
     * Perform search based on text given for current view
     * @param text
     */
    var performSearch = function(text){
        $('#files_container').find('.filemanager-item').each(function(){


            if($(this).hasClass('file')){

                if($(this).find('.name-file').text().toUpperCase().indexOf(text.toUpperCase()) != -1){
                    $(this).show();
                } else {
                    $(this).hide();
                }
            }
        });
    };

    /**
     * Search event
     */
    $(document).on('keypress', '#search', function(e){
        if(e.keyCode==13){
            if($(this).val()){
                performSearch($(this).val());
                $("#search-button").addClass('hide');
                $("#reset-button").removeClass('hide');
            } else {
                $('.filemanager-item').show();
                $("#search-button").removeClass('hide');
                $("#reset-button").addClass('hide');
            }
        }
    });

    $(document).on('click', '#search-button', function(e){
        if($("#search").val()){
            performSearch($("#search").val());
            $("#search-button").addClass('hide');
            $("#reset-button").removeClass('hide');
        }
    });

    $(document).on('click', '#reset-button', function(e){
        $("#search").val('');
        $('.filemanager-item').show();
        $("#search-button").removeClass('hide');
        $("#reset-button").addClass('hide');

    });



    /**
     * Button delete event
     */
    $(document).on('click', '.delete', function(e){
        swal(
            {  title: "Are you sure?",
                text: "This file will be deleted!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes, delete it!",
                closeOnConfirm: true
            }, function(){
                deleteFileorFolder(current_file.name, 'file');
            }
        );
    });

    /**
     * Move event button
     */
    $(document).on('click', '.move', function(e){
        if( checkFileSelected() ) {
            cutted_file = (path_folder != '' ? path_folder+ '/' : '') + current_file.name;
            $(this).removeClass('move').addClass('paste');
            $(this).find('button').html('<i class="fa fa-paste"> Paste');
        }
    });

    /**
     * Paste Event button
     */
    $(document).on('click', '.paste', function(e){
        if( cutted_file != null ) {
            moveFile(cutted_file, path_folder);
            $(this).removeClass('paste active').addClass('move').find('button').html('<i class="fa fa-arrows"> Move');
        }
    });



    /**
     * Navigation through breadcrum
     */
    $(document).on('click', '.breadcrumb li a', function(){
        var folder = $(this).parent().data('folder');
        if(folder == 'Home'){
            path_folder = '';
        } else {
            path_folder = folder;
        }
        var filter = $('.filter.active').data('filter');
        var sort = $("#sort-by").val();
        getData(path_folder, sort, filter);
    });


    /**
     * Change view items
     */
    $(document).on('click', '.list', function(){
        $(".view-type").removeClass('active');
        $(this).addClass('active');
        $('.item').removeClass('grid col-sm-3 big-grid col-sm-6').addClass('list col-sm-12')
        $('.item').find('.icon').removeClass('col-sm-4 col-sm-2').addClass('col-sm-1');
        $('.item').find('.info').removeClass('col-sm-8 col-sm-10').addClass('col-sm-11');
    });

    $(document).on('click', '.grid', function(){
        $(".view-type").removeClass('active');
        $(this).addClass('active');
        $('.item').removeClass('list col-sm-12 big-grid col-sm-6').addClass('grid col-sm-3')
        $('.item').find('.icon').removeClass('col-sm-1 col-sm-2').addClass('col-sm-4');
        $('.item').find('.info').removeClass('col-sm-11 col-sm-10').addClass('col-sm-8');
    });

    $(document).on('click', '.big-grid', function(){
        $(".view-type").removeClass('active');
        $(this).addClass('active');
        $('.item').removeClass('list col-sm-12 grid col-sm-3').addClass('big-grid col-sm-6')
        $('.item').find('.icon').removeClass('col-sm-1 col-sm-4').addClass('col-sm-2');
        $('.item').find('.info').removeClass('col-sm-11 col-sm-8').addClass('col-sm-10');
    });

});
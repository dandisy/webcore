(function( $, window, undefined ) {
    $.gallery = $.extend( {}, {

        addLog: function(str){
            console.log(str);
        },

        addFile: function(id, i, file){


            var template ='<div class="item grid col-sm-3">' +
                                '<div id="file-' + i + '" class="filemanager-item file" data-file="'+file.type+'">' +
                                    '<div class="row full-width centered">' +
                                        '<div class="col-sm-4 b-r b-grey icon">';
                    if(file.type.match('image')){
                        template +=         '<img src="" class="img-responsive" />';
                    } else {
                        template +=         '<p class="small">'+ file.name +'</p>';
                    }
                    template +=         '</div>' +
                                        '<div class="col-sm-8 info">' +
                                            '<p class="name-file">'+file.name+'</p>' +
                                            '<p class="small">Upload <span class="upload-percent"></span></p>' +
                                        '</div>' +
                                    '</div>' +
                                '</div>' +
                            '</div>' ;


            var i = $(id).attr('file-counter');
            if (!i){
                //$(id).empty();
                i = 0;
            }

            i++;

            $(id).attr('file-counter', i);

            $(id).append(template);
        },

        updateFileStatus: function(i, status, message){
            $('#file-' + i).find('span.demo-file-status').html(message).addClass('demo-file-status-' + status);
        },

        updateFileProgress: function(i, percent){
            $('#file-' + i).find('span.upload-percent').html(percent);
        },

        humanizeSize: function(size) {
            var i = Math.floor( Math.log(size) / Math.log(1024) );
            return ( size / Math.pow(1024, i) ).toFixed(2) * 1 + ' ' + ['B', 'kB', 'MB', 'GB', 'TB'][i];
        },

        addFileUploaded : function(id, file, delete_ul){

            console.log(id);
        }

    }, $.gallery);
})(jQuery, this);

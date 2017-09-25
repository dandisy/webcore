### How to use dialog

#### File select:  Image selector, file selector, etc

You can use a dialog (modal) version of this FileManager to select a file.

First, open new modal with your favourite popup service. In this example I will use fancybox.

```javascript
selectFile = function(url){
    $.fancybox({
        type        : 'iframe',
        href        : url,
    });
};
```

The link to dialog should have **appendId** parameter. **Filter** parameter is optional:
- filter
    - *all*, *image*, *audio*, *video*, *documents*. Default to *image*.

Then for example you can call it like: 
```html
    <a onclick="selectFile('admin/filemanager/dialog?filter=all&appendId=myDivID')">Select Image</a>
```

Your page should have also this javscript function:

```javascript
OnMessage = function(data){
    // data example
    // {
    //   "path": "/Applications/MAMP/htdocs/laravel54/public/image1.jpg",
    //   "thumb": "http://laravel54.dev/image1.jpg",
    //   "appendId": "myDivID"
    // }

    //And close fancybox after select file
    $.fancybox.close();
};
```

Then when you click a file, `OnMessage` function will be called.

Now you can play with it!
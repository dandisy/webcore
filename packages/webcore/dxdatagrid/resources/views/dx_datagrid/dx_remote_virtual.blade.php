<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>DevExtreme Demo</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script>window.jQuery || document.write(decodeURIComponent('%3Cscript src="js/jquery.min.js"%3E%3C/script%3E'))</script>
    <link rel="stylesheet" type="text/css" href="https://cdn3.devexpress.com/jslib/19.1.4/css/dx.common.css" />
    <link rel="stylesheet" type="text/css" href="https://cdn3.devexpress.com/jslib/19.1.4/css/dx.light.css" />
    <script src="https://cdn3.devexpress.com/jslib/19.1.4/js/dx.all.js"></script>
    <script src="https://unpkg.com/devextreme-aspnet-data@2.2.1/js/dx.aspnet.data.js"></script>

    <!-- <link rel="stylesheet" type="text/css" href="styles.css" /> -->
    <style>
    #gridContainer {
        height: 440px;
    }
    </style>

    <!-- <script src="index.js"></script> -->
    <script>
    $(function() {
        $("#gridContainer").dxDataGrid({
            dataSource: DevExpress.data.AspNet.createStore({
                key: "Id",
                loadUrl: "https://js.devexpress.com/Demos/WidgetsGalleryDataService/api/Sales"
            }),
            remoteOperations: true,
            scrolling: {
                mode: "virtual",
                rowRenderingMode: "virtual"
            },
            paging: {
                pageSize: 100
            },
            headerFilter: {
                visible: true,
                allowSearch: true
            },
            wordWrapEnabled: true,
            showBorders: true,
            columns: [{
                dataField: "Id",
                width: 75
            }, {
                caption: "Store",
                dataField: "StoreName",
                width: 150
            }, {
                caption: "Category",
                dataField: "ProductCategoryName",
                width: 120
            }, {
                caption: "Product",
                dataField: "ProductName"
            }, {
                caption: "Date",
                dataField: "DateKey",
                dataType: "date",
                format: "yyyy-MM-dd",
                width: 100
            }, {
                caption: "Amount",
                dataField: "SalesAmount",
                format: "currency",
                headerFilter: {
                    groupInterval: 1000
                },
                width: 100
            }]
        });
    });
    </script>
</head>
<body class="dx-viewport">
    <div class="demo-container">
        <div id="gridContainer"></div>
    </div>
</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>dxDataGrid Server Process</title>

    <!-- <link rel="stylesheet" type="text/css" href="https://cdn3.devexpress.com/jslib/19.1.4/css/dx.common.css" />
    <link rel="stylesheet" type="text/css" href="https://cdn3.devexpress.com/jslib/19.1.4/css/dx.light.css" /> -->
    <link rel="stylesheet" type="text/css" href="{{ asset('vendor/dxDataGrid/css/dx.common.css') }}" />
    <link rel="dx-theme" data-theme="generic.light" href="{{ asset('vendor/dxDataGrid/css/dx.light.css') }}" />
</head>
<body>
    <div id="gridContainer"></div>

    <!-- <script type="text/javascript" src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script type="text/javascript" src="https://cdn3.devexpress.com/jslib/19.1.4/js/dx.all.js"></script> -->
    
    <script src="{{ asset('vendor/jQuery/jquery-2.2.3.min.js') }}"></script>
    <script src="{{ asset('vendor/dxDataGrid/js/cldr.min.js') }}"></script>
    <script src="{{ asset('vendor/dxDataGrid/js/cldr/event.min.js') }}"></script>
    <script src="{{ asset('vendor/dxDataGrid/js/cldr/supplemental.min.js') }}"></script>
    <script src="{{ asset('vendor/dxDataGrid/js/cldr/unresolved.min.js') }}"></script>	
    <script src="{{ asset('vendor/dxDataGrid/js/globalize.min.js') }}"></script>
    <script src="{{ asset('vendor/dxDataGrid/js/globalize/message.min.js') }}"></script>
    <script src="{{ asset('vendor/dxDataGrid/js/globalize/number.min.js') }}"></script>
    <script src="{{ asset('vendor/dxDataGrid/js/globalize/date.min.js') }}"></script>
    <script src="{{ asset('vendor/dxDataGrid/js/globalize/currency.min.js') }}"></script>
    <script src="{{ asset('vendor/dxDataGrid/js/dx.web.js') }}"></script>
    <script>
        var gridDataSource = new DevExpress.data.DataSource({
            // loadMode: "raw",
            key: "emp_no",
            load: function (loadOptions) {
                // return $.getJSON('http://localhost/spkk/public/api/dx-server-fingerprint');
                var d = $.Deferred();
                $.getJSON('{{url("/")}}/api/dx-server/Employee', {  
                    // Passing settings to the server        
                    filter: loadOptions.filter ? JSON.stringify(loadOptions.filter) : "", // Pass if filtering is remote
                    sort: loadOptions.sort ? JSON.stringify(loadOptions.sort) : "", // Pass if sorting is remote
                    // Pass if paging is remote
                    skip: loadOptions.skip, // The number of records to skip
                    take: loadOptions.take, // The number of records to take
                    requireGroupCount: loadOptions.requireGroupCount,
                    requireTotalCount: loadOptions.requireTotalCount, // A flag telling the server whether the total count of records (totalCount) is required
                    group: loadOptions.group ? JSON.stringify(loadOptions.group) : "", // Pass if grouping is remote
                    totalSummary: loadOptions.totalSummary ? JSON.stringify(loadOptions.totalSummary) : "", // Pass if summary is calculated remotely
                    groupSummary: loadOptions.groupSummary ? JSON.stringify(loadOptions.groupSummary) : "" // Pass if grouping is remote and summary is calculated remotely
                }).done(function (result) {
                    console.log(result)
                    // You can process the received data here
                    d.resolve(result.data, { 
                        groupCount: result.groupCount,
                        totalCount: result.totalCount, // The count of received records; needed if paging is enabled
                        summary: result.summary // Needed if summary is calculated remotely
                    });
                });
                return d.promise();
            },
            byKey: function(key) {
                return $.getJSON("{{url('/')}}/api/Models/Employee/" + encodeURIComponent(key));
            },
            insert: function (values) {
                return $.ajax({
                    url: "{{url('/')}}/api/Models/Employee",
                    method: "POST",
                    data: values
                })
            },
            remove: function (key) {
                return $.ajax({
                    url: "{{url('/')}}/api/Models/Employee/" + encodeURIComponent(key),
                    method: "DELETE",
                })
            },
            update: function (key, values) {
                return $.ajax({
                    url: "{{url('/')}}/api/Models/Employee/" + encodeURIComponent(key),
                    method: "PUT",
                    data: values
                })
            }
        });
        
        $(function() {
            $("#gridContainer").dxDataGrid({
                dataSource: gridDataSource,
                // remoteOperations: { groupPaging: true }, // all operations including group paging
                remoteOperations: true, // all operations except group paging

                // columns: [
                //     "id", 
                //     'ac_no',
                //     'nik_karyawan',
                //     'name',
                //     'date',
                //     'clock_in',
                //     'clock_out',
                //     'late',
                //     'work_time',
                //     'att_time',
                //     'catatan',
                //     'month',
                //     'year',
                //     'work_day',
                //     // "created_by", 
                //     // "updated_by", 
                //     {
                //         dataField: "created_at",
                //         dataType: "date"
                //     }, 
                //     {
                //         dataField: "updated_at",
                //         dataType: "date"
                //     },
                // ],
                // keyExpr: "id",
                columnChooser: {
                    enabled: true,
                    mode: "dragAndDrop" // or "select"
                },
                columnFixing: {
                    enabled: true
                },
                columnAutoWidth: true,
                allowColumnResizing: true,
                columnResizingMode: 'widget', // or 'nextColumn'
                rowAlternationEnabled: true,
                hoverStateEnabled: true,
                showBorders: true,
                grouping: {
                    autoExpandAll: false,
                    contextMenuEnabled: true
                },
                groupPanel: {
                    visible: true
                },       
                searchPanel: {
                    visible: true
                },   
                filterRow: {
                    visible: true
                },
                headerFilter: {
                    visible: true
                },
                paging: {
                    pageSize: 10
                },
                pager: {
                    showPageSizeSelector: true,
                    allowedPageSizes: [10, 50, 100],
                    showInfo: true
                }
            });
        });
    </script>
</body>
</html>
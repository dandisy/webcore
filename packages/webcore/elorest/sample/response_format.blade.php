<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Elorest Response Format</title>
</head>
<body>
    <form action="">
        <input type="text" name="name" value="dandi setiyawan">
        <input type="text" name="address" value="cengkareng">
    </form>

    <script src="{{ asset('vendor/jQuery/jquery-2.2.3.min.js') }}"></script>
    <script>
    $.ajax({
            url: '{{url("/")}}/api/elorest/User', // &form.serialize(), no url parameters for elorest
            data: $('form').serialize() + "&" + $.param({                    
                "$data": [
                    [ // array in array indicate collection (grouping)
                        {"groupBy": "name"},
                        {
                            "$key": "$this.name",
                            "$count": {"count": "*"},
                            "$items" : {
                                "where": "name,$this.name",
                                "get": "name,email"
                            },
                            // "$items" : [
                            //     [ // array in array indicate collection (grouping)
                            //         {
                            //             // "where": "name,$this.name", // auto filter by system using parent $items conditions
                            //             "groupBy": "type" // "type" is only example a column name to second nested grouping
                            //         },
                            //         {
                            //             "$key": "$this.name", // $this.name is example a column name which is "name" column in secend nested grouping
                            //             "$count": {"count": "*"},
                            //             "$items" : {
                            //                 "where": "name,$this.name",
                            //                 "get": "name,email"
                            //             },
                            //             "$summary": [
                            //                 {
                            //                     "where": "name,$this.name",
                            //                     "sum": "id"
                            //                 },
                            //                 {
                            //                     "where": "name,$this.name",
                            //                     "max": "id"
                            //                 }
                            //             ]
                            //         }
                            //     ]
                            // ],
                            "$summary": [
                                {
                                    "where": "name,$this.name",
                                    "sum": "id"
                                },
                                {
                                    "where": "name,$this.name",
                                    "max": "id"
                                }
                            ]
                        }
                    ]
                ],
                "$totalCount": {"count": '*'},
                // $test1 status = ok
                "$test1": {
                    "$count": {"count": "*"},
                    "$items" : {
                        "where": "name,User",
                        "get": "name,email"
                    }
                },
                // $test2 status = ok
                "$test2" : {
                    "where": "name,User",
                    "get": "name,email"
                },                
                // $test3 status = ok with exception
                "$test3": {
                    "$items" : [
                        {"sum": "id"},
                        // // todo : not ok, still return all User
                        // {
                        //     "where": "name,User",
                        //     "get": "name,email"
                        // },
                        {
                            "$count": {"count": "*"},
                            "$items" : {
                                "where": "name,User",
                                "get": "name,email"
                            }
                        }
                    ]
                },
                "$summary": [
                    {"sum": "id"},
                    {"max": "id"}
                ],
                // 'status', // auto add by server
                // 'message' // auto add by server
            })
        }).then(function(res) {
            console.log(res);
        });
    </script>
</body>
</html>
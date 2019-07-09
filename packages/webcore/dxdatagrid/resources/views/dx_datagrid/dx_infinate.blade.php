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

    <!-- <script src="data.js"></script> -->
    <script>
    var s = 123456789;
    var random = function() {
        s = (1103515245 * s + 12345) % 2147483647;
        return s % (10 - 1);
    };

    var generateData = function (count) {
        var i;
        var surnames = ['Smith', 'Johnson', 'Brown', 'Taylor', 'Anderson', 'Harris', 'Clark', 'Allen', 'Scott', 'Carter'];
        var names = ['James', 'John', 'Robert', 'Christopher', 'George', 'Mary', 'Nancy', 'Sandra', 'Michelle', 'Betty'];
        var gender = ['Male', 'Female'];
        var items = [],
            startBirthDate = Date.parse('1/1/1975'),
            endBirthDate = Date.parse('1/1/1992');

        for (i = 0; i < count; i++) {
            var birthDate = new Date(startBirthDate + Math.floor(
                    random() * 
                    (endBirthDate - startBirthDate) / 10));
            birthDate.setHours(12);

            var nameIndex = random();
            var item = {
                id: i + 1,
                firstName: names[nameIndex],
                lastName: surnames[random()],
                gender: gender[Math.floor(nameIndex / 5)],
                birthDate: birthDate
            };
            items.push(item);
        }
        return items;
    };
    </script>

    <!-- <link rel="stylesheet" type="text/css" href="styles.css" /> -->
    <style>
    #gridContainer {
        height: 440px;
    }
    </style>

    <!-- <script src="index.js"></script> -->
    <script>
    $(function(){
        $("#gridContainer").dxDataGrid({
            dataSource: generateData(100000),
            showBorders: true,
            customizeColumns: function (columns) {
                columns[0].width = 70;
            },
            loadPanel: {
                enabled: false
            },
            scrolling: {
                mode: 'infinite'
            },
            sorting: {
                mode: "none"
            }
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
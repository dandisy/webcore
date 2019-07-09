# dandisy/dxdatagrid

dxDataGrid Server Processing for Webcore

    - all Http GET request with {your-domain}/api/dx-server/{ModelNameSpace}/{Model?} url will be routed to DXDataGrid server processing.
    - for other Http requests (POST, PUT, PATCH and DELETE) can be handled with Elorest.

### Usage

-   add DXDataGrid route to routes/api.php
    
        DXDataGrid::routes();

-   copy public folder
-   copy resource folder (as examples)

### Todo

- [x] paging
- [x] global search
- [x] column search
- [x] column filter (crash on 300.000 data in column)
- [x] column sort
- [x] group by a column (limited to 1.000 items in group, and crash on 300.000 data diff in column)

- [ ] where not like, not working
- [ ] make only column with contens diff max 30 can by filtered and grouped. due to crash
- [ ] handling summary
- [ ] handling group summary
- [ ] handling group in group (nested group)
- [ ] testing multi group
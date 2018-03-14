# pagination in php 

### sql for pagination is following

~~~sql
select * from <tablename> limit <offset_number>,<limit_number>;
# or
select * from <tablename> limit <limit_number> offset <offset_number>;
~~~

Latter one is better since its clear to us.      

## Offset value
getting offset value dynamically by calculating limit and $page number

~~~php
// $page = isset($_GET['page']) ? $_GET['page'] : 1;
// if (isset($_GET['page'])) {
//  $page = $_GET['page'];
// }else {
//  $page = 1;
// }
$page = $_GET['page'] ?? 1;
//$offset = ($page -1) * $limit;
$offset = $page * $limit - $limit;

~~~

## total row in database
In order to get total row in database we need to use rowCount method.

~~~php
$results2 = $con->query('select * from people');
$total_row_in_database = $results2->rowCount();
~~~

## number of page

we can calculate number of page by dividing total_row with limit. Since it might gives us total fraction value(float), We ceil this result using php ceil function.
~~~php
$total_page = ceil( $total_row_in_database / $limit);
~~~

## paginate data from database

~~~php
$results = $con->query("select * from people limit $limit offset $offset");
$people = $results->fetchAll(PDO::FETCH_OBJ);
~~~

## pagination markup with logic

~~~php

<nav aria-label="Page navigation example">
  <ul class="pagination">
    <li class="page-item <?php echo $page <= 1 ? 'disabled' : '' ?>"><a class="page-link" href="/?page=<?php echo $page - 1 ?>">Previous</a></li>
    <?php for($i = 1; $i <= $total_page; $i++) : ?>

    <li class="page-item <?php echo $page == $i ? 'active' : '' ?>"><a class="page-link" href="/?page=<?php echo $i ?>"><?php echo $i; ?></a></li>


  <?php endfor; ?>

    <li class="page-item <?php echo $page >= $total_page ? 'disabled' : '' ?>"><a class="page-link" href="/?page=<?php echo $page + 1 ?>">Next</a></li>
  </ul>
</nav>  
~~~
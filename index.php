<?php 
// $page = isset($_GET['page']) ? $_GET['page'] : 1;
// if (isset($_GET['page'])) {
// 	$page = $_GET['page'];
// }else {
// 	$page = 1;
// }
$page = $_GET['page'] ?? 1;
$limit = 10;
$offset = $page * $limit - $limit;

$con = new PDO('mysql:host=localhost;dbname=paginate', 'root', '');
$results = $con->query("select * from people limit $limit offset $offset");
$people = $results->fetchAll(PDO::FETCH_OBJ);

$results2 = $con->query('select * from people');
$total_row_in_database = $results2->rowCount();
$total_page = ceil( $total_row_in_database / $limit);
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<link rel="stylesheet" href="bootstrap.css">
</head>
<body class="bg-info">
	<div class="container mt-5">
		<div class="card">
			<div class="card-header">
				<h2>All people</h2>
			</div>
			<div class="card-body">
				<table class="table table-bordered">
					<tr>
						<th>Id</th>
						<th>Name</th>
						<th>Email</th>
					</tr>
					<?php foreach($people as $person) : ?>
					<tr>
						<td><?php echo $person->id ?></td>
						<td><?php echo $person->name ?></td>
						<td><?php echo $person->email ?></td>
					</tr>
					<?php endforeach; ?>

				</table>
				<div class="my-4">
					<nav aria-label="Page navigation example">
					  <ul class="pagination">
					    <li class="page-item <?php echo $page <= 1 ? 'disabled' : '' ?>"><a class="page-link" href="/?page=<?php echo $page - 1 ?>">Previous</a></li>
					    <?php for($i = 1; $i <= $total_page; $i++) : ?>

					    <li class="page-item <?php echo $page == $i ? 'active' : '' ?>"><a class="page-link" href="/?page=<?php echo $i ?>"><?php echo $i; ?></a></li>


						<?php endfor; ?>

					    <li class="page-item <?php echo $page >= $total_page ? 'disabled' : '' ?>"><a class="page-link" href="/?page=<?php echo $page + 1 ?>">Next</a></li>
					  </ul>
					</nav>	
				</div>
			</div>
		</div>
	</div>
	
</body>
</html>
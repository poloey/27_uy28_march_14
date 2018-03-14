<?php 

$con = new PDO('mysql:host=localhost;dbname=paginate', 'root', '');
$con->query('drop table if exists people');
$con->query("create table people(
	id serial,
	name varchar(30),
	email varchar(30)
)");


$people = [
	'tasnia', 'mimi', 'tanim', 'mithu', 'nizam', 'asraf', 'akbar', 'sujon', 'rajib', 'sarif', 'parvez', 'helal', 'fahim', 'faria', 'nila', 'faysal', 'sumon', 'sarwar', 'riaz', 'palash', 'milky', 'rabby', 'hasnath', 'sarif'
];

foreach($people as $person) {
	$con->query("insert into people (name, email) values('$person', '$person@gmail.com')");
}
foreach($people as $person) {
	$con->query("insert into people (name, email) values('$person', '$person@gmail.com')");
}






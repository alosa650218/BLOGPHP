<?php
require 'classes/Database.php';

$database = new Database;


$post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

if($post['submit']){

    $id = $post['id'];
	$title = $post['title'];
    $body = $post['body'];
  

    $database->query('UPDATE post SET title =:title, body=:body WHERE id=:id');
    $database->bind(':title',$title);
    $database->bind(':body',$body);
    $database->bind(':id',$id);
    $database->execute();

   
  }


$database->query('SELECT * FROM  post');

$rows = $database->resultset();
?>
<link href = "css/bootstrap.css" rel="stylesheet">
<h1>Post </h1>


  <form method="post" action="<?php $_SERVER['PHP_SELF']; ?>">
  <label> ID </label></br>
  <input type="text" name="id" placeholder="Specify ID"><br />
  <label>Post Title</label></br>
  <input type="text" name="title" placeholder="Add a title..."><br />
  <label>Post Body</label></br>
  <textarea name="body"></textarea></br></br>
  <input type="submit" name="submit" value=Submit>

</form>

<h1> Post </h1>
<div>

<?php foreach($rows as $row) :?>

   <div>
      <h2><?php echo $row['title']; ?></h2>
      <p><?php echo $row['body'];    ?></p>
  </div>

<?php endforeach; ?>
</div>
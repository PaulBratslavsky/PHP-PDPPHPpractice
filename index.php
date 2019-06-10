<?php 
  error_reporting(E_ALL); ini_set('display_errors', 'on');
  require 'classes/Database.php'; 
  $database = new Database;
  

  $post = filter_input_array( INPUT_POST, FILTER_SANITIZE_STRING );

  if ( $post['submit']) {
    $title = $post['title'];
    $body = $post['post'];

    $database->query('INSERT INTO posts (title, body) VALUES(:title, :body)');
    $database->bind(':title', $title);
    $database->bind(':body', $body);

    $database->execute();

    if ( $database->lastInsertId() ) {
      echo '<p>Post Added!!!</p>';
      echo 'post submitted with title ' . $title;

    }



  }

  $database->query('SELECT * FROM posts');
  $rows = $database->resutlset();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
</head>
<body>
  <h1><?php echo "This is from PHP"; ?></h1>

  <h2>Add Post</h2>

  <form method="POST" action="<?php $_SERVER['PHP_SELF']; ?>">
    <div>
      <label for='title'>Add Title:</label><br>
      <input type="text" name="title" /><br><br>
    </div>

    <div>
      <label for='post'>Add Post:</label><br>
      <textarea name="post"></textarea><br>
    </div>
    <br>
    <input type="submit" name="submit" value="Submit Post" />
  </form>

  <?php foreach( $rows as $row ) : ?>
    
    <div>
      <h2><?php echo $row['title']; ?></h2>
      <p><?php echo $row['body']; ?></p>
    </div>

  <?php endforeach; ?>

</body>
</html>

<?php // echo phpinfo(); ?>
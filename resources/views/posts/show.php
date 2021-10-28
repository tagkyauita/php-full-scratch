<!DOCTYPE html>
<html lang="ja">
<head>
  <?php include($values["layouts"]."meta.php"); ?>
</head>
<body>
  <?php include($values["layouts"]."header.php"); ?>
  <main>
    <div class="container">
      <div class="my-4 text-right">
        <a href=<?php echo "/edit/".$post["id"] ?> class="btn btn-primary">
          編集する
        </a>
        <a href="<?php echo "/destroy/".$post["id"] ?>" class="btn btn-danger">
          削除する
        </a>        
      </div>
    
        <div class="card mb-4">
          <div class="card-header">
              <h2><?php echo $post["title"]; ?></h2>
          </div>
          <div class="card-body">
              <p><?php echo $post["body"]; ?></p>
          </div>
        </div>
    </div>
  </main>

  <?php include($values["layouts"]."footer.php"); ?>

</body>
</html>
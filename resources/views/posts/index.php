<!DOCTYPE html>
<html lang="ja">
<head>
  <?php include($values["layouts"]."meta.php"); ?>
</head>
<body>
  <?php include($values["layouts"]."header.php"); ?>
  <main>
    <div class="container">
      <div class="my-4">
        <a href="/create" class="btn btn-primary">
          投稿を新規作成する
        </a>
      </div>
    
      <?php foreach($posts as $post): ?>
        <div class="card mb-4">
          <div class="card-header">
              <h2><?php echo $post["title"]; ?></h2>
          </div>
          <div class="card-body">
              <p><?php echo $post["body"]; ?></p>
              <a href=<?php echo "show/".$post["id"]; ?> class="card-link">
                詳細を見る
              </a>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </main>

  <?php include($values["layouts"]."footer.php"); ?>

</body>
</html>
<!DOCTYPE html>
<html lang="ja">
<head>
  <?php include($values["layouts"]."meta.php"); ?>
</head>
<body>
  <?php include($values["layouts"]."header.php"); ?>
  <main>
    <div class="container my-4">
      <div class="border p-4">
          <h5 class="mb-4">
              新規投稿作成
          </h5>

          <h5 class="mb-4 text-danger">
              <?php foreach ($error as $alert):?>
                <?php echo $alert."<br>"; ?>
              <?php endforeach; ?>
          </h5>

          <form action="store" method="POST">
            <fieldset>
                <div class="form-group">
                <label for="title">
                    タイトル
                </label>
                <input type="text" 
                       id="title" 
                       name="title" 
                       class="form-control"
                       value="<?php echo $posts['title']; ?>"
                >
                </div>

                <div class="form-group">
                <label for="body">
                    本文
                </label>
                <textarea type="text" 
                          id="body" 
                          name="body" 
                          class="form-control" 
                          rows="10"
                ><?php echo $posts['body']; ?></textarea>
                </div>
                <div>
                    <a href="/" class="btn btn-secondary">
                        キャンセル
                    </a>
                    <button type="submit" class="btn btn-primary">
                        投稿する
                    </button>
                </div>
            </fieldset>    
          </form>
      </div>
    </div>
  </main>

  <?php include($values["layouts"]."footer.php"); ?>

</body>
</html>
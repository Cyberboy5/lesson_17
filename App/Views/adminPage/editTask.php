<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h2 class="card-title">Update Task</h2>
              </div>
              <form action="/editTask" method="POST" enctype="multipart/form-data">
                <div class="card-body">

                  <!-- Title Field -->
                  <div class="form-group">
                    <label for="exampleInputEmail1">Title</label>
                    <input type="text" name='title' value="<?= htmlspecialchars($_POST['title']) ?>" class="form-control" id="exampleInputEmail1" placeholder="Enter Title:">
                  </div>
                  <input type="hidden" name="id" value="<?= $_POST['id']?>">

                  <!-- Description Field -->
                  <div class="form-group">
                    <label for="exampleInputdesc">Description</label>
                    <textarea name="description" class="form-control" id="exampleInputdesc" placeholder="Enter Description..."><?= htmlspecialchars($_POST['description']) ?></textarea>
                  </div>

                  <div class="form-group">
                    <label for="exampleInputdesc">Comment</label>
                    <textarea name="comment" class="form-control" id="exampleInputdesc" placeholder="Enter Comment..."><?= htmlspecialchars($_POST['comment']) ?></textarea>
                  </div>

                  <!-- User Selection Field -->
                  <div class="form-group">
                    <label for="exampleInputuser">Assign User</label>
                    <select name="user_id" class="form-control" id="exampleInputuser">
                        <?php foreach($data as $user) { ?>
                            <option value="<?= $user['id'] ?>" <?= ($user['name'] == $_POST['name']) ? 'selected' : '' ?>>
                                <?= htmlspecialchars($user['name']) ?>
                            </option>
                        <?php } ?>
                    </select>
                  </div>
                  <!-- File Input Field -->
                  <div class="form-group">
                    <label for="exampleInputFile">File input</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" name="image" class="custom-file-input" id="exampleInputFile">
                        <label class="custom-file-label" for="exampleInputFile">
                          <?= !empty($_POST['image']) ? htmlspecialchars($_POST['image']) : 'Choose file' ?>
                        </label>
                    </div>
                    <div class="input-group-append">
                        <span class="input-group-text">Upload</span>
                    </div>
                </div>
                <img class = 'm-1' src="<?= $_POST['image']?>" width="200px" alt="image">
                  </div>

                  <!-- Example Check Field (if needed) -->
                  <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="exampleCheck1">
                    <label class="form-check-label" for="exampleCheck1">Check me out</label>
                  </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" name='submit' class="btn btn-primary">Submit</button>
                </div>
              </form>
            </div>
            <!-- /.card -->
          </div>
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>

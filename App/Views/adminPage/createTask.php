
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->


    <!-- Main content -->
    <section class="content m-5">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">General Form</h3>
              </div>
              <form action="/createTask" method="POST" enctype="multipart/form-data">
                <div class="card-body">

                  <div class="form-group">
                    <label for="exampleInputEmail1">Title</label>
                    <input type="text" name = 'title' class="form-control" id="exampleInputEmail1" placeholder="Enter Title:">
                  </div>

                  <div class="form-group">
                    <label for="exampleInputdesc">Description</label>
                    <textarea name="description"  class="form-control"  id="exampleInputdesc" placeholder="Enter Description..."></textarea>
                  </div>

                  <div class="form-group">
                    <label for="exampleInputuser">Assign User</label>
                    <select name="user_id" class="form-control" id="exampleInputuser">
                        <?php
                            foreach($data as $user){?>
                                <option value="<?= $user['id']?>"><?= $user['name']?></option>
                            <?php }
                        ?>
                    </select>
                  </div>

                  <div class="form-group">
                    <label for="exampleInputstt">Status</label>
                    <select name="status" class="form-control" id="exampleInputstat">
                        <option selected value="todo">To Do</option>
                        <option value="in progress">In Progress</option>
                    </select>
                  </div>

                  <div class="form-group">
                    <label for="exampleInputFile">File input</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" name="image" class="custom-file-input" id="exampleInputFile">
                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                      </div>
                      <div class="input-group-append">
                        <span class="input-group-text">Upload</span>
                      </div>
                    </div>
                  </div>

                  <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="exampleCheck1">
                    <label class="form-check-label" for="exampleCheck1">Check me out</label>
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" name = 'submit' class="btn btn-primary">Submit</button>
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
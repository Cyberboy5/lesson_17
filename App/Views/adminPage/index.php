
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3>To Do</h3>
                <p>Tasks</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <form action="/admin_page" method="POST">
                <input type="hidden" name="status" value="todo">
                <button class="btn btn-info" name="more_info">More Info</button>
                <i class="fas fa-arrow-circle-right"></i>
                </form>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3>In Progress</h3>

                <p>Tasks</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <form action="/admin_page" method="POST">
                <input type="hidden" name="status" value="in progress">
                <button class="btn btn-success" name="more_info">More Info</button>
                <i class="fas fa-arrow-circle-right"></i>
              </form>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3>Done</h3>

                <p>Tasks</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <form action="/admin_page" method="POST">
                <input type="hidden" name="status" value="done">
                <button class="btn btn-warning" name="more_info">More Info</button>
                <i class="fas fa-arrow-circle-right"></i>
              </form>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3>Rejacted</h3>

                <p>Tasks</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
              <form action="/admin_page" method="POST">
                <input type="hidden" name="status" value="rejacted">
                <button class="btn btn-danger" name="more_info">More Info</button>
                <i class="fas fa-arrow-circle-right"></i>
              </form>
            </div>
          </div>
          <!-- ./col -->
        </div>
        <!-- /.row -->
        <div class="row">
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <a href = '/createTask' class = 'btn btn-primary m-2' >Add new Task</a>
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">DataTable with default features</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>ID</th>
                    <th>Image</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>User Name</th>
                    <th>Comment</th>
                    <th>Status</th>
                    <th>Options</th>
                  </tr>
                  </thead>
                  <tbody>
                    
                    <?php
                  // dd($data);
                  foreach($data as $task){?>
                    <tr>
                      <td><?= $task['id']?></td>
                      <td><img src="<?= $task['image']?>" width="150px" alt="image"></td>
                      <td><?= $task['title']?></td>
                      <td><?= $task['description']?></td>
                      <td><?= $task['name']?></td>
                      <td><?= $task['comment']?></td>
                      <td><?= $task['status']?></td>
                      <td>
                      <form action="/editTaskPage" method="POST">
                        <button class="btn btn-warning m-2" name = 'edit'>Edit</button>
                        <input type="hidden" value="<?= $task['id']?>" name="id">
                        <input type="hidden" value="<?= $task['title']?>" name="title">
                        <input type="hidden" value="<?= $task['description']?>" name="description">
                        <input type="hidden" value="<?= $task['name']?>" name="name">
                        <input type="hidden" value="<?= $task['comment']?>" name="comment">
                        <input type="hidden" value="<?= $task['status']?>" name="status">
                        <input type="hidden" value="<?= $task['image']?>" name="image">
                      </form>
                      <form action="/deleteTask" method="POST">
                        <button class="btn btn-danger" name = 'delete'>Delete</button>
                        <input type="hidden" value="<?= $task['id']?>" name="id">
                      </form>

                      </td>
                    </tr>
                    <?php } ?>
                 
                  </tbody>
                  <tfoot>
                  <tr>
                    <th>ID</th>
                    <th>Image</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>User Name</th>
                    <th>Comment</th>
                    <th>Status</th>
                    <th>Options</th>

                  </tr>
                  </tfoot>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>


  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 3.2.0
    </div>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

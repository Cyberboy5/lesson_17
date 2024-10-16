
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->

    <!-- Main content -->
    <section class="content">
    </section>
    <!-- /.content -->
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <h1 >Users</h1>
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">DataTable with User Informations</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Password</th>
                    <th>Role</th>
                    <th>Status</th>
                    <th>Registration Date</th>
                    <th>Options</th>
                  </tr>
                  </thead>
                  <tbody>
                    
                    <?php
                  // dd($data);
                  foreach($data as $user){?>
                    <tr>
                      <td><?= $user['id']?></td>
                      <td><?= $user['name']?></td>
                      <td><?= $user['email']?></td>
                      <td><?= $user['password']?></td>
                      <td><?= $user['role']?></td>
                      <td><?= $user['status']?></td>
                      <td><?= $user['registration_date']?></td>
                    <?php
                        if($user['status'] == 0){?>
                        <td>
                          <form action="/activateUser" method="POST">
                              <input type="hidden" value="<?= $user['id']?>" name="id">
                              <button class = "btn btn-primary" name = 'activate'>Activate</button>
                          </form>
                         </td>
                        <?php }else{?>
                          <td>
                          <form action="/activateUser" method="POST">
                              <input type="hidden" value="<?= $user['id']?>" name="id">
                              <button class = "btn btn-danger" name = 'deactivate'>Deactivate</button>
                          </form>
                         </td>

                        <?php }   ?>
                    </tr>
                    <?php } ?>
                 
                  </tbody>
                  <tfoot>
                  <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Password</th>
                    <th>Role</th>
                    <th>Status</th>
                    <th>Registration Date</th>
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

  <style>
    .col-lg-2 {
      flex: 0 0 20%; /* Adjust the percentage so that all cards fit the row without space */
      max-width: 20%;
  }
  </style>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-2 col-md-3 col-sm-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3>To Do</h3>
                <h5><?= $data['status_counts']['todo_count']?> tasks</h5>
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
          
          <div class="col-lg-2 col-md-3 col-sm-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3>In Progress</h3>
                <h5><?= $data['status_counts']['in_progress_count']?> tasks</h5>
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
          
          <div class="col-lg-2 col-md-3 col-sm-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3>Done</h3>
                <h5><?= $data['status_counts']['done_count']?> tasks</h5>
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
          
          <div class="col-lg-2 col-md-3 col-sm-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3>Rejected</h3>
                <h5><?= $data['status_counts']['rejected_count']?> tasks</h5>
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
          
          <div class="col-lg-2 col-md-3 col-sm-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3>Completed</h3>
                <h5><?= $data['status_counts']['completed_count']?> tasks</h5>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <form action="/admin_page" method="POST">
                <input type="hidden" name="status" value="completed">
                <button class="btn btn-success" name="more_info">More Info</button>
                <i class="fas fa-arrow-circle-right"></i>
              </form>
            </div>
          </div>
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
                    <th>User Name</th>
                    <th>Status</th>
                    <th>Options</th>
                  </tr>
                  </thead>
                  <tbody>
                    
                  <?php
                      foreach($data['tasks'] as $task){
                      ?>
                      <tr>
                        <td><?= $task['id']?></td>
                        <td><img src="<?= $task['image']?>" width="150px" alt="image"></td>
                        <td><?= $task['title']?></td>
                                  <td><?= $task['name']?></td>
                  <?php
                  if($task['status'] == 'done'){?>
                        <td>
                            <a href="#" data-toggle="modal" data-target="#completeRejectModal"
                              data-task-id="<?= $task['id'] ?>"
                              data-task-title="<?= $task['title'] ?>"
                              data-task-status="<?= $task['status'] ?>"
                              data-task-description="<?= $task['description'] ?>"
                              data-task-status="<?= $task['status'] ?>">
                              <?= $task['status'] ?>
                            </a>
                        </td>

                  <?php }else{?>
                    <td><?= $task['status']?></td>
                  <?php }  ?>
                <td>
                <!-- Existing forms for edit and delete buttons -->
                <div class="d-inline-block">
                  <form action="/editTaskPage" method="POST" class="d-inline-block">
                    <button class="btn btn-warning m-2" name='edit'><i class="bi bi-pen-fill"></i></button>
                    <input type="hidden" value="<?= $task['id']?>" name="id">
                    <input type="hidden" value="<?= $task['title']?>" name="title">
                    <input type="hidden" value="<?= $task['description']?>" name="description">
                    <input type="hidden" value="<?= $task['name']?>" name="name">
                    <input type="hidden" value="<?= $task['comment']?>" name="comment">
                    <input type="hidden" value="<?= $task['status']?>" name="status">
                    <input type="hidden" value="<?= $task['image']?>" name="image">
                  </form>
                </div>
                <div class="d-inline-block">
                  <form action="/deleteTask" method="POST" class="d-inline-block">
                    <button class="btn btn-danger" name='delete'><i class="bi bi-trash3-fill"></i></button>
                    <input type="hidden" value="<?= $task['id']?>" name="id">
                  </form>
                </div>
                <div class="d-inline-block">
                  <button class="btn btn-info"
                          data-toggle="modal"
                          data-target="#taskInfoModal"
                          data-task-id="<?= $task['id'] ?>" 
                          data-task-title="<?= $task['title'] ?>"
                          data-task-description="<?= $task['description'] ?>"
                          data-task-user="<?= $task['name'] ?>"
                          data-task-comment="<?= $task['comment'] ?>"
                          data-task-image="<?= $task['image'] ?>"
                          data-task-status="<?= $task['status'] ?>">
                    <i class="bi bi-eye-fill"></i>
                  </button>
                </div>
              </td>
          </tr>

          <?php } ?>
                 
                  </tbody>
                  <tfoot>
                  <tr>
                    <th>ID</th>
                    <th>Image</th>
                    <th>Title</th>
                    <th>User Name</th>
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

<div class="modal fade" id="taskInfoModal" tabindex="-1" role="dialog" aria-labelledby="taskInfoModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="taskInfoModalLabel">Task Information</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p><strong>Title:</strong> <span id="taskTitle"></span></p>
                <p><strong>Description:</strong> <span id="taskDescription"></span></p>
                <p><strong>Assigned User:</strong> <span id="taskUser"></span></p>
                <p><strong>Status:</strong> <span id="taskStatus"></span></p>
                <p><strong>Comment:</strong> <span id="taskComment"></span></p>
                <p><strong>Image:</strong> <img id="taskImage" width="150px" alt="Task Image"></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Complete or Reject Modal -->
<div class="modal fade" id="completeRejectModal" tabindex="-1" role="dialog" aria-labelledby="completeRejectModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="POST" action="/handle_completion">
                <div class="modal-header">
                    <h5 class="modal-title" id="completeRejectModalLabel">Complete or Reject Task</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Task ID: <span id="modal-task-id-display"></span></p>
                    <p>Task Title: <span id="modal-task-title-display"></span></p>
                    <input type="hidden" name="task_id" id="modal-task-id">
                    <input type="hidden" name="task_title" id="modal-task-title">
                    <input type="hidden" name="task_status" id="modal-task-status">
                    
                    <div class="form-group" id="rejectCommentContainer">
                        <label for="rejectComment">Comment (required for rejection):</label>
                        <textarea class="form-control" name="reject_comment" id="rejectComment" rows="3"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" name="action" value="reject" class="btn btn-danger">Reject</button>
                    <button type="submit" name="action" value="complete" class="btn btn-success">Complete</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>


<?php
$host = "localhost";
$user = "root";
$paswoord = "";
$dp = "to_do_list";
$connection = mysqli_connect($host, $user, $paswoord, $dp);

$select = "SELECT * from tasks";
$selected_data = mysqli_query($connection, $select);

if (isset($_POST["insert"])) {
  $task_name = $_POST["TASK_NAME"];
  $task_desc = $_POST["TASK_DESC"];
  $insert = "INSERT INTO tasks VALUES ('null','$task_name','$task_desc','0')";
  $new = mysqli_query($connection, $insert);
  if ($new) {
    header("location:index.php");
  }
}

if (isset($_GET["edit"])) {
  $updated_ID = $_GET["edit"];
  $GET_Updated = "UPDATE tasks SET STATUS='1' WHERE ID='$updated_ID'";
  $GET_query = mysqli_query($connection, $GET_Updated);
  if ($GET_query) {
    header("location:index.php");
    // exit();
?>
    <script>
      reloadPage();
    </script>
<?php
  }
}
if (isset($_GET["delete"])) {
  $ID = $_GET["delete"];
  $delete_query = "DELETE FROM tasks WHERE ID='$ID'";
  $delete_excute = mysqli_query($connection, $delete_query);
  if ($delete_excute) {
    header("location:index.php");
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- <link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet"> -->

  <link rel="stylesheet" href="fonts/icomoon/style.css">

  <link rel="stylesheet" href="css/owl.carousel.min.css">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="css/bootstrap.min.css">

  <!-- Style -->
  <link rel="stylesheet" href="css/style.css">
  <title>Document</title>
</head>

<body style="background-color: #eee;">

  <section style="background-color: #eee;">
    <div class="container py-5">
      <div class="row d-flex justify-content-center align-items-center ">
        <div class="col col-lg-15 col-xxl-9">
          <div class="card rounded-5">
            <div class="card-body p-5">
              <!-- <div class="text-center pt-3 pb-2">
                <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-todo-list/check1.webp" alt="Check" width="60">
                <h2 class="my-4">Task List</h2>
              </div> -->
              <h4 class="text-center my-3 pb-3">To Do App</h4>

              <form class="row row-cols-lg-auto g-3 justify-content-center align-items-center mb-4 pb-2" method="post">
                <div class="col-8">
                  <div class="form-outline">
                    <input type="text" id="form1" name="TASK_NAME" class="form-control" />
                    <label class="form-label" for="form1">Enter a task name here</label>
                  </div>
                  <div class="form-outline">
                    <input type="text" id="form1" name="TASK_DESC" class="form-control" />
                    <label class="form-label" for="form1">Enter a task here</label>
                  </div>
                </div>

                <div class="col-8">
                  <input value="save" type="submit" name="insert" class="btn btn-primary">
                </div>

              </form>

              <table class="table mb-5">
                <thead>
                  <tr>
                    <th scope="col">No.</th>
                    <th scope="col">Name</th>
                    <th scope="col">Todo item</th>
                    <th scope="col">Status</th>
                    <th scope="col">Actions</th>
                  </tr>
                </thead>

                <tbody>
                  <?php foreach ($selected_data as $row) { ?>
                    <tr>

                      <th scope="row">
                        <?php echo $row["ID"]; ?>
                      </th>
                      <td><?php echo $row["TASK_NAME"]; ?></td>
                      <td class="d-block">
                        <?php echo $row["TASK_DESC"]; ?>
                      </td>
                      <td><?php
                          if ($row["STATUS"]) {
                            echo "Finished";
                          } else {
                            echo "In progress";
                          }
                          ?></td>
                      <td>
                        <a class="btn btn-danger" href="index.php?delete=<?php echo $row["ID"]; ?>"><button type="submit" class="btn btn-danger">Delete</button></a>
                        <a class="btn btn-success" href="index.php?edit=<?php echo $row["ID"]; ?>"><button type="submit" class="btn btn-success">Finished</button></a>
                      </td>
                    </tr>
                  <?php } ?>

                </tbody>

              </table>

            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <script src="js/jquery-3.3.1.min.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/main.js"></script>
</body>

</html>
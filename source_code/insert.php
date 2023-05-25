<?php

include('config/db.php');
include('classes/DB.php');
include('classes/Jobdesc.php');
include('classes/Project.php');
include('classes/Team.php');
include('classes/Template.php');

// Membuat objek Team
$team = new Team($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$team->open();
$jobdesc = new Jobdesc($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$jobdesc->open();
$project = new Project($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$project->open();

if (isset($_POST['submit'])) {
    //memanggil add
    $result = $team->addData($_POST, $_FILES);

    if ($result) {
      echo "<script>
        alert('Data berhasil ditambah!');
        document.location.href = 'index.php';
      </script>";
    } else {
      echo "<script>
          alert('Data gagal ditambah!');
          document.location.href = 'index.php';
      </script>";
    }
}
$team->close();

$project->getProject();
$dataProject = null;
while ($row = $project->getResult()) {
  $dataProject .= "<option value=" . $row['id_project'] . ">" . $row['nama_project'] . "</option>";
}
$project->close();

$jobdesc->getJobdesc();
$dataJobdesc = null;

while ($row = $jobdesc->getResult()) {
    $dataJobdesc .= "<option value=" . $row['id_jobdesc'] . ">" . $row['nama_jobdesc'] . "</option>";
}
$jobdesc->close();

$template = new Template('templates/skinInsert.html');
$mainTitle = 'Tambah';
$template->replace('DATA_MAIN_TITLE', $mainTitle);
$template->replace('DATA_PROJECT', $dataProject);
$template->replace('DATA_JOBDESC', $dataJobdesc);
$template->write();

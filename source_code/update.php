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
$template = new Template('templates/skinInsert.html');

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    if ($id > 0) {
        if (isset($_POST['submit'])) {
            if ($team->updateData($id, $_POST, $_FILES) > 0) {
                echo "<script>
                alert('Data berhasil diubah!');
                document.location.href = 'index.php';
            </script>";
            } else {
                echo "<script>
                alert('Data gagal diubah!');
                document.location.href = 'index.php';
            </script>";
            }
        } 
    }
    $team->getTeamById($id);
    $row = $team->getResult();

    $dataUpdate['nama_anggota'] = $row['nama_anggota'];
    $dataUpdate['id_project'] = $row['id_project'];
    $dataUpdate['id_jobdesc'] = $row['id_jobdesc'];
    $dataUpdate['foto_anggota'] = $row['foto_anggota'];
    $btn = 'Simpan';
    $title = 'Ubah';

    $template->replace('DATA_UPDATE_NAMA', $dataUpdate['nama_anggota']);
    $template->replace('DATA_UPDATE_PROJECT', $dataUpdate['id_project']);
    $template->replace('DATA_UPDATE_JOBDESC', $dataUpdate['id_jobdesc']);
    $template->replace('DATA_UPDATE_FOTO', $dataUpdate['foto_anggota']);
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

$mainTitle = 'Update';
$template->replace('DATA_MAIN_TITLE', $mainTitle);
$template->replace('DATA_PROJECT', $dataProject);
$template->replace('DATA_JOBDESC', $dataJobdesc);
$template->write();
<?php

include('config/db.php');
include('classes/DB.php');
include('classes/Project.php');
include('classes/Template.php');

$project = new Project($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$project->open();
$project->getProject();

// cari pengurus
if (isset($_POST['btn-cari'])) {
    // methode mencari data pengurus
    $project->searchProject($_POST['cari']);
}

if (!isset($_GET['id'])) {
    if (isset($_POST['submit'])) {
        if ($project->addProject($_POST) > 0) {
            echo "<script>
                alert('Data berhasil ditambah!');
                document.location.href = 'project.php';
            </script>";
        } else {
            echo "<script>
                alert('Data gagal ditambah!');
                document.location.href = 'project.php';
            </script>";
        }
    }

    $btn = 'Tambah';
    $title = 'Tambah';
}

$view = new Template('templates/skintabel.html');

$mainTitle = 'Project';
$header = '<tr>
<th scope="row">No.</th>
<th scope="row">Nama Project</th>
<th scope="row">Aksi</th>
</tr>';
$data = null;
$no = 1;
$formLabel = 'project';

while ($div = $project->getResult()) {
    $data .= '<tr>
    <th scope="row">' . $no . '</th>
    <td>' . $div['nama_project'] . '</td>
    <td style="font-size: 22px;">
        <a href="project.php?id=' . $div['id_project'] . '" title="Edit Data"><i class="bi bi-pencil-square text-warning"></i></a>&nbsp;
        <a href="project.php?hapus=' . $div['id_project'] . '" title="Delete Data"><i class="bi bi-trash-fill text-danger"></i></a>
        </td>
    </tr>';
    $no++;
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    if ($id > 0) {
        if (isset($_POST['submit'])) {
            if ($project->updateProject($id, $_POST) > 0) {
                echo "<script>
                alert('Data berhasil diubah!');
                document.location.href = 'project.php';
            </script>";
            } else {
                echo "<script>
                alert('Data gagal diubah!');
                document.location.href = 'project.php';
            </script>";
            }
        }

        $project->getProjectById($id);
        $row = $project->getResult();

        $dataUpdate = $row['nama_project'];
        $btn = 'Simpan';
        $title = 'Ubah';

        $view->replace('DATA_VAL_UPDATE', $dataUpdate);
    }
}

if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    if ($id > 0) {
        if ($project->deleteProject($id) > 0) {
            echo "<script>
                alert('Data berhasil dihapus!');
                document.location.href = 'project.php';
            </script>";
        } else {
            echo "<script>
                alert('Data gagal dihapus!');
                document.location.href = 'project.php';
            </script>";
        }
    }
}

$project->close();

$view->replace('DATA_MAIN_TITLE', $mainTitle);
$view->replace('DATA_TABEL_HEADER', $header);
$view->replace('DATA_TITLE', $title);
$view->replace('DATA_BUTTON', $btn);
$view->replace('DATA_FORM_LABEL', $formLabel);
$view->replace('DATA_TABEL', $data);
$view->write();

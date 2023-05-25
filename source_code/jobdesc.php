<?php

include('config/db.php');
include('classes/DB.php');
include('classes/Jobdesc.php');
include('classes/Template.php');

$jobdesc = new Jobdesc($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$jobdesc->open();
$jobdesc->getJobdesc();

// cari pengurus
if (isset($_POST['btn-cari'])) {
    // methode mencari data pengurus
    $jobdesc->searchJobdesc($_POST['cari']);
}

if (!isset($_GET['id'])) {
    if (isset($_POST['submit'])) {
        if ($jobdesc->addJobdesc($_POST) > 0) {
            echo "<script>
                alert('Data berhasil ditambah!');
                document.location.href = 'jobdesc.php';
            </script>";
        } else {
            echo "<script>
                alert('Data gagal ditambah!');
                document.location.href = 'jobdesc.php';
            </script>";
        }
    }

    $btn = 'Tambah';
    $title = 'Tambah';
}

$view = new Template('templates/skintabel.html');

$mainTitle = 'Jobdesc';
$header = '<tr>
<th scope="row">No.</th>
<th scope="row">Nama Jobdesc</th>
<th scope="row">Aksi</th>
</tr>';
$data = null;
$no = 1;
$formLabel = 'jobdesc';

while ($div = $jobdesc->getResult()) {
    $data .= '<tr>
    <th scope="row">' . $no . '</th>
    <td>' . $div['nama_jobdesc'] . '</td>
    <td style="font-size: 22px;">
        <a href="jobdesc.php?id=' . $div['id_jobdesc'] . '" title="Edit Data"><i class="bi bi-pencil-square text-warning"></i></a>&nbsp;
        <a href="jobdesc.php?hapus=' . $div['id_jobdesc'] . '" title="Delete Data"><i class="bi bi-trash-fill text-danger"></i></a>
        </td>
    </tr>';
    $no++;
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    if ($id > 0) {
        if (isset($_POST['submit'])) {
            if ($jobdesc->updateJobdesc($id, $_POST) > 0) {
                echo "<script>
                alert('Data berhasil diubah!');
                document.location.href = 'jobdesc.php';
            </script>";
            } else {
                echo "<script>
                alert('Data gagal diubah!');
                document.location.href = 'jobdesc.php';
            </script>";
            }
        }

        $jobdesc->getJobdescById($id);
        $row = $jobdesc->getResult();

        $dataUpdate = $row['nama_jobdesc'];
        $btn = 'Simpan';
        $title = 'Ubah';

        $view->replace('DATA_VAL_UPDATE', $dataUpdate);
    }
}

if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    if ($id > 0) {
        if ($jobdesc->deleteJobdesc($id) > 0) {
            echo "<script>
                alert('Data berhasil dihapus!');
                document.location.href = 'jobdesc.php';
            </script>";
        } else {
            echo "<script>
                alert('Data gagal dihapus!');
                document.location.href = 'jobdesc.php';
            </script>";
        }
    }
}

$jobdesc->close();

$view->replace('DATA_MAIN_TITLE', $mainTitle);
$view->replace('DATA_TABEL_HEADER', $header);
$view->replace('DATA_TITLE', $title);
$view->replace('DATA_BUTTON', $btn);
$view->replace('DATA_FORM_LABEL', $formLabel);
$view->replace('DATA_TABEL', $data);
$view->write();
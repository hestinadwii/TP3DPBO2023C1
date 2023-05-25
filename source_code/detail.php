<?php

include('config/db.php');
include('classes/DB.php');
include('classes/Jobdesc.php');
include('classes/Project.php');
include('classes/Team.php');
include('classes/Template.php');

$team = new Team($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$team->open();

$data = nulL;

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    if ($id > 0) {
        $team->getTeamById($id);
        $row = $team->getResult();

        $data .= '<div class="card-header text-center">
        <h3 class="my-0">Detail ' . $row['nama_anggota'] . '</h3>
        </div>
        <div class="card-body text-end">
            <div class="row mb-5">
                <div class="col-3">
                    <div class="row justify-content-center">
                        <img src="assets/images/' . $row['foto_anggota'] . '" class="img-thumbnail" alt="' . $row['foto_anggota'] . '" width="60">
                        </div>
                    </div>
                    <div class="col-9">
                        <div class="card px-3">
                            <table border="0" class="text-start">
                                <tr>
                                    <td>Nama</td>
                                    <td>:</td>
                                    <td>' . $row['nama_anggota'] . '</td>
                                </tr>
                                <tr>
                                    <td>Project</td>
                                    <td>:</td>
                                    <td>' . $row['nama_project'] . '</td>
                                </tr>
                                <tr>
                                    <td>Role</td>
                                    <td>:</td>
                                    <td>' . $row['nama_jobdesc'] . '</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer text-end">
                <a href="update.php?id=' . $row['id_anggota'] . '"><button type="button" class="btn btn-success text-white">Ubah Data</button></a>
                <a href="detail.php?hapus=' . $row['id_anggota'] . '"><button type="button" class="btn btn-danger">Hapus Data</button></a>
            </div>';
    }
}

if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    if ($id > 0) {
        if ($team->deleteData($id) > 0) {
            echo "<script>
                alert('Data berhasil dihapus!');
                document.location.href = 'index.php';
            </script>";
        } else {
            echo "<script>
                alert('Data gagal dihapus!');
                document.location.href = 'index.php';
            </script>";
        }
    }
}

// if (isset($_POST['hapus'])) {
//     //memanggil add
//     $id = $_GET['hapus'];
//     $result = $team->deleteData($id);

//     if ($result) {
//       echo "<script>
//         alert('Data berhasil dihapus!');
//         document.location.href = 'index.php';
//       </script>";
//     } else {
//       echo "<script>
//           alert('Data gagal dihapus!');
//           document.location.href = 'index.php';
//       </script>";
//     }
//     //header("location:index.php");
//     //$team->close();
// }

$team->close();
$detail = new Template('templates/skindetail.html');
$detail->replace('DATA_DETAIL_TEAM', $data);
$detail->write();

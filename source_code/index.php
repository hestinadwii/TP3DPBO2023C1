<?php

include('config/db.php');
include('classes/DB.php');
include('classes/Jobdesc.php');
include('classes/Project.php');
include('classes/Team.php');
include('classes/Template.php');

// buat instance pengurus
$listTeam = new Team($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);

// buka koneksi
$listTeam->open();
// tampilkan data pengurus
$listTeam->getTeamJoin();

// cari pengurus
if (isset($_POST['btn-cari'])) {
    // methode mencari data pengurus
    $listTeam->searchTeam($_POST['cari']);
} else {
    // method menampilkan data Team
    $listTeam->getTeamJoin();
}

if (isset($_POST['sort_by'])) {
    $sort_by = $_POST['sort_by'];
    $listTeam->sorting($sort_by);

    // execute the query and display the results
}

$data = null;

// ambil data Team
// gabungkan dgn tag html
// untuk di passing ke skin/template
while ($row = $listTeam->getResult()) {
    $data .= '<div class="col gx-2 gy-3 justify-content-center">' .
        '<div class="card pt-4 px-2 Team-thumbnail">
        <a href="detail.php?id=' . $row['id_anggota'] . '">
            <div class="row justify-content-center">
                <img src="assets/images/' . $row['foto_anggota'] . '" class="card-img-top" alt="' . $row['foto_anggota'] . '">
            </div>
            <div class="card-body">
                <p class="card-text Team-nama my-0">' . $row['nama_anggota'] . '</p>
                <p class="card-text divisi-nama">' . $row['nama_project'] . '</p>
                <p class="card-text jabatan-nama my-0">' . $row['nama_jobdesc'] . '</p>
            </div>
        </a>
    </div>    
    </div>';
}

// tutup koneksi
$listTeam->close();

// buat instance template
$home = new Template('templates/skin.html');

// simpan data ke template
$home->replace('DATA_TEAM', $data);
$home->write();

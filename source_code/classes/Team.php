<?php

class Team extends DB
{
    function getTeamJoin()
    {
        $query = "SELECT * FROM team JOIN project ON team.id_project=project.id_project JOIN jobdesc ON team.id_jobdesc=jobdesc.id_jobdesc ORDER BY team.id_anggota";

        return $this->execute($query);
    }

    function getTeam()
    {
        $query = "SELECT * FROM team";
        return $this->execute($query);
    }

    function getTeamById($id)
    {
        $query = "SELECT * FROM team JOIN project ON team.id_project=project.id_project JOIN jobdesc ON team.id_jobdesc=jobdesc.id_jobdesc WHERE id_anggota=$id";
        return $this->execute($query);
    }

    function searchTeam($keyword)
    {
        $query = "SELECT * FROM team JOIN project ON team.id_project=project.id_project JOIN jobdesc ON team.id_jobdesc=jobdesc.id_jobdesc WHERE team.nama_anggota LIKE '%$keyword%'";
        return $this->execute($query);
    }

    function addData($data, $file)
    {
        $nama_anggota = $data['nama'];
        $id_project = $data['project'];
        $id_jobdesc = $data['jobdesc'];

        $foto_anggota = $file['foto_anggota']['name'];
        $tmp_file = $file['foto_anggota']['tmp_name'];
        
        $path = "assets/images/$foto_anggota";
        move_uploaded_file($tmp_file, $path);

        $query = "INSERT INTO team VALUES('', '$foto_anggota', '$nama_anggota', '$id_project', '$id_jobdesc')";
        
        return $this->executeAffected($query);
    }

    function updateData($id, $data, $file)
    {
        $nama_anggota = $data['nama'];
        $id_project = $data['project'];
        $id_jobdesc = $data['jobdesc'];

        $foto_anggota = $file['foto_anggota']['name'];
        $tmp_file = $file['foto_anggota']['tmp_name'];
        $path = "assets/images/$foto_anggota";
        move_uploaded_file($tmp_file, $path);

        $query = "UPDATE team SET nama_anggota = '$nama_anggota', id_project = '$id_project', id_jobdesc = '$id_jobdesc', foto_anggota = '$foto_anggota' WHERE id_anggota = '$id'";
        
        return $this->executeAffected($query);
    }

    function deleteData($id)
    {
        $query = "DELETE FROM team WHERE id_anggota = '$id'";
        return $this->executeAffected($query);
    }

    function sorting($sort)
    {
        $query = "SELECT * FROM team
              JOIN project ON team.id_project=project.id_project
              JOIN jobdesc ON team.id_jobdesc=jobdesc.id_jobdesc
              ORDER BY $sort";
        return $this->execute($query);
    }
}

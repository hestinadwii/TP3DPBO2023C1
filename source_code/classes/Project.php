<?php

class Project extends DB
{
    function getProject()
    {
        $query = "SELECT * FROM project";
        return $this->execute($query);
    }

    function getProjectById($id)
    {
        $query = "SELECT * FROM project WHERE id_project=$id";
        return $this->execute($query);
    }

    function searchProject($keyword)
    {
        $query = "SELECT * FROM project WHERE nama_project LIKE '%$keyword%'";
        return $this->execute($query);
    }

    function addProject($data)
    {
        $nama_project = $data['nama'];
        $query = "INSERT INTO project VALUES('', '$nama_project')";
        return $this->executeAffected($query);
    }

    function updateProject($id, $data)
    {
        $nama_project = $data['nama'];
        $query = "UPDATE project SET nama_project = '$nama_project' WHERE id_project = '$id'";
        return $this->executeAffected($query);
    }

    function deleteProject($id)
    {
        $query = "DELETE FROM project WHERE id_project = '$id'";
        return $this->executeAffected($query);
    }
}

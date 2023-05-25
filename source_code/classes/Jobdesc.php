<?php

class Jobdesc extends DB
{
    function getJobdesc()
    {
        $query = "SELECT * FROM jobdesc";
        $result = $this->execute($query);
        if ($result && mysqli_num_rows($result) > 0) {
            return mysqli_fetch_all($result, MYSQLI_NUM);
        }
        
        return array(); // Mengembalikan array kosong jika tidak ada hasil
    }

    function getJobdescById($id)
    {
        $query = "SELECT * FROM jobdesc WHERE id_jobdesc=$id";
        $result = $this->execute($query);
        
        if ($result && mysqli_num_rows($result) > 0) {
            return mysqli_fetch_array($result, MYSQLI_NUM);
        }
        
        return null; // Mengembalikan null jika tidak ada hasil
    }

    function searchJobdesc($keyword)
    {
        $query = "SELECT * FROM jobdesc WHERE nama_jobdesc LIKE '%$keyword%'";
        return $this->execute($query);
    }

    function addJobdesc($data)
    {
        // ...
        $nama_jobdesc = $data['nama'];
        $query = "INSERT INTO jobdesc VALUES('', '$nama_jobdesc')";
        return $this->executeAffected($query);
    }

    
    function updateJobdesc($id, $data)
    {
        $nama_jobdesc = $data['nama'];
        $query = "UPDATE jobdesc SET nama_jobdesc = '$nama_jobdesc' WHERE id_jobdesc = '$id'";
        return $this->executeAffected($query);
    }

    function deleteJobdesc($id)
    {
        $query = "DELETE FROM jobdesc WHERE id_jobdesc = '$id'";
        return $this->executeAffected($query);
    }
}

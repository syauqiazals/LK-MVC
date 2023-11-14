<?php

class daftarBarang extends model{
    private $daftar = [];

    public function getDataAll(){
        //return $this->daftar;
        $data = [];
        $stmt = "select * from daftarbarang";
        $query = $this->db->query($stmt);

        while ($result = $this->db->fetch_array($query)){
            $data[] = $result;
        }
        return $data;
    }

    public function getDataById($id){
        //return $this->daftar;
        $data = [];
        $stmt = "select * from daftarbarang where id = $id";
        $query = $this->db->query($stmt);
        $data = $this->db->query($stmt);

        return $data;
    }

    public function tambahBarang($param){
        $stmt = "insert into daftarBarang (nama, qty) values (:nama, :qty)";
        $query = $this->db->query($stmt, $param);
        if ($this->db->last_id()>0){
            return true;
        }
        else {
            return false;
        }
    }

    public function updateBarang($param){
        $stmt = "update daftarbarang set nama = :nama, qty = :qty where id = :id";
        $query = $this->db->query($stmt, $param);
        if ($query->rowCount()>0){
            return true;
        }
        else {
            return false;
        }
    }

    public function hapusBarang($id){
        $stmt = "delete from daftarbarang where id = $id";
        $query = $this->db->query($stmt);
        if ($query->rowCount()>0){
            return true;
        }
        else {
            return false;
        }
    }
}
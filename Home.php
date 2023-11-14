<?php


class Home extends controller{

    private $dt;
    private $df;

    public function __construct(){
        $this->dt = $this->loadmodel("barang"); // objek dr kelas barang
        $this->df = $this->loadmodel("daftarBarang");
    }
    public function index(){
        echo "anda memanggil action index \n";
    }

    public function home($data1, $data2){
        echo "anda memanggil action home dengan data 1 = $data1 dan data 2 = $data2 \n";
    }

    public function lihatData($id){
        $data =  $this->df->getDataById($id);

        $this->loadview('templates/header', ['title' => 'detail Barang']);
        $this->loadview('home/detailbarang', $data);
        $this->loadview('templates/footer');
    }

    public function listbarang(){
        $data = $this->df->getDataAll();

        // foreach ($this->df->getDataAll() as $item) {
        //     echo $item['id']. " " . $item['nama']. " ". $item['qty'];
        //     echo "<br />";
        // }
        
        $this->loadview('templates/header', ['title' => 'list Barang']);
        $this->loadview('home/listbarang', $data);
        $this->loadview('templates/footer');
    }

    public function insertBarang(){
        if(!empty($_POST)){
            if($this->df->tambahBarang($_POST)){
                header('Location: '.BASE_URL.'index.php?r=home/listbarang');
                exit;
            }
        }

        $this->loadview('templates/header', ['title' => 'insert Barang']);
        $this->loadview('home/insert');
        $this->loadview('templates/footer'); 
    }

    public function updatebarang($id){
        $data = $this->df->getDataById($id);

        if(!empty($_POST)){
            if($this->df->updateBarang($_POST)){
                header('Location: '.BASE_URL.'index.php?r=home/listbarang');
                exit;
            }
        }

        $this->loadview('templates/header', ['title' => 'Update Barang']);
        $this->loadview('home/update', $data);
        $this->loadview('templates/footer'); 
    }

    public function deletebarang($id){
        $data = $this->df->getDataById($id);
        
            if($this->df->hapusBarang($id)){
                header('Location: '.BASE_URL.'index.php?r=home/listbarang');
                exit;
            }
    }
}
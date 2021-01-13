<?php

$host = "localhost";
$user = "nofrisdan";
$pass = "N03D0600";
$db = "mydb";
$connect = mysqli_connect($host,$user,$pass,$db);

if(mysqli_error($connect)){
    echo "database tidak tersambung";
}

function query($query){
    global $connect;
    $result = mysqli_query($connect,$query);
    $rows = [];
    while($row = mysqli_fetch_assoc($result)){
        $rows[] = $row;
    }
    return $rows;
}

function input($data){
    global $connect;
    $nama = $data['nama_satwa'];
    $makanan = $data['makanan'];
    $jenis = $data['jenis_hewan'];

    $gambar = upload();

    $query = "INSERT INTO hewan VALUES(null,'$nama','$makanan','$jenis','$gambar')";
    mysqli_query($connect,$query);

    return mysqli_affected_rows($connect);

}

function delete($id){
    global $connect;

    $query = "DELETE FROM hewan WHERE id=$id";
    mysqli_query($connect,$query);

    return mysqli_affected_rows($connect);

}
function update($data){
    global $connect;
    $id = $data["id"];
    $nama = $data["nama_satwa"];
    $makanan = $data["makanan"];
    $jenis = $data["jenis_hewan"];
    $gambarlama = $data["gambarlama"];

    if($_FILES['gambar']['error']=== 4){
        $gambar = $gambarlama;
    }else{
        $gambar = update();
    }
    $query = "UPDATE hewan SET 
                nama_hewan = '$nama',
                makanan = '$makanan',
                jenis_hewan = '$jenis',
                gambar= '$gambar'
                WHERE id = $id
                ";
    mysqli_query($connect,$query);   

    return mysqli_affected_rows($connect);
}

function upload(){
    $namaFile = $_FILES['gambar']['name'];
    $ukuranFile = $_FILES['gambar']['size'];
    $error = $_FILES['gambar']['error'];
    $tmpName = $_FILES['gambar']['tmp_name'];//directory penyimpanan gambar

    //cek apakah ada gambar yang di upload
    if( $error === 4){
        echo "<script>alert('Pilih gambar terlebih dahulu')</script>";
        return false;
    }

    //cek apakah yang diupload adalah gambar
    $ekstensiGambarValid = ["jpg","jpeg","png","pdf"]; //pastikan ekstensi gambar ditentukan karna jikalau tidak ditentukan maka sangat bahaya jikalau user mengupload sebuah script
    $ekstensi = explode('.',$namaFile); // memecah string menjadi array cth : nofrisdan.jpg -> ["nofrisdan","jpg"]
    $ekstensiGambar = strtolower(end($ekstensi));

    //CEK APAKAH FILE YANG DI UPLOAD SESUAI DENGAN YANG DITENTUKAN
    if( !in_array($ekstensiGambar,$ekstensiGambarValid)){ //in_array mencari data string di dalam array
        echo "<script>alert('File yang Anda Upload Tidak sesuai')</script>";
        return false;
    }

    //cek jika gambar yang diupload ukurannya terlalu besar
    if($ukuranFile > 5000000){ //20 000 000 = 20mb
        echo "<script>alert('Ukuran File anda terlalu besar')</script>";
        return false;

    }

    //jika gambar sudah sesuai maka, siap untuk di upload

    //jika nama file sama pastikan file yang lain tidak berubah
    //generate nama baru file

    // $namaFilebaru = uniqid();//uniqid() salah satu function php yang berfungsi untuk mengubah string menjadi beberapa kumpulan angka random
    // $namaFilebaru .= '.';
    // $namaFilebaru .=$ekstensiGambar;


    move_uploaded_file($tmpName,'img/'.$namaFile); //menyimpan data kedalam folder /var/www/html/database/img/ dengan nama file $namaFile
    
    return $namaFile; //return berfungsi untuk mengambalikan $namaFile ke function upload yang dimana upload = $gambar yang nantinya akan di masukkan ke dalam database dengan nama file    
}




?>
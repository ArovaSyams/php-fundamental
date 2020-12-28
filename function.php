<?php 
    
	//connect ke database urutan (<host>, <userame>, <password>, <database>)
    $conn = mysqli_connect("localhost", "root", "@D4t4b4s3", "phpdasar");

    function query($query) {
    	global $conn;
    	$result = mysqli_query($conn, $query);

    	$rows = [];
        
    	while ($row = mysqli_fetch_assoc($result)) {
    		$rows[] = $row;
    	}
    	return $rows;
    }

    function tambah($data) {

        global $conn;

        $nama = htmlspecialchars($data["nama"]);
        $asal = htmlspecialchars($data["asal"]);
        $sekolah = htmlspecialchars($data["sekolah"]);
        $nomor = htmlspecialchars($data["lemari"]);

        $gambar = upload();
        if (!$gambar) {
            return false;
        }

        $query = "INSERT INTO kamar_11 VALUES (
            '', '$nama', '$asal', '$sekolah', '$nomor', '$gambar'
        );";
    
        mysqli_query($conn, $query);

        return mysqli_affected_rows($conn);
    }


    function hapus($id) {
        global $conn;

        mysqli_query($conn, "DELETE FROM kamar_11 WHERE id=$id");
        return mysqli_affected_rows($conn);
    }

    function ubah($data) {
        global $conn;
        
        $id = $data["id"];
        $nama = htmlspecialchars($data["nama"]);
        $asal = htmlspecialchars($data["asal"]);
        $sekolah = htmlspecialchars($data["sekolah"]);
        $nomor = htmlspecialchars($data["lemari"]);
        $gambarLama = htmlspecialchars($data["gambar"]);

        if ($_FILES['gambar']['error'] === 4) {
            $gambar = $gambarLama;
        }else {
            $gambar = upload();
        }

        $query = "UPDATE kamar_11 SET 
            nama = '$nama', asal = '$asal', sekolah = '$sekolah', nomor_lemari = $nomor, gambar = '$gambar'
            WHERE id = $id
        ";

        mysqli_query($conn, $query);
        return mysqli_affected_rows($conn);
    }

    function cari($keyword) {

        $query = "SELECT * FROM kamar_11 WHERE 
            nama LIKE '%$keyword%' OR
            asal LIKE '%$keyword%' OR
            sekolah LIKE '%$keyword%' OR
            nomor_lemari LIKE '%$keyword%'";

        return query($query);
    }

    function upload() {

        $namaFile = $_FILES['gambar']['name'];
        $ukuranFile = $_FILES['gambar']['size'];
        $error = $_FILES['gambar']['error'];
        $tmpName = $_FILES['gambar']['tmp_name'];

        //cek apakah tidak ada gambar yg diupload
        if ($error === 4) {
            echo "<script>
                    alert('Pilih Gambar Terlebih Dahulu');
                  </script>";
            return false;
        }

        //gambar yang diupload gambar / bukan
        $ekstensiGambarValid = ["jpg", "png", "jpeg"];
        $ekstensiGambar = explode(".", $namaFile);
        $ekstensiGambar = strtolower(end($ekstensiGambar));

        if (!in_array($ekstensiGambar, $ekstensiGambarValid)) {
            echo "<script>
                        alert('Yang anda upload bukan gambar');
                   </script>";
            return false;   
        }

        //membatasi ukuran gambar
        if ($ukuranFile >= 2000000) {
            echo "<script>
                        alert('Yang anda upload bukan gambar');
                   </script>";
            return false;      
        }

        //jika berhasil
        //generate nama gambar menjadi uniq

        $namaFileBaru = uniqid() . "." . $ekstensiGambar;

        move_uploaded_file($tmpName, 'img/'.$namaFileBaru );

        return $namaFileBaru;
    }

    function registrasi($data) {
        global $conn;

        $username = strtolower(stripslashes($data["username"]));
        $password = mysqli_real_escape_string($conn, $data["password"]);
        $password2 = mysqli_real_escape_string($conn, $data["password2"]);

        //cek username sudah ada atau belum
        $result = mysqli_query($conn, "SELECT username FROM user WHERE username = '$username'");

        if (mysqli_fetch_assoc($result)) {
            echo "
            <script>
                alert('Username sudah ada');
            </script>
            ";
            return false;
        }

        //cek konfirmasi password
        if ($password != $password2) {
            echo "
            <script>
                alert('Registrasi Berhasil');
            </script>
            ";
            return false;
        }
        //encripsi password
        $password = password_hash($password, PASSWORD_DEFAULT);

        //tambahkan ke database
        mysqli_query($conn, "INSERT INTO user VALUES('', '$username', '$password')");

        return mysqli_affected_rows($conn);
    }
?>  
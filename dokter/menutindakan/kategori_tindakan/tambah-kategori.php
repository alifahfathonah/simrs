<?php 
session_start();

$_SESSION["judul"] = "Tambah Kategori Tindakan";

if (!isset($_SESSION["login_admin"]))
{
    header("location: ../../../login.php");
    exit();
}
require '../../../koneksi/koneksi.php';

if (isset($_POST["submit"])){
    $kd_kategori = $_POST['kd_kategori'];
    $nama_kategori = $_POST['nama_kategori'];

    mysqli_query($conn, "INSERT INTO tb_kategori_tindakan VALUES ('', '$kd_kategori', '$nama_kategori')");

    if (mysqli_affected_rows($conn) > 0){
        header('location: data-kategori.php?notif=true');
        $_SESSION["notif"] = "Data berhasil ditambahkan";
    }
    else {
        echo "<script>
        alert('Gagal ditambahkan!');
        </script>";
        echo mysqli_error($conn);
        exit();
    }
}

require '../../../template/header.php';
?>

<div class="row">
    <div class="col-12">
        <div class="page-title-box">

            <ol class="breadcrumb float-right">
                <li class="breadcrumb-item"><a href="#">Menu Tindakan</a></li>
                <li class="breadcrumb-item active">Data Tindakan</li>
                <li class="breadcrumb-item active">Tambah Kategori Tindakan</li>
            </ol>

            <div class="clearfix"></div>
        </div>
    </div>
</div>
<!-- end row -->


<div class="row">
    <div class="col-12">
        <div class="card-box">
            <h4 class="m-t-0 header-title">Tambah Kategori Tindakan</h4><br>

            <div class="row">
                <div class="col-12">
                    <div class="p-20">
                        <form class="form-horizontal" role="form" method="POST">
                            <div class="form-group row">
                                <label class="col-3 col-form-label">Kode Kategori</label>
                                <div class="col-9">
                                    <input type="text" class="form-control" value="" name="kd_kategori">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-3 col-form-label">Nama Kategori</label>
                                <div class="col-9">
                                    <input type="text" class="form-control" value="" name="nama_kategori">
                                </div>
                            </div>

                            <button type="submit" name="submit" class="btn btn-gradient waves-light waves-effect w-md"><i class="fa fa-save"></i>&nbsp&nbspSimpan</button>

                            <a href="data-kategori.php" role="button" class="btn btn-danger waves-light waves-effect w-md"><i class="fa fa-times-circle"></i>&nbsp&nbsp Batal</a> <br> <br>

                        </form>
                    </div>
                </div>

            </div>
            <!-- end row -->

        </div> <!-- end card-box -->
    </div><!-- end col -->
</div>

<?php require '../../../template/footer.php'; ?>
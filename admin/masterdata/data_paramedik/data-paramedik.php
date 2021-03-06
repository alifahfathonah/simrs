<?php 
session_start();

$_SESSION["judul"] = "Data Paramedik";

if (!isset($_SESSION["login_admin"]))
{
    header("location: ../../../login.php");
    exit();
}
require '../../../koneksi/koneksi.php';
$data = mysqli_query($conn, "SELECT * FROM tb_paramedik");

if (isset($_POST["hapus"])) {
    $id = $_POST["id"];

    mysqli_query($conn,"DELETE FROM tb_paramedik WHERE id=$id");
    if (mysqli_affected_rows($conn)>0){
        echo "<script>
        alert('Data paramedik berhasil dihapus!');
        document.location.href='data-paramedik.php';
        </script>";

    }
    else {
        echo "<script>
        alert('Terjadi Kesalahan');
        </script>";
        echo mysqli_error($conn);
    }
}

require '../../../template/header.php';
?>

<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <ol class="breadcrumb float-right">
                <li class="breadcrumb-item"><a href="#">Master Data</a></li>
                <li class="breadcrumb-item active">Data Paramedik</li>
            </ol>

            <div class="clearfix"></div>
        </div>
    </div>
</div>
<!-- end row -->

<div class="row">
    <div class="col-12">
        <div class="card-box table-responsive">
            <h4 class="m-t-0 header-title"><b>Data Paramedik</b></h4><br>
            <a href="tambah-paramedik.php" role="button" class="btn btn-gradient waves-light waves-effect w-md"><i class="fa fa-plus-square"></i>&nbsp Tambah Paramedik</a><br><br>

            <table id="datatable" class="table table-bordered">
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Spesialis</th>
                        <th>No Telepon</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>


                <tbody>
                    <?php foreach ($data as $dta) : ?>
                        <tr>
                            <td><?= $dta["nama"]?></td>
                            <td><?= $dta["spesialis"]?></td>
                            <td><?= $dta["telepon"]?></td>
                            <td><?= $dta["status"]?></td>
                            <td class="text-center">
                                <a href="edit-paramedik.php?id=<?= $dta["id"] ?>" class="btn btn-gradient waves-light waves-effect"><i class="mdi mdi-table-edit"></i>&nbsp Edit</a>

                                <button class="btn btn-danger waves-light waves-effect" type="button" data-toggle="modal" data-target="#staticModal<?= $dta['id'] ?>"><i class="mdi mdi-delete"></i>&nbsp Hapus</button>
                            </td>
                        </tr>

                        <!-- Konfirmasi Hapus -->
                        <div class="modal fade" id="staticModal<?= $dta['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="staticModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-sm" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="staticModalLabel">Hapus Data</h5>
                                    </div>
                                    <div class="modal-body">
                                        <p>Yakin ingin menghapus data ini?</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                        <form method="POST">
                                         <input type="hidden" name="id" value="<?= $dta["id"]?>">
                                         <button type="submit" name="hapus" class="btn btn-danger">Hapus</button>
                                     </form>
                                 </div>
                             </div>
                         </div>
                     </div>
                     <!-- End Konfirmasi Hapus -->

                 <?php endforeach; ?>
             </tbody>
         </table>
     </div>
 </div>
</div>

<?php require '../../../template/footer.php'; ?>
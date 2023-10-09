<?= $this->extend('layouts/app') ?>

<?= $this->section('content') ?>

<nav class="navbar bg-light">
    <!-- Navbar -->
    <div class="container-fluid">
        <a href="<?= base_url('user/create') ?>">
        Tambah Data 
    </a>
</div>
</nav>

<div class="container">
    <figure>
        <h1>College Student Data</h1>
            <blockquote class="blockquote">
                <p>Data Mahasiswa yang terdapat pada database</p>
            </blockquote>
    </figure>
    
    <!-- Tabel -->
    <table class="table">
        <thead class="table-dark">
            <tr>
                <th class="col justify-content-center text-center">ID</th>
                <th class="col justify-content-center text-center">Nama</th>
                <th class="col justify-content-center text-center">NPM</th>
                <th class="col justify-content-center text-center">Kelas</th>
                <th class="col justify-content-center text-center" style="width: 220px;">Aksi</th>
            </tr>
        </thead>
            <tbody>
                <?php 
                    foreach($user as $user){
                ?>
                    <tr>
                        <td class="col justify-content-center text-center"><?= $user['id'] ?></td>
                        <td class="col justify-content-center"><?= $user['nama'] ?></td>
                        <td class="col justify-content-center text-center"><?= $user['npm'] ?></td>
                        <td class="col justify-content-center text-center"><?= $user['nama_kelas'] ?></td>
                        <td class="col justify-content-center text-center">
                            <a href="<?= base_url('user/' . $user['id']) ?>">Detail</a>
                            <button type="button">Edit</button>
                            <button type="button">Delete</button>
                        </td>
                    </tr>
                <?php
                }
                ?>
            </tbody>        
    </table>
</div>
<?= $this->endSection() ?>
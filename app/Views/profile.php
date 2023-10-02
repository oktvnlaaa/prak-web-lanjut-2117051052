<?= $this->extend('layouts/app') ?>
<?= $this->section('content') ?>

    <center>
    </center>

    <center>
      <div class="container">
      <img src ="
    <?php
        echo base_url('./img/yola.jpg') ;
    ?>">
      <div class="item" >
            <?= $nama?>
</div>
<div class="item">
            <?= $kelas?>
</div>
<div class="item">
            <?= $npm?>
</div>

</div>
</center>

<?= $this->endSection() ?>
<?= $this->extend('/layouts/main_layout') ?>

<?= $this->section('content') ?>

<h3 class="title-page"> Meu Perfil</h3>

<div class="container" style="margin: 4% auto;">
  <div class="row">
    <div class="col-md-4 img">
      <img src="<?= base_url('public/' . $userData['img_path']) ?>" alt="profile image" class="rounded-circle" width="190" height="190">
    </div>
    <div class="col-md-8 details">
      <blockquote>
        <h5><?= htmlspecialchars($userData['nome']) ?></h5>
      </blockquote>
      <p>
        <?= $userData['email'] ?> <br>

      </p>

      <p>
        Cadastrado em <?= formatDate($userData['dt_cadastro']) ?> <br>

      </p>
      <div style="margin-top: 200px;">
        <a name="btedit" class="btn btn-success" href="<?= base_url('/profile/edit/') ?>" > Editar Meu Perfil</a>
        <a name="btdel"  class="btn btn-primary" href="<?= base_url('/profile/chpassword') ?>"> Mudar minha senha </a>
        <a name="btdel"  class="btn btn-danger" href="<?= base_url('/profile/remove/') ?>"><i class="fa-solid fa-circle-minus"></i> Apagar minha conta </a>
      </div>
      
    </div>
  </div>
</div>


<?= $this->endSection() ?>
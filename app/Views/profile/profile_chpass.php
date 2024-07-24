<?= $this->extend('/layouts/main_layout') ?>

<?= $this->section('content') ?>


<h3 class="title-page"> Alterar senha</h3>
<hr>
<?php  if (isset($errors)) { ?>

<div class="alert alert-danger mt-10 mb-5">
        <ul>
        <?php foreach ($errors as $error): ?>
            <li><?= esc($error) ?></li>
        <?php endforeach ?>
        </ul>
</div>
<?php } ?>


<?php  if (isset($msg)) { ?>

<div class="alert alert-success alert-box">
     <h3 class="title-page"><?= $msg ?></h3>
</div>
<?php } ?>


<?php  if (isset($err_msg)) { ?>

<div class="alert alert-danger mt-10">
     <h3 class="title-page"><?= $err_msg ?></h3>
</div>
<?php } ?>

<div class="container col-4">

    <?= form_open('profile/updatepassword',  ['class' => 'pull_right']) ?>

    <div class="form-group">
        <label for="name">Digite sua nova senha:</label>
        <input type="password" class="form-control" name="password" placeholder="Digite sua nova senha" required>
    </div>
    <div class="form-group">
        <label for="email">Repita sua nova senha:</label>
        <input type="password"  class="form-control" name="passconf" placeholder="Repita sua nova senha para confirmar" required>
    </div>

    <div class="form-group">
      <button name="save" type="save" class="btn btn-success"><i class="fa-regular fa-floppy-disk"></i> Salvar</button>
      <a href="<?= base_url('/profile/show')?>" class="btn btn-danger"><i class="fa-sharp fa-solid fa-backward"></i> Voltar</a>
    
  </div>

    </form>

</div>


<?= $this->endSection() ?>
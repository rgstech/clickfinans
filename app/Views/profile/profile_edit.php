<?= $this->extend('/layouts/main_layout') ?>

<?= $this->section('content') ?>


<h3 class="title-page"> Editar Perfil</h3>
<hr>
<?php  if (isset($errors)) { ?>

<div class="alert">
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

<div class="container col-4">

    <?= form_open('profile/update',  ['class' => 'pull_right']) ?>

    <div class="form-group">
        <label for="name">Nome:</label>
        <input type="text" class="form-control"  name="nome" id="nome" value="<?= $userData['nome'] ?>" required placeholder="Digite seu nome.." >
    </div>
    <div class="form-group">
        <label for="email">Email:</label>
        <input type="email" class="form-control" name="email" id="email"  value="<?= $userData['email'] ?>" required placeholder="Digite seu email...">
    </div>

    <div class="form-group">
      <button name="save" type="save" class="btn btn-success"><i class="fa-regular fa-floppy-disk"></i> Salvar</button>
      <a href="<?= base_url('/profile/show')?>" class="btn btn-danger"><i class="fa-sharp fa-solid fa-backward"></i> Voltar</a>
    
  </div>

    </form>

</div>


<?= $this->endSection() ?>
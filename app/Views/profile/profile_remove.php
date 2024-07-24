<?= $this->extend('/layouts/main_layout') ?>

<?= $this->section('content') ?>


<h3 class="title-page"> Digite seu e-mail e senha para confirmar o cancelamento da sua conta</h3>
<hr>
<div class="container col-4">

    <?= form_open('profile/delete',  ['class' => 'pull_right']) ?>

    <div class="form-group">
        <label for="email">Email:</label>
        <input type="email" name="email" class="form-control" placeholder="Digite seu email..." id="email">
    </div>
    
    <div class="form-group">
        <label for="password">Senha:</label>
        <input type="password"  name="password" class="form-control" placeholder="Digite sua senha..." id="password">
    </div>

    <div class="form-group">
        <button type="submit" class="btn btn-danger">Confirmar e APAGAR minha conta definitivamente</button>
    </div>

    <div class="form-group">
    <a href="<?= base_url('/profile/show')?>" class="btn btn-primary"><i class="fa-sharp fa-solid fa-backward"></i> Voltar</a>

    </div>


    </form>
 
</div>


<?= $this->endSection() ?>
<?= $this->extend('/layouts/main_layout') ?>

<?= $this->section('content') ?>



<div class="container mt-10">
     <div class="alert alert-danger mt-10">
          <strong>Erro!</strong> Erro ao Salvar dados.
     </div>
     <hr>
     <?php echo anchor('/expense/all', 'Voltar para pagina anterior'); ?>
</div>



<?= $this->endSection() ?>
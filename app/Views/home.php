<?= $this->extend('/layouts/main_layout') ?>

<?= $this->section('content') ?>



<div class="container-fluid">
   <div class="painel">
      <div class="painel-card painel-card-day">
         <h4>Despesas:</h4>
         <h5><?= formatMoney($daybalance) ?></h5>
         <hr>
         <h6>Hoje</h6>
      </div>
      <div class="painel-card  painel-card-week">
         <h4>Despesas:</h4>
         <h5><?= formatMoney($weekbalance) ?></h5>
         <hr>
         <h6>Esta semana</h6>
      </div>
      <div class="painel-card painel-card-month">
         <h4>Despesas:</h4>
         <h5> <?= formatMoney($monthbalance) ?></h5>
         <hr>
         <h6>Este mês</h6>
      </div>

      <!-- <div class="painel-card-bottom">
         <h4>Mural de Mensagens:</h4>
         <hr>
         <p> dia de lançamentos</p>
         
         <h6></h6>
      </div> -->
   </div>
</div>



<?= $this->endSection() ?>
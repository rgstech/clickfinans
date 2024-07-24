<?= $this->extend('/layouts/main_layout') ?>

<?= $this->section('content') ?>


<h3 class="title-page"><?=  isset($vexpense) ?  "Editar Despesa" : "Adicionar nova despesa" ?></h3>
<hr>
 <div class="container">

     <?php if (isset($vexpense)) {

            echo form_open('/expense/save/'. $vexpense['id'],  ['class' => 'pull_right']); 
            
        }  else {
          
           echo form_open('/expense/save',  ['class' => 'pull_right']); 

       } ?>

    <?php  if (isset($vexpense)) { ?>

          <input type="hidden" name="eid" value="<?php echo $vexpense['id'] ?>" />
          <input type="hidden" name="uid" value="<?php echo $vexpense['usuario_fk']  ?>" /> 

    <?php } else { ?> 

          <input type="hidden" name="uid" value="<?php echo session()->get('id'); ?>" />
          
    <?php }?>
      
 
  <div class="form-group row">
    <label for="descricao" class="col-4 col-form-label">Descrição</label> 
    <div class="col-4">
      <input id="descricao" name="descricao" type="text" class="form-control" required value="<?= isset($vexpense['descricao']) ? $vexpense['descricao'] : ''?>">
    </div>
  </div>
  <div class="form-group row">
    <label for="vcurrency" class="col-4 col-form-label">Valor</label> 
    <div class="col-4">
      <input id="vcurrency" name="valor" type="text"  class="form-control vcurrency" required value="<?= isset($vexpense['valor']) ? substr(formatMoney($vexpense['valor']), 3) : '' ?>">
    </div>
  </div>
  <div class="form-group row">
    <label for="data" class="col-4 col-form-label">Data da Despesa</label> 
    <div class="col-4">
      <input id="data" name="data" type="date" class="form-control" required value="<?= isset($vexpense['dt_despesa']) ? $vexpense['dt_despesa'] : ''?>">
    </div>
  </div>
  <div class="form-group row">
    <label for="category" class="col-4 col-form-label">Categoria</label> 
    <div class="col-4">
      <select id="category" name="category" class="custom-select">
     
        <?php if($vcategory) { foreach ($vcategory as $category) { ?>


          <?php  if (isset($vexpense)) { ?>

          <option value="<?= $category['id'] ?>" 
             <?= $vexpense['categoria_fk'] == $category['id'] ? 'selected' : '' ?> > 

                    <?= $category['descricao']?> 
                    
            </option>

         <?php }  else { ?>
          
          <option value="<?= $category['id'] ?>"> 
                    <?= $category['descricao']?> 
          </option>
              
          <?php }?>

        <?php } }?>

      </select>
    </div>
  </div>
  <div class="form-group row">
    <div class="offset-4 col-6">
      <button name="save" type="save" class="btn btn-primary"><i class="fa-regular fa-floppy-disk"></i> Salvar</button>
      <a href="<?= base_url('/expense/all')?>" class="btn btn-danger"><i class="fa-sharp fa-solid fa-backward"></i> Voltar</a>
    </div>
  </div>


 <?php echo form_close() ?> 

 </div>   
        
<?= $this->endSection() ?>  
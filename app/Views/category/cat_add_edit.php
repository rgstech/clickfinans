<?= $this->extend('/layouts/main_layout') ?>

<?= $this->section('content') ?>


<h3 class="title-page"><?=  isset($vcategory) ?  "Editar Categoria" : "Adicionar nova categoria" ?></h3>
<hr>
 <div class="container">

 <?php 
        if (isset($vcategory)) {

            echo form_open('/category/save/'. $vcategory['id'],  ['class' => 'pull_right']); 
            
        }  else {
          
            echo form_open('/category/save',  ['class' => 'pull_right']); 

       } ?>

    <?php  if (isset($vcategory)) { ?>

          <input type="hidden" name="cid" value="<?php echo $vcategory['id'] ?>" />
          <input type="hidden" name="uid" value="<?php echo $vcategory['cat_usuario_fk']  ?>" /> 

    <?php } else { ?> 

          <input type="hidden" name="uid" value="<?php echo session()->get('id'); ?>" />
          
    <?php }?>
      
 
  <div class="form-group row">
    <label for="descricao" class="col-4 col-form-label">Descrição</label> 
    <div class="col-4">
      <input id="descricao" name="descricao" type="text" class="form-control" required value="<?= isset($vcategory['descricao']) ? $vcategory['descricao'] : ''?>">
    </div>
  </div>
  <div class="form-group row">
    <div class="offset-4 col-6">
      <button name="save" type="save" class="btn btn-primary"><i class="fa-regular fa-floppy-disk"></i> Salvar</button>
      <a href="<?= base_url('/category/all')?>" class="btn btn-danger"><i class="fa-sharp fa-solid fa-backward"></i> Voltar</a>
    </div>
  </div>


 <?php echo form_close() ?> 

 </div>   
        
<?= $this->endSection() ?>  
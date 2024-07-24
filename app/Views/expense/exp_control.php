<?= $this->extend('/layouts/main_layout') ?>

<?= $this->section('content') ?>


<div class="container-fluid mt-5">
    <div class="row">
        <div class="col-md-12">
        <div class="table-responsive">
        <a name="btadd" class="btn btn-success mb-2" href="<?= base_url('/expense/new') ?>"><i class="fa-regular fa-square-plus"></i> Adicionar Despesa</a>
        
        <!--  inicio formulario de filtro / start filter form -->
        <form action="<?php echo base_url('/expense/all') ?>" method="get">
            <div class="form-group form-row ml-3 mt-5 mb-5">
                    <label for="data" class="mr-2">De: </label> 
                    <input id="sdata" name="dt_start" type="date" value="<?php echo $arsearch['dt_start'] ?? ""; ?>" class="form-control col-3">
                    <label for="data" class="ml-2 mr-2">Até: </label> 
                    <input id="edata" name="dt_end" type="date"  value="<?php echo $arsearch['dt_end'] ?? ""; ?>"class="form-control col-3">
                    <label for="data" class="ml-2 mr-2">Categoria: </label> 


                    <select id="category" name="category" class="custom-select"  style="width: 200px">
                              <option value="" selected disabled hidden>Escolha categoria</option>
                            <?php if(isset($vcategory)) { foreach ($vcategory as $category) { ?>

                                <option value="<?= $category['id'] ?>"
                                <?= (isset($arsearch['category']) && $arsearch['category'] == $category['id'])  ? 'selected' : '' ?> > 

                                               <?= $category['descricao']?> 
                                </option>
                                
                            <?php } }?>
                      </select>


                    <button style="margin-right: 5px;"class="btn btn-primary" type="submit">Filtrar</button>
            </div>
         </form>
      <!--  fim formulario de filtro / end filter form -->

        <table id="exptable" class="table table-sm">
                <thead class="thead-dark">
                    <tr id="tabhead">
                        <th>Descrição</th>
                        <th>Valor</th>    
                        <th>Data</th>
                        <th>Categoria</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody id="expregs">
                <?php if($vexpenses) { foreach ($vexpenses as $expense) { ?>

                     <tr>
                         <td><?= esc($expense["descricao"]) ?></td>
                         <td><?= formatMoney($expense["valor"]) ?></td>
                         <td><?= formatDate($expense["dt_despesa"]) ?></td>
                         <td><?= esc($expense["categoria"] ? $expense["categoria"] : "sem categoria") ?></td>
                         <td>
                            <div style="display:flex; flex-wrap: wrap; gap: 5px;">
                                <a name="btedit" class="btn btn-success" href="<?= base_url('/expense/edit/'.$expense["desp_id"]) ?>" ><i class="fa-regular fa-pen-to-square"></i> Editar</a>
                                <a name="btdel" class="btn btn-danger" onclick="confirmDelete(event)" href="<?= base_url('/expense/delete/'.$expense["desp_id"]) ?>"><i class="fa-solid fa-circle-minus"></i> Excluir</a>
                            </div>
                         </td>
                      </tr>
                
                 <?php } }  else {?>

                    <div class="alert alert-info">
                       <strong>Opa!</strong> Ainda não há depesas lançadas aqui.
                    </div>

                    <?php }?>
                </tbody>
        </table>
            <hr>
            <?php echo $pager->links(); ?>
          </div>
        </div>
    </div>
</div>

<script>

    function confirmDelete(e) {

        e.preventDefault();
       
        let vres = confirm("Tem certeza que deseja apagar o registro");

        if (vres) {

             window.location.href = e.target.href;

        } else {
            
             return false;
             
        }
         
    }

</script>

<?= $this->endSection() ?>
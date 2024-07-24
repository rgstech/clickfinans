<?= $this->extend('/layouts/main_layout') ?>

<?= $this->section('content') ?>


<div class="container col-md-12 mt-5">
    <div class="row">
        <div class="col-md-6">
        <div class="table-responsive table-sm">
        <a name="btadd" class="btn btn-success mb-2" href="<?= base_url('/category/new') ?>"><i class="fa-regular fa-square-plus"></i> Adicionar Categoria</a>
            <table id="exptable" class="table">
                <thead class="thead-dark">
                    <tr id="tabhead">
                        <th>Descrição</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody id="expregs">
                <?php if($vcategories) { foreach ($vcategories as $category) { ?>

                     <tr>
                         <td><?= esc($category["descricao"]) ?></td>
                         <td>
                            <div style="display:flex; flex-wrap: wrap; gap: 5px;">
                                <a name="btedit" class="btn btn-success" href="<?= base_url('/category/edit/'.$category["id"]) ?>" ><i class="fa-regular fa-pen-to-square"></i> Editar</a>
                                <a name="btdel" class="btn btn-danger" onclick="confirmDelete(event)" href="<?= base_url('/category/delete/'.$category["id"]) ?>"><i class="fa-solid fa-circle-minus"></i> Excluir</a>
                            </div>
                         </td>
                      </tr>
                
                 <?php } }  else {?>

                    <div class="alert alert-info">
                       <strong>Opa!</strong> Ainda não há categorias cadastradas.
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
       
        let vres = confirm("Tem certeza que deseja apagar este registro");

        if (vres) {

             window.location.href = e.target.href;

        } else {
            
             return false;
             
        }
         
    }

</script>

<?= $this->endSection() ?>
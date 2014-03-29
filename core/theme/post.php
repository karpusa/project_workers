<h1>Должности</h1>
<p>
    <a href="post/add/" type="button" class="btn btn-primary btn-lg">Добавить должность</a>
</p>
<?php if (isset($data['error']['message'])){ ?>
    <div class="alert alert-danger"><?php echo $data['error']['message'];?></div>
<?php }?>
<?php if ($data['result']){ ?>
    <table class="table table-striped">
        <tr><th>Должность</th><th>Описание</th><th></th></tr>
        <?php foreach ($data['result'] as $i=>$item) {?>
            <tr>
                <td><?php echo htmlspecialchars($item['name']);?></td>
                <td><?php echo htmlspecialchars($item['description']);?></td>
                <td class="text-right"><a href="post/edit?id=<?php echo $item['id']?>" class="btn btn-default btn-sm"><span class="glyphicon glyphicon-edit"></span></a> <a href="post?delete=1&id=<?php echo $item['id']?>" class="btn btn-default btn-sm"><span class="glyphicon glyphicon-remove"></span></a></td>
            </tr>
        <?php } ?>
    </table>        
<?php } ?>

<h1>Работники</h1>
<p>
    <a href="staff/add/" type="button" class="btn btn-primary btn-lg">Добавить работника</a>
</p>
<?php if ($data['result']){ ?>
    <table class="table table-striped">
        <tr><th><a href="staff/?sort=<?php echo $this->formAscDesc('name') ?>&field=name">Имя</a></th><th><a href="staff/?sort=<?php echo $this->formAscDesc('surname') ?>&field=surname">Фамилия</a></th><th><a href="staff/?sort=<?php echo $this->formAscDesc('post_name') ?>&field=post_name">Должность</a></th><th><a href="staff/?sort=<?php echo $this->formAscDesc('salary') ?>&field=salary">Зарплата</a></th><th></th></tr>
        <?php foreach ($data['result'] as $i=>$item) {?>
            <tr>
                <td><?php echo $item['name'];?></td>
                <td><?php echo htmlspecialchars($item['surname']);?></td>
                <td><?php echo htmlspecialchars($item['post_name']);?></td>
                <td><?php echo ($item['salary'])?$item['salary'].' EUR':'—';?></td>                
                <td class="text-right"><a href="staff/edit?id=<?php echo $item['id']?>" class="btn btn-default btn-sm"><span class="glyphicon glyphicon-edit"></span></a> <a href="staff?delete=1&id=<?php echo $item['id']?>" class="btn btn-default btn-sm"><span class="glyphicon glyphicon-remove"></span></a></td>
            </tr>
        <?php } ?>
    </table>        
<?php } ?>

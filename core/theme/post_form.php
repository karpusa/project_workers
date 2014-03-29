<h1><?php echo (isset($data['edit'])?'Изменить должность':'Добавить должность')?></h1>
<form class="form-horizontal" role="form" method="post">
  <input type="hidden" name="post_form" value="1"/>    
  <?php if (isset($data['edit'])){?>
    <input type="hidden" name="id" value="<?php echo $data['result']['id']; ?>"/>
  <?php }?>
  <div class="form-group<?php echo($this->isErrorField('name')?' has-error':'') ?>">
    <label for="fname" class="col-sm-2 control-label">Название</label>
    <div class="col-sm-5">
        <input type="text" class="form-control" name="name" value="<?php echo $this->formPost('name',isset($data['result']['name'])?$data['result']['name']:''); ?>" id="fname" placeholder="Название"/>
    </div>
    <?php echo($this->isErrorField('name')?' <span class="help-block">'.$this->isErrorField('name').'</span>':'') ?>
  </div>
  <div class="form-group">
    <label for="fdescription" class="col-sm-2 control-label">Описание</label>
    <div class="col-sm-5">
      <input type="text" class="form-control" name="description" value="<?php echo $this->formPost('description',isset($data['result']['description'])?$data['result']['description']:''); ?>" id="fdescription" placeholder="Описание"/>
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-5">
      <button type="submit" class="btn btn-default"><?php echo (isset($data['edit'])?'Изменить':'Добавить')?></button>
    </div>
  </div>
</form>


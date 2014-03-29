<h1><?php echo (isset($data['edit'])?'Изменить работника':'Добавить работника')?></h1>
<form class="form-horizontal" role="form" method="post" id="staff_form">
  <input type="hidden" name="staff_form" value="1"/>     
  <?php if (isset($data['edit'])){?>
    <input type="hidden" name="id" value="<?php echo $data['result']['id']; ?>"/>
  <?php }?>
  <div class="form-group<?php echo($this->isErrorField('name')?' has-error':'') ?>">
    <label for="fname" class="col-sm-2 control-label">Имя</label>
    <div class="col-sm-5">
        <input type="text" class="form-control required" name="name" value="<?php echo $this->formPost('name',isset($data['result']['name'])?$data['result']['name']:''); ?>" id="fname" placeholder="Имя"/>
    </div>
    <?php echo($this->isErrorField('name')?' <span class="help-block">'.$this->isErrorField('name').'</span>':'') ?>
  </div>
  <div class="form-group<?php echo($this->isErrorField('surname')?' has-error':'') ?>">
    <label for="fsurname" class="col-sm-2 control-label">Фамилия</label>
    <div class="col-sm-5">
        <input type="text" class="form-control required" name="surname" value="<?php echo $this->formPost('surname',isset($data['result']['surname'])?$data['result']['surname']:''); ?>" id="fsurname" placeholder="Фамилия"/>
    </div>
    <?php echo($this->isErrorField('surname')?' <span class="help-block">'.$this->isErrorField('surname').'</span>':'') ?>
  </div>
  <div class="form-group<?php echo($this->isErrorField('post_id')?' has-error':'') ?>">
    <label for="fpost_id" class="col-sm-2 control-label">Должность</label>
    <div class="col-sm-5">
        <select class="form-control required" name="post_id" id="fpost_id">
            <option value="">Пожалуйста, выберите должность</option>            
            <?php foreach($data['post_list'] as $list){ ?>
                <option value="<?php echo $list['id'] ?>"<?php echo ($this->formPost('post_id',isset($data['result']['post_id'])?$data['result']['post_id']:'')==$list['id'])?' selected':''; ?>><?php echo $list['name'] ?></option>
            <?php } ?>
        </select>
    </div>
    <?php echo($this->isErrorField('post_id')?' <span class="help-block">'.$this->isErrorField('post_id').'</span>':'') ?>    
  </div>
  <div class="form-group<?php echo($this->isErrorField('description')?' has-error':'') ?>">
    <label for="description" class="col-sm-2 control-label">Характеристика</label>
    <div class="col-sm-5">
        <textarea class="form-control" name="description" id="fdescription" placeholder="Характеристика"><?php echo $this->formPost('description',isset($data['result']['description'])?$data['result']['description']:''); ?></textarea>
    </div>
    <?php echo($this->isErrorField('description')?' <span class="help-block">'.$this->isErrorField('description').'</span>':'') ?>
  </div>
  <div class="form-group<?php echo($this->isErrorField('salary')?' has-error':'') ?>">
    <label for="fsalary" class="col-sm-2 control-label">Зарплата в Eur</label>
    <div class="col-sm-5">
        <input type="text" class="form-control validateFloat" name="salary" value="<?php echo $this->formPost('salary',isset($data['result']['salary'])?$data['result']['salary']:''); ?>" id="fsalary" placeholder="Зарплата в Ls"/>
    </div>
    <?php echo($this->isErrorField('salary')?' <span class="help-block">'.$this->isErrorField('salary').'</span>':'') ?>
  </div>    
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-5">
      <button type="submit" class="btn btn-default"><?php echo (isset($data['edit'])?'Изменить':'Добавить')?></button>
    </div>
  </div>
</form>
<div class="container users form">
    <div class="row card-panel" style="margin: 2em auto;">
    <?php echo $this->Form->create('User'); ?>
        <?php echo $this->Form->input('email', ['div' => ['class' => 'input-field col s12']]); ?>
        <?php echo $this->Form->input('firstname', ['div' => ['class' => 'input-field col s12']]); ?>
        <?php echo $this->Form->input('lastname', ['div' => ['class' => 'input-field col s12']]); ?>
        <?php echo $this->Form->input('username', ['div' => ['class' => 'input-field col s12']]); ?>
        <?php echo $this->Form->input('password', ['div' => ['class' => 'input-field col s12']]); ?>
        <?php echo $this->Form->input('regdate', ['type' => 'hidden', 'value' => date('Y-m-d H:i:s')]); ?>
        <div class="input-field col s12">
            <?php echo $this->Form->button(__('Add Me'), ['type' => 'submit', 'name' => 'action', 'class' => 'btn waves-effect red lighten-1 center']); ?>
        </div>
    </div>
</div>
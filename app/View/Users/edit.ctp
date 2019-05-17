<div class="container users form">
    <div class="row card-panel" style="margin: 2em auto;">
        <h5><?php echo __('Profile'); ?> </h5><a class="right" href="/users/password">Change password</a>
    <?php echo $this->Form->create('User'); ?>
        <?php echo $this->Form->input('email', ['div' => ['class' => 'input-field col s12']]); ?>
        <?php echo $this->Form->input('firstname', ['div' => ['class' => 'input-field col s12']]); ?>
        <?php echo $this->Form->input('lastname', ['div' => ['class' => 'input-field col s12']]); ?>
        <?php echo $this->Form->input('username', ['div' => ['class' => 'input-field col s12']]); ?>
        <div class="input-field col s12">
            <?php echo $this->Form->button(__('Update Me'), ['type' => 'submit', 'name' => 'action', 'class' => 'btn waves-effect red lighten-1 center']); ?>
        </div>
    </div>
</div>
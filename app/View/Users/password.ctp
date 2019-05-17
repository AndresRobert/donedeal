<div class="container users form">
    <div class="row card-panel" style="margin: 2em auto;">
        <h5><?php echo __('Change Password'); ?></h5>
    <?php echo $this->Form->create('User'); ?>
        <?php echo $this->Form->input('password', ['div' => ['class' => 'input-field col s12']]); ?>
        <div class="input-field col s12">
            <?php echo $this->Form->button(__('Change'), ['type' => 'submit', 'name' => 'action', 'class' => 'btn waves-effect red lighten-1 center']); ?>
        </div>
    </div>
</div>
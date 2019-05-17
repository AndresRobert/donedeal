<div class="container users form">
    <div class="row card-panel" style="margin: 2em auto;">
        <?php echo $this->Flash->render('auth'); ?>
        <?php echo $this->Form->create('User'); ?>
        <?php echo $this->Form->input('username', ['div' => ['class' => 'input-field col s12']]); ?>
        <?php echo $this->Form->input('password', ['div' => ['class' => 'input-field col s12']]); ?>
        <div class="input-field col s12">
            <?php echo $this->Form->button(__('Login'), ['type' => 'submit', 'name' => 'action', 'class' => 'btn waves-effect red lighten-1 center']); ?>
        </div>
    </div>
    <div class="row">
        <div class="col s5 center">
            <a href="/users/add" class="red-text lighten-1 center">Register</a>
        </div>
        <div class="col s2 center">|</div>
        <div class="col s5 center">
            <a href="/users/recover" class="red-text lighten-1 center">Recover</a>
        </div>
    </div>
</div>
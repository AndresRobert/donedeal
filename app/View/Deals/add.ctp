<a class="btn-floating btn-large waves-effect waves-light red lighten-1 float-bottom-right" href="/deals/"><i class="material-icons">arrow_back</i></a>
<div class="container users form">
    <div class="row card-panel" style="margin: 2em auto;">
    <?php echo $this->Form->create('Deal'); ?>
        <div class="input-field col s12 required">
            <label for="DealName">Name</label>
            <textarea class="materialize-textarea" name="data[Deal][name]" id="DealName" required="required" data-length="128"></textarea>
        </div>
        <div class="input-field col s12">
            <label for="DealDescription">Description</label>
            <textarea class="materialize-textarea" name="data[Deal][description]" id="DealDescription" data-length="256"></textarea>
        </div>
        <div class="input-field col s12 required">
            <label for="DealDate">Date</label>
            <input type="text" name="data[Deal][date]" id="DealDate" required="required" class="datepicker">
        </div>
        <div class="input-field col s12 required">
            <label for="DealTime">Time</label>
            <input type="text" name="data[Deal][time]" id="DealTime" required="required" class="timepicker">
        </div>
        <?php echo $this->Form->input('status_id', ['type' => 'hidden', 'value' => 1]); ?>
        <div class="input-field col s12">
            <?php echo $this->Form->button(__('Create New Deal'), ['type' => 'submit', 'name' => 'action', 'class' => 'btn waves-effect red lighten-1 center']); ?>
        </div>
    </div>
    <script>
        $(function () {
            $('textarea').characterCounter();
            $('.datepicker').datepicker({
                format: 'yyyy-mm-dd'
            });
            $('.timepicker').timepicker({
                twelveHour: false
            });
        });
    </script>
</div>

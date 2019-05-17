<?php  ?>
<a class="btn-floating btn-large waves-effect waves-light red lighten-1 float-bottom-right" href="/deals/add"><i class="material-icons">add</i></a>
<div id="tab_pannel" class="row">
    <div class="col s12">
        <ul id="tabs" class="tabs grey lighten-4">
            <?php foreach ($status as $id => $statu) : ?>
            <?php $active = ($statu['Statu']['id'] == $tab) ? 'active' : ''; ?>
                <li class="tab col s3"><a class="<?= $active ?>" id="item_<?= $statu['Statu']['id'] ?>" href="#tab_<?= $statu['Statu']['id'] ?>"><i class="material-icons small grey-text text-darken-1"><?= $statu['Statu']['icon'] ?></i></a></li>
            <?php endforeach; ?>
        </ul>
    </div>
    <?php foreach ($status as $id => $statu) : ?>
    <div id="tab_<?= $statu['Statu']['id'] ?>" class="col s12">
        <h6><?= $statu['Statu']['name'] ?></h6>
    <?php if (count($deals[$statu['Statu']['id']]) > 0) : ?>
        <?php foreach($deals[$statu['Statu']['id']] as $deal_id => $deal_data) : ?>
        <div class="card-panel row" onclick="$(this).toggle().next().toggle();">
            <div class="col s12"><strong><?= $deal_data['Deal']['name'] ?></strong></div>
            <div class="col s12"><small><?= $deal_data['Deal']['date'] ?></small></div>
        </div>
        <div class="card-panel card-panel-button-right row" style="display: none;">
            <?php if ($statu['Statu']['id'] == 1) : ?>
                <div class="col m9 s6" onclick="$(this).parent().toggle().prev().toggle();"><i><?= $deal_data['Deal']['description'] ?></i></div>
                <a class="col m1 s2 button-right red lighten-1 waves-effect waves-light center-align white-text modal-trigger deal-deleter" href="#modalDelete" delete_id="<?= $deal_data['Deal']['id'] ?>"><i class="material-icons small" style="margin-top: 12px;">close</i></a>
                <a class="col m1 s2 button-right blue lighten-1 waves-effect waves-light center-align white-text" href="/deals/edit/<?= $deal_data['Deal']['id'] ?>"><i class="material-icons small" style="margin-top: 12px;">create</i></a>
                <a class="col m1 s2 button-right grey lighten-1 waves-effect waves-light center-align white-text" href="/deals/forward/<?= $deal_data['Deal']['id'] ?>"><i class="material-icons small" style="margin-top: 12px;">arrow_forward</i></a>
            <?php elseif ($statu['Statu']['id'] == 2) : ?>
                <div class="col m10 s8" onclick="$(this).parent().toggle().prev().toggle();"><i><?= $deal_data['Deal']['description'] ?></i></div>
                <a class="col m1 s2 button-right green lighten-1 waves-effect waves-light center-align white-text modal-trigger deal-doner" href="#modalDeal" donedeal_id="<?= $deal_data['Deal']['id'] ?>"><i class="material-icons small" style="margin-top: 12px;">check</i></a>
                <a class="col m1 s2 button-right grey lighten-1 waves-effect waves-light center-align white-text" href="/deals/back/<?= $deal_data['Deal']['id'] ?>"><i class="material-icons small" style="margin-top: 12px;">arrow_back</i></a>
            <?php elseif ($statu['Statu']['id'] == 3) : ?>
                <div class="col s12" onclick="$(this).parent().toggle().prev().toggle();"><strong>$<?= $deal_data['Deal']['pay_amount'] ?></strong> <i><?= $deal_data['Deal']['description'] ?></i></div>
                <div class="col s12"><small><?= $deal_data['Deal']['pay_date'] ?></small></div>
            <?php else : ?>
                <div class="col m10 s8" onclick="$(this).parent().toggle().prev().toggle();"><i><?= $deal_data['Deal']['description'] ?></i></div>
                <a class="col m1 s2 button-right grey lighten-1 waves-effect waves-light center-align white-text" href="/deals/forward/<?= $deal_data['Deal']['id'] ?>"><i class="material-icons small" style="margin-top: 12px;">arrow_forward</i></a>
                <a class="col m1 s2 button-right grey lighten-1 waves-effect waves-light center-align white-text" href="/deals/back/<?= $deal_data['Deal']['id'] ?>"><i class="material-icons small" style="margin-top: 12px;">arrow_back</i></a>
            <?php endif; ?>
        </div>
        <?php endforeach; ?>
        <div>Last deal reached</div>
    <?php else : ?>
        <div class="card-panel">:/ No deals so far... Add one pushing that big red button at the bottom!</div>
    <?php endif; ?>
    </div>
    <?php endforeach; ?>
</div>
<div id="modalDelete" class="modal">
    <div class="modal-content">
        <h4>Are you sure?</h4>
        <p>Once deleted, it can not be recovered</p>
    </div>
    <div class="modal-footer">
        <a href="javascript:deleteDeal();" class="modal-close waves-effect waves-green btn-flat">OK</a>
        <a href="#!" class="modal-close waves-effect waves-red btn-flat">Cancel</a>
    </div>
</div>
<div id="modalDeal" class="modal">
    <div class="modal-content">
        <h4>Finally!</h4>
        <div class="input-field col s12 required">
            <label for="DealAmountPaid">Amount Paid</label>
            <input id="DealAmountPaid" type="text" required="required">
        </div>
    </div>
    <div class="modal-footer">
        <a href="javascript:doneDeal();" class="modal-close waves-effect waves-green btn-flat">OK</a>
        <a href="#!" class="modal-close waves-effect waves-red btn-flat">Cancel</a>
    </div>
</div>
<script>
    var delete_this, donedeal_this, deleteDeal, doneDeal;
    $(function () {
        // Materialize
        $('.tabs').tabs();
        $('.modal').modal();
        // Vars
        delete_this = '0';
        donedeal_this = '0';
        // Events
        $(document).on('click', '.deal-deleter', function() {
            delete_this = $(this).attr('delete_id');
        });
        $(document).on('click', '.deal-doner', function () {
            donedeal_this = $(this).attr('donedeal_id');
        });
        // Functions
        deleteDeal = function() {
            location.replace('/deals/delete/' + delete_this);
        };
        doneDeal = function () {
            location.replace('/deals/forward/' + donedeal_this + '/' + $('#DealAmountPaid').val());
        };
    });
</script>

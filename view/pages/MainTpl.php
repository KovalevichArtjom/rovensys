<div class="container">
    <div class="container-fluid title">
        <h1>Список покупок</h1>
    </div>
    <div class="purchases">
        <div class="row">
            <div class="col-1 purchases_header id">№</div>
            <div class="col-5 purchases_header name">Название</div>
            <div class="col-1 purchases_header amount">Количество</div>
            <div class="col-3 purchases_header status">Статус</div>
            <div class="col-2 purchases_header edit">Редактировать</div>
        </div>
        <div class="row">
            <?php if($listPurchases && $arrStatusPurchase):
                foreach ($listPurchases as $attrs):?>
                    <div class="col-1 purchases_body id"><?php echo $attrs['id']?></div>
                    <div class="col-5 purchases_body name" id="namePurchase_<?php echo $attrs['id']?>">
                        <?php echo $attrs['name']?>
                    </div>
                    <div class="col-1 purchases_body amount" id="amountPurchase_<?php echo $attrs['id']?>">
                        <?php echo $attrs['amount']?>
                    </div>
                    <div class="col-3 purchases_body status" id="statusPurchase_<?php echo $attrs['id']?>">
                        <?php echo $arrStatusPurchase[$attrs['status']]?>
                    </div>
                    <div class="col-2 purchases_body edit">
                        <img src="/img/edit.svg" data-idpurchase="<?php echo $attrs['id'] ?>"/>
                    </div>
                <?php endforeach;
            else:?>
                <div class="col-1 purchases_body id">#</div>
                <div class="col-5 purchases_body name">NULL</div>
                <div class="col-1 purchases_body amount">NULL</div>
                <div class="col-3 purchases_body status">NULL</div>
                <div class="col-2 purchases_body edit">NULL</div>
            <?php endif; ?>
        </div>
        <div class="row">
            <div class="col purchases_btn__add">
                <button type="button" class="btn btn-primary btn-lg btn-block">Добавить покупку</button>
            </div>
        </div>
    </div>
    <?php /*//modal add */?>
    <div id="modal-add-purchase" class="modal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <form id="purchase-add" class="modal__form" method="post">
                <div class="modal-content">
                    <div class="modal-header">
                        <div class="modal-title page__title">Окно добавления покупки</div>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <?php /*//name purchase*/?>
                        <div class="col-md namePurchase">
                            <label>Название покупки</label>
                            <input type="text" class="form-control" id="namePurchase" required>
                        </div>
                        <?php /*//amount purchase*/?>
                        <div class="col-md amountPurchase">
                            <label for="validationCustomUsername">Количество</label>
                            <input type="text" class="form-control" id="amountPurchase" aria-describedby="inputGroupPrepend" pattern="^\d+$" required>
                        </div>
                        <?php /*//status purchase*/?>
                        <div class="col-md statusPurchase">
                            <label>Статус покупки</label>
                            <select class="custom-select statusPurchase" id="statusPurchase">
                                <?php if(is_array($arrStatusPurchase)):
                                    foreach ($arrStatusPurchase as $status => $nameStatus): ?>
                                        <option value="<?php echo $status ?>"><?php echo $nameStatus ?></option>
                                    <?php endforeach;
                                endif; ?>
                            </select>
                            <div class="form-error statusPurchase"></div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="submit" class="btn btn-primary btn-lg btn-block" value="добавить"/>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <?php /*//end modal add */?>
    <?php /*//modal edit */?>
    <div id="modal-edit-purchase" class="modal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <form id="purchase-edit" class="modal__form" method="post">
                <div class="modal-content">
                    <div class="modal-header">
                        <div class="modal-title page__title">Окно добавления покупки</div>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <?php /*//name purchase*/?>
                        <div class="col-md namePurchase">
                            <label>Название покупки</label>
                            <input type="text" class="form-control" id="namePurchase" required>
                        </div>
                        <?php /*//amount purchase*/?>
                        <div class="col-md amountPurchase">
                            <label for="validationCustomUsername">Количество</label>
                            <input type="text" class="form-control" id="amountPurchase" aria-describedby="inputGroupPrepend" pattern="^\d+$" required>
                        </div>
                        <?php /*//status purchase*/?>
                        <div class="col-md statusPurchase">
                            <label>Статус покупки</label>
                            <select class="custom-select statusPurchase" id="statusPurchase">
                                <?php if($arrStatusPurchase):
                                    foreach ($arrStatusPurchase as $status => $nameStatus): ?>
                                        <option value="<?php echo $status ?>"><?php echo $nameStatus ?></option>
                                    <?php endforeach;
                                endif; ?>
                            </select>
                            <div class="form-error statusPurchase"></div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="input-group">
                            <input type="submit" class="btn btn-primary btn-lg btn-block purchase-edit__upd" id="updBtn" value="Сохранить"/>
                            <input type="submit" class="btn btn-primary btn-lg btn-block purchase-edit__del" id="delBtn" value="Удалить"/>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <?php /*//end modal edit */?>
</div>

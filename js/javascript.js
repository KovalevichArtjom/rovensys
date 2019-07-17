//checking possibility of delete product
function checkingOnDelete(CheckingEl,NoneEl){
    let statusPurchase = $(CheckingEl).val(),
        idPurchased = 1;//Default val if product purchased

    if(statusPurchase == idPurchased){
        //hide btn for delete
        $(NoneEl).css('display','none');
    }else{
        //show btn for delete
        $(NoneEl).css('display','block');
    }
}
//on event closed window
$('#purchase-add').on('hidden.bs.modal', function () {
    location.reload();
})
//on event closed window
$('#purchase-edit').on('hidden.bs.modal', function () {
    location.reload();
})
//show window for add purchase
$('.purchases_btn__add').click(function(){
    $('#modal-add-purchase').modal('show');
});

$('#purchase-edit #statusPurchase').on('change',function () {
    checkingOnDelete('#purchase-edit #statusPurchase','.purchase-edit__del');
});

//additing parchase
$('#purchase-add').submit(function () {
    let namePurchase = $('#'+this.id+' #namePurchase').val(),
        amountPurchase = $('#'+this.id+' #amountPurchase').val(),
        statusPurchase = $('#'+this.id+' #statusPurchase option:selected').val();

    if (namePurchase && amountPurchase && statusPurchase) {
        $.ajax({
            method: 'post',
            dataType: "json",
            data: {
                "ac": "addPurchase",
                "namePurchase": namePurchase,
                "amountPurchase": amountPurchase,
                "statusPurchase": '' + statusPurchase + '',
                "dataType": "json"
            },
            success: (function (res) {
                if (res === true) {
                    $('#modal-add-purchase').modal('hide');
                    location.reload();
                }else{
                    //if have error request
                    $('#'+this.id+'.statusPurchase').children('.form-error').html('<span class="mess-err" style="color:red">'+res+'</span>');
                }
            })
        })
    }
    return false;
})

//Variable stores purchase id.
var idPurchase = '';
//show window for update purchase
$('.edit img').click(function(){
    //get value for input from table
    idPurchase = $(this).data('idpurchase');
    let fatherClass = '#purchase-edit ',
        namePurchase = $('#namePurchase_' + idPurchase).text().trim(),
        amountPurchase = $('#amountPurchase_' + idPurchase).text().trim(),
        statusPurchase = $('#statusPurchase_' + idPurchase).text().trim();
    //set value in input modal window
    $(fatherClass+'#namePurchase').val(namePurchase);
    $(fatherClass+'#amountPurchase').val(amountPurchase);
    $(fatherClass+'#statusPurchase option[selected]').removeAttr("selected");
    $(fatherClass+'#statusPurchase option:contains(' + statusPurchase + ')').attr('selected', true);

    checkingOnDelete(fatherClass+'#statusPurchase','.purchase-edit__del');

    //show modal
    $('#modal-edit-purchase').modal('show');
});
//update parchase
$('#purchase-edit').submit(function () {
    var idAcBtn = $(document.activeElement).attr("id");
    //If there's ID purchase
    if(idPurchase) {
        //For update data purchase
        if (idAcBtn === 'updBtn') {
            let namePurchase = $('#' + this.id + ' #namePurchase').val(),
                amountPurchase = $('#' + this.id + ' #amountPurchase').val(),
                statusPurchase = $('#' + this.id + ' #statusPurchase option:selected').val();

            if (namePurchase && amountPurchase && statusPurchase) {
                $.ajax({
                    method: 'post',
                    dataType: "json",
                    data: {
                        "ac": "updPurchase",
                        "namePurchase": namePurchase,
                        "amountPurchase": amountPurchase,
                        "statusPurchase": '' + statusPurchase + '',
                        "idPurchase": idPurchase,
                        "dataType": "json"
                    },
                    success: (function (res) {
                        if (res === true) {
                            $('#modal-add-purchase').modal('hide');
                            location.reload();
                        } else {
                            //if have error request
                            $('#purchase-edit .statusPurchase').children('.form-error').html('<span class="mess-err" style="color:red">' + res + '</span>');
                        }
                    })
                })
            }
        }
        //For delete purchase
        if (idAcBtn === 'delBtn') {
            $.ajax({
                method: 'post',
                dataType: "json",
                data: {
                    "ac": "delPurchase",
                    "idPurchase": idPurchase,
                    "dataType": "json"
                },
                success: (function (res) {
                    if (res === true) {
                        $('#modal-add-purchase').modal('hide');
                        location.reload();
                    } else {
                        //if have error request
                        $('#purchase-edit .statusPurchase').children('.form-error').html('<span class="mess-err" style="color:red">' + res + '</span>');
                    }
                })
            })
        }
    }
    return false;
})
function fvalor(){
    var vcos = document.getElementById('vcosto').value;
    var vmar = document.getElementById('pmargen').value;

    if (vcos == "" || vcos == null || vcos == undefined) {
        document.getElementById('valor').value = 0.00;
    } else if (vmar == "" || vmar == null || vmar == undefined) {
        document.getElementById('valor').value = 0.00;
    } else {
        vcos = parseFloat(vcos);
        vmar = parseFloat(vmar);
        var vcalculo = (vcos + ((vcos * vmar) / 100));
        document.getElementById('valor').value = vcalculo.toFixed(2);
    }
};

function ftotal(){
    var vnet = document.getElementById('vneto').value;
    var viva = document.getElementById('piva').value;

    if (vnet == "" || vnet == null || vnet == undefined) {
        document.getElementById('vtotal').value = 0.00;
    }else if (viva == "" || viva == null || viva == undefined){
        document.getElementById('vtotal').value = 0.00;
    }
    else {
        var vnet = parseFloat(vnet);
        var viva = parseFloat(viva);
        var vcalculo = (vnet + ((vnet * viva) / 100));
        document.getElementById('vtotal').value = vcalculo.toFixed(2);
    }
};
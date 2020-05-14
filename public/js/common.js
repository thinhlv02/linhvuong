function getAjax(url, params, method, onSuccess, dataType, onError, onComplete) {
    // console.log(url);
    method = (typeof (method) == 'undefined' || method == '' || (method.toUpperCase() != 'POST' && method.toUpperCase() != 'GET')) ? 'GET' : method.toUpperCase();
    dataType = (typeof (dataType) == 'undefined' || dataType == '') ? 'html' : dataType;

    if (typeof (onSuccess) == 'undefined' || onSuccess == '') {
        var _onSucess = function (data) {
        };
    } else {
        var _onSucess = onSuccess;
    }

    if (typeof (onComplete) == 'undefined' || onComplete == '') {
        var _onComplete = function (jqXHR, textStatus) {

        };
    } else {
        var _onComplete = onComplete;
    }

    if (typeof (onError) == 'undefined' || onError == '') {
        var _onError = function (jqXHR, textStatus, errorThrown) {
        };
    } else {
        var _onError = onError;
    }

    $.ajax({
        type: method,
        url: url,
        dataType: dataType,
        data: params,
        success: _onSucess,
        error: _onError,
        complete: _onComplete,
        cache: false
    });
}
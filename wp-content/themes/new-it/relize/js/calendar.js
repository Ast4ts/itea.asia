(function($) {

    /**
     * autor: CTAPbIu_MABP
     * email: ctapbiumabp@gmail.com
     * site: mabp.kiev.ua/2009/08/11/customized-datepicker/
     * license: MIT & GPL
     * last update: 11.08.2009
     * version: 1.0
     */

    // сохраняем старые функции
    var old_datepicker = $.fn.datepicker;
    var old_generateHTML = $.datepicker._generateHTML;

    // и делигируем их новым
    $.datepicker._generateHTML = function(inst) {
        // получаем календарь ввиде raw-html
        var _generateHTML = old_generateHTML.apply(this, arguments),
                // выгребаем даты для этого календаря
                dates = inst.settings.hightlight.values;
        titles = inst.settings.hightlight.titles;

        // и начинаем расскрашивать
        for (var i in dates) {

            if (dates[i].getFullYear() == inst.drawYear && dates[i].getMonth() == inst.drawMonth) {
                var AReplaceText = '<strong>' + dates[i].getDate() + '</strong>';
                //var text = 'href="#">' + dates[i].getDate();
                var regul = dates[i].getDate()  + '</a>';
               
                var VRegExp = new RegExp(regul);
                // alert(VRegExp);
                //var textHTMS = '<a class="ui-state-default" href="#">1</a><a class="ui-state-default" href="#">2</a><a class="ui-state-default" href="#">3</a><a class="ui-state-default" href="#">15</a>';
                //var VResult = _generateHTML.replace(VRegExp, AReplaceText);
                //alert(VResult);
//                var reg = '/<a class="([^"]+)" href="#">' + dates[i].getDate() + '<\/a>/';
//                found = _generateHTML.match(reg);
//
//                alert(found);

                _generateHTML = _generateHTML.replace(VRegExp, AReplaceText);
            }
        }
        return _generateHTML;
    };

    // делегируем конструктор
    $.fn.datepicker = function(options) {
        // новые опции преобразовываем к объекту
        options.hightlight = $.extend(
                {format: $.datepicker._defaults.dateFormat, values: [], titles: [], settings: {}},
        options.hightlight
                );

        // сразу превращаем даты в объекты типа Date для того чтобы сохранить
        options.hightlight.values = $.map(options.hightlight.values, function(value) {
            return $.datepicker.parseDate(options.hightlight.format, value, options.hightlight.settings);
        });

        return old_datepicker.apply(this, [options]);
    };
})(jQuery);
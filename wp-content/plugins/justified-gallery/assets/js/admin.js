(function ($) {

    var SETTINGS_TOGGLE = {
        selectSel: 'dgwt-jg-options-toggle select',
        groupSel: 'dgwt_jg_settings-group',
        reloadChoices: function ($el) {
            var _this = this,
                $group = $el.closest('.' + _this.groupSel),
                value = $group.find('.' + _this.selectSel + ' option:selected').val(),
                currentClass = '';

            _this.hideAll($group);

            value = value.replace('_', '-');

            if (value.length > 0) {
                currentClass = 'opt-' + value;
            }

            if ($('.' + currentClass).length > 0) {
                $('.' + currentClass).fadeIn();
            }

        },
        hideAll: function ($group) {
            $group.find('tr[class*="opt-"]').hide();
        },
        registerListeners: function () {
            var _this = this;

            $('.' + _this.selectSel).on('change', function () {
                _this.reloadChoices($(this));
            });

        },
        init: function () {
            var _this = this,
                $sel = $('.' + _this.selectSel);

            if ($sel.length > 0) {
                _this.registerListeners();

                $sel.each(function () {
                    _this.reloadChoices($(this));
                });

            }


        }

    };

    function moveOuterBorderOption(){
        var $elToMove = $('.js-dgwt-jg-settings-margin-nob');

        if($elToMove.length > 0){
            var $label = $elToMove.find('td label');
            if($label.length > 0){
                $label.clone().addClass('dgwt-jg-settings-margin-nob').appendTo( '.js-dgwt-jg-settings-margin td' );
                $elToMove.remove();
            }

        }
    }

    $(document).ready(function () {
        SETTINGS_TOGGLE.init();

        moveOuterBorderOption();
    });


})(jQuery);
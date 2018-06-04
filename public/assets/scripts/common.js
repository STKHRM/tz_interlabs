Object.defineProperty(Array.prototype, 'max', {
    value: function() {
        return Math.max.apply(null, this);
    },
    enumerable: false
});

Object.defineProperty(Array.prototype, 'min', {
    value: function() {
        return Math.min.apply(null, this);
    },
    enumerable: false
});

(function($) {
    $(function() {

        'use strict';

        $('body').on('click', '.js-alert-close', function(e) {
            $(this).closest('.notifications__item').fadeOut(300, function() {
                $(this).remove();
            });
            e.preventDefault();
        });



        function bindTableSort() {
            var el = document.getElementById('table'),
                dragger = tableDragger(el, {
                    mode: 'row',
                    dragHandler: '.table__td_drag',
                    onlyBody: true,
                    animation: 300
                });

            dragger.on('drop', function(from, to) {
                var min = Math.min(from, to),
                    max = Math.max(from, to),
                    minSort = null,
                    maxSort = null,
                    $items = $('.table__body .table__tr'),
                    updateItems = [],
                    sortValues = [];

                $items.each(function(index) {
                    var itemId = $(this).data('id');
                    if (itemId) {
                        updateItems[index] = {
                            'id': $(this).data('id'),
                            'sort': $(this).data('sort') || 10
                        };
                        sortValues.push($(this).data('sort'));
                    }
                });

                maxSort = sortValues.max();
                minSort = sortValues.min();

                if (maxSort && minSort && sortValues.length) {
                    var range = maxSort - minSort,
                        chunk = range / sortValues.length;

                    updateItems.forEach(function(item, i, updateItems) {
                        if (i == 0) {
                            var sort = maxSort;
                        } else {
                            maxSort -= chunk;
                            var sort = maxSort;
                        }

                        $('#' + item.id).find('.sort').text(Math.floor(sort));
                        updateItems[i].sort = Math.floor(sort);
                    });
                }

                $.ajax({
                    type: 'POST',
                    data: { items: updateItems },
                    url: '/data/edit',
                    success: function(data) {
                        if (!!data['messages']) showMessages(data['messages']);
                        updateDataView();
                        hideModal();
                    },
                    error: function() {
                        showMessages([{
                            type: 'error',
                            text: 'Произошла ошибка'
                        }]);
                        updateDataView();
                        hideModal();
                    }
                });

            });
        }


        // Аякс пагинация
        $('body').on('click', '.js-ajax-link', function(e) {
            var url = $(this).attr('href');

            if (url) {
                history.pushState({}, null, url);
                updateDataView(url);
                e.preventDefault();
            }
        });

        // Добавление записей
        $('body').on('click', '.js-data-add', function(e) {
            var $entryPanel = $('.entry-form'),
                $entryForm = $('#entryForm'),
                url = $(this).attr('href'),
                $formTitle = $entryPanel.find('.panel__title');

            $formTitle.text($formTitle.data('title'));
            $entryForm.find('input[name="id"]').val(' ');

            $entryForm.trigger('reset').attr('action', url);
            showModal('#entryFormWrapper');
            e.preventDefault();
        });

        // Редактирование записей
        $('body').on('click', '.js-edit-entry', function(e) {
            var url = $(this).attr('href');

            if (url) {
                $.getJSON(url, function(data) {
                    console.log(data);
                    setFormValue(data);
                    showModal('#entryFormWrapper');
                });
            }
            e.preventDefault();
        });

        bindTableSort();
        // Отправка формы редактирования записи
        bindAjaxForm($('.js-ajax-entry-form'));
        bindAjaxForm($('.js-ajax-sort-form'));
        function bindAjaxForm($form) {
            if($form.length) {
                $form.submit(function (e) {
                    var url = $(this).attr('action');
                    $.ajax({
                        type: "POST",
                        url: url,
                        data: $(this).serialize(),
                        success: function (data) {
                            if (!!data['messages']) showMessages(data['messages']);
                            updateDataView();
                            hideModal();
                        },
                        error: function () {
                            showMessages([{
                                type: 'error',
                                text: 'Произошла ошибка'
                            }]);
                            updateDataView();
                            hideModal();
                        }
                    });

                    e.preventDefault();
                });
            }
        }

        $('body').on('change', '.js-item-mark', function () {
            var $submit = $(this).closest('form').find('button[type=submit]');
            if($(this).is(':checked')) {
                $submit.prop('disabled', false);
            } else {
                $submit.prop('disabled', true);
            }
        });

        $('body').on('change', '.js-item-all-mark', function () {
            var $checkboxes = $(this).closest('form').find('.js-item-mark');
            if($(this).is(':checked')) {
                $checkboxes.prop('checked', true).change();
            } else {
                $checkboxes.prop('checked', false).change();
            }
        });

        function setFormValue(data) {
            var $entryPanel = $('.entry-form'),
                formTitle = data.title || null,
                action = data.action || null,
                formItems = data.data || null;

            if ($entryPanel.length && !!action) {
                $entryPanel.find('.panel__title').text(formTitle);

                $('#entryForm').attr('action', '/data/' + action);

                for (var prop in formItems) {
                    var $ctrl = $('[name=' + prop + ']', $entryPanel);
                    $ctrl.val(formItems[prop]);
                }
            }
        }

        function updateDataView(url) {
            var href = url || window.location.href;
            $.ajax({
                url: href,
                dataType: "html",
                beforeSend: function() {
                    $('#content').addClass('load');
                },
                success: function(data) {
                    $('#content').html(data).removeClass('load');
                    bindAjaxForm($('.js-ajax-sort-form'));
                    bindTableSort();
                }
            });
        }

        function showMessages(messages, clearMessages = true) {
            var $notificationsPanel = $('.notifications');
            if (clearMessages) $notificationsPanel.html('');

            if (messages.length) {
                messages.forEach(function(message, i, messages) {
                    $('<div class="notifications__item"><div class="alert alert_style_' + message.type + '">' + message.text + '<button class="alert__close js-alert-close">&#215;</button></div></div>').appendTo($notificationsPanel);
                });
            }
        }

        function showModal(id) {
            $(id).addClass('page__modal_state_open');
        }


        function hideModal() {
            $('.page__modal').removeClass('page__modal_state_open');
        }

        var $modalClose = $('.js-close-modal');
        $modalClose.on('click', function() {
            hideModal();
        });

        function toObject(arr) {
            var res = {};
            for (var i = 0; i < arr.length; ++i)
                if (arr[i] !== undefined) res[i] = arr[i];
            return res;
        }
    });
})(jQuery);
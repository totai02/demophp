$(document).ready(function () {
    // Image Manager
    $(document).delegate('a[data-toggle="image"]', 'click', function (e) {
        e.preventDefault();

        $('.popover').popover('hide', function () {
            $('.popover').remove();
        });

        var element = this;

        $(element).popover({
            html: true,
            placement: 'right',
            trigger: 'manual',
            content: function () {
                return '<button type="button" id="button-image" class="btn btn-primary"><i class="fa fa-pencil"></i></button> <button type="button" id="button-clear" class="btn btn-danger"><i class="fa fa-trash-o"></i></button>';
            }
        });

        $(element).popover('toggle');

        $('#button-image').on('click', function () {
            $('#modal-image').remove();

            CKFinder.modal({
                chooseFiles: true,
                width: 900,
                height: 600,
                onInit: function (finder) {
                    finder.on('files:choose', function (evt) {
                        var file = evt.data.files.first();

                        $(element).next().val(file.getUrl().replace(dir_sub + 'resources/upload/image/', ''));
                        $(element).find('img').attr('src', root_url + 'resources/assets/admin/js/ckfinder/core/connector/php/connector.php?command=Thumbnail&lang=vi&type=' + file.attributes.folder.attributes.parent.attributes.name.replace("%20", " ") + '&currentFolder=' + file.attributes.folder.attributes.name.replace("%20", " ") + '&fileName=' + file.attributes.name.replace("%20", " ") + '&size=100x100');
                    });
                }
            });

            $(element).popover('hide', function () {
                $('.popover').remove();
            });
        });

        $('#button-clear').on('click', function () {
            $(element).find('img').attr('src', $(element).find('img').attr('data-placeholder'));

            $(element).parent().find('input').attr('value', '');
            $(element).popover('hide', function () {
                $('.popover').remove();
            });
        });
    });

    // tooltips on hover
    $('[data-toggle=\'tooltip\']').tooltip({container: 'body', html: true});

    // Makes tooltips work on ajax generated content
    $(document).ajaxStop(function () {
        $('[data-toggle=\'tooltip\']').tooltip({container: 'body'});
    });

    $.event.special.remove = {
        remove: function (o) {
            if (o.handler) {
                o.handler.apply(this, arguments);
            }
        }
    };

    $('[data-toggle=\'tooltip\']').on('remove', function () {
        $(this).tooltip('destroy');
    });
});


function getURLVar(key) {
    var value = [];

    var query = String(document.location).split('?');

    if (query[1]) {
        var part = query[1].split('&');

        for (i = 0; i < part.length; i++) {
            var data = part[i].split('=');

            if (data[0] && data[1]) {
                value[data[0]] = data[1];
            }
        }

        if (value[key]) {
            return value[key];
        } else {
            return '';
        }
    }
}

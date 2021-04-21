function resetMarkdownEditor() {
    $('.markdown').markdownEditor({
        preview: true,
        onPreview: function (content, callback) {
            callback(marked(content));
        }
    });
}

jQuery(document).ready(function ($) {
    resetMarkdownEditor();
});

$(document).ajaxComplete(function () {
    resetMarkdownEditor();
});

var gitPageGenerate = function (options) {
    $.ajax({
        type: options.type,
        url: options.url,
        /*beforeSend: function (xhr) {
            xhr.overrideMimeType("text/plain; charset=x-user-defined");
        },*/
        statusCode: {
            404: function () {
                alert("page not found");
            }
        },
        data: options.data,
        dataType: 'json'
    }).done(function (data) {
        if (data.status) {
            alert('OK:' + data.path);
        }
    });
}

var gitPageAllGenerate = function (url) {
    gitPageGenerate({
        type: 'GET',
        url: url,
        data: {},
    });

    return false;
}

var gitPageSpecGenerate = function (url, id, slug) {
    gitPageGenerate({
        type: 'GET',
        url: url,
        data: {
            id,
            slug
        },
    });

    return false;
}


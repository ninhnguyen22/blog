var mdStatus = false;

function resetMarkdownEditor() {
    if (!checkEditPage()) {
        mdStatus = false;
        return;
    }

    if (!mdStatus) {
        var content = $('.markdown');
        if (content[0]) {
            content.parent().attr('id', 'editor');

            var editor = editormd("editor", {
                // width: "100%",
                height: "700px",
                // markdown: "xxxx",     // dynamic set Markdown text
                path: "/bower_components/editor.md/lib/",  // Autoload modules mode, codemirror, marked... dependents libs path
                lang: {
                    name: "en"
                },
                imageUpload          : true,          // Enable/disable upload
                imageFormats         : ["jpg", "jpeg", "gif", "png", "PNG", "bmp", "webp"],
                imageUploadURL       : "/api/admin/support/upload"
            });
            mdStatus = true;
        }
    }
}

function checkEditPage() {
    const url = window.location.href;
    return url.includes("edit") || url.includes("create");
}

jQuery(document).ready(function ($) {
    resetMarkdownEditor();
});

$(document).ajaxComplete(function () {
    resetMarkdownEditor();
});

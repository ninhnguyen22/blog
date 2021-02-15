var SlugConvert = (function () {
    function SlugConvert(targetId, out) {
        this.targetId = targetId;
        this.out = out;

        this.addEvent();
    }

    SlugConvert.prototype.addEvent = function () {
        var target = document.getElementById(this.targetId);
        if (target) {
            var self = this;
            target.addEventListener("keyup", function () {
                self.assignInput(this.value)
            });
        }
    }

    SlugConvert.prototype.assignInput = function (value) {
        var outInput = document.getElementById(this.out);
        outInput.value = this.convertToSlug(value);
    }

    SlugConvert.prototype.convertToSlug = function (text) {
        return text
            .toLowerCase()
            .replace(/ /g, '-')
            .replace(/[^\w-]+/g, '')
    }

    SlugConvert.prototype.reset = function () {
        this.addEvent();
    }

    return SlugConvert;
}())

var nameSlug = new SlugConvert("name", "slug");

$(document).bind("ajaxComplete", function () {
    nameSlug.reset();
});

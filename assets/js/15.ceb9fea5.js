(window.webpackJsonp=window.webpackJsonp||[]).push([[15],{530:function(e,t,n){"use strict";n.r(t);var i=n(6),a=Object(i.a)({},(function(){var e=this,t=e.$createElement,n=e._self._c||t;return n("ContentSlotsDistributor",{attrs:{"slot-key":e.$parent.slotKey}},[n("h3",{attrs:{id:"description"}},[n("a",{staticClass:"header-anchor",attrs:{href:"#description"}},[e._v("#")]),e._v(" Description")]),e._v(" "),n("h4",{attrs:{id:"application-initialization"}},[n("a",{staticClass:"header-anchor",attrs:{href:"#application-initialization"}},[e._v("#")]),e._v(" Application initialization")]),e._v(" "),n("p",[e._v("Khởi tạo application và binding các important service (Kernel, ExceptionHandler) tại "),n("code",[e._v("boostrap/app.php")])]),e._v(" "),n("ul",[n("li",[n("p",[e._v("Đối với Http Request, tất cả request sẽ được web server (apache, nginx) điều hướng đến file public/index.php để khởi tạo application theo config:")]),e._v(" "),n("div",{staticClass:"language- line-numbers-mode"},[n("pre",{pre:!0,attrs:{class:"language-text"}},[n("code",[e._v('# Apache\nDocumentRoot "< app directory path >/public"\n\n# Nginx\nserver {\n    . . .\n    root < app directory path >/public;\n    . . .\n}\n')])]),e._v(" "),n("div",{staticClass:"line-numbers-wrapper"},[n("span",{staticClass:"line-number"},[e._v("1")]),n("br"),n("span",{staticClass:"line-number"},[e._v("2")]),n("br"),n("span",{staticClass:"line-number"},[e._v("3")]),n("br"),n("span",{staticClass:"line-number"},[e._v("4")]),n("br"),n("span",{staticClass:"line-number"},[e._v("5")]),n("br"),n("span",{staticClass:"line-number"},[e._v("6")]),n("br"),n("span",{staticClass:"line-number"},[e._v("7")]),n("br"),n("span",{staticClass:"line-number"},[e._v("8")]),n("br"),n("span",{staticClass:"line-number"},[e._v("9")]),n("br")])]),n("p",[n("code",[e._v("index.php")])]),e._v(" "),n("ul",[n("li",[e._v("Load composer autoload")]),e._v(" "),n("li",[e._v("Khởi tạo Laravel Application tại "),n("code",[e._v("boostrap/app.php")])]),e._v(" "),n("li",[e._v("Resolved"),n("code",[e._v("Illuminate\\Http\\Kernel")]),e._v(" và handle kernel.")])])]),e._v(" "),n("li",[n("p",[e._v("Đối với Console Request (khi sử dụng command cli như "),n("code",[e._v("php artisan ..")]),e._v("):")]),e._v(" "),n("p",[e._v("xử lí khởi tại tạo file "),n("code",[e._v("artisan")]),e._v(" tương tự như trên nhưng sẽ resolved "),n("code",[e._v("Illuminate\\Contracts\\Console\\Kernel")])])])]),e._v(" "),n("h4",{attrs:{id:"http-console-kernel"}},[n("a",{staticClass:"header-anchor",attrs:{href:"#http-console-kernel"}},[e._v("#")]),e._v(" Http/Console Kernel:")]),e._v(" "),n("ul",[n("li",[n("p",[e._v("Http Kernel: file concrete "),n("code",[e._v("app/Http/Kernel.php")]),e._v(" cho contract "),n("code",[e._v("Illuminate\\Http\\Kernel")])]),e._v(" "),n("ul",[n("li",[n("p",[e._v("Load qua các bootstrap classes và thực hiện xử lí bootstrap trước khi xử lí request. Chi tiết hơn Laravel binding các class này vào container và run method "),n("code",[e._v("bootstrap()")]),e._v(" của riêng từng class. Xem tại "),n("code",[e._v("Illuminate\\Foundation\\Application::bootstrapWith()")]),e._v(".")]),e._v(" "),n("ul",[n("li",[n("code",[e._v("\\Illuminate\\Foundation\\Bootstrap\\LoadEnvironmentVariables")]),e._v(" : load environment, sử dụng package "),n("code",[e._v("vlucas/phpdotenv")])]),e._v(" "),n("li",[n("code",[e._v("\\Illuminate\\Foundation\\Bootstrap\\LoadConfiguration")]),e._v(": load tất cả config vào instance "),n("code",[e._v("Illuminate\\Config\\Repository")]),e._v(". Trường hợp đã cache config (khi run "),n("code",[e._v("php artisan config:cache")]),e._v(") sẽ get tại file "),n("code",[e._v("cache/config.php")]),e._v(" còn không sẽ get tất cả file "),n("code",[e._v("*.php")]),e._v(" trong folder config.")]),e._v(" "),n("li",[n("code",[e._v("\\Illuminate\\Foundation\\Bootstrap\\HandleExceptions")]),e._v(": set các tham số môi trường liên quan đến handle exception...")]),e._v(" "),n("li",[n("code",[e._v("\\Illuminate\\Foundation\\Bootstrap\\RegisterFacades")]),e._v(": Đăng kí các facade alias cho các instance trong config "),n("code",[e._v("app.alias")]),e._v(". Chi tiết facade thì có thể xem tại "),n("a",{attrs:{href:"https://ninhnguyen22.github.io/blog/docs/nin/facade.html",target:"_blank",rel:"noopener noreferrer"}},[e._v("https://ninhnguyen22.github.io/blog/docs/nin/facade.html"),n("OutboundLink")],1)]),e._v(" "),n("li",[n("code",[e._v("\\Illuminate\\Foundation\\Bootstrap\\RegisterProviders::class")]),e._v(": Register các service provider. Chi tiết service provider xem "),n("a",{attrs:{href:"https://ninhnguyen22.github.io/blog/docs/nin/service-provider.html",target:"_blank",rel:"noopener noreferrer"}},[e._v("https://ninhnguyen22.github.io/blog/docs/nin/service-provider.html"),n("OutboundLink")],1)]),e._v(" "),n("li",[n("code",[e._v("\\Illuminate\\Foundation\\Bootstrap\\BootProviders")]),e._v(": Binding các class liên quan của provider hoặc các xử lí riêng của provider.")])])]),e._v(" "),n("li",[n("p",[e._v("Define các middleware cho route. Có 3 loại Glocal middleware($middleware), middleware group($middlewareGroups) và middleware route($routeMiddleware). Sử dụng Pipeline, xử lí request với từng middleware.")])]),e._v(" "),n("li",[n("p",[e._v("Nếu pass qua các middleware. Laravel xử lí make controller trong container và call method của controller tương ứng với request.")])])])]),e._v(" "),n("li",[n("p",[e._v("Console Kernel: to be continue..")])])])])}),[],!1,null,null,null);t.default=a.exports}}]);
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require("./main");
require("select2");
require("./bootstrap");

window.Vue = require("vue");

const Swal = require("sweetalert2");

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component("spare-po", require("./components/spare/po/SparePO.vue").default);
Vue.component(
    "spare-grn",
    require("./components/spare/grn/SpareGrn.vue").default
);
Vue.component(
    "spare-invoice",
    require("./components/spare/invoice/SpareInvoice.vue").default
);
Vue.component(
    "spare-gin",
    require("./components/spare/gin/SpareGin.vue").default
);
Vue.component("spare-dn", require("./components/spare/dn/SpareDn.vue").default);
Vue.component(
    "spare-grf",
    require("./components/spare/grf/SpareGrf.vue").default
);
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: "#app"
});

var $ = require("jquery");
$.fn.select2.defaults.set("theme", "bootstrap4");
$(function() {
    $(".delete").submit(function(event) {
        event.preventDefault();
        var form = this;
        Swal.fire({
            title: "Are you sure?",
            text: "You will not be able to recover this Record!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Yes, delete it!",
            cancelButtonText: "No, keep it"
        }).then(result => {
            if (result.value) {
                form.submit(); // <--- submit form programmatically
            } else if (result.dismiss === Swal.DismissReason.cancel) {
                Swal.fire("Cancelled", "Your Record is safe :)", "error");
            }
        });
    });

    $(".dynamic").change(function() {
        if ($(this).val() != "") {
            var select = $(this).attr("id");
            var value = $(this).val();
            var dependent = $(this).data("dependent");
            var route = $(this).data("route");
            var hold = $(this).data("hold");
            var _token = $('input[name="_token"]').val();
            $("#" + dependent)
                .empty()
                .trigger("change");
            var selected = $("#" + dependent)
                .select2({
                    placeholder: hold
                })
                .trigger("change");
            $.ajax({
                url: route,
                method: "POST",
                dataType: "json",
                data: {
                    select: select,
                    value: value,
                    _token: _token,
                    dependent: dependent
                },
                success: function(results) {
                    selected.select2({
                        data: results
                    });
                }
            });
        }
    });
});

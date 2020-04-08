<template>
    <div>
        <form
            id="signupForm"
            class="col-md-12 mx-auto"
            method="post"
            action=""
            novalidate
            @submit.prevent="onSubmit"
        >
            <div class="row">
                <div class="col-md-6">
                    <div
                        :class="{
                            'is-error': errors.spare_gin_id
                        }"
                    >
                        <v-select
                            v-model="property.spare_gin_id"
                            placeholder="Select GIN"
                            label="gin_label"
                            :options="gins"
                            :reduce="gin => gin.id"
                            @input="loadInvoice"
                        />
                    </div>
                </div>
                <div class=" col-lg-6">
                    <div>
                        DN Date
                        <date-picker
                            v-model="property.date"
                            valueType="format"
                        ></date-picker>
                    </div>
                    <span v-if="errors.date" class="text-danger" role="alert">
                        <span>{{ errors.date.join(", ") }}</span>
                    </span>
                </div>
            </div>
            <br />
            <div v-if="Object.keys(invoice).length !== 0">
                <table class="mb-0 table">
                    <thead>
                        <tr>
                            <th>Gin #</th>
                            <th>Gin Date</th>
                            <th>Gin Remarks</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ gin.id }}</td>
                            <td>{{ gin.date }}</td>
                            <td>{{ gin.remarks }}</td>
                        </tr>
                    </tbody>
                </table>

                <table class="mb-0 table">
                    <thead>
                        <tr>
                            <th>Invoice # {{ invoice.invoice_type_no }}</th>
                            <th>Invoice Date</th>
                            <th>Cus Type: {{ invoice.customer_type_no }}</th>
                            <th>Invoice Remarks</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ gin.id }}</td>
                            <td>{{ invoice.date }}</td>
                            <td>
                                MR #: <b>{{ invoice.job_number }}</b> <br />JOB
                                #:
                                <b>{{ invoice.mr_number }}</b>
                            </td>
                            <td>{{ invoice.remarks }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="row" v-if="Object.keys(invoice).length !== 0">
                <div class="col-lg-12">
                    <table class="table table-bordered form-group">
                        <thead>
                            <tr>
                                <th>Item Name</th>
                                <th style="width: 15%">Rate</th>
                                <th style="width: 5%">Quantity</th>
                                <th style="width: 15%">Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr
                                :key="index"
                                v-for="(data, index) in invoice.items"
                            >
                                <td>{{ data.spare_name }}</td>
                                <td>{{ data.rate }}</td>
                                <td>{{ data.quantity }}</td>
                                <td align="right">{{ data.amount }}</td>
                            </tr>
                            <tr>
                                <td style="" colspan="3" align="right">
                                    <b>SubTotal :</b>
                                </td>

                                <td align="right">
                                    {{ invoice.sub_total }}
                                </td>
                            </tr>
                            <tr v-if="invoice.discount">
                                <td style="" colspan="3" align="right">
                                    <b
                                        >Discount
                                        {{ invoice.discount_percentage }}%:</b
                                    >
                                </td>

                                <td align="right">
                                    {{ invoice.discount }}
                                </td>
                            </tr>
                            <tr>
                                <td style="" colspan="3" align="right">
                                    <b>NBT {{ invoice.nbt_percentage }}%:</b>
                                </td>

                                <td align="right">{{ invoice.nbt }}</td>
                            </tr>
                            <tr>
                                <td style="" colspan="3" align="right">
                                    <b>VAT {{ invoice.vat_percentage }}%:</b>
                                </td>

                                <td align="right">{{ invoice.vat }}</td>
                            </tr>
                            <tr>
                                <td style="" colspan="3" align="right">
                                    <b>Total Amount :</b>
                                </td>

                                <td align="right">
                                    {{ invoice.total_amount }}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group ">
                        <label for="remarks">Remarks</label>
                        <div>
                            <textarea
                                rows="3"
                                class="form-control autosize-input"
                                v-model="property.remarks"
                                placeholder="Enter Remarks..."
                            ></textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group ">
                        <button
                            type="submit"
                            class="btn btn-primary mt-2 btn-lg"
                            name="signup"
                            value="Sign up"
                        >
                            Save {{ btn_name }}
                        </button>
                        <a
                            v-if="property.id"
                            href=""
                            target="_blank"
                            class="btn btn-warning mt-2 btn-lg"
                            @click.prevent="printNow"
                        >
                            <i class="fa   fa-print fa-w-20"></i> Print
                            {{ btn_name }}
                        </a>
                        <a href="" class="btn btn-danger mt-2 btn-lg">
                            <i class="fa   fa-undo fa-w-20"></i> Reset
                            {{ btn_name }}
                        </a>
                    </div>
                </div>
            </div>
        </form>
    </div>
</template>

<script>
import DatePicker from "vue2-datepicker";
import VueSweetalert2 from "vue-sweetalert2";
// If you don't need the styles, do not connect
import "sweetalert2/dist/sweetalert2.min.css";
import "vue2-datepicker/index.css";

import vSelect from "vue-select";
import "vue-select/dist/vue-select.css";

Vue.use(VueSweetalert2);
export default {
    components: { DatePicker, vSelect },
    props: ["gins", "property_update"],
    methods: {
        printNow: function() {
            this.onSubmit();
            window.open(
                window.location.origin +
                    "/spareparts/spare_dn_print/" +
                    this.property.id,
                "_blank"
            );
        },
        loadInvoice: function(val) {
            this.gin = this.gins.filter(d => d.id == val)[0];
            let invoice_id = this.gin.spare_invoice.id;
            if (invoice_id > 0) {
                axios
                    .post("/api/spareparts/spare_invoice/get/" + invoice_id)
                    .then(res => {
                        if (res.data.success) {
                            this.invoice = res.data.invoice;
                        }
                    })
                    .catch(err => {
                        console.error(err);
                    });
            } else {
                this.$swal({
                    icon: "error",
                    title: "Invoice Number not Available",
                    text: "Please add Invoice"
                });
            }
        },

        onSubmit: function() {
            if (Object.keys(this.invoice).length === 0 && false) {
                this.$swal({
                    icon: "error",
                    title: "Invoice not selected",
                    text: "to save invoice need to be selected"
                });
            } else if (false) {
                this.$swal({
                    icon: "error",
                    title: "Item(s) Quantity Not Available",
                    text: "Please Check Red color Row"
                });
            } else {
                axios
                    .post("/api/spareparts/spare_dn/upsert", this.property)
                    .then(res => {
                        if (res.data.success) {
                            this.$swal({
                                position: "top-end",
                                icon: "success",
                                title: "Your work has been saved",
                                showConfirmButton: false,
                                timer: 1500
                            });
                            this.property = res.data.property;
                            this.spare_grns = [];
                        }
                    })
                    .catch(err => {
                        if (err.response.status == 422) {
                            this.errors = err.response.data.errors;
                            let msg = Object.values(err.response.data.errors);
                            this.errorMsg = [].concat.apply([], messages);
                        }
                    });
            }
        }
    },
    computed: {},
    mounted() {
        if (this.property_update) {
            this.property = this.property_update;
            this.property.invoice_type = parseInt(this.property.invoice_type);
            this.property.customer_type = parseInt(this.property.customer_type);
        }
    },
    data() {
        return {
            btn_name: "DN",
            gin: {},
            invoice: {},
            errorMsg: "",
            saveError: false,
            isActive: true,
            spare_grns: [],
            spare_parts_id: "",
            property: {
                spare_gin_id: "",
                date: new Date().toISOString().slice(0, 10),
                remarks: ""
            },

            errors: []
        };
    }
};
</script>

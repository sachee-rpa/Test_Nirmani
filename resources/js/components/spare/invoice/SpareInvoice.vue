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
                    <div class="form-group col-lg-12">
                        <div
                            :class="{
                                'is-error': errors.customer_id
                            }"
                        >
                            <label for="fk_supplier">Customer</label>
                            <v-select
                                v-model="property.customer_id"
                                placeholder="Select Customer"
                                label="name"
                                :options="customers"
                                :reduce="customer => customer.id"
                                @input="setDiscount"
                            />
                        </div>
                    </div>
                    <div class="form-group col-lg-6">
                        <label for="date">Date</label>
                        <div>
                            <date-picker
                                v-model="property.date"
                                valueType="format"
                            ></date-picker>
                        </div>
                        <span
                            v-if="errors.date"
                            class="text-danger"
                            role="alert"
                        >
                            <span>{{ errors.date.join(", ") }}</span>
                        </span>
                    </div>
                    <div class="form-group col-lg-12">
                        <label for="quotation_no">Invoice Type</label>
                        <div
                            :class="{
                                'is-error': errors.invoice_type
                            }"
                        >
                            <v-select
                                v-model="property.invoice_type"
                                placeholder="Select Invoice Type"
                                label="name"
                                :options="invoice_types"
                                :reduce="invoice_type => invoice_type.id"
                            />
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group col-lg-12">
                        <label for="quotation_no">Customer PO</label>
                        <div>
                            <v-select
                                v-model="property.customer_po_id"
                                placeholder="Customer PO"
                                label="id"
                                :options="customer_pos"
                                :reduce="customer_po => customer_po.id"
                            />
                        </div>
                    </div>
                    <div class="form-group col-lg-12">
                        <div
                            :class="{
                                'is-error': errors.customer_type
                            }"
                        >
                            <label for="fk_country">Customer Type</label>
                            <v-select
                                v-model="property.customer_type"
                                placeholder="Select Customer Type"
                                label="name"
                                :options="customer_types"
                                :reduce="customer_type => customer_type.id"
                            />
                            <span
                                v-if="errors.country_id"
                                class="invalid-feedback"
                                role="alert"
                            >
                                <strong>{{
                                    errors.country_id.join(", ")
                                }}</strong>
                            </span>
                        </div>
                    </div>
                    <div class="form-group col-lg-12">
                        <div class="row">
                            <div class="col-lg-6">
                                <input
                                    :class="{
                                        'is-invalid': errors.mr_number
                                    }"
                                    v-if="property.customer_type == 1"
                                    v-model="property.mr_number"
                                    type="number"
                                    class="form-control  "
                                    placeholder="MR Number"
                                    aria-label="Username"
                                    aria-describedby="basic-addon1"
                                />
                            </div>
                            <div class="col-lg-6">
                                <input
                                    :class="{
                                        'is-invalid': errors.job_number
                                    }"
                                    v-if="property.customer_type == 1"
                                    v-model="property.job_number"
                                    type="number"
                                    class="form-control  "
                                    placeholder="Job Number"
                                    aria-label="Username"
                                    aria-describedby="basic-addon1"
                                />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="accordion" class="accordion-wrapper mb-3">
                <div class="card">
                    <div id="headingOne" class="card-header">
                        <button
                            type="button"
                            data-toggle="collapse"
                            data-target="#collapseTwo"
                            aria-expanded="false"
                            aria-controls="collapseTwo"
                            class="text-left m-0 p-0 btn btn-link btn-block"
                        >
                            <span class="form-heading">Add Items</span>
                        </button>
                    </div>
                    <div
                        data-parent="#accordion"
                        id="collapseTwo"
                        aria-labelledby="headingOne"
                        class="collapse show"
                    >
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Item Name</th>
                                        <th>
                                            GRN
                                        </th>
                                        <th>SP</th>
                                        <th>Quantity</th>
                                        <th>TSP</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td style="width:30%">
                                            <v-select
                                                :class="{
                                                    'is-invalid':
                                                        errorRefs.invalid_spare_grn_item_id
                                                }"
                                                v-model="spare_parts_id"
                                                placeholder="Select Sparepart"
                                                label="name"
                                                :options="spareparts"
                                                :reduce="
                                                    sparepart => sparepart.id
                                                "
                                                @input="loadGRN"
                                            />
                                        </td>
                                        <td class="" style="width:30%">
                                            <v-select
                                                :class="{
                                                    'is-invalid':
                                                        errorRefs.invalid_spare_grn_item_id
                                                }"
                                                v-model="
                                                    item.spare_grn_items_id
                                                "
                                                placeholder="Select Stock ?"
                                                label="label"
                                                :options="spare_grns"
                                                :reduce="
                                                    spare_grn => spare_grn.id
                                                "
                                                @input="selectItem"
                                            />
                                        </td>

                                        <td>
                                            <input
                                                :class="{
                                                    'is-invalid':
                                                        errorRefs.invalid_rate
                                                }"
                                                v-model="item.rate"
                                                type="text"
                                                class="form-control"
                                            />
                                        </td>
                                        <td class=" ">
                                            <input
                                                :class="{
                                                    'is-invalid':
                                                        errorRefs.invalid_quantity
                                                }"
                                                v-model="item.quantity"
                                                type="number"
                                                class="form-control"
                                                placeholder="Quantity"
                                                aria-label="Username"
                                                aria-describedby="basic-addon1"
                                            />
                                        </td>
                                        <td>
                                            <input
                                                v-model="amount"
                                                type="text"
                                                class="form-control"
                                                disabled
                                            />
                                        </td>

                                        <td>
                                            <button
                                                type="button"
                                                title=""
                                                data-placement="bottom"
                                                class="btn-shadow mr-3 btn btn-success"
                                                data-original-title="Example Tooltip"
                                                @click.prevent="addItems"
                                            >
                                                <i class="fa fa-plus"></i>
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <table class="table table-bordered form-group">
                        <thead>
                            <tr>
                                <th>Item Name</th>

                                <th style="width: 15%">Rate</th>
                                <th style="width: 5%">Quantity</th>
                                <th style="width: 15%">Amount</th>
                                <th style="width: 5%"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr
                                :key="index"
                                v-for="(data, index) in property.items"
                                :class="{
                                    red: data.qtyerror
                                }"
                            >
                                <td>
                                    {{ data.qtyerror }}
                                    {{
                                        spareparts.filter(
                                            d => d.id == data.spare_parts_id
                                        )[0].name
                                    }}
                                </td>
                                <td>{{ data.rate }}</td>
                                <td>
                                    {{ data.quantity }}
                                </td>
                                <td align="right">{{ data.amount }}</td>
                                <td>
                                    <button
                                        @click.prevent="removeItem(index)"
                                        class="mb-2 mr-2 btn btn-shadow btn-danger"
                                    >
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td style="" colspan="3" align="right">
                                    <b>SubTotal :</b>
                                </td>

                                <td align="right">{{ sub_total }}</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td style="" colspan="3" align="right">
                                    <b
                                        >Discount
                                        {{
                                            this.property.discount_percentage
                                        }}%:</b
                                    >
                                </td>

                                <td align="right">
                                    {{ property.discount.toFixed(2) }}
                                </td>
                                <td></td>
                            </tr>
                            <tr>
                                <td style="" colspan="3" align="right">
                                    <b
                                        >NBT
                                        {{ this.property.nbt_percentage }}%:</b
                                    >
                                </td>

                                <td align="right">
                                    {{ property.nbt.toFixed(2) }}
                                </td>
                                <td></td>
                            </tr>
                            <tr>
                                <td style="" colspan="3" align="right">
                                    <b
                                        >VAT
                                        {{ this.property.vat_percentage }}%:</b
                                    >
                                </td>

                                <td align="right">
                                    {{ property.vat.toFixed(2) }}
                                </td>
                                <td></td>
                            </tr>
                            <tr
                                :class="{
                                    table_error: errors.total_amount
                                }"
                            >
                                <td style="" colspan="3" align="right">
                                    <span
                                        v-if="errors.total_amount"
                                        class="text-danger float-left"
                                        role="alert"
                                    >
                                        <strong>{{
                                            errors.total_amount.join(", ")
                                        }}</strong>
                                    </span>
                                    <b>Total Amount :</b>
                                </td>

                                <td align="right">
                                    {{ property.total_amount.toFixed(2) }}
                                </td>
                                <td></td>
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
                            Save Invoice
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
                            <i class="fa   fa-undo fa-w-20"></i> Reset property
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
    props: [
        "customers",
        "spareparts",
        "customer_pos",
        "nbt_percentage",
        "vat_percentage",
        "customer_types",
        "invoice_types",
        "property_update"
    ],
    methods: {
        printNow: function() {
            this.onSubmit();
            window.open(
                window.location.origin +
                    "/spareparts/spare_invoice_print/" +
                    this.property.id,
                "_blank"
            );
        },
        setDiscount: function(id) {
            if (this.property.customer_id > 0) {
                axios
                    .post("/api/customer/get/" + id)
                    .then(res => {
                        if (res.data.success) {
                            console.log(res.data.customer.discount);
                            this.property.discount_percentage =
                                res.data.customer.discount_spare;
                        }
                    })
                    .catch(err => {
                        console.error(err);
                    });
            } else {
                this.$swal({
                    icon: "error",
                    title: "PO Number not available",
                    text: "Please add po number"
                });
            }
        },
        selectItem: function(id) {
            if (this.item.spare_grn_items_id > 0) {
                let seletedGrn = this.spare_grns.filter(d => d.id == id)[0];
                this.item.rate = seletedGrn.unit_sell_price;
                this.item.spare_parts_id = seletedGrn.spare_parts_id;
                this.item.quantity = 1;
            }

            this.checkItem();
        },

        loadGRN: function() {
            if (this.spare_parts_id > 0) {
                axios
                    .post(
                        "/api/spareparts/spare_grn/get/" + this.spare_parts_id
                    )
                    .then(res => {
                        if (res.data.success) {
                            this.spare_grns = res.data.grn;
                        } else {
                            this.spare_grns = [];
                            this.item.spare_grn_items_id = "";
                            this.item.rate = 0;
                            this.item.quantity = 0;
                        }
                    })
                    .catch(err => {
                        console.error(err);
                    });
            } else {
                this.$swal({
                    icon: "error",
                    title: "PO Number not available",
                    text: "Please add po number"
                });
            }
        },

        onSubmit: function() {
            if (this.property.items.length == 0) {
                this.$swal({
                    icon: "error",
                    title: "Item(s) not available",
                    text: "to save at least add one item "
                });
            } else if (false) {
                this.$swal({
                    icon: "error",
                    title: "Item(s) Quantity Not Available",
                    text: "Please Check Red color Row"
                });
            } else {
                axios
                    .post("/api/spareparts/spare_invoice/upsert", this.property)
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
        },
        removeItem: function(index) {
            this.$swal({
                title: "Are you sure?",
                text: "You will not be able to recover this Record!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Yes, delete it!",
                cancelButtonText: "No, keep it"
            }).then(result => {
                if (result.value) {
                    let id = this.property.items[index].id;
                    if (id > 0) {
                        axios
                            .delete(
                                "/api/spareparts/spare_invoice/delete/" + id
                            )
                            .then(res => {
                                if (res.data.success) {
                                    this.$swal({
                                        position: "top-end",
                                        icon: "warning",
                                        title: "Your Record has been Removed",
                                        showConfirmButton: false,
                                        timer: 1500
                                    });
                                    this.property.items = res.data.items;
                                }
                            })
                            .catch(err => {
                                console.error(err);
                            });
                    }
                    this.property.items.splice(index, 1);
                } else if (result.dismiss) {
                    this.$swal("Cancelled", "Your Record is safe :)", "error");
                }
            });
        },
        addItems: function() {
            if (this.checkItemErrors()) {
                let item = {
                    spare_grn_items_id: this.item.spare_grn_items_id,
                    rate: this.item.rate,
                    quantity: this.item.quantity,
                    amount: this.item.amount,
                    spare_parts_id: this.item.spare_parts_id,
                    qtyerror: false
                };
                this.property.items.push(item);
                this.item = {
                    spare_grn_items_id: "",
                    rate: "0",
                    quantity: "0",
                    amount: "0",
                    spare_parts_id: "",
                    qtyerror: false
                };
            }
        },
        checkItem() {
            if (this.item.spare_grn_items_id != "") {
                this.errorRefs.invalid_spare_grn_item_id = false;
            }
            if (this.item.rate != "") {
                this.errorRefs.invalid_rate = false;
            }
            if (this.item.quality != "") {
                this.errorRefs.invalid_quantity = false;
            }

            return true;
        },
        checkItemErrors() {
            let selectedGrn = this.spare_grns.filter(
                d => d.id == this.item.spare_grn_items_id
            )[0];
            let minSelPrice = selectedGrn.unit_sell_price;
            let maxQty = selectedGrn.available;

            if (this.item.spare_grn_items_id == "") {
                this.errorRefs.invalid_spare_grn_item_id = true;
                return false;
            }
            if (this.item.rate == "" || this.item.rate == "0") {
                this.errorRefs.invalid_rate = true;
                return false;
            }

            if (this.item.rate < minSelPrice) {
                this.errorRefs.invalid_rate = true;
                this.item.rate = minSelPrice;
                return false;
            }

            if (this.item.quantity > maxQty) {
                this.errorRefs.invalid_quantity = true;
                this.item.quantity = maxQty;
                return false;
            }

            if (this.item.quantity == "" || this.item.quantity == "0") {
                this.errorRefs.invalid_quantity = true;
                return false;
            }
            return true;
        }
    },
    computed: {
        amount: function() {
            this.item.amount = (this.item.rate * this.item.quantity).toFixed(2);
            return this.item.amount;
        },
        sub_total: function() {
            let toatalAmout = 0;
            if (this.property.items.length !== 0) {
                this.property.items.forEach(item => {
                    if (item.amount > 0) {
                        toatalAmout += isNaN(parseFloat(item.amount))
                            ? 0
                            : parseFloat(item.amount);
                    } else {
                        item.amount = 0;
                    }
                });
            }
            this.property.sub_total = toatalAmout;
            return toatalAmout.toFixed(2);
        },
        sub_total: function() {
            let toatalAmout = 0;
            if (this.property.items.length !== 0) {
                this.property.items.forEach(item => {
                    if (item.amount > 0) {
                        toatalAmout += isNaN(parseFloat(item.amount))
                            ? 0
                            : parseFloat(item.amount);
                    } else {
                        item.amount = 0;
                    }
                });
            }
            this.property.sub_total = toatalAmout;
            this.property.after_discount =
                toatalAmout -
                (toatalAmout * this.property.discount_percentage) / 100;
            this.property.discount = toatalAmout - this.property.after_discount;
            this.property.nbt = parseFloat(
                (this.property.after_discount * this.property.nbt_percentage) /
                    100
            );
            this.property.vat = parseFloat(
                ((this.property.after_discount + this.property.nbt) *
                    this.property.vat_percentage) /
                    100
            );
            this.property.total_amount = parseFloat(
                this.property.after_discount +
                    this.property.nbt +
                    this.property.vat
            );
            return this.property.sub_total.toFixed(2);
        }
    },
    mounted() {
        if (this.property_update) {
            this.property = this.property_update;
            this.property.invoice_type = parseInt(this.property.invoice_type);
            this.property.customer_type = parseInt(this.property.customer_type);
        }

        if (this.nbt_percentage > 0) {
            this.property.nbt_percentage = this.nbt_percentage;
        }

        if (this.vat_percentage > 0) {
            this.property.vat_percentage = this.vat_percentage;
        }
    },
    data() {
        return {
            errorMsg: "",
            saveError: false,
            isActive: true,
            spare_grns: [],
            spare_parts_id: "",
            property: {
                invoice_type: "",
                customer_id: "",
                customer_po_id: "",
                customer_type: "",
                mr_number: "",
                job_number: "",
                date: new Date().toISOString().slice(0, 10),
                remarks: "",
                vat_percentage: 0,
                nbt_percentage: 0,
                vat: 0,
                nbt: 0,
                sub_total: 0,
                after_discount: 0,
                discount_percentage: 0,
                discount: 0,
                total_amount: 0,
                items: []
            },
            item: {
                spare_grn_items_id: "",
                rate: 0,
                quantity: 0,
                amount: 0,
                qtyerror: false
            },
            errors: [],
            errorRefs: {
                invalid_spare_grn_item_id: false,
                invalid_rate: false,
                invalid_quantity: false,
                invalid_amount: false
            }
        };
    }
};
</script>

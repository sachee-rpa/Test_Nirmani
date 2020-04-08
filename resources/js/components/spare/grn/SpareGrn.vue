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
                                'is-error': errors.supplier_id
                            }"
                        >
                            <label for="fk_supplier">Supplier</label>
                            <v-select
                                v-model="property.supplier_id"
                                placeholder="Select Supplier"
                                label="name"
                                :options="suppliers"
                                :reduce="supplier => supplier.id"
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
                        <label for="quotation_no">Invoice No</label>
                        <div>
                            <input
                                type="text"
                                class="form-control "
                                placeholder="Enter Invoice No"
                                v-model="property.invoice_number"
                                :class="{
                                    'is-invalid': errors.invoice_number
                                }"
                            />
                            <span
                                v-if="errors.invoice_number"
                                class="invalid-feedback"
                                role="alert"
                            >
                                <strong>{{
                                    errors.invoice_number.join(", ")
                                }}</strong>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group col-lg-12">
                        <label for="quotation_no">PO Number</label>
                        <div>
                            <v-select
                                v-model="property.spare_po_id"
                                placeholder="PO Number"
                                label="id"
                                :options="spare_pos"
                                :reduce="spare_po => spare_po.id"
                                @input="loadPo"
                            />
                        </div>
                    </div>
                    <div class="form-group col-lg-12">
                        <div
                            :class="{
                                'is-error': errors.country_id
                            }"
                        >
                            <label for="fk_country">Country</label>
                            <v-select
                                v-model="property.country_id"
                                placeholder="Select Country"
                                label="name"
                                :options="countries"
                                :reduce="country => country.id"
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
                                            Condition <br />
                                            Quality
                                        </th>
                                        <th>Currency <br />Quantity</th>

                                        <th>Amount</th>
                                        <th>SP {{ selling_percentage }}%</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td style="width:30%">
                                            <v-select
                                                :class="{
                                                    'is-invalid':
                                                        errorRefs.invalid_spare_parts_id
                                                }"
                                                v-model="item.spare_parts_id"
                                                placeholder="Select Sparepart"
                                                label="name"
                                                :options="spareparts"
                                                :reduce="
                                                    sparepart => sparepart.id
                                                "
                                                @input="checkItem"
                                            />
                                        </td>
                                        <td class="" style="width:15%">
                                            <v-select
                                                :class="{
                                                    'is-invalid':
                                                        errorRefs.invalid_condition
                                                }"
                                                v-model="item.condition"
                                                placeholder="Condition ?"
                                                label="name"
                                                :options="conditions"
                                                :reduce="
                                                    condition => condition.id
                                                "
                                                @input="checkItem"
                                            />
                                            <v-select
                                                :class="{
                                                    'is-invalid':
                                                        errorRefs.invalid_quality
                                                }"
                                                v-model="item.quality"
                                                placeholder="Quality ?"
                                                label="name"
                                                :options="qualities"
                                                :reduce="quality => quality.id"
                                                @input="checkItem"
                                            />
                                            <v-select
                                                :class="{
                                                    'is-invalid':
                                                        errorRefs.invalid_unit_id
                                                }"
                                                v-model="item.unit_id"
                                                placeholder="Unit ?"
                                                label="name"
                                                :options="units"
                                                :reduce="unit => unit.id"
                                                @input="checkItem"
                                            />
                                        </td>
                                        <td class="form-control">
                                            <div class="input-group ">
                                                <div
                                                    class="input-group-prepend"
                                                >
                                                    <select
                                                        :class="{
                                                            'is-invalid':
                                                                errorRefs.invalid_currency_id
                                                        }"
                                                        class="form-control"
                                                        v-model="
                                                            item.currency_id
                                                        "
                                                    >
                                                        <option
                                                            disabled
                                                            selected
                                                            value="0"
                                                            >$ ?</option
                                                        >
                                                        <option
                                                            v-for="currency in currencies"
                                                            :key="currency.id"
                                                            :value="currency.id"
                                                            >{{ currency.name }}
                                                        </option>
                                                    </select>
                                                </div>
                                                <input
                                                    :class="{
                                                        'is-invalid':
                                                            errorRefs.invalid_rate
                                                    }"
                                                    v-model="item.rate"
                                                    type="number"
                                                    class="form-control"
                                                    placeholder="Rate"
                                                    aria-label="Username"
                                                    aria-describedby="basic-addon1"
                                                />
                                            </div>

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
                                            <input
                                                v-model="sell_price"
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
                                <th>Currency</th>
                                <th>Quantity</th>
                                <th>Condition</th>
                                <th>Quality</th>
                                <th style="width:  15%">USP</th>
                                <th style="width:  8%">Amount</th>
                                <th style="width:  15%">SP</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr
                                :key="index"
                                v-for="(data, index) in property.items"
                            >
                                <td>
                                    {{
                                        spareparts.filter(
                                            d => d.id == data.spare_parts_id
                                        )[0].name
                                    }}
                                </td>
                                <td>
                                    {{
                                        currencies.filter(
                                            d => d.id == data.currency_id
                                        )[0].name
                                    }}

                                    {{ data.rate }}
                                </td>
                                <td>
                                    {{ data.quantity }}
                                    <span
                                        v-if="property.items[index].unit_id > 0"
                                    >
                                        {{
                                            units.filter(
                                                d => d.id == data.unit_id
                                            )[0].name
                                        }}
                                    </span>
                                    <v-select
                                        v-if="
                                            property.items[index].unit_id == ''
                                        "
                                        :class="{
                                            'is-invalid':
                                                errorRefs.invalid_unit_id
                                        }"
                                        v-model="property.items[index].unit_id"
                                        placeholder="Unit ?"
                                        label="name"
                                        :options="units"
                                        :reduce="unit => unit.id"
                                        @input="checkItem"
                                    />
                                </td>
                                <td>
                                    {{
                                        conditions.filter(
                                            d => d.id == data.condition
                                        )[0].name
                                    }}
                                </td>
                                <td>{{ qualities[data.quality].name }}</td>
                                <td>
                                    <input
                                        v-model="
                                            property.items[index]
                                                .unit_sell_price
                                        "
                                        type="text"
                                        class="form-control"
                                    />
                                </td>
                                <td>
                                    {{ property.items[index].amount }}
                                </td>
                                <td class="w20">
                                    <input
                                        v-model="
                                            property.items[index].sell_price
                                        "
                                        type="text"
                                        class="form-control"
                                    />
                                </td>
                                <td>
                                    <button
                                        @click.prevent="removeItem(index)"
                                        class="mb-2 mr-2 btn btn-shadow btn-danger"
                                    >
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                            <tr
                                :class="{
                                    table_error: errors.total_amount
                                }"
                                class=""
                            >
                                <td style="" colspan="6" align="right">
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
                                <td>{{ formatPrice(totalAmount) }}</td>
                                <td>{{ formatPrice(totalSellPrice) }}</td>
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
                            Save & GRN
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
        "suppliers",
        "countries",
        "spareparts",
        "currencies",
        "conditions",
        "qualities",
        "property_update",
        "units",
        "selling_percentage",
        "spare_pos"
    ],
    methods: {
        printNow: function() {
            this.onSubmit();
            window.open(
                window.location.origin +
                    "/spareparts/spare_gin_print/" +
                    this.property.id,
                "_blank"
            );
        },
        formatPrice: function(value) {
            let val = (value / 1).toFixed(2).replace(",", ".");
            return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        },

        loadPo: function() {
            if (this.property.spare_po_id > 0) {
                if (this.property.spare_po_id > 0) {
                    axios
                        .post(
                            "/api/spareparts/spare_po/get/" +
                                this.property.spare_po_id
                        )
                        .then(res => {
                            if (res.data.success) {
                                let po = res.data.po;
                                this.property.supplier_id = po.supplier_id;
                                this.property.spare_po_id = po.id;
                                this.property.country_id = po.country_id;
                                this.property.total_amount = po.total_amount;
                                this.property.items = [];
                                let sell_price = 0;
                                po.items.forEach(item => {
                                    let sellPrice =
                                        (item.amount / 100) *
                                        (100 +
                                            parseFloat(
                                                this.selling_percentage
                                            ));
                                    let poItem = {
                                        spare_parts_id: item.spare_parts_id,
                                        unit_id: "",
                                        currency_id: item.currency_id,
                                        rate: item.rate,
                                        quantity: item.quantity,
                                        quality: item.quality,
                                        condition: item.condition,
                                        amount: item.amount,
                                        sell_price: sellPrice
                                    };
                                    sell_price += sellPrice;
                                    this.property.items.push(poItem);
                                });
                                this.property.sell_price = sell_price;
                            }
                        })
                        .catch(err => {
                            console.error(err);
                        });
                }
            } else {
                this.$swal({
                    icon: "error",
                    title: "PO Number not available",
                    text: "Please add po number"
                });
            }
        },
        onSubmit: function() {
            let all_unit_add = true;
            this.property.items.forEach(item => {
                if (item.unit_id == "") {
                    all_unit_add = false;
                }
            });

            if (this.property.items.length == 0) {
                this.$swal({
                    icon: "error",
                    title: "Item(s) not available",
                    text: "to save at least add one item "
                });
            } else if (!all_unit_add) {
                this.$swal({
                    icon: "error",
                    title: "Item(s) Units Not Set",
                    text: "Please Set units For Items"
                });
            } else {
                axios
                    .post("/api/spareparts/spare_grn/upsert", this.property)
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
                            .delete("/api/spareparts/spare_grn/delete/" + id)
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
                let unit_sell_price = (
                    (this.item.rate / 100) *
                    (100 + parseFloat(this.selling_percentage))
                ).toFixed(2);
                let item = {
                    spare_parts_id: this.item.spare_parts_id,
                    currency_id: this.item.currency_id,
                    rate: this.item.rate,
                    quantity: this.item.quantity,
                    quality: this.item.quality,
                    condition: this.item.condition,
                    unit_sell_price: unit_sell_price,
                    amount: this.item.amount,
                    sell_price: this.item.sell_price,
                    unit_id: this.item.unit_id
                };
                this.property.items.push(item);
                this.item = {
                    spare_parts_id: "",
                    unit_id: "",
                    currency_id: "0",
                    rate: "",
                    quantity: "",
                    quality: "",
                    condition: "",
                    amount: "0",
                    sell_price: "0",
                    unit_sell_price: ""
                };
            }
        },
        checkItem() {
            if (this.item.spare_parts_id != "") {
                this.errorRefs.invalid_spare_parts_id = false;
            }
            if (this.item.condition != "") {
                this.errorRefs.invalid_condition = false;
            }
            if (this.item.quality != "") {
                this.errorRefs.invalid_quality = false;
            }
            if (this.item.unit_id != "") {
                this.errorRefs.invalid_unit_id = false;
            }
            return true;
        },
        checkItemErrors() {
            if (this.item.spare_parts_id == "") {
                this.errorRefs.invalid_spare_parts_id = true;
                return false;
            }
            if (this.item.condition == "") {
                this.errorRefs.invalid_condition = true;
                return false;
            }
            if (this.item.quality == "") {
                this.errorRefs.invalid_quality = true;
                return false;
            }
            if (this.item.unit_id == "") {
                this.errorRefs.invalid_unit_id = true;
                return false;
            }
            if (this.item.currency_id == "0") {
                this.errorRefs.invalid_currency_id = true;
                return false;
            }
            if (this.item.rate == "") {
                this.errorRefs.invalid_rate = true;
                return false;
            }
            if (this.item.quantity == "") {
                this.errorRefs.invalid_quantity = true;
                return false;
            }
            return true;
        }
    },
    computed: {
        sell_price: function() {
            this.item.unit_sell_price =
                (this.item.rate / 100) *
                (100 + parseFloat(this.selling_percentage));

            this.item.sell_price =
                this.item.unit_sell_price * this.item.quantity;
            this.item.sell_price = this.item.sell_price.toFixed(2);
            return this.item.sell_price;
        },
        amount: function() {
            this.item.amount = (this.item.rate * this.item.quantity).toFixed(2);
            return this.item.amount;
        },
        totalAmount: function() {
            let toatalAmout = 0;
            if (this.property.items.length !== 0) {
                this.property.items.forEach(item => {
                    if (item.amount > 0) {
                        toatalAmout += isNaN(parseFloat(item.amount))
                            ? 0
                            : parseFloat(item.amount);
                        item.sell_price = isNaN(parseFloat(item.rate))
                            ? 0
                            : item.unit_sell_price * item.quantity;
                    } else {
                        item.amount = 0;
                    }
                });
            }
            this.property.total_amount = toatalAmout;
            return toatalAmout.toFixed(2);
        },
        totalSellPrice: function() {
            let toatalSell = 0;
            if (this.property.items.length !== 0) {
                this.property.items.forEach(item => {
                    if (item.amount > 0) {
                        toatalSell += isNaN(parseFloat(item.unit_sell_price))
                            ? 0
                            : parseFloat(item.unit_sell_price) * item.quantity;
                    } else {
                        item.sell_price = 0;
                    }
                });
            }
            this.property.total_sell_amount = toatalSell;
            return toatalSell.toFixed(2);
        }
    },
    mounted() {
        if (this.property_update) {
            this.property = this.property_update;
        }
    },
    data() {
        return {
            errorMsg: "",
            isActive: true,
            property: {
                supplier_id: "",
                spare_po_id: "",
                invoice_number: "",
                country_id: "",
                date: new Date().toISOString().slice(0, 10),
                remarks: "",
                total_amount: 0,
                total_sell_amount: 0,
                items: []
            },
            item: {
                spare_parts_id: "",
                unit_id: "",
                currency_id: "0",
                rate: "",
                quantity: "",
                quality: "",
                condition: "",
                unit_sell_price: "",
                amount: "0",
                sell_price: "0"
            },
            errors: [],
            errorRefs: {
                invalid_spare_parts_id: false,
                invalid_currency_id: false,
                invalid_rate: false,
                invalid_quantity: false,
                invalid_quality: false,
                invalid_condition: false,
                invalid_amount: false,
                invalid_unit_id: false,
                invalid_sell_price: false
            }
        };
    }
};
</script>

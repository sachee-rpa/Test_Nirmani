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
                        <div>
                            <label for="fk_supplier">Supplier</label>
                            <select
                                class="form-control "
                                v-model="po.supplier_id"
                                placeholder="Enter Remarks..."
                                :class="{
                                    'is-invalid': errors.supplier_id
                                }"
                            >
                                <option disabled selected="selected" value="0"
                                    >Select Supplier</option
                                >
                                <option
                                    v-for="(supplier, index) in suppliers"
                                    :key="supplier.id"
                                    :value="supplier.id"
                                    >{{ supplier.name }}</option
                                >
                            </select>
                            <span
                                v-if="errors.supplier_id"
                                class="invalid-feedback"
                                role="alert"
                            >
                                <strong>{{
                                    errors.supplier_id.join(", ")
                                }}</strong>
                            </span>
                        </div>
                    </div>
                    <div class="form-group col-lg-6">
                        <label for="date">Date</label>
                        <div>
                            <date-picker
                                v-model="po.date"
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
                    <div class="form-group col-lg-6">
                        <label for="required_date">Required Date</label>
                        <div>
                            <date-picker
                                v-model="po.required_date"
                                valueType="format"
                            ></date-picker>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group col-lg-12">
                        <label for="quotation_no">Quotation No</label>
                        <div>
                            <input
                                type="text"
                                class="form-control "
                                placeholder="Enter Quotation No"
                                v-model="po.quote_number"
                                :class="{
                                    'is-invalid': errors.quote_number
                                }"
                            />
                            <span
                                v-if="errors.quote_number"
                                class="invalid-feedback"
                                role="alert"
                            >
                                <strong>{{
                                    errors.quote_number.join(", ")
                                }}</strong>
                            </span>
                        </div>
                    </div>
                    <div class="form-group col-lg-12">
                        <div>
                            <label for="fk_country">Country</label>
                            <select
                                class="form-control"
                                v-model="po.country_id"
                                :class="{
                                    'is-invalid': errors.country_id
                                }"
                            >
                                <option disabled selected value="0"
                                    >Select Country</option
                                >
                                <option
                                    v-for="(country, index) in countries"
                                    :key="country.id"
                                    :value="country.id"
                                    >{{ country.name }}</option
                                >
                            </select>
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
                                <th>Amount</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td style="width:40%">
                                    <select
                                        :class="{
                                            'is-invalid':
                                                errorRefs.invalid_spare_parts_id
                                        }"
                                        class="form-control"
                                        v-model="item.spare_parts_id"
                                    >
                                        <option disabled selected value="0"
                                            >Select Sparepart</option
                                        >
                                        <option
                                            v-for="(sparepart,
                                            index) in spareparts"
                                            :key="sparepart.id"
                                            :value="sparepart.id"
                                            >{{ sparepart.name }}</option
                                        >
                                    </select>
                                </td>
                                <td>
                                    <div class="input-group ">
                                        <div class="input-group-prepend">
                                            <select
                                                :class="{
                                                    'is-invalid':
                                                        errorRefs.invalid_currency_id
                                                }"
                                                class="form-control"
                                                v-model="item.currency_id"
                                            >
                                                <option
                                                    disabled
                                                    selected
                                                    value="0"
                                                    >Currency</option
                                                >
                                                <option
                                                    v-for="(currency,
                                                    index) in currencies"
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
                                </td>

                                <td>
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
                                    <select
                                        :class="{
                                            'is-invalid':
                                                errorRefs.invalid_condition
                                        }"
                                        class="form-control"
                                        v-model="item.condition"
                                    >
                                        <option disabled selected value="0"
                                            >Condition</option
                                        >
                                        <option
                                            v-for="(condition,
                                            index) in conditions"
                                            :key="index"
                                            :value="index"
                                            >{{ condition }}
                                        </option>
                                    </select>
                                </td>
                                <td>
                                    <select
                                        :class="{
                                            'is-invalid':
                                                errorRefs.invalid_quality
                                        }"
                                        class="form-control"
                                        v-model="item.quality"
                                    >
                                        <option disabled selected value="0"
                                            >Quality</option
                                        >
                                        <option
                                            v-for="(Quality,
                                            index) in Qualities"
                                            :key="index"
                                            :value="index"
                                            >{{ Quality }}
                                        </option>
                                    </select>
                                </td>
                                <td>
                                    <input
                                        v-model="amount"
                                        type="text"
                                        class="form-control"
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
                            <tr v-for="(data, index) in po.items">
                                <td>
                                    {{
                                        spareparts.filter(
                                            d => d.id === data.spare_parts_id
                                        )[0].name
                                    }}
                                </td>
                                <td>
                                    {{
                                        currencies.filter(
                                            d => d.id === data.currency_id
                                        )[0].name +
                                            " " +
                                            data.rate
                                    }}
                                </td>
                                <td>{{ data.quantity }}</td>
                                <td>{{ conditions[data.condition] }}</td>
                                <td>{{ Qualities[data.quality] }}</td>
                                <td>{{ formatPrice(data.amount) }}</td>
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
                                <td style="" colspan="5" align="right">
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
                                <td colspan="2">
                                    {{ formatPrice(totalAmount) }}
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
                                v-model="po.remarks"
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
                            Save Purches Order
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
                            <i class="fa   fa-undo fa-w-20"></i> Reset PO
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
Vue.use(VueSweetalert2);
export default {
    components: { DatePicker },
    props: [
        "suppliers",
        "countries",
        "spareparts",
        "currencies",
        "conditions",
        "Qualities",
        "po_update"
    ],
    methods: {
        printNow: function() {
            this.onSubmit();
            window.open(
                window.location.origin +
                    "/spareparts/spare_po_print/" +
                    this.po.id,
                "_blank"
            );
        },
        formatPrice: function(value) {
            let val = (value / 1).toFixed(2).replace(",", ".");
            return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        },

        onSubmit: function() {
            if (this.po.items.length == 0) {
                this.$swal({
                    icon: "error",
                    title: "Item(s) not available",
                    text: "to save at least add one item "
                });
            } else {
                axios
                    .post("/api/spareparts/spare_po/upsert", this.po)
                    .then(res => {
                        if (res.data.success) {
                            this.$swal({
                                position: "top-end",
                                icon: "success",
                                title: "Your work has been saved",
                                showConfirmButton: false,
                                timer: 1500
                            });
                            this.po = res.data.po;
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
                    let id = this.po.items[index].id;
                    if (id > 0) {
                        axios
                            .delete("/api/spareparts/spare_po/delete/" + id)
                            .then(res => {
                                if (res.data.success) {
                                    this.$swal({
                                        position: "top-end",
                                        icon: "warning",
                                        title: "Your Record has been Removed",
                                        showConfirmButton: false,
                                        timer: 1500
                                    });
                                    this.po.items = res.data.items;
                                }
                            })
                            .catch(err => {
                                console.error(err);
                            });
                    }
                    this.po.items.splice(index, 1);
                } else if (result.dismiss) {
                    this.$swal("Cancelled", "Your Record is safe :)", "error");
                }
            });
        },
        addItems: function() {
            if (this.checkItemErrors()) {
                let item = {
                    spare_parts_id: this.item.spare_parts_id,
                    currency_id: this.item.currency_id,
                    rate: this.item.rate,
                    quantity: this.item.quantity,
                    quality: this.item.quality,
                    condition: this.item.condition,
                    amount: this.item.amount
                };
                this.po.items.push(item);
                this.item = {
                    spare_parts_id: "0",
                    currency_id: "0",
                    rate: "",
                    quantity: "",
                    quality: "0",
                    condition: "0",
                    amount: ""
                };
            }
        },

        checkItemErrors() {
            if (this.item.spare_parts_id == "0") {
                this.errorRefs.invalid_spare_parts_id = true;
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
            if (this.item.condition == "0") {
                this.errorRefs.invalid_condition = true;
                return false;
            }
            if (this.item.quality == "0") {
                this.errorRefs.invalid_quality = true;
                return false;
            }

            return true;
        }
    },
    computed: {
        amount: function() {
            this.item.amount = this.item.rate * this.item.quantity;
            return this.item.amount;
        },
        totalAmount: function() {
            let toatalAmout = 0;
            this.po.items.forEach(item => {
                toatalAmout += item.amount;
            });
            this.po.total_amount = toatalAmout;
            return toatalAmout;
        }
    },
    mounted() {
        if (this.po_update) {
            this.po = this.po_update;
        }
    },
    data() {
        return {
            errorMsg: "",
            isActive: true,
            po: {
                supplier_id: "0",
                country_id: "0",
                date: new Date().toISOString().slice(0, 10),
                required_date: new Date().toISOString().slice(0, 10),
                quote_number: "",
                remarks: "",
                total_amount: 0,
                items: []
            },
            item: {
                spare_parts_id: "0",
                currency_id: "0",
                rate: "",
                quantity: "",
                quality: "0",
                condition: "0",
                amount: ""
            },
            errors: [],
            errorRefs: {
                invalid_spare_parts_id: false,
                invalid_currency_id: false,
                invalid_rate: false,
                invalid_quantity: false,
                invalid_quality: false,
                invalid_condition: false,
                invalid_amount: false
            }
        };
    }
};
</script>

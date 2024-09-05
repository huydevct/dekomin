<template>
    <div class="container-fluid p-3">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex">
                        <h3 class="card-title">
                            {{
                                product
                                    ? "Cập nhật product: " + product.id
                                    : "Tạo mới product"
                            }}
                        </h3>
                    </div>
                    <div class="card-body">
                        <div class="col-md-12 row">
                            <input type="hidden" name="_token" :value="this.csrf_token" />
                            <div class="col-md-4">
                                <div :class="{
                                'form-group': true,
                                'is-invalid':
                                    typeof form_error.name !=
                                    'undefined',
                            }">
                                    <label>Name</label>
                                    <span style="color: red">*</span>
                                    <input class="form-control" :class="{
                                'is-invalid':
                                    typeof form_error.name !=
                                    'undefined',
                            }" type="text" name="name" v-model="form_data.name" required />
                                    <span v-if="typeof form_error.name !=
                                'undefined'
                                " class="error invalid-feedback">
                                        {{ form_error.name.join(", ") }}
                                    </span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label :class="{
                                'is-invalid':
                                    typeof form_error.categories !=
                                    'undefined',
                            }">Categories</label><span style="color: red">*</span>
                                    <Multiselect :multiple="true" :close-on-select="true" v-model="form_data.categories"
                                        :taggable="true" open-direction="bottom" @tag="addCategory" label="name"
                                        track-by="name" :options="category_select">
                                    </Multiselect>
                                    <span v-if="typeof form_error.categories !=
                                'undefined'
                                " class="error invalid-feedback">
                                        {{ form_error.categories.join(", ") }}
                                    </span>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div :class="{
                                'form-group': true,
                                'is-invalid':
                                    typeof form_error.description !=
                                    'undefined',
                            }">
                                    <label>Description</label>
                                    <span style="color: red">*</span>
                                    <div>
                                        <textarea id="mytextarea"></textarea>
                                    </div>

                                    <!-- <textarea
                                        class="form-control"
                                        :class="{
                                            'is-invalid':
                                                typeof form_error.description !=
                                                'undefined',
                                        }"
                                        type="text"
                                        name="name"
                                        v-model="form_data.description"
                                        required
                                    /> -->
                                    <span v-if="typeof form_error.description !=
                                'undefined'
                                " class="error invalid-feedback">
                                        {{ form_error.description.join(", ") }}
                                    </span>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div :class="{
                                'form-group': true,
                                'is-invalid':
                                    typeof form_error.note !=
                                    'undefined',
                            }">
                                    <label>Note</label>
                                    <span style="color: red">*</span>
                                    <div>
                                        <textarea id="mytextarea_note"></textarea>
                                    </div>
<!--                                    <input class="form-control" :class="{-->
<!--                                'is-invalid':-->
<!--                                    typeof form_error.description_vi !=-->
<!--                                    'undefined',-->
<!--                            }" type="text" name="title" v-model="form_data.description_vi" required />-->
                                    <span v-if="typeof form_error.note !=
                                'undefined'
                                " class="error invalid-feedback">
                                        {{ form_error.note.join(", ") }}
                                    </span>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div :class="{
                                'form-group': true,
                                'is-invalid':
                                    typeof form_error.uses !=
                                    'undefined',
                            }">
                                    <label>Uses</label>
                                    <span style="color: red">*</span>
                                    <div>
                                        <textarea id="mytextarea_uses"></textarea>
                                    </div>
<!--                                    <input class="form-control" :class="{-->
<!--                                'is-invalid':-->
<!--                                    typeof form_error.description_zh !=-->
<!--                                    'undefined',-->
<!--                            }" type="text" name="title" v-model="form_data.description_zh" required />-->
                                    <span v-if="typeof form_error.uses !=
                                'undefined'
                                " class="error invalid-feedback">
                                        {{ form_error.uses.join(", ") }}
                                    </span>
                                </div>
                            </div>


                            <input v-for="(category, index) in form_data.categories" :key="`category_${index}`"
                                type="hidden" name="categories[]" :value="category.name" />
                            <div class="col-md-4">
                                <div :class="{
                                'form-group': true,
                            }">
                                    <label :class="{
                                'is-invalid':
                                    typeof form_error.order !=
                                    'undefined',
                            }">Order</label>
                                    <input class="form-control" type="number" name="order" v-model="form_data.order" />
                                    <span v-if="typeof form_error.order !=
                                'undefined'
                                " class="error invalid-feedback">
                                        {{ form_error.order.join(", ") }}
                                    </span>
                                </div>
                            </div>
<!--                            <div class="col-md-6">-->
<!--                                <div class="form-group">-->
<!--                                    <label>Product Parent</label-->
<!--                                    >-->
<!--                                    <select-->
<!--                                        name="parent_id"-->
<!--                                        :class="{-->
<!--                                            'form-control': true,-->
<!--                                            'is-invalid':-->
<!--                                                typeof form_error.parent_id !=-->
<!--                                                'undefined',-->
<!--                                        }"-->
<!--                                        v-model="form_data.parent_id"-->
<!--                                    >-->
<!--                                        <option value="0">-->
<!--                                            Select Product-->
<!--                                        </option>-->
<!--                                        <option-->
<!--                                            v-for="sp_item in products"-->
<!--                                            :key="sp_item.id"-->
<!--                                            :value="sp_item.id"-->
<!--                                        >-->
<!--                                            {{ sp_item.title }}/{{sp_item.id}}-->
<!--                                        </option>-->
<!--                                    </select>-->
<!--                                    <span-->
<!--                                        v-if="-->
<!--                                            typeof form_error.parent_id !=-->
<!--                                            'undefined'-->
<!--                                        "-->
<!--                                        class="error invalid-feedback"-->
<!--                                    >-->
<!--                                        {{ form_error.parent_id.join(", ") }}-->
<!--                                    </span>-->
<!--                                </div>-->
<!--                            </div>-->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Subject Of Use</label
                                    >
                                    <select
                                        name="product_id"
                                        :class="{
                                            'form-control': true,
                                            'is-invalid':
                                                typeof form_error.subject_of_use !=
                                                'undefined',
                                        }"
                                        v-model="form_data.subject_of_use"
                                    >
                                        <option value="0">
                                            Select subject of use
                                        </option>
                                        <option value="1">Người già</option>
                                        <option value="2">Trẻ em</option>
                                        <option value="3">Người lớn</option>
                                    </select>
                                    <span
                                        v-if="
                                            typeof form_error.subject_of_use !=
                                            'undefined'
                                        "
                                        class="error invalid-feedback"
                                    >
                                        {{ form_error.subject_of_use.join(", ") }}
                                    </span>
                                </div>
                            </div>
<!--                            <div class="col-md-6">-->
<!--                                <div class="form-group">-->
<!--                                    <label>Package Type</label-->
<!--                                    >-->
<!--                                    <select-->
<!--                                        name="package_id"-->
<!--                                        :class="{-->
<!--                                            'form-control': true,-->
<!--                                            'is-invalid':-->
<!--                                                typeof form_error.package_id !=-->
<!--                                                'undefined',-->
<!--                                        }"-->
<!--                                        v-model="form_data.package_id"-->
<!--                                    >-->
<!--                                        <option value="0">-->
<!--                                            Select Package Type-->
<!--                                        </option>-->
<!--                                        <option-->
<!--                                            v-for="sp_item in packages"-->
<!--                                            :key="sp_item.PackageID"-->
<!--                                            :value="sp_item.PackageID"-->
<!--                                        >-->
<!--                                            {{ sp_item.PackageTypeName }}/{{sp_item.PackageID}}-->
<!--                                        </option>-->
<!--                                    </select>-->
<!--                                    <span-->
<!--                                        v-if="-->
<!--                                            typeof form_error.package_id !=-->
<!--                                            'undefined'-->
<!--                                        "-->
<!--                                        class="error invalid-feedback"-->
<!--                                    >-->
<!--                                        {{ form_error.package_id.join(", ") }}-->
<!--                                    </span>-->
<!--                                </div>-->
<!--                            </div>-->
                            <div class="col-md-4">
                                <div :class="{
                                'form-group': true,
                                'is-invalid':
                                    typeof form_error.sku !=
                                    'undefined',
                            }">
                                    <label>SKU</label>
                                    <span style="color: red">*</span>
                                    <input class="form-control" :class="{
                                'is-invalid':
                                    typeof form_error.sku !=
                                    'undefined',
                            }" type="text" name="sku" v-model="form_data.sku" required />
                                    <span v-if="typeof form_error.sku !=
                                'undefined'
                                " class="error invalid-feedback">
                                        {{ form_error.sku.join(", ") }}
                                    </span>
                                </div>
                            </div>
<!--                            <div class="col-md-4">-->
<!--                                <div :class="{-->
<!--                                'form-group': true,-->
<!--                            }">-->
<!--                                    <label :class="{-->
<!--                                'is-invalid':-->
<!--                                    typeof form_error.rating !=-->
<!--                                    'undefined',-->
<!--                            }">Rating</label>-->
<!--                                    <input class="form-control" type="number" name="rating"-->
<!--                                        v-model="form_data.rating" />-->
<!--                                    <span v-if="typeof form_error.rating !=-->
<!--                                'undefined'-->
<!--                                " class="error invalid-feedback">-->
<!--                                        {{ form_error.rating.join(", ") }}-->
<!--                                    </span>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="col-md-4">-->
<!--                                <div :class="{-->
<!--                                'form-group': true,-->
<!--                            }">-->
<!--                                    <label :class="{-->
<!--                                'is-invalid':-->
<!--                                    typeof form_error.price !=-->
<!--                                    'undefined',-->
<!--                            }">Price</label>-->
<!--                                    <input class="form-control" type="number" name="price" v-model="form_data.price" />-->
<!--                                    <span v-if="typeof form_error.price !=-->
<!--                                'undefined'-->
<!--                                " class="error invalid-feedback">-->
<!--                                        {{ form_error.price.join(", ") }}-->
<!--                                    </span>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="col-md-4">-->
<!--                                <div :class="{-->
<!--                                'form-group': true,-->
<!--                            }">-->
<!--                                    <label :class="{-->
<!--                                'is-invalid':-->
<!--                                    typeof form_error.price_sale !=-->
<!--                                    'undefined',-->
<!--                            }">Price Sale</label>-->
<!--                                    <input class="form-control" type="number" name="price_sale" v-model="form_data.price_sale" />-->
<!--                                    <span v-if="typeof form_error.price_sale !=-->
<!--                                'undefined'-->
<!--                                " class="error invalid-feedback">-->
<!--                                        {{ form_error.price_sale.join(", ") }}-->
<!--                                    </span>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="col-md-4">-->
<!--                                <div :class="{-->
<!--                                'form-group': true,-->
<!--                            }">-->
<!--                                    <label :class="{-->
<!--                                'is-invalid':-->
<!--                                    typeof form_error.sale_price !=-->
<!--                                    'undefined',-->
<!--                            }">Sale Price</label>-->
<!--                                    <input class="form-control" type="number" name="sale_price"-->
<!--                                        v-model="form_data.sale_price" />-->
<!--                                    <span v-if="typeof form_error.sale_price !=-->
<!--                                'undefined'-->
<!--                                " class="error invalid-feedback">-->
<!--                                        {{ form_error.sale_price.join(", ") }}-->
<!--                                    </span>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="col-md-4">-->
<!--                                <div :class="{-->
<!--                                'form-group': true,-->
<!--                            }">-->
<!--                                    <label :class="{-->
<!--                                'is-invalid':-->
<!--                                    typeof form_error.stock !=-->
<!--                                    'undefined',-->
<!--                            }">Stock</label>-->
<!--                                    <input class="form-control" type="number" name="stock"-->
<!--                                        v-model="form_data.stock" />-->
<!--                                    <span v-if="typeof form_error.stock !=-->
<!--                                'undefined'-->
<!--                                " class="error invalid-feedback">-->
<!--                                        {{ form_error.stock.join(", ") }}-->
<!--                                    </span>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="col-md-4">-->
<!--                                <div :class="{-->
<!--                                'form-group': true,-->
<!--                            }">-->
<!--                                    <label :class="{-->
<!--                                'is-invalid':-->
<!--                                    typeof form_error.stock_sold !=-->
<!--                                    'undefined',-->
<!--                            }">Stock Sold</label>-->
<!--                                    <input class="form-control" type="number" name="stock_sold"-->
<!--                                        v-model="form_data.stock_sold" />-->
<!--                                    <span v-if="typeof form_error.stock_sold !=-->
<!--                                'undefined'-->
<!--                                " class="error invalid-feedback">-->
<!--                                        {{ form_error.stock_sold.join(", ") }}-->
<!--                                    </span>-->
<!--                                </div>-->
<!--                            </div>-->

                            <div class="col-md-4">
                                <div :class="{
                                'form-group': true,
                            }">
                                    <label :class="{
                                'is-invalid':
                                    typeof form_error.brand !=
                                    'undefined',
                            }">Brand</label>
                                    <input class="form-control" type="text" name="brand"
                                           v-model="form_data.brand" />
                                    <span v-if="typeof form_error.brand !=
                                'undefined'
                                " class="error invalid-feedback">
                                        {{ form_error.brand.join(", ") }}
                                    </span>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div :class="{
                                'form-group': true,
                            }">
                                    <label :class="{
                                'is-invalid':
                                    typeof form_error.rate !=
                                    'undefined',
                            }">Rate</label>
                                    <input class="form-control" type="number" name="rate" step="0.01"
                                           v-model="form_data.rate" />
                                    <span v-if="typeof form_error.rate !=
                                'undefined'
                                " class="error invalid-feedback">
                                        {{ form_error.rate.join(", ") }}
                                    </span>
                                </div>
                            </div>

<!--                            <div class="col-md-4">-->
<!--                                <div :class="{-->
<!--                                'form-group': true,-->
<!--                            }">-->
<!--                                    <label :class="{-->
<!--                                'is-invalid':-->
<!--                                    typeof form_error.weight !=-->
<!--                                    'undefined',-->
<!--                            }">Weight</label>-->
<!--                                    <input class="form-control" type="number" name="weight" step="0.01"-->
<!--                                           v-model="form_data.weight" />-->
<!--                                    <span v-if="typeof form_error.weight !=-->
<!--                                'undefined'-->
<!--                                " class="error invalid-feedback">-->
<!--                                        {{ form_error.weight.join(", ") }}-->
<!--                                    </span>-->
<!--                                </div>-->
<!--                            </div>-->

<!--                            <div class="col-md-4">-->
<!--                                <div :class="{-->
<!--                                'form-group': true,-->
<!--                            }">-->
<!--                                    <label :class="{-->
<!--                                'is-invalid':-->
<!--                                    typeof form_error.weight_unit !=-->
<!--                                    'undefined',-->
<!--                            }">Weight Unit</label>-->
<!--                                    <input class="form-control" type="text" name="weight_unit"-->
<!--                                           v-model="form_data.weight_unit" />-->
<!--                                    <span v-if="typeof form_error.weight_unit !=-->
<!--                                'undefined'-->
<!--                                " class="error invalid-feedback">-->
<!--                                        {{ form_error.flavour.join(", ") }}-->
<!--                                    </span>-->
<!--                                </div>-->
<!--                            </div>-->

<!--                            <div class="col-md-4">-->
<!--                                <div :class="{-->
<!--                                'form-group': true,-->
<!--                            }">-->
<!--                                    <label :class="{-->
<!--                                'is-invalid':-->
<!--                                    typeof form_error.length !=-->
<!--                                    'undefined',-->
<!--                            }">Length</label>-->
<!--                                    <input class="form-control" type="number" name="length" step="0.01"-->
<!--                                           v-model="form_data.length" />-->
<!--                                    <span v-if="typeof form_error.length !=-->
<!--                                'undefined'-->
<!--                                " class="error invalid-feedback">-->
<!--                                        {{ form_error.length.join(", ") }}-->
<!--                                    </span>-->
<!--                                </div>-->
<!--                            </div>-->

<!--                            <div class="col-md-4">-->
<!--                                <div :class="{-->
<!--                                'form-group': true,-->
<!--                            }">-->
<!--                                    <label :class="{-->
<!--                                'is-invalid':-->
<!--                                    typeof form_error.height !=-->
<!--                                    'undefined',-->
<!--                            }">Height</label>-->
<!--                                    <input class="form-control" type="number" name="height" step="0.01"-->
<!--                                           v-model="form_data.height" />-->
<!--                                    <span v-if="typeof form_error.height !=-->
<!--                                'undefined'-->
<!--                                " class="error invalid-feedback">-->
<!--                                        {{ form_error.height.join(", ") }}-->
<!--                                    </span>-->
<!--                                </div>-->
<!--                            </div>-->

<!--                            <div class="col-md-4">-->
<!--                                <div :class="{-->
<!--                                'form-group': true,-->
<!--                            }">-->
<!--                                    <label :class="{-->
<!--                                'is-invalid':-->
<!--                                    typeof form_error.width !=-->
<!--                                    'undefined',-->
<!--                            }">Width</label>-->
<!--                                    <input class="form-control" type="number" name="width" step="0.01"-->
<!--                                           v-model="form_data.width" />-->
<!--                                    <span v-if="typeof form_error.width !=-->
<!--                                'undefined'-->
<!--                                " class="error invalid-feedback">-->
<!--                                        {{ form_error.width.join(", ") }}-->
<!--                                    </span>-->
<!--                                </div>-->
<!--                            </div>-->

<!--                            <div class="col-md-4">-->
<!--                                <div :class="{-->
<!--                                'form-group': true,-->
<!--                            }">-->
<!--                                    <label :class="{-->
<!--                                'is-invalid':-->
<!--                                    typeof form_error.box_width !=-->
<!--                                    'undefined',-->
<!--                            }">Box Width</label>-->
<!--                                    <input class="form-control" type="number" name="box_width" step="0.01"-->
<!--                                           v-model="form_data.box_width" />-->
<!--                                    <span v-if="typeof form_error.box_width !=-->
<!--                                'undefined'-->
<!--                                " class="error invalid-feedback">-->
<!--                                        {{ form_error.box_width.join(", ") }}-->
<!--                                    </span>-->
<!--                                </div>-->
<!--                            </div>-->

<!--                            <div class="col-md-4">-->
<!--                                <div :class="{-->
<!--                                'form-group': true,-->
<!--                            }">-->
<!--                                    <label :class="{-->
<!--                                'is-invalid':-->
<!--                                    typeof form_error.width !=-->
<!--                                    'undefined',-->
<!--                            }">Box Height</label>-->
<!--                                    <input class="form-control" type="number" name="box_height" step="0.01"-->
<!--                                           v-model="form_data.box_height" />-->
<!--                                    <span v-if="typeof form_error.box_height !=-->
<!--                                'undefined'-->
<!--                                " class="error invalid-feedback">-->
<!--                                        {{ form_error.box_height.join(", ") }}-->
<!--                                    </span>-->
<!--                                </div>-->
<!--                            </div>-->

<!--                            <div class="col-md-4">-->
<!--                                <div :class="{-->
<!--                                'form-group': true,-->
<!--                            }">-->
<!--                                    <label :class="{-->
<!--                                'is-invalid':-->
<!--                                    typeof form_error.box_length !=-->
<!--                                    'undefined',-->
<!--                            }">Box Length</label>-->
<!--                                    <input class="form-control" type="number" name="box_length" step="0.01"-->
<!--                                           v-model="form_data.box_length" />-->
<!--                                    <span v-if="typeof form_error.box_length !=-->
<!--                                'undefined'-->
<!--                                " class="error invalid-feedback">-->
<!--                                        {{ form_error.box_length.join(", ") }}-->
<!--                                    </span>-->
<!--                                </div>-->
<!--                            </div>-->

<!--                            <div class="col-md-4">-->
<!--                                <div :class="{-->
<!--                                'form-group': true,-->
<!--                            }">-->
<!--                                    <label :class="{-->
<!--                                'is-invalid':-->
<!--                                    typeof form_error.box_count !=-->
<!--                                    'undefined',-->
<!--                            }">Box Count</label>-->
<!--                                    <input class="form-control" type="number" name="box_count"-->
<!--                                           v-model="form_data.box_count" />-->
<!--                                    <span v-if="typeof form_error.box_count !=-->
<!--                                'undefined'-->
<!--                                " class="error invalid-feedback">-->
<!--                                        {{ form_error.box_count.join(", ") }}-->
<!--                                    </span>-->
<!--                                </div>-->
<!--                            </div>-->

<!--                            <div class="col-md-4">-->
<!--                                <div :class="{-->
<!--                                'form-group': true,-->
<!--                            }">-->
<!--                                    <label :class="{-->
<!--                                'is-invalid':-->
<!--                                    typeof form_error.flavour !=-->
<!--                                    'undefined',-->
<!--                            }">Flavour</label>-->
<!--                                    <input class="form-control" type="text" name="flavour"-->
<!--                                           v-model="form_data.flavour" />-->
<!--                                    <span v-if="typeof form_error.flavour !=-->
<!--                                'undefined'-->
<!--                                " class="error invalid-feedback">-->
<!--                                        {{ form_error.flavour.join(", ") }}-->
<!--                                    </span>-->
<!--                                </div>-->
<!--                            </div>-->

<!--                            <div class="col-md-4">-->
<!--                                <div :class="{-->
<!--                                'form-group': true,-->
<!--                            }">-->
<!--                                    <label :class="{-->
<!--                                'is-invalid':-->
<!--                                    typeof form_error.tax_gst !=-->
<!--                                    'undefined',-->
<!--                            }">Tax GST</label>-->
<!--                                    <input class="form-control" type="number" name="tax_gst" step="0.01"-->
<!--                                           v-model="form_data.tax_gst" />-->
<!--                                    <span v-if="typeof form_error.tax_gst !=-->
<!--                                'undefined'-->
<!--                                " class="error invalid-feedback">-->
<!--                                        {{ form_error.tax_gst.join(", ") }}-->
<!--                                    </span>-->
<!--                                </div>-->
<!--                            </div>-->

<!--                            <div class="col-md-4">-->
<!--                                <div :class="{-->
<!--                                'form-group': true,-->
<!--                            }">-->
<!--                                    <label :class="{-->
<!--                                'is-invalid':-->
<!--                                    typeof form_error.tax_pst !=-->
<!--                                    'undefined',-->
<!--                            }">Tax PST</label>-->
<!--                                    <input class="form-control" type="number" name="tax_pst" step="0.01"-->
<!--                                           v-model="form_data.tax_pst" />-->
<!--                                    <span v-if="typeof form_error.tax_pst !=-->
<!--                                'undefined'-->
<!--                                " class="error invalid-feedback">-->
<!--                                        {{ form_error.tax_pst.join(", ") }}-->
<!--                                    </span>-->
<!--                                </div>-->
<!--                            </div>-->

                            <div class="col-md-12 d-flex">
                                <div class="col-md-2 align-items-end">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" v-model="form_data.active"
                                            id="active" name="active" />
                                        <label class="form-check-label" for="active">
                                            Active
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" v-model="form_data.is_recommend"
                                            id="is_recommend" />
                                        <label class="form-check-label" for="is_recommend">
                                            Is Recommend
                                        </label>
                                    </div>
                                </div>
<!--                                <div class="col-md-2">-->
<!--                                    <div class="form-check">-->
<!--                                        <input class="form-check-input" type="checkbox" v-model="form_data.is_sale"-->
<!--                                            id="is_sale" />-->
<!--                                        <label class="form-check-label" for="is_sale">-->
<!--                                            Is Sale-->
<!--                                        </label>-->
<!--                                    </div>-->
<!--                                </div>-->

<!--                                <div class="col-md-2">-->
<!--                                    <div class="form-check">-->
<!--                                        <input class="form-check-input" type="checkbox" v-model="form_data.dieu_khien_qua_app"-->
<!--                                               id="dieu_khien_qua_app" />-->
<!--                                        <label class="form-check-label" for="dieu_khien_qua_app">-->
<!--                                            Điều khiển qua app-->
<!--                                        </label>-->
<!--                                    </div>-->
<!--                                </div>-->

<!--                                <div class="col-md-1">-->
<!--                                    <div class="form-check">-->
<!--                                        <input class="form-check-input" type="checkbox" v-model="form_data.dieu_khien_tu_xa"-->
<!--                                               id="dieu_khien_tu_xa" />-->
<!--                                        <label class="form-check-label" for="dieu_khien_tu_xa">-->
<!--                                            Điều khiển từ xa-->
<!--                                        </label>-->
<!--                                    </div>-->
<!--                                </div>-->

<!--                                <div class="col-md-1">-->
<!--                                    <div class="form-check">-->
<!--                                        <input class="form-check-input" type="checkbox" v-model="form_data.khang_nuoc"-->
<!--                                               id="khang_nuoc" />-->
<!--                                        <label class="form-check-label" for="khang_nuoc">-->
<!--                                            Kháng nước-->
<!--                                        </label>-->
<!--                                    </div>-->
<!--                                </div>-->

<!--                                <div class="col-md-2">-->
<!--                                    <div class="form-check">-->
<!--                                        <input class="form-check-input" type="checkbox" v-model="form_data.suoi_am"-->
<!--                                               id="suoi_am" />-->
<!--                                        <label class="form-check-label" for="suoi_am">-->
<!--                                            Sưởi ấm-->
<!--                                        </label>-->
<!--                                    </div>-->
<!--                                </div>-->
                            </div>
<!--                            <div class="col-md-6">-->
<!--                                <div :class="{-->
<!--                                'form-group': true,-->
<!--                                'is-invalid':-->
<!--                                    typeof form_error.info !=-->
<!--                                    'undefined',-->
<!--                            }">-->
<!--                                    <label>Code</label>-->
<!--                                    <span style="color: red;">*</span>-->
<!--                                    <input class="form-control" :class="{-->
<!--                                'is-invalid':-->
<!--                                    typeof form_error.info !=-->
<!--                                    'undefined',-->
<!--                            }" type="text" name="code" v-model="form_data.code" required />-->
<!--                                    <span v-if="typeof form_error.info !=-->
<!--                                'undefined'-->
<!--                                " class="error invalid-feedback">-->
<!--                                        {{ form_error.info.join(", ") }}-->
<!--                                    </span>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="col-md-6">-->
<!--                                <div :class="{-->
<!--                                'form-group': true,-->
<!--                                'is-invalid':-->
<!--                                    typeof form_error.info !=-->
<!--                                    'undefined',-->
<!--                            }">-->
<!--                                    <label>Chất liệu</label>-->
<!--                                    <input class="form-control" :class="{-->
<!--                                'is-invalid':-->
<!--                                    typeof form_error.info !=-->
<!--                                    'undefined',-->
<!--                            }" type="text" name="chat_lieu" v-model="form_data.chat_lieu" required />-->
<!--                                    <span v-if="typeof form_error.info !=-->
<!--                                'undefined'-->
<!--                                " class="error invalid-feedback">-->
<!--                                        {{ form_error.info.join(", ") }}-->
<!--                                    </span>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="col-md-6">-->
<!--                                <div :class="{-->
<!--                                'form-group': true,-->
<!--                                'is-invalid':-->
<!--                                    typeof form_error.info !=-->
<!--                                    'undefined',-->
<!--                            }">-->
<!--                                    <label>Chức năng</label>-->
<!--                                    <input class="form-control" :class="{-->
<!--                                'is-invalid':-->
<!--                                    typeof form_error.info !=-->
<!--                                    'undefined',-->
<!--                            }" type="text" name="chuc_nang" v-model="form_data.chuc_nang" required />-->
<!--                                    <span v-if="typeof form_error.info !=-->
<!--                                'undefined'-->
<!--                                " class="error invalid-feedback">-->
<!--                                        {{ form_error.info.join(", ") }}-->
<!--                                    </span>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="col-md-6">-->
<!--                                <div :class="{-->
<!--                                'form-group': true,-->
<!--                                'is-invalid':-->
<!--                                    typeof form_error.info !=-->
<!--                                    'undefined',-->
<!--                            }">-->
<!--                                    <label>Nguồn</label>-->
<!--                                    <input class="form-control" :class="{-->
<!--                                'is-invalid':-->
<!--                                    typeof form_error.info !=-->
<!--                                    'undefined',-->
<!--                            }" type="text" name="nguon" v-model="form_data.nguon" required />-->
<!--                                    <span v-if="typeof form_error.info !=-->
<!--                                'undefined'-->
<!--                                " class="error invalid-feedback">-->
<!--                                        {{ form_error.info.join(", ") }}-->
<!--                                    </span>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="col-md-6">-->
<!--                                <div :class="{-->
<!--                                'form-group': true,-->
<!--                                'is-invalid':-->
<!--                                    typeof form_error.info !=-->
<!--                                    'undefined',-->
<!--                            }">-->
<!--                                    <label>Kích thước</label>-->
<!--                                    <input class="form-control" :class="{-->
<!--                                'is-invalid':-->
<!--                                    typeof form_error.info !=-->
<!--                                    'undefined',-->
<!--                            }" type="text" name="kich_thuoc" v-model="form_data.kich_thuoc" required />-->
<!--                                    <span v-if="typeof form_error.info !=-->
<!--                                'undefined'-->
<!--                                " class="error invalid-feedback">-->
<!--                                        {{ form_error.info.join(", ") }}-->
<!--                                    </span>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="col-md-6">-->
<!--                                <div :class="{-->
<!--                                'form-group': true,-->
<!--                                'is-invalid':-->
<!--                                    typeof form_error.info !=-->
<!--                                    'undefined',-->
<!--                            }">-->
<!--                                    <label>Xuất xứ</label>-->
<!--                                    <input class="form-control" :class="{-->
<!--                                'is-invalid':-->
<!--                                    typeof form_error.info !=-->
<!--                                    'undefined',-->
<!--                            }" type="text" name="xuat_xu" v-model="form_data.xuat_xu" required />-->
<!--                                    <span v-if="typeof form_error.info !=-->
<!--                                'undefined'-->
<!--                                " class="error invalid-feedback">-->
<!--                                        {{ form_error.info.join(", ") }}-->
<!--                                    </span>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="col-md-6">-->
<!--                                <div :class="{-->
<!--                                'form-group': true,-->
<!--                                'is-invalid':-->
<!--                                    typeof form_error.info !=-->
<!--                                    'undefined',-->
<!--                            }">-->
<!--                                    <label>Bảo hành</label>-->
<!--                                    <input class="form-control" :class="{-->
<!--                                'is-invalid':-->
<!--                                    typeof form_error.info !=-->
<!--                                    'undefined',-->
<!--                            }" type="text" name="bao_hanh" v-model="form_data.bao_hanh" required />-->
<!--                                    <span v-if="typeof form_error.info !=-->
<!--                                'undefined'-->
<!--                                " class="error invalid-feedback">-->
<!--                                        {{ form_error.info.join(", ") }}-->
<!--                                    </span>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="col-md-6">-->
<!--                                <div :class="{-->
<!--                                'form-group': true,-->
<!--                                'is-invalid':-->
<!--                                    typeof form_error.info !=-->
<!--                                    'undefined',-->
<!--                            }">-->
<!--                                    <label>Nhãn Hàng</label>-->
<!--                                    <input class="form-control" :class="{-->
<!--                                'is-invalid':-->
<!--                                    typeof form_error.info !=-->
<!--                                    'undefined',-->
<!--                            }" type="text" name="nhan_hang" v-model="form_data.nhan_hang" required />-->
<!--                                    <span v-if="typeof form_error.info !=-->
<!--                                'undefined'-->
<!--                                " class="error invalid-feedback">-->
<!--                                        {{ form_error.info.join(", ") }}-->
<!--                                    </span>-->
<!--                                </div>-->
<!--                            </div>-->
                            <div class="col-md-6">
                                <!-- Upload Picture -->
                                <div :class="{
                                'form-group': true,
                                'mt-2': true,
                                'is-invalid':
                                    typeof form_error.images !=
                                    'undefined',
                            }" style="display: flex; gap: 20px">
                                    <label for="image_upload" v-if="!uploading" class="btn btn-primary"
                                        style="flex: none">
                                        <i class="fas fa-upload"></i> Upload Image/Video
                                    </label>
                                    <button v-else class="btn btn-warning" style="flex: none">
                                        {{
                                process_upload === 100
                                    ? "Đang xử lý ..."
                                    : `Uploading: ${process_upload} %`
                            }}
                                    </button>
                                    <div v-if="uploading && process_upload !== 100
                                " class="process" style="
                                            flex: 1;
                                            display: flex;
                                            align-items: center;
                                        ">
                                        <div class="progress progress-striped active w-100" role="progressbar"
                                            :aria-valuemin="process_upload" aria-valuemax="100" aria-valuenow="0">
                                            <div class="progress-bar progress-bar-success"
                                                :style="`width:${process_upload}%;`" data-dz-uploadprogress=""></div>
                                        </div>
                                    </div>
                                </div>
                                <span v-if="typeof form_error.images != 'undefined'
                                " class="error invalid-feedback">
                                    {{ form_error.images.join(", ") }}
                                </span>
                            </div>

                            <div class="col-sm-12 my-3" v-if="!uploading && images.length !== 0">
                                <div class="form-group" style="display: flex; gap: 20px">
                                    <div class="custom-control custom-radio">
                                        <input class="custom-control-input me-2" type="radio" id="customRadio1"
                                            name="customRadio" v-model="delete_image" value="delete" />
                                        <label for="customRadio1" class="custom-control-label">Xóa</label>
                                    </div>
                                    <div class="custom-control custom-radio">
                                        <input class="custom-control-input me-2" type="radio" id="customRadio2"
                                            name="customRadio2" v-model="delete_image" value="sort" />
                                        <label for="customRadio2" class="custom-control-label">Sắp xếp</label>
                                    </div>
                                </div>
                            </div>
                            <!-- image -->
                            <div :class="{
                                'col-md-12': true,
                                'slick-sort': this.slick_sort,
                            }">
                                <SlickList @sort-end="endSort" @sort-start="startSort" axis="x" v-model:list="images"
                                    class="list-image">
                                    <SlickItem :disabled="delete_image == 'delete'" v-for="(image, i) in images"
                                        :key="image.path" :index="i" class="img-item">
                                        <!-- Button -->
                                        <div class="d-flex justify-content-between mb-2">
                                            <div class="count">
                                                {{ i + 1 }}
                                            </div>
                                            <div class="sort-options">
                                                <video-modal
                                                    v-if="checkIsVideo(image.url.full) == true"
                                                    :path="image.url.full"
                                                    :index="i"
                                                />
                                                <div v-if="delete_image == 'delete'
                                " class="item-op" title="Xóa ảnh" @click="
                                deleteImage(
                                    images,
                                    i
                                )
                                ">
                                                    <CIcon :icon="cilX" size="xl" />
                                                </div>
                                                <div v-else class="item-op full-screen">
                                                    <CIcon :icon="cilMove" size="xl" />
                                                </div>
                                            </div>
                                        </div>
                                        <img v-if="checkIsVideo(image.url.small) == false" :src="image.url.small" alt="Image" />
                                        <video
                                            v-if="checkIsVideo(image.url.full) == true"
                                            :src="image.url.full"
                                            class="object-fit-contain mw-100"
                                        ></video>
                                    </SlickItem>
                                </SlickList>
                            </div>

<!--                            <div class="col-md-12 my-4">-->
<!--                                <div class="form-group">-->
<!--                                    <label-->
<!--                                        v-if="video_uploading === false"-->
<!--                                        for="videos"-->
<!--                                        class="btn btn-success"-->
<!--                                        style="flex: 0 0 auto"-->
<!--                                    >-->
<!--                                        <i class="fas fa-file-image"></i> Upload Videos-->
<!--                                    </label>-->
<!--                                    <label-->
<!--                                        v-else-->
<!--                                        for="videos"-->
<!--                                        class="btn btn-warning"-->
<!--                                        style="flex: 0 0 auto"-->
<!--                                    >-->
<!--                                        <i class="fas fa-file-image"></i> Đang-->
<!--                                        tải video lên ...-->
<!--                                    </label>-->
<!--                                </div>-->
<!--                            </div>-->

                            <!-- Videos -->
<!--                            <div-->
<!--                                :class="{-->
<!--                                    'col-md-12': true,-->
<!--                                    'slick-sort': this.slick_sort,-->
<!--                                }"-->
<!--                            >-->
<!--                                <SlickList-->
<!--                                    @sort-end="endSort"-->
<!--                                    @sort-start="startSort"-->
<!--                                    axis="x"-->
<!--                                    v-model:list="videos"-->
<!--                                    class="list-image"-->
<!--                                >-->
<!--                                    <SlickItem-->
<!--                                        :disabled="delete_image == 'delete'"-->
<!--                                        v-for="(-->
<!--                                            image, i-->
<!--                                        ) in videos"-->
<!--                                        :key="image.file_name"-->
<!--                                        :index="i"-->
<!--                                        class="img-item"-->
<!--                                    >-->
<!--                                        &lt;!&ndash; Button Video &ndash;&gt;-->
<!--                                        <div-->
<!--                                            class="d-flex justify-content-between mb-2"-->
<!--                                        >-->
<!--                                            <div class="count">-->
<!--                                                {{ i + 1 }}-->
<!--                                            </div>-->
<!--                                            <div class="sort-options">-->
<!--                                                <video-modal-->
<!--                                                    :path="image.url.full"-->
<!--                                                    :index="i"-->
<!--                                                />-->

<!--                                                <div-->
<!--                                                    v-if="-->
<!--                                                        delete_image == 'delete'-->
<!--                                                    "-->
<!--                                                    class="item-op"-->
<!--                                                    title="Xóa ảnh"-->
<!--                                                    @click="-->
<!--                                                        deleteImage(-->
<!--                                                            videos,-->
<!--                                                            i-->
<!--                                                        )-->
<!--                                                    "-->
<!--                                                >-->
<!--                                                    <CIcon-->
<!--                                                        :icon="cilX"-->
<!--                                                        size="xl"-->
<!--                                                    />-->
<!--                                                </div>-->
<!--                                                <div-->
<!--                                                    v-else-->
<!--                                                    class="item-op full-screen"-->
<!--                                                >-->
<!--                                                    <CIcon-->
<!--                                                        :icon="cilMove"-->
<!--                                                        size="xl"-->
<!--                                                    />-->
<!--                                                </div>-->
<!--                                            </div>-->
<!--                                        </div>-->
<!--                                        <video-->
<!--                                            :src="image.url.full"-->
<!--                                            class="object-fit-contain mw-100"-->
<!--                                        ></video>-->
<!--                                    </SlickItem>-->
<!--                                </SlickList>-->
<!--                            </div>-->
                        </div>
                    </div>
                    <div class="card-footer">
                        <button v-if="api_loading === false" class="btn btn-success" @click="saveData">
                            <i class="far fa-save"></i> Save
                        </button>
                        <button v-else class="btn btn-warning">
                            <i class="far fa-save"></i> Đang lưu ...
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <input id="image_upload" accept="image/*|video/*" v-on:change="uploadPictures" name="files[]" type="file"
            style="display: none" multiple />
<!--        <input-->
<!--            v-on:change="uploadVideos"-->
<!--            id="videos"-->
<!--            accept="video/*"-->
<!--            name="files[]"-->
<!--            type="file"-->
<!--            style="display: none"-->
<!--            multiple-->
<!--        />-->
    </div>
</template>

<script>
import { SlickItem, SlickList } from "vue-slicksort";
import axios from "axios";
import Multiselect from "vue-multiselect";
import "vue-multiselect/dist/vue-multiselect.css";
import { CIcon } from "@coreui/icons-vue";
import { cilX, cilMove } from "@coreui/icons";
import VideoModal from "./Commons/Modal/VideoModal.vue";

export default {
    name: "CreateUpdate",
    components: {
        SlickList,
        SlickItem,
        Multiselect,
        CIcon,
        VideoModal,
    },
    data() {
        let product = window.$VueData.product;
        if (product) {
        }

        return {
            cilX,
            cilMove,
            slick_sort: false,
            process_upload: 0,
            video_uploading: false,
            video_process_upload: 0,
            uploading: false,
            images: product?.images == undefined ? [] : product?.images,
            videos: product?.videos == undefined ? [] : product?.videos,
            delete_image: "delete",
            categories: window.$VueData.categories,
            products: window.$VueData.products,
            packages: window.$VueData.packages,
            product_types: window.$VueData.product_types,
            page: window.$VueData.page,
            csrf_token: window.$VueData.csrf_token,
            params: new URLSearchParams(window.$VueData.params),
            api_loading: false,
            product: product,
            info: {},
            form_data: {
                rating: product ? product.rating : 0,
                subject_of_use: product ? product.subject_of_use : 0,
                tax_gst: product ? product.tax_gst : 0,
                product_id: product ? product.product_id : 0,
                package_id: product ? product.package_id : 0,
                uses: product ? product.uses : '',
                note: product ? product.note : '',
                categories: product ? product.categories : [],
                name: product ? product.name : '',
                brand: product ? product.brand : '',
                xuat_xu: product ? product.info?.xuat_xu : '',
                bao_hanh: product ? product.info?.bao_hanh : '',
                nhan_hang: product ? product.info?.nhan_hang : '',
                nguon: product ? product.info?.nguon : '',
                chat_lieu: product ? product.info?.chat_lieu : '',
                chuc_nang: product ? product.info?.chuc_nang : '',
                suoi_am: product ? product.info?.suoi_am : 0,
                dieu_khien_tu_xa: product ? product.info?.dieu_khien_tu_xa : 0,
                dieu_khien_qua_app: product ? product.info?.dieu_khien_qua_app : 0,
                khang_nuoc: product ? product.info?.khang_nuoc : 0,
                rate: product ? product.rate : 0,
                stock_sold: product ? product.stock_sold : 0,
                price: product ? product.price : 0,
                length: product ? product.length : 0,
                height: product ? product.height : 0,
                width: product ? product.width : 0,
                box_length: product ? product.box_length : 0,
                box_height: product ? product.box_height : 0,
                box_width: product ? product.box_width : 0,
                box_count: product ? product.box_count : 0,
                price_sale: product ? product.price_sale : 0,
                // tags: product ? product.tags : [],
                title: product ? product.title : '',
                sku: product ? product.sku : '',
                parent_id: product ? product.parent_id : 0,
                weight: product ? product.weight : 0,
                weight_unit: product ? product.weight_unit : '',
                active: product ? product.active === 1 : true,
                is_recommend: product ? product.is_recommend === 1 : false,
                // is_new: product ? product.is_new === 1 : true,
                order: product ? product.order : 0,
                is_sale: product ? product.is_sale === 1 : 0,
            },
            form_error: {},
            content: product ? product.description : '',
            uses: product ? product.uses : '',
            note: product ? product.note : '',
        };
    },
    computed: {
        category_select: function () {
            return this.categories;
        },
    },
    watch: {
    },
    mounted() {
        this.loadTinyFull('#mytextarea');
        this.loadTinyFullVi('#mytextarea_uses');
        this.loadTinyFullZh('#mytextarea_note');
    },
    methods: {
        repairParams(params){
            params = params.replace(/null/g,'');
            return params;
        },
        startSort() {
            this.slick_sort = true;
        },
        endSort() {
            this.slick_sort = false;
        },
        addCategory(newCategory) {
            const category = {
                name: newCategory,
            };
            this.form_data.categories.push(category);
            this.categories.push(category);
        },
        checkIsVideo(url){
            let urls = url.split("/");
            let name = urls[urls.length - 1];
            let ext = name.split(".")
            let e = ext[ext.length - 1]
            return e == "mp4";
        },
        deleteImage(list, index) {
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!"
            }).then((result) => {
                if (result.isConfirmed) {
                    list.splice(index, 1);
                    Swal.fire({
                        title: "Deleted!",
                        text: "Your file has been deleted.",
                        icon: "success"
                    });
                }
            });
        },
        async saveData() {
            if (this.api_loading) return;
            let data_post = {
                _token: this.csrf_token,
            };
            // this.info = {
            //     "kich_thuoc": this.form_data.kich_thuoc || "",
            //     "nguon": this.form_data.nguon || "",
            //     "chat_lieu": this.form_data.chat_lieu || "",
            //     "chuc_nang": this.form_data.chuc_nang || "",
            //     "suoi_am": this.form_data.suoi_am || 0,
            //     "dieu_khien_tu_xa": this.form_data.dieu_khien_tu_xa || 0,
            //     "dieu_khien_qua_app": this.form_data.dieu_khien_qua_app || 0,
            //     "khang_nuoc": this.form_data.khang_nuoc || 0,
            //     "xuat_xu": this.form_data.xuat_xu || "",
            //     "bao_hanh": this.form_data.bao_hanh || "",
            //     "nhan_hang": this.form_data.nhan_hang || "",
            // }
            // data_post.info = this.info;
            if (this.form_data.name)
                data_post.name = this.form_data.name;
            if (this.form_data.sku)
                data_post.sku = this.form_data.sku;
            if (this.form_data.active)
                data_post.active = this.form_data.active & true;
            // data_post.rating = this.form_data.rating || 0;
            data_post.is_recommend = this.form_data.is_recommend & true;
            data_post.brand = this.form_data.brand || '';
            // data_post.flavour = this.form_data.flavour || '';
            // data_post.is_sale = this.form_data.is_sale & true;
            // data_post.is_crawl = this.form_data.is_crawl & true;
            data_post.order = this.form_data.order;
            data_post.rate = this.form_data.rate || 0;
            data_post.subject_of_use = this.form_data.subject_of_use || 0;
            // data_post.price_sale = this.form_data.price_sale;
            // data_post.weight = this.form_data.weight;
            // data_post.width = this.form_data.width;
            // data_post.height = this.form_data.height;
            // data_post.length = this.form_data.length;
            // data_post.box_width = this.form_data.box_width;
            // data_post.box_height = this.form_data.box_height;
            // data_post.box_length = this.form_data.box_length;
            // data_post.box_count = this.form_data.box_count;
            // data_post.tax_gst = this.form_data.tax_gst;
            // data_post.product_id = this.form_data.product_id;
            // data_post.package_id = this.form_data.package_id;
            // data_post.tax_pst = this.form_data.tax_pst;
            // data_post.weight_unit = this.form_data.weight_unit;
            // data_post.parent_id = this.form_data.parent_id;
            // data_post.stock_sold = this.form_data.stock_sold;
            // data_post.stock = this.form_data.stock;
            // data_post.sale_price = this.form_data.sale_price;
            data_post.description = this.content || "";
            data_post.uses = this.uses || "";
            data_post.note = this.note || "";
            if (this.form_data.categories?.length !== 0) {
                data_post.categories = this.form_data?.categories?.map((item) => {
                    return item.id;
                });
                // console.log("data_post", data_post);
            }

            data_post.images = this.images.map((item) => {
                return {
                    file_name: item.file_name,
                    size: item.size,
                };
            });
            console.log("data_post", data_post);

            // data_post.videos = this.videos.map((item) => {
            //     return {
            //         path: item.path,
            //         size: item.size,
            //     }
            // });
            this.api_loading = true;
            let api_fetch = null;
            if (this.product) {
                api_fetch = axios.post(
                    `/admin/products/update/${this.product.id}`,
                    data_post
                );
            } else {
                api_fetch = axios.post("/admin/products/store", data_post);
            }
            await api_fetch
                .then((res) => {
                    console.log("Save:", res);
                    Swal.fire({
                        icon: "success",
                        text: "Lưu thành công",
                    }).then(() => {
                        window.location.href = this.repairParams("/admin/products?" + this.params);
                    });
                })
                .catch((error) => {
                    if (error.response) {
                        if (error.response.status === 422) {
                            let data = error.response.data;
                            console.log("Error ", data.errors);
                            Object.keys(data.errors).forEach((message) => {
                                console.log(
                                    "error.response.status",
                                    error.response.status
                                );
                            });

                            this.form_error = data.errors;
                        }
                    }
                    Swal.fire({
                        icon: "error",
                        title: "Error!",
                        text: "Lưu không thành công. Vui lòng thử lại!",
                    });
                });
            this.api_loading = false;
        },
        async uploadPictures(files) {
            if (this.uploading) return;
            files = files.target.files;

            if (files.length === 0) return;
            const formData = new FormData();
            for (var i = 0; i < files.length; i++) {
                formData.append("files[]", files[i]);
            }
            this.uploading = true;
            await axios
                .post("/admin/storage/images", formData, {
                    headers: {
                        "Content-Type": "multipart/form-data",
                    },
                    onUploadProgress: (progressEvent) => {
                        this.process_upload = Math.round(
                            (progressEvent.loaded * 100) / progressEvent.total
                        );
                    },
                })
                .then((res) => {
                    console.log("Upload file Success:", res.data);
                    const data = res.data.map((item) => {
                        return item;
                    });

                    this.images = [...this.images, ...data];
                })
                .catch((e) => {
                    console.error("Upload file error:", e);
                });
            this.process_upload = 0;
            this.uploading = false;
        },
        async uploadVideos(files) {
            if (this.video_uploading) return;
            if (typeof files.target == "undefined") return;
            files = files.target.files;
            const formData = new FormData();
            for (var i = 0; i < files.length; i++) {
                formData.append("files[]", files[i]);
            }
            this.video_uploading = true;
            await axios
                .post("/admin/storage/videos", formData, {
                    headers: {
                        "Content-Type": "multipart/form-data",
                    },
                    onUploadProgress: (progressEvent) => {
                        this.video_process_upload = Math.round(
                            (progressEvent.loaded * 100) / progressEvent.total
                        );
                    },
                })
                .then((res) => {
                    console.log("Upload file Success:", res.data);

                    const data = res.data.data.map((item) => {
                        return item;
                    });

                    this.videos = [
                        ...this.videos,
                        ...data[0],
                    ];
                })
                .catch((e) => {
                    console.error("Upload file error:", e);
                });
            this.video_process_upload = 0;
            this.video_uploading = false;
        },
        loadTinyFull(selector) {
            // Configuration for the full body TinyMCE editor
            const self = this
            const fullBodyConfig = {
                selector: selector,
                setup: function(editor) {
                    editor.on('init', function(e) {
                        editor.setContent(self.content);
                    });
                    editor.on('change', function () {
                        self.content = editor.getContent();
                    });
                },
                plugins: 'preview importcss searchreplace autolink autosave save directionality code visualblocks visualchars fullscreen image link media codesample table charmap pagebreak nonbreaking anchor insertdatetime advlist lists wordcount help charmap emoticons accordion',
                editimage_cors_hosts: ['picsum.photos'],
                menubar: 'file edit view insert format tools table help',
                toolbar1: "undo redo | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | styleselect",
                toolbar2: "| link unlink anchor | image media | forecolor backcolor ",
                image_advtab: true,
                formats: {
                    underline: { inline: 'span', styles: { borderBottom: '1px solid' } },
                },
                promotion: false,
                statusbar: false,
                file_picker_callback: function (callback, value, meta) {
                    // Create input element
                    var endpoint = '';
                    var input = document.createElement('input');
                    input.setAttribute('type', 'file');

                    // Set accept attribute based on file type
                    if (meta.filetype === 'image') {
                        input.setAttribute('accept', 'image/*');
                        endpoint = '/admin/storage/images'
                    } else if (meta.filetype === 'media') {
                        endpoint = '/admin/storage/videos'
                        input.setAttribute('accept', 'video/*');
                    }

                    // On file selection
                    input.onchange = function () {
                        var file = this.files[0];

                        // Create FormData object
                        var formData = new FormData();
                        formData.append("file", file);

                        // Ajax request to upload file
                        jQuery.ajax({
                            url: endpoint,
                            type: "post",
                            data: formData,
                            contentType: false,
                            processData: false,
                            async: false,
                            headers: {'X-CSRF-TOKEN': self.csrf_token},
                            success: function (response) {
                                let fileUrl = response?.data?.url?.full
                                // Callback to insert the file into editor
                                callback(fileUrl, { text: '' });
                            }
                        });
                    };

                    // Simulate click on input element
                    input.click();
                },
            };

            tinymce.init(fullBodyConfig);
        },

        loadTinyFullVi(selector) {
            // Configuration for the full body TinyMCE editor
            const self = this
            const fullBodyConfig = {
                selector: selector,
                setup: function(editor) {
                    editor.on('init', function(e) {
                        editor.setContent(self.uses);
                    });
                    editor.on('change', function () {
                        self.uses = editor.getContent();
                    });
                },
                plugins: 'preview importcss searchreplace autolink autosave save directionality code visualblocks visualchars fullscreen image link media codesample table charmap pagebreak nonbreaking anchor insertdatetime advlist lists wordcount help charmap emoticons accordion',
                editimage_cors_hosts: ['picsum.photos'],
                menubar: 'file edit view insert format tools table help',
                toolbar1: "undo redo | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | styleselect",
                toolbar2: "| link unlink anchor | image media | forecolor backcolor ",
                image_advtab: true,
                formats: {
                    underline: { inline: 'span', styles: { borderBottom: '1px solid' } },
                },
                promotion: false,
                statusbar: false,
                file_picker_callback: function (callback, value, meta) {
                    // Create input element
                    var endpoint = '';
                    var input = document.createElement('input');
                    input.setAttribute('type', 'file');

                    // Set accept attribute based on file type
                    if (meta.filetype === 'image') {
                        input.setAttribute('accept', 'image/*');
                        endpoint = '/admin/storage/images'
                    } else if (meta.filetype === 'media') {
                        endpoint = '/admin/storage/videos'
                        input.setAttribute('accept', 'video/*');
                    }

                    // On file selection
                    input.onchange = function () {
                        var file = this.files[0];

                        // Create FormData object
                        var formData = new FormData();
                        formData.append("file", file);

                        // Ajax request to upload file
                        jQuery.ajax({
                            url: endpoint,
                            type: "post",
                            data: formData,
                            contentType: false,
                            processData: false,
                            async: false,
                            headers: {'X-CSRF-TOKEN': self.csrf_token},
                            success: function (response) {
                                let fileUrl = response?.data?.url?.full
                                // Callback to insert the file into editor
                                callback(fileUrl, { text: '' });
                            }
                        });
                    };

                    // Simulate click on input element
                    input.click();
                },
            };

            tinymce.init(fullBodyConfig);
        },

        loadTinyFullZh(selector) {
            // Configuration for the full body TinyMCE editor
            const self = this
            const fullBodyConfig = {
                selector: selector,
                setup: function(editor) {
                    editor.on('init', function(e) {
                        editor.setContent(self.note);
                    });
                    editor.on('change', function () {
                        self.note = editor.getContent();
                    });
                },
                plugins: 'preview importcss searchreplace autolink autosave save directionality code visualblocks visualchars fullscreen image link media codesample table charmap pagebreak nonbreaking anchor insertdatetime advlist lists wordcount help charmap emoticons accordion',
                editimage_cors_hosts: ['picsum.photos'],
                menubar: 'file edit view insert format tools table help',
                toolbar1: "undo redo | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | styleselect",
                toolbar2: "| link unlink anchor | image media | forecolor backcolor ",
                image_advtab: true,
                formats: {
                    underline: { inline: 'span', styles: { borderBottom: '1px solid' } },
                },
                promotion: false,
                statusbar: false,
                file_picker_callback: function (callback, value, meta) {
                    // Create input element
                    var endpoint = '';
                    var input = document.createElement('input');
                    input.setAttribute('type', 'file');

                    // Set accept attribute based on file type
                    if (meta.filetype === 'image') {
                        input.setAttribute('accept', 'image/*');
                        endpoint = '/admin/storage/images'
                    } else if (meta.filetype === 'media') {
                        endpoint = '/admin/storage/videos'
                        input.setAttribute('accept', 'video/*');
                    }

                    // On file selection
                    input.onchange = function () {
                        var file = this.files[0];

                        // Create FormData object
                        var formData = new FormData();
                        formData.append("file", file);

                        // Ajax request to upload file
                        jQuery.ajax({
                            url: endpoint,
                            type: "post",
                            data: formData,
                            contentType: false,
                            processData: false,
                            async: false,
                            headers: {'X-CSRF-TOKEN': self.csrf_token},
                            success: function (response) {
                                let fileUrl = response?.data?.url?.full
                                // Callback to insert the file into editor
                                callback(fileUrl, { text: '' });
                            }
                        });
                    };

                    // Simulate click on input element
                    input.click();
                },
            };

            tinymce.init(fullBodyConfig);
        }
    },
};
</script>


<style lang="scss">
.img-item {
    width: 200px;
    z-index: 1000;

    .count {
        display: none;
    }

    .sort-options {
        display: none;
    }

    img {
        width: 200px;
        border-radius: 10px;
    }
}
</style>

<style scoped lang="scss">
.ck-editor__editable  {
    min-height: 200px !important;
}

.image-thumbnail {
    .item-img {
        width: 200px;
        position: relative;

        .badge {
            cursor: pointer;
            position: absolute;
            top: 5px;
            right: 5px;
        }

        img-item img {
            width: 200px;
            border-radius: 10px;
        }
    }
}

.list-image {
    display: flex;
    flex-wrap: wrap;
    gap: 15px;

    .img-item {
        width: 200px;
        border: 1px solid #bbbbbb;
        border-radius: 5px;
        padding: 5px;
        position: relative;
        background: #f2f2f2;

        .count {
            display: block;
            background: rgba(52, 152, 219, 0.8);
            color: #fff;
            padding: 5px 8px;
            top: 0;
            left: 0;
            border-radius: 3px;
        }

        .sort-options {
            display: flex;
            align-items: center;
            background: rgba(119, 153, 176, 0.8);
            color: #fff;
            top: 0;
            right: 0;
            border-radius: 3px;

            .item-op {
                padding: 5px 8px;
                color: #0a001f;

                &:hover {
                    background: rgba(12, 132, 255, 0.65);
                    color: white;
                    cursor: pointer;
                }
            }

            //border-radius: 3px;
        }

        img {
            width: 100%;
            height: auto;
            object-fit: cover;
            -o-object-position: center center;
            object-position: center center;
            border-radius: 0;
        }
    }
}
</style>

<template>
    <div>
        <div class="modal" v-if="showModal">
            <div class="modal-wrapper">
                <div class="modal-content">
                    <button class="modal-dismiss btn" @click="dismissModal()">X</button>
                    <div class="modal-body">
                        <form>
                            <div class="form-group">
                                <label for="">Product Name</label>
                                <input type="text" v-model.trim="formData.productName" name="product-name">
                            </div>
                            <div class="form-group">
                                <label for="">Quantity</label>
                                <input type="text" v-model.trim="formData.qty" name="quantity">
                            </div>
                            <div class="form-group">
                                <label for="">Amount</label>
                                <input type="text" v-model.trim="formData.amount" name="amount">
                            </div>
                            <button type="button" class="btn" @click="onSubmit">
                                {{ formData.id ? 'Update' : 'Create'}}
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal-backdrop" v-if="showModal"></div>
    </div>
</template>

<script>

export default {
    props: {
        showModal: {
            type: Boolean,
            default: false,
        },
        formData: {
            type: Object,
            default: null
        }
    },
    methods: {
        dismissModal() {
            this.$emit('close');
        },
        onSubmit() {
            this.$emit('onSave');
        }
    }
}
</script>

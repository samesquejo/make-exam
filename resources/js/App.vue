<template>
    <div class="wrapper">
        <div class="wrapper-container">
            <button type="button" class="btn" @click="createForm()">
                New
            </button>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Product Name</th>
                        <th>Qty</th>
                        <th>Amount</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(value, key) in data" :key="key" >
                        <td>{{ value.id }}</td>
                        <td>{{ value.productName }}</td>
                        <td>{{ value.qty }}</td>
                        <td>{{ value.amount }}</td>
                        <td>
                            <button class="btn" @click="editForm(value)">
                                Edit
                            </button>
                            <button class="btn-danger" @click="deleteItem(value.id)">
                                Delete
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <modals :showModal="showModal" :formData="formData" @close="activeModal(false)" @onSave="onSave()" />
    </div>
</template>

<script>
import Modals from './vue-components/modals.vue';

export default {
    components: {
        Modals
    },
    data() {
        return {
            showModal: false,
            isEdit: 0,
            data: [],
            formData: {
                id: null,
                productName: null,
                qty: null,
                amount: null
            }
        }
    },
    created() {
        this.getInventory();
    },
    methods: {
        async getInventory() {
            await this.$axios.get(`api/inventory`).then( ({data}) => {
                if (data.data) {
                    this.data = data.data;
                }
            });
        },
        activeModal(type) {
            this.showModal = type;
        },
        async onSave() {
            try {
                const body = {
                    productName: this.formData.productName,
                    qty: this.formData.qty,
                    amount: this.formData.amount
                }
                if (this.formData.id) {
                    body.id = this.formData.id;
                    await this.$axios.put(`api/inventory/${body.id}`, body);
                } else {
                    await this.$axios.post(`api/inventory`, body);
                }
                await this.getInventory();
                this.activeModal(false);
                this.formData = {
                    id: null,
                    productName: null,
                    qty: null,
                    amount: null
                };
            } catch (error) {
                alert(error);
            }
        },
        createForm() {
            this.activeModal(true);
            this.formData = {
                id: null,
                productName: null,
                qty: null,
                amount: null
            };
        },
        editForm(data) {
            this.formData = {
                id: data.id,
                productName: data.productName,
                qty: data.qty,
                amount: data.amount,
            }
            this.activeModal(true);
        },
        async deleteItem(id) {
            try {
                await this.$axios.delete(`api/inventory/${id}`);
                await this.getInventory();
            } catch (error) {
                alert(error);
            }
        }
    }
}
</script>

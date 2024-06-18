<template>
    <form @submit.prevent="store()" @keydown="clearError($event.target.name)">
        <div class="form-group mb-4">
            <label>{{formLables.name}}</label>
            <input type="text" name="name" required class="form-control" v-model="modalData.listItem.name">
            <small v-if="modalData.errors.name" class="text-danger float-end">{{ modalData.errors.name[0] }}</small>
        </div>

        <div class="form-group mb-4">
            <label>{{formLables.email}}</label>
            <input type="email" name="email" required class="form-control" v-model="modalData.listItem.email">
            <small v-if="modalData.errors.email" class="text-danger float-end">{{ modalData.errors.email[0] }}</small>
        </div>

        <div class="form-group mb-4">
            <label>{{formLables.phone}}</label>
            <input type="tel" name="phone" required pattern="\d*" minlength=11 maxlength="11" class="form-control" v-model="modalData.listItem.phone">
            <small v-if="modalData.errors.phone" class="text-danger float-end">{{ modalData.errors.phone[0] }}</small>
        </div>

        <div class="form-group mb-4">
            <label>{{formLables.description}}</label>
            <textarea name="description" rows="4" class="form-control w-100" style="resize:none;" v-model="modalData.listItem.description"></textarea>
            <small v-if="modalData.errors.description" class="text-danger float-end">{{ modalData.errors.description[0] }}</small>
        </div>

        <div class="form-group text-center">
            <button class="btn btn-primary" :disabled=isErrors>
                <span v-if="modalData.modalState == 'Create'" class="me-2">{{texts.btnSave}}</span>
                <span v-if="modalData.modalState == 'Edit'" class="me-2">{{texts.btnUpdate}}</span>
                <i class="fa fa-floppy-o fa-lg"></i>
            </button>
        </div>
    </form>
</template>

<script>
    export default {
        props:['formLables', 'texts', 'modalData'],

        computed: {
            isErrors() {
                return Object.keys(this.modalData.errors).length;
            },
        },

        methods: {
            clearError(field){
                if (field) {
                    delete this.modalData.errors[field];
                }
            },

            store() {
                if (!this.isErrors) {
                    let axiosResult, success;
                    if(this.modalData.modalState == 'Create') {
                        success = this.texts.created;
                        axiosResult = axios.put('/list/save', this.modalData.listItem)
                    }
                    else if(this.modalData.modalState == 'Edit') {
                        success = this.texts.updated;
                        axiosResult = axios.patch('/list/' + this.modalData.listItem.id, this.modalData.listItem);
                    }
                    else {
                        return;
                    }
                    axiosResult
                        .then((resp)=> {
                            this.$emit('modalShow', success);
                            this.$emit('reRenderList');
                        })
                        .catch((error) => {
                            this.modalData.errors = error.response.data;
                        })
                }
            }
        }
    }
</script>
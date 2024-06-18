<template>
    <div class="modal bg-secondary bg-opacity-50 pt-5" :style="[modalData.modalState ? 'display: block !important' : false]" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">{{modalData.modalState}}</h3>
                    <button type="button" class="btn-close" @click="modalShow(false)"></button>
                </div>

                <div v-if="modalData.modalState == 'Show'" class="modal-body">
                    <b>Description:</b> {{modalData.listItem.description}}
                </div>

                <div v-if="modalData.modalState == 'Create' || modalData.modalState == 'Edit'" class="modal-body">
                    <FormComponent :formLables="formLables" :texts="texts" :modalData="modalData" @reRenderList="reRenderList" @modalShow="modalShow"></FormComponent>
                </div>

                <div v-else-if="modalData.modalState == 'Delete'" class="modal-body">
                    <h4 class="modal-title text-danger mb-2">Do you really want to delete?</h4>
                    <div class="text-center">
                        <DeleteComponent :texts="texts" :listItemId="modalData.listItem.id" @reRenderList="reRenderList" @modalShow="modalShow"></DeleteComponent>
                    </div>
                </div>

                <div v-else-if="modalData.modalState == 'Error'" class="modal-body">
                    <div class="modal-body">
                        <h4 class="modal-title text-center text-danger">
                            {{texts.status}}: {{modalData.errors.status}}
                            <br>
                            {{texts.text}}: {{modalData.errors.statusText}}
                        </h4>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-info" @click="modalShow(false)">
                        <span class="me-2">{{texts.btnClose}}</span>
                        <i class="fa fa-times"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import DeleteComponent from './DeleteComponent.vue';
    import FormComponent from './FormComponent.vue';

    export default {
        props:['formLables', 'texts', 'modalData'],

        components: {
            DeleteComponent,
            FormComponent
        },

        methods: {
            reRenderList() {
                this.$emit('reRenderList');
            },

            modalShow(state, data) {
                this.$emit('modalShow', state, data);
            }
        }
    }
</script>
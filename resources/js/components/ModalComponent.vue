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

                <div v-if="modalData.modalState == 'Edit'" class="modal-body">
                    <!-- <UpdateComponent :phone="modalData.listItem" :data="modalData.edit" :formLables="formLables" @reRenderList="reRenderList" @modalShow="modalShow"></UpdateComponent> -->
                </div>

                <div v-else-if="modalData.modalState == 'Delete'" class="modal-body">
                    <h4 class="modal-title text-danger mb-2">Do you really want to delete?</h4>
                    <div class="text-center">
                        <DeleteComponent :listItemId="modalData.listItem.id" @reRenderList="reRenderList" @modalShow="modalShow"></DeleteComponent>
                    </div>
                </div>

                <div v-else-if="modalData.modalState == 'Error'" class="modal-body">
                    <div class="modal-body">
                        <h4 class="modal-title text-center text-danger">
                            Status: {{modalData.error.status}}
                            <br>
                            Text: {{modalData.error.statusText}}
                        </h4>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-info" @click="modalShow(false)">
                        <span class="me-2">Close</span>
                        <i class="fa fa-times"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import DeleteComponent from './DeleteComponent.vue';
    // import UpdateComponent from './UpdateComponent.vue';

    export default {
        props:['modalData', 'formLables'],

        components: {
            DeleteComponent,
            // UpdateComponent
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
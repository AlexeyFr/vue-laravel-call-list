<template>
    <section>
        <h2 class="text-center mt-4 mb-0">{{texts.table_name}}</h2>

        <div class="text-end me-1 position-relative">
            <span v-if="listDataTemp.length" class="me-3 pe-3">{{texts.list_calls}}: <b>{{listDataTemp.length}}</b></span>
            <i v-if="refreshShow" role="button" class="fa fa-refresh fa-lg text-info position-absolute end-0 top-50 translate-middle-y" @click="reRenderList"></i>
        </div>

        <h4 class="text-center mt-4 text-warning" v-if="!listDataTemp.length && !isLoading">The table is empty! </h4>

        <table class="table table-bordered table-hover text-center align-middle position-relative">
            <thead v-if="listDataTemp.length">
                <tr>
                    <th class="position-relative" style="cursor: pointer" @click="sortListByCalled">
                        <span>Called</span>
                        <i class="fa fa-sort position-absolute top-50 end-0 translate-middle-y me-1"></i>
                    </th>
                    <th v-for="(lable, index) in tableLables" :key="index">{{lable}}</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="listItem in listDataTemp" :key="listItem.id">
                    <td>
                        <input class="form-check-input border-primary" type="checkbox" @change="updateCheck(listItem)" :checked="listItem.called" />
                    </td>
                    <td>{{ listItem.name }}</td>
                    <td>{{ listItem.phone }}</td>
                    <td>{{ listItem.email }}</td>
                    <td>
                        <button class="btn text-success" @click="modalShow(texts.show, listItem)">
                            <i class="fa fa-eye fa-lg"></i>
                        </button>
                    </td>
                    <td class="text-center">
                        <button class="btn text-primary" @click="modalShow(texts.edit, listItem)">
                            <i class="fa fa-pencil fa-lg"></i>
                        </button>
                    </td>
                    <td class="text-center">
                        <button class="btn text-danger" @click="modalShow(texts.delete, listItem)">
                            <i class="fa fa-trash fa-lg"></i>
                        </button>
                    </td>
                </tr>
            </tbody>
            <div v-if="isLoading" class="bg-light bg-opacity-75 w-100 h-100 position-absolute start-0 top-0 mt-5 flex justify-content-center align-items-center">
                <div class="spinner-border" role="status" style="width: 4rem; height: 4rem;"></div>
            </div>
        </table>
    </section>
</template>

<script>
    export default {
        props:['texts', 'tableLables',  'isLoading', 'refreshShow', 'listDataTemp'],

        methods: {
            sortListByCalled() {
                this.$emit('sortListByCalled');
            },

            reRenderList() {
                this.$emit('reRenderList');
            },

            modalShow(state, data) {
                this.$emit('modalShow', state, data);
            },

            updateCheck(listItem) {
                listItem.called = !listItem.called;
                axios.patch('/list/' + listItem.id, listItem)
                    .then(resp => {
                        console.log('Updated');
                    })
                    .catch(err => {
                        this.$emit('modalShow', 'Error', err.response);
                    });
            }
        }
    }
</script>
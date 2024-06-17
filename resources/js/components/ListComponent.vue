<template>
    <table class="table table-bordered table-hover text-center align-middle position-relative">
        <thead>
            <tr>
                <th role="button" class="position-relative" @click="sortListByCalled">
                    <span>Called</span>
                    <i class="fa fa-sort position-absolute top-50 end-0 translate-middle-y me-1"></i>
                </th>
                <th v-for="(lable, index) in tableLables" :key="index">{{lable}}</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="listItem in listDataTemp" :key="listItem.id" class="">
                <td>
                    <input class="form-check-input border-primary" type="checkbox" @change="updateCheck(listItem)" :checked="listItem.called" />
                </td>
                <td>{{ listItem.name }}</td>
                <td>{{ listItem.phone }}</td>
                <td>{{ listItem.email }}</td>
                <td>
                    <button class="btn text-success" @click="modalShow('Show', listItem)">
                        <i class="fa fa-eye fa-lg"></i>
                    </button>
                </td>
                <td class="text-center">
                    <button class="btn text-primary" @click="modalShow('Edit', listItem)">
                        <i class="fa fa-pencil fa-lg"></i>
                    </button>
                </td>
                <td class="text-center">
                    <button class="btn text-danger" @click="modalShow('Delete', listItem)">
                        <i class="fa fa-trash fa-lg"></i>
                    </button>
                </td>
            </tr>
        </tbody>
        <div v-if="isLoading" class="bg-light bg-opacity-75 w-100 h-100 position-absolute start-0 top-0 flex justify-content-center align-items-center">
            <div class="spinner-border" role="status" style="width: 4rem; height: 4rem;"></div>
        </div>
    </table>
</template>

<script>
    export default {
        props:['tableLables', 'isLoading', 'listDataTemp'],

        methods: {
            sortListByCalled() {
                this.$emit('sortListByCalled');
            },

            updateCheck(listItem) {
                listItem.called = !listItem.called;
                axios.put('list/' + listItem.id, listItem)
                    .then(resp => {
                        console.log('Updated');
                        // this.$emit('modalShow', 'Updated');
                    })
                    .catch(err => {
                        this.$emit('modalShow', 'Error', err.response);
                    });
            },

            modalShow(state, data) {
                this.$emit('modalShow', state, data);
            }
        }
    }
</script>
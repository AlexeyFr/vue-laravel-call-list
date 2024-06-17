<template>
    <table class="table table-bordered table-hover text-center align-middle">
        <thead>
            <tr>
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
    </table>
</template>

<script>
    export default {
        props:['tableLables', 'listDataTemp'],

        methods: {
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
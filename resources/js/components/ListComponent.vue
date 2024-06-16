<template>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th v-for="(lable, index) in tableLables" :key="index" class="text-center">{{lable}}</th>
            </tr>
        </thead>

        <tbody>
            <tr v-for="list in listDataTemp" :key="list.id">
                <td class="text-center">{{ list.called }}</td>
                <td class="text-center">{{ list.name }}</td>
                <td class="text-center">{{ list.phone }}</td>
                <td class="text-center">{{ list.email }}</td>
                <td class="text-center">
                    <button class="btn btn-primary">
                        <i class="glyphicon glyphicon-pencil"></i>
                    </button>
                </td>
                <td class="text-center">
                    <button class="btn btn-danger">
                        <i class="glyphicon glyphicon-trash"></i>
                    </button>
                </td>
            </tr>
        </tbody>
    </table>
</template>

<script>
    export default {
        props:['tableLables', 'listDataTemp'],
    }
</script>
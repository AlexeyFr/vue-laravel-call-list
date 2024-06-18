<template>
    <button class="btn btn-danger" @click="deleteListItem()">
        <span class="me-2">{{texts.delete}}</span>
        <i class="fa fa-trash-o"></i>
    </button>
</template>
<script>
    export default {
        props:['texts', 'listItemId'],

        methods: {
            deleteListItem() {
                axios.delete('/list/' + this.listItemId)
                    .then(res => {
                        this.$emit('reRenderList');
                        this.$emit('modalShow', 'Deleted');
                    })
                    .catch(err => {
                        this.$emit('modalShow', 'Error', err.response);
                    });
            },
        }
    }
</script>
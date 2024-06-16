<template>
    <h2 class="text-center">{{dataSearch.title}}</h2>
    <form>
        <div class="has-success has-feedback">
            <input type="text" class="form-control" placeholder="Search by Name and Phone" v-model="dataSearch.searchQuery">
            <span class="glyphicon glyphicon-search form-control-feedback"></span>
        </div>
    </form>
</template>

<script>
    export default {
        props:['dataSearch']
    }
</script>
<template>
    <h2 class="text-center">{{dataSearch.title}}</h2>
    <form>
        <div class="position-relative">
            <input type="text" class="border-primary form-control ps-5" placeholder="Search by Name and Phone" v-model="dataSearch.searchQuery">
            <i class="fa fa-search fa-lg position-absolute top-50 start-0 translate-middle-y ms-3 text-primary"></i>
        </div>
    </form>
</template>

<script>
    export default {
        props:['dataSearch']
    }
</script>
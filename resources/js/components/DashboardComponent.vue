<template>
    <section class="container">
        <h1 class="text-center">{{title}}</h1>
        <CreateComponent :formLables="formLables" :action="action" @reRenderList="reRenderList"></CreateComponent>
        <ListComponent :tableLables="tableLables" :listData="listData"></ListComponent>
    </section>
</template>

<script>
    import CreateComponent from './CreateComponent.vue';
    import ListComponent from './ListComponent.vue';

    export default {
        components: {
            CreateComponent,
            ListComponent,
        },

        data() {
            return {
                title: 'Vue-Laravel Call-Lists',
                formLables: {
                    name: 'Name',
                    email: 'Email',
                    phone: 'Phone',
                    description: 'Description',
                },
                tableLables: {
                    called: 'Called',
                    name: 'Name',
                    email: 'Email',
                    phone: 'Phone',
                    edit: 'Edit',
                    delete: 'Delete'
                },
                action: {
                    title: 'Create',
                    button: 'Save'
                },
                listData: []
            }
        },

        created() {
            if (ListCall) {
                this.listData = ListCall;
            }
            else {
                this.getListData();
            }
        },

        methods: {
            getListData() {
                axios.post('/list/get')
                    .then(response => {
                        this.listData = response.data
                    })
                    .catch(error => {
                        console.log("error", error);
                    });
            },

            reRenderList() {
                this.getListData();
            },
        }

    }
</script>
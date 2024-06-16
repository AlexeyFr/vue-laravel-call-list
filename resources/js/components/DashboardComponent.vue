<template>
    <h1 class="text-center">{{title}}</h1>
    <SearchComponent :dataSearch="dataSearch"></SearchComponent>
    <CreateComponent :formLables="formLables" :action="action" @reRenderList="reRenderList"></CreateComponent>
    <ListComponent :tableLables="tableLables" :listDataTemp="listDataTemp"></ListComponent>
</template>

<script>
    import SearchComponent from './SearchComponent.vue';
    import CreateComponent from './CreateComponent.vue';
    import ListComponent from './ListComponent.vue';
    export default {
        components: {
            SearchComponent,
            CreateComponent,
            ListComponent,
        },

        data() {
            return {
                title: 'Vue-Laravel Call-Lists',
                dataSearch: {
                    title: 'Search',
                    searchQuery: ''
                },
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

                listData: [],
                listDataTemp: [],

            }
        },

        created() {
            if (ListCall) {
                this.listDataTemp = this.listData = ListCall;
            }
            else {
                this.getListData();
            }
        },

        methods: {
            getListData() {
                axios.post('/list/get')
                    .then(response => {
                        this.listDataTemp = this.listData = response.data;
                    })
                    .catch(error => {
                        console.log("error", error);
                    });
            },

            reRenderList() {
                this.getListData();
            },

        },

        watch:{
            'dataSearch.searchQuery'() {
                if (this.dataSearch.searchQuery.length > 0) {
                    this.listDataTemp = this.listData.filter((item) => {
                        return Object.keys(item).some((key)=>{
                            if (key == 'name' || key == 'phone') {
                                let string = String(item[key]);
                                return string.toLowerCase().indexOf(this.dataSearch.searchQuery.toLowerCase())>-1
                            }
                        })
                    });
                }
                else {
                    this.listDataTemp = this.listData
                }
            }
        }

    }
</script>
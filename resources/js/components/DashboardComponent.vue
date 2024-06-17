<template>
    <h1 class="text-center mt-3">{{title}}</h1>
    <SearchComponent :dataSearch="dataSearch"></SearchComponent>
    <CreateComponent :formLables="formLables" :action="action" @reRenderList="getListData"></CreateComponent>
    <div class="text-right me-1 mb-1 position-relative">
        <span class="me-3 pe-3">List calls: <b>{{listDataTemp.length}}</b></span>
        <i v-if="refreshShow" role="button" class="fa fa-refresh fa-lg text-info position-absolute end-0 top-50 translate-middle-y" @click="getListData"></i>
    </div>
    <ListComponent :tableLables="tableLables" :isLoading="isLoading" :listDataTemp="listDataTemp" @sortListByCalled="sortListByCalled" @modalShow="modalShow"></ListComponent>
    <ModalComponent :modalData="modalData" :formLables="formLables" @reRenderList="getListData" @modalShow="modalShow"></ModalComponent>

</template>

<script>
    import SearchComponent from './SearchComponent.vue';
    import CreateComponent from './CreateComponent.vue';
    import ListComponent from './ListComponent.vue';
    import ModalComponent from './ModalComponent.vue';
    export default {
        components: {
            SearchComponent,
            CreateComponent,
            ListComponent,
            ModalComponent,
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
                    phone: 'Phone',
                    email: 'Email',
                    description: 'Description',
                },
                tableLables: {
                    name: 'Name',
                    phone: 'Phone',
                    email: 'Email',
                    description: 'Description',
                    edit: 'Edit',
                    delete: 'Delete'
                },
                action: {
                    title: 'Create',
                    button: 'Save'
                },
                isSortByCalled: false,

                isLoading: true,
                refreshShow: true,
                listData: [],
                listDataTemp: [],

                modalData: {
                    modalState: '',
                    listItem: {},
                    edit: {
                        button: 'Update'
                    },
                    error: ''
                },
            }
        },

        created() {
            if (typeof listCalls !== "undefined" && !!listCalls && listCalls.length > 0) {
                setTimeout(() => {
                    this.listDataTemp = this.listData = listCalls;
                    this.isLoading = false;
                }, 1000);
            }
            else {
                this.getListData();
            }
        },

        methods: {
            getListData() {
                this.refreshShow = false;
                this.isLoading = true;
                axios.post('/list/get')
                    .then(response => {
                        setTimeout(() => {
                            this.listDataTemp = this.listData = response.data;
                            this.dataSearch.searchQuery = '';
                            this.isSortByCalled = false;

                            this.isLoading = false;
                            this.refreshShow = true;
                        }, 1000);
                    })
                    .catch(error => {
                        console.log("error", error);
                        setTimeout(() => {
                            this.isLoading = false;
                            this.refreshShow = true;
                        }, 1000);
                    });
            },

            sortListByCalled() {
                this.isSortByCalled = !this.isSortByCalled;
                this.sortList();
            },

            modalShow(state, data) {
                if (state) {
                    if (state == "Error") {
                        this.modalData.error = data
                    }
                    else {
                        this.modalData.listItem = data ? data : {};
                    }
                    this.modalData.modalState = state;
                }
                else {
                    this.modalData.modalState = this.modalData.error = ''
                    this.modalData.listItem = {};
                }
            },

            sortList() {
                if (this.isSortByCalled) {
                    this.listDataTemp.sort(function(a,b){
                        if (!a.called && b.called) {
                            return -1;
                        }
                        else {
                            return 1;
                        }
                    })
                }
                else {
                    this.listDataTemp.sort(function(a,b){
                        if (a.id > b.id) {
                            return 1;
                        }
                        else {
                            return -1;
                        }
                    })
                }
            },
        },

        mounted() {
            this.sortList();
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
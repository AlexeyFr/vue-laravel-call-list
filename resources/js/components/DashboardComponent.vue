<template>
    <header class="text-center">
        <h1 class="text-center mt-4 mb-3">{{title}}</h1>
        <button class="btn btn-success btn-lg" @click="modalShow('Create')">
            <span class="me-2">{{texts.btnCreate}}</span>
            <i class="fa fa-plus"></i>
        </button>
    </header>

    <SearchComponent :dataSearch="dataSearch"></SearchComponent>
    <ListComponent :tableLables="tableLables" :texts="texts" :isLoading="isLoading" :refreshShow="refreshShow" @reRenderList="getListData" :listDataTemp="listDataTemp" @sortListByCalled="sortListByCalled" @modalShow="modalShow"></ListComponent>
    <ModalComponent :formLables="formLables" :texts="texts" :modalData="modalData" @reRenderList="getListData" @modalShow="modalShow"></ModalComponent>
</template>

<script>
    import SearchComponent from './SearchComponent.vue';
    import ListComponent from './ListComponent.vue';
    import ModalComponent from './ModalComponent.vue';
    export default {
        components: {
            SearchComponent,
            ListComponent,
            ModalComponent,
        },

        data() {
            return {
                title: 'Vue-Laravel Call-List',
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
                isSortByCalled: false,

                isLoading: true,
                refreshShow: true,
                listData: [],
                listDataTemp: [],

                texts: {
                    table_name: 'Table Call-List',
                    list_calls: 'Calls list count',
                    btnCreate: 'Create',
                    btnSave: 'Save',
                    btnUpdate: 'Update',
                    show: 'Show',
                    edit: 'Edit',
                    delete: 'Delete',
                    btnClose: 'Close',
                    status: 'Status',
                    text: 'Text',
                    created: 'Successfully created',
                    updated: 'Successfully updated',
                },

                modalData: {
                    modalState: false,
                    listItem: {},
                    errors: {},
                }
            }
        },

        created() {
            if (typeof listCalls !== "undefined" && !!listCalls && listCalls.length > 0) {
                setTimeout(() => {
                    this.listDataTemp = this.listData = listCalls;
                    this.isLoading = false;
                }, 500);
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
                        }, 500);
                    })
                    .catch(error => {
                        console.log("error", error);
                        setTimeout(() => {
                            this.isLoading = false;
                            this.refreshShow = true;
                        }, 500);
                    });
            },

            sortListByCalled() {
                this.isSortByCalled = !this.isSortByCalled;
                this.sortList();
            },

            modalShow(state, data) {
                if (state) {
                    if (state == "Error") {
                        this.modalData.errors = data ? data : {};
                    }
                    else {
                        this.modalData.listItem = data ? data : {};
                    }
                    this.modalData.modalState = state;
                }
                else {
                    this.modalData.modalState = false;
                    this.modalData.listItem = this.modalData.errors = {};
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
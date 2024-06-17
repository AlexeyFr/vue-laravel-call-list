<template>
    <h1 class="text-center mt-3">{{title}}</h1>
    <SearchComponent :dataSearch="dataSearch"></SearchComponent>
    <CreateComponent :formLables="formLables" :action="action" @reRenderList="reRenderList"></CreateComponent>
    <h6 class="text-right me-1">List calls: <b>{{listDataTemp.length}}</b></h6>
    <ListComponent :tableLables="tableLables" :listDataTemp="listDataTemp" @modalShow="modalShow"></ListComponent>
    <ModalComponent :modalData="modalData" :formLables="formLables" @reRenderList="reRenderList" @modalShow="modalShow"></ModalComponent>
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
                    called: 'Called',
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
                this.listDataTemp = this.listData = listCalls;
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
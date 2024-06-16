<template>
    <section>
        <h2 v-if="action.title" class="text-center">{{action.title}}</h2>

        <form @submit.prevent="save()" @keydown="clearError($event.target.name)">
            <div class="form-group">
                <label>{{formLables.name}}</label>
                <input type="text" name="name" required class="form-control" v-model="form.name">
                <small v-if="errors.name" class="has-text-danger is-pulled-right">{{ errors.name[0] }}</small>
            </div>

            <div class="form-group">
                <label>{{formLables.email}}</label>
                <input type="email" name="email" required class="form-control" v-model="form.email">
                <small v-if="errors.email" class="has-text-danger is-pulled-right">{{ errors.email[0] }}</small>
            </div>

            <div class="form-group">
                <label>{{formLables.phone}}</label>
                <input type="tel" name="phone" required pattern="\d*" minlength=11 maxlength="11" class="form-control" v-model="form.phone">
                <small v-if="errors.phone" class="has-text-danger is-pulled-right">{{ errors.phone[0] }}</small>
            </div>

            <div class="form-group">
                <label>{{formLables.description}}</label>
                <textarea name="description" class="form-control w-100" v-model="form.description"></textarea>
                <small v-if="errors.description" class="has-text-danger is-pulled-right">{{ errors.description[0] }}</small>
            </div>

            <div class="form-group">
                <button class="btn btn-primary" :disabled=isErrors>
                    <span class='glyphicon glyphicon-save-file'></span>
                    <span>{{action.button}}</span>
                </button>
            </div>
        </form>
    </section>
</template>

<script>
    export default {
        props:['formLables', 'action'],

        data() {
            return {
                form: {
                    name: '',
                    phone: '',
                    email: '',
                    description: ''
                },
                errors: {},
            }
        },

        computed: {
            isErrors() {
                return Object.keys(this.errors).length;
            },
        },

        methods: {
            clearError(field){
                if (field) {
                    delete this.errors[field];
                }
            },

            save() {
                if (!this.isErrors) {
                    axios.post('/list/save', this.$data.form)
                        .then((resp)=> {
                            this.$emit('reRenderList');
                        })
                        .catch((error) => {
                            this.errors = error.response.data;
                        })
                }
            }
        }
    }
</script>
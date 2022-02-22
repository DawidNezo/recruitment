<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="row" v-if="errors !== ''">
                    {{ errors }}
                </div>

                <form @submit.prevent="saveEmployee">
                    <label for="name">Name </label>
                    <input type="text" name="name" id="name" v-model="form.name">
                    <hr>
                    <label for="surname">Surname </label>
                    <input type="text" name="surname" id="surname" v-model="form.surname">
                    <hr>
                    <label for="email">Email </label>
                    <input type="text" name="email" id="email" v-model="form.email">
                    <hr>
                    <button class="btn btn-primary" type="submit">Submit</button>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
    import useEmployees from "../composables/employees";
    import { reactive } from "vue";

    export default {
        setup() {
            const form = reactive({
                name: '',
                surname: '',
                email: ''
            })

            const { errors, storeEmployee } = useEmployees()

            const saveEmployee = async () => {
                await storeEmployee({ ...form })
            }

            return {
                form,
                errors,
                saveEmployee
            }
        }
    }
</script>

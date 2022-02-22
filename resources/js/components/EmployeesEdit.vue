<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="row" v-if="errors !== ''">
                    {{ errors }}
                </div>

                <form @submit.prevent="saveEmployee">
                    <label for="name">Name </label>
                    <input type="text" name="name" id="name" v-model="employee.name">
                    <hr>
                    <label for="surname">Surname </label>
                    <input type="text" name="surname" id="surname" v-model="employee.surname">
                    <hr>
                    <label for="email">Email </label>
                    <input type="text" name="email" id="email" v-model="employee.email">
                    <hr>
                    <button class="btn btn-primary" type="submit">Submit</button>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
    import useEmployees from "../composables/employees";
    import { onMounted } from "vue";

    export default {
        props: {
            id: {
                required: true,
                type: String
            }
        },

        setup(props) {
            const { errors, employee, updateEmployee, getEmployee } = useEmployees()

            onMounted(() => getEmployee(props.id))

            const saveEmployee = async () => {
                await updateEmployee(props.id)
            }

            return {
                errors,
                employee,
                saveEmployee
            }
        }
    }
</script>
